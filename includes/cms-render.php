<?php

declare(strict_types=1);

function cms_stars(int $rating): string
{
    $rating = max(1, min(5, $rating));
    return str_repeat('<i class="fa fa-star"></i>', $rating);
}

function render_cms_service_cards(int $limit = 4): void
{
    foreach (array_slice(cms_services(), 0, $limit) as $index => $service): ?>
      <?php $detailUrl = !empty($service['slug']) ? 'page-service-details.php?service=' . rawurlencode((string) $service['slug']) : validate_public_url($service['detail_url'] ?: 'page-service-details.php', 'page-service-details.php'); ?>
      <div class="service-block-one">
        <div class="inner-block wow fadeInUp" data-wow-delay="<?= e((string) (($index + 1) * 200)) ?>ms">
          <div class="icon"><i class="<?= e($service['icon_class'] ?: 'flaticon-set-agreement') ?>"></i></div>
          <div class="h5 title"><a href="<?= e($detailUrl) ?>"><?= e($service['title']) ?></a></div>
          <div class="text"><?= e($service['summary']) ?></div>
        </div>
      </div>
    <?php endforeach;
}

function render_cms_featured_properties(): void
{
    $featured = cms_featured_properties(3);
    if (!$featured) {
        $featured = array_slice(get_all_admin_properties(), 0, 3);
    }

    foreach ($featured as $index => $property):
        if ((int) ($property['is_published'] ?? 1) !== 1) {
            continue;
        }
        $images = get_property_images((int) $property['id']);
        $primaryImage = validate_asset_path($property['hero_image'] ?: ($images[0]['image_path'] ?? ''), 'images/resource/project1-1.jpg');
        $secondaryImage = validate_asset_path($images[1]['image_path'] ?? $primaryImage, $primaryImage);
        $blockClass = $index % 2 === 1 ? 'feature-block-two' : 'feature-block';
        $stats = [
            'Lot Area' => $property['lot_area'] ?? '',
            'Bedrooms' => $property['bedrooms'] ?? '',
            'Baths' => $property['bathrooms'] ?? '',
            'Parking' => $property['parking'] ?? '',
        ];
        ?>
        <div class="<?= e($blockClass) ?>">
          <div class="inner-block wow fadeInUp" data-wow-delay="<?= e((string) (($index + 2) * 100)) ?>ms">
            <div class="image-block">
              <div class="image-1">
                <div class="inner-box overflow-hidden" data-height="600">
                  <img data-speed="0.8" src="<?= e($primaryImage) ?>" alt="<?= e($property['name']) ?>">
                </div>
              </div>
              <div class="image-2">
                <div class="inner-box overflow-hidden" data-height="600">
                  <img data-speed="0.8" src="<?= e($secondaryImage) ?>" alt="<?= e($property['name']) ?>">
                </div>
                <div class="img-text-block">
                  <div class="icon"><img src="images/icons/marker-pin.png" alt=""></div>
                  <div class="text"><?= e($property['location'] ?: 'Davao City') ?></div>
                </div>
              </div>
            </div>
            <div class="content-block">
              <div class="h6 subtitle"><?= e($property['category_name'] ?? 'Featured Listing') ?></div>
              <div class="h3 title tx-title tz-itm-title tz-itm-anim"><?= e($property['name']) ?></div>
              <div class="text"><?= e($property['summary']) ?></div>
              <div class="features-list">
                <?php foreach ($stats as $label => $value): ?>
                  <?php if (trim((string) $value) !== ''): ?>
                    <div class="list-item">
                      <div class="icon"><img src="images/icons/feature1-icon1.png" alt=""></div>
                      <div class="ftr-title"><?= e($label) ?></div>
                      <div class="separetor">:</div>
                      <div class="value"><?= e($value) ?></div>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
              <a href="page-project-details.php?id=<?= e($property['slug']) ?>" class="btn-style-one">
                View Property Details
                <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
              </a>
            </div>
          </div>
        </div>
    <?php endforeach;
}

function render_cms_testimonials(int $limit = 2): void
{
    foreach (array_slice(cms_testimonials(), 0, $limit) as $index => $testimonial): ?>
      <div class="col-xl-6">
        <div class="testimonial-block">
          <div class="inner-box wow fadeInUp" data-wow-delay="<?= e((string) (($index + 2) * 100)) ?>ms">
            <div class="content-box">
              <div class="logo"><i class="fa-classic fa-solid fa-quote-left"></i></div>
              <div class="h4 focus-text"><?= e($testimonial['headline']) ?></div>
              <div class="h5 text">"<?= e($testimonial['quote']) ?>"</div>
              <div class="info-box">
                <div class="user-info">
                  <div class="h5 name"><?= e($testimonial['client_name']) ?></div>
                  <span class="designation"><?= e($testimonial['client_role']) ?></span>
                </div>
                <div class="rating"><?= cms_stars((int) $testimonial['rating']) ?></div>
              </div>
            </div>
            <figure class="image-box">
              <img src="<?= e(validate_asset_path($testimonial['image_path'] ?: '', 'images/resource/testimonial1-1.jpg')) ?>" alt="<?= e($testimonial['client_name']) ?>">
            </figure>
          </div>
        </div>
      </div>
    <?php endforeach;
}

function render_public_flash(): void
{
    $flash = flash();
    if (!$flash) {
        return;
    }
    ?>
    <div class="alert alert-<?= e($flash['type']) ?>" style="margin-bottom: 24px;"><?= e($flash['message']) ?></div>
    <?php
}
