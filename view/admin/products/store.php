<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Product</title>
  <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css" />
</head>
<body>
  <h2 style="text-align: center;">Store Product</h2>

  <form class="form-container" method="POST" action="/sotre_php_mvc/index.php?controller=product&action=store" enctype="multipart/form-data">
    
    <input class="input-field" type="text" name="name" placeholder="Product Name" required />

    <textarea class="input-field" name="description" placeholder="Description" required></textarea>

    <input class="input-field" type="number" name="price" placeholder="Price" step="0.01" required />

    <input class="input-field" type="number" name="quantity" placeholder="Quantity" required />

    <select class="input-field" name="category_id" required>
      <?php foreach ($categories as $category): ?>
        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
      <?php endforeach; ?>
    </select>

    <select class="input-field" name="supplier_id" required>
      <?php foreach ($suppliers as $supplier): ?>
        <option value="<?= $supplier['id'] ?>"><?= htmlspecialchars($supplier['name']) ?></option>
      <?php endforeach; ?>
    </select>

    <input class="input-field" type="file" name="image" accept="image/*" required />

    <button class="action-button" type="submit">Add Product</button>
    
  </form>
</body>
</html>
