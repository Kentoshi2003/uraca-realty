<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

require_admin();

$fields = [
    'contact_name' => 'Default Contact Person',
    'phone' => 'Phone',
    'email' => 'Email',
    'address' => 'Address',
    'facebook_url' => 'Facebook URL',
    'whatsapp_url' => 'WhatsApp URL',
    'instagram_url' => 'Instagram URL',
    'map_embed_url' => 'Google Map Embed URL',
    'newsletter_text' => 'Footer Newsletter Text',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $settings = [];
    foreach ($fields as $key => $label) {
        $settings[$key] = trim((string) ($_POST[$key] ?? ''));
    }
    cms_save_settings($settings);
    flash('Site settings saved.');
    redirect('content-site.php');
}

$settings = cms_settings();

admin_header('Site Settings');
?>
<form class="admin-card" method="post">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">Global Content</div>
      <h2 class="admin-card__title">Site Settings</h2>
      <p class="admin-card__note">These values appear in headers, footers, contact cards, and forms.</p>
    </div>
    <div class="admin-actions">
      <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Settings</button>
      <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
    </div>
  </div>
  <div class="row">
    <?php foreach ($fields as $key => $label): ?>
      <div class="<?= in_array($key, ['newsletter_text', 'map_embed_url'], true) ? 'col-12' : 'col-md-6' ?> mb-3">
        <label for="<?= e($key) ?>"><?= e($label) ?></label>
        <?php if (in_array($key, ['newsletter_text', 'map_embed_url'], true)): ?>
          <textarea class="form-control" id="<?= e($key) ?>" name="<?= e($key) ?>"><?= e($settings[$key] ?? '') ?></textarea>
        <?php else: ?>
          <input class="form-control" id="<?= e($key) ?>" name="<?= e($key) ?>" value="<?= e($settings[$key] ?? '') ?>">
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="admin-actions mt-4">
    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Settings</button>
    <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
  </div>
</form>
<?php admin_footer(); ?>

