<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (PHP_SAPI !== 'cli') {
    exit('Run this importer from the command line.');
}

$slug = trim((string) ($argv[1] ?? ''));
if ($slug === '') {
    fwrite(STDERR, "Usage: php database/upsert_listing_from_json.php <listing-slug>\n");
    exit(1);
}

$jsonPath = __DIR__ . '/../data/properties.json';
$payload = json_decode((string) file_get_contents($jsonPath), true, 512, JSON_THROW_ON_ERROR);
$listing = null;

foreach ($payload['properties'] ?? [] as $property) {
    if (($property['id'] ?? '') === $slug) {
        $listing = $property;
        break;
    }
}

if (!$listing) {
    fwrite(STDERR, "Listing not found in data/properties.json: {$slug}\n");
    exit(1);
}

$pdo = db();
$categoryStmt = $pdo->prepare('SELECT id FROM categories WHERE slug = :slug LIMIT 1');
$categoryStmt->execute(['slug' => $listing['category']]);
$categoryId = $categoryStmt->fetchColumn();

if (!$categoryId) {
    fwrite(STDERR, "Category not found: {$listing['category']}\n");
    exit(1);
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
    echo "Listing imported: {$listing['name']} (ID {$savedId})\n";
} catch (Throwable $exception) {
    $pdo->rollBack();
    throw $exception;
}
