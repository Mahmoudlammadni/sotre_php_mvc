<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Store Settings</h2>
        
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="px-4 py-2 bg-green-100 text-green-700 rounded-md">
                <?= $_SESSION['success_message'] ?>
                <?php unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>
    </div>

    <form action="index.php?controller=settings&action=update" method="POST" class="space-y-6">
        <div class="bg-white dark:bg-dark-700 rounded-lg shadow overflow-hidden">
           
            <div class="p-6 border-b border-gray-200 dark:border-gray-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">General Settings</h3>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="store_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Store Name</label>
                        <input type="text" name="settings[store_name]" id="store_name" 
                               value="<?= htmlspecialchars($settings['store_name'] ?? '') ?>" 
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-dark-800 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label for="store_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Store Email</label>
                        <input type="email" name="settings[store_email]" id="store_email" 
                               value="<?= htmlspecialchars($settings['store_email'] ?? '') ?>" 
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-dark-800 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label for="store_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Store Phone</label>
                        <input type="text" name="settings[store_phone]" id="store_phone" 
                               value="<?= htmlspecialchars($settings['store_phone'] ?? '') ?>" 
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-dark-800 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Currency</label>
                        <select name="settings[currency]" id="currency" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-dark-800 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="MAD" <?= ($settings['currency'] ?? '') === 'MAD' ? 'selected' : '' ?>>MAD</option>
                            <option value="USD" <?= ($settings['currency'] ?? '') === 'USD' ? 'selected' : '' ?>>US Dollar ($)</option>
                            <option value="EUR" <?= ($settings['currency'] ?? '') === 'EUR' ? 'selected' : '' ?>>Euro (€)</option>
                            <option value="GBP" <?= ($settings['currency'] ?? '') === 'GBP' ? 'selected' : '' ?>>British Pound (£)</option>
                        </select>
                    </div>
                </div>
            </div>
            
         
            <div class="p-6 border-b border-gray-200 dark:border-gray-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Payment Settings</h3>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Payment Methods</label>
                        <select name="settings[payment_method]" id="payment_method" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-dark-800 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="cod" <?= ($settings['payment_method'] ?? '') === 'cod' ? 'selected' : '' ?>>Cash on Delivery</option>
                            <option value="stripe" <?= ($settings['payment_method'] ?? '') === 'stripe' ? 'selected' : '' ?>>Stripe</option>
                            <option value="paypal" <?= ($settings['payment_method'] ?? '') === 'paypal' ? 'selected' : '' ?>>PayPal</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="stripe_key" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stripe API Key</label>
                        <input type="password" name="settings[stripe_key]" id="stripe_key" 
                               value="<?= htmlspecialchars($settings['stripe_key'] ?? '') ?>" 
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-dark-800 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>
            </div>
            

            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Shipping Settings</h3>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="shipping_cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Standard Shipping Cost</label>
                        <input type="number" step="0.01" name="settings[shipping_cost]" id="shipping_cost" 
                               value="<?= htmlspecialchars($settings['shipping_cost'] ?? '5.99') ?>" 
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-dark-800 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    
                    <div>
                        <label for="free_shipping_threshold" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Free Shipping Threshold</label>
                        <input type="number" step="0.01" name="settings[free_shipping_threshold]" id="free_shipping_threshold" 
                               value="<?= htmlspecialchars($settings['free_shipping_threshold'] ?? '50.00') ?>" 
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-dark-800 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Save Settings
            </button>
        </div>
    </form>
</div>