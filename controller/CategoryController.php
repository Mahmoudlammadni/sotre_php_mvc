<?php 
include __DIR__ ."/../model/Category.php";
class CategoryController{
private $model ;
 public function __construct()
    {
        global $pdo;
        $this->model= new Category($pdo);
    }
    public function index (){
        $category = $this->model->getAll();
        $view= __DIR__ . "/../view/admin/category/index.php";
        include __DIR__ . "/../view/admin/layout.php";
    }
    public function create(){
       $view= __DIR__ . "/../view/admin/category/store.php";
    include __DIR__ . "/../view/admin/layout.php";

    }
    public function store(){
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $name=$_POST["name"];
            $description=$_POST["description"];
        }
        $this->model->StoreCategory($name,$description);
        header("Location: index.php?controller=category&action=index");
         exit;
        
    }
    
}