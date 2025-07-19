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

public function index() {
    $users = $this->model->all_users();
    
    if ($this->isAjaxRequest()) {
        $searchTerm = $_GET['term'] ?? '';
        if (!empty($searchTerm)) {
            $users = $this->model->searchUsers($searchTerm);
        }
        header('Content-Type: application/json');
        echo json_encode($users);
        exit;
    }
    
    $view = __DIR__ . '/../view/admin/users/index.php';
    include __DIR__ . "/../view/admin/layout.php";
}

private function isAjaxRequest() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}


 public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->model->LogIn($email, $password);

        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role_name' => $user['role_name'],
                'created_at' => $user['created_at'] ?? date('Y-m-d H:i:s') 
            ];

            if ($user['role_name'] === 'admin' || $user['role_name'] === 'manager') {
                header("Location: index.php?controller=product&action=index");
            } else {
                header("Location: index.php?controller=home&action=index");
            }
            exit;
        } else {
            echo "Invalid credentials.";
        }
    }
}

    public function showLogin() {
    include __DIR__ . '/../view/auth/login.php';
}

public function register() {
    include __DIR__ . '/../view/auth/register.php';
}
public function create(){
    $roles =$this->role->getRoles();
    $view=__DIR__ ."/../view/admin/users/store.php";
    include __DIR__ . "/../view/admin/layout.php";
    

}


public function store(){
    if($_SERVER["REQUEST_METHOD"]==='POST'){
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $role_id=$_POST["role_id"];
        $this->model->StoreUser($username,$email,$password,$role_id);
                header("Location: index.php?controller=client&action=index");
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
    $view= __DIR__ . "/../view/admin/users/update.php";
    include __DIR__ . "/../view/admin/layout.php";

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
public function profile() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?controller=user&action=showLogin");
        exit;
    }
    
    $userData = $this->model->getUserById($_SESSION['user']['id']);
    
    if ($_SESSION['user']['role_name'] === 'admin' || $_SESSION['user']['role_name'] === 'manager') {
        $view = __DIR__ . '/../view/admin/profile/profile.php';
        include __DIR__ . "/../view/admin/layout.php";
    } else {
        header("Location: index.php?controller=client&action=profile");
        exit;
    }
}

public function editProfile() {
    if (!isset($_GET['id'])) {
        echo "User ID is missing.";
        return;
    }

    $id = $_GET['id'];
    $userData = $this->model->getUserById($id);
    
    if ($_SESSION['user']['id'] != $id && $_SESSION['user']['role_name'] !== 'admin') {
        echo "You don't have permission to edit this profile.";
        return;
    }
    
    $roles = $this->role->getRoles();
    
    $view = __DIR__ . '/../view/admin/profile/edit_profile.php';
    include __DIR__ . "/../view/admin/layout.php";
}

}

