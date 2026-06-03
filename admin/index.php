<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

require_admin();

$properties = get_all_admin_properties();
$publishedCount = count(array_filter($properties, static fn ($property) => (int) $property['is_published'] === 1));
$draftCount = count($properties) - $publishedCount;
$categoryCount = count(array_unique(array_column($properties, 'category_name')));

admin_header('Listings');
?>
<div class="admin-stats">
  <div class="admin-stat">
    <div class="admin-stat__label">Total Listings</div>
    <div class="admin-stat__value"><?= count($properties) ?></div>
  </div>
  <div class="admin-stat">
    <div class="admin-stat__label">Published</div>
    <div class="admin-stat__value"><?= $publishedCount ?></div>
  </div>
  <div class="admin-stat">
    <div class="admin-stat__label">Categories</div>
    <div class="admin-stat__value"><?= $categoryCount ?></div>
  </div>
</div>
<div class="admin-card">
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">Inventory</div>
      <h2 class="admin-card__title">Manage Listings</h2>
      <p class="admin-card__note"><?= $draftCount ?> draft<?= $draftCount === 1 ? '' : 's' ?> waiting off-site.</p>
    </div>
    <a class="btn btn-primary" href="property-edit.php"><i class="fa-solid fa-plus"></i> Add Listing</a>
  </div>
  <div class="table-responsive">
    <table class="table admin-table align-middle">
      <thead>
        <tr>
          <th>Listing</th>
          <th>Category</th>
          <th>Status</th>
          <th>Published</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($properties as $property): ?>
          <tr>
            <td>
              <div class="admin-listing-cell">
                <img class="admin-listing-thumb" src="../<?= e($property['hero_image'] ?: 'images/resource/project1-1.jpg') ?>" alt="<?= e($property['name']) ?>">
                <div>
                  <strong class="admin-listing-title"><?= e($property['name']) ?></strong>
                  <span class="admin-listing-slug"><?= e($property['slug']) ?></span>
                </div>
              </div>
            </td>
            <td><span class="admin-pill"><?= e($property['category_name']) ?></span></td>
            <td><?= e($property['status']) ?></td>
            <td>
              <?php if ((int) $property['is_published'] === 1): ?>
                <span class="admin-pill admin-pill--published"><i class="fa-solid fa-circle-check me-1"></i> Published</span>
              <?php else: ?>
                <span class="admin-pill admin-pill--draft"><i class="fa-solid fa-pen-to-square me-1"></i> Draft</span>
              <?php endif; ?>
            </td>
            <td class="text-end">
              <div class="admin-row-actions">
                <a class="btn btn-sm btn-outline-secondary" href="../page-project-details.php?id=<?= e($property['slug']) ?>" target="_blank" rel="noopener"><i class="fa-solid fa-eye"></i> View</a>
                <a class="btn btn-sm btn-primary" href="property-edit.php?id=<?= (int) $property['id'] ?>"><i class="fa-solid fa-pen"></i> Edit</a>
                <form method="post" action="property-delete.php" onsubmit="return confirm('Delete this listing?');">
                  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                  <input type="hidden" name="id" value="<?= (int) $property['id'] ?>">
                  <button class="btn btn-sm btn-danger" type="submit"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php admin_footer(); ?>
