<?php
class Product {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query(" SELECT p.*, pi.image_path
        FROM products p
        LEFT JOIN products_images pi ON p.id = pi.product_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
      public function insertProductWithImage($data, $imagePath) {
        try {
            $this->pdo->beginTransaction();

            $stmt1 = $this->pdo->prepare("
                INSERT INTO products (name, description, price, quantity, category_id, supplier_id, created_at)
                VALUES (:name, :description, :price, :quantity, :category_id, :supplier_id, :created_at)
            ");

            $stmt1->execute([
                ':name' => $data['name'],
                ':description' => $data['description'],
                ':price' => $data['price'],
                ':quantity' => $data['quantity'],
                ':category_id' => $data['category_id'],
                ':supplier_id' => $data['supplier_id'],
                ':created_at' => date('Y-m-d H:i:s')
            ]);

            $product_id = $this->pdo->lastInsertId();

            $stmt2 = $this->pdo->prepare("
                INSERT INTO products_images (product_id, image_path)
                VALUES (:product_id, :image_url)
            ");
            $stmt2->execute([
                ':product_id' => $product_id,
                ':image_url' => $imagePath
            ]);

            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            throw new Exception("DB Error: " . $e->getMessage());
        }
    }
}
