<?php
class CartController {

    public function add() {
        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
            header("Location: index.php?controller=user&action=showLogin");
            exit;
        }

        $productId = $_GET['id'];
        $quantity = $_GET['quantity'] ?? 1;

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'cart_count' => array_sum($_SESSION['cart'])
            ]);
            exit;
        }

        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
    }
    public function remove() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?controller=user&action=showLogin");
        exit;
    }

    $productId = $_GET['id'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
    }

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
        exit;
    }

    header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php?controller=client&action=profile'));
}

}