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

    <main class="container mx-auto px-4 py-8 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-serif font-bold text-gray-800 mb-2">My Profile</h1>
                <p class="text-gray-500">Manage your account details and preferences</p>
            </div>
            
            <div class="bg-white rounded-2xl profile-card overflow-hidden border border-gray-100">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row items-start gap-8 mb-10">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-600 flex items-center justify-center text-6xl shadow-inner">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="absolute -bottom-2 -right-2 bg-white rounded-full p-2 shadow-md border border-gray-100">
                                <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center">
                                    <i class="fas fa-pen text-xs"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($client['username'] ?? '') ?></h2>
                            <p class="text-gray-500 mt-1 flex items-center">
                                <i class="fas fa-envelope mr-2 text-indigo-500"></i>
                                <?= htmlspecialchars($client['email'] ?? '') ?>
                            </p>
                            <?php if (!empty($client['phone'])): ?>
                            <p class="text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-phone-alt mr-2 text-indigo-500"></i>
                                <?= htmlspecialchars($client['phone']) ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border border-gray-100 rounded-xl p-6 bg-gray-50/50">
                            <h3 class="font-semibold text-lg text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-user-circle mr-2 text-indigo-500"></i>
                                Account Details
                            </h3>
                            <div class="space-y-3">
                                <?php if (!empty($client['address'])): ?>
                                <div>
                                    <p class="text-sm text-gray-500">Address</p>
                                    <p class="text-gray-700 mt-1 flex items-start">
                                        <i class="fas fa-map-marker-alt mr-2 mt-1 text-indigo-500"></i>
                                        <?= htmlspecialchars($client['address']) ?>
                                    </p>
                                </div>
                                <?php endif; ?>
                                <div>
                                    <p class="text-sm text-gray-500">Member Since</p>
                                    <p class="text-gray-700 mt-1 flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i>
                                        <?= date('F Y', strtotime($user['created_at'] ?? 'now')) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border border-gray-100 rounded-xl p-6 bg-gray-50/50">
                            <h3 class="font-semibold text-lg text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-cog mr-2 text-indigo-500"></i>
                                Account Actions
                            </h3>
                            <div class="space-y-3">
                              
                                <a href="/sotre_php_mvc/index.php?controller=client&action=edit&id=<?= $client['user_id']?>"  class="block w-full text-center bg-white border border-indigo-100 text-indigo-600 hover:bg-indigo-50 hover:border-indigo-200 px-4 py-3 rounded-lg transition action-btn shadow-sm flex items-center justify-center">
                                    <i class="fas fa-edit mr-2"></i> Edit Profile
                        </a>
                                <a href="index.php?controller=user&action=logout" 
                                   class="block w-full text-center bg-white border border-red-100 text-red-600 hover:bg-red-50 hover:border-red-200 px-4 py-3 rounded-lg transition action-btn shadow-sm flex items-center justify-center">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<div class="mt-12">
    <h2 class="text-2xl font-serif font-bold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-shopping-cart mr-2 text-indigo-500"></i>
        Your Shopping Cart
    </h2>
    
    <?php if (empty($cartItems)): ?>
        <div class="bg-white rounded-xl shadow-md p-8 text-center">
            <i class="fas fa-shopping-cart text-5xl text-gray-300 mb-4"></i>
            <p class="text-gray-600 text-xl">Your cart is empty</p>
            <a href="index.php?controller=home&action=index" class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition">
                Browse Products
            </a>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="divide-y divide-gray-200">
                <?php foreach ($cartItems as $item): ?>
                <div class="p-4 cart-item transition-colors duration-200">
                    <div class="flex flex-col md:flex-row gap-4 items-center">
                        
                        <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                            <?php if (!empty($item['image_path'])): ?>
                                <img src="/sotre_php_mvc/<?= htmlspecialchars($item['image_path']) ?>" 
                                     alt="<?= htmlspecialchars($item['name']) ?>" 
                                     class="max-h-full max-w-full object-contain">
                            <?php else: ?>
                                <div class="text-gray-400">
                                    <i class="fas fa-image fa-2x"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-medium"><?= htmlspecialchars($item['name'] ?? 'No name') ?></h3>
                            <p class="text-gray-600 text-sm"><?= htmlspecialchars($item['description'] ?? '') ?></p>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="text-right">
                                <p class="text-gray-700 font-medium"><?= number_format($item['subtotal'] ?? 0, 2) ?> MAD</p>
                                <p class="text-gray-500 text-sm">
                                    <?= $item['quantity'] ?? 0 ?> x <?= number_format($item['price'] ?? 0, 2) ?> MAD
                                </p>
                            </div>
                           <button onclick="removeFromCart(<?= $item['id'] ?>)" 
                                class="text-red-500 hover:text-red-700 transition-colors">
                                <i class="fas fa-trash-alt"></i>
                                </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="p-6 bg-gray-50">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg font-semibold">Subtotal:</span>
                    <span class="text-xl font-bold"><?= number_format($cartTotal, 2) ?> MAD</span>
                </div>
                <div class="flex flex-col sm:flex-row justify-end gap-3">
                    <a href="index.php?controller=home&action=index" class="px-6 py-2 border border-gray-300 rounded-md text-center hover:bg-gray-100 transition">
                        Continue Shopping
                    </a>
                    <a href="index.php?controller=cart&action=checkout" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition text-center">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6 mt-12">
        <div class="container mx-auto px-4 text-center text-gray-500 text-sm">
            <p>© <?= date('Y') ?> LuxeCart. All rights reserved.</p>
        </div>
    </footer>
    <script src="/sotre_php_mvc/public/javascript/profile.js"></script>
   
</body>
</html>