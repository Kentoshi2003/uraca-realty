<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/public-layout.php';

$slug = isset($_GET['id']) && is_string($_GET['id']) ? trim($_GET['id']) : '';

try {
    $property = $slug !== '' ? get_property_by_slug($slug) : null;
} catch (Throwable $exception) {
    render_setup_error($exception);
}

if (!$property) {
    http_response_code(404);
    render_public_head('Property Not Found | Uraca Realty PH', 'The requested property listing was not found.', 'page-project-details.php');
    render_public_header();
    render_page_title('Property Not Found', ['Listings' => 'page-projects.php', 'Not Found' => null]);
    ?>
    <section class="project-details pt-120 pb-120">
      <div class="container">
        <div class="uraca-empty-state">
          <h3>Property not found</h3>
          <p>The listing may have been unpublished or the link may be incorrect.</p>
          <a class="theme-btn btn-style-one" href="page-projects.php"><span class="btn-title">Back to Listings</span></a>
        </div>
      </div>
    </section>
    <?php
    render_public_footer();
    exit;
}

$images = $property['images'] ?: [];
$heroImage = $property['hero_image'] ?: ($images[0]['image_path'] ?? 'images/resource/project-details.jpg');
$videoPath = validate_video_path($property['video_path'] ?? '', '');
$videoMime = str_ends_with(strtolower($videoPath), '.webm') ? 'video/webm' : 'video/mp4';
$galleryImages = array_values(array_filter($images, static fn ($image) => empty($image['is_hero'])));
$specs = [
    'Bedrooms' => $property['bedrooms'],
    'Bathrooms' => $property['bathrooms'],
    'Parking' => $property['parking'],
    'Lot Area' => $property['lot_area'],
    'Floor Area' => $property['floor_area'],
];
$specs = array_filter($specs, static fn ($value) => trim((string) $value) !== '');

render_public_head(
    $property['name'] . ' | Uraca Realty PH',
    $property['summary'] ?: 'View complete property details from Uraca Realty PH.',
    'page-project-details.php?id=' . rawurlencode($property['slug']),
    $heroImage
);
render_public_header();
render_page_title($property['name'], ['Listings' => 'page-projects.php', $property['name'] => null]);
?>
<section class="project-details pt-120 pb-120">
  <div class="container">
    <div class="row g-4 align-items-stretch mb-5">
      <div class="col-xl-8">
        <div class="uraca-detail-hero-card">
          <div class="uraca-detail-hero-card__media uraca-property-detail__hero">
            <img data-speed=".8" src="<?= e($heroImage) ?>" alt="<?= e($property['name']) ?>">
            <div class="uraca-detail-hero-card__overlay">
              <div class="uraca-detail-hero-card__badge-row">
                <span class="uraca-detail-badge uraca-detail-badge--dark"><?= e($property['category_name']) ?></span>
                <span class="uraca-detail-badge uraca-detail-badge--light"><?= e($property['status']) ?></span>
              </div>
              <div class="uraca-detail-hero-card__content">
                <div class="uraca-detail-hero-card__price"><?= e($property['price']) ?></div>
                <h2 class="uraca-detail-hero-card__title"><?= e($property['name']) ?></h2>
                <p class="uraca-detail-hero-card__location"><?= e($property['location']) ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="uraca-detail-sidebar-card">
          <div class="uraca-detail-sidebar-card__section">
            <div class="uraca-detail-sidebar-card__label">Listing Snapshot</div>
            <ul class="uraca-property-specs">
              <?php foreach ($specs as $label => $value): ?>
                <li><span><?= e($label) ?></span><strong><?= e($value) ?></strong></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="uraca-detail-sidebar-card__section">
            <div class="uraca-detail-sidebar-card__label">Agent Contact</div>
            <div class="uraca-detail-contact-card">
              <div class="uraca-detail-contact-card__name"><?= e($property['contact_name'] ?: 'Maylyn Grace Uraca') ?></div>
              <div class="uraca-detail-contact-card__meta"><span>Updated <?= e(date('F Y', strtotime((string) $property['updated_at']))) ?></span></div>
              <a class="theme-btn btn-style-one w-100 mb-3 uraca-detail-contact-card__primary-btn" href="page-contact.php"><span class="btn-title">Request Property Inquiry</span></a>
              <div class="uraca-detail-contact-card__actions">
                <a class="uraca-detail-contact-card__icon-btn" href="<?= e(phone_href($property['contact_phone'])) ?>" aria-label="Call agent" title="Call">
                  <i class="fa-solid fa-phone"></i>
                </a>
                <a class="uraca-detail-contact-card__icon-btn" href="<?= e(whatsapp_href($property['contact_phone'])) ?>" target="_blank" rel="noopener noreferrer" aria-label="Open WhatsApp" title="WhatsApp">
                  <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a class="uraca-detail-contact-card__icon-btn" href="mailto:uracarealty@gmail.com?subject=Property%20Inquiry%3A%20<?= rawurlencode($property['name']) ?>" aria-label="Email agent" title="Email">
                  <i class="fa-solid fa-envelope"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="project-details__content">
      <div class="row g-5 align-items-start">
        <div class="col-xl-8">
          <div class="uraca-detail-section-card mb-4">
            <div class="uraca-detail-section-card__eyebrow">Property Overview</div>
            <p class="uraca-property-summary"><?= e($property['summary']) ?></p>
            <?php foreach ($property['descriptions'] as $paragraph): ?>
              <p class="text uraca-detail-paragraph"><?= e($paragraph) ?></p>
            <?php endforeach; ?>
          </div>
          <?php if ($videoPath !== ''): ?>
            <div class="uraca-detail-section-card mb-4">
              <div class="uraca-detail-section-header">
                <div>
                  <div class="uraca-detail-section-card__eyebrow">Video Walkthrough</div>
                  <h3 class="title mb-0">Property Video Tour</h3>
                </div>
              </div>
              <button
                class="uraca-property-video-preview"
                type="button"
                aria-label="Play property tour"
                aria-haspopup="dialog"
                aria-controls="property-video-modal"
                data-property-video-open
              >
                <img src="<?= e($heroImage) ?>" alt="" loading="lazy">
                <span class="uraca-property-video-preview__shade" aria-hidden="true"></span>
                <span class="uraca-property-video-preview__play" aria-hidden="true">
                  <i class="fa-solid fa-play"></i>
                </span>
                <span class="uraca-property-video-preview__label">Watch property tour</span>
              </button>
            </div>
          <?php endif; ?>
          <div class="uraca-detail-section-card">
            <div class="uraca-detail-section-header">
              <div>
                <div class="uraca-detail-section-card__eyebrow">Image Collection</div>
                <h3 class="title mb-0">Property Gallery</h3>
              </div>
              <div class="uraca-detail-gallery-count"><span><?= count($galleryImages) ?></span> Images</div>
            </div>
            <div class="uraca-gallery">
              <?php foreach ($galleryImages as $image): ?>
                <div class="uraca-gallery-item">
                  <a class="uraca-gallery-card" href="<?= e($image['image_path']) ?>" data-fancybox="property-gallery">
                    <img src="<?= e($image['image_path']) ?>" alt="<?= e($image['alt_text'] ?: $property['name']) ?>">
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="uraca-detail-section-card">
            <h3 class="title mb-3">Highlights</h3>
            <div class="feature-list uraca-detail-feature-list">
              <ul>
                <?php foreach ($property['features'] as $feature): ?>
                  <li><i class="icon fa-solid fa-circle-check"></i><?= e($feature) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-5 pt-3">
        <a class="theme-btn btn-style-one" href="<?= e($property['category_page_url']) ?>"><span class="btn-title">Back to <?= e($property['category_name']) ?></span></a>
      </div>
    </div>
  </div>
</section>
<?php if ($videoPath !== ''): ?>
  <div
    class="uraca-property-video-modal"
    id="property-video-modal"
    role="dialog"
    aria-modal="true"
    aria-hidden="true"
    aria-labelledby="property-video-modal-title"
    hidden
  >
    <div class="uraca-property-video-modal__backdrop" data-property-video-close></div>
    <div class="uraca-property-video-modal__dialog">
      <h2 class="visually-hidden" id="property-video-modal-title">Property Video Tour</h2>
      <button class="uraca-property-video-modal__close" type="button" aria-label="Close property video" data-property-video-close>
        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
      </button>
      <video controls playsinline preload="metadata" poster="<?= e($heroImage) ?>" data-property-video-player>
        <source src="<?= e($videoPath) ?>" type="<?= e($videoMime) ?>">
        Your browser does not support embedded property videos.
      </video>
    </div>
  </div>
  <script>
  (function () {
    const modal = document.getElementById('property-video-modal');
    const openButton = document.querySelector('[data-property-video-open]');
    const closeButton = modal ? modal.querySelector('.uraca-property-video-modal__close') : null;
    const player = modal ? modal.querySelector('[data-property-video-player]') : null;

    if (!modal || !openButton || !closeButton || !player) {
      return;
    }

    const openModal = function () {
      modal.hidden = false;
      modal.classList.add('is-open');
      modal.setAttribute('aria-hidden', 'false');
      document.body.classList.add('uraca-video-modal-open');
      closeButton.focus();
      const playPromise = player.play();
      if (playPromise && typeof playPromise.catch === 'function') {
        playPromise.catch(function () {});
      }
    };

    const closeModal = function () {
      if (!modal.classList.contains('is-open')) {
        return;
      }
      player.pause();
      try {
        player.currentTime = 0;
      } catch (error) {}
      modal.classList.remove('is-open');
      modal.setAttribute('aria-hidden', 'true');
      modal.hidden = true;
      document.body.classList.remove('uraca-video-modal-open');
      openButton.focus();
    };

    openButton.addEventListener('click', openModal);
    modal.querySelectorAll('[data-property-video-close]').forEach(function (element) {
      element.addEventListener('click', closeModal);
    });
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && modal.classList.contains('is-open')) {
        closeModal();
      }
    });
  }());
  </script>
<?php endif; ?>
<?php render_public_footer(); ?>
