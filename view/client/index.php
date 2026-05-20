<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Area | LuxeCart</title>
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
      <span style="font-size:14px;font-weight:500;color:var(--text);">Welcome back!</span>
      <form action="index.php?controller=user&action=logout" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <button class="btn btn-sm btn-outline">Sign Out</button>
      </form>
    </div>
  </div>
</header>

<main style="display:flex;align-items:center;justify-content:center;min-height:70vh;">
  <div class="container" style="text-align:center;max-width:500px;">
    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" style="margin:0 auto 24px">
      <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
    </svg>
    <h1 style="font-size:28px;font-weight:700;color:var(--dark);margin-bottom:8px;">Client Dashboard</h1>
    <p style="color:var(--text-muted);margin-bottom:32px;">Manage your account, view orders, and update preferences.</p>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
      <a href="index.php?controller=client&action=profile" class="btn btn-primary">My Profile</a>
      <a href="index.php?controller=home&action=index" class="btn btn-outline">Browse Store</a>
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
