<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="/sotre_php_mvc/public/css/table.css" />
    <style>
        .user-data-table td {
            vertical-align: middle !important;
            padding-top: 12px !important;
            padding-bottom: 12px !important;
        }
        
        .user-actions-cell {
            padding-top: 8px !important;
            padding-bottom: 8px !important;
        }
        
        .user-action-btn {
            transform: translateY(-1px);
        }
        
        #searchLoading {
            display: none;
        }
        #searchLoading.visible {
            display: block;
        }
    </style>
</head>
<body>
    <div class="user-management-wrapper">
        <h2 class="user-management-heading">All Users</h2>
        
        <div class="mb-6">
            <div class="relative max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class='bx bx-search text-gray-400'></i>
                </div>
                <input type="text" id="userSearch" 
                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                       placeholder="Search users...">
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
                        <th style="width: 15%">Username</th>
                        <th style="width: 20%">Email</th>
                        <th style="width: 10%">Role</th>
                        <th style="width: 12%">Password</th>
                        <th style="width: 18%">Actions</th>
                        <th style="width: 15%">Created At</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?=$user['id'] ?></td>
                        <td><?=$user['username'] ?></td>
                        <td><?=$user['email'] ?></td>
                        <td><?=$user['role_name'] ?></td>
                        <td class="user-password-field">••••••••</td>
                        <td class="user-actions-cell">
                            <a href="/sotre_php_mvc/index.php?controller=user&action=edite&id=<?= $user['id']?>">
                                <button class="user-action-btn user-edit-btn">
                                    Update
                                </button>
                            </a>
                            <a href="/sotre_php_mvc/index.php?controller=user&action=destroy&id=<?= $user['id']?>" 
                               onclick="return confirm('Are you sure you want to delete this user?');">
                                <button class="user-action-btn user-delete-btn">
                                    Delete
                                </button>
                            </a>
                        </td>
                        <td><?=date('M d, Y', strtotime($user['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
       <script src="/sotre_php_mvc/public/javascript/user.js"></script>
</body>
</html>