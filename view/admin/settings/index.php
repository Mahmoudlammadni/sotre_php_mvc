<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Store Settings</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your store configuration and preferences</p>
        </div>
        
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="px-4 py-3 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-md border border-green-200 dark:border-green-800/50 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <?= $_SESSION['success_message'] ?>
                <?php unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>
    </div>

    <form action="index.php?controller=settings&action=update" method="POST" class="space-y-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-6 sm:p-8 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="bg-primary-100 dark:bg-primary-900/30 p-2 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">General Settings</h3>
                </div>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="store_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Store Name</label>
                        <input type="text" name="settings[store_name]" id="store_name" 
                               value="<?= htmlspecialchars($settings['store_name'] ?? '') ?>" 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200">
                    </div>
                    
                    <div>
                        <label for="store_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Store Email</label>
                        <input type="email" name="settings[store_email]" id="store_email" 
                               value="<?= htmlspecialchars($settings['store_email'] ?? '') ?>" 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200">
                    </div>
                    
                    <div>
                        <label for="store_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Store Phone</label>
                        <input type="text" name="settings[store_phone]" id="store_phone" 
                               value="<?= htmlspecialchars($settings['store_phone'] ?? '') ?>" 
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200">
                    </div>
                    
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Currency</label>
                        <select name="settings[currency]" id="currency" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200">
                            <option value="MAD" <?= ($settings['currency'] ?? '') === 'MAD' ? 'selected' : '' ?>>MAD</option>
                            <option value="USD" <?= ($settings['currency'] ?? '') === 'USD' ? 'selected' : '' ?>>US Dollar ($)</option>
                            <option value="EUR" <?= ($settings['currency'] ?? '') === 'EUR' ? 'selected' : '' ?>>Euro (€)</option>
                            <option value="GBP" <?= ($settings['currency'] ?? '') === 'GBP' ? 'selected' : '' ?>>British Pound (£)</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="p-6 sm:p-8 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-2 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Payment Settings</h3>
                </div>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Payment Methods</label>
                        <select name="settings[payment_method]" id="payment_method" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200">
                            <option value="cod" <?= ($settings['payment_method'] ?? '') === 'cod' ? 'selected' : '' ?>>Cash on Delivery</option>
                            <option value="stripe" <?= ($settings['payment_method'] ?? '') === 'stripe' ? 'selected' : '' ?>>Stripe</option>
                            <option value="paypal" <?= ($settings['payment_method'] ?? '') === 'paypal' ? 'selected' : '' ?>>PayPal</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="stripe_key" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stripe API Key</label>
                        <div class="relative">
                            <input type="password" name="settings[stripe_key]" id="stripe_key" 
                                   value="<?= htmlspecialchars($settings['stripe_key'] ?? '') ?>" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200 pr-10">
                            <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-500" onclick="togglePasswordVisibility('stripe_key')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-6 sm:p-8">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg mr-4">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Shipping Settings</h3>
                </div>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="shipping_cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Standard Shipping Cost</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 dark:text-gray-400"><?= $settings['currency'] ?? 'MAD' ?></span>
                            </div>
                            <input type="number" step="0.01" name="settings[shipping_cost]" id="shipping_cost" 
                                   value="<?= htmlspecialchars($settings['shipping_cost'] ?? '5.99') ?>" 
                                   class="w-full pl-14 px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200">
                        </div>
                    </div>
                    
                    <div>
                        <label for="free_shipping_threshold" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Free Shipping Threshold</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 dark:text-gray-400"><?= $settings['currency'] ?? 'MAD' ?></span>
                            </div>
                            <input type="number" step="0.01" name="settings[free_shipping_threshold]" id="free_shipping_threshold" 
                                   value="<?= htmlspecialchars($settings['free_shipping_threshold'] ?? '50.00') ?>" 
                                   class="w-full pl-14 px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition duration-200">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Save Settings
            </button>
        </div>
    </form>
</div>

<script>
function togglePasswordVisibility(id) {
    const input = document.getElementById(id);
    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}
</script>