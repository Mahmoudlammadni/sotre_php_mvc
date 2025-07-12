<?php 
$client = $clientData ?? [];
$user = $_SESSION['user'] ?? [];

$cartItems = [];
$cartTotal = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $product = $this->productModel->getById($productId);
        if ($product) {
            $product['quantity'] = $quantity;
            $product['subtotal'] = $product['price'] * $quantity;
            $cartItems[] = $product;
            $cartTotal += $product['subtotal'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | LuxeCart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-card {
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .profile-card:hover {
            box-shadow: 0 15px 40px -10px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        .action-btn:hover {
            transform: translateY(-1px);
        }
        .home-btn:hover {
            transform: scale(1.05);
        }
        .cart-item:hover {
            background-color: rgba(249, 250, 251, 0.8);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans antialiased">
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-sm shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="index.php?controller=home&action=index" class="home-btn transition-transform duration-200 text-gray-600 hover:text-indigo-600">
                        <i class="fas fa-home text-xl"></i>
                    </a>
                    
                    <div class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <div>
                            <h1 class="text-xl font-bold text-gray-800">LuxeCart</h1>
                            <p class="text-xs text-gray-500">Premium quality for everyone</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="index.php?controller=cart&action=view" class="relative text-gray-600 hover:text-indigo-600">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <?php if (!empty($cartItems)): ?>
                            <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                <?= array_sum(array_column($cartItems, 'quantity')) ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    
                    <?php if (isset($_SESSION['user'])): ?>
                        <div class="relative group">
                            <button class="flex items-center space-x-1 focus:outline-none">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white flex items-center justify-center shadow-md">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <span class="hidden sm:inline-block font-medium text-gray-700"><?= htmlspecialchars($user['username']) ?></span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6 profile-card">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Update</h2>
            <form action="/sotre_php_mvc/index.php?controller=client&action=update&id=<?= $client['user_id'] ?>" method="post">
                <div class="mb-4">
                    <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" 
                           type="text" placeholder="Name" name="username" value="<?= htmlspecialchars($client['username']) ?>" required>
                </div>
                <div class="mb-4">
                    <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" 
                           type="text" placeholder="Email" name="email" value="<?= htmlspecialchars($client['email']) ?>"required>
                </div>
                <div class="mb-4">
                    <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" 
                           type="text" placeholder="Password" name="password" value="<?= htmlspecialchars($client['password']) ?>" required>
                </div>
                <div class="mb-4">
                    <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" 
                           type="text" placeholder="Phone" name="phone" value="<?= htmlspecialchars($client['phone']) ?>" required>
                </div>
                <div class="mb-6">
                    <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" 
                           type="text" placeholder="Address"  name="address" value="<?= htmlspecialchars($clientData['address']) ?>"  required>
                </div>
                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 transform hover:-translate-y-1" 
                        type="submit">Update </button>
            </form>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 mt-12">
        <div class="container mx-auto px-4 text-center text-gray-500 text-sm">
            <p>© <?= date('Y') ?> LuxeCart. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>