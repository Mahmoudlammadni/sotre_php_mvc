<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Products</title>
    <link rel="stylesheet" href="/sotre_php_mvc/public/css/table.css" />
    <style>
        /* Alignment Fixes */
        .user-data-table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
        }
        
        .user-data-table td, 
        .user-data-table th {
            vertical-align: middle;
            line-height: 1.4;
            padding: 12px 8px;
        }
        
        .user-actions-cell {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 0 !important;
            gap: 8px;
        }

        .user-action-btn {
            height: 32px;
            line-height: 30px;
            padding: 0 12px;
            margin: 0 !important;
            transform: none !important;
        }
        
        .product-image-cell {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 8px !important;
        }
        
        .user-data-table img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            display: block;
        }

        /* Search loading indicator */
        #searchLoading {
            display: none;
        }
        
        #searchLoading.visible {
            display: flex;
        }

        /* No results row */
        .no-results {
            text-align: center;
            padding: 20px !important;
        }
    </style>
</head>
<body>
    <div class="mb-6">
        <div class="relative max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class='bx bx-search text-gray-400'></i>
            </div>
            <input type="text" id="productSearch" 
                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                   placeholder="Search products...">
            <div id="searchLoading" class="absolute inset-y-0 right-0 flex items-center pr-3">
                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-primary-600"></div>
            </div>
        </div>
    </div>

    <div class="user-table-container">
        <table class="user-data-table">
            <thead>
                <tr>
                    <th style="width: 10%">Image</th>
                    <th style="width: 20%">Name</th>
                    <th style="width: 35%">Description</th>
                    <th style="width: 10%">Price</th>
                    <th style="width: 10%">Quantity</th>
                    <th style="width: 15%">Actions</th>
                </tr>
            </thead>
            <tbody id="productsTableBody">
                <?php foreach ($products as $product): ?>
                <tr>
                    <td class="product-image-cell">
                        <?php if (!empty($product['image_path'])): ?>
                        <img src="/sotre_php_mvc/<?= htmlspecialchars($product['image_path']) ?>" 
                             alt="<?= htmlspecialchars($product['name']) ?>">
                        <?php else: ?>
                        <div class="text-gray-400">No image</div>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['description']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?> MAD</td>
                    <td><?= htmlspecialchars($product['quantity']) ?></td>
                    <td class="user-actions-cell">
                        <a href="/sotre_php_mvc/index.php?controller=product&action=edite&id=<?= $product['id'] ?>">
                            <button class="user-action-btn user-edit-btn">
                                Edit
                            </button>
                        </a>
                        <?php if ($_SESSION['user']['role_name'] === 'admin'): ?>
                        <a href="/sotre_php_mvc/index.php?controller=product&action=destroy&id=<?= $product['id'] ?>" 
                           onclick="return confirm('Are you sure you want to delete this product?');">
                            <button class="user-action-btn user-delete-btn">
                                Delete
                            </button>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

        <script src="/sotre_php_mvc/public/javascript/products.js"></script>

</body>
</html>