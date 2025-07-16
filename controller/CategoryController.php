<?php 
include __DIR__ ."/../model/Category.php";
class CategoryController{
private $model ;
 public function __construct()
    {
        global $pdo;
        $this->model= new Category($pdo);
    }
  public function index() {
        $categories = $this->model->getAll();
        
        if ($this->isAjaxRequest()) {
            $searchTerm = $_GET['term'] ?? '';
            if (!empty($searchTerm)) {
                $categories = $this->model->searchCategories($searchTerm);
            }
            header('Content-Type: application/json');
            echo json_encode($categories);
            exit;
        }
        
        $view = __DIR__ . '/../view/admin/category/index.php';
        include __DIR__ . "/../view/admin/layout.php";
    }
    
    private function isAjaxRequest() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
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
    public function edit(){
          if (!isset($_GET['id'])) {
        echo "User ID is missing.";
        return;
        }
        $id = $_GET['id'];
        $cat = $this->model->findOneCategory($id);
       $view= __DIR__ . "/../view/admin/category/edit.php";
        include __DIR__ . "/../view/admin/layout.php";
    }
    public function update(){
        $id=$_GET["id"];
       if (!$id) {
              echo "No category ID provided.";
        return;}
        $name=$_POST['name'];
        $description=$_POST["description"];
        $this->model->UpdateCategory($id,$name,$description);
         header("Location: index.php?controller=category&action=index");

    }
    public function destroy(){
        if(isset($_GET["id"])){
            $id=$_GET["id"];
            $this->model->destroy($id);
            header("Location:index.php?controller=category&action=index");
             exit;
        }else{
            echo "Clinet Id not found";
        }}
    
    
}


