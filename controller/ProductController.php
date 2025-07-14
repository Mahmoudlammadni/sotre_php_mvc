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
public function search() {
    if (!$this->isAjaxRequest()) {
        header("Location: index.php?controller=product&action=index");
        exit;
    }

    $searchTerm = $_GET['term'] ?? '';
    $products = [];
    
    if (!empty($searchTerm)) {
        $products = $this->model->searchProducts($searchTerm);
    } else {
        $products = $this->model->getAll();
    }
    
    header('Content-Type: application/json');
    echo json_encode($products);
    exit;
}


public function index() {
    $products = $this->model->getAll(); 
    
    
    if ($this->isAjaxRequest()) {
        $searchTerm = $_GET['search'] ?? '';
        if (!empty($searchTerm)) {
            $products = $this->model->searchProducts($searchTerm);
        }
        include __DIR__ . '/../view/admin/products/partials/products_table.php';
        exit;
    }
    
    $view = __DIR__ . '/../view/admin/products/index.php';
    include __DIR__ . '/../view/admin/layout.php';
}

private function isAjaxRequest() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
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
       
     $view = __DIR__ . '/../view/admin/products/store.php';
      include __DIR__ . "/../view/admin/layout.php";
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

   $view= __DIR__ . '/../view/admin/products/update.php';
    include __DIR__ . "/../view/admin/layout.php";

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