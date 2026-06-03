<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

require_admin();
verify_csrf();

$propertyId = (int) ($_POST['id'] ?? 0);
if ($propertyId > 0) {
    delete_property($propertyId);
    flash('Listing deleted.');
}

redirect('index.php');

