<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (PHP_SAPI !== 'cli') {
    exit('Run this importer from the command line.');
}

$jsonPath = __DIR__ . '/../data/properties.json';
$payload = json_decode((string) file_get_contents($jsonPath), true, 512, JSON_THROW_ON_ERROR);
$pdo = db();

$pdo->beginTransaction();

try {
    foreach ($payload['categories'] ?? [] as $index => $category) {
        $stmt = $pdo->prepare('INSERT INTO categories (slug, name, description, hero_image, page_url, sort_order)
            VALUES (:slug, :name, :description, :hero_image, :page_url, :sort_order)
            ON DUPLICATE KEY UPDATE
                name = VALUES(name),
                description = VALUES(description),
                hero_image = VALUES(hero_image),
                page_url = VALUES(page_url),
                sort_order = VALUES(sort_order)');
        $stmt->execute([
            'slug' => $category['slug'],
            'name' => $category['name'],
            'description' => $category['description'] ?? null,
            'hero_image' => $category['heroImage'] ?? null,
            'page_url' => str_replace('.html', '.php', $category['pageUrl'] ?? 'page-projects.php'),
            'sort_order' => $index,
        ]);
    }

    $categoryLookup = [];
    foreach ($pdo->query('SELECT id, slug FROM categories') as $row) {
        $categoryLookup[$row['slug']] = (int) $row['id'];
    }

    foreach ($payload['properties'] ?? [] as $index => $property) {
        if (empty($categoryLookup[$property['category']])) {
            continue;
        }

        $existing = $pdo->prepare('SELECT id FROM properties WHERE slug = :slug LIMIT 1');
        $existing->execute(['slug' => $property['id']]);
        $existingId = $existing->fetchColumn();

        $savedId = save_property([
            'category_id' => $categoryLookup[$property['category']],
            'slug' => $property['id'],
            'name' => $property['name'],
            'price' => $property['price'] ?? null,
            'status' => $property['status'] ?? null,
            'listing_purpose' => $property['listingPurpose'] ?? 'sale',
            'location' => $property['location'] ?? null,
            'summary' => $property['summary'] ?? null,
            'bedrooms' => $property['bedrooms'] ?? null,
            'bathrooms' => $property['bathrooms'] ?? null,
            'parking' => $property['parking'] ?? null,
            'lot_area' => $property['lotArea'] ?? null,
            'floor_area' => $property['floorArea'] ?? null,
            'contact_name' => $property['contactName'] ?? null,
            'contact_phone' => $property['contactPhone'] ?? null,
            'hero_image' => $property['heroImage'] ?? null,
            'video_path' => $property['videoPath'] ?? null,
            'is_published' => 1,
            'sort_order' => $index,
        ], $property['description'] ?? [], $property['features'] ?? [], $existingId ? (int) $existingId : null);

        $deleteImages = $pdo->prepare('DELETE FROM property_images WHERE property_id = :property_id');
        $deleteImages->execute(['property_id' => $savedId]);

        $images = array_values(array_unique(array_filter(array_merge(
            [$property['heroImage'] ?? null],
            $property['gallery'] ?? []
        ))));

        $insertImage = $pdo->prepare('INSERT INTO property_images (property_id, image_path, alt_text, is_hero, sort_order)
            VALUES (:property_id, :image_path, :alt_text, :is_hero, :sort_order)');
        foreach ($images as $imageIndex => $imagePath) {
            $insertImage->execute([
                'property_id' => $savedId,
                'image_path' => $imagePath,
                'alt_text' => $property['name'],
                'is_hero' => $imagePath === ($property['heroImage'] ?? null) ? 1 : 0,
                'sort_order' => $imageIndex,
            ]);
        }
    }

    $adminEmail = getenv('URACA_ADMIN_EMAIL') ?: 'admin@uracarealtyph.com';
    $adminPassword = getenv('URACA_ADMIN_PASSWORD');
    if (!is_string($adminPassword) || $adminPassword === '') {
        $adminPassword = bin2hex(random_bytes(12));
    }
    $adminStmt = $pdo->prepare('INSERT INTO admins (name, email, password_hash)
        VALUES (:name, :email, :password_hash)
        ON DUPLICATE KEY UPDATE name = VALUES(name)');
    $adminStmt->execute([
        'name' => 'Uraca Admin',
        'email' => $adminEmail,
        'password_hash' => password_hash($adminPassword, PASSWORD_DEFAULT),
    ]);

    cms_seed_defaults();

    $pdo->commit();
    echo "Imported listings, CMS defaults, and admin user.\n";
    echo "Admin email: {$adminEmail}\n";
    echo "Admin password: {$adminPassword}\n";
    echo "Change this password immediately after first login.\n";
} catch (Throwable $exception) {
    $pdo->rollBack();
    throw $exception;
}
