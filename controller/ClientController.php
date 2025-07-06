<?php 
include __DIR__ . "/../model/Client.php";
class ClientController{
    private  $model;
  
    public function __construct()
    {
        global $pdo;
        $this->model= new Client($pdo);
    }
    public function index(){
        $clients=$this->model->all_clients();
        include __DIR__ . "/../view/admin/clients/index.php";
    }
    public function edit(){
        if (!isset($_GET['id'])) {
        echo "User ID is missing.";
        return;
    }
         $id = $_GET['id'];
        $client = $this->model->getClientByUserId($id);
        include __DIR__ ."/../view/admin/clients/edite.php";
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
