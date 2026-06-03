<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/public-layout.php';

try {
    $category = get_category_by_slug($categorySlug);
    $properties = $category ? get_properties_by_category($categorySlug) : [];
} catch (Throwable $exception) {
    render_setup_error($exception);
}

if (!$category) {
    http_response_code(404);
    render_public_head('Category Not Found | Uraca Realty PH', 'The requested listing category was not found.', 'page-projects.php');
    render_public_header();
    render_page_title('Category Not Found', ['Listings' => 'page-projects.php', 'Not Found' => null]);
    ?>
    <section class="project-section pt-120 pb-90">
      <div class="auto-container">
        <div class="uraca-empty-state">
          <h3>Category not found</h3>
          <p>Please return to the listing categories.</p>
        </div>
      </div>
    </section>
    <?php
    render_public_footer();
    return;
}

$countText = count($properties) === 1 ? '1 listing available' : count($properties) . ' listings available';

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
                <?php
                $visibleImages = array_slice($imagePaths, 0, 4);
                $extraCount = count($imagePaths) - count($visibleImages);
                foreach ($visibleImages as $index => $imagePath):
                ?>
                  <button type="button" class="uraca-property-card__thumb<?= $index === 0 ? ' is-active' : '' ?>" data-card-thumb data-image="<?= e($imagePath) ?>">
                    <img src="<?= e($imagePath) ?>" alt="<?= e($property['name']) ?> image <?= $index + 1 ?>">
                    <?php if ($extraCount > 0 && $index === count($visibleImages) - 1): ?>
                      <span class="uraca-property-card__thumb-more">+<?= $extraCount ?></span>
                    <?php endif; ?>
                  </button>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="uraca-property-card__body">
              <div class="uraca-property-card__eyebrow-row">
                <span class="uraca-property-card__eyebrow">Premium Listing</span>
                <span class="uraca-property-card__location-tag"><?= e($property['location'] ?: 'Davao City') ?></span>
              </div>
              <div class="uraca-property-card__price"><?= e($property['price'] ?: 'Price on request') ?></div>
              <h3 class="uraca-property-card__title"><a href="<?= e($detailUrl) ?>"><?= e($property['name']) ?></a></h3>
              <p class="uraca-property-card__location"><?= e($property['location'] ?: 'Location available upon request') ?></p>
              <p class="uraca-property-card__summary"><?= e($property['summary']) ?></p>
              <?php if ($stats): ?>
                <ul class="uraca-property-card__stats">
                  <?php foreach ($stats as $stat): ?>
                    <li><?= e($stat) ?></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
              <?php if ($features): ?>
                <div class="uraca-property-card__features-wrap">
                  <div class="uraca-property-card__features-title">Highlights</div>
                  <ul class="uraca-property-card__features">
                    <?php foreach ($features as $feature): ?>
                      <li><i class="icon fa-solid fa-circle-check"></i><span><?= e($feature) ?></span></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
              <div class="uraca-property-card__actions">
                <a class="theme-btn btn-style-one uraca-property-card__button" href="<?= e($detailUrl) ?>"><span class="btn-title">View Details</span></a>
                <button type="button" class="uraca-property-card__secondary-btn uraca-property-card__share-btn" data-copy-listing-url="<?= e($shareUrl) ?>" aria-label="Copy listing link" title="Copy listing link">
                  <i class="fa-solid fa-link"></i>
                </button>
              </div>
            </div>
          </article>
        </div>
    <?php
}

render_public_head(
    $category['name'] . ' | Uraca Realty PH',
    $category['description'] ?: 'Browse active Uraca Realty listings.',
    $category['page_url'],
    $category['hero_image']
);
render_public_header();
render_page_title($category['name'], ['Listings' => 'page-projects.php', $category['name'] => null]);
?>
<section class="project-section pt-120 pb-90">
  <div class="auto-container">
    <div class="row align-items-center uraca-category-intro">
      <div class="col-lg-5 mb-4 mb-lg-0">
        <div class="uraca-category-intro__image">
          <img src="<?= e($category['hero_image']) ?>" alt="<?= e($category['name']) ?>">
        </div>
      </div>
      <div class="col-lg-7">
        <div class="uraca-category-intro__content">
          <span class="uraca-category-intro__eyebrow">Property Category</span>
          <h2 class="mb-3"><?= e($category['name']) ?></h2>
          <p class="text mb-0"><?= e($category['description']) ?></p>
          <div class="uraca-category-intro__count"><?= e($countText) ?></div>
        </div>
      </div>
    </div>
    <div class="row">
      <?php if (!$properties): ?>
        <div class="col-12">
          <div class="uraca-empty-state">
            <h3>No Published Listings Yet</h3>
            <p>New properties under this category will appear here after they are published in the admin panel.</p>
          </div>
        </div>
      <?php endif; ?>
      <?php foreach ($properties as $property): ?>
        <?php render_property_card($property); ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php render_public_footer(); ?>
