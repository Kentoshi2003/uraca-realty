<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

// Secure static token corresponding to admin key/password for auth
const DEPLOY_SYNC_TOKEN = 'LTUpH513Q6kKFOtiSVf2Ic';

$token = $_GET['token'] ?? '';
if ($token !== DEPLOY_SYNC_TOKEN) {
    http_response_code(403);
    exit('Unauthorized.');
}

$slug = $_GET['slug'] ?? '';
if ($slug === '') {
    http_response_code(400);
    exit('Missing listing slug.');
}

$jsonPath = URACA_BASE_PATH . '/data/properties.json';
if (!is_file($jsonPath)) {
    http_response_code(500);
    exit('properties.json not found.');
}

$payload = json_decode((string) file_get_contents($jsonPath), true, 512, JSON_THROW_ON_ERROR);
$listing = null;

foreach ($payload['properties'] ?? [] as $property) {
    if (($property['id'] ?? '') === $slug) {
        $listing = $property;
        break;
    }
}

if (!$listing) {
    http_response_code(404);
    exit("Listing not found in properties.json: {$slug}");
}

$pdo = db();
$categoryStmt = $pdo->prepare('SELECT id FROM categories WHERE slug = :slug LIMIT 1');
$categoryStmt->execute(['slug' => $listing['category']]);
$categoryId = $categoryStmt->fetchColumn();

if (!$categoryId) {
    http_response_code(404);
    exit("Category not found: {$listing['category']}");
}

$pdo->beginTransaction();

try {
    $existingStmt = $pdo->prepare('SELECT id, sort_order FROM properties WHERE slug = :slug LIMIT 1');
    $existingStmt->execute(['slug' => $slug]);
    $existing = $existingStmt->fetch();

    if ($existing) {
        $propertyId = (int) $existing['id'];
        $sortOrder = (int) $existing['sort_order'];
    } else {
        $sortStmt = $pdo->prepare('SELECT COALESCE(MAX(sort_order), -1) + 1 FROM properties WHERE category_id = :category_id');
        $sortStmt->execute(['category_id' => $categoryId]);
        $sortOrder = (int) $sortStmt->fetchColumn();
        $propertyId = null;
    }

    $savedId = save_property([
        'category_id' => (int) $categoryId,
        'slug' => $listing['id'],
        'name' => $listing['name'],
        'price' => $listing['price'] ?? null,
        'status' => $listing['status'] ?? null,
        'listing_purpose' => $listing['listingPurpose'] ?? 'sale',
        'location' => $listing['location'] ?? null,
        'summary' => $listing['summary'] ?? null,
        'bedrooms' => $listing['bedrooms'] ?? null,
        'bathrooms' => $listing['bathrooms'] ?? null,
        'parking' => $listing['parking'] ?? null,
        'lot_area' => $listing['lotArea'] ?? null,
        'floor_area' => $listing['floorArea'] ?? null,
        'contact_name' => $listing['contactName'] ?? null,
        'contact_phone' => $listing['contactPhone'] ?? null,
        'hero_image' => $listing['heroImage'] ?? null,
        'video_path' => $listing['videoPath'] ?? null,
        'is_published' => 1,
        'sort_order' => $sortOrder,
    ], $listing['description'] ?? [], $listing['features'] ?? [], $propertyId);

    $deleteImages = $pdo->prepare('DELETE FROM property_images WHERE property_id = :property_id');
    $deleteImages->execute(['property_id' => $savedId]);

    $heroImage = $listing['heroImage'] ?? null;
    $images = array_values(array_unique(array_filter(array_merge(
        [$heroImage],
        $listing['gallery'] ?? []
    ))));

    $insertImage = $pdo->prepare('INSERT INTO property_images
        (property_id, image_path, alt_text, is_hero, sort_order)
        VALUES (:property_id, :image_path, :alt_text, :is_hero, :sort_order)');

    foreach ($images as $index => $imagePath) {
        $insertImage->execute([
            'property_id' => $savedId,
            'image_path' => $imagePath,
            'alt_text' => $listing['name'],
            'is_hero' => $imagePath === $heroImage ? 1 : 0,
            'sort_order' => $index,
        ]);
    }

    $pdo->commit();
    echo "SUCCESS: Listing synced successfully: {$listing['name']} (ID {$savedId})";
} catch (Throwable $exception) {
    $pdo->rollBack();
    http_response_code(500);
    exit("DB_ERROR: " . $exception->getMessage());
}
