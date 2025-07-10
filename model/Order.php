<?php
class Order {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($clientId, $total) {
        $stmt = $this->pdo->prepare("INSERT INTO orders (client_id, user_id, total_amount, status)
                                     VALUES (:client_id, :user_id, :total, 'confirmed')");
        $stmt->execute([
            'client_id' => $clientId,
            'user_id' => $clientId, 
            'total' => $total
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT o.*, c.name AS client_name 
                                    FROM orders o
                                    JOIN clients c ON o.client_id = c.id
                                    ORDER BY o.order_date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}