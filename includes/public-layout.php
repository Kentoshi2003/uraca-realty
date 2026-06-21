<?php

declare(strict_types=1);

function render_public_head(string $title, string $description, string $canonicalPath, ?string $image = null): void
{
    $ogImage = $image ?: 'images/preview.jpg';
    $styleVersion = (string) (@filemtime(__DIR__ . '/../css/style.css') ?: 1);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= e($title) ?></title>
  <meta name="description" content="<?= e($description) ?>">
  <meta name="keywords" content="Uraca Realty, real estate Philippines, house and lot for sale, property investment PH, Davao City real estate">
  <meta name="author" content="Uraca Realty">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <link rel="canonical" href="<?= e(site_url($canonicalPath)) ?>">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="<?= e($title) ?>">
  <meta property="og:description" content="<?= e($description) ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= e(site_url($canonicalPath)) ?>">
  <meta property="og:image" content="<?= e(site_url($ogImage)) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($title) ?>">
  <meta name="twitter:description" content="<?= e($description) ?>">
  <meta name="twitter:image" content="<?= e(site_url($ogImage)) ?>">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <link rel="icon" href="images/favicon.png" type="image/x-icon">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css?v=<?= e($styleVersion) ?>" rel="stylesheet">
  <link href="css/fontawesome.css" rel="stylesheet">
  <link href="css/flaticon-set-realestate.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/aos.css" rel="stylesheet">
  <link href="css/jquery-ui.css" rel="stylesheet">
  <link href="css/jquery.fancybox.min.css" rel="stylesheet">
  <link href="css/swiper.min.css" rel="stylesheet">
  <link href="css/linear.css" rel="stylesheet">
</head>
<?php
}

function render_public_header(): void
{
    $settings = cms_settings();
    $current_script = basename($_SERVER['SCRIPT_NAME']);
    $is_listings = in_array($current_script, [
        'page-projects.php',
        'page-project-details.php',
        'page-houses-and-townhouses.php',
        'page-condos-and-apartments.php',
        'page-lots-and-land.php',
        'page-commercial-and-investment.php'
    ], true);
    ?>
<body>
<div class="page-wrapper">
  <div class="preloader"></div>
  <header class="main-header header-style-one">
    <div class="large-container">
      <div class="header-lower anim-fade-move" data-delay="0.25">
        <div class="inner-container">
          <!-- Main box -->
          <div class="main-box">
            <div class="logo-box">
              <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="Logo" /></a>
              </div>
            </div>

            <!--Nav Box-->
            <div class="nav-outer">
              <nav class="nav main-menu">
                <ul class="navigation">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="page-about.php">About Us</a></li>
                  <li><a href="page-services.php">Services</a></li>
                  <li class="<?= $is_listings ? 'current' : '' ?>"><a href="page-projects.php">Listings</a></li>
                  <li><a href="page-contact.php">Contact</a></li>
                </ul>
              </nav>
            </div>
            <div class="right-box">
              <a class="theme-btn btn-style-one" href="page-contact.php"><span class="btn-title">Get a Quote </span></a>
              <div class="ui-btn-outer">
                <button class="ui-btn search-btn"><span class="icon lnr lnr-icon-search"></span></button>
              </div>
              <!--Mobile Navigation Toggler-->
              <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
      <div class="menu-backdrop"></div>
      <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
      <nav class="menu-box">
        <div class="upper-box">
          <div class="nav-logo">
            <a href="index.php"><img src="images/logo-2.png" alt="" /></a>
          </div>
          <div class="close-btn"><i class="icon fa fa-times"></i></div>
        </div>
        <ul class="navigation clearfix">
          <!--Keep This Empty / Menu will come through Javascript-->
        </ul>
        <ul class="contact-list-one">
          <li>
            <i class="icon lnr-icon-envelope1"></i>
            <span class="title">Send Email</span>
            <div class="text"><a href="mailto:<?= e($settings['email']) ?>"><?= e($settings['email']) ?></a></div>
          </li>
        </ul>
        <ul class="social-links">
          <li><a href="#"><i class="icon fab fa-twitter"></i></a></li>
          <li><a href="#"><i class="icon fab fa-facebook-f"></i></a></li>
          <li><a href="#"><i class="icon fab fa-pinterest-p"></i></a></li>
          <li><a href="#"><i class="icon fab fa-vimeo-v"></i></a></li>
        </ul>
      </nav>
    </div>
    <!-- End Mobile Menu -->

    <!-- Header Search -->
    <div class="search-popup">
      <span class="search-back-drop"></span>
      <button class="close-search"><span class="fa fa-times"></span></button>

      <div class="search-inner">
        <form method="get" action="page-projects.php">
          <div class="form-group">
            <input type="search" name="search-field" value="" placeholder="Search..." required="" />
            <button type="submit"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
    </div>
    <!-- End Header Search -->

    <!-- Sticky Header  -->
    <div class="sticky-header">
      <div class="auto-container">
        <div class="inner-container">
          <!--Logo-->
          <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="" /></a>
          </div>

          <!--Right Col-->
          <div class="nav-outer">
            <!-- Main Menu -->
            <nav class="main-menu">
              <div class="navbar-collapse show collapse clearfix">
                <ul class="navigation clearfix">
                  <!--Keep This Empty / Menu will come through Javascript-->
                </ul>
              </div>
            </nav>
            <!-- Main Menu End-->

            <!--Mobile Navigation Toggler-->
            <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Sticky Menu -->
  </header>
  <!--End Main Header -->
<?php
}

function render_page_title(string $title, array $crumbs = []): void
{
    ?>
  <section class="page-title" style="background-image: url(images/background/page-title-bg.jpg);">
    <div class="large-container">
      <div class="title-outer text-center">
        <h1 class="title"><?= e($title) ?></h1>
        <ul class="page-breadcrumb">
          <li><a href="index.php">Home</a></li>
          <?php foreach ($crumbs as $label => $url): ?>
            <?php if ($url): ?>
              <li><a href="<?= e($url) ?>"><?= e((string) $label) ?></a></li>
            <?php else: ?>
              <li><?= e((string) $label) ?></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>
<?php
}

function render_public_footer(): void
{
    $settings = cms_settings();
    ?>
  <footer class="main-footer footer-style-one">
    <div class="floating-img bounce-x"><img src="images/background/footer-bg-obj-1.png" alt=""></div>
    <div class="floating-img2 bounce-y"><img src="images/background/footer-bg-obj-2.png" alt=""></div>
    <!-- Widgets Section -->
    <div class="widgets-section">
      <div class="auto-container">
        <div class="row">
          <!-- Footer Column -->
          <div class="footer-column col-lg-3 col-sm-6">
            <div class="footer-widget links-widget ms-0 ms-xl-4">
              <div class="h4 widget-title">Quick Links</div>
              <div class="widget-content">
                <ul class="user-links">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="page-about.php">About Us</a></li>
                  <li><a href="page-services.php">Services</a></li>
                  <li><a href="page-projects.php">Listings</a></li>
                  <li><a href="page-contact.php">Contact</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- Footer Column -->
          <div class="footer-column col-lg-6 col-sm-6">
            <div class="footer-widget news-widget">
              <div class="widget-content">
                <div class="text"><?= sanitize_html_fragment($settings['newsletter_text']) ?></div>
                <form class="newsletter-form" method="post" action="mailto:<?= e($settings['email']) ?>">
                  <div class="form-group">
                    <input type="email" name="email" class="email" placeholder="Your email address" required="">
                    <button type="button" class="subscribe-btn">Subscribe <i class="fa-light fa-paper-plane"></i></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- footer column -->
          <div class="footer-column col-lg-3 col-sm-6">
            <div class="footer-widget info-widget">
              <div class="h4 widget-title">Contact Us</div>
              <div class="widget-content">
                <!-- Contact List -->
                <div class="contact-list">
                  <div class="list-info"><a href="<?= e(phone_href($settings['phone'])) ?>"><?= e($settings['phone']) ?></a></div>
                  <div class="list-info"><a href="mailto:<?= e($settings['email']) ?>"><?= e($settings['email']) ?></a></div>
                  <div class="list-info"><a href="#" class="address"><?= e($settings['address']) ?></a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="auto-container">
      <div class="footer-bottom">
        <div class="inner-container justify-content-center justify-content-sm-between">
          <p class="copyright-text">© Copyright 2026 by Uraca Realty</p>
          <ul class="d-flex align-items-center gap-2">
            <li><a href="#0">Privacy Policy</a></li>
            <li>|</li>
            <li><a href="#0">Terms & Conditions</a></li>
          </ul>
        </div>
      </div>
    </div>
    <img class="img-reveal footer-bottom-logo" src="images/footer-bottom-logo.png" alt="">
  </footer>
</div>
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/wow.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/appear.js"></script>
<script src="js/bxslider.js"></script>
<script src="js/knob.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/gsap.min.js"></script>
<script src="js/ScrollTrigger.min.js"></script>
<script src="js/splitType.js"></script>
<script src="js/gsap-scroll-smoother.js"></script>
<script src="js/gsap-scroll-to-plugin.js"></script>
<script src="js/SplitText.min.js"></script>
<script src="js/custom-gsap.js"></script>
<script src="js/script.js"></script>
<script>
(function () {
  function showCopyToast(message) {
    var toast = document.querySelector("[data-copy-toast]");
    if (!toast) {
      toast = document.createElement("div");
      toast.className = "uraca-copy-toast";
      toast.setAttribute("data-copy-toast", "");
      document.body.appendChild(toast);
    }
    toast.textContent = message;
    toast.classList.add("is-visible");
    window.clearTimeout(showCopyToast.timeoutId);
    showCopyToast.timeoutId = window.setTimeout(function () {
      toast.classList.remove("is-visible");
    }, 2200);
  }

  document.addEventListener("click", function (event) {
    var thumb = event.target.closest("[data-card-thumb]");
    if (thumb) {
      var card = thumb.closest(".uraca-property-card");
      var mainImage = card && card.querySelector("[data-card-main]");
      if (mainImage) {
        mainImage.src = thumb.getAttribute("data-image");
        card.querySelectorAll("[data-card-thumb]").forEach(function (item) {
          item.classList.remove("is-active");
        });
        thumb.classList.add("is-active");
      }
      return;
    }

    var shareButton = event.target.closest("[data-copy-listing-url]");
    if (!shareButton) {
      return;
    }

    event.preventDefault();
    var url = shareButton.getAttribute("data-copy-listing-url");
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(url).then(function () {
        showCopyToast("Listing link Copied");
      }).catch(function () {
        showCopyToast("Unable to copy link");
      });
    } else {
      var input = document.createElement("input");
      input.value = url;
      document.body.appendChild(input);
      input.select();
      document.execCommand("copy");
      document.body.removeChild(input);
      showCopyToast("Listing link Copied");
    }
  });
})();
</script>
</body>
</html>
<?php
}

function render_setup_error(Throwable $exception): void
{
    http_response_code(500);
    render_public_head('Listings Setup Required | Uraca Realty PH', 'The listing database needs to be configured.', 'page-projects.php');
    render_public_header();
    render_page_title('Listings Setup Required', ['Listings' => null]);
    ?>
    <section class="project-section pt-120 pb-90">
      <div class="auto-container">
        <div class="uraca-empty-state">
          <h3>Database setup required</h3>
          <p>Import <code>database/schema.sql</code>, update <code>config/config.php</code>, then run <code>php database/seed_from_json.php</code>.</p>
          <p><?= e($exception->getMessage()) ?></p>
        </div>
      </div>
    </section>
    <?php
    render_public_footer();
    exit;
}
