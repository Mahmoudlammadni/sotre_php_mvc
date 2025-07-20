<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Clients</title>
    <link rel="stylesheet" href="/sotre_php_mvc/public/css/table.css" />
    <style>
        body {
            background-color: #ffffff;
            color: #111827;
        }
        
        .dark body {
            background-color: #0f172a;
            color: #f3f4f6;
        }
        
        .user-management-wrapper {
            background-color: #ffffff;
            color: #111827;
        }
        
        .dark .user-management-wrapper {
            background-color: #0f172a;
            color: #f3f4f6;
        }
        
        .user-management-heading {
            color: #111827;
        }
        
        .dark .user-management-heading {
            color: #f3f4f6;
        }
        
        .user-table-container {
            background-color: #ffffff;
            color: #111827;
            border-color: #e5e7eb;
        }
        
        .dark .user-table-container {
            background-color: #1e293b;
            color: #f8fafc;
            border-color: #334155;
        }
        
        .user-data-table {
            background-color: #ffffff;
            color: #111827;
        }
        
        .dark .user-data-table {
            background-color: #1e293b;
            color: #f8fafc;
        }
        
        .user-data-table th,
        .user-data-table td {
            border-color: #e5e7eb;
        }
        
        .dark .user-data-table th,
        .dark .user-data-table td {
            border-color: #334155;
        }
        
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
            color: #6b7280;
        }
        
        .dark .no-results {
            color: #9ca3af;
        }
        
        #clientSearch {
            background-color: #ffffff;
            color: #111827;
            border-color: #d1d5db;
        }
        
        .dark #clientSearch {
            background-color: #1e293b;
            color: #f8fafc;
            border-color: #334155;
        }
        
        /* Button styling - removed space below */
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

        .user-edit-btn {
            background-color: #e0e7ff;
            color: #4f46e5;
        }
        
        .dark .user-edit-btn {
            background-color: #3730a3;
            color: #a5b4fc;
        }
        
        .user-delete-btn {
            background-color: #fee2e2;
            color: #dc2626;
        }
        
        .dark .user-delete-btn {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .user-password-field {
            font-family: monospace;
            letter-spacing: 0.1em;
        }
    
    </style>
</head>
<body class="bg-white dark:bg-dark-900">
    <div class="user-management-wrapper p-4 sm:p-6 lg:p-8">
        <h2 class="user-management-heading text-2xl font-bold mb-6">Client Management</h2>
        
        <div class="mb-6">
            <div class="relative max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class='bx bx-search text-gray-400 dark:text-gray-500'></i>
                </div>
                <input type="text" id="clientSearch" 
                       class="block w-full pl-10 pr-3 py-2 border rounded-md leading-5 bg-white dark:bg-dark-800 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                       placeholder="Search clients...">
                <div id="searchLoading" class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-primary-600"></div>
                </div>
            </div>
        </div>
        
        <div class="user-table-container rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <table class="user-data-table w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 5%">ID</th>
                        <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 12%">Username</th>
                        <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 18%">Email</th>
                        <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 10%">Password</th>
                        <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 10%">Phone</th>
                        <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 20%">Address</th>
                        <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 15%">Actions</th>
                        <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 10%">Created</th>
                    </tr>
                </thead>
                <tbody id="clientsTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <?php foreach ($clients as $c): ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($c['client_id']) ?></td>
                        <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($c['username']) ?></td>
                        <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($c['email']) ?></td>
                        <td class="py-4 px-4 text-gray-800 dark:text-gray-200 user-password-field">••••••••</td>
                        <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($c['phone']) ?></td>
                        <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($c['address']) ?></td>
                        <td class="user-actions-cell py-4 px-4" id="hihi">
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
                        <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= date('M d, Y', strtotime($c['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($clients)): ?>
                    <tr>
                        <td colspan="8" class="no-results py-4 px-4">
                            No clients found
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="/sotre_php_mvc/public/javascript/client.js"></script>
</body>
</html>