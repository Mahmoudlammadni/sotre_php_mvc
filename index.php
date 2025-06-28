<?php
require_once 'config/db.php';

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

$controllerFile = "controller/" . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $class = ucfirst($controller) . "Controller";
    $obj = new $class();

    if (method_exists($obj, $action)) {
        $obj->$action();
    } else {
        echo "Action not found.";
    }
} else {
    echo "Controller not found.";
}
