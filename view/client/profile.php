<?php 
$client = $clientData ?? [];
$user = $_SESSION['user'] ?? [];

$cartItems = [];
$cartTotal = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $product = $this->productModel->getById($productId);
        if ($product) {
            $product['quantity'] = $quantity;
            $product['subtotal'] = $product['price'] * $quantity;
            $cartItems[] = $product;
            $cartTotal += $product['subtotal'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile | LuxeCart</title>
  <link rel="stylesheet" href="/sotre_php_mvc/public/css/main.css">
  <style>
    .profile-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-xl); box-shadow: var(--shadow-md); overflow: hidden; }
    .profile-avatar { width: 120px; height: 120px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: 700; flex-shrink: 0; }
    .info-card { border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; background: var(--bg); }
    .info-card h3 { font-size: 17px; font-weight: 600; color: var(--dark); margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
    .info-card h3 svg { color: var(--primary); flex-shrink: 0; }
    .info-row { margin-bottom: 12px; }
    .info-row .label { font-size: 13px; color: var(--text-muted); margin-bottom: 2px; }
    .info-row .value { font-size: 14px; color: var(--text); display: flex; align-items: center; gap: 8px; }
    .info-row .value svg { color: var(--primary); flex-shrink: 0; width: 14px; }
    .cart-item-row { display: flex; gap: 16px; align-items: center; padding: 16px; border-bottom: 1px solid var(--border); transition: background var(--transition); }
    .cart-item-row:hover { background: var(--bg); }
    .cart-item-row:last-child { border-bottom: none; }
    .cart-thumb { width: 72px; height: 72px; border-radius: var(--radius-md); background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
    .cart-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .empty-cart { text-align: center; padding: 48px 24px; }
    .empty-cart svg { color: var(--border-strong); margin-bottom: 16px; }
    .empty-cart p { color: var(--text-muted); font-size: 18px; margin-bottom: 20px; }
  </style>
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
      <a href="index.php?controller=client&action=profile" class="icon-btn" style="position:relative">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
          <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
        </svg>
        <?php if (!empty($cartItems)): ?>
        <span class="cart-badge"><?= array_sum(array_column($cartItems, 'quantity')) ?></span>
        <?php endif; ?>
      </a>
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

<main style="padding: 40px 0; min-height: 70vh;">
  <div class="container" style="max-width: 800px;">
    <div style="text-align:center;margin-bottom:40px">
      <h1 style="font-size:32px;font-weight:700;color:var(--dark);margin-bottom:4px;">My Profile</h1>
      <p style="color:var(--text-muted);">Manage your account details and preferences</p>
    </div>

    <div class="profile-card">
      <div style="padding:32px;">
        <div style="display:flex;flex-direction:column;gap:32px;margin-bottom:40px">
          <div style="display:flex;align-items:center;gap:24px;flex-wrap:wrap">
            <div class="profile-avatar">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div>
              <h2 style="font-size:22px;font-weight:700;color:var(--dark);"><?= htmlspecialchars($client['username'] ?? '') ?></h2>
              <p style="color:var(--text-muted);margin-top:4px;display:flex;align-items:center;gap:6px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <?= htmlspecialchars($client['email'] ?? '') ?>
              </p>
              <?php if (!empty($client['phone'])): ?>
              <p style="color:var(--text-muted);margin-top:4px;display:flex;align-items:center;gap:6px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <?= htmlspecialchars($client['phone']) ?>
              </p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">
          <div class="info-card">
            <h3>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              Account Details
            </h3>
            <?php if (!empty($client['address'])): ?>
            <div class="info-row">
              <div class="label">Address</div>
              <div class="value">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <?= htmlspecialchars($client['address']) ?>
              </div>
            </div>
            <?php endif; ?>
            <div class="info-row">
              <div class="label">Member Since</div>
              <div class="value">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <?= date('F Y', strtotime($user['created_at'] ?? 'now')) ?>
              </div>
            </div>
          </div>

          <div class="info-card">
            <h3>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
              Account Actions
            </h3>
            <div style="display:flex;flex-direction:column;gap:8px;">
              <a href="/sotre_php_mvc/index.php?controller=client&action=edit&id=<?= $client['user_id']?>" class="btn btn-outline btn-sm btn-block" style="justify-content:center">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Edit Profile
              </a>
              <form action="index.php?controller=user&action=logout" method="post">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <button type="submit" class="btn btn-sm btn-block" style="justify-content:center;background:transparent;color:var(--danger);border:1px solid var(--danger)">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                  Sign Out
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div style="margin-top:48px;">
      <h2 style="font-size:24px;font-weight:700;color:var(--dark);margin-bottom:24px;display:flex;align-items:center;gap:8px;">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        Your Shopping Cart
      </h2>
      <?php if (empty($cartItems)): ?>
      <div class="card empty-cart">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        <p>Your cart is empty</p>
        <a href="index.php?controller=home&action=index" class="btn btn-primary">Browse Products</a>
      </div>
      <?php else: ?>
      <div class="card">
        <?php foreach ($cartItems as $item): ?>
        <div class="cart-item-row">
          <div class="cart-thumb">
            <?php if (!empty($item['image_path'])): ?>
              <img src="/sotre_php_mvc/<?= htmlspecialchars($item['image_path']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
            <?php else: ?>
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <?php endif; ?>
          </div>
          <div style="flex:1;min-width:0">
            <h4 style="font-weight:600;color:var(--dark);font-size:15px;margin-bottom:2px;"><?= htmlspecialchars($item['name'] ?? 'No name') ?></h4>
            <p style="font-size:13px;color:var(--text-muted);"><?= htmlspecialchars(substr($item['description'] ?? '', 0, 60)) ?></p>
          </div>
          <div style="text-align:right;flex-shrink:0">
            <p style="font-weight:700;color:var(--primary);">$<?= number_format($item['subtotal'] ?? 0, 2) ?></p>
            <p style="font-size:12px;color:var(--text-muted);"><?= $item['quantity'] ?? 0 ?> x $<?= number_format($item['price'] ?? 0, 2) ?></p>
          </div>
          <button onclick="removeFromCart(<?= $item['id'] ?>)" style="color:var(--danger);background:none;border:none;cursor:pointer;padding:8px;flex-shrink:0">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
          </button>
        </div>
        <?php endforeach; ?>
        <div style="padding:20px 24px;background:var(--bg);border-top:1px solid var(--border);">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
            <span style="font-weight:600;font-size:16px;">Subtotal:</span>
            <span style="font-weight:700;font-size:20px;color:var(--primary);">$<?= number_format($cartTotal, 2) ?></span>
          </div>
          <div style="display:flex;gap:12px;justify-content:flex-end;flex-wrap:wrap">
            <a href="index.php?controller=home&action=index" class="btn btn-ghost btn-sm">Continue Shopping</a>
            <a href="index.php?controller=cart&action=checkout" class="btn btn-primary btn-sm">Proceed to Checkout</a>
          </div>
        </div>
      </div>
      <?php endif; ?>
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
