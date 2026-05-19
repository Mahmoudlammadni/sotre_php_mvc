<?php foreach ($products as $product): ?>
<tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
    <td class="product-image-cell py-4 px-4">
        <?php if (!empty($product['image_path'])): ?>
        <img src="/sotre_php_mvc/<?= htmlspecialchars($product['image_path']) ?>"
             alt="<?= htmlspecialchars($product['name']) ?>">
        <?php else: ?>
        <div class="text-gray-400 dark:text-gray-500">No image</div>
        <?php endif; ?>
    </td>
    <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($product['name']) ?></td>
    <td class="py-4 px-4 text-gray-600 dark:text-gray-300"><?= htmlspecialchars($product['description']) ?></td>
    <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($product['price']) ?> MAD</td>
    <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($product['quantity']) ?></td>
    <td class="user-actions-cell py-4 px-4">
        <a href="/sotre_php_mvc/index.php?controller=product&action=edite&id=<?= $product['id'] ?>">
            <button class="user-action-btn user-edit-btn">Edit</button>
        </a>
        <?php if ($_SESSION['user']['role_name'] === 'admin'): ?>
        <a href="/sotre_php_mvc/index.php?controller=product&action=destroy&id=<?= $product['id'] ?>"
           onclick="return confirm('Are you sure you want to delete this product?');">
            <button class="user-action-btn user-delete-btn">Delete</button>
        </a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

<?php if (empty($products)): ?>
<tr>
    <td colspan="6" class="no-results text-gray-500 dark:text-gray-400">
        No products found
    </td>
</tr>
<?php endif; ?>
