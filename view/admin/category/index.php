<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Categories</title>
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
        
        .user-table-container {
            background-color: #ffffff;
            color: #111827;
        }
        
        .dark .user-table-container {
            background-color: #1e293b;
            color: #f8fafc;
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
        
        #categorySearch {
            background-color: #ffffff;
            color: #111827;
            border-color: #d1d5db;
        }
        
        .dark #categorySearch {
            background-color: #1e293b;
            color: #f8fafc;
            border-color: #334155;
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
    </style>
</head>
<body class="bg-white dark:bg-dark-900">
    <div class="mb-6">
        <div class="relative max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class='bx bx-search text-gray-400 dark:text-gray-500'></i>
            </div>
            <input type="text" id="categorySearch" 
                   class="block w-full pl-10 pr-3 py-2 border rounded-md leading-5 bg-white dark:bg-dark-800 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500" 
                   placeholder="Search categories...">
            <div id="searchLoading" class="absolute inset-y-0 right-0 flex items-center pr-3">
                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-primary-600"></div>
            </div>
        </div>
    </div>

    <div class="user-table-container bg-white dark:bg-dark-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
        <table class="user-data-table w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 10%">ID</th>
                    <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 30%">Name</th>
                    <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 50%">Description</th>
                    <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-300" style="width: 10%">Actions</th>
                </tr>
            </thead>
            <tbody id="categoriesTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php foreach ($categories as $category): ?>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($category['id']) ?></td>
                    <td class="py-4 px-4 text-gray-800 dark:text-gray-200"><?= htmlspecialchars($category['name']) ?></td>
                    <td class="py-4 px-4 text-gray-600 dark:text-gray-300"><?= htmlspecialchars($category['description']) ?></td>
                    <td class="user-actions-cell py-4 px-4">
                        <a href="/sotre_php_mvc/index.php?controller=category&action=edit&id=<?= $category['id'] ?>">
                            <button class="user-action-btn user-edit-btn">
                                Edit
                            </button>
                        </a>
                        <?php if ($_SESSION['user']['role_name'] === 'admin'): ?>
                        <a href="/sotre_php_mvc/index.php?controller=category&action=destroy&id=<?= $category['id'] ?>" 
                           onclick="return confirm('Are you sure you want to delete this category?');">
                            <button class="user-action-btn user-delete-btn">
                                Delete
                            </button>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if (empty($categories)): ?>
                <tr>
                    <td colspan="4" class="no-results text-gray-500 dark:text-gray-400">
                        No categories found
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="/sotre_php_mvc/public/javascript/category.js"></script>
</body>
</html>