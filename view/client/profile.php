<?php 
$client = $clientData ?? [];
$user = $_SESSION['user'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | LuxeCart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans antialiased">
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <main class="container mx-auto px-4 py-8 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-serif font-bold text-dark mb-8">My Profile</h1>
            
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col md:flex-row items-start gap-6 mb-8">
                        <div class="w-24 h-24 rounded-full bg-primary text-white flex items-center justify-center text-4xl">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold"><?= htmlspecialchars($client['username'] ?? '') ?></h2>
                            <p class="text-gray-600 mt-1"><?= htmlspecialchars($client['email'] ?? '') ?></p>
                            <?php if (!empty($client['phone'])): ?>
                            <p class="text-gray-600 mt-1">
                                <i class="fas fa-phone mr-2"></i><?= htmlspecialchars($client['phone']) ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border rounded-lg p-4">
                            <h3 class="font-medium text-lg mb-3">Account Details</h3>
                            <div class="space-y-2">
                                <?php if (!empty($client['address'])): ?>
                                <p>
                                    <span class="text-gray-600 block">Address:</span> 
                                    <?= htmlspecialchars($client['address']) ?>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="border rounded-lg p-4">
                            <h3 class="font-medium text-lg mb-3">Actions</h3>
                            <div class="space-y-3">
                                <a href="index.php?controller=client&action=edit&id=<?= $user['id'] ?>" 
                                   class="block w-full text-center bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-md transition">
                                    <i class="fas fa-edit mr-2"></i> Edit Profile
                                </a>
                                <a href="index.php?controller=user&action=logout" 
                                   class="block w-full text-center bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-md transition">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
    
    <script src="/sotre_php_mvc/public/javascript/home.js"></script>
</body>
</html>