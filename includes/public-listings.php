<?php

declare(strict_types=1);

function listing_filter_url(string $baseUrl, string $category = '', string $purpose = ''): string
{
    $query = [];
    if ($category !== '') {
        $query['category'] = $category;
    }
    if ($purpose !== '') {
        $query['purpose'] = $purpose;
    }

    return $baseUrl . ($query ? '?' . http_build_query($query) : '');
}

function render_listing_filters(array $categories, string $selectedCategory, string $selectedPurpose, string $baseUrl, bool $categoryLocked = false): void
{
    $purposes = ['' => 'All Listings'] + listing_purposes();
    ?>
    <nav class="uraca-listing-filters" aria-label="Listing filters">
      <?php if (!$categoryLocked): ?>
        <div class="uraca-listing-filter-group">
          <div class="uraca-listing-filter-label">Property Type</div>
          <div class="uraca-listing-filter-tabs">
            <a href="<?= e(listing_filter_url($baseUrl, '', $selectedPurpose)) ?>" class="<?= $selectedCategory === '' ? 'is-active' : '' ?>" <?= $selectedCategory === '' ? 'aria-current="page"' : '' ?>>All Types</a>
            <?php foreach ($categories as $category): ?>
              <?php $slug = (string) $category['slug']; ?>
              <a href="<?= e(listing_filter_url($baseUrl, $slug, $selectedPurpose)) ?>" class="<?= $selectedCategory === $slug ? 'is-active' : '' ?>" <?= $selectedCategory === $slug ? 'aria-current="page"' : '' ?>><?= e($category['name']) ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
      <div class="uraca-listing-filter-group">
        <div class="uraca-listing-filter-label">Listing Purpose</div>
        <div class="uraca-listing-filter-tabs uraca-listing-filter-tabs--purpose">
          <?php foreach ($purposes as $purpose => $label): ?>
            <a href="<?= e(listing_filter_url($baseUrl, $categoryLocked ? '' : $selectedCategory, $purpose)) ?>" class="<?= $selectedPurpose === $purpose ? 'is-active' : '' ?>" <?= $selectedPurpose === $purpose ? 'aria-current="page"' : '' ?>><?= e($label) ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    </nav>
    <?php
}

function render_property_card(array $property): void
{
    $detailUrl = 'page-project-details.php?id=' . rawurlencode((string) $property['slug']);
    $shareUrl = site_url($detailUrl);
    $images = get_property_images((int) $property['id']);
    $features = array_slice(get_property_features((int) $property['id']), 0, 4);
    $imagePaths = [];

    if (!empty($property['hero_image'])) {
        $imagePaths[] = $property['hero_image'];
    }

    foreach ($images as $image) {
        if (!empty($image['image_path']) && !in_array($image['image_path'], $imagePaths, true)) {
            $imagePaths[] = $image['image_path'];
        }
    }

    if (!$imagePaths) {
        $imagePaths[] = 'images/resource/project1-1.jpg';
    }

    $stats = array_values(array_filter([
        $property['bedrooms'] ?? '',
        $property['bathrooms'] ?? '',
        $property['parking'] ?? '',
        $property['floor_area'] ?? '',
        $property['lot_area'] ?? '',
    ], static fn ($value) => trim((string) $value) !== ''));
    $purpose = normalize_listing_purpose($property['listing_purpose'] ?? '') ?: 'sale';
    ?>
      <div class="col-xl-6 col-lg-6">
        <article class="uraca-property-card">
          <div class="uraca-property-card__media">
            <a class="uraca-property-card__image" href="<?= e($detailUrl) ?>">
              <img data-card-main src="<?= e($imagePaths[0]) ?>" alt="<?= e($property['name']) ?>">
            </a>
            <div class="uraca-property-card__badges">
              <span class="uraca-property-card__status"><?= e($property['status'] ?: 'Available') ?></span>
              <span class="uraca-property-card__gallery-count"><?= count($imagePaths) ?> Photo<?= count($imagePaths) === 1 ? '' : 's' ?></span>
            </div>
            <div class="uraca-property-card__thumbs">
              <?php $visibleImages = array_slice($imagePaths, 0, 4); $extraCount = count($imagePaths) - count($visibleImages); ?>
              <?php foreach ($visibleImages as $index => $imagePath): ?>
                <button type="button" class="uraca-property-card__thumb<?= $index === 0 ? ' is-active' : '' ?>" data-card-thumb data-image="<?= e($imagePath) ?>">
                  <img src="<?= e($imagePath) ?>" alt="<?= e($property['name']) ?> image <?= $index + 1 ?>">
                  <?php if ($extraCount > 0 && $index === count($visibleImages) - 1): ?><span class="uraca-property-card__thumb-more">+<?= $extraCount ?></span><?php endif; ?>
                </button>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="uraca-property-card__body">
            <div class="uraca-property-card__eyebrow-row">
              <span class="uraca-property-card__eyebrow"><?= e(listing_purposes()[$purpose]) ?></span>
              <span class="uraca-property-card__location-tag"><?= e($property['category_name'] ?? 'Property') ?></span>
            </div>
            <div class="uraca-property-card__price"><?= e($property['price'] ?: 'Price on request') ?></div>
            <h3 class="uraca-property-card__title"><a href="<?= e($detailUrl) ?>"><?= e($property['name']) ?></a></h3>
            <p class="uraca-property-card__location"><?= e($property['location'] ?: 'Location available upon request') ?></p>
            <p class="uraca-property-card__summary"><?= e($property['summary']) ?></p>
            <?php if ($stats): ?>
              <ul class="uraca-property-card__stats">
                <?php foreach ($stats as $stat): ?><li><?= e($stat) ?></li><?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <?php if ($features): ?>
              <div class="uraca-property-card__features-wrap">
                <div class="uraca-property-card__features-title">Highlights</div>
                <ul class="uraca-property-card__features">
                  <?php foreach ($features as $feature): ?><li><i class="icon fa-solid fa-circle-check"></i><span><?= e($feature) ?></span></li><?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
            <div class="uraca-property-card__actions">
              <a class="theme-btn btn-style-one uraca-property-card__button" href="<?= e($detailUrl) ?>"><span class="btn-title">View Details</span></a>
              <button type="button" class="uraca-property-card__secondary-btn uraca-property-card__share-btn" data-copy-listing-url="<?= e($shareUrl) ?>" aria-label="Copy listing link" title="Copy listing link"><i class="fa-solid fa-link"></i></button>
            </div>
          </div>
        </article>
      </div>
    <?php
}

function render_property_grid(array $properties, string $emptyMessage = 'New matching properties will appear here after they are published.'): void
{
    ?>
    <div class="row">
      <?php if (!$properties): ?>
        <div class="col-12"><div class="uraca-empty-state"><h3>No Matching Listings</h3><p><?= e($emptyMessage) ?></p></div></div>
      <?php endif; ?>
      <?php foreach ($properties as $property): ?><?php render_property_card($property); ?><?php endforeach; ?>
    </div>
    <?php
}
