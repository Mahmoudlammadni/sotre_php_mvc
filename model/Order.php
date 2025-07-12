<?php
class Order {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($clientId, $userId, $total) {
        $stmt = $this->pdo->prepare("INSERT INTO orders (client_id, user_id, total_amount, status)
                                     VALUES (:client_id, :user_id, :total, 'pending')"); 
        $stmt->execute([
            'client_id' => $clientId,
            'user_id' => $userId, 
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

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT o.*, c.name AS client_name 
                                    FROM orders o
                                    JOIN clients c ON o.client_id = c.id
                                    WHERE o.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUserId($userId) {
    $stmt = $this->pdo->prepare("SELECT o.*, c.name AS client_name 
                                FROM orders o
                                JOIN clients c ON o.client_id = c.id
                                WHERE o.user_id = :user_id
                                ORDER BY o.order_date DESC");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}