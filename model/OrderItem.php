<?php
class OrderItem{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($orderId, $productId, $quantity, $unitPrice) {
        $stmt = $this->pdo->prepare(" INSERT INTO order_items 
                                     (order_id, product_id, quantity, unit_price, subtotal)
                                     VALUES (:order_id, :product_id, :quantity, :unit_price, :subtotal)");
        $subtotal = $quantity * $unitPrice;
        $stmt->execute([
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $subtotal
        ]);
    }

    public function getByOrder($orderId) {
        $stmt = $this->pdo->prepare("SELECT oi.*, p.name AS product_name 
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}