<?php
include __DIR__ . '/../model/Settings.php';

class SettingsController {
    private $model;
    
    public function __construct() {
        global $pdo;
        $this->model = new Settings($pdo);
    }

    public function index() {
        if ($_SESSION['user']['role_name'] !== 'admin') {
            header("Location: index.php?controller=product&action=index");
            exit;
        }

        $settings = $this->model->getAllSettings();
        $view = __DIR__ . '/../view/admin/settings/index.php';
        include __DIR__ . "/../view/admin/layout.php";
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['user']['role_name'] === 'admin') {
            $userId = $_SESSION['user']['id'];
            
            foreach ($_POST['settings'] as $key => $value) {
                $this->model->updateSetting($key, $value, $userId);
            }
            
            $_SESSION['success_message'] = "Settings updated successfully!";
            header("Location: index.php?controller=settings&action=index");
            exit;
        }
    }
}