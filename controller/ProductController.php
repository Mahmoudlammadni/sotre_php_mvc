<?php
include  __DIR__ . "/../model/Product.php";
 if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role_name'], ['admin', 'manager'])) {
     echo "Unauthorized access.";
     exit;
 }
class ProductController{
 private  $model;
 public function __construct()
 {
    global $pdo;
    $this->model= new Product($pdo);
 }
 public function index() {
        $products = $this->model->getAll();
        include __DIR__ . '/../view/admin/index.php';
    }

  public function store($data, $file) {
        try {
            if (isset($file['image']) && $file['image']['error'] == 0) {
                $uploadDir = "uploads/";
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $imageName = uniqid() . '_' . basename($file['image']['name']);
                $uploadPath = $uploadDir . $imageName;

                move_uploaded_file($file['image']['tmp_name'], $uploadPath);
            } else {
                throw new Exception("Image upload failed.");
            }

          
            $relativeImagePath = $uploadDir . $imageName;
            $this->model->insertProductWithImage($data, $relativeImagePath);

            echo "Product saved successfully.";
            header("Location: /sotre_php_mvc/index.php?controller=product&action=index");
            exit;


        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
  }}


?>