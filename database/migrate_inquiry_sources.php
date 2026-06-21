<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (PHP_SAPI !== 'cli') {
    exit('Run this migration from the command line.');
}

$pdo = db();
$columnStmt = $pdo->prepare('SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table_name AND COLUMN_NAME = :column_name');
$columnStmt->execute(['table_name' => 'contact_inquiries', 'column_name' => 'property_id']);

if ((int) $columnStmt->fetchColumn() === 0) {
    $pdo->exec('ALTER TABLE contact_inquiries ADD COLUMN property_id INT UNSIGNED NULL AFTER id');
    echo "Added contact_inquiries.property_id.\n";
} else {
    echo "contact_inquiries.property_id already exists.\n";
}

$indexStmt = $pdo->prepare('SELECT COUNT(*) FROM INFORMATION_SCHEMA.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = :table_name AND INDEX_NAME = :index_name');
$indexStmt->execute(['table_name' => 'contact_inquiries', 'index_name' => 'idx_inquiries_property']);

if ((int) $indexStmt->fetchColumn() === 0) {
    $pdo->exec('ALTER TABLE contact_inquiries ADD INDEX idx_inquiries_property (property_id)');
    echo "Added idx_inquiries_property.\n";
} else {
    echo "idx_inquiries_property already exists.\n";
}
