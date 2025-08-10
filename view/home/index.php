<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeCart | Premium Online Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">     
    <style type="text/css">
        
        .hero-gradient {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.95) 0%, rgba(124, 58, 237, 0.95) 100%);
        }
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        .scroll-down {
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-10px);}
            60% {transform: translateY(-5px);}
        }
        
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                    <div>
                        <h1 class="text-xl font-bold text-dark">LuxeCart</h1>
                        <p class="text-xs text-gray-500">Premium quality for everyone</p>
                    </div>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-700 hover:text-primary transition">Home</a>
                    <a href="#" class="text-gray-700 hover:text-primary transition">Products</a>
                    <a href="#" class="text-gray-700 hover:text-primary transition">Collections</a>
                    <a href="#" class="text-gray-700 hover:text-primary transition">About</a>
                </nav>

                   <div class="flex items-center space-x-4">
    <?php if (isset($_SESSION['user'])): ?>
        <div class="flex items-center space-x-2">
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="setTimeout(() => open = false, 200)" @click.away="open = false">
                <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                    <span class="hidden sm:inline-block font-medium"><?= htmlspecialchars($_SESSION['user']['username']) ?></span>
                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'transform rotate-180': open}"></i>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <a href="index.php?controller=client&action=profile" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">My Profile</a>                    <a href="index.php?controller=user&action=logout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900">Logout</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <a href="index.php?controller=user&action=showLogin" class="text-gray-700 hover:text-primary transition hidden sm:inline-block">
            <i class="fas fa-user mr-1"></i> Sign In
        </a>
        <a href="index.php?controller=user&action=register" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition shadow-sm hidden sm:inline-block">
            Register
        </a>
    <?php endif; ?>
    <button class="md:hidden text-gray-700">
        <i class="fas fa-bars"></i>
    </button>
</div>

                </div>
            </div>
        </div>
    </header>

    <section class="relative hero-gradient text-white">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="container mx-auto px-4 py-24 md:py-32 relative z-10">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-serif font-bold mb-4">Elevate Your Shopping Experience</h2>
                <p class="text-xl md:text-2xl mb-8 opacity-90">Discover premium products curated for quality and style</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#" class="bg-white text-primary hover:bg-gray-100 px-8 py-3 rounded-md font-medium transition shadow-lg">
                        Shop Now
                    </a>
                    <a href="#" class="border-2 border-white text-white hover:bg-white hover:bg-opacity-10 px-8 py-3 rounded-md font-medium transition">
                        View Collections
                    </a>
                </div>
            </div>
            <a href="#featured" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 scroll-down text-white text-2xl">
                <i class="fas fa-chevron-down"></i>
            </a>
        </div>
    </section>

    <section id="featured" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-serif font-bold text-dark mb-2">Featured Products</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Our most popular items loved by customers worldwide</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <?php foreach ($products as $product): ?>
                <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative overflow-hidden">
                        <div class="product-image h-64 bg-gray-100 flex items-center justify-center p-4 transition duration-500">
                            <img src="/sotre_php_mvc/<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="absolute top-3 left-3 bg-accent text-white text-xs font-bold px-3 py-1 rounded-full">
                            Bestseller
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-5 transition duration-300"></div>
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-dark mb-1"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="text-gray-600 text-sm mb-3"><?= htmlspecialchars($product['description']) ?></p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-primary font-bold text-lg"><?= htmlspecialchars($product['price']) ?> MAD</span>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                <?= htmlspecialchars($product['quantity']) ?> in stock
                            </span>
                        </div>
                      <button onclick="addToCart(<?= $product['id'] ?>)" 
        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-md transition flex items-center justify-center gap-2">
    <i class="fas fa-shopping-cart"></i> Add to Cart
</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-block border-2 border-primary text-primary hover:bg-primary hover:text-white px-8 py-3 rounded-md font-medium transition">
                    View All Products
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-serif font-bold text-dark mb-2">What Our Customers Say</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Trusted by thousands of happy customers worldwide</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-sm text-gray-500">2 days ago</span>
                    </div>
                    <p class="text-gray-700 mb-4">"The quality of products exceeded my expectations. Shipping was fast and packaging was premium."</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gray-300 mr-3"></div>
                        <div>
                            <h4 class="font-medium">Sarah Johnson</h4>
                            <p class="text-sm text-gray-500">Verified Buyer</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-sm text-gray-500">1 week ago</span>
                    </div>
                    <p class="text-gray-700 mb-4">"Excellent customer service! They helped me choose the perfect product for my needs."</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gray-300 mr-3"></div>
                        <div>
                            <h4 class="font-medium">Michael Chen</h4>
                            <p class="text-sm text-gray-500">Verified Buyer</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-sm text-gray-500">3 weeks ago</span>
                    </div>
                    <p class="text-gray-700 mb-4">"I've ordered multiple times and never been disappointed. Highly recommend this store!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-gray-300 mr-3"></div>
                        <div>
                            <h4 class="font-medium">Emma Rodriguez</h4>
                            <p class="text-sm text-gray-500">Verified Buyer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-white border-t border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-3xl text-primary mr-3"></i>
                    <div>
                        <h4 class="font-medium">Secure Payments</h4>
                        <p class="text-sm text-gray-500">SSL Encryption</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-truck text-3xl text-primary mr-3"></i>
                    <div>
                        <h4 class="font-medium">Fast Shipping</h4>
                        <p class="text-sm text-gray-500">Worldwide Delivery</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-undo text-3xl text-primary mr-3"></i>
                    <div>
                        <h4 class="font-medium">Easy Returns</h4>
                        <p class="text-sm text-gray-500">30-Day Policy</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-headset text-3xl text-primary mr-3"></i>
                    <div>
                        <h4 class="font-medium">24/7 Support</h4>
                        <p class="text-sm text-gray-500">Dedicated Team</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-serif font-bold mb-4">Join Our Community</h2>
                <p class="text-lg opacity-90 mb-8">Subscribe to get exclusive offers, product updates, and insider deals</p>
                <form class="flex flex-col sm:flex-row gap-2 max-w-md mx-auto">
                    <input type="email" placeholder="Your email address" class="flex-grow px-4 py-3 rounded-md text-gray-900 focus:outline-none focus:ring-2 focus:ring-accent">
                    <button type="submit" class="bg-accent hover:bg-pink-600 px-6 py-3 rounded-md font-medium transition shadow-sm">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-gray-300 pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-white">LuxeCart</h3>
                    </div>
                    <p class="mb-4">Premium quality products for everyone. We're committed to excellence in every detail.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-medium mb-4">Shop</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">All Products</a></li>
                        <li><a href="#" class="hover:text-white transition">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-white transition">Featured</a></li>
                        <li><a href="#" class="hover:text-white transition">Bestsellers</a></li>
                        <li><a href="#" class="hover:text-white transition">Special Offers</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-medium mb-4">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Our Story</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition">Press</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-medium mb-4">Help</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                                                <li><a href="#" class="hover:text-white transition">Shipping & Returns</a></li>
                        <li><a href="#" class="hover:text-white transition">Track Order</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm mb-4 md:mb-0">© 2023 LuxeCart. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-sm hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="text-sm hover:text-white transition">Terms of Service</a>
                    <a href="#" class="text-sm hover:text-white transition">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <button id="backToTop" class="fixed bottom-8 right-8 bg-primary text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition opacity-0 invisible hover:bg-primary-dark">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="/sotre_php_mvc/public/javascript/home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
function addToCart(productId) {
    fetch(`index.php?controller=cart&action=add&id=${productId}`)
        .then(response => {
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                const current = parseInt(cartCount.textContent) || 0;
                cartCount.textContent = current + 1;
            }
        });
}
</script>
</body>
</html>
