<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

if (PHP_SAPI !== 'cli') {
    exit('Run this migration from the command line.');
}

$updates = [
    'Emily Carter' => [
        'headline' => 'Warm, patient guidance from inquiry to turnover',
        'quote' => 'Uraca Realty helped our family compare homes around Davao City without pressure. Marylyn explained the documents clearly, scheduled viewings around our work hours, and guided us until we felt confident with our decision.',
        'client_name' => 'Ana',
        'client_role' => 'First-time Home Buyer, Davao City',
    ],
    'Marcus Vance' => [
        'headline' => 'Local market advice that made the sale smoother',
        'quote' => 'We wanted to sell our property in Buhangin but were unsure about pricing and buyer screening. Uraca Realty gave practical market advice, handled inquiries professionally, and helped us move forward with a serious buyer.',
        'client_name' => 'Ramon',
        'client_role' => 'Property Seller, Buhangin',
    ],
];

$stmt = db()->prepare('UPDATE cms_testimonials
    SET headline = :headline, quote = :quote, client_name = :new_client_name, client_role = :client_role
    WHERE client_name = :old_client_name');
$updated = 0;

foreach ($updates as $oldClientName => $data) {
    $stmt->execute([
        'headline' => $data['headline'],
        'quote' => $data['quote'],
        'new_client_name' => $data['client_name'],
        'client_role' => $data['client_role'],
        'old_client_name' => $oldClientName,
    ]);
    $updated += $stmt->rowCount();
}

echo 'Filipino testimonial migration complete. Rows updated: ' . $updated . PHP_EOL;
