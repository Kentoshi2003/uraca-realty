<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';

require_admin();
verify_csrf();

$imageId = (int) ($_POST['image_id'] ?? 0);
$propertyId = (int) ($_POST['property_id'] ?? 0);

if ($imageId > 0) {
    delete_property_image($imageId);
    flash('Image record deleted.');
}

redirect('property-edit.php?id=' . $propertyId);

