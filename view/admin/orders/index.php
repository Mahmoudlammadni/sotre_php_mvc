<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
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
        
        .container {
            background-color: #ffffff;
        }
        
        .dark .container {
            background-color: #0f172a;
        }
        
        .order-table-container {
            background-color: #ffffff;
            color: #111827;
        }
        
        .dark .order-table-container {
            background-color: #1e293b;
            color: #f8fafc;
        }
        
        .order-table {
            background-color: #ffffff;
            color: #111827;
        }
        
        .dark .order-table {
            background-color: #1e293b;
            color: #f8fafc;
        }
        
        .order-table th,
        .order-table td {
            border-color: #e5e7eb;
        }
        
        .dark .order-table th,
        .dark .order-table td {
            border-color: #334155;
        }
        
        /* Table header dark mode */
        .order-table thead {
            background-color: #f9fafb;
        }
        
        .dark .order-table thead {
            background-color: #1f2937;
        }
        
        .order-table th {
            color: #374151;
        }
        
        .dark .order-table th {
            color: #e5e7eb;
        }
        
        /* Status badges */
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .dark .status-pending {
            background-color: #92400e;
            color: #fef3c7;
        }
        
        .status-paid {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .dark .status-paid {
            background-color: #065f46;
            color: #d1fae5;
        }
        
        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .dark .status-cancelled {
            background-color: #991b1b;
            color: #fee2e2;
        }
        
        /* Action links */
        .action-link {
            color: #2563eb;
        }
        
        .dark .action-link {
            color: #60a5fa;
        }
        
        .action-link:hover {
            color: #1e40af;
        }
        
        .dark .action-link:hover {
            color: #93c5fd;
        }
        
        /* Header styles */
        .order-header {
            border-color: #e5e7eb;
            color: #111827;
        }
        
        .dark .order-header {
            border-color: #334155;
            color: #f3f4f6;
        }
    </style>
</head>
<body class="bg-white dark:bg-dark-900">
    <div class="container mx-auto px-4 py-6">
        <div class="order-table-container bg-white dark:bg-dark-700 rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 order-header border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold">Order Management</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="order-table min-w-full divide-y">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="width: 10%">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="width: 20%">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="width: 15%">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="width: 15%">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="width: 15%">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="width: 25%">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php foreach ($orders as $order): ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-dark-600">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                #<?= $order['id'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <?= htmlspecialchars($order['client_name']) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <?= date('M d, Y', strtotime($order['order_date'])) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                $<?= number_format($order['total_amount'], 2) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?= $order['status'] === 'pending' ? 'status-pending' : 
                                       ($order['status'] === 'paid' ? 'status-paid' : 'status-cancelled') ?>">
                                    <?= ucfirst($order['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="index.php?controller=order&action=show&id=<?= $order['id'] ?>" class="action-link mr-3">View</a>
                                <a href="#" class="action-link">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>