<div class="container mx-auto px-4 py-6">
    <div class="bg-white dark:bg-dark-700 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Order Management</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                <thead class="bg-gray-50 dark:bg-dark-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-dark-700 divide-y divide-gray-200 dark:divide-gray-600">
                    <?php foreach ($orders as $order): ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-dark-600">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-200">
                            #<?= $order['id'] ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            <?= htmlspecialchars($order['client_name']) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            <?= date('M d, Y', strtotime($order['order_date'])) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            $<?= number_format($order['total_amount'], 2) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?= $order['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($order['status'] === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') ?>">
                                <?= ucfirst($order['status']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="index.php?controller=order&action=show&id=<?= $order['id'] ?>" class="text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-300 mr-3">View</a>
                            <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
       
    </div>
</div>