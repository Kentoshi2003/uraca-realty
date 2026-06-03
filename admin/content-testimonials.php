<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/admin-cms-helpers.php';
require_once __DIR__ . '/layout.php';

require_admin();

$testimonialId = isset($_GET['id']) ? (int) $_GET['id'] : null;
$status = (string) ($_GET['status'] ?? 'active');
if (!in_array($status, ['active', 'archived', 'all'], true)) {
    $status = 'active';
}
$testimonial = cms_testimonial($testimonialId, true);
if ($testimonialId && !$testimonial) {
    flash('Testimonial not found.', 'warning');
    redirect('content-testimonials.php');
}
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = (string) ($_POST['action'] ?? 'save');
    $id = $testimonialId;

    if ($action === 'archive' && $id) {
        cms_delete_testimonial($id);
        flash('Testimonial archived.');
        redirect('content-testimonials.php?status=archived');
    }

    if ($action === 'restore' && $id) {
        cms_restore_testimonial($id);
        flash('Testimonial restored.');
        redirect('content-testimonials.php');
    }

    $imagePath = trim((string) ($_POST['image_path'] ?? ''));
    $uploaded = upload_cms_image('image_upload', 'testimonial', $errors);
    if ($uploaded) {
        $imagePath = $uploaded;
    }
    $imagePath = admin_cms_validate_asset_path($imagePath, 'Image Path', $errors);

    $quote = trim((string) ($_POST['quote'] ?? ''));
    $clientName = trim((string) ($_POST['client_name'] ?? ''));
    if ($quote === '') {
        $errors[] = 'Testimonial quote is required.';
    }
    if ($clientName === '') {
        $errors[] = 'Client name is required.';
    }

    if (!$errors) {
        $savedId = cms_save_testimonial([
        'headline' => trim((string) ($_POST['headline'] ?? '')),
        'quote' => $quote,
        'client_name' => $clientName,
        'client_role' => trim((string) ($_POST['client_role'] ?? '')),
        'image_path' => $imagePath,
        'rating' => (int) ($_POST['rating'] ?? 5),
        'is_enabled' => isset($_POST['is_enabled']) ? 1 : 0,
        'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ], $id ?: null);

        flash('Testimonial saved.');
        redirect('content-testimonials.php?id=' . $savedId);
    }
}

$form = array_merge([
    'id' => '',
    'headline' => '',
    'quote' => '',
    'client_name' => '',
    'client_role' => '',
    'image_path' => '',
    'rating' => 5,
    'is_enabled' => 1,
    'sort_order' => 0,
], $_SERVER['REQUEST_METHOD'] === 'POST' ? [
    'headline' => trim((string) ($_POST['headline'] ?? '')),
    'quote' => trim((string) ($_POST['quote'] ?? '')),
    'client_name' => trim((string) ($_POST['client_name'] ?? '')),
    'client_role' => trim((string) ($_POST['client_role'] ?? '')),
    'image_path' => trim((string) ($_POST['image_path'] ?? '')),
    'rating' => (int) ($_POST['rating'] ?? 5),
    'is_enabled' => isset($_POST['is_enabled']) ? 1 : 0,
    'sort_order' => (int) ($_POST['sort_order'] ?? 0),
] : ($testimonial ?: []));
$testimonials = cms_testimonials(false, $status);

admin_header('Testimonials Content');
?>
<form class="admin-card" method="post" enctype="multipart/form-data">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
  <?php foreach ($errors as $error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endforeach; ?>
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">CMS Testimonials</div>
      <h2 class="admin-card__title"><?= $testimonial ? 'Edit Testimonial' : 'Add Testimonial' ?></h2>
    </div>
    <div class="admin-actions">
      <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Testimonial</button>
      <a class="btn btn-outline-secondary" href="content-testimonials.php"><i class="fa-solid fa-plus"></i> New</a>
      <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 mb-3"><label>Headline</label><input class="form-control" name="headline" value="<?= e($form['headline']) ?>"></div>
    <div class="col-md-2 mb-3"><label>Rating</label><input class="form-control" type="number" min="1" max="5" name="rating" value="<?= e((string) $form['rating']) ?>"></div>
    <div class="col-md-2 mb-3"><label>Sort</label><input class="form-control" type="number" name="sort_order" value="<?= e((string) $form['sort_order']) ?>"></div>
    <div class="col-12 mb-3"><label>Quote</label><textarea class="form-control" name="quote" required><?= e($form['quote']) ?></textarea></div>
    <div class="col-md-6 mb-3"><label>Client Name</label><input class="form-control" name="client_name" value="<?= e($form['client_name']) ?>" required></div>
    <div class="col-md-6 mb-3"><label>Client Role</label><input class="form-control" name="client_role" value="<?= e($form['client_role']) ?>"></div>
    <div class="col-md-8 mb-3"><label>Image Path</label><input class="form-control" name="image_path" value="<?= e($form['image_path']) ?>"></div>
    <div class="col-md-4 mb-3"><label>Upload Image</label><input class="form-control" type="file" name="image_upload" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"></div>
    <div class="col-12"><?php admin_cms_image_preview($form['image_path'], $form['client_name']); ?></div>
    <div class="col-12 form-check mb-3"><input class="form-check-input" type="checkbox" id="is_enabled" name="is_enabled" <?= admin_checked($form['is_enabled']) ?>><label class="form-check-label" for="is_enabled">Published</label></div>
  </div>
  <div class="admin-actions mt-4">
    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Testimonial</button>
    <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
  </div>
</form>
<div class="admin-card mt-4">
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">Existing</div>
      <h2 class="admin-card__title">Testimonials</h2>
      <p class="admin-card__note">Archived testimonials are hidden from public pages until restored.</p>
    </div>
    <div class="admin-actions">
      <a class="btn btn-sm <?= $status === 'active' ? 'btn-primary' : 'btn-outline-secondary' ?>" href="content-testimonials.php?status=active">Active</a>
      <a class="btn btn-sm <?= $status === 'archived' ? 'btn-primary' : 'btn-outline-secondary' ?>" href="content-testimonials.php?status=archived">Archived</a>
      <a class="btn btn-sm <?= $status === 'all' ? 'btn-primary' : 'btn-outline-secondary' ?>" href="content-testimonials.php?status=all">All</a>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table admin-table align-middle">
      <thead><tr><th>Client</th><th>Headline</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
      <tbody>
        <?php foreach ($testimonials as $item): ?>
          <tr>
            <td>
              <strong><?= e($item['client_name']) ?></strong>
              <?php if ($item['client_role']): ?><br><small class="text-muted"><?= e($item['client_role']) ?></small><?php endif; ?>
            </td>
            <td><?= e($item['headline']) ?></td>
            <td>
              <?php if (!empty($item['deleted_at'])): ?>
                <span class="admin-pill admin-pill--draft"><i class="fa-solid fa-box-archive me-1"></i> Archived</span>
              <?php elseif ((int) $item['is_enabled'] === 1): ?>
                <span class="admin-pill admin-pill--published"><i class="fa-solid fa-circle-check me-1"></i> Published</span>
              <?php else: ?>
                <span class="admin-pill admin-pill--draft"><i class="fa-solid fa-eye-slash me-1"></i> Hidden</span>
              <?php endif; ?>
            </td>
            <td class="text-end">
              <div class="admin-row-actions">
                <a class="btn btn-sm btn-primary" href="content-testimonials.php?id=<?= (int) $item['id'] ?>"><i class="fa-solid fa-pen"></i> Edit</a>
                <form method="post" onsubmit="return confirm('<?= empty($item['deleted_at']) ? 'Archive this testimonial?' : 'Restore this testimonial?' ?>');">
                  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                  <input type="hidden" name="action" value="<?= empty($item['deleted_at']) ? 'archive' : 'restore' ?>">
                  <button class="btn btn-sm <?= empty($item['deleted_at']) ? 'btn-danger' : 'btn-success' ?>" formaction="content-testimonials.php?id=<?= (int) $item['id'] ?>" type="submit"><i class="fa-solid <?= empty($item['deleted_at']) ? 'fa-box-archive' : 'fa-rotate-left' ?>"></i> <?= empty($item['deleted_at']) ? 'Archive' : 'Restore' ?></button>
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
