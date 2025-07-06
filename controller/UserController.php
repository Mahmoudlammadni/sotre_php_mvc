<?php
include __DIR__ . '/../model/User.php';
include __DIR__ . "/../model/Role.php";
class UserController{
    private  $model;
    private $role ;
    public function __construct()
    {
        global $pdo;
        $this->model= new user($pdo);
        $this->role= new Role($pdo);
    }

    public function index(){
        $users=$this->model->all_users();
        include __DIR__ . '/../view/admin/users/index.php';
    }


   public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->model->LogIn($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;

            if ($user['role_name'] === 'admin') {
                header("Location: index.php?controller=product&action=index");
            } elseif ($user['role_name'] === 'client') {
                include __DIR__ . '/../view/client/index.php';
            } else {
                echo "Role not handled.";
            }
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "Invalid request method.";
    }
}

    public function showLogin() {
    include __DIR__ . '/../view/auth/login.php';
}

public function register() {
    include __DIR__ . '/../view/auth/register.php';
}
// public function storeclient() {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $name=$_POST["name"];
//         $email=$_POST['email'];
//         $password=$_POST["password"];
//         $phone=$_POST["phone"];
//         $address=$_POST["address"];
//         $this->model->StoreClient($name,$email,$password,$phone,$address);
//        header("Location: index.php");
//         exit;

//     }
// }
public function create(){
    $roles =$this->role->getRoles();
    include __DIR__ ."/../view/admin/users/store.php";
}

public function store(){
    if($_SERVER["REQUEST_METHOD"]==='POST'){
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $role_id=$_POST["role_id"];
        $this->model->StoreUser($username,$email,$password,$role_id);
                header("Location: index.php?controller=user&action=index");
    }
}
public function edite(){
     if (!isset($_GET['id'])) {
        echo "User ID is missing.";
        return;
    }
    $id = $_GET['id'];
    $roles =$this->role->getRoles();
    $user= $this->model->getUserById($id);
    include __DIR__ . "/../view/admin/users/update.php";
}
public function update(){
  $id = $_GET['id'] ;
    if (!$id) {
        echo "No user ID provided.";
        return;
    }
   $name=$_POST["username"];
   $email=$_POST["email"];
   $password=$_POST["password"];
   $role_id=$_POST["role_id"];
   $this->model->UpdateUser($id,$name,$email,$password,$role_id);
    header("Location: index.php?controller=user&action=index");

}
public function destroy(){
  if(isset($_GET["id"])){
    $id=$_GET["id"];
    $this->model->destroy($id);
    header("Location:index.php?controller=user&action=index");
    exit;
  }else{
    echo "User Id not found";
  }
}
public function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();    
    session_destroy();   
    header("Location: index.php?controller=user&action=showLogin");
    exit;
}

}

