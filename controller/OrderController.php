<?php
include __DIR__ ."/../model/Order.php";
include __DIR__ ."/../model/OrderItem.php";
class OrderController {
    private $order;
    private $orderItem;

    public function __construct() {
        global $pdo;
        $this->order = new Order($pdo);
        $this->orderItem = new OrderItem($pdo);
    }

 public function show() {
    $orderId = $_GET['id'] ?? null;

    if (!$orderId || !is_numeric($orderId)) {
        $_SESSION['error'] = "Invalid order ID";
        header("Location: index.php?controller=order&action=index");
        exit();
    }

    $order = $this->order->getById($orderId);
    
    if ($order === false) {
        $_SESSION['error'] = "Database error occurred";
        header("Location: index.php?controller=order&action=index");
        exit();
    }
    
    if (empty($order)) {
        $_SESSION['error'] = "Order not found";
        header("Location: index.php?controller=order&action=index");
        exit();
    }

    $items = $this->orderItem->getByOrder($orderId);
    
    $view = __DIR__ . '/../view/admin/orders/show.php';
    include __DIR__ . '/../view/admin/layout.php';
}


    public function index() {
        $orders = $this->order->getAll();
        $_SESSION['pending_order_count'] = $this->order->countPendingOrders();
        $view = __DIR__ . '/../view/admin/orders/index.php';
        include __DIR__ . '/../view/admin/layout.php';
    }

public function markAsPaid() {
    if ($_SESSION['user']['role_name'] !== 'admin' && $_SESSION['user']['role_name'] !== 'manager') {
        $_SESSION['error'] = "You don't have permission to perform this action";
        header("Location: index.php?controller=order&action=index");
        exit();
    }

    $orderId = $_POST['order_id'] ?? null;
    
    if (!$orderId || !is_numeric($orderId)) {
        $_SESSION['error'] = "Invalid order ID";
        header("Location: index.php?controller=order&action=index");
        exit();
    }
    
    $success = $this->order->updateStatus($orderId, 'paid');
    
    if ($success) {
        $_SESSION['success'] = "Order #$orderId has been marked as paid";
        $_SESSION['pending_order_count'] = $this->order->countPendingOrders();
    } else {
        $_SESSION['error'] = "Failed to update order status";
    }
    
    header("Location: index.php?controller=order&action=show&id=$orderId");
    exit();
}

}