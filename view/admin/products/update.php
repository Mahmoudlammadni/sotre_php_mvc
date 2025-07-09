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

<form class="form-container" action="index.php?controller=product&action=update&id=<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
    <input   class="input-field"  type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <textarea  class="input-field"  name="description" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>

    <input  class="input-field"  type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

    <input  class="input-field"  type="number" name="quantity" value="<?= htmlspecialchars($product['quantity']) ?>" required>

    <select  class="input-field"  name="category_id" required>
        <option value="">-- Select Category --</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($category['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select  class="input-field"  name="supplier_id" required>
        <option value="">-- Select Supplier --</option>
        <?php foreach ($suppliers as $supplier): ?>
            <option value="<?= $supplier['id'] ?>" <?= ($supplier['id'] == $product['supplier_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($supplier['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    

    <input  class="input-field"  type="file" name="image">

    <button class="action-button" type="submit">Update Product</button>
</form>

</body>
</html>
