<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/sotre_php_mvc/index.php?controller=product&action=store" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Product Name" required><br>
  <textarea name="description" placeholder="Description" required></textarea><br>
  <input type="number" name="price" placeholder="Price" step="0.01" required><br>
  <input type="number" name="quantity" placeholder="Quantity" required><br>
    category : <select name="category_id" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
        <?php endforeach; ?>
    </select><br>
 
 supplier: <select name="supplier_id" required>
        <?php foreach ($suppliers as $supplier): ?>
            <option value="<?= $supplier['id'] ?>"><?= htmlspecialchars($supplier['name']) ?></option>
        <?php endforeach; ?>
    </select> <br>
     <input type="file" name="image" accept="image/*" required><br>
  <button type="submit">Add Product</button>
</form>

    
</body>
</html>