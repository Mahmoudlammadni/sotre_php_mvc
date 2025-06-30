<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <link rel="stylesheet" href="/sotre_php_mvc/public/css/home.css">
</head>
<body>
<a href="/sotre_php_mvc/view/products/store.php">add</a>
    <div class="app-container">
        <header class="app-header">
            <h1 class="app-title">Our Store</h1>
            <p class="app-subtitle">Quality products for everyone</p>
        </header>

        <main class="product-showcase">
            <h2 class="section-title">Featured Products</h2>
            
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
             <article class="product-item">
    <img src="/sotre_php_mvc/<?= htmlspecialchars($product['image_path']) ?>" alt="Product Image" width="150">

    <h3 class="product-name"><?= htmlspecialchars($product['name']) ?></h3>
    <p class="product-description"><?= htmlspecialchars($product['description']) ?></p>
    <div class="product-meta">
        <span class="product-price"><?= htmlspecialchars($product['price']) ?> MAD</span>
        <span class="product-stock"><?= htmlspecialchars($product['quantity']) ?> in stock</span>
    </div>
</article>

                <?php endforeach; ?>
            </div>
        </main>

        <nav class="user-actions">
            <a href="index.php?controller=user&action=showLogin" class="action-button login-button">Sign In</a>
            <a href="index.php?controller=user&action=register" class="action-button register-button">Create Account</a>
        </nav>
    </div>
</body>
</html>