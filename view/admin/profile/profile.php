<?php 
$user = $userData ?? [];
$currentUser = $_SESSION['user'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Profile | LuxeCart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-card {
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .profile-card:hover {
            box-shadow: 0 15px 40px -10px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        .action-btn:hover {
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans antialiased">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-serif font-bold text-gray-800 mb-2">Staff Profile</h1>
                <p class="text-gray-500">Manage your account details</p>
            </div>
            
            <div class="bg-white rounded-2xl profile-card overflow-hidden border border-gray-100">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row items-start gap-8 mb-10">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-600 flex items-center justify-center text-6xl shadow-inner">
                                <i class="fas fa-user-shield"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($user['username'] ?? '') ?></h2>
                            <p class="text-gray-500 mt-1 flex items-center">
                                <i class="fas fa-envelope mr-2 text-indigo-500"></i>
                                <?= htmlspecialchars($user['email'] ?? '') ?>
                            </p>
                            <p class="text-gray-500 mt-2 flex items-center">
                                <i class="fas fa-user-tag mr-2 text-indigo-500"></i>
                                <?= ucfirst(htmlspecialchars($user['role_name'] ?? '')) ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border border-gray-100 rounded-xl p-6 bg-gray-50/50">
                            <h3 class="font-semibold text-lg text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-indigo-500"></i>
                                Account Information
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">User ID</p>
                                    <p class="text-gray-700 mt-1">
                                        <?= htmlspecialchars($user['id'] ?? '') ?>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Member Since</p>
                                    <p class="text-gray-700 mt-1 flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-indigo-500"></i>
                                        <?= date('F Y', strtotime($user['created_at'] ?? 'now')) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border border-gray-100 rounded-xl p-6 bg-gray-50/50">
                            <h3 class="font-semibold text-lg text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-cog mr-2 text-indigo-500"></i>
                                Account Actions
                            </h3>
                            <div class="space-y-3">
                                <a href="index.php?controller=user&action=editProfile&id=<?= $user['id'] ?>" 
                                   class="block w-full text-center bg-white border border-indigo-100 text-indigo-600 hover:bg-indigo-50 hover:border-indigo-200 px-4 py-3 rounded-lg transition action-btn shadow-sm flex items-center justify-center">
                                    <i class="fas fa-edit mr-2"></i> Edit Profile
                                </a>
                                <a href="index.php?controller=user&action=logout" 
                                   class="block w-full text-center bg-white border border-red-100 text-red-600 hover:bg-red-50 hover:border-red-200 px-4 py-3 rounded-lg transition action-btn shadow-sm flex items-center justify-center">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>