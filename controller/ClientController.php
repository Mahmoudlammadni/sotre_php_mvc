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
