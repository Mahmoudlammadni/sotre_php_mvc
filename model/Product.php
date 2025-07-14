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
    public function getById($id) {
    $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
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
    
    public function updateProductWithImage(int $id, array $data, ?string $imagePath = null): bool {
    try {
        $this->pdo->beginTransaction();

        $stmt = $this->pdo->prepare("UPDATE products SET name = :name,
                description = :description,price = :price,quantity = :quantity,category_id = :category_id,
                supplier_id = :supplier_id WHERE id = :id");

        $stmt->execute([
            ':name'        => htmlspecialchars($data['name']),
            ':description' => htmlspecialchars($data['description']),
            ':price'       => $data['price'],
            ':quantity'    => $data['quantity'],
            ':category_id' => $data['category_id'],
            ':supplier_id' => $data['supplier_id'],
            ':id'          => $id
        ]);

        if ($imagePath !== null) {
            $stmt2 = $this->pdo->prepare("UPDATE products_images SET image_path = :image_path WHERE product_id = :product_id");

            $stmt2->execute([':image_path'  => $imagePath,':product_id'  => $id]);
        }

        $this->pdo->commit();
        return true;

    } catch (PDOException $e) {
        $this->pdo->rollBack();
        throw new Exception("DB Error: " . $e->getMessage());
    }
}


    public function destroy($id){
       
        try{
        $this->pdo->beginTransaction();
        $req2= $this->pdo->prepare("DELETE FROM products_images where product_id=:id ");
        $req2->execute([":id"=>$id]);
        $req = $this->pdo->prepare("DELETE FROM products where id = :id");
        $req->execute([":id"=>$id]);
        $this->pdo->commit();
        }
        catch(PDOException $e){
        $this->pdo->rollBack();
        echo "Failed :".$e->getMessage();
        }
    }
 public function searchProducts($searchTerm) {
    $stmt = $this->pdo->prepare("SELECT p.*, c.name as category_name FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.name LIKE :search
        OR p.description LIKE :search
        OR c.name LIKE :search
    ");
    $stmt->execute(['search' => "%$searchTerm%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
