<?php

declare(strict_types=1);

function upload_cms_image(string $fieldName, string $prefix = 'cms', ?array &$errors = null): ?string
{
    if (empty($_FILES[$fieldName]['name']) || ($_FILES[$fieldName]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if (($_FILES[$fieldName]['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        $errors[] = 'Image upload failed. Please try again.';
        return null;
    }

    if (($_FILES[$fieldName]['size'] ?? 0) > 5 * 1024 * 1024) {
        $errors[] = 'Image upload failed because the file is larger than 5MB.';
        return null;
    }

    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
    ];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($_FILES[$fieldName]['tmp_name']);
    if (!isset($allowed[$mime])) {
        $errors[] = 'Image upload failed because only JPG, PNG, and WEBP files are allowed.';
        return null;
    }

    $uploadDir = URACA_BASE_PATH . '/uploads/cms';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = slugify($prefix) . '-' . bin2hex(random_bytes(5)) . '.' . $allowed[$mime];
    $destination = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

    if (!move_uploaded_file($_FILES[$fieldName]['tmp_name'], $destination)) {
        $errors[] = 'Image upload failed while saving the file.';
        return null;
    }

    return 'uploads/cms/' . $fileName;
}

function admin_checked($value): string
{
    return (int) $value === 1 ? 'checked' : '';
}

function admin_cms_validate_asset_path(?string $path, string $label, array &$errors, bool $required = false): string
{
    $path = trim((string) $path);
    if ($path === '') {
        if ($required) {
            $errors[] = $label . ' is required.';
        }
        return '';
    }

    $validated = validate_asset_path($path, '');
    if ($validated === '') {
        $errors[] = $label . ' must be an image path under images/ or uploads/, or a valid HTTPS image URL.';
    }

    return $validated;
}

function admin_cms_validate_public_url(?string $url, string $label, array &$errors, string $fallback = '', bool $allowRelative = true): string
{
    $url = trim((string) $url);
    if ($url === '') {
        return $fallback;
    }

    $validated = validate_public_url($url, '', $allowRelative);
    if ($validated === '') {
        $errors[] = $label . ' must be a safe relative URL or an HTTPS/mail/tel URL.';
    }

    return $validated;
}

function admin_cms_image_preview(?string $path, string $alt = ''): void
{
    $path = validate_asset_path($path ?? '', '');
    if ($path === '') {
        return;
    }
    ?>
    <div class="admin-image-preview mt-2">
      <img src="../<?= e($path) ?>" alt="<?= e($alt) ?>">
    </div>
    <?php
}
