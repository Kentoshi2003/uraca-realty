<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (PHP_SAPI !== 'cli') {
    exit('Run this migration from the command line.');
}

function migration_column_exists(PDO $pdo, string $table, string $column): bool
{
    $stmt = $pdo->prepare('SELECT COUNT(*)
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table_name AND COLUMN_NAME = :column_name');
    $stmt->execute(['table_name' => $table, 'column_name' => $column]);

    return (int) $stmt->fetchColumn() > 0;
}

function migration_index_exists(PDO $pdo, string $table, string $index): bool
{
    $stmt = $pdo->prepare('SELECT COUNT(*)
        FROM INFORMATION_SCHEMA.STATISTICS
        WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table_name AND INDEX_NAME = :index_name');
    $stmt->execute(['table_name' => $table, 'index_name' => $index]);

    return (int) $stmt->fetchColumn() > 0;
}

function migration_unique_service_slug(PDO $pdo, string $title, ?int $serviceId = null): string
{
    $base = slugify($title);
    $slug = $base;
    $suffix = 2;
    $stmt = $pdo->prepare('SELECT id FROM cms_services WHERE slug = :slug LIMIT 1');

    while (true) {
        $stmt->execute(['slug' => $slug]);
        $existingId = $stmt->fetchColumn();
        if (!$existingId || ($serviceId !== null && (int) $existingId === $serviceId)) {
            return $slug;
        }
        $slug = $base . '-' . $suffix;
        $suffix++;
    }
}

$pdo = db();

if (!migration_column_exists($pdo, 'cms_services', 'slug')) {
    $pdo->exec('ALTER TABLE cms_services ADD COLUMN slug VARCHAR(190) NULL AFTER id');
}

if (!migration_column_exists($pdo, 'cms_services', 'deleted_at')) {
    $pdo->exec('ALTER TABLE cms_services ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL AFTER sort_order');
}

if (!migration_column_exists($pdo, 'cms_testimonials', 'deleted_at')) {
    $pdo->exec('ALTER TABLE cms_testimonials ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL AFTER sort_order');
}

foreach ($pdo->query("SELECT id, title FROM cms_services WHERE slug IS NULL OR slug = '' ORDER BY id ASC") as $service) {
    $slug = migration_unique_service_slug($pdo, (string) $service['title'], (int) $service['id']);
    $stmt = $pdo->prepare('UPDATE cms_services SET slug = :slug WHERE id = :id');
    $stmt->execute(['slug' => $slug, 'id' => (int) $service['id']]);
}

if (!migration_index_exists($pdo, 'cms_services', 'uq_cms_services_slug')) {
    $pdo->exec('ALTER TABLE cms_services ADD UNIQUE KEY uq_cms_services_slug (slug)');
}

if (!migration_index_exists($pdo, 'cms_services', 'idx_cms_services_active_sort')) {
    $pdo->exec('ALTER TABLE cms_services ADD INDEX idx_cms_services_active_sort (deleted_at, is_enabled, sort_order)');
}

if (!migration_index_exists($pdo, 'cms_testimonials', 'idx_cms_testimonials_active_sort')) {
    $pdo->exec('ALTER TABLE cms_testimonials ADD INDEX idx_cms_testimonials_active_sort (deleted_at, is_enabled, sort_order)');
}

echo "CMS CRUD migration complete.\n";
