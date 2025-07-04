<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
     <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css">
</head>
<body>

<h2 style="text-align: center;">Edit Product</h2>

<form action="index.php?controller=product&action=update&id=<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
    <label for="name">Product Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <label for="description">Description:</label>
    <textarea name="description" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>

    <label for="price">Price (MAD):</label>
    <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" value="<?= htmlspecialchars($product['quantity']) ?>" required>

    <label for="category_id">Category:</label>
    <select name="category_id" required>
        <option value="">-- Select Category --</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="supplier_id">Supplier:</label>
    <select name="supplier_id" required>
        <option value="">-- Select Supplier --</option>
        <?php foreach ($suppliers as $supplier): ?>
            <option value="<?= $supplier['id'] ?>" <?= ($supplier['id'] == $product['supplier_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($supplier['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="image">Current Image:</label><br>
    <img src="/sotre_php_mvc/<?= htmlspecialchars($product['image_path'] ?? '') ?>" alt="Product Image"><br>

    <label for="image">Change Image:</label>
    <input type="file" name="image">

    <button type="submit">Update Product</button>
</form>

</body>
</html>
