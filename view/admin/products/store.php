<!DOCTYPE html>
<html lang="en" class="h-full bg-white dark:bg-dark-900">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Product</title>
  <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #ffffff;
      color: #111827;
    }
    
    .dark body {
      background-color: #0f172a;
      color: #f3f4f6;
    }
    
    .form-container {
      background-color: #ffffff;
      border-color: #e5e7eb;
    }
    
    .dark .form-container {
      background-color: #1e293b;
      border-color: #334155;
    }
    
    .input-field {
      background-color: #ffffff;
      border-color: #d1d5db;
      color: #111827;
    }
    
    .dark .input-field {
      background-color: #1e293b;
      border-color: #334155;
      color: #f3f4f6;
    }
    
    .input-field::placeholder {
      color: #9ca3af;
    }
    
    .dark .input-field::placeholder {
      color: #6b7280;
    }
    
    .action-button {
      background-color: #4f46e5;
      color: #ffffff;
    }
    
    .dark .action-button {
      background-color: #6366f1;
      color: #ffffff;
    }
    
    .action-button:hover {
      background-color: #4338ca;
    }
    
    .dark .action-button:hover {
      background-color: #4f46e5;
    }
    
    h2 {
      color: #111827;
    }
    
    .dark h2 {
      color: #f3f4f6;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">
  <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Add New Product</h2>

  <form class="form-container w-full max-w-md p-6 rounded-lg shadow-md border dark:border-gray-700" method="POST" action="/sotre_php_mvc/index.php?controller=product&action=store" enctype="multipart/form-data">
    
    <div class="mb-4">
      <input class="input-field w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
             type="text" name="name" id="name" placeholder="Product Name" required />
    </div>

    <div class="mb-4">
      <textarea class="input-field w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
                name="description" id="description" placeholder="Description" required></textarea>
    </div>

    <div class="mb-4">
      <input class="input-field w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
             type="number" name="price" id="price" placeholder="Price" step="0.01" required />
    </div>

    <div class="mb-4">
      <input class="input-field w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
             type="number" name="quantity" id="quantity" placeholder="Quantity" required />
    </div>

    <div class="mb-4">
      <select class="input-field w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
              name="category_id" id="category_id" required>
        <?php foreach ($categories as $category): ?>
          <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-4">
      <select class="input-field w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
              name="supplier_id" id="supplier_id" required>
        <?php foreach ($suppliers as $supplier): ?>
          <option value="<?= $supplier['id'] ?>"><?= htmlspecialchars($supplier['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-6">
      <input class="input-field w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-primary-900/30 dark:file:text-primary-300" 
             type="file" name="image" id="image" accept="image/*" required />
    </div>

    <button class="action-button w-full py-2 px-4 rounded-md font-medium transition-colors duration-200" type="submit">
      Add Product
    </button>
    
  </form>
</body>
</html>