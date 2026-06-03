<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/public-layout.php';

try {
    $categories = get_categories();
} catch (Throwable $exception) {
    render_setup_error($exception);
}

render_public_head(
    'Listings | Uraca Realty PH',
    'Browse Uraca Realty property categories powered by the PHP and MySQL listing backend.',
    'page-projects.php'
);
render_public_header();
render_page_title('Listings', ['Listings' => null]);
?>
<section class="project-section pt-120 pb-90">
  <div class="auto-container">
    <div class="row">
      <?php foreach ($categories as $category): ?>
        <div class="col-md-6">
          <div class="project-block mb-30">
            <div class="inner-block">
              <div class="image-block">
                <a class="image" href="<?= e($category['page_url']) ?>">
                  <img src="<?= e($category['hero_image']) ?>" alt="<?= e($category['name']) ?>">
                  <img src="<?= e($category['hero_image']) ?>" alt="<?= e($category['name']) ?>">
                </a>
              </div>
              <div class="content-block">
                <div class="h4 title"><a href="<?= e($category['page_url']) ?>"><?= e($category['name']) ?></a></div>
                <a href="<?= e($category['page_url']) ?>" class="read-more"><img src="images/icons/btn-icon-2.png" alt="<?= e($category['name']) ?>"></a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php render_public_footer(); ?>

