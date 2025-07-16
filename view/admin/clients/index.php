<!-- In view/admin/clients/index.php -->
<link rel="stylesheet" href="/sotre_php_mvc/public/css/table.css" />
<div class="user-management-wrapper">
    <h2 class="user-management-heading">User Management</h2>
    
    <div class="mb-6">
        <div class="relative max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class='bx bx-search text-gray-400'></i>
            </div>
            <input type="text" id="clientSearch" 
                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                   placeholder="Search clients...">
            <div id="searchLoading" class="absolute inset-y-0 right-0 flex items-center pr-3">
                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-primary-600"></div>
            </div>
        </div>
    </div>
    
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
            <tbody id="clientsTableBody">
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

 <script src="/sotre_php_mvc/public/javascript/client.js"></script>