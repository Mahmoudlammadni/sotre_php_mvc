<?php
session_start(); 
require_once 'config/db.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerFile = "controller/" . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $class = ucfirst($controller) . "Controller";
    $obj = new $class();

    if (method_exists($obj, $action)) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (empty($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
                $_SESSION['error'] = "Invalid or expired form token. Please try again.";
                header("Location: index.php");
                exit;
            }
            $obj->$action($_POST, $_FILES);
        } else {
            $obj->$action();
        }
    } else {
        echo "Action not found.";
    }
} else {
    echo "Controller not found.";
}

