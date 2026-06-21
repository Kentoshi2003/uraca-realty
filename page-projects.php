<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/public-layout.php';
require_once __DIR__ . '/includes/public-listings.php';

$selectedCategory = trim((string) ($_GET['category'] ?? ''));
$selectedPurpose = normalize_listing_purpose(isset($_GET['purpose']) ? (string) $_GET['purpose'] : '');

try {
    $categories = get_categories();
    $validCategorySlugs = array_column($categories, 'slug');
    if (!in_array($selectedCategory, $validCategorySlugs, true)) {
        $selectedCategory = '';
    }
    $properties = get_properties($selectedCategory, $selectedPurpose);
} catch (Throwable $exception) {
    render_setup_error($exception);
}

render_public_head('Property Listings | Uraca Realty PH', 'Browse houses, townhouses, condos, apartments, lots, commercial properties, and investment opportunities in Davao.', 'page-projects.php');
render_public_header();
render_page_title('Property Listings', ['Listings' => null]);
?>
<section class="project-section pt-120 pb-90">
  <div class="auto-container">
    <div class="sec-title text-center mb-5"><div class="h6 sub-title">Property Types</div><div class="h2 title">Explore Every Property Opportunity</div></div>
    <div class="row uraca-category-grid">
      <?php foreach ($categories as $category): ?>
        <div class="col-xl-3 col-md-6">
          <div class="project-block mb-30"><div class="inner-block"><div class="image-block"><a class="image" href="<?= e($category['page_url']) ?>"><img src="<?= e($category['hero_image']) ?>" alt="<?= e($category['name']) ?>"><img src="<?= e($category['hero_image']) ?>" alt="<?= e($category['name']) ?>"></a></div><div class="content-block"><div class="h4 title"><a href="<?= e($category['page_url']) ?>"><?= e($category['name']) ?></a></div><a href="<?= e($category['page_url']) ?>" class="read-more"><img src="images/icons/btn-icon-2.png" alt=""></a></div></div></div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="uraca-listing-hub-heading"><div><span>Available Properties</span><h2>Find the Right Listing</h2></div><strong><?= count($properties) ?> result<?= count($properties) === 1 ? '' : 's' ?></strong></div>
    <?php render_listing_filters($categories, $selectedCategory, $selectedPurpose, 'page-projects.php'); ?>
    <?php render_property_grid($properties); ?>
  </div>
</section>
<?php render_public_footer(); ?>
