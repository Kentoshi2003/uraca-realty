<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/admin-cms-helpers.php';
require_once __DIR__ . '/layout.php';

require_admin();

$serviceId = isset($_GET['id']) ? (int) $_GET['id'] : null;
$status = (string) ($_GET['status'] ?? 'active');
if (!in_array($status, ['active', 'archived', 'all'], true)) {
    $status = 'active';
}
$service = cms_service($serviceId, true);
if ($serviceId && !$service) {
    flash('Service not found.', 'warning');
    redirect('content-services.php');
}
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = (string) ($_POST['action'] ?? 'save');
    $id = $serviceId;

    if ($action === 'archive' && $id) {
        cms_delete_service($id);
        flash('Service archived.');
        redirect('content-services.php?status=archived');
    }

    if ($action === 'restore' && $id) {
        cms_restore_service($id);
        flash('Service restored.');
        redirect('content-services.php');
    }

    $imagePath = trim((string) ($_POST['image_path'] ?? ''));
    $uploaded = upload_cms_image('image_upload', 'service', $errors);
    if ($uploaded) {
        $imagePath = $uploaded;
    }
    $imagePath = admin_cms_validate_asset_path($imagePath, 'Image Path', $errors);
    $detailUrl = admin_cms_validate_public_url((string) ($_POST['detail_url'] ?? 'page-service-details.php'), 'Detail URL', $errors, 'page-service-details.php');

    $title = trim((string) ($_POST['title'] ?? ''));
    if ($title === '') {
        $errors[] = 'Service title is required.';
    }

    if (!$errors) {
        $savedId = cms_save_service([
        'title' => $title,
        'summary' => trim((string) ($_POST['summary'] ?? '')),
        'body' => trim((string) ($_POST['body'] ?? '')),
        'icon_class' => trim((string) ($_POST['icon_class'] ?? '')),
        'image_path' => $imagePath,
        'detail_url' => $detailUrl,
        'is_enabled' => isset($_POST['is_enabled']) ? 1 : 0,
        'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ], $id ?: null);

        flash('Service saved.');
        redirect('content-services.php?id=' . $savedId);
    }
}

$form = array_merge([
    'id' => '',
    'title' => '',
    'summary' => '',
    'body' => '',
    'icon_class' => 'flaticon-set-agreement',
    'image_path' => '',
    'detail_url' => 'page-service-details.php',
    'is_enabled' => 1,
    'sort_order' => 0,
], $_SERVER['REQUEST_METHOD'] === 'POST' ? [
    'title' => trim((string) ($_POST['title'] ?? '')),
    'summary' => trim((string) ($_POST['summary'] ?? '')),
    'body' => trim((string) ($_POST['body'] ?? '')),
    'icon_class' => trim((string) ($_POST['icon_class'] ?? '')),
    'image_path' => trim((string) ($_POST['image_path'] ?? '')),
    'detail_url' => trim((string) ($_POST['detail_url'] ?? 'page-service-details.php')),
    'is_enabled' => isset($_POST['is_enabled']) ? 1 : 0,
    'sort_order' => (int) ($_POST['sort_order'] ?? 0),
] : ($service ?: []));
$services = cms_services(false, $status);

admin_header('Services Content');
?>
<form class="admin-card" method="post" enctype="multipart/form-data">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
  <?php foreach ($errors as $error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endforeach; ?>
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">CMS Services</div>
      <h2 class="admin-card__title"><?= $service ? 'Edit Service' : 'Add Service' ?></h2>
      <p class="admin-card__note">Service cards appear on the homepage and services page.</p>
    </div>
    <div class="admin-actions">
      <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Service</button>
      <?php if (!empty($form['slug']) && empty($form['deleted_at'])): ?>
        <a class="btn btn-outline-secondary" href="../page-service-details.php?service=<?= e(rawurlencode((string) $form['slug'])) ?>" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> View Public</a>
      <?php endif; ?>
      <a class="btn btn-outline-secondary" href="content-services.php"><i class="fa-solid fa-plus"></i> New</a>
      <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 mb-3"><label>Title</label><input class="form-control" name="title" value="<?= e($form['title']) ?>" required></div>
    <div class="col-md-4 mb-3"><label>Sort Order</label><input class="form-control" type="number" name="sort_order" value="<?= e((string) $form['sort_order']) ?>"></div>
    <div class="col-12 mb-3"><label>Summary</label><textarea class="form-control" name="summary"><?= e($form['summary']) ?></textarea></div>
    <div class="col-12 mb-3"><label>Body</label><textarea class="form-control" name="body"><?= e($form['body']) ?></textarea></div>
    <div class="col-md-4 mb-3"><label>Icon Class</label><input class="form-control" name="icon_class" value="<?= e($form['icon_class']) ?>"></div>
    <div class="col-md-4 mb-3"><label>Detail URL</label><input class="form-control" name="detail_url" value="<?= e($form['detail_url']) ?>"></div>
    <div class="col-md-4 form-check mt-4 mb-3">
      <input class="form-check-input" type="checkbox" id="is_enabled" name="is_enabled" <?= admin_checked($form['is_enabled']) ?>>
      <label class="form-check-label" for="is_enabled">Published</label>
    </div>
    <div class="col-md-8 mb-3"><label>Image Path</label><input class="form-control" name="image_path" value="<?= e($form['image_path']) ?>"></div>
    <div class="col-md-4 mb-3"><label>Upload Image</label><input class="form-control" type="file" name="image_upload" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"></div>
    <div class="col-12"><?php admin_cms_image_preview($form['image_path'], $form['title']); ?></div>
  </div>
  <div class="admin-actions mt-4">
    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Service</button>
    <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
  </div>
</form>
<div class="admin-card mt-4">
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">Existing</div>
      <h2 class="admin-card__title">Services</h2>
      <p class="admin-card__note">Archived services are hidden from public pages until restored.</p>
    </div>
    <div class="admin-actions">
      <a class="btn btn-sm <?= $status === 'active' ? 'btn-primary' : 'btn-outline-secondary' ?>" href="content-services.php?status=active">Active</a>
      <a class="btn btn-sm <?= $status === 'archived' ? 'btn-primary' : 'btn-outline-secondary' ?>" href="content-services.php?status=archived">Archived</a>
      <a class="btn btn-sm <?= $status === 'all' ? 'btn-primary' : 'btn-outline-secondary' ?>" href="content-services.php?status=all">All</a>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table admin-table align-middle">
      <thead><tr><th>Title</th><th>Status</th><th>Sort</th><th class="text-end">Actions</th></tr></thead>
      <tbody>
        <?php foreach ($services as $item): ?>
          <tr>
            <td><strong><?= e($item['title']) ?></strong></td>
            <td>
              <?php if (!empty($item['deleted_at'])): ?>
                <span class="admin-pill admin-pill--draft"><i class="fa-solid fa-box-archive me-1"></i> Archived</span>
              <?php elseif ((int) $item['is_enabled'] === 1): ?>
                <span class="admin-pill admin-pill--published"><i class="fa-solid fa-circle-check me-1"></i> Published</span>
              <?php else: ?>
                <span class="admin-pill admin-pill--draft"><i class="fa-solid fa-eye-slash me-1"></i> Hidden</span>
              <?php endif; ?>
            </td>
            <td><span class="admin-pill"><?= (int) $item['sort_order'] ?></span></td>
            <td class="text-end">
              <div class="admin-row-actions">
                <a class="btn btn-sm btn-primary" href="content-services.php?id=<?= (int) $item['id'] ?>"><i class="fa-solid fa-pen"></i> Edit</a>
                <?php if (!empty($item['slug']) && empty($item['deleted_at'])): ?>
                  <a class="btn btn-sm btn-outline-secondary" href="../page-service-details.php?service=<?= e(rawurlencode((string) $item['slug'])) ?>" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> View</a>
                <?php endif; ?>
                <form method="post" onsubmit="return confirm('<?= empty($item['deleted_at']) ? 'Archive this service?' : 'Restore this service?' ?>');">
                  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                  <input type="hidden" name="action" value="<?= empty($item['deleted_at']) ? 'archive' : 'restore' ?>">
                  <button class="btn btn-sm <?= empty($item['deleted_at']) ? 'btn-danger' : 'btn-success' ?>" formaction="content-services.php?id=<?= (int) $item['id'] ?>" type="submit"><i class="fa-solid <?= empty($item['deleted_at']) ? 'fa-box-archive' : 'fa-rotate-left' ?>"></i> <?= empty($item['deleted_at']) ? 'Archive' : 'Restore' ?></button>
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
