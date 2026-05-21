<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $mode === 'login' ? 'Sign In' : 'Create Account' ?> | LuxeCart</title>
  <link rel="stylesheet" href="/sotre_php_mvc/public/css/main.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
    .auth-page { display: flex; align-items: center; justify-content: center; padding: 100px 20px 40px; min-height: 100vh; }
    .auth-container { display: flex; width: 100%; max-width: 1100px; min-height: 620px; border-radius: 24px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.1); position: relative; background: var(--surface); }
    .form-side { flex: 1; background: var(--surface, #fff); padding: 48px; display: flex; flex-direction: column; justify-content: center; position: relative; z-index: 2; transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1); }
    .panel-side { flex: 1; background: linear-gradient(135deg, #6c3ce0, #3b82f6, #06b6d4); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 48px; position: relative; z-index: 2; transition: transform 0.6s cubic-bezier(0.22, 1, 0.36, 1); overflow: hidden; }
    .panel-side::before { content: ''; position: absolute; inset: 0; background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
    .floating-shapes { position: absolute; inset: 0; overflow: hidden; pointer-events: none; }
    .shape { position: absolute; border-radius: 50%; opacity: 0.12; }
    .shape:nth-child(1) { width: 200px; height: 200px; background: #fff; top: -40px; right: -40px; animation: float1 8s ease-in-out infinite; }
    .shape:nth-child(2) { width: 120px; height: 120px; background: #fff; bottom: 60px; left: -30px; animation: float2 10s ease-in-out infinite; }
    .shape:nth-child(3) { width: 80px; height: 80px; background: #fff; top: 40%; left: 20%; animation: float3 7s ease-in-out infinite; }
    .shape:nth-child(4) { width: 50px; height: 50px; background: #fff; bottom: 20%; right: 15%; animation: float1 9s ease-in-out infinite; }
    @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(20px,-30px) scale(1.1); } }
    @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-25px,20px) scale(1.15); } }
    @keyframes float3 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(15px,25px) scale(1.2); } }
    .panel-content { position: relative; z-index: 1; text-align: center; transition: opacity 0.5s ease, transform 0.5s ease; }
    .panel-content.hide { opacity: 0; transform: translateY(20px); pointer-events: none; position: absolute; }
    .panel-icon { width: 72px; height: 72px; background: rgba(255,255,255,0.15); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; backdrop-filter: blur(4px); }
    .panel-icon svg { width: 36px; height: 36px; stroke: #fff; }
    .panel-side h2 { font-size: 28px; font-weight: 700; margin-bottom: 12px; color: #fff; }
    .panel-side p { font-size: 15px; opacity: 0.85; line-height: 1.6; max-width: 340px; margin-bottom: 28px; color: #fff; }
    .panel-toggle { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); color: #fff; padding: 12px 32px; border-radius: 50px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; backdrop-filter: blur(4px); }
    .panel-toggle:hover { background: rgba(255,255,255,0.25); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.2); }
    .form-side h1 { font-size: 26px; font-weight: 700; margin-bottom: 6px; color: var(--text); }
    .form-side .subtitle { color: var(--text-muted); font-size: 14px; margin-bottom: 28px; }
    .form-box { transition: opacity 0.5s ease, transform 0.5s ease; }
    .form-box.hide { opacity: 0; transform: translateX(-30px); pointer-events: none; position: absolute; width: calc(100% - 96px); }
    .form-group { margin-bottom: 18px; }
    .form-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 6px; }
    .input-wrap { position: relative; }
    .input-wrap .icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: var(--text-muted); pointer-events: none; }
    .input-wrap input { width: 100%; padding: 12px 14px 12px 44px; background: var(--bg); border: 1px solid var(--border); border-radius: 12px; color: var(--text); font-size: 14px; outline: none; transition: border-color 0.3s; }
    .input-wrap input:focus { border-color: #6c3ce0; box-shadow: 0 0 0 3px rgba(108,60,224,0.1); }
    .input-wrap input::placeholder { color: var(--text-muted); }
    .pw-toggle { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer; padding: 0; width: 20px; height: 20px; }
    .pw-toggle:hover { color: var(--text); }
    .form-options { display: flex; justify-content: space-between; align-items: center; margin: 18px 0 24px; font-size: 13px; }
    .form-options label { display: flex; align-items: center; gap: 8px; color: var(--text-muted); cursor: pointer; }
    .form-options label input { width: 16px; height: 16px; accent-color: #6c3ce0; }
    .form-options a { color: #6c3ce0; text-decoration: none; font-weight: 500; }
    .form-options a:hover { text-decoration: underline; }
    .btn-submit { width: 100%; padding: 13px; border: none; border-radius: 12px; font-size: 15px; font-weight: 700; cursor: pointer; transition: all 0.3s ease; background: linear-gradient(135deg, #6c3ce0, #3b82f6); color: #fff; }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(108,60,224,0.35); }
    .name-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .terms-check { display: flex; align-items: flex-start; gap: 10px; margin: 18px 0 24px; font-size: 12px; color: var(--text-muted); }
    .terms-check input { width: 16px; height: 16px; accent-color: #6c3ce0; margin-top: 2px; flex-shrink: 0; }
    .terms-check a { color: #6c3ce0; }
    .auth-divider { display: flex; align-items: center; gap: 16px; margin: 22px 0; color: var(--text-muted); font-size: 12px; }
    .auth-divider::before, .auth-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
    .social-auth { display: flex; gap: 12px; }
    .social-auth button { flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px; padding: 10px; background: var(--bg); border: 1px solid var(--border); border-radius: 12px; color: var(--text); font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.3s; }
    .social-auth button:hover { background: var(--surface); border-color: var(--border); }
    .social-auth button svg { width: 18px; height: 18px; fill: currentColor; }
    .alert { padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 20px; text-align: center; }
    .alert-error { background: var(--danger-bg, #fef2f2); color: var(--danger, #dc2626); border: 1px solid var(--danger-border, #fecaca); }
    .alert-success { background: var(--success-bg, #f0fdf4); color: var(--success, #059669); border: 1px solid var(--success-border, #bbf7d0); }
    @media (max-width: 768px) {
      .auth-container { flex-direction: column; max-width: 480px; min-height: auto; }
      .form-side { padding: 32px 24px; }
      .panel-side { padding: 40px 24px; min-height: 260px; }
      .panel-side h2 { font-size: 22px; }
      .name-row { grid-template-columns: 1fr; }
      .form-box.hide { width: calc(100% - 48px); }
    }
    .auth-container.swapped .form-side { transform: translateX(0); }
    .auth-container.swapped .panel-side { transform: translateX(0); }
    @media (min-width: 769px) {
      .auth-container.swapped .form-side { transform: translateX(100%); }
      .auth-container.swapped .panel-side { transform: translateX(-100%); }
    }
  </style>
  <script>if(localStorage.getItem('theme')==='dark')document.documentElement.setAttribute('data-theme','dark');</script>
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <a href="/sotre_php_mvc" class="logo">
      <svg class="logo-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
      </svg>
      <div><div class="logo-text">LuxeCart</div><div class="logo-sub">Premium quality for everyone</div></div>
    </a>
    <nav class="main-nav">
      <a href="/sotre_php_mvc">Home</a>
      <a href="/sotre_php_mvc#products">Products</a>
      <a href="/sotre_php_mvc#collections">Collections</a>
    </nav>
    <div class="header-actions">
      <button id="themeToggle" class="icon-btn" aria-label="Toggle theme">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
      </button>
      <?php if ($mode === 'login'): ?>
      <a href="index.php?controller=user&action=register" class="btn btn-sm btn-primary">Register</a>
      <?php else: ?>
      <a href="index.php?controller=user&action=showLogin" class="btn btn-sm btn-ghost">Sign In</a>
      <?php endif; ?>
    </div>
  </div>
</header>

<div class="auth-page">
<div class="auth-container" id="authContainer">
  <div class="form-side">

    <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?><?php unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-error" id="errorAlert"><?= htmlspecialchars($_SESSION['error']) ?><?php unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="form-box" id="loginForm">
      <h1>Welcome Back</h1>
      <p class="subtitle">Sign in to access your account</p>
      <form action="index.php?controller=user&action=login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="form-group">
          <label>Email Address</label>
          <div class="input-wrap">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <input type="email" name="email" required placeholder="you@example.com">
          </div>
        </div>
        <div class="form-group">
          <label>Password</label>
          <div class="input-wrap">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <input type="password" name="password" id="loginPass" required placeholder="Enter your password">
            <button type="button" class="pw-toggle" onclick="togglePW('loginPass',this)" aria-label="Toggle password">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>
        <div class="form-options">
          <label><input type="checkbox" name="remember"> Remember me</label>
          <a href="#">Forgot password?</a>
        </div>
        <button class="btn-submit" type="submit">Sign In</button>
      </form>
    </div>

    <div class="form-box hide" id="registerForm">
      <h1>Create Your Account</h1>
      <p class="subtitle">Join 50,000+ happy shoppers</p>
      <form action="index.php?controller=client&action=StoreClient" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="form-group">
          <label>Full Name</label>
          <div class="input-wrap">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <input type="text" name="name" required placeholder="John Doe">
          </div>
        </div>
        <div class="form-group">
          <label>Email Address</label>
          <div class="input-wrap">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <input type="email" name="email" required placeholder="you@example.com">
          </div>
        </div>
        <div class="form-group">
          <label>Password</label>
          <div class="input-wrap">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <input type="password" name="password" id="regPass" required placeholder="At least 6 characters" minlength="6">
            <button type="button" class="pw-toggle" onclick="togglePW('regPass',this)" aria-label="Toggle password">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>
        <div class="name-row">
          <div class="form-group">
            <label>Phone</label>
            <div class="input-wrap">
              <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <input type="text" name="phone" placeholder="+1 (555) 000-0000">
            </div>
          </div>
          <div class="form-group">
            <label>Address</label>
            <div class="input-wrap">
              <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <input type="text" name="address" placeholder="123 Main St, City">
            </div>
          </div>
        </div>
        <div class="terms-check">
          <input type="checkbox" id="terms" required>
          <label for="terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</label>
        </div>
        <button class="btn-submit" type="submit">Create Account</button>
      </form>
      <div class="auth-divider">or sign up with</div>
      <div class="social-auth">
        <button><svg viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg> Google</button>
        <button><svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg> Facebook</button>
      </div>
    </div>
  </div>

  <div class="panel-side" id="panel">
    <div class="floating-shapes">
      <div class="shape"></div>
      <div class="shape"></div>
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
    <div class="panel-content" id="panelLogin">
      <div class="panel-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
      </div>
      <h2>Welcome Back!</h2>
      <p>Sign in to your account to access your orders, wishlist, and personalized recommendations.</p>
      <button class="panel-toggle" onclick="toggleAuth()">Create an Account →</button>
    </div>
    <div class="panel-content hide" id="panelRegister">
      <div class="panel-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>
      </div>
      <h2>New Here?</h2>
      <p>Create an account and get 10% off your first order. Join 50,000+ happy customers worldwide.</p>
      <button class="panel-toggle" onclick="toggleAuth()">← Sign In</button>
    </div>
  </div>
</div>
</div>

<script>
var container = document.getElementById('authContainer');
var loginForm = document.getElementById('loginForm');
var regForm = document.getElementById('registerForm');
var panelLogin = document.getElementById('panelLogin');
var panelReg = document.getElementById('panelRegister');
var isLogin = true;

<?php if ($mode === 'register'): ?>
isLogin = false;
container.classList.add('swapped');
loginForm.classList.add('hide');
regForm.classList.remove('hide');
panelLogin.classList.add('hide');
panelReg.classList.remove('hide');
<?php endif; ?>

function toggleAuth() {
  isLogin = !isLogin;
  container.classList.toggle('swapped');
  loginForm.classList.toggle('hide');
  regForm.classList.toggle('hide');
  panelLogin.classList.toggle('hide');
  panelReg.classList.toggle('hide');
  var err = document.getElementById('errorAlert');
  if (err) err.style.display = 'none';
}

function togglePW(id, btn) {
  var inp = document.getElementById(id);
  var isPW = inp.type === 'password';
  inp.type = isPW ? 'text' : 'password';
  btn.innerHTML = isPW
    ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>'
    : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
}
</script>
<script src="/sotre_php_mvc/public/javascript/main.js"></script>
</body>
</html>