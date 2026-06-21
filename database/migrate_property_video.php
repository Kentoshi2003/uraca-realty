<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (PHP_SAPI !== 'cli') {
    exit('Run this migration from the command line.');
}

$stmt = db()->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'properties' AND COLUMN_NAME = 'video_path'");
$stmt->execute();

if ((int) $stmt->fetchColumn() === 0) {
    db()->exec('ALTER TABLE properties ADD COLUMN video_path VARCHAR(255) NULL AFTER hero_image');
    echo "Added properties.video_path.\n";
} else {
    echo "properties.video_path already exists.\n";
}
