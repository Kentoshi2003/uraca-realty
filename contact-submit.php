<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('page-contact.php');
}

$sourcePage = (string) ($_POST['source_page'] ?? 'page-contact.php');
$returnTo = in_array($sourcePage, ['index.php', 'page-contact.php'], true) ? $sourcePage : 'page-contact.php';

try {
    verify_csrf();
    if (trim((string) ($_POST['form_botcheck'] ?? '')) !== '') {
        flash('Message sent.', 'success');
        redirect($returnTo);
    }

    $name = limit_text($_POST['form_name'] ?? '', 160);
    $email = limit_text($_POST['form_email'] ?? '', 190);
    $phone = limit_text($_POST['form_phone'] ?? '', 80);
    $subject = limit_text($_POST['form_subject'] ?? '', 190);
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
        'source_page' => $returnTo,
    ]);

    flash('Message sent. We will review your inquiry shortly.', 'success');
    redirect($returnTo);
} catch (Throwable) {
    flash('Unable to send your message right now. Please try again later.', 'danger');
    redirect($returnTo);
}
