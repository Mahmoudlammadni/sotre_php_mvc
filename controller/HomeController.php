<?php
require_once __DIR__ . '/../model/Product.php';

class HomeController {
    public function index() {
        global $pdo;
        $productModel = new Product($pdo);
        $products = $productModel->getAll();

        include __DIR__ . '/../view/home/index.php';
    }
}
