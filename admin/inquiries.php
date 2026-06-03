<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $id = (int) ($_POST['id'] ?? 0);
    if ($id > 0) {
        cms_mark_inquiry_read($id, (int) ($_POST['is_read'] ?? 0) === 1);
        flash('Inquiry updated.');
    }
    redirect('inquiries.php');
}

$inquiries = cms_table_ready('contact_inquiries') ? cms_inquiries() : [];

admin_header('Contact Inquiries');
?>
<div class="admin-card">
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">Messages</div>
      <h2 class="admin-card__title">Contact Inquiries</h2>
      <p class="admin-card__note">Messages submitted from public contact forms.</p>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table admin-table align-middle">
      <thead>
        <tr>
          <th>Status</th>
          <th>Sender</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Date</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($inquiries as $inquiry): ?>
          <tr>
            <td>
              <?php if ((int) $inquiry['is_read'] === 1): ?>
                <span class="admin-pill admin-pill--published"><i class="fa-solid fa-envelope-open me-1"></i> Read</span>
              <?php else: ?>
                <span class="admin-pill admin-pill--draft"><i class="fa-solid fa-envelope me-1"></i> Unread</span>
              <?php endif; ?>
            </td>
            <td>
              <strong><?= e($inquiry['name']) ?></strong><br>
              <a href="mailto:<?= e($inquiry['email']) ?>"><?= e($inquiry['email']) ?></a><br>
              <span class="text-muted" style="font-size: 13px;"><?= e($inquiry['phone']) ?></span>
            </td>
            <td>
              <strong><?= e($inquiry['subject']) ?></strong><br>
              <small class="text-muted"><?= e($inquiry['source_page']) ?></small>
            </td>
            <td style="min-width: 280px; font-size: 13.5px; line-height: 1.5; color: #444;"><?= nl2br(e($inquiry['message'])) ?></td>
            <td style="font-size: 13px; color: #666;"><?= e($inquiry['created_at']) ?></td>
            <td class="text-end">
              <form method="post">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="id" value="<?= (int) $inquiry['id'] ?>">
                <input type="hidden" name="is_read" value="<?= (int) $inquiry['is_read'] === 1 ? 0 : 1 ?>">
                <?php if ((int) $inquiry['is_read'] === 1): ?>
                  <button class="btn btn-sm btn-outline-secondary" type="submit"><i class="fa-solid fa-envelope me-1"></i> Mark Unread</button>
                <?php else: ?>
                  <button class="btn btn-sm btn-primary" type="submit"><i class="fa-solid fa-envelope-open me-1"></i> Mark Read</button>
                <?php endif; ?>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$inquiries): ?>
          <tr><td colspan="6" class="text-center text-muted py-4">No inquiries yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php admin_footer(); ?>
