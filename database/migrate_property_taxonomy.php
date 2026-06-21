<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (PHP_SAPI !== 'cli') {
    exit('Run this migration from the command line.');
}

function taxonomy_column_exists(PDO $pdo, string $table, string $column): bool
{
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table_name AND COLUMN_NAME = :column_name');
    $stmt->execute(['table_name' => $table, 'column_name' => $column]);
    return (int) $stmt->fetchColumn() > 0;
}

function taxonomy_index_exists(PDO $pdo, string $table, string $index): bool
{
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS
        WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table_name AND INDEX_NAME = :index_name');
    $stmt->execute(['table_name' => $table, 'index_name' => $index]);
    return (int) $stmt->fetchColumn() > 0;
}

function taxonomy_upsert_category(PDO $pdo, array $category): int
{
    $stmt = $pdo->prepare('SELECT id FROM categories WHERE slug IN (:old_slug, :new_slug)
        ORDER BY CASE WHEN slug = :preferred_slug THEN 0 ELSE 1 END LIMIT 1');
    $stmt->execute([
        'old_slug' => $category['old_slug'],
        'new_slug' => $category['slug'],
        'preferred_slug' => $category['slug'],
    ]);
    $id = $stmt->fetchColumn();
    $params = [
        'slug' => $category['slug'],
        'name' => $category['name'],
        'description' => $category['description'],
        'hero_image' => $category['hero_image'],
        'page_url' => $category['page_url'],
        'sort_order' => $category['sort_order'],
    ];

    if ($id) {
        $update = $pdo->prepare('UPDATE categories SET slug = :slug, name = :name, description = :description,
            hero_image = :hero_image, page_url = :page_url, is_active = 1, sort_order = :sort_order WHERE id = :id');
        $update->execute($params + ['id' => (int) $id]);
        return (int) $id;
    }

    $insert = $pdo->prepare('INSERT INTO categories
        (slug, name, description, hero_image, page_url, is_active, sort_order)
        VALUES (:slug, :name, :description, :hero_image, :page_url, 1, :sort_order)');
    $insert->execute($params);
    return (int) $pdo->lastInsertId();
}

$pdo = db();

if (!taxonomy_column_exists($pdo, 'properties', 'listing_purpose')) {
    $pdo->exec("ALTER TABLE properties ADD COLUMN listing_purpose VARCHAR(20) NOT NULL DEFAULT 'sale' AFTER status");
}

if (!taxonomy_index_exists($pdo, 'properties', 'idx_properties_category_purpose_published')) {
    $pdo->exec('ALTER TABLE properties ADD INDEX idx_properties_category_purpose_published (category_id, listing_purpose, is_published)');
}

$categories = [
    [
        'old_slug' => 'house-and-lot',
        'slug' => 'houses-townhouses',
        'name' => 'Houses & Townhouses',
        'description' => 'Explore detached homes, house-and-lot packages, bungalows, duplexes, and townhouses for sale or rent across Davao.',
        'hero_image' => 'images/Categories/houses-townhouses.jpg',
        'page_url' => 'page-houses-and-townhouses.php',
        'sort_order' => 0,
    ],
    [
        'old_slug' => 'rentals',
        'slug' => 'condos-apartments',
        'name' => 'Condos & Apartments',
        'description' => 'Browse condominium units, apartments, studios, and urban residences available for sale or rent.',
        'hero_image' => 'images/Categories/condos-apartments.jpg',
        'page_url' => 'page-condos-and-apartments.php',
        'sort_order' => 1,
    ],
    [
        'old_slug' => 'prime-lots',
        'slug' => 'lots-land',
        'name' => 'Lots & Land',
        'description' => 'Discover residential, commercial, and investment land with strong access, development potential, and long-term value.',
        'hero_image' => 'images/Categories/lots-land.jpg',
        'page_url' => 'page-lots-and-land.php',
        'sort_order' => 2,
    ],
    [
        'old_slug' => 'construction',
        'slug' => 'commercial-investment',
        'name' => 'Commercial & Investment',
        'description' => 'Find offices, retail spaces, warehouses, mixed-use buildings, and income-focused property opportunities.',
        'hero_image' => 'images/Categories/commercial-investment.jpg',
        'page_url' => 'page-commercial-and-investment.php',
        'sort_order' => 3,
    ],
];

$pdo->beginTransaction();

try {
    $categoryIds = [];
    foreach ($categories as $category) {
        $categoryIds[$category['slug']] = taxonomy_upsert_category($pdo, $category);
    }

    $pdo->prepare("UPDATE properties SET category_id = :category_id, listing_purpose = 'rent'
        WHERE slug = 'lanang-family-townhouse-rental'")
        ->execute(['category_id' => $categoryIds['houses-townhouses']]);
    $pdo->prepare("UPDATE properties SET category_id = :category_id, listing_purpose = 'rent'
        WHERE slug = 'elev8-furnished-condo'")
        ->execute(['category_id' => $categoryIds['condos-apartments']]);
    $pdo->prepare("UPDATE properties SET category_id = :category_id, listing_purpose = 'sale'
        WHERE slug IN ('samal-view-estate-lot', 'mintal-corner-commercial-lot')")
        ->execute(['category_id' => $categoryIds['lots-land']]);
    $pdo->prepare("UPDATE properties SET category_id = :category_id, is_published = 0
        WHERE slug IN ('buhangin-modern-build-package', 'toril-duplex-construction-package')")
        ->execute(['category_id' => $categoryIds['commercial-investment']]);
    $pdo->exec("UPDATE properties SET listing_purpose = 'sale'
        WHERE listing_purpose NOT IN ('sale', 'rent') OR listing_purpose IS NULL OR listing_purpose = ''");

    $serviceSlug = 'construction-design-build';
    $service = [
        'slug' => $serviceSlug,
        'title' => 'Construction & Design-Build',
        'summary' => 'Guided residential design and construction solutions for custom homes, duplexes, and investment builds.',
        'body' => "Uraca Realty helps landowners move from initial concept to a practical construction plan through design coordination, budgeting guidance, and managed project support.\nOur construction and design-build service can accommodate modern homes, duplex concepts, phased developments, and investment-focused residential projects based on the lot, goals, and target budget.",
        'icon_class' => 'flaticon-set-building-plan',
        'image_path' => 'images/Categories/Construction.png',
        'detail_url' => 'page-service-details.php?service=' . $serviceSlug,
        'is_enabled' => 1,
        'sort_order' => 30,
    ];
    $existingService = $pdo->prepare('SELECT id FROM cms_services WHERE slug = :slug LIMIT 1');
    $existingService->execute(['slug' => $serviceSlug]);
    $serviceId = $existingService->fetchColumn();
    cms_save_service($service, $serviceId ? (int) $serviceId : null);

    $serviceOrder = [
        'Property Buying Assistance' => 10,
        'Property Selling Services' => 20,
        'Construction & Design-Build' => 30,
        'Rental & Leasing Solutions' => 40,
        'Investment Consulting Services' => 50,
    ];
    $orderStmt = $pdo->prepare('UPDATE cms_services SET sort_order = :sort_order WHERE title = :title');
    foreach ($serviceOrder as $title => $sortOrder) {
        $orderStmt->execute(['sort_order' => $sortOrder, 'title' => $title]);
    }

    $pdo->commit();
    echo "Property taxonomy migration complete.\n";
} catch (Throwable $exception) {
    $pdo->rollBack();
    throw $exception;
}
