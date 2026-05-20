<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In | LuxeCart</title>
  <link rel="stylesheet" href="/sotre_php_mvc/public/css/main.css">
  <style>
    .auth-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; background: var(--bg); padding: 80px 20px 40px; }
    .auth-card { width: 100%; max-width: 440px; padding: 40px; }
    .auth-header { text-align: center; margin-bottom: 32px; }
    .auth-header .logo-wrap { display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 20px; text-decoration: none; }
    .auth-header h1 { font-size: 24px; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
    .auth-header p { color: var(--text-muted); font-size: 14px; }
    .input-icon-wrap { position: relative; }
    .input-icon-wrap .input-icon {
      position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
      color: var(--text-muted); width: 18px; height: 18px; pointer-events: none;
    }
    .input-icon-wrap .form-input { padding-left: 44px; }
    .auth-options { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; font-size: 14px; }
    .auth-options label { display: flex; align-items: center; gap: 8px; color: var(--text-muted); cursor: pointer; }
    .auth-options label input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--primary); }
    .auth-options a { color: var(--primary); font-weight: 500; }
    .auth-options a:hover { text-decoration: underline; }
    .auth-divider { display: flex; align-items: center; gap: 16px; margin: 24px 0; color: var(--text-muted); font-size: 13px; }
    .auth-divider::before, .auth-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }
    .social-auth { display: flex; gap: 12px; }
    .social-auth button {
      flex: 1; display: flex; align-items: center; justify-content: center; gap: 8px;
      padding: 10px; border: 1px solid var(--border); border-radius: var(--radius-md);
      background: var(--surface); cursor: pointer; font-size: 13px; font-weight: 500; color: var(--text);
      transition: background var(--transition), border-color var(--transition);
    }
    .social-auth button:hover { background: var(--bg); border-color: var(--border-strong); }
    .auth-footer { text-align: center; margin-top: 24px; font-size: 14px; color: var(--text-muted); }
    .auth-footer a { color: var(--primary); font-weight: 600; }
    .auth-footer a:hover { text-decoration: underline; }
    .password-toggle { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer; padding: 0; width: 20px; height: 20px; }
    .password-toggle:hover { color: var(--text); }
  </style>
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
    <div class="header-actions">
      <button id="themeToggle" class="icon-btn" aria-label="Toggle theme">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
      </button>
      <a href="index.php?controller=user&action=register" class="btn btn-sm btn-primary">Register</a>
    </div>
  </div>
</header>

<div class="auth-page">
  <div class="card auth-card">
    <div class="auth-header">
      <a href="/sotre_php_mvc" class="logo-wrap">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
        </svg>
        <span style="font-size:22px;font-weight:700;color:var(--dark)">LuxeCart</span>
      </a>
      <h1>Welcome Back</h1>
      <p>Sign in to access your account</p>
      <?php if (isset($_SESSION['success'])): ?>
      <div style="background:var(--success-bg);color:var(--success);padding:12px 16px;border-radius:var(--radius-md);font-size:14px;margin-bottom:20px;text-align:center">
        <?= htmlspecialchars($_SESSION['success']) ?>
        <?php unset($_SESSION['success']); ?>
      </div>
      <?php endif; ?>
      <?php if (isset($_SESSION['error'])): ?>
      <div style="background:var(--danger-bg);color:var(--danger);padding:12px 16px;border-radius:var(--radius-md);font-size:14px;margin-bottom:20px;text-align:center">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <?php unset($_SESSION['error']); ?>
      </div>
      <?php endif; ?>
    </div>

    <form action="index.php?controller=user&action=login" method="POST">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <div class="input-icon-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          <input class="form-input" type="email" name="email" required placeholder="you@example.com">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <div class="input-icon-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          <input class="form-input" type="password" name="password" id="loginPassword" required placeholder="Enter your password">
          <button type="button" class="password-toggle" onclick="togglePassword('loginPassword',this)" aria-label="Toggle password visibility">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
          </button>
        </div>
      </div>
      <div class="auth-options">
        <label><input type="checkbox" name="remember"> Remember me</label>
        <a href="#">Forgot password?</a>
      </div>
      <button class="btn btn-primary btn-block btn-lg" type="submit">Sign In</button>
    </form>

    <div class="auth-divider">or continue with</div>
    <div class="social-auth">
      <button>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
          Google
      </button>
      <button>
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          Facebook
      </button>
    </div>

    <p class="auth-footer">
      Don't have an account? <a href="index.php?controller=user&action=register">Create one</a>
    </p>
  </div>
</div>

<script>window.isLoggedIn = false;</script>
<script src="/sotre_php_mvc/public/javascript/main.js"></script>
<script>
function togglePassword(id, btn) {
  const input = document.getElementById(id);
  const isPassword = input.type === 'password';
  input.type = isPassword ? 'text' : 'password';
  btn.innerHTML = isPassword
    ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>'
    : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
}
</script>
</body>
</html>
