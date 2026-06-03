<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/admin-cms-helpers.php';
require_once __DIR__ . '/layout.php';

require_admin();

$pageSlug = isset($_GET['page']) ? preg_replace('/[^a-z0-9_-]/', '', (string) $_GET['page']) : 'home';
$allowedPages = ['home', 'about', 'services', 'contact'];
if (!in_array($pageSlug, $allowedPages, true)) {
    $pageSlug = 'home';
}
$errors = [];
$postedPage = null;
$postedSections = [];

$sectionMap = [
    'home' => ['about_intro', 'services_intro', 'featured_intro', 'testimonials_intro', 'contact_intro'],
    'about' => ['about_intro', 'mission', 'vision'],
    'services' => ['services_intro'],
    'contact' => ['contact_intro'],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $socialImage = trim((string) ($_POST['social_image'] ?? ''));
    $uploadedSocial = upload_cms_image('social_image_upload', $pageSlug . '-social', $errors);
    if ($uploadedSocial) {
        $socialImage = $uploadedSocial;
    }
    $socialImage = admin_cms_validate_asset_path($socialImage, 'Social Image Path', $errors);
    $postedPage = [
        'title' => trim((string) ($_POST['title'] ?? '')),
        'meta_title' => trim((string) ($_POST['meta_title'] ?? '')),
        'meta_description' => trim((string) ($_POST['meta_description'] ?? '')),
        'social_image' => $socialImage,
        'hero_title' => trim((string) ($_POST['hero_title'] ?? '')),
        'hero_subtitle' => trim((string) ($_POST['hero_subtitle'] ?? '')),
    ];

    $sectionPayloads = [];
    foreach ($sectionMap[$pageSlug] as $sectionKey) {
        $imagePath = trim((string) ($_POST['sections'][$sectionKey]['image_path'] ?? ''));
        $uploaded = upload_cms_image('section_image_' . $sectionKey, $pageSlug . '-' . $sectionKey, $errors);
        if ($uploaded) {
            $imagePath = $uploaded;
        }
        $imagePath = admin_cms_validate_asset_path($imagePath, ucwords(str_replace('_', ' ', $sectionKey)) . ' Image Path', $errors);
        $buttonUrl = admin_cms_validate_public_url((string) ($_POST['sections'][$sectionKey]['button_url'] ?? ''), ucwords(str_replace('_', ' ', $sectionKey)) . ' Button URL', $errors);

        $sectionPayloads[$sectionKey] = [
            'eyebrow' => trim((string) ($_POST['sections'][$sectionKey]['eyebrow'] ?? '')),
            'title' => trim((string) ($_POST['sections'][$sectionKey]['title'] ?? '')),
            'body' => trim((string) ($_POST['sections'][$sectionKey]['body'] ?? '')),
            'button_label' => trim((string) ($_POST['sections'][$sectionKey]['button_label'] ?? '')),
            'button_url' => $buttonUrl,
            'image_path' => $imagePath,
            'is_enabled' => isset($_POST['sections'][$sectionKey]['is_enabled']) ? 1 : 0,
            'sort_order' => (int) ($_POST['sections'][$sectionKey]['sort_order'] ?? 0),
        ];
    }
    $postedSections = $sectionPayloads;

    if (!$errors) {
        db()->beginTransaction();
        try {
            cms_save_page($pageSlug, $postedPage);
            foreach ($sectionPayloads as $sectionKey => $payload) {
                cms_save_section($pageSlug, $sectionKey, $payload);
            }
            db()->commit();
        } catch (Throwable $exception) {
            db()->rollBack();
            $errors[] = 'Unable to save page content. Please try again.';
        }
        if (!$errors) {
            flash('Page content saved.');
            redirect('content-page.php?page=' . $pageSlug);
        }
    }
}

$page = cms_page($pageSlug);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $errors && $postedPage !== null) {
    $page = array_merge($page, $postedPage);
}

admin_header('Edit ' . ucfirst($pageSlug) . ' Content');
?>
<form class="admin-card" method="post" enctype="multipart/form-data">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
  <?php foreach ($errors as $error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endforeach; ?>
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">Page Content</div>
      <h2 class="admin-card__title"><?= e(ucfirst($pageSlug)) ?> Page</h2>
      <p class="admin-card__note">Basic SEO, page title, and structured public sections.</p>
    </div>
    <div class="admin-actions">
      <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Page</button>
      <a class="btn btn-outline-secondary" href="../<?= e($pageSlug === 'home' ? 'index.php' : 'page-' . $pageSlug . '.php') ?>" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> View Public</a>
      <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
    </div>
  </div>
  <div class="admin-form-section">
    <div class="admin-section-title">SEO and Page Header</div>
    <div class="row">
      <div class="col-md-6 mb-3"><label>Page Title</label><input class="form-control" name="title" value="<?= e($page['title']) ?>"></div>
      <div class="col-md-6 mb-3"><label>Meta Title</label><input class="form-control" name="meta_title" value="<?= e($page['meta_title']) ?>"></div>
      <div class="col-12 mb-3"><label>Meta Description</label><textarea class="form-control" name="meta_description"><?= e($page['meta_description']) ?></textarea></div>
      <div class="col-md-6 mb-3"><label>Hero Title</label><input class="form-control" name="hero_title" value="<?= e($page['hero_title']) ?>"></div>
      <div class="col-md-6 mb-3"><label>Hero Subtitle</label><input class="form-control" name="hero_subtitle" value="<?= e($page['hero_subtitle']) ?>"></div>
      <div class="col-md-8 mb-3"><label>Social Image Path</label><input class="form-control" name="social_image" value="<?= e($page['social_image']) ?>"></div>
      <div class="col-md-4 mb-3"><label>Upload Social Image</label><input class="form-control" type="file" name="social_image_upload" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"></div>
      <div class="col-12"><?php admin_cms_image_preview($page['social_image'], $page['title']); ?></div>
    </div>
  </div>
  <?php foreach ($sectionMap[$pageSlug] as $sectionKey): $section = cms_section($pageSlug, $sectionKey); $section = array_merge($section, $postedSections[$sectionKey] ?? []); ?>
    <div class="admin-form-section">
      <div class="admin-section-title"><?= e(ucwords(str_replace('_', ' ', $sectionKey))) ?></div>
      <div class="row">
        <div class="col-md-4 mb-3"><label>Eyebrow</label><input class="form-control" name="sections[<?= e($sectionKey) ?>][eyebrow]" value="<?= e($section['eyebrow']) ?>"></div>
        <div class="col-md-8 mb-3"><label>Title</label><input class="form-control" name="sections[<?= e($sectionKey) ?>][title]" value="<?= e($section['title']) ?>"></div>
        <div class="col-12 mb-3"><label>Body</label><textarea class="form-control" name="sections[<?= e($sectionKey) ?>][body]"><?= e($section['body']) ?></textarea></div>
        <div class="col-md-4 mb-3"><label>Button Label</label><input class="form-control" name="sections[<?= e($sectionKey) ?>][button_label]" value="<?= e($section['button_label']) ?>"></div>
        <div class="col-md-4 mb-3"><label>Button URL</label><input class="form-control" name="sections[<?= e($sectionKey) ?>][button_url]" value="<?= e($section['button_url']) ?>"></div>
        <div class="col-md-4 mb-3"><label>Sort Order</label><input class="form-control" type="number" name="sections[<?= e($sectionKey) ?>][sort_order]" value="<?= e((string) $section['sort_order']) ?>"></div>
        <div class="col-md-8 mb-3"><label>Image Path</label><input class="form-control" name="sections[<?= e($sectionKey) ?>][image_path]" value="<?= e($section['image_path']) ?>"></div>
        <div class="col-md-4 mb-3"><label>Upload Image</label><input class="form-control" type="file" name="section_image_<?= e($sectionKey) ?>" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"></div>
        <div class="col-12"><?php admin_cms_image_preview($section['image_path'], $section['title']); ?></div>
        <div class="col-12 form-check mb-3">
          <input class="form-check-input" type="checkbox" id="enabled-<?= e($sectionKey) ?>" name="sections[<?= e($sectionKey) ?>][is_enabled]" <?= admin_checked($section['is_enabled']) ?>>
          <label class="form-check-label" for="enabled-<?= e($sectionKey) ?>">Enabled</label>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  <div class="admin-actions mt-4">
    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Page</button>
    <a class="btn btn-outline-secondary" href="content.php"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
  </div>
</form>
<?php admin_footer(); ?>
