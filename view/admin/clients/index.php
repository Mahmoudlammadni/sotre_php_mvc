 <link rel="stylesheet" href="/sotre_php_mvc/public/css/table.css" />
<div class="user-management-wrapper">
    <h2 class="user-management-heading">User Management</h2>
    
    <div class="user-table-container">
        <table class="user-data-table">
            <thead>
                <tr>
                    <th style="width: 5%">ID</th>
                    <th style="width: 12%">Username</th>
                    <th style="width: 18%">Email</th>
                    <th style="width: 10%">Password</th>
                    <th style="width: 10%">Phone</th>
                    <th style="width: 20%">Address</th>
                    <th style="width: 15%">Actions</th>
                    <th style="width: 10%">Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $c): ?>
                <tr>
                    <td><?=$c['client_id'] ?></td>
                    <td><?=$c['username'] ?></td>
                    <td><?=$c['email'] ?></td>
                    <td class="user-password-field">••••••••</td>
                    <td><?=$c['phone'] ?></td>
                    <td><?=$c['address'] ?></td>
                    <td class="user-actions-cell">
                        <a href="/sotre_php_mvc/index.php?controller=client&action=edit&id=<?= $c['user_id']?>">
                            <button class="user-action-btn user-edit-btn">
                                Edit
                            </button>
                        </a>
                        <a href="/sotre_php_mvc/index.php?controller=client&action=destroy&id=<?= $c['user_id']?>" 
                           onclick="return confirm('Are you sure you want to delete this user?');">
                            <button class="user-action-btn user-delete-btn">
                                Delete
                            </button>
                        </a>
                    </td>
                    <td><?=date('M d, Y', strtotime($c['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>