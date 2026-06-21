<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

require_admin();

$propertyId = isset($_GET['id']) ? (int) $_GET['id'] : null;
$property = $propertyId ? get_admin_property($propertyId) : null;
$categories = get_categories(false);
$categoryIds = array_map('intval', array_column($categories, 'id'));
$errors = [];

const LISTING_HERO_WIDTH = 1600;
const LISTING_HERO_HEIGHT = 1000;
const LISTING_HERO_MIN_WIDTH = 1600;
const LISTING_HERO_MIN_HEIGHT = 1000;
const LISTING_VIDEO_MAX_BYTES = 75 * 1024 * 1024;

if ($propertyId && !$property) {
    flash('Listing not found.', 'danger');
    redirect('index.php');
}

function listing_upload_finfo(): finfo
{
    static $finfo;
    if (!$finfo) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
    }

    return $finfo;
}

function listing_allowed_image_types(): array
{
    return [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];
}

function listing_has_upload(string $fieldName, ?int $index = null): bool
{
    if (!isset($_FILES[$fieldName])) {
        return false;
    }

    if ($index === null) {
        return !empty($_FILES[$fieldName]['name']) && (int) ($_FILES[$fieldName]['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;
    }

    return !empty($_FILES[$fieldName]['name'][$index]) && (int) ($_FILES[$fieldName]['error'][$index] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;
}

function validate_listing_image_upload(string $fieldName, array &$errors, string $label, bool $requireHeroSize = false, ?int $index = null): bool
{
    if (!listing_has_upload($fieldName, $index)) {
        return true;
    }

    $file = $_FILES[$fieldName];
    $error = $index === null ? (int) $file['error'] : (int) $file['error'][$index];
    $size = $index === null ? (int) $file['size'] : (int) $file['size'][$index];
    $tmpName = $index === null ? (string) $file['tmp_name'] : (string) $file['tmp_name'][$index];

    if ($error !== UPLOAD_ERR_OK) {
        $errors[] = $label . ' upload failed. Please choose the image again.';
        return false;
    }

    if ($size > 5 * 1024 * 1024) {
        $errors[] = $label . ' must be 5MB or smaller.';
        return false;
    }

    $mime = listing_upload_finfo()->file($tmpName);
    if (!isset(listing_allowed_image_types()[$mime])) {
        $errors[] = $label . ' must be a JPG, PNG, or WEBP image.';
        return false;
    }

    $dimensions = getimagesize($tmpName);
    if (!$dimensions) {
        $errors[] = $label . ' could not be read as a valid image.';
        return false;
    }

    if ($requireHeroSize) {
        if ($dimensions[0] < LISTING_HERO_MIN_WIDTH || $dimensions[1] < LISTING_HERO_MIN_HEIGHT) {
            $errors[] = $label . ' must be at least ' . LISTING_HERO_MIN_WIDTH . 'x' . LISTING_HERO_MIN_HEIGHT . ' pixels so it fits the public hero area.';
            return false;
        }

        if (!function_exists('imagecreatetruecolor')) {
            $errors[] = $label . ' requires the PHP GD extension so it can be cropped to ' . LISTING_HERO_WIDTH . 'x' . LISTING_HERO_HEIGHT . '.';
            return false;
        }
    }

    return true;
}

function validate_listing_uploads(array &$errors): void
{
    validate_listing_image_upload('hero_image_upload', $errors, 'Hero image', true);
    validate_listing_video_upload($errors);

    if (empty($_FILES['images']['name'][0])) {
        return;
    }

    foreach ($_FILES['images']['tmp_name'] as $index => $_) {
        validate_listing_image_upload('images', $errors, 'Gallery image ' . ($index + 1), false, $index);
    }
}

function validate_listing_video_upload(array &$errors): void
{
    if (!listing_has_upload('video_upload')) {
        return;
    }

    $file = $_FILES['video_upload'];
    if ((int) ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        $errors[] = 'Property video upload failed. Check the server upload limit and choose the file again.';
        return;
    }
    if ((int) ($file['size'] ?? 0) > LISTING_VIDEO_MAX_BYTES) {
        $errors[] = 'Property video must be 75MB or smaller.';
        return;
    }

    $mime = listing_upload_finfo()->file((string) $file['tmp_name']);
    if ($mime !== 'video/mp4') {
        $errors[] = 'Property video must be an MP4 file.';
    }
}

function create_listing_image_resource(string $tmpName, string $mime)
{
    return match ($mime) {
        'image/jpeg' => imagecreatefromjpeg($tmpName),
        'image/png' => imagecreatefrompng($tmpName),
        'image/webp' => imagecreatefromwebp($tmpName),
        default => false,
    };
}

function save_listing_hero_crop(string $tmpName, string $destination, string $mime): bool
{
    $source = create_listing_image_resource($tmpName, $mime);
    if (!$source) {
        return false;
    }

    $sourceWidth = imagesx($source);
    $sourceHeight = imagesy($source);
    $targetRatio = LISTING_HERO_WIDTH / LISTING_HERO_HEIGHT;
    $sourceRatio = $sourceWidth / $sourceHeight;

    if ($sourceRatio > $targetRatio) {
        $cropHeight = $sourceHeight;
        $cropWidth = (int) round($sourceHeight * $targetRatio);
        $cropX = (int) floor(($sourceWidth - $cropWidth) / 2);
        $cropY = 0;
    } else {
        $cropWidth = $sourceWidth;
        $cropHeight = (int) round($sourceWidth / $targetRatio);
        $cropX = 0;
        $cropY = (int) floor(($sourceHeight - $cropHeight) / 2);
    }

    $target = imagecreatetruecolor(LISTING_HERO_WIDTH, LISTING_HERO_HEIGHT);
    imagecopyresampled($target, $source, 0, 0, $cropX, $cropY, LISTING_HERO_WIDTH, LISTING_HERO_HEIGHT, $cropWidth, $cropHeight);
    $saved = imagejpeg($target, $destination, 88);
    imagedestroy($source);
    imagedestroy($target);

    return $saved;
}

function upload_listing_hero_image(int $propertyId, string $propertyName, array &$errors): bool
{
    if (!listing_has_upload('hero_image_upload')) {
        return false;
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }

    $tmpName = (string) $_FILES['hero_image_upload']['tmp_name'];
    $mime = listing_upload_finfo()->file($tmpName);
    $fileName = slugify($propertyName) . '-hero-' . bin2hex(random_bytes(5)) . '.jpg';
    $destination = rtrim(UPLOAD_DIR, '/\\') . DIRECTORY_SEPARATOR . $fileName;

    if (!save_listing_hero_crop($tmpName, $destination, $mime)) {
        $errors[] = 'Hero image could not be cropped and saved.';
        return false;
    }

    add_property_image($propertyId, rtrim(UPLOAD_URL, '/\\') . '/' . $fileName, $propertyName, true);
    return true;
}

function upload_listing_images(int $propertyId, string $propertyName, bool $makeFirstHero): void
{
    if (empty($_FILES['images']['name'][0])) {
        return;
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }

    $allowed = listing_allowed_image_types();
    $finfo = listing_upload_finfo();

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

function upload_listing_video(int $propertyId, string $propertyName, array &$errors): void
{
    if (!listing_has_upload('video_upload')) {
        return;
    }

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }

    $fileName = slugify($propertyName) . '-video-' . bin2hex(random_bytes(5)) . '.mp4';
    $destination = rtrim(UPLOAD_DIR, '/\\') . DIRECTORY_SEPARATOR . $fileName;
    if (!move_uploaded_file((string) $_FILES['video_upload']['tmp_name'], $destination)) {
        $errors[] = 'Property video could not be saved.';
        return;
    }

    update_property_video_path($propertyId, rtrim(UPLOAD_URL, '/\\') . '/' . $fileName);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $name = trim((string) ($_POST['name'] ?? ''));
    $slug = trim((string) ($_POST['slug'] ?? '')) ?: slugify($name);
    $categoryId = (int) ($_POST['category_id'] ?? 0);
    $listingPurpose = normalize_listing_purpose((string) ($_POST['listing_purpose'] ?? ''));
    $videoPath = trim((string) ($_POST['video_path'] ?? ''));

    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($categoryId <= 0 || !in_array($categoryId, $categoryIds, true)) {
        $errors[] = 'Category is required.';
    }
    if ($listingPurpose === '') {
        $errors[] = 'Listing purpose must be For Sale or For Rent.';
    }
    if ($videoPath !== '' && validate_video_path($videoPath, '') === '') {
        $errors[] = 'Property video path must be an MP4 or WEBM file under images/ or uploads/.';
    }
    validate_listing_uploads($errors);

    if (!$errors) {
        $savedId = save_property([
            'category_id' => $categoryId,
            'slug' => slugify($slug),
            'name' => $name,
            'price' => trim((string) ($_POST['price'] ?? '')),
            'status' => trim((string) ($_POST['status'] ?? '')),
            'listing_purpose' => $listingPurpose,
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
            'video_path' => $videoPath,
            'is_published' => isset($_POST['is_published']) ? 1 : 0,
            'sort_order' => (int) ($_POST['sort_order'] ?? 0),
        ], split_lines((string) ($_POST['descriptions'] ?? '')), split_lines((string) ($_POST['features'] ?? '')), $propertyId);

        $uploadedHero = upload_listing_hero_image($savedId, $name, $errors);
        upload_listing_video($savedId, $name, $errors);
        if (!$errors) {
            upload_listing_images($savedId, $name, !$uploadedHero && trim((string) ($_POST['hero_image'] ?? '')) === '');
        }

        if ($errors) {
            flash('Listing details were saved, but one or more images failed to upload.', 'danger');
            redirect('property-edit.php?id=' . $savedId);
        }

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
    'listing_purpose' => 'sale',
    'location' => '',
    'summary' => '',
    'bedrooms' => '',
    'bathrooms' => '',
    'parking' => '',
    'lot_area' => '',
    'floor_area' => '',
    'contact_name' => 'Maylyn Grace Uraca',
    'contact_phone' => '+63 9185305683',
    'hero_image' => '',
    'video_path' => '',
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
        <div class="form-text">Use descriptive availability such as Pre-selling, RFO, Furnished, or Clean Title.</div>
      </div>
      <div class="mb-3">
        <label for="listing_purpose">Listing Purpose</label>
        <select class="form-select" id="listing_purpose" name="listing_purpose" required>
          <?php foreach (listing_purposes() as $purposeValue => $purposeLabel): ?>
            <option value="<?= e($purposeValue) ?>" <?= ($form['listing_purpose'] ?? 'sale') === $purposeValue ? 'selected' : '' ?>><?= e($purposeLabel) ?></option>
          <?php endforeach; ?>
        </select>
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
    <div class="form-text">Use this only for an existing image path. A new hero upload below will replace it.</div>
  </div>
  <div class="mb-4">
    <label for="hero_image_upload">Upload Hero Image</label>
    <input class="form-control" type="file" id="hero_image_upload" name="hero_image_upload" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
    <div class="form-text">Minimum <?= LISTING_HERO_MIN_WIDTH ?>x<?= LISTING_HERO_MIN_HEIGHT ?>px. The image will be center-cropped to <?= LISTING_HERO_WIDTH ?>x<?= LISTING_HERO_HEIGHT ?>px for the public hero placeholder.</div>
  </div>
  <div class="mb-4">
    <label for="images">Upload Images</label>
    <input class="form-control" type="file" id="images" name="images[]" multiple accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
    <div class="form-text">Allowed: JPG, PNG, WEBP. Maximum 5MB each.</div>
  </div>
  <div class="mb-3">
    <label for="video_path">Property Video Path</label>
    <input class="form-control" id="video_path" name="video_path" value="<?= e($form['video_path']) ?>">
    <div class="form-text">Optional existing MP4 or WEBM path under images/ or uploads/.</div>
  </div>
  <div class="mb-4">
    <label for="video_upload">Upload Property Video</label>
    <input class="form-control" type="file" id="video_upload" name="video_upload" accept="video/mp4,.mp4">
    <div class="form-text">Optional MP4 video, maximum 75MB. Your server PHP upload limit must also allow the file size.</div>
  </div>
  <?php if (!empty($form['video_path'])): ?>
    <?php $formVideoMime = str_ends_with(strtolower((string) $form['video_path']), '.webm') ? 'video/webm' : 'video/mp4'; ?>
    <video class="w-100 mb-4" controls preload="metadata" style="max-height: 420px; background: #111;">
      <source src="../<?= e($form['video_path']) ?>" type="<?= e($formVideoMime) ?>">
    </video>
  <?php endif; ?>
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
