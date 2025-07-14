<?php
$orderItems = $this->orderItem->getByOrder($order['id']);
?>
<?php if (isset($_SESSION['success'])): ?>
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
        <?= $_SESSION['success'] ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
        <?= $_SESSION['error'] ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>


<div class="container mx-auto px-4 py-6">
    <div class="bg-white dark:bg-dark-700 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Order #<?= $order['id'] ?></h2>
                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                    <?= $order['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                       ($order['status'] === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') ?>">
                    <?= ucfirst($order['status']) ?>
                </span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Placed on <?= date('F j, Y \a\t g:i A', strtotime($order['order_date'])) ?>
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-6 p-6">
            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200 mb-4">Order Items</h3>
                
                <div class="bg-gray-50 dark:bg-dark-600 rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-500">
                        <thead class="bg-gray-100 dark:bg-dark-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Qty</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-dark-600 divide-y divide-gray-200 dark:divide-gray-500">
                            <?php foreach ($orderItems as $item): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-200"><?= htmlspecialchars($item['product_name']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    $<?= number_format($item['unit_price'], 2) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    <?= $item['quantity'] ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                    $<?= number_format($item['subtotal'], 2) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-200 mb-4">Order Summary</h3>
                
                <div class="bg-gray-50 dark:bg-dark-600 rounded-lg p-4">
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-500">
                        <span class="text-gray-600 dark:text-gray-300">Subtotal</span>
                        <span class="text-gray-900 dark:text-gray-200">$<?= number_format($order['total_amount'], 2) ?></span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-500">
                        <span class="text-gray-600 dark:text-gray-300">Shipping</span>
                        <span class="text-gray-900 dark:text-gray-200">$0.00</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-500">
                        <span class="text-gray-600 dark:text-gray-300">Tax</span>
                        <span class="text-gray-900 dark:text-gray-200">$0.00</span>
                    </div>
                    <div class="flex justify-between py-2 font-semibold text-lg">
                        <span class="text-gray-900 dark:text-gray-200">Total</span>
                        <span class="text-gray-900 dark:text-gray-200">$<?= number_format($order['total_amount'], 2) ?></span>
                    </div>
                </div>
                
                <div class="mt-6 bg-gray-50 dark:bg-dark-600 rounded-lg p-4">
                    <h4 class="text-md font-medium text-gray-900 dark:text-gray-200 mb-2">Customer Information</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300"><?= htmlspecialchars($order['client_name']) ?></p>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Order placed by User #<?= $order['user_id'] ?></p>
                </div>
                <div class="mt-6 space-y-2">
                 <?php if ($order['status'] === 'pending'): ?>
                     <form action="index.php?controller=order&action=markAsPaid" method="POST">
                         <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                         <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2 px-4 rounded-md transition duration-200">
                             Mark as Paid
                         </button>
                     </form>
                 <?php endif; ?>
                
                 <button class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-dark-500 dark:hover:bg-dark-400 dark:text-gray-200 py-2 px-4 rounded-md transition duration-200">
                     Print Invoice
                 </button>
                </div>
            </div>
        </div>
    </div>
</div>