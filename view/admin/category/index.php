<link rel="stylesheet" href="/sotre_php_mvc/public/css/table.css" />
<body>
    <div class="user-management-wrapper">
        <h2 class="user-management-heading">All Categories</h2>
        
        <div class="user-table-container">
            <table class="user-data-table">
                <thead>
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th style="width: 25%">Name</th>
                        <th style="width: 45%">Description</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($category as $c): ?>
                    <tr>
                        <td><?=$c['id'] ?></td>
                        <td><?=$c['name'] ?></td>
                        <td><?=$c['description'] ?></td>
                        <td class="user-actions-cell">
                            <a href="/sotre_php_mvc/index.php?controller=category&action=edit&id=<?= $c['id']?>">
                                <button class="user-action-btn user-edit-btn">
                                    Update
                                </button>
                            </a>
                            <a href="/sotre_php_mvc/index.php?controller=category&action=destroy&id=<?= $c['id'] ?>" 
                               onclick="return confirm('Are you sure you want to delete this category?');">
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