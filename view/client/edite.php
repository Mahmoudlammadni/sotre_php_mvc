<?php 
$client = $clientData ?? [];
$user = $_SESSION['user'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile | LuxeCart</title>
  <link rel="stylesheet" href="/sotre_php_mvc/public/css/main.css">
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <a href="index.php?controller=home&action=index" class="logo">
      <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
      </svg>
      <div>
        <div class="logo-text">LuxeCart</div>
        <div class="logo-sub">Premium quality for everyone</div>
      </div>
    </a>
    <div class="header-actions">
      <div class="user-menu" data-dropdown>
        <button class="user-btn" data-dropdown-btn>
          <div class="user-avatar"><?= strtoupper(substr($user['username'] ?? 'U', 0, 1)) ?></div>
          <span class="user-name"><?= htmlspecialchars($user['username'] ?? '') ?></span>
          <svg class="chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="dropdown" data-dropdown-menu>
          <a href="index.php?controller=client&action=profile">My Profile</a>
          <div class="dropdown-divider"></div>
          <form action="index.php?controller=user&action=logout" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <button type="submit">Sign Out</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>

<main style="padding: 48px 0; min-height: 70vh;">
  <div class="container" style="max-width: 480px;">
    <div class="card" style="padding:32px;">
      <h2 style="font-size:24px;font-weight:700;color:var(--dark);text-align:center;margin-bottom:24px;">Edit Profile</h2>
      <form action="/sotre_php_mvc/index.php?controller=client&action=update&id=<?= $client['user_id'] ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="form-group">
          <label class="form-label">Name</label>
          <input class="form-input" type="text" name="username" value="<?= htmlspecialchars($client['username']) ?>" required>
        </div>
        <div class="form-group">
          <label class="form-label">Email</label>
          <input class="form-input" type="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>
        </div>
        <div class="form-group">
          <label class="form-label">New Password</label>
          <input class="form-input" type="password" name="password" required>
        </div>
        <div class="form-group">
          <label class="form-label">Phone</label>
          <input class="form-input" type="text" name="phone" value="<?= htmlspecialchars($client['phone']) ?>" required>
        </div>
        <div class="form-group">
          <label class="form-label">Address</label>
          <input class="form-input" type="text" name="address" value="<?= htmlspecialchars($clientData['address']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
      </form>
    </div>
  </div>
</main>

<footer class="site-footer" style="padding:24px 0;">
  <div class="container">
    <p style="text-align:center;font-size:14px;">&copy; <?= date('Y') ?> LuxeCart. All rights reserved.</p>
  </div>
</footer>

<script>window.isLoggedIn = true;</script>
<script src="/sotre_php_mvc/public/javascript/main.js"></script>
</body>
</html>
