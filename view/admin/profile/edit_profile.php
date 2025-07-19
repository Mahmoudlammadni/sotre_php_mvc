<?php 
$user = $userData ?? [];
$roles = $roles ?? [];
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-serif font-bold text-gray-800 dark:text-white mb-2">Edit Profile</h1>
            <p class="text-gray-500 dark:text-gray-400">Update your account details</p>
        </div>
        
        <div class="bg-white dark:bg-dark-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-8">
                <form action="index.php?controller=user&action=update&id=<?= $user['id'] ?>" method="post">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="username">
                                    Username
                                </label>
                                <input class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-dark-700 transition duration-200" 
                                       type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="email">
                                    Email
                                </label>
                                <input class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-dark-700 transition duration-200" 
                                       type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="password">
                                    New Password (leave blank to keep current)
                                </label>
                                <input class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-dark-700 transition duration-200" 
                                       type="password" name="password" placeholder="••••••••">
                            </div>
                            
                            <?php if ($_SESSION['user']['role_name'] === 'admin'): ?>
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="role_id">
                                    Role
                                </label>
                                <select name="role_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-dark-700 transition duration-200">
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?= $role['id'] ?>" <?= ($role['id'] == ($user['role_id'] ?? '')) ? 'selected' : '' ?>>
                                            <?= ucfirst($role['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php else: ?>
                                <input type="hidden" name="role_id" value="<?= $user['role_id'] ?? '' ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="index.php?controller=user&action=profile" 
                           class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Cancel
                        </a>
                        <button class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition duration-200" 
                                type="submit">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>