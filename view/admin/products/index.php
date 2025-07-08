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
            table-layout: fixed; /* Ensures consistent column widths */
        }
        
        .user-data-table td, 
        .user-data-table th {
            vertical-align: middle !important; /* Forces middle alignment */
            line-height: 1.4; /* Consistent text spacing */
        }
        
    .user-actions-cell {
    display: flex !important;
    align-items: center !important;
    height: 100% !important;
    padding: 4px 0 0 0 !important; /* Added 4px top padding to lift buttons */
    box-sizing: border-box !important;
    

}

.user-action-btn {
    height: 32px !important;
    line-height: 30px !important; /* Slightly reduced for visual balance */
    transform: translateY(-2px); /* Micro-adjustment to lift buttons */
    margin: 0 4px !important;
    
}
        
        .product-image-cell {
            display: flex;
            align-items: center;
            height: 80px; /* Slightly taller to accommodate image */
        }
        
        .user-data-table img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            display: block; /* Removes inline spacing issues */
            margin: 0 auto; /* Centers image */
        }
    </style>
</head>
<body>
    <div class="user-management-wrapper">
        <h1 class="user-management-heading">Product Management</h1>
        
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
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="product-image-cell">
                            <img src="/sotre_php_mvc/<?= htmlspecialchars($product['image_path']) ?>" 
                                 alt="<?= htmlspecialchars($product['name']) ?>">
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
                            <a href="/sotre_php_mvc/index.php?controller=product&action=destroy&id=<?= $product['id'] ?>" 
                               onclick="return confirm('Are you sure you want to delete this product?');">
                                <button class="user-action-btn user-delete-btn">
                                    Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>