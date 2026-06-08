<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (PHP_SAPI !== 'cli') {
    exit('Run this migration from the command line.');
}

$updates = [
    ['site_settings', 'setting_value'],
    ['properties', 'contact_name'],
    ['cms_testimonials', 'quote'],
];

$total = 0;
$oldName = 'Mar' . 'ylyn';
$newName = 'Maylyn';

foreach ($updates as [$table, $column]) {
    $stmt = db()->prepare("UPDATE {$table} SET {$column} = REPLACE({$column}, :old_name, :new_name) WHERE {$column} LIKE :old_name_pattern");
    $stmt->execute([
        'old_name' => $oldName,
        'new_name' => $newName,
        'old_name_pattern' => '%' . $oldName . '%',
    ]);
    $total += $stmt->rowCount();
}

echo 'Maylyn name migration complete. Rows updated: ' . $total . PHP_EOL;
