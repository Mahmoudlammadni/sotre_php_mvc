<?php 
$user = $userData ?? [];
$roles = $roles ?? [];
$currentUser = $_SESSION['user'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | LuxeCart</title>
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
                <h1 class="text-4xl font-serif font-bold text-gray-800 mb-2">Edit Profile</h1>
                <p class="text-gray-500">Update your account details</p>
            </div>
            
            <div class="bg-white rounded-2xl profile-card overflow-hidden border border-gray-100">
                <div class="p-8">
                    <form action="index.php?controller=user&action=update&id=<?= $user['id'] ?>" method="post">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Username
                                    </label>
                                    <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" 
                                           type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                        Email
                                    </label>
                                    <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" 
                                           type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                        New Password (leave blank to keep current)
                                    </label>
                                    <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200" 
                                           type="password" name="password" placeholder="••••••••">
                                </div>
                                
                                <?php if ($_SESSION['user']['role_name'] === 'admin'): ?>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role_id">
                                        Role
                                    </label>
                                    <select name="role_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
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
                               class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition" 
                                    type="submit">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>