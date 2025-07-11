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
    public function index(){
        $clients=$this->model->all_clients();
        $view = __DIR__ . "/../view/admin/clients/index.php";
        include __DIR__ . "/../view/admin/layout.php";
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

    public function edit(){
        if (!isset($_GET['id'])) {
        echo "User ID is missing.";
        return;
    }
         $id = $_GET['id'];
        $client = $this->model->getClientByUserId($id);
        $view= __DIR__ ."/../view/admin/clients/edite.php";
        include __DIR__ . "/../view/admin/layout.php";

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
        header("Location: index.php?controller=client&action=index");

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
