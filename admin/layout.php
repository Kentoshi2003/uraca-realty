<?php

declare(strict_types=1);

function admin_header(string $title): void
{
    $flash = flash();
    $loggedIn = is_admin_logged_in();
    $current_script = basename($_SERVER['SCRIPT_NAME']);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title><?= e($title) ?> | Uraca Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/fontawesome.css" rel="stylesheet">
  <style>
    :root {
      --uraca-brown: #A06F49;
      --uraca-brown-dark: #7d5334;
      --uraca-ink: #111111;
      --uraca-muted: #6f6a63;
      --uraca-line: rgba(17, 17, 17, 0.08);
      --uraca-cream: #fbf9f6;
      --uraca-soft: #f7f0e5;
      --sidebar-width: 260px;
    }
    * {
      letter-spacing: 0.01em;
      box-sizing: border-box;
    }
    body {
      min-height: 100vh;
      background-color: var(--uraca-cream);
      color: var(--uraca-ink);
      font-family: 'Outfit', 'Inter', -apple-system, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    /* Layout structure when logged in */
    .admin-layout {
      display: flex;
      min-height: 100vh;
    }
    
    /* Sidebar Navigation */
    .admin-sidebar {
      width: var(--sidebar-width);
      background: linear-gradient(180deg, #1b1612 0%, #111111 100%);
      color: rgba(255, 255, 255, 0.85);
      border-right: 1px solid rgba(160, 111, 73, 0.18);
      display: flex;
      flex-direction: column;
      flex-shrink: 0;
      transition: transform 0.3s ease;
      z-index: 1000;
      
      /* Fixed sticky sidebar fitting viewport */
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
    }
    .admin-sidebar::-webkit-scrollbar {
      width: 4px;
    }
    .admin-sidebar::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 4px;
    }
    
    .admin-sidebar__brand {
      padding: 24px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    .admin-sidebar__logo {
      display: grid;
      place-items: center;
      width: 48px;
      height: 48px;
      border-radius: 12px;
      background: #fff;
      padding: 4px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }
    .admin-sidebar__logo img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .admin-sidebar__brand-text {
      display: flex;
      flex-direction: column;
      min-width: 0;
    }
    .admin-sidebar__kicker {
      font-size: 11px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.15em;
      color: var(--uraca-brown);
    }
    .admin-sidebar__app-name {
      font-size: 15px;
      font-weight: 700;
      color: #fff;
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
    }
    
    .admin-sidebar__nav {
      padding: 24px 16px;
      display: flex;
      flex-direction: column;
      gap: 8px;
      flex: 1 1 auto;
    }
    .admin-sidebar__link {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 16px;
      border-radius: 12px;
      color: rgba(255, 255, 255, 0.7);
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.25s ease;
      border-left: 3px solid transparent;
    }
    .admin-sidebar__link i {
      font-size: 16px;
      width: 20px;
      text-align: center;
    }
    .admin-sidebar__link:hover {
      background: rgba(255, 255, 255, 0.05);
      color: #fff;
      padding-left: 20px;
    }
    .admin-sidebar__link.is-active {
      background: rgba(160, 111, 73, 0.14);
      color: #fff;
      border-left-color: var(--uraca-brown);
      padding-left: 20px;
    }
    
    .admin-sidebar__footer {
      padding: 20px 16px;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
    }
    
    /* Main Workspace */
    .admin-main {
      flex: 1 1 auto;
      display: flex;
      flex-direction: column;
      min-width: 0;
      min-height: 100vh;
    }
    
    /* Top Header Bar */
    .admin-topbar-new {
      background: #fff;
      border-bottom: 1px solid var(--uraca-line);
      padding: 20px 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
    }
    .admin-topbar-new__title {
      font-size: 24px;
      font-weight: 700;
      margin: 0;
      color: var(--uraca-ink);
    }
    .admin-topbar-new__meta {
      font-size: 13px;
      color: var(--uraca-muted);
      margin-top: 4px;
    }
    
    .admin-content-new {
      padding: 32px;
      flex: 1 1 auto;
      max-width: 1320px;
      width: 100%;
      margin: 0 auto;
    }
    
    /* Mobile Header toggler */
    .admin-mobile-header {
      background: #111;
      color: #fff;
      display: none;
      justify-content: space-between;
      align-items: center;
      padding: 14px 20px;
      position: sticky;
      top: 0;
      z-index: 1010;
    }
    .admin-mobile-header__brand {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: #fff;
    }
    .admin-mobile-header__logo {
      width: 38px;
      height: 38px;
      border-radius: 8px;
      background: #fff;
      padding: 2px;
      display: grid;
      place-items: center;
    }
    .admin-mobile-header__logo img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .admin-mobile-header__text {
      font-size: 15px;
      font-weight: 700;
    }
    .admin-mobile-toggler {
      background: none;
      border: 0;
      color: #fff;
      font-size: 22px;
      padding: 4px;
      cursor: pointer;
    }
    
    /* Stats & Cards */
    .admin-stats {
      display: grid;
      gap: 20px;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      margin-bottom: 28px;
    }
    .admin-stat {
      border: 0;
      border-radius: 16px;
      background: #fff;
      padding: 24px;
      box-shadow: 0 10px 30px rgba(17, 17, 17, 0.03);
      border: 1px solid rgba(17, 17, 17, 0.04);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .admin-stat:hover {
      transform: translateY(-4px);
      box-shadow: 0 16px 40px rgba(17, 17, 17, 0.06);
    }
    .admin-stat__label {
      color: var(--uraca-muted);
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }
    .admin-stat__value {
      margin-top: 8px;
      color: var(--uraca-ink);
      font-size: 36px;
      font-weight: 800;
      line-height: 1;
    }
    
    .admin-card {
      background: #fff;
      border: 1px solid rgba(17, 17, 17, 0.05);
      border-radius: 20px;
      box-shadow: 0 12px 35px rgba(17, 17, 17, 0.04);
      padding: 30px;
    }
    .admin-card__header {
      align-items: center;
      display: flex;
      justify-content: space-between;
      gap: 20px;
      margin-bottom: 24px;
      padding-bottom: 20px;
      border-bottom: 1px solid rgba(17, 17, 17, 0.06);
    }
    .admin-card__eyebrow {
      margin-bottom: 6px;
      color: var(--uraca-brown);
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }
    .admin-card__title {
      margin: 0;
      font-size: 24px;
      font-weight: 700;
      color: var(--uraca-ink);
    }
    .admin-card__note {
      margin: 6px 0 0;
      color: var(--uraca-muted);
      font-size: 14px;
    }
    
    /* Table styling */
    .admin-table {
      margin: 0;
    }
    .admin-table thead th {
      border-bottom: 2px solid rgba(17, 17, 17, 0.06);
      color: var(--uraca-muted);
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      padding: 16px 12px;
      background: #fafaf9;
    }
    .admin-table tbody td {
      border-bottom: 1px solid rgba(17, 17, 17, 0.05);
      padding: 20px 12px;
      font-size: 14px;
      vertical-align: middle;
      color: #333;
    }
    .admin-listing-cell {
      align-items: center;
      display: flex;
      gap: 16px;
      min-width: 320px;
    }
    .admin-listing-thumb {
      flex: 0 0 auto;
      width: 76px;
      height: 56px;
      border-radius: 10px;
      object-fit: cover;
      border: 1px solid rgba(17, 17, 17, 0.08);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
    }
    .admin-listing-title {
      display: block;
      color: var(--uraca-ink);
      font-size: 15px;
      font-weight: 700;
      line-height: 1.35;
    }
    .admin-listing-slug {
      color: var(--uraca-muted);
      font-size: 12px;
      margin-top: 2px;
      display: block;
    }
    
    /* Badges */
    .admin-pill {
      display: inline-flex;
      align-items: center;
      padding: 6px 14px;
      border-radius: 999px;
      background: #faf7f2;
      color: #555;
      font-size: 12px;
      font-weight: 700;
    }
    .admin-pill--published {
      background: rgba(56, 142, 60, 0.12);
      color: #2e7d32;
    }
    .admin-pill--draft {
      background: rgba(211, 47, 47, 0.1);
      color: #c62828;
    }
    
    /* Row Actions */
    .admin-row-actions {
      display: flex;
      justify-content: flex-end;
      gap: 8px;
    }
    
    /* Login Page Styling */
    .admin-login-page {
      background:
        radial-gradient(circle at top right, rgba(160, 111, 73, 0.15), transparent 45%),
        linear-gradient(135deg, #1b1612 0%, #111111 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }
    .admin-login-card {
      width: 100%;
      max-width: 480px;
      background: #ffffff;
      border-radius: 24px;
      box-shadow: 0 30px 90px rgba(0, 0, 0, 0.45);
      border: 1px solid rgba(255, 255, 255, 0.08);
      overflow: hidden;
    }
    .admin-login-header {
      background: linear-gradient(135deg, #2c211a 0%, #16120e 100%);
      color: #fff;
      padding: 40px 32px 30px;
      text-align: center;
      border-bottom: 1px solid rgba(160, 111, 73, 0.16);
      position: relative;
    }
    .admin-login-logo {
      width: 74px;
      height: 74px;
      border-radius: 16px;
      background: #fff;
      margin: 0 auto 20px;
      display: grid;
      place-items: center;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      padding: 8px;
    }
    .admin-login-logo img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }
    .admin-login-title {
      font-size: 24px;
      font-weight: 700;
      margin: 0 0 6px;
    }
    .admin-login-subtitle {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.65);
    }
    .admin-login-body {
      padding: 40px 32px;
    }
    
    /* Buttons */
    .btn {
      border-radius: 12px;
      font-weight: 700;
      font-size: 14px;
      padding: 10px 20px;
      min-height: 44px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.25s ease;
    }
    .btn-sm {
      min-height: 32px !important;
      padding: 6px 12px !important;
      font-size: 12px !important;
      border-radius: 8px !important;
      gap: 6px !important;
    }
    .admin-actions {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .btn-primary {
      background: var(--uraca-brown);
      border-color: var(--uraca-brown);
      color: #fff;
      box-shadow: 0 6px 16px rgba(160, 111, 73, 0.2);
    }
    .btn-primary:hover, .btn-primary:focus {
      background: var(--uraca-brown-dark);
      border-color: var(--uraca-brown-dark);
      color: #fff;
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(160, 111, 73, 0.3);
    }
    .btn-outline-secondary {
      border-color: rgba(17, 17, 17, 0.15);
      color: var(--uraca-ink);
      background: transparent;
    }
    .btn-outline-secondary:hover {
      background: #faf7f2;
      border-color: var(--uraca-brown);
      color: var(--uraca-brown);
    }
    .btn-danger {
      background: #c62828;
      border-color: #c62828;
      color: #fff;
    }
    .btn-danger:hover {
      background: #b71c1c;
      border-color: #b71c1c;
    }
    
    /* Forms & Controls */
    label {
      color: var(--uraca-ink);
      font-size: 13px;
      font-weight: 700;
      margin-bottom: 8px;
      display: block;
    }
    .form-control, .form-select {
      min-height: 48px;
      border: 1px solid rgba(17, 17, 17, 0.12);
      border-radius: 12px;
      background-color: #fafaf9;
      padding: 10px 16px;
      font-size: 14px;
      color: var(--uraca-ink);
      transition: all 0.25s ease;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--uraca-brown);
      background-color: #fff;
      box-shadow: 0 0 0 4px rgba(160, 111, 73, 0.12);
      color: var(--uraca-ink);
    }
    .form-check-input {
      width: 20px;
      height: 20px;
      border-radius: 6px;
      border-color: rgba(17, 17, 17, 0.18);
      cursor: pointer;
    }
    .form-check-input:checked {
      background-color: var(--uraca-brown);
      border-color: var(--uraca-brown);
    }
    .form-check-label {
      margin-bottom: 0;
      margin-left: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
    }
    .form-text {
      color: var(--uraca-muted);
      font-size: 12px;
      margin-top: 6px;
    }
    
    .admin-form-section {
      margin-top: 28px;
      padding-top: 28px;
      border-top: 1px solid rgba(17, 17, 17, 0.08);
    }
    .admin-form-section:first-of-type {
      margin-top: 0;
      padding-top: 0;
      border-top: 0;
    }
    .admin-section-title {
      margin-bottom: 20px;
      font-size: 17px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--uraca-brown);
    }
    
    /* Thumb Grid */
    .thumb-grid {
      display: grid;
      gap: 20px;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    }
    .thumb-card {
      border: 1px solid rgba(17, 17, 17, 0.06);
      border-radius: 14px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 8px 24px rgba(17, 17, 17, 0.04);
      transition: transform 0.25s ease;
    }
    .thumb-card:hover {
      transform: translateY(-2px);
    }
    .thumb-card img {
      aspect-ratio: 4 / 3;
      display: block;
      object-fit: cover;
      width: 100%;
    }
    .thumb-card form {
      padding: 12px;
    }
    
    /* Responsive Queries */
    @media (max-width: 991.98px) {
      .admin-sidebar {
        position: fixed;
        left: 0;
        top: 66px; /* below mobile sticky header */
        bottom: 0;
        width: var(--sidebar-width);
        transform: translateX(-100%);
      }
      .admin-sidebar.show {
        transform: translateX(0);
      }
      .admin-mobile-header {
        display: flex;
      }
      .admin-topbar-new {
        display: none;
      }
      .admin-content-new {
        padding: 20px 16px;
      }
      .admin-stats {
        grid-template-columns: 1fr;
        gap: 16px;
      }
      .admin-card {
        padding: 20px;
      }
    }
  </style>
</head>
<body class="<?= !$loggedIn ? 'admin-login-page' : '' ?>">
<?php if ($loggedIn): ?>
<div class="admin-layout">
  <!-- Mobile Header -->
  <header class="admin-mobile-header">
    <a href="index.php" class="admin-mobile-header__brand">
      <div class="admin-mobile-header__logo">
        <img src="../images/logo.png" alt="Uraca Realty">
      </div>
      <span class="admin-mobile-header__text">Uraca Realty</span>
    </a>
    <button class="admin-mobile-toggler" id="sidebar_toggler" type="button" aria-label="Toggle Navigation">
      <i class="fa-solid fa-bars"></i>
    </button>
  </header>

  <!-- Sidebar -->
  <aside class="admin-sidebar" id="admin_sidebar">
    <div class="admin-sidebar__brand">
      <div class="admin-sidebar__logo">
        <img src="../images/logo.png" alt="Uraca Realty">
      </div>
      <div class="admin-sidebar__brand-text">
        <span class="admin-sidebar__kicker">Uraca Realty</span>
        <span class="admin-sidebar__app-name">Admin Portal</span>
      </div>
    </div>
    
    <nav class="admin-sidebar__nav">
      <a class="admin-sidebar__link <?= $current_script === 'index.php' || ($current_script === 'property-edit.php' && isset($_GET['id'])) ? 'is-active' : '' ?>" href="index.php">
        <i class="fa-solid fa-chart-line"></i>
        <span>Dashboard</span>
      </a>
      <a class="admin-sidebar__link <?= $current_script === 'property-edit.php' && !isset($_GET['id']) ? 'is-active' : '' ?>" href="property-edit.php">
        <i class="fa-solid fa-circle-plus"></i>
        <span>Add Listing</span>
      </a>
      <a class="admin-sidebar__link <?= in_array($current_script, ['content.php', 'content-site.php', 'content-page.php', 'content-services.php', 'content-testimonials.php', 'content-featured.php'], true) ? 'is-active' : '' ?>" href="content.php">
        <i class="fa-solid fa-file-signature"></i>
        <span>Website Content</span>
      </a>
      <a class="admin-sidebar__link <?= $current_script === 'inquiries.php' ? 'is-active' : '' ?>" href="inquiries.php">
        <i class="fa-solid fa-envelope-open-text"></i>
        <span>Inquiries</span>
      </a>
      <a class="admin-sidebar__link" href="../page-projects.php" target="_blank" rel="noopener">
        <i class="fa-solid fa-globe"></i>
        <span>View Website</span>
      </a>
    </nav>

    
    <div class="admin-sidebar__footer">
      <a class="admin-sidebar__link text-danger" href="logout.php">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Sign Out</span>
      </a>
    </div>
  </aside>

  <!-- Main Content Wrapper -->
  <div class="admin-main">
    <header class="admin-topbar-new">
      <div>
        <h1 class="admin-topbar-new__title"><?= e($title) ?></h1>
        <div class="admin-topbar-new__meta">Manage property inventory, descriptions, and media.</div>
      </div>
      <div class="d-flex align-items-center gap-3">
        <a class="btn btn-outline-secondary btn-sm" href="../page-projects.php" target="_blank" rel="noopener">
          <i class="fa-solid fa-arrow-up-right-from-square"></i> Live Preview
        </a>
      </div>
    </header>
    
    <div class="admin-content-new">
      <?php if ($flash): ?>
        <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show" role="alert">
          <?= e($flash['message']) ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
<?php else: ?>
  <!-- Centered Login page wraps here -->
<?php endif; ?>
<?php
}

function admin_footer(): void
{
    $loggedIn = is_admin_logged_in();
    if ($loggedIn): ?>
        </div> <!-- Close admin-content-new -->
      </div> <!-- Close admin-main -->
    </div> <!-- Close admin-layout -->
    <?php endif; ?>
    
    <script src="../js/bootstrap.min.js"></script>
    <?php if ($loggedIn): ?>
    <script>
      (function() {
        var toggler = document.getElementById('sidebar_toggler');
        var sidebar = document.getElementById('admin_sidebar');
        if (toggler && sidebar) {
          toggler.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('show');
          });
          
          document.addEventListener('click', function(e) {
            if (sidebar.classList.contains('show') && !sidebar.contains(e.target) && e.target !== toggler) {
              sidebar.classList.remove('show');
            }
          });
        }
      })();
    </script>
    <?php endif; ?>
</body>
</html>
<?php
}
