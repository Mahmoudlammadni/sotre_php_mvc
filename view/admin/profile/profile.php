<?php 
$user = $userData ?? [];
$currentUser = $_SESSION['user'] ?? [];
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-serif font-bold text-gray-800 dark:text-white mb-2">Staff Profile</h1>
            <p class="text-gray-500 dark:text-gray-400">Manage your account details</p>
        </div>
        
        <div class="bg-white dark:bg-dark-800 rounded-2xl profile-card overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-8">
                <div class="flex flex-col md:flex-row items-start gap-8 mb-10">
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white"><?= htmlspecialchars($user['username'] ?? '') ?></h2>
                        <p class="text-gray-500 dark:text-gray-400 mt-1 flex items-center">
                            <i class="fas fa-envelope mr-2 text-indigo-500"></i>
                            <?= htmlspecialchars($user['email'] ?? '') ?>
                        </p>
                        <p class="text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                            <i class="fas fa-user-tag mr-2 text-indigo-500"></i>
                            <?= ucfirst(htmlspecialchars($user['role_name'] ?? '')) ?>
                        </p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-gray-50/50 dark:bg-gray-900/50">
                        <h3 class="font-semibold text-lg text-gray-700 dark:text-gray-200 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-indigo-500"></i>
                            Account Information
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">User ID</p>
                                <p class="text-gray-700 dark:text-gray-200 mt-1">
                                    <?= htmlspecialchars($user['id'] ?? '') ?>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Member Since</p>
                                <p class="text-gray-700 dark:text-gray-200 mt-1 flex items-center">
                                    <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i>
                                    <?= date('F Y', strtotime($user['created_at'] ?? 'now')) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 bg-gray-50/50 dark:bg-gray-900/50">
                        <h3 class="font-semibold text-lg text-gray-700 dark:text-gray-200 mb-4 flex items-center">
                            <i class="fas fa-cog mr-2 text-indigo-500"></i>
                            Account Actions
                        </h3>
                        <div class="space-y-3">
                            <a href="index.php?controller=user&action=editProfile&id=<?= $user['id'] ?>" 
                               class="block w-full text-center bg-white dark:bg-gray-800 border border-indigo-100 dark:border-indigo-900 text-indigo-600 dark:text-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 px-4 py-3 rounded-lg transition action-btn shadow-sm flex items-center justify-center">
                                <i class="fas fa-edit mr-2"></i> Edit Profile
                            </a>
                            <a href="index.php?controller=user&action=logout" 
                               class="block w-full text-center bg-white dark:bg-gray-800 border border-red-100 dark:border-red-900 text-red-600 dark:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/30 px-4 py-3 rounded-lg transition action-btn shadow-sm flex items-center justify-center">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>