<?php
include __DIR__ . '/../model/User.php';
class UserController{
    private  $model;
    public function __construct()
    {
        global $pdo;
        $this->model= new user($pdo);
    }

    public function index(){
        $users=$this->model->all_users();
        include __DIR__ . '/../view/users/index.php';
    }


   public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->model->LogIn($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;

            if ($user['role_name'] === 'admin') {
                include __DIR__ . '/../view/admin/index.php';
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

