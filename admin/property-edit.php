<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

require_admin();

$propertyId = isset($_GET['id']) ? (int) $_GET['id'] : null;
$property = $propertyId ? get_admin_property($propertyId) : null;
$categories = get_categories(false);
$errors = [];

if ($propertyId && !$property) {
    flash('Listing not found.', 'danger');
    redirect('index.php');
}

function upload_listing_images(int $propertyId, string $propertyName, bool $makeFirstHero): void
{
    if (empty($_FILES['images']['name'][0])) {
        return;
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }

    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];
    $finfo = new finfo(FILEINFO_MIME_TYPE);

    foreach ($_FILES['images']['tmp_name'] as $index => $tmpName) {
        if ($_FILES['images']['error'][$index] !== UPLOAD_ERR_OK) {
            continue;
        }

        if ($_FILES['images']['size'][$index] > 5 * 1024 * 1024) {
            continue;
        }

        $mime = $finfo->file($tmpName);
        if (!isset($allowed[$mime])) {
            continue;
        }

        $fileName = slugify($propertyName) . '-' . bin2hex(random_bytes(5)) . '.' . $allowed[$mime];
        $destination = rtrim(UPLOAD_DIR, '/\\') . DIRECTORY_SEPARATOR . $fileName;

        if (move_uploaded_file($tmpName, $destination)) {
            add_property_image($propertyId, rtrim(UPLOAD_URL, '/\\') . '/' . $fileName, $propertyName, $makeFirstHero && $index === 0);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $name = trim((string) ($_POST['name'] ?? ''));
    $slug = trim((string) ($_POST['slug'] ?? '')) ?: slugify($name);
    $categoryId = (int) ($_POST['category_id'] ?? 0);

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($categoryId <= 0) {
        $errors[] = 'Category is required.';
    }

    if (!$errors) {
        $savedId = save_property([
            'category_id' => $categoryId,
            'slug' => slugify($slug),
            'name' => $name,
            'price' => trim((string) ($_POST['price'] ?? '')),
            'status' => trim((string) ($_POST['status'] ?? '')),
            'location' => trim((string) ($_POST['location'] ?? '')),
            'summary' => trim((string) ($_POST['summary'] ?? '')),
            'bedrooms' => trim((string) ($_POST['bedrooms'] ?? '')),
            'bathrooms' => trim((string) ($_POST['bathrooms'] ?? '')),
            'parking' => trim((string) ($_POST['parking'] ?? '')),
            'lot_area' => trim((string) ($_POST['lot_area'] ?? '')),
            'floor_area' => trim((string) ($_POST['floor_area'] ?? '')),
            'contact_name' => trim((string) ($_POST['contact_name'] ?? '')),
            'contact_phone' => trim((string) ($_POST['contact_phone'] ?? '')),
            'hero_image' => trim((string) ($_POST['hero_image'] ?? '')),
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ], split_lines((string) ($_POST['descriptions'] ?? '')), split_lines((string) ($_POST['features'] ?? '')), $propertyId);

        upload_listing_images($savedId, $name, trim((string) ($_POST['hero_image'] ?? '')) === '');

        flash('Listing saved.');
        redirect('property-edit.php?id=' . $savedId);
    }
}

$form = array_merge([
    'category_id' => '',
    'slug' => '',
    'name' => '',
    'price' => '',
    'status' => '',
    'location' => '',
    'summary' => '',
    'bedrooms' => '',
    'bathrooms' => '',
    'parking' => '',
    'lot_area' => '',
    'floor_area' => '',
    'contact_name' => 'Marylyn Grace Uraca',
    'contact_phone' => '+63 9185305683',
    'hero_image' => '',
    'is_published' => 1,
    'sort_order' => 0,
    'descriptions' => '',
    'features' => '',
    'images' => [],
], $property ?: []);

if ($property) {
    $form['descriptions'] = implode("\n", $property['descriptions']);
    $form['features'] = implode("\n", $property['features']);
}

admin_header($property ? 'Edit Listing' : 'Add Listing');
?>
<form class="admin-card" method="post" enctype="multipart/form-data">
  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
  <?php foreach ($errors as $error): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
  <?php endforeach; ?>
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow"><?= $property ? 'Listing Editor' : 'New Property' ?></div>
      <h2 class="admin-card__title"><?= $property ? e($form['name']) : 'Create a listing' ?></h2>
      <p class="admin-card__note">Keep pricing, media, and listing highlights polished for public pages.</p>
    </div>
    <div class="admin-actions">
      <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Listing</button>
      <a class="btn btn-outline-secondary" href="index.php"><i class="fa-solid fa-xmark"></i> Cancel</a>
    </div>
  </div>
  <div class="admin-form-section">
    <div class="admin-section-title">Core Listing Details</div>
    <div class="row">
      <div class="col-lg-8">
      <div class="mb-3">
        <label for="name">Listing Name</label>
        <input class="form-control" id="name" name="name" value="<?= e($form['name']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="summary">Summary</label>
        <textarea class="form-control" id="summary" name="summary"><?= e($form['summary']) ?></textarea>
        <div class="form-text">Short public preview shown on category cards and meta descriptions.</div>
      </div>
      <div class="mb-3">
        <label for="descriptions">Description Paragraphs</label>
        <textarea class="form-control" id="descriptions" name="descriptions" placeholder="One paragraph per line"><?= e($form['descriptions']) ?></textarea>
      </div>
      <div class="mb-3">
        <label for="features">Features</label>
        <textarea class="form-control" id="features" name="features" placeholder="One feature per line"><?= e($form['features']) ?></textarea>
      </div>
      </div>
      <div class="col-lg-4">
      <div class="mb-3">
        <label for="category_id">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
          <option value="">Choose category</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?= (int) $category['id'] ?>" <?= (int) $form['category_id'] === (int) $category['id'] ? 'selected' : '' ?>><?= e($category['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="slug">Slug</label>
        <input class="form-control" id="slug" name="slug" value="<?= e($form['slug']) ?>">
        <div class="form-text">Used in the public detail URL.</div>
      </div>
      <div class="mb-3">
        <label for="price">Price Text</label>
        <input class="form-control" id="price" name="price" value="<?= e($form['price']) ?>">
      </div>
      <div class="mb-3">
        <label for="status">Status</label>
        <input class="form-control" id="status" name="status" value="<?= e($form['status']) ?>">
      </div>
      <div class="mb-3">
        <label for="location">Location</label>
        <input class="form-control" id="location" name="location" value="<?= e($form['location']) ?>">
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" <?= (int) $form['is_published'] === 1 ? 'checked' : '' ?>>
        <label class="form-check-label" for="is_published">Published</label>
      </div>
      </div>
    </div>
  </div>
  <div class="admin-form-section">
  <div class="admin-section-title">Property Snapshot</div>
  <div class="row">
    <div class="col-md-4 mb-3">
      <label for="bedrooms">Bedrooms</label>
      <input class="form-control" id="bedrooms" name="bedrooms" value="<?= e($form['bedrooms']) ?>">
    </div>
    <div class="col-md-4 mb-3">
      <label for="bathrooms">Bathrooms</label>
      <input class="form-control" id="bathrooms" name="bathrooms" value="<?= e($form['bathrooms']) ?>">
    </div>
    <div class="col-md-4 mb-3">
      <label for="parking">Parking</label>
      <input class="form-control" id="parking" name="parking" value="<?= e($form['parking']) ?>">
    </div>
    <div class="col-md-4 mb-3">
      <label for="lot_area">Lot Area</label>
      <input class="form-control" id="lot_area" name="lot_area" value="<?= e($form['lot_area']) ?>">
    </div>
    <div class="col-md-4 mb-3">
      <label for="floor_area">Floor Area</label>
      <input class="form-control" id="floor_area" name="floor_area" value="<?= e($form['floor_area']) ?>">
    </div>
    <div class="col-md-4 mb-3">
      <label for="sort_order">Sort Order</label>
      <input class="form-control" type="number" id="sort_order" name="sort_order" value="<?= e((string) $form['sort_order']) ?>">
    </div>
  </div>
  </div>
  <div class="admin-form-section">
  <div class="admin-section-title">Contact and Media</div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="contact_name">Contact Name</label>
      <input class="form-control" id="contact_name" name="contact_name" value="<?= e($form['contact_name']) ?>">
    </div>
    <div class="col-md-6 mb-3">
      <label for="contact_phone">Contact Phone</label>
      <input class="form-control" id="contact_phone" name="contact_phone" value="<?= e($form['contact_phone']) ?>">
    </div>
  </div>
  <div class="mb-3">
    <label for="hero_image">Hero Image Path</label>
    <input class="form-control" id="hero_image" name="hero_image" value="<?= e($form['hero_image']) ?>">
  </div>
  <div class="mb-4">
    <label for="images">Upload Images</label>
    <input class="form-control" type="file" id="images" name="images[]" multiple accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
    <div class="form-text">Allowed: JPG, PNG, WEBP. Maximum 5MB each.</div>
  </div>
  </div>
  <div class="admin-actions">
    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save Listing</button>
    <a class="btn btn-outline-secondary" href="index.php"><i class="fa-solid fa-xmark"></i> Cancel</a>
  </div>
</form>

<?php if (!empty($form['images'])): ?>
  <div class="admin-card mt-4">
    <h2 class="h5 mb-3"><i class="fa-solid fa-images me-2 text-primary"></i> Listing Images</h2>
    <div class="thumb-grid">
      <?php foreach ($form['images'] as $image): ?>
        <div class="thumb-card">
          <img src="../<?= e($image['image_path']) ?>" alt="<?= e($image['alt_text']) ?>">
          <form method="post" action="image-delete.php" onsubmit="return confirm('Delete this image record?');">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <input type="hidden" name="property_id" value="<?= (int) $form['id'] ?>">
            <input type="hidden" name="image_id" value="<?= (int) $image['id'] ?>">
            <button class="btn btn-sm btn-outline-danger w-100" type="submit"><i class="fa-solid fa-trash-can me-1"></i> Delete<?= (int) $image['is_hero'] === 1 ? ' Hero' : '' ?></button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
<?php admin_footer(); ?>
