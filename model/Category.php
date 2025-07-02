<?php 
class Category {
    private $pdo ; 
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
     public function getAll() {
        $stmt = $this->pdo->query(" SELECT * from categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}