<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $featured = [];
    foreach ($_POST['featured'] ?? [] as $propertyId => $enabled) {
        if ((int) $enabled === 1) {
            $featured[(int) $propertyId] = (int) ($_POST['sort_order'][$propertyId] ?? 0);
        }
    }
    cms_save_featured_listings($featured);
    flash('Featured listings saved.');
    redirect('content-featured.php');
}

$properties = get_all_admin_properties();
$featuredRows = cms_featured_properties(100);
$featuredLookup = [];
foreach ($featuredRows as $index => $property) {
    $featuredLookup[(int) $property['id']] = (int) ($property['featured_sort_order'] ?? (($index + 1) * 10));
}

admin_header('Featured Listings');
?>
<form class="admin-card" method="post">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">Homepage</div>
      <h2 class="admin-card__title">Featured Listings</h2>
      <p class="admin-card__note">Only published listings selected here appear on the homepage.</p>
    </div>
    <div class="admin-actions">
      <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Featured</button>
      <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table admin-table align-middle">
      <thead><tr><th style="width: 80px;">Show</th><th>Listing</th><th>Published</th><th style="width: 140px;">Sort</th></tr></thead>
      <tbody>
        <?php foreach ($properties as $property): $isFeatured = array_key_exists((int) $property['id'], $featuredLookup); ?>
          <tr>
            <td>
              <input class="form-check-input" type="checkbox" name="featured[<?= (int) $property['id'] ?>]" value="1" <?= $isFeatured ? 'checked' : '' ?> <?= (int) $property['is_published'] === 1 ? '' : 'disabled' ?>>
            </td>
            <td><strong><?= e($property['name']) ?></strong></td>
            <td>
              <?php if ((int) $property['is_published'] === 1): ?>
                <span class="admin-pill admin-pill--published"><i class="fa-solid fa-circle-check me-1"></i> Published</span>
              <?php else: ?>
                <span class="admin-pill admin-pill--draft"><i class="fa-solid fa-pen-to-square me-1"></i> Draft</span>
              <?php endif; ?>
            </td>
            <td>
              <input class="form-control" type="number" name="sort_order[<?= (int) $property['id'] ?>]" value="<?= e((string) ($featuredLookup[(int) $property['id']] ?? $property['sort_order'] ?? 0)) ?>">
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="admin-actions mt-4">
    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Featured</button>
    <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
  </div>
</form>
<?php admin_footer(); ?>
