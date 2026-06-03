<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

if (is_admin_logged_in()) {
    redirect('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = trim((string) ($_POST['email'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $now = time();
    $attempts = $_SESSION['login_attempts'][$email] ?? ['count' => 0, 'locked_until' => 0];

    if (($attempts['locked_until'] ?? 0) > $now) {
        $error = 'Too many failed attempts. Please try again in a few minutes.';
    } else {

        $stmt = db()->prepare('SELECT * FROM admins WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password_hash'])) {
            unset($_SESSION['login_attempts'][$email]);
            session_regenerate_id(true);
            $_SESSION['admin_id'] = (int) $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            redirect('index.php');
        }

        $attempts['count'] = (int) ($attempts['count'] ?? 0) + 1;
        $attempts['locked_until'] = $attempts['count'] >= 5 ? $now + 300 : 0;
        $_SESSION['login_attempts'][$email] = $attempts;
        $error = 'Invalid admin email or password.';
    }
}

admin_header('Admin Login');
?>
<div class="admin-login-card">
  <div class="admin-login-header">
    <div class="admin-login-logo">
      <img src="../images/logo.png" alt="Uraca Realty">
    </div>
    <h2 class="admin-login-title">Admin Portal</h2>
    <p class="admin-login-subtitle">Sign in to manage Uraca Realty listings.</p>
  </div>
  <div class="admin-login-body">
    <?php if ($error): ?><div class="alert alert-danger mb-4"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
      <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
      <div class="mb-3">
        <label for="email">Email Address</label>
        <input class="form-control" type="email" id="email" name="email" autocomplete="username" placeholder="name@uracarealtyph.com" required>
      </div>
      <div class="mb-4">
        <label for="password">Password</label>
        <input class="form-control" type="password" id="password" name="password" autocomplete="current-password" placeholder="••••••••" required>
      </div>
      <button class="btn btn-primary w-100" type="submit">Sign In</button>
    </form>
  </div>
</div>
<?php admin_footer(); ?>
