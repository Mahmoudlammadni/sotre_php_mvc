<?php
include __DIR__ . "/../model/Client.php";
include __DIR__ . "/../model/Product.php";
include __DIR__ . "/../model/Order.php";
include __DIR__ . "/../model/Orderitem.php";
class CartController {
   private  $clientModel;
    private $productModel;
    private $orderModel;
    private $orderItemModel;
  
    public function __construct()
    {
        global $pdo;
        $this->clientModel= new Client($pdo);
        $this->productModel = new Product($pdo); 
        $this->orderModel = new Order($pdo); 
        $this->orderItemModel = new Orderitem($pdo); 
    }
    public function add() {
        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
            header("Location: index.php?controller=user&action=showLogin");
            exit;
        }

        $productId = $_GET['id'];
        $quantity = $_GET['quantity'] ?? 1;

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'cart_count' => array_sum($_SESSION['cart'])
            ]);
            exit;
        }

        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
    }
    public function remove() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?controller=user&action=showLogin");
        exit;
    }

    $productId = $_GET['id'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit;
    }

    header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php?controller=client&action=profile'));
}

    public function checkout() {
        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect'] = 'checkout';
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        if (empty($_SESSION['cart'])) {
            $_SESSION['error'] = "Your cart is empty";
            header("Location: index.php?controller=cart&action=view");
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $client = $this->clientModel->getClientByUserId($userId);
        
        if (!$client) {
        $_SESSION['pending_checkout'] = true;
        $_SESSION['error'] = "Please complete your client profile before checkout";
        header("Location: index.php?controller=client&action=edit");
        exit();
    }
        $clientId = $client['id'];

        $total = 0;
        $validItems = [];
        
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = $this->productModel->getById($productId);
            
            if (!$product) {
                $_SESSION['error'] = "Product no longer available";
                header("Location: index.php?controller=cart&action=view");
                exit();
            }
            
            if ($product['quantity'] < $quantity) {
                $_SESSION['error'] = "Not enough stock for {$product['name']}";
                header("Location: index.php?controller=cart&action=view");
                exit();
            }
            
            $subtotal = $product['price'] * $quantity;
            $total += $subtotal;
            $validItems[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product['price'],
                'subtotal' => $subtotal
            ];
        }

        try {
            $orderId = $this->orderModel->create($clientId, $userId, $total);

            foreach ($validItems as $item) {
                $this->orderItemModel->create(
                    $orderId,
                    $item['product_id'],
                    $item['quantity'],
                    $item['price']
                );
               
            }

            unset($_SESSION['cart']);
            header("Location: index.php?controller=client&action=profile&id=$orderId");
            exit();

        } catch (Exception $e) {
            error_log("Checkout error: " . $e->getMessage());
            $_SESSION['error'] = "Checkout failed. Please try again.";
            header("Location: index.php?controller=cart&action=view");
            exit();
        }
    }

}