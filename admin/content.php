<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

require_admin();

$cards = [
    ['Site Settings', 'Phone, email, address, social links, and footer text.', 'content-site.php', 'fa-solid fa-sliders'],
    ['Homepage', 'Hero, about intro, section headings, and contact intro.', 'content-page.php?page=home', 'fa-solid fa-house-chimney'],
    ['About Page', 'About page title, mission, vision, and intro copy.', 'content-page.php?page=about', 'fa-solid fa-circle-info'],
    ['Services Page', 'Services page intro and SEO content.', 'content-page.php?page=services', 'fa-solid fa-gears'],
    ['Contact Page', 'Contact page intro, SEO, and form messaging.', 'content-page.php?page=contact', 'fa-solid fa-address-book'],
    ['Services', 'Service cards and detail content.', 'content-services.php', 'fa-solid fa-hand-holding-hand'],
    ['Testimonials', 'Client testimonials, ratings, images, and ordering.', 'content-testimonials.php', 'fa-solid fa-comments'],
    ['Featured Listings', 'Choose the listings shown on the homepage.', 'content-featured.php', 'fa-solid fa-star'],
    ['Contact Inquiries', 'Review messages submitted from public forms.', 'inquiries.php', 'fa-solid fa-envelope-open-text'],
];

admin_header('Website Content');
?>
<div class="admin-card">
  <div class="admin-card__header">
    <div>
      <div class="admin-card__eyebrow">CMS</div>
      <h2 class="admin-card__title">Website Content</h2>
      <p class="admin-card__note">Edit public website content without touching PHP templates.</p>
    </div>
  </div>
  <div class="row g-4">
    <?php foreach ($cards as [$title, $note, $url, $icon]): ?>
      <div class="col-md-6 col-xl-4">
        <div class="admin-stat h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex align-items-center gap-3 mb-3">
              <span style="color: var(--uraca-brown); font-size: 1.5rem;"><i class="<?= e($icon) ?>"></i></span>
              <div class="admin-stat__label mb-0" style="font-size: 14px; font-weight: 800; color: var(--uraca-ink);"><?= e($title) ?></div>
            </div>
            <p class="admin-card__note mb-4" style="font-size: 13.5px; line-height: 1.5; min-height: 40px;"><?= e($note) ?></p>
          </div>
          <div>
            <a class="btn btn-primary btn-sm w-100" href="<?= e($url) ?>"><i class="fa-solid fa-pen-to-square"></i> Manage</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php admin_footer(); ?>

