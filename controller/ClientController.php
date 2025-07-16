<?php 
include __DIR__ . "/../model/Client.php";
include __DIR__ . "/../model/Product.php";
class ClientController{
    private  $model;
    private $productModel;
  
    public function __construct()
    {
        global $pdo;
        $this->model= new Client($pdo);
        $this->productModel = new Product($pdo); 
    }
    // In ClientController.php
public function index() {
    $clients = $this->model->all_clients();
    
    if ($this->isAjaxRequest()) {
        $searchTerm = $_GET['term'] ?? '';
        if (!empty($searchTerm)) {
            $clients = $this->model->searchClients($searchTerm);
        }
        header('Content-Type: application/json');
        echo json_encode($clients);
        exit;
    }
    
    $view = __DIR__ . '/../view/admin/clients/index.php';
    include __DIR__ . "/../view/admin/layout.php";
}

private function isAjaxRequest() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
    public function create(){
        $view= __DIR__ . "/../view/admin/clients/store.php";
        include __DIR__ . "/../view/admin/layout.php";

    }

 public function store() {
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $name=$_POST["name"];
         $email=$_POST['email'];
         $password=$_POST["password"];
         $phone=$_POST["phone"];
         $address=$_POST["address"];
         $this->model->StoreClient($name,$email,$password,$phone,$address);
        header("Location: index.php?controller=client&action=index");
         exit;
     }
 }

   public function edit() {
    if (!isset($_GET['id'])) {
        echo "User ID is missing.";
        return;
    }

    $id = $_GET['id'];
    $client = $this->model->getClientByUserId($id);

    $role = $_SESSION['user']['role_name'] ?? '';

    if ($role === 'admin') {
        $view = __DIR__ . "/../view/admin/clients/edite.php";
        include __DIR__ . "/../view/admin/layout.php";
    } else {
        $clientData = $client;
        include __DIR__ . "/../view/client/edite.php";
       
        
    }
}


    public function update(){
        $id = $_GET['id'] ;
        if (!$id) {
              echo "No client ID provided.";
        return;}
        $name = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $this->model->UpdateClient($id,$name,$email,$password,$phone,$address);
        $role = $_SESSION['user']['role_name'] ?? '';
         if ($role === 'admin') {
             header("Location: index.php?controller=client&action=index");
         } else {
             header("Location: index.php?controller=client&action=profile&id=$id");
         }
    

    }
    
 public function profile() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=user&action=showLogin");
            exit;
        }
        
        $clientData = $this->model->getClientByUserId($_SESSION['user']['id']);
        
        $cartItems = [];
        $cartTotal = 0;
        
       if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = $this->productModel->getById($productId);
            if ($product) {
                if (!empty($product['image_path']) && strpos($product['image_path'], '/') !== 0) {
                    $product['image_path'] = '/' . ltrim($product['image_path'], '/');
                }
                $product['quantity'] = $quantity;
                $product['subtotal'] = $product['price'] * $quantity;
                $cartItems[] = $product;
                $cartTotal += $product['subtotal'];
            }
        }
    }
        
        include __DIR__ . '/../view/client/profile.php';
    }

    
    public function destroy(){
        if(isset($_GET["id"])){
            $id=$_GET["id"];
            $this->model->destroy($id);
            header("Location:index.php?controller=client&action=index");
             exit;
        }else{
            echo "Clinet Id not found";
        }}
    }
