<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/public-layout.php';
require_once __DIR__ . '/public-listings.php';

$selectedPurpose = normalize_listing_purpose(isset($_GET['purpose']) ? (string) $_GET['purpose'] : '');

try {
    $category = get_category_by_slug($categorySlug);
    $categories = get_categories();
    $properties = $category ? get_properties_by_category($categorySlug, true, $selectedPurpose) : [];
} catch (Throwable $exception) {
    render_setup_error($exception);
}

if (!$category) {
    http_response_code(404);
    render_public_head('Category Not Found | Uraca Realty PH', 'The requested listing category was not found.', 'page-projects.php');
    render_public_header();
    render_page_title('Category Not Found', ['Listings' => 'page-projects.php', 'Not Found' => null]);
    ?>
    <section class="project-section pt-120 pb-90"><div class="auto-container"><div class="uraca-empty-state"><h3>Category not found</h3><p>Please return to the listing categories.</p></div></div></section>
    <?php
    render_public_footer();
    return;
}

$countText = count($properties) === 1 ? '1 listing available' : count($properties) . ' listings available';
render_public_head($category['name'] . ' | Uraca Realty PH', $category['description'] ?: 'Browse active Uraca Realty listings.', $category['page_url'], $category['hero_image']);
render_public_header();
render_page_title($category['name'], ['Listings' => 'page-projects.php', $category['name'] => null]);
?>
<section class="project-section pt-120 pb-90">
  <div class="auto-container">
    <div class="row align-items-center uraca-category-intro">
      <div class="col-lg-5 mb-4 mb-lg-0"><div class="uraca-category-intro__image"><img src="<?= e($category['hero_image']) ?>" alt="<?= e($category['name']) ?>"></div></div>
      <div class="col-lg-7"><div class="uraca-category-intro__content"><span class="uraca-category-intro__eyebrow">Property Category</span><h2 class="mb-3"><?= e($category['name']) ?></h2><p class="text mb-0"><?= e($category['description']) ?></p><div class="uraca-category-intro__count"><?= e($countText) ?></div></div></div>
    </div>
    <?php render_listing_filters($categories, $categorySlug, $selectedPurpose, (string) $category['page_url'], true); ?>
    <?php render_property_grid($properties); ?>
  </div>
</section>
<?php render_public_footer(); ?>
