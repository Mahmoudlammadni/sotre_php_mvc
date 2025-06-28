<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>the first page </p>
    <h2>Our Products</h2>
<?php foreach ($products as $product): ?>
    <div>
        <h3><?= htmlspecialchars($product['name']) ?></h3>
        <p><?= htmlspecialchars($product['description']) ?></p>
        <strong><?= htmlspecialchars($product['price']) ?> MAD</strong>
    </div>
<?php endforeach; ?>

<a href="index.php?controller=user&action=showLogin">Login</a>
<a href="index.php?controller=user&action=register">Register</a>

</body>
</html>