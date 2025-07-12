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

    public function show($orderId = null) {  
        if (!$orderId) {
            header("Location: index.php?controller=home");
            exit();
        }

        $order = $this->order->getById($orderId);
        $items = $this->orderItem->getByOrder($orderId);
        
        include __DIR__ . '/../view/client/order_confirmation.php';
    }


    public function index() {
        $orders = $this->order->getAll();
        $view = __DIR__ . '/../view/admin/orders/index.php';
        include __DIR__ . '/../view/admin/layout.php';
    }
    

}