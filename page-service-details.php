<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/public-layout.php';

$settings = cms_settings();
$servicesPage = cms_page('services');
$hasServiceParam = isset($_GET['service']);
$slug = $hasServiceParam ? slugify((string) $_GET['service']) : '';
$service = $slug !== '' ? cms_service_by_slug($slug) : null;
$services = cms_services();

if (!$hasServiceParam && !$service && $services) {
    $service = $services[0];
    $slug = (string) ($service['slug'] ?? '');
}

if ($hasServiceParam && !$service) {
    http_response_code(404);
}

$title = $service ? (string) $service['title'] . ' | Uraca Realty PH' : 'Service Not Found | Uraca Realty PH';
$description = $service ? (string) ($service['summary'] ?: $servicesPage['meta_description']) : 'The requested service could not be found.';
$canonical = $service && !empty($service['slug'])
    ? 'page-service-details.php?service=' . rawurlencode((string) $service['slug'])
    : 'page-service-details.php';
$image = $service ? validate_asset_path($service['image_path'] ?? '', 'images/resource/service-details.jpg') : 'images/resource/service-details.jpg';

render_public_head($title, $description, $canonical, $image);
render_public_header();
render_page_title($service ? (string) $service['title'] : 'Service Not Found', [
    'Services' => 'page-services.php',
    $service ? (string) $service['title'] : 'Not Found' => null,
]);
?>
  <div id="smooth-wrapper">
    <div id="smooth-content">
      <section class="services-details pt-100 pb-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-4">
              <div class="service-sidebar">
                <div class="sidebar-widget service-sidebar-single">
                  <div class="sidebar-service-list">
                    <ul>
                      <?php foreach ($services as $item): ?>
                        <?php $itemSlug = (string) ($item['slug'] ?? ''); ?>
                        <li>
                          <a href="page-service-details.php?service=<?= e(rawurlencode($itemSlug)) ?>" class="<?= $service && $itemSlug === (string) ($service['slug'] ?? '') ? 'current' : '' ?>">
                            <i class="fas fa-angle-right"></i><span><?= e($item['title']) ?></span>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class="service-details-help">
                    <div class="help-shape-1"></div>
                    <div class="help-shape-2"></div>
                    <div class="h3 help-title">Contact with <br /> us for any <br /> advice</div>
                    <div class="help-icon"><span class="lnr-icon-phone-handset"></span></div>
                    <div class="help-contact">
                      <p>Need help? Talk to an expert</p>
                      <a href="<?= e(phone_href($settings['phone'])) ?>"><?= e($settings['phone']) ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-8 col-lg-8">
              <div class="services-details__content">
                <?php if (!$service): ?>
                  <div class="uraca-empty-state">
                    <h3>Service not found</h3>
                    <p>The service you requested is unavailable or has been archived.</p>
                    <a href="page-services.php" class="theme-btn btn-style-one"><span class="btn-title">View Services</span></a>
                  </div>
                <?php else: ?>
                  <img class="w-100" src="<?= e($image) ?>" alt="<?= e($service['title']) ?>" />
                  <div class="h3 mt-4"><?= e($service['title']) ?></div>
                  <?php if (trim((string) $service['summary']) !== ''): ?>
                    <p><?= e($service['summary']) ?></p>
                  <?php endif; ?>
                  <?php foreach (split_lines((string) $service['body']) as $paragraph): ?>
                    <p><?= e($paragraph) ?></p>
                  <?php endforeach; ?>
                  <?php if (trim((string) $service['body']) === ''): ?>
                    <p>Our team will guide you through this service with practical advice, verified information, and a clear process from inquiry to completion.</p>
                  <?php endif; ?>
                  <div class="content mt-40">
                    <div class="text">
                      <div class="h3">Service Center</div>
                      <p>For tailored help with <?= e(strtolower((string) $service['title'])) ?>, contact Uraca Realty and our team will review your needs carefully.</p>
                      <blockquote class="blockquote-one">Clear guidance, verified options, and professional support for every real estate decision.</blockquote>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
<?php render_public_footer(); ?>
