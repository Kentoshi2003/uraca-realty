<?php
require_once __DIR__ . '/includes/bootstrap.php';
$settings = cms_settings();
$contactPage = cms_page('contact');
$contactIntro = cms_section('contact', 'contact_intro');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  
  <!-- Primary SEO -->
  <title><?= e($contactPage['meta_title']) ?></title>
  <meta name="description" content="<?= e($contactPage['meta_description']) ?>" />
  <meta name="keywords" content="Uraca Realty, real estate Philippines, house and lot for sale, condos Philippines, property investment PH, buy house Philippines, real estate agent Philippines" />
  <meta name="author" content="Uraca Realty" />

  <!-- Mobile + Compatibility -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Canonical (VERY IMPORTANT FOR SEO) -->
    <link rel="canonical" href="https://uracarealtyph.com/page-contact.php" />

  <!-- Indexing -->
  <meta name="robots" content="index, follow" />

  <!-- Open Graph (Facebook / Messenger / LinkedIn) -->
  <meta property="og:title" content="<?= e($contactPage['meta_title']) ?>" />
  <meta property="og:description" content="<?= e($contactPage['meta_description']) ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://uracarealtyph.com/" />
  <meta property="og:image" content="<?= e(site_url($contactPage['social_image'])) ?>" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= e($contactPage['meta_title']) ?>" />
  <meta name="twitter:description" content="<?= e($contactPage['meta_description']) ?>" />
  <meta name="twitter:image" content="<?= e(site_url($contactPage['social_image'])) ?>" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
  <link rel="icon" href="images/favicon.png" type="image/x-icon" />

  <!-- Styles -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />

  <!-- Performance (Optional but Powerful) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>

<body>
<div class="page-wrapper">

  <div class="preloader"></div>

  <!-- Back-to-top start -->
  <div class="back-to-top-wrapper">
    <button id="back_to_top" type="button" class="back-to-top-btn" style="background-color: var(--theme-color2);">
      <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: var(--theme-color-white);">
        <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </button>
  </div>
  <!-- Back-to-top start -->

  <!-- Main Header-->
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
                  <li><a href="page-projects.php">Listings</a></li>
                  <li class="current"><a href="page-contact.php">Contact</a></li>
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

  <div id="smooth-wrapper">
    <div id="smooth-content">

      <!-- Start main-content -->
      <section class="page-title">
        <div class="large-container">
          <div class="title-outer text-center">
            <div class="h1 title">Contact Us</div>
            <ul class="page-breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li>Contact</li>
            </ul>
          </div>
        </div>
      </section>
      <!-- end main-content -->

      <!--Contact Details Start-->
      <section class="contact-details">
        <div class="container pt-110 pb-70">
          <div class="row">
            <div class="col-xl-7 col-lg-6">
              <div class="sec-title">
                <span class="sub-title before-none"><?= e($contactIntro['eyebrow'] ?: 'Send us email') ?></span>
                <div class="h2"><?= e($contactIntro['title'] ?: 'Feel free to write') ?></div>
              </div>
              <!-- Contact Form -->
              <?php render_public_flash(); ?>
              <form id="contact_form" name="contact_form" action="contact-submit.php" method="post">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="source_page" value="page-contact.php">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <input name="form_name" class="form-control" type="text" placeholder="Enter Name">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <input name="form_subject" class="form-control required" type="text" placeholder="Enter Subject">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <input name="form_phone" class="form-control" type="text" placeholder="Enter Phone">
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <textarea name="form_message" class="form-control required" rows="7" placeholder="Enter Message"></textarea>
                </div>
                <div class="mb-5">
                  <input name="form_botcheck" class="form-control" type="hidden" value="" />
                  <button type="submit" name="form_botcheck" class="btn-style-one mb-2 mb-sm-0 wow fadeInUp" data-loading-text="Please wait...">Send message <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span></button>
                  <button type="reset" name="form_botcheck" class="btn-style-one wow fadeInUp" data-loading-text="Please wait...">Reset<span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span></button>
                </div>
              </form>
              <!-- Contact Form Validation-->
            </div>
            <div class="col-xl-5 col-lg-6">
              <div class="contact-details__right">
                <div class="sec-title">
                  <span class="sub-title before-none">Need any help?</span>
                  <div class="h2">Get in touch with us</div>
                  <div class="text"><?= e($contactIntro['body'] ?: 'Message us for property inquiries, private showings, listing consultations, and guided real estate support in Davao City and nearby areas.') ?></div>
                </div>
                <ul class="list-unstyled contact-details__info">
                  <li>
                    <div class="icon">
                      <span class="fa-classic fa-light fa-phone-plus"></span>
                    </div>
                    <div class="text">
                      <div class="h5 mb-1">Have any question?</div>
                      <a href="<?= e(phone_href($settings['phone'])) ?>"><?= e($settings['phone']) ?></a>
                    </div>
                  </li>
                  <li>
                    <div class="icon">
                      <span class="fal fa-envelope"></span>
                    </div>
                    <div class="text">
                      <div class="h5 mb-1">Write email</div>
                      <a href="mailto:<?= e($settings['email']) ?>"><?= e($settings['email']) ?></a>
                    </div>
                  </li>
                  <li>
                    <div class="icon">
                      <span class="fal fa-location-arrow"></span>
                    </div>
                    <div class="text">
                      <div class="h5 mb-1">Visit anytime</div>
                      <span><?= e($settings['address']) ?></span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--Contact Details End-->

      <!-- Map Section-->
      <section class="map-section">
         <iframe  class="map w-100"  src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Davao%20City,%20Philippines&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
      </section>
      <!--End Map Section-->

      <!-- Main Footer -->
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
                    <div class="text"><em>Subscribe</em> to receive high-potential investment properties, market analysis, and expert recommendations..</div>
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
              <p class="copyright-text">Copyright 2026 by Uraca Realty</p>
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
      <!--End Main Footer -->
    </div>
  </div>


</div>
<!-- End Page Wrapper -->

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
    
<script src="js/contact-form-script.js"></script>
</body>
</html>
