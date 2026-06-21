<?php

declare(strict_types=1);

function get_categories(bool $publicOnly = true): array
{
    $sql = 'SELECT * FROM categories';
    if ($publicOnly) {
        $sql .= ' WHERE is_active = 1';
    }
    $sql .= ' ORDER BY sort_order ASC, name ASC';

    return db()->query($sql)->fetchAll();
}

function get_category_by_slug(string $slug): ?array
{
    $stmt = db()->prepare('SELECT * FROM categories WHERE slug = :slug AND is_active = 1 LIMIT 1');
    $stmt->execute(['slug' => $slug]);
    $category = $stmt->fetch();

    return $category ?: null;
}

function listing_purposes(): array
{
    return [
        'sale' => 'For Sale',
        'rent' => 'For Rent',
    ];
}

function normalize_listing_purpose(?string $purpose): string
{
    $purpose = strtolower(trim((string) $purpose));
    return array_key_exists($purpose, listing_purposes()) ? $purpose : '';
}

function get_properties(?string $categorySlug = null, ?string $purpose = null, bool $publishedOnly = true): array
{
    $sql = 'SELECT p.*, c.name AS category_name, c.slug AS category_slug, c.page_url AS category_page_url
        FROM properties p
        INNER JOIN categories c ON c.id = p.category_id
        WHERE c.is_active = 1';
    $params = [];

    $categorySlug = trim((string) $categorySlug);
    if ($categorySlug !== '') {
        $sql .= ' AND c.slug = :category_slug';
        $params['category_slug'] = $categorySlug;
    }

    $purpose = normalize_listing_purpose($purpose);
    if ($purpose !== '') {
        $sql .= ' AND p.listing_purpose = :listing_purpose';
        $params['listing_purpose'] = $purpose;
    }

    if ($publishedOnly) {
        $sql .= ' AND p.is_published = 1';
    }

    $sql .= ' ORDER BY p.sort_order ASC, p.updated_at DESC, p.name ASC';
    $stmt = db()->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
}

function get_properties_by_category(string $slug, bool $publishedOnly = true, ?string $purpose = null): array
{
    return get_properties($slug, $purpose, $publishedOnly);
}

function get_property_by_slug(string $slug, bool $publishedOnly = true): ?array
{
    $sql = 'SELECT p.*, c.name AS category_name, c.slug AS category_slug, c.page_url AS category_page_url
        FROM properties p
        INNER JOIN categories c ON c.id = p.category_id
        WHERE p.slug = :slug';

    if ($publishedOnly) {
        $sql .= ' AND p.is_published = 1';
    }

    $sql .= ' LIMIT 1';
    $stmt = db()->prepare($sql);
    $stmt->execute(['slug' => $slug]);
    $property = $stmt->fetch();

    if (!$property) {
        return null;
    }

    $property['descriptions'] = get_property_descriptions((int) $property['id']);
    $property['features'] = get_property_features((int) $property['id']);
    $property['images'] = get_property_images((int) $property['id']);

    return $property;
}

function get_property_descriptions(int $propertyId): array
{
    $stmt = db()->prepare('SELECT body FROM property_descriptions WHERE property_id = :property_id ORDER BY sort_order ASC, id ASC');
    $stmt->execute(['property_id' => $propertyId]);

    return array_column($stmt->fetchAll(), 'body');
}

function get_property_features(int $propertyId): array
{
    $stmt = db()->prepare('SELECT feature FROM property_features WHERE property_id = :property_id ORDER BY sort_order ASC, id ASC');
    $stmt->execute(['property_id' => $propertyId]);

    return array_column($stmt->fetchAll(), 'feature');
}

function get_property_images(int $propertyId): array
{
    $stmt = db()->prepare('SELECT * FROM property_images WHERE property_id = :property_id ORDER BY is_hero DESC, sort_order ASC, id ASC');
    $stmt->execute(['property_id' => $propertyId]);

    return $stmt->fetchAll();
}

function get_all_admin_properties(): array
{
    $sql = 'SELECT p.*, c.name AS category_name
        FROM properties p
        INNER JOIN categories c ON c.id = p.category_id
        ORDER BY p.updated_at DESC, p.id DESC';

    return db()->query($sql)->fetchAll();
}

function get_admin_property(int $propertyId): ?array
{
    $stmt = db()->prepare('SELECT * FROM properties WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $propertyId]);
    $property = $stmt->fetch();

    if (!$property) {
        return null;
    }

    $property['descriptions'] = get_property_descriptions($propertyId);
    $property['features'] = get_property_features($propertyId);
    $property['images'] = get_property_images($propertyId);

    return $property;
}

function save_property(array $data, array $descriptions, array $features, ?int $propertyId = null): int
{
    if ($propertyId === null) {
        $stmt = db()->prepare('INSERT INTO properties
            (category_id, slug, name, price, status, listing_purpose, location, summary, bedrooms, bathrooms, parking, lot_area, floor_area, contact_name, contact_phone, hero_image, is_published, sort_order)
            VALUES
            (:category_id, :slug, :name, :price, :status, :listing_purpose, :location, :summary, :bedrooms, :bathrooms, :parking, :lot_area, :floor_area, :contact_name, :contact_phone, :hero_image, :is_published, :sort_order)');
    } else {
        $stmt = db()->prepare('UPDATE properties SET
            category_id = :category_id,
            slug = :slug,
            name = :name,
            price = :price,
            status = :status,
            listing_purpose = :listing_purpose,
            location = :location,
            summary = :summary,
            bedrooms = :bedrooms,
            bathrooms = :bathrooms,
            parking = :parking,
            lot_area = :lot_area,
            floor_area = :floor_area,
            contact_name = :contact_name,
            contact_phone = :contact_phone,
            hero_image = :hero_image,
            is_published = :is_published,
            sort_order = :sort_order
            WHERE id = :id');
    }

    $params = [
        'category_id' => (int) $data['category_id'],
        'slug' => $data['slug'],
        'name' => $data['name'],
        'price' => $data['price'],
        'status' => $data['status'],
        'listing_purpose' => normalize_listing_purpose($data['listing_purpose'] ?? '') ?: 'sale',
        'location' => $data['location'],
        'summary' => $data['summary'],
        'bedrooms' => $data['bedrooms'],
        'bathrooms' => $data['bathrooms'],
        'parking' => $data['parking'],
        'lot_area' => $data['lot_area'],
        'floor_area' => $data['floor_area'],
        'contact_name' => $data['contact_name'],
        'contact_phone' => $data['contact_phone'],
        'hero_image' => $data['hero_image'],
        'is_published' => !empty($data['is_published']) ? 1 : 0,
        'sort_order' => (int) ($data['sort_order'] ?? 0),
    ];

    if ($propertyId !== null) {
        $params['id'] = $propertyId;
    }

    $stmt->execute($params);
    $savedId = $propertyId ?? (int) db()->lastInsertId();

    replace_property_descriptions($savedId, $descriptions);
    replace_property_features($savedId, $features);

    return $savedId;
}

function replace_property_descriptions(int $propertyId, array $descriptions): void
{
    $delete = db()->prepare('DELETE FROM property_descriptions WHERE property_id = :property_id');
    $delete->execute(['property_id' => $propertyId]);

    $insert = db()->prepare('INSERT INTO property_descriptions (property_id, body, sort_order) VALUES (:property_id, :body, :sort_order)');
    foreach (array_values($descriptions) as $index => $body) {
        $insert->execute(['property_id' => $propertyId, 'body' => $body, 'sort_order' => $index]);
    }
}

function replace_property_features(int $propertyId, array $features): void
{
    $delete = db()->prepare('DELETE FROM property_features WHERE property_id = :property_id');
    $delete->execute(['property_id' => $propertyId]);

    $insert = db()->prepare('INSERT INTO property_features (property_id, feature, sort_order) VALUES (:property_id, :feature, :sort_order)');
    foreach (array_values($features) as $index => $feature) {
        $insert->execute(['property_id' => $propertyId, 'feature' => $feature, 'sort_order' => $index]);
    }
}

function add_property_image(int $propertyId, string $imagePath, ?string $altText = null, bool $isHero = false): void
{
    if ($isHero) {
        $clear = db()->prepare('UPDATE property_images SET is_hero = 0 WHERE property_id = :property_id');
        $clear->execute(['property_id' => $propertyId]);

        $updateProperty = db()->prepare('UPDATE properties SET hero_image = :hero_image WHERE id = :id');
        $updateProperty->execute(['hero_image' => $imagePath, 'id' => $propertyId]);
    }

    $stmt = db()->prepare('INSERT INTO property_images (property_id, image_path, alt_text, is_hero, sort_order)
        VALUES (:property_id, :image_path, :alt_text, :is_hero, :sort_order)');
    $stmt->execute([
        'property_id' => $propertyId,
        'image_path' => $imagePath,
        'alt_text' => $altText,
        'is_hero' => $isHero ? 1 : 0,
        'sort_order' => 100,
    ]);
}

function delete_property_image(int $imageId): void
{
    $stmt = db()->prepare('SELECT property_id, image_path, is_hero FROM property_images WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $imageId]);
    $image = $stmt->fetch();

    if (!$image) {
        return;
    }

    $delete = db()->prepare('DELETE FROM property_images WHERE id = :id');
    $delete->execute(['id' => $imageId]);

    $absolutePath = URACA_BASE_PATH . '/' . ltrim((string) $image['image_path'], '/\\');
    $uploadRoot = realpath(URACA_BASE_PATH . '/uploads');
    $realImagePath = realpath($absolutePath);
    if ($uploadRoot && $realImagePath && str_starts_with($realImagePath, $uploadRoot) && is_file($realImagePath)) {
        unlink($realImagePath);
    }

    if ((int) $image['is_hero'] === 1) {
        $next = db()->prepare('SELECT image_path FROM property_images WHERE property_id = :property_id ORDER BY sort_order ASC, id ASC LIMIT 1');
        $next->execute(['property_id' => $image['property_id']]);
        $nextImage = $next->fetch();

        $update = db()->prepare('UPDATE properties SET hero_image = :hero_image WHERE id = :id');
        $update->execute(['hero_image' => $nextImage['image_path'] ?? null, 'id' => $image['property_id']]);
    }
}

function delete_property(int $propertyId): void
{
    foreach (get_property_images($propertyId) as $image) {
        $absolutePath = URACA_BASE_PATH . '/' . ltrim((string) $image['image_path'], '/\\');
        $uploadRoot = realpath(URACA_BASE_PATH . '/uploads');
        $realImagePath = realpath($absolutePath);
        if ($uploadRoot && $realImagePath && str_starts_with($realImagePath, $uploadRoot) && is_file($realImagePath)) {
            unlink($realImagePath);
        }
    }

    $stmt = db()->prepare('DELETE FROM properties WHERE id = :id');
    $stmt->execute(['id' => $propertyId]);
}
