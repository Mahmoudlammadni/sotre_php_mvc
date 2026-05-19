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

        global $pdo;

        try {
            $pdo->beginTransaction();

            $total = 0;
            $validItems = [];
            
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? FOR UPDATE");
                $stmt->execute([$productId]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$product) {
                    throw new Exception("Product no longer available");
                }
                
                if ($product['quantity'] < $quantity) {
                    throw new Exception("Not enough stock for {$product['name']}");
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

            $orderId = $this->orderModel->create($clientId, $userId, $total);

            foreach ($validItems as $item) {
                $this->orderItemModel->create(
                    $orderId,
                    $item['product_id'],
                    $item['quantity'],
                    $item['price']
                );
                $this->productModel->decrementStock($item['product_id'], $item['quantity']);
            }

            unset($_SESSION['cart']);
            $pdo->commit();
            header("Location: index.php?controller=client&action=profile&id=$orderId");
            exit();

        } catch (Exception $e) {
            $pdo->rollBack();
            error_log("Checkout error: " . $e->getMessage());
            $_SESSION['error'] = $e->getMessage() ?: "Checkout failed. Please try again.";
            header("Location: index.php?controller=cart&action=view");
            exit();
        }
    }

}