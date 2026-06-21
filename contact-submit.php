<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('page-contact.php');
}

$sourcePage = (string) ($_POST['source_page'] ?? 'page-contact.php');
$returnTo = in_array($sourcePage, ['index.php', 'page-contact.php'], true) ? $sourcePage : 'page-contact.php';
$propertySlug = limit_text($_POST['property_slug'] ?? '', 190);
$property = null;

try {
    verify_csrf();

    if ($propertySlug !== '') {
        if (!preg_match('/^[a-z0-9-]+$/', $propertySlug)) {
            throw new InvalidArgumentException('Invalid property reference.');
        }
        $property = get_property_by_slug($propertySlug);
        if (!$property) {
            flash('This property is no longer available for inquiries.', 'danger');
            redirect('page-contact.php');
        }
        $returnTo = 'page-project-details.php?id=' . rawurlencode($propertySlug) . '#property-inquiry';
    }

    if (trim((string) ($_POST['form_botcheck'] ?? '')) !== '') {
        flash('Message sent.', 'success');
        redirect($returnTo);
    }

    $name = limit_text($_POST['form_name'] ?? '', 160);
    $email = limit_text($_POST['form_email'] ?? '', 190);
    $phone = limit_text($_POST['form_phone'] ?? '', 80);
    $subject = $property
        ? limit_text('Property inquiry: ' . $property['name'], 190)
        : limit_text($_POST['form_subject'] ?? '', 190);
    $message = limit_text($_POST['form_message'] ?? '', 5000);

    if ($name === '' || $email === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        flash('Please enter your name, a valid email, and a message.', 'danger');
        redirect($returnTo);
    }

    cms_save_inquiry([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'subject' => $subject,
        'message' => $message,
        'source_page' => $property
            ? 'page-project-details.php?id=' . $propertySlug
            : $returnTo,
        'property_id' => $property ? (int) $property['id'] : null,
    ]);

    flash('Message sent. We will review your inquiry shortly.', 'success');
    redirect($returnTo);
} catch (Throwable) {
    flash('Unable to send your message right now. Please try again later.', 'danger');
    redirect($returnTo);
}
