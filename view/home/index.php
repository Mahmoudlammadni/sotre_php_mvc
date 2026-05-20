<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LuxeCart | Premium Online Store</title>
  <link rel="stylesheet" href="/sotre_php_mvc/public/css/main.css">
  <style>
    .toast { position: fixed; bottom: 80px; left: 50%; transform: translateX(-50%); background: #1e293b; color: #fff; padding: 12px 24px; border-radius: 8px; font-size: 14px; font-weight: 500; box-shadow: 0 8px 24px rgba(0,0,0,0.2); z-index: 9999; opacity: 0; transition: opacity 0.3s ease; }
    @keyframes pop { 0% { transform: scale(1); } 50% { transform: scale(1.3); } 100% { transform: scale(1); } }
    #cartCount.pop { animation: pop 0.3s ease; }
    #mobileNav { position: fixed; top: 0; right: -300px; width: 280px; height: 100vh; background: var(--surface); z-index: 200; padding: 24px; transition: right 0.3s ease; box-shadow: var(--shadow-xl); }
    #mobileNav.open { right: 0; }
    #mobileNav a { display: block; padding: 12px 0; font-size: 16px; font-weight: 500; color: var(--text); border-bottom: 1px solid var(--border); }
    #mobileOverlay { position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 150; opacity: 0; visibility: hidden; transition: opacity 0.3s ease; }
    #mobileOverlay.open { opacity: 1; visibility: visible; }
    .hero { min-height: 100vh; }
    @keyframes heroBg { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
    .hero { background: linear-gradient(-45deg, #2563eb, #7c3aed, #ec4899, #2563eb); background-size: 400% 400%; animation: heroBg 12s ease infinite; }
  </style>
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <a href="/sotre_php_mvc" class="logo">
      <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
      </svg>
      <div>
        <div class="logo-text">LuxeCart</div>
        <div class="logo-sub">Premium quality for everyone</div>
      </div>
    </a>
    <nav class="main-nav">
      <a href="/sotre_php_mvc">Home</a>
      <a href="#products">Products</a>
      <a href="#trending">Trending</a>
      <a href="#collections">Collections</a>
      <a href="#about">About</a>
      <a href="#blog">Blog</a>
    </nav>
    <div class="header-actions">
      <button id="themeToggle" class="icon-btn" aria-label="Toggle theme">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
      </button>
      <?php if (isset($_SESSION['user'])): ?>
      <div class="user-menu" data-dropdown>
        <button class="user-btn" data-dropdown-btn>
          <div class="user-avatar"><?= strtoupper(substr($_SESSION['user']['username'], 0, 1)) ?></div>
          <span class="user-name"><?= htmlspecialchars($_SESSION['user']['username']) ?></span>
          <svg class="chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="dropdown" data-dropdown-menu>
          <a href="index.php?controller=client&action=profile">My Profile</a>
          <div class="dropdown-divider"></div>
          <form action="index.php?controller=user&action=logout" method="post"><input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"><button type="submit">Sign Out</button></form>
        </div>
      </div>
      <?php else: ?>
      <a href="index.php?controller=user&action=showLogin" class="btn btn-sm btn-ghost">Sign In</a>
      <a href="index.php?controller=user&action=register" class="btn btn-sm btn-primary">Register</a>
      <?php endif; ?>
      <a href="index.php?controller=client&action=profile" class="icon-btn" style="position:relative">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
        <span class="cart-badge" id="cartCount" style="display:none">0</span>
      </a>
      <button id="mobileMenuBtn" class="icon-btn mobile-menu-btn" aria-label="Menu">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
    </div>
  </div>
</header>

<div id="mobileOverlay"></div>
<nav id="mobileNav">
  <a href="/sotre_php_mvc">Home</a>
  <a href="#products">Products</a>
  <a href="#trending">Trending</a>
  <a href="#collections">Collections</a>
  <a href="#about">About</a>
  <a href="#blog">Blog</a>
  <?php if (isset($_SESSION['user'])): ?>
  <a href="index.php?controller=client&action=profile">My Profile</a>
  <a href="index.php?controller=user&action=logout">Sign Out</a>
  <?php else: ?>
  <a href="index.php?controller=user&action=showLogin">Sign In</a>
  <a href="index.php?controller=user&action=register">Register</a>
  <?php endif; ?>
</nav>

<section class="hero">
  <div class="hero-content fade-in">
    <h1>Elevate Your Shopping Experience</h1>
    <p>Discover premium products curated for quality and style. Free shipping on orders over $50. Join 50,000+ happy customers.</p>
    <div class="hero-buttons">
      <a href="#products" class="btn btn-primary btn-lg">Shop Now</a>
      <a href="#collections" class="btn btn-secondary btn-lg">View Collections</a>
    </div>
  </div>
  <div class="scroll-indicator" onclick="document.getElementById('flashSale').scrollIntoView({behavior:'smooth'})">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
  </div>
</section>

<section class="flash-sale" id="flashSale">
  <div class="container flash-sale-inner">
    <span class="flash-sale-tag">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;margin-right:4px"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
      FLASH SALE
    </span>
    <span class="flash-sale-text">50% OFF everything — limited time only!</span>
    <div class="flash-countdown" id="flashCountdown"></div>
    <a href="#products" class="flash-cta">Shop Sale</a>
  </div>
</section>

<section id="trending" class="trending-strip">
  <div class="container">
    <h2 class="section-title fade-in-up" style="font-size:22px;margin-bottom:4px">🔥 Trending Now</h2>
    <p class="section-subtitle fade-in-up" style="margin-bottom:20px">Most wanted items this week</p>
  </div>
  <?php
  $trendSeeds = ['wireless-earbuds','smart-ring','leather-wallet','yoga-mat','protein-shaker','desk-lamp','plant-pot','coffee-mug'];
  $trendNames = ['Wireless Earbuds','Smart Ring','Leather Wallet','Yoga Mat','Protein Shaker','Desk Lamp','Plant Pot','Coffee Mug'];
  $trendPrices = [79.99, 149.99, 49.99, 29.99, 24.99, 39.99, 19.99, 14.99];
  ?>
  <div class="container">
    <div class="trending-scroll">
      <?php for ($t = 0; $t < 8; $t++): ?>
      <div class="trending-item">
        <div class="thumb"><img src="https://picsum.photos/seed/<?= $trendSeeds[$t] ?>/200/200" alt="<?= $trendNames[$t] ?>" loading="lazy"></div>
        <h4><?= $trendNames[$t] ?></h4>
        <span class="price">$<?= number_format($trendPrices[$t], 2) ?></span>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<section id="products" class="section products-carousel">
  <div class="container">
    <div class="carousel-header fade-in-up">
      <h2 class="section-title" style="margin-bottom:0;">Featured Products</h2>
      <p class="section-subtitle" style="margin:4px auto 0">Our most popular items loved by customers worldwide</p>
    </div>
  </div>
  <div class="carousel-wrapper fade-in">
    <div class="carousel-track">
      <?php
      $prodImgs = ['headphones','watch','bag','shoes','camera','perfume','sunglasses','backpack'];
      $i = 0;
      ?>
      <?php for ($rep = 0; $rep < 3; $rep++): ?>
      <?php foreach ($products as $product): ?>
      <div class="product-card">
        <div class="product-card-image">
          <img src="https://picsum.photos/seed/<?= $prodImgs[$i % count($prodImgs)] ?>/400/400" alt="<?= htmlspecialchars($product['name']) ?>" loading="lazy">
          <span class="badge badge-primary product-badge">Bestseller</span>
        </div>
        <div class="product-card-body">
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <p class="desc"><?= htmlspecialchars(substr($product['description'], 0, 80)) ?>...</p>
          <div class="product-card-footer">
            <span class="product-price">$<?= number_format($product['price'], 2) ?></span>
            <span class="product-stock"><?= $product['quantity'] ?> in stock</span>
          </div>
          <button class="btn btn-primary btn-sm btn-block mt-8" data-add-to-cart="<?= $product['id'] ?>">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            Add to Cart
          </button>
        </div>
      </div>
      <?php $i++; endforeach; ?>
      <?php endfor; ?>
    </div>
  </div>
  <div class="carousel-dots"></div>
</section>

<section class="section limited-offers">
  <div class="container">
    <h2 class="section-title fade-in-up">⏳ Limited Time Offers</h2>
    <p class="section-subtitle fade-in-up">Grab these deals before they're gone</p>
    <div class="limited-grid stagger">
      <?php
      $offerNames = ['Premium Headphones Bundle', 'Smartwatch Pro', 'Designer Backpack'];
      $offerImgs = ['headphones-bundle', 'smartwatch-pro', 'backpack-design'];
      $offerPrices = [199.99, 299.99, 89.99];
      $offerOld = [349.99, 499.99, 149.99];
      $offerHours = [8, 14, 6];
      ?>
      <?php for ($o = 0; $o < 3; $o++): ?>
      <div class="card fade-in-up">
        <div style="aspect-ratio:4/3;overflow:hidden;background:#f1f5f9;">
          <img src="https://picsum.photos/seed/<?= $offerImgs[$o] ?>/400/300" alt="<?= $offerNames[$o] ?>" style="width:100%;height:100%;object-fit:cover" loading="lazy">
        </div>
        <div style="padding:20px">
          <h3 style="font-size:17px;font-weight:600;color:var(--dark);margin-bottom:4px"><?= $offerNames[$o] ?></h3>
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px">
            <span style="font-size:22px;font-weight:800;color:var(--danger)">$<?= number_format($offerPrices[$o], 2) ?></span>
            <span style="font-size:14px;color:var(--text-muted);text-decoration:line-through">$<?= number_format($offerOld[$o], 2) ?></span>
            <span class="badge badge-danger">-<?= round((1 - $offerPrices[$o]/$offerOld[$o])*100) ?>%</span>
          </div>
          <div class="offer-countdown" data-hours="<?= $offerHours[$o] ?>"></div>
          <button class="btn btn-primary btn-sm btn-block mt-8" data-add-to-cart="<?= $o + 100 ?>">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            Grab Deal
          </button>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<section class="section" id="collections">
  <div class="container">
    <h2 class="section-title fade-in-up">Shop by Category</h2>
    <p class="section-subtitle fade-in-up">Find exactly what you're looking for</p>
    <div class="category-grid stagger">
      <div class="category-card fade-in-up">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
        <h3>Electronics</h3><p>Gadgets & gear</p>
      </div>
      <div class="category-card fade-in-up">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
        <h3>Fashion</h3><p>Trending styles</p>
      </div>
      <div class="category-card fade-in-up">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        <h3>Accessories</h3><p>Complete your look</p>
      </div>
      <div class="category-card fade-in-up">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
        <h3>Home & Living</h3><p>Beautiful spaces</p>
      </div>
      <div class="category-card fade-in-up">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
        <h3>Sports</h3><p>Active lifestyle</p>
      </div>
      <div class="category-card fade-in-up">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        <h3>Beauty</h3><p>Look your best</p>
      </div>
      <div class="category-card fade-in-up">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        <h3>Books</h3><p>Knowledge awaits</p>
      </div>
      <div class="category-card fade-in-up">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
        <h3>Electronics</h3><p>Screen time</p>
      </div>
    </div>
  </div>
</section>

<section class="brand-showcase">
  <div class="container">
    <h2 class="section-title fade-in-up" style="font-size:20px;margin-bottom:0">Brands We Love</h2>
  </div>
  <div class="brand-track">
    <?php for ($b = 1; $b <= 8; $b++): ?>
    <div class="brand-item">
      <svg viewBox="0 0 100 40"><rect x="5" y="5" width="90" height="30" rx="4" fill="none" stroke="currentColor" stroke-width="1.5"/><text x="50" y="27" text-anchor="middle" font-size="14" font-weight="700" fill="currentColor">BRAND <?= $b ?></text></svg>
    </div>
    <?php endfor; ?>
  </div>
</section>

<section class="section customer-favorites">
  <div class="container">
    <h2 class="section-title fade-in-up">⭐ Customer Favorites</h2>
    <p class="section-subtitle fade-in-up">Top-rated products our customers love</p>
    <div class="fav-grid stagger">
      <?php
      $favImgs = ['laptop','tablet','speaker','mouse','keyboard','monitor','chair','desk'];
      $i2 = 0;
      ?>
      <?php for ($f = 0; $f < 2; $f++): ?>
      <?php foreach ($products as $product): ?>
      <div class="product-card fade-in-up" style="min-width:0">
        <div class="product-card-image">
          <img src="https://picsum.photos/seed/<?= $favImgs[$i2 % count($favImgs)] ?>/400/400" alt="<?= htmlspecialchars($product['name']) ?>" loading="lazy">
          <span class="badge badge-success product-badge" style="background:var(--success-bg);color:var(--success);left:auto;right:12px">4.8 ★</span>
        </div>
        <div class="product-card-body">
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <p class="desc"><?= htmlspecialchars(substr($product['description'], 0, 60)) ?>...</p>
          <div class="product-card-footer">
            <span class="product-price">$<?= number_format($product['price'], 2) ?></span>
          </div>
          <button class="btn btn-outline btn-sm btn-block mt-8" data-add-to-cart="<?= $product['id'] ?>">Add to Cart</button>
        </div>
      </div>
      <?php $i2++; endforeach; ?>
      <?php endfor; ?>
    </div>
  </div>
</section>

<section class="section about-section" id="about">
  <div class="container">
    <div class="about-content">
      <div class="about-text fade-in-up">
        <h2>Our Story — Quality You Can Trust</h2>
        <p>Founded in 2020, LuxeCart started with a simple mission: bring premium products to everyone at fair prices. We partner directly with artisans and manufacturers to ensure every item meets our high standards of quality.</p>
        <p>Today we serve over 50,000 happy customers worldwide, with a 99% satisfaction rate. Every order is hand-packed with care and shipped within 24 hours.</p>
        <a href="#" class="btn btn-outline">Learn More</a>
      </div>
      <div class="about-image slide-in-right">
        <img src="https://picsum.photos/seed/warehouse/600/400" alt="Our warehouse" loading="lazy">
      </div>
    </div>
    <div class="stats-grid stagger">
      <div class="stat-item fade-in-up"><div class="stat-number" data-target="50000">0</div><div class="stat-label">Happy Customers</div></div>
      <div class="stat-item fade-in-up"><div class="stat-number" data-target="15000">0</div><div class="stat-label">Products Sold</div></div>
      <div class="stat-item fade-in-up"><div class="stat-number" data-target="5">0</div><div class="stat-label">Years Experience</div></div>
      <div class="stat-item fade-in-up"><div class="stat-number" data-target="98">0</div><div class="stat-label">5-Star Reviews (%)</div></div>
    </div>
  </div>
</section>

<section class="section testimonials">
  <div class="container">
    <h2 class="section-title fade-in-up">What Our Customers Say</h2>
    <p class="section-subtitle fade-in-up">Trusted by thousands of happy customers worldwide</p>
    <div class="testimonial-slider fade-in">
      <div class="testimonial-track">
        <div class="testimonial-card"><div class="stars">★★★★★</div><blockquote>"The quality exceeded my expectations. Fast shipping and premium packaging. Already placed my second order!"</blockquote><div class="testimonial-author"><div class="avatar">S</div><div><h4>Sarah Johnson</h4><span>Verified Buyer</span></div></div></div>
        <div class="testimonial-card"><div class="stars">★★★★★</div><blockquote>"Excellent customer service! They helped me choose the perfect product. Highly recommend this store."</blockquote><div class="testimonial-author"><div class="avatar">M</div><div><h4>Michael Chen</h4><span>Verified Buyer</span></div></div></div>
        <div class="testimonial-card"><div class="stars">★★★★★</div><blockquote>"I've ordered multiple times and never been disappointed. Quality is consistent and prices are fair."</blockquote><div class="testimonial-author"><div class="avatar">E</div><div><h4>Emma Rodriguez</h4><span>Verified Buyer</span></div></div></div>
        <div class="testimonial-card"><div class="stars">★★★★★</div><blockquote>"Best online shopping experience I've ever had. The packaging alone shows how much they care."</blockquote><div class="testimonial-author"><div class="avatar">D</div><div><h4>David Kim</h4><span>Verified Buyer</span></div></div></div>
        <div class="testimonial-card"><div class="stars">★★★★½</div><blockquote>"Fast delivery worldwide! I'm in Australia and my order arrived in 4 days. Incredible service."</blockquote><div class="testimonial-author"><div class="avatar">L</div><div><h4>Lisa Thompson</h4><span>Verified Buyer</span></div></div></div>
      </div>
      <div class="testimonial-controls">
        <button class="carousel-dot active"></button>
        <button class="carousel-dot"></button>
        <button class="carousel-dot"></button>
        <button class="carousel-dot"></button>
        <button class="carousel-dot"></button>
      </div>
    </div>
  </div>
</section>

<section class="section blog-section" id="blog">
  <div class="container">
    <h2 class="section-title fade-in-up">📝 Latest from Our Blog</h2>
    <p class="section-subtitle fade-in-up">Tips, trends, and stories from the LuxeCart team</p>
    <div class="blog-grid stagger">
      <div class="blog-card fade-in-up">
        <div class="blog-card-image"><img src="https://picsum.photos/seed/blog1/600/340" alt="Blog" loading="lazy"></div>
        <div class="blog-card-body">
          <div class="date">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            May 15, 2026
          </div>
          <h3>10 Must-Have Gadgets for 2026</h3>
          <p>Discover the top tech trends shaping this year. From AI-powered devices to sustainable innovations.</p>
          <a href="#" class="read-more">Read More
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>
        </div>
      </div>
      <div class="blog-card fade-in-up">
        <div class="blog-card-image"><img src="https://picsum.photos/seed/blog2/600/340" alt="Blog" loading="lazy"></div>
        <div class="blog-card-body">
          <div class="date">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            May 8, 2026
          </div>
          <h3>How to Style Your Home on a Budget</h3>
          <p>Transform your living space without breaking the bank. Simple tips for a magazine-worthy home.</p>
          <a href="#" class="read-more">Read More
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>
        </div>
      </div>
      <div class="blog-card fade-in-up">
        <div class="blog-card-image"><img src="https://picsum.photos/seed/blog3/600/340" alt="Blog" loading="lazy"></div>
        <div class="blog-card-body">
          <div class="date">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            Apr 28, 2026
          </div>
          <h3>The Ultimate Gift Guide for Every Occasion</h3>
          <p>Finding the perfect gift is easy with our curated selection for birthdays, holidays, and more.</p>
          <a href="#" class="read-more">Read More
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section features">
  <div class="container">
    <div class="features-grid">
      <div class="feature-item fade-in-up">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        <h4>Secure Payments</h4><p>SSL Encrypted checkout</p>
      </div>
      <div class="feature-item fade-in-up">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        <h4>Fast Shipping</h4><p>Worldwide delivery</p>
      </div>
      <div class="feature-item fade-in-up">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
        <h4>Easy Returns</h4><p>30-day return policy</p>
      </div>
      <div class="feature-item fade-in-up">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <h4>24/7 Support</h4><p>Dedicated team</p>
      </div>
    </div>
  </div>
</section>

<section class="section faq-section">
  <div class="container">
    <h2 class="section-title fade-in-up">❓ Frequently Asked Questions</h2>
    <p class="section-subtitle fade-in-up">Everything you need to know</p>
    <div class="faq-list fade-in-up">
      <div class="faq-item">
        <button class="faq-question">
          What payment methods do you accept?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </button>
        <div class="faq-answer">We accept Visa, Mastercard, American Express, PayPal, Apple Pay, Google Pay, and bank transfers. All payments are processed securely with SSL encryption.</div>
      </div>
      <div class="faq-item">
        <button class="faq-question">
          How long does shipping take?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </button>
        <div class="faq-answer">Domestic orders arrive within 3-5 business days. International shipping takes 7-14 business days. Express shipping is available at checkout for 1-2 day delivery.</div>
      </div>
      <div class="faq-item">
        <button class="faq-question">
          What is your return policy?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </button>
        <div class="faq-answer">We offer a 30-day hassle-free return policy on all unused items. Simply contact our support team for a free return label. Refunds are processed within 5-7 business days.</div>
      </div>
      <div class="faq-item">
        <button class="faq-question">
          Do you offer international shipping?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </button>
        <div class="faq-answer">Yes! We ship to over 48 countries worldwide. International shipping rates are calculated at checkout based on destination and package weight. Free shipping on orders over $100.</div>
      </div>
      <div class="faq-item">
        <button class="faq-question">
          How can I track my order?
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </button>
        <div class="faq-answer">Once your order ships, you'll receive a tracking number via email. You can also track your order in real-time from your account dashboard under "My Orders."</div>
      </div>
    </div>
  </div>
</section>

<section class="section instagram-gallery">
  <div class="container">
    <h2 class="section-title fade-in-up">📸 Follow Us on Instagram</h2>
    <p class="section-subtitle fade-in-up">@luxecart_official — Tag us for a chance to be featured</p>
    <div class="insta-grid stagger">
      <div class="insta-item fade-in-up"><img src="https://picsum.photos/seed/insta1/400/400" alt="Instagram" loading="lazy"><div class="overlay">❤️ 2.4K</div></div>
      <div class="insta-item fade-in-up"><img src="https://picsum.photos/seed/insta2/400/400" alt="Instagram" loading="lazy"><div class="overlay">❤️ 1.8K</div></div>
      <div class="insta-item fade-in-up"><img src="https://picsum.photos/seed/insta3/400/400" alt="Instagram" loading="lazy"><div class="overlay">❤️ 3.1K</div></div>
      <div class="insta-item fade-in-up"><img src="https://picsum.photos/seed/insta4/400/400" alt="Instagram" loading="lazy"><div class="overlay">❤️ 2.7K</div></div>
      <div class="insta-item fade-in-up"><img src="https://picsum.photos/seed/insta5/400/400" alt="Instagram" loading="lazy"><div class="overlay">❤️ 1.2K</div></div>
      <div class="insta-item fade-in-up"><img src="https://picsum.photos/seed/insta6/400/400" alt="Instagram" loading="lazy"><div class="overlay">❤️ 4.5K</div></div>
    </div>
  </div>
</section>

<section class="newsletter">
  <div class="container">
    <h2 class="fade-in-up">Join Our Community</h2>
    <p class="fade-in-up">Subscribe for exclusive offers, product updates, and 10% off your first order</p>
    <form class="newsletter-form fade-in-up" onsubmit="event.preventDefault();showToast('Thanks! Check your email for 10% off.');this.reset()">
      <input type="email" placeholder="Enter your email address" required>
      <button type="submit" class="btn btn-accent">Subscribe</button>
    </form>
  </div>
</section>

<section class="payment-strip">
  <div class="container payment-strip-inner">
    <span>🔒 100% Secure Checkout</span>
    <div class="pmt-icons">
      <svg viewBox="0 0 100 60"><rect x="2" y="2" width="96" height="56" rx="6" fill="none" stroke="currentColor" stroke-width="1.5"/><text x="50" y="32" text-anchor="middle" font-size="22" font-weight="700" fill="currentColor" font-family="serif">VISA</text><text x="50" y="50" text-anchor="middle" font-size="8" fill="currentColor" letter-spacing="2">ELECTRON</text></svg>
      <svg viewBox="0 0 100 60"><rect x="2" y="2" width="96" height="56" rx="6" fill="none" stroke="currentColor" stroke-width="1.5"/><text x="50" y="36" text-anchor="middle" font-size="18" font-weight="700" fill="currentColor" font-family="serif">MC</text></svg>
      <svg viewBox="0 0 100 60"><rect x="2" y="2" width="96" height="56" rx="6" fill="none" stroke="currentColor" stroke-width="1.5"/><text x="50" y="36" text-anchor="middle" font-size="14" font-weight="700" fill="currentColor">PayPal</text></svg>
      <svg viewBox="0 0 100 60"><rect x="2" y="2" width="96" height="56" rx="6" fill="none" stroke="currentColor" stroke-width="1.5"/><circle cx="38" cy="30" r="16" stroke="currentColor" stroke-width="1.5" fill="none"/><circle cx="62" cy="30" r="16" stroke="currentColor" stroke-width="1.5" fill="none"/></svg>
      <svg viewBox="0 0 100 60"><rect x="2" y="2" width="96" height="56" rx="6" fill="none" stroke="currentColor" stroke-width="1.5"/><text x="50" y="36" text-anchor="middle" font-size="14" font-weight="700" fill="currentColor">AMEX</text></svg>
    </div>
    <span>🔐 SSL Encrypted</span>
  </div>
</section>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-col">
        <div class="logo" style="margin-bottom:16px">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          <span style="color:#fff;font-size:20px;font-weight:700">LuxeCart</span>
        </div>
        <p>Premium quality products for everyone. We're committed to excellence in every detail.</p>
        <div class="footer-contact" style="margin-top:16px">
          <p><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> hello@luxecart.com</p>
          <p><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> +1 (555) 123-4567</p>
          <p><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg> 123 Commerce St, New York, NY</p>
        </div>
        <div class="social-links" style="margin-top:16px">
          <a href="#" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
          <a href="#" aria-label="Twitter"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg></a>
          <a href="#" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
          <a href="#" aria-label="YouTube"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.94 2C5.12 20 12 20 12 20s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg></a>
        </div>
      </div>
      <div class="footer-col"><h4>Shop</h4><ul><li><a href="#">All Products</a></li><li><a href="#">New Arrivals</a></li><li><a href="#">Featured</a></li><li><a href="#">Bestsellers</a></li><li><a href="#">Special Offers</a></li></ul></div>
      <div class="footer-col"><h4>Company</h4><ul><li><a href="#">About Us</a></li><li><a href="#">Our Story</a></li><li><a href="#">Careers</a></li><li><a href="#">Press</a></li><li><a href="#">Contact</a></li></ul></div>
      <div class="footer-col"><h4>Help</h4><ul><li><a href="#">FAQs</a></li><li><a href="#">Shipping & Returns</a></li><li><a href="#">Track Order</a></li><li><a href="#">Privacy Policy</a></li><li><a href="#">Terms of Service</a></li></ul></div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2026 LuxeCart. All rights reserved.</p>
      <div class="footer-bottom-links"><a href="#">Privacy</a><a href="#">Terms</a><a href="#">Cookies</a><a href="#">Accessibility</a></div>
    </div>
  </div>
</footer>

<button id="backToTop" class="back-to-top" aria-label="Back to top">
  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
</button>

<script>window.isLoggedIn = <?= isset($_SESSION['user']) ? 'true' : 'false' ?>;</script>
<script src="/sotre_php_mvc/public/javascript/main.js"></script>
</body>
</html>
