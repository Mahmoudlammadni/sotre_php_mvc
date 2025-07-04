<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Products</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        img {
            width: 60px;
        }

        .actions button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>Admin Panel - Product Management</h1>

    <form action="index.php?controller=user&action=logout" method="post">
        <button type="submit">Log Out</button>
    </form>

    <a href="index.php?controller=product&action=create">+ Add Product</a>
    <a href="index.php?controller=user&action=index">see user</a>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price (MAD)</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><img src="/sotre_php_mvc/<?= htmlspecialchars($product['image_path']) ?>" alt="Product"></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['description']) ?></td>
                <td><?= htmlspecialchars($product['price']) ?></td>
                <td><?= htmlspecialchars($product['quantity']) ?></td>
                <td class="actions">
                    <a href="/sotre_php_mvc/index.php?controller=product&action=edite&id=<?= $product['id'] ?>"><button>Edit</button></a>
                    <a href="/sotre_php_mvc/index.php?controller=product&action=destroy&id=<?= $product['id'] ?>" onclick="return confirm('Are you sure?');">
                        <button>Delete</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
