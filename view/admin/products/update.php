<!DOCTYPE html>
<html lang="en" class="h-full bg-white dark:bg-dark-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="/sotre_php_mvc/public/css/form.css">
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
        
        select option {
            background-color: white;
            color: black;
        }
        
        .dark select option {
            background-color: #1e293b;
            color: white;
        }
        
        .form-columns {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .form-column {
            flex: 1;
            min-width: 0;
        }
        
        .file-input-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">
    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Edit Product</h2>

    <form class="form-container w-full max-w-6xl p-8 rounded-lg shadow-md border dark:border-gray-700" 
          action="index.php?controller=product&action=update&id=<?= $product['id'] ?>" 
          method="post" 
          enctype="multipart/form-data">
        
        <div class="form-columns">
            <div class="form-column space-y-4">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2" for="name">Product Name</label>
                    <input class="input-field w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
                           type="text" 
                           name="name" 
                           id="name" 
                           value="<?= htmlspecialchars($product['name']) ?>" 
                           required>
                </div>
                
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2" for="price">Price</label>
                    <input class="input-field w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
                           type="number" 
                           name="price" 
                           id="price" 
                           value="<?= htmlspecialchars($product['price']) ?>" 
                           required>
                </div>
                
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2" for="quantity">Quantity</label>
                    <input class="input-field w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
                           type="number" 
                           name="quantity" 
                           id="quantity" 
                           value="<?= htmlspecialchars($product['quantity']) ?>" 
                           required>
                </div>
            </div>
            
            <div class="form-column space-y-4">
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2" for="category_id">Category</label>
                    <select class="input-field w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
                            name="category_id" 
                            id="category_id" 
                            required>
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= ($category['id'] == $product['category_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2" for="supplier_id">Supplier</label>
                    <select class="input-field w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
                            name="supplier_id" 
                            id="supplier_id" 
                            required>
                        <option value="">-- Select Supplier --</option>
                        <?php foreach ($suppliers as $supplier): ?>
                            <option value="<?= $supplier['id'] ?>" <?= ($supplier['id'] == $product['supplier_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($supplier['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2" for="description">Description</label>
                    <textarea class="input-field w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500" 
                              name="description" 
                              id="description" 
                              rows="3" 
                              required><?= htmlspecialchars($product['description']) ?></textarea>
                </div>
            </div>
        </div>
        
        <div class="file-input-container mt-6">
            <div>
                <label class="block text-gray-700 dark:text-gray-300 mb-2" for="image">Product Image</label>
                <input class="input-field w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-primary-900/30 dark:file:text-primary-300" 
                       type="file" 
                       name="image" 
                       id="image" 
                       accept="image/*">
                
                <?php if (!empty($product['image_path'])): ?>
                <div class="mt-3 flex items-center justify-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400 mr-3">Current Image:</span>
                    <img src="/sotre_php_mvc/<?= htmlspecialchars($product['image_path']) ?>" 
                         alt="Current Product Image" 
                         class="h-12 w-12 rounded-lg object-cover border border-gray-200 dark:border-gray-600">
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="mt-8 flex justify-center">
            <button class="action-button px-8 py-3 rounded-md font-medium transition-colors duration-200 text-lg" type="submit">
                Update Product
            </button>
        </div>
    </form>
</body>
</html>