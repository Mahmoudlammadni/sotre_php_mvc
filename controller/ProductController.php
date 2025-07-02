<?php
include  __DIR__ . "/../model/Product.php";
include  __DIR__ . "/../model/Category.php";
include  __DIR__ . "/../model/Supplier.php";
 if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role_name'], ['admin', 'manager'])) {
     echo "Unauthorized access.";
     exit;
 }
class ProductController{
 private  $model;
 private  $cate;
 private  $supp;
 public function __construct()
 {
    global $pdo;
    $this->model= new Product($pdo);
    $this->cate=new Category($pdo);
    $this->supp=new Supplier($pdo);
 }
 public function index() {
        $products = $this->model->getAll();
        include __DIR__ . '/../view/admin/index.php';
    }

   public function destroy() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $this->model->destroy($id);
        header("Location: index.php?controller=product&action=index");
        exit;
    } else {
        echo "Product ID not provided.";
    }
}
public function create() {
   
    $categories = $this->cate->getAll();
    $suppliers = $this->supp->getAll();

    include __DIR__ . '/../view/products/store.php';
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
  }

  public function edite() {
    if (!isset($_GET['id'])) {
        echo "Product ID is missing.";
        return;
    }

    $id = $_GET['id'];
    $product = $this->model->getById($id);
    $categories = $this->cate->getAll();
    $suppliers = $this->supp->getAll();

    include __DIR__ . '/../view/products/update.php';
}

public function update($data, $file) {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo "No product ID provided.";
        return;
    }

    try {
        if (isset($file['image']) && $file['image']['error'] == 0) {
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $imageName = uniqid() . '_' . basename($file['image']['name']);
            $uploadPath = $uploadDir . $imageName;

            move_uploaded_file($file['image']['tmp_name'], $uploadPath);
            $imagePath = $uploadPath;
        } else {
            $imagePath = null;
        }

        $this->model->updateProductWithImage($id, $data, $imagePath);
        echo "Product updated successfully.";
        header("Location: /sotre_php_mvc/index.php?controller=product&action=index");
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

}


?>