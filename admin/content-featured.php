<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

require_admin();

$errors = [];
$properties = get_all_admin_properties();
$publishedProperties = array_values(array_filter($properties, static fn ($property) => (int) $property['is_published'] === 1));
$publishedLookup = [];
foreach ($publishedProperties as $property) {
    $publishedLookup[(int) $property['id']] = $property;
}
$featuredRows = cms_featured_properties(3);
$slotIds = [1 => 0, 2 => 0, 3 => 0];
foreach (array_values($featuredRows) as $index => $property) {
    if ($index < 3) {
        $slotIds[$index + 1] = (int) $property['id'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $featured = [];
    $slotIds = [1 => 0, 2 => 0, 3 => 0];
    $selectedIds = [];

    for ($slot = 1; $slot <= 3; $slot++) {
        $propertyId = (int) ($_POST['featured_slots'][$slot] ?? 0);
        $slotIds[$slot] = $propertyId;

        if ($propertyId <= 0) {
            continue;
        }

        if (!isset($publishedLookup[$propertyId])) {
            $errors[] = 'Top ' . $slot . ' must be a published listing.';
            continue;
        }

        if (in_array($propertyId, $selectedIds, true)) {
            $errors[] = 'Each featured slot must use a different listing.';
            continue;
        }

        $selectedIds[] = $propertyId;
        $featured[$propertyId] = $slot * 10;
    }

    if (!$errors) {
        cms_save_featured_listings($featured);
        flash('Featured listings saved.');
        redirect('content-featured.php');
    }
}

admin_header('Featured Listings');
?>
<form class="admin-card" method="post">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
  <?php foreach ($errors as $error): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
  <?php endforeach; ?>
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">Homepage</div>
      <h2 class="admin-card__title">Featured Listings</h2>
      <p class="admin-card__note">Choose up to three published listings for the homepage featured section.</p>
    </div>
    <div class="admin-actions">
      <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Featured</button>
      <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
    </div>
  </div>
  <div class="admin-form-section">
    <div class="admin-section-title">Homepage Order</div>
    <div class="row">
      <?php for ($slot = 1; $slot <= 3; $slot++): ?>
        <div class="col-lg-4 mb-3">
          <label for="featured-slot-<?= $slot ?>">Top <?= $slot ?> Featured Listing</label>
          <select class="form-select" id="featured-slot-<?= $slot ?>" name="featured_slots[<?= $slot ?>]">
            <option value="">No listing</option>
            <?php foreach ($publishedProperties as $property): ?>
              <?php $propertyId = (int) $property['id']; ?>
              <option value="<?= $propertyId ?>" <?= $slotIds[$slot] === $propertyId ? 'selected' : '' ?>>
                <?= e($property['name']) ?><?= !empty($property['category_name']) ? ' - ' . e($property['category_name']) : '' ?> - Published
              </option>
            <?php endforeach; ?>
          </select>
          <div class="form-text">Shown as position <?= $slot ?> on the homepage.</div>
        </div>
      <?php endfor; ?>
    </div>
  </div>
  <div class="admin-form-section">
    <div class="admin-section-title">Current Preview</div>
    <div class="featured-slot-preview">
      <?php for ($slot = 1; $slot <= 3; $slot++): ?>
        <?php $selectedProperty = $publishedLookup[$slotIds[$slot]] ?? null; ?>
        <div class="featured-slot-card">
          <div class="featured-slot-card__rank">Top <?= $slot ?></div>
          <?php if ($selectedProperty): ?>
            <img class="admin-listing-thumb" src="../<?= e($selectedProperty['hero_image'] ?: 'images/resource/project1-1.jpg') ?>" alt="<?= e($selectedProperty['name']) ?>">
            <div class="featured-slot-card__body">
              <strong><?= e($selectedProperty['name']) ?></strong>
              <span><?= e($selectedProperty['category_name'] ?? 'Listing') ?></span>
              <span class="admin-pill admin-pill--published"><i class="fa-solid fa-circle-check me-1"></i> Published</span>
            </div>
          <?php else: ?>
            <div class="featured-slot-card__empty">No listing selected</div>
          <?php endif; ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>
  <div class="admin-actions mt-4">
    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Featured</button>
    <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
  </div>
</form>
<?php admin_footer(); ?>
