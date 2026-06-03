<?php
require_once __DIR__ . '/includes/bootstrap.php';
$settings = cms_settings();
$servicesPage = cms_page('services');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <meta charset="utf-8" />
  
  <!-- Primary SEO -->
  <title><?= e($servicesPage['meta_title']) ?></title>
  <meta name="description" content="<?= e($servicesPage['meta_description']) ?>" />
  <meta name="keywords" content="Uraca Realty, real estate Philippines, house and lot for sale, condos Philippines, property investment PH, buy house Philippines, real estate agent Philippines" />
  <meta name="author" content="Uraca Realty" />

  <!-- Mobile + Compatibility -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Canonical (VERY IMPORTANT FOR SEO) -->
    <link rel="canonical" href="https://uracarealtyph.com/page-service-details.php" />

  <!-- Indexing -->
  <meta name="robots" content="index, follow" />

  <!-- Open Graph (Facebook / Messenger / LinkedIn) -->
  <meta property="og:title" content="Uraca Realty PH | Find Your Dream Property Today" />
  <meta property="og:description" content="Premium real estate opportunities in the Philippines. Buy, sell, and invest with confidence through Uraca Realty." />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://uracarealtyph.com/" />
  <meta property="og:image" content="https://uracarealtyph.com/images/preview.jpg" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Uraca Realty PH | Smart Real Estate Decisions" />
  <meta name="twitter:description" content="Discover premium homes and investment properties in the Philippines with expert guidance." />
  <meta name="twitter:image" content="https://uracarealtyph.com/images/preview.jpg" />

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
                  <li class="current"><a href="page-services.php">Services</a></li>
                  <li><a href="page-projects.php">Listings</a></li>
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
            <div class="h2">Send Email</div>
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
            <div class="h1 title">Service Details</div>
            <ul class="page-breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li>Service Details</li>
            </ul>
          </div>
        </div>
      </section>
      <!-- end main-content -->

      <!--Start Services Details-->
      <section class="services-details pt-100 pb-100">
        <div class="container">
          <div class="row">
            <!--Start Services Details Sidebar-->
            <div class="col-xl-4 col-lg-4">
              <div class="service-sidebar">
                <!--Start Services Details Sidebar Single-->
                <div class="sidebar-widget service-sidebar-single">
                  <div class="sidebar-service-list">
                    <ul>
                      <li><a href="page-service-details.php" class="current"><i class="fas fa-angle-right"></i><span>Property Buying</span></a></li>
                      <li class="current"><a href="page-service-details.php"><i class="fas fa-angle-right"></i><span>Real Estate Marketing</span></a></li>
                      <li><a href="page-service-details.php"><i class="fas fa-angle-right"></i><span>Luxury Home Sales</span></a></li>
                      <li><a href="page-service-details.php"><i class="fas fa-angle-right"></i><span>Relocation Services</span></a></li>
                      <li><a href="page-service-details.php"><i class="fas fa-angle-right"></i><span>Property Legal Assistance</span></a></li>
                      <li><a href="page-service-details.php"><i class="fas fa-angle-right"></i><span>Home Loan Consultation</span></a></li>
                    </ul>
                  </div>
                  <div class="service-details-help">
                    <div class="help-shape-1"></div>
                    <div class="help-shape-2"></div>
                    <div class="h3 help-title">Contact with <br /> us for any <br /> advice</div>
                    <div class="help-icon"><span class=" lnr-icon-phone-handset"></span></div>
                    <div class="help-contact">
                      <p>Need help? Talk to an expert</p>
                      <a href="tel:+639185305683">+63 918 530 5683</a>
                    </div>
                  </div>
                  <!--Start Services Details Sidebar Single-->
                  <div class="sidebar-widget service-sidebar-single mt-4">
                    <div class="service-sidebar-single-btn wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1200m">
                      <a href="#" class="theme-btn btn-style-one d-grid"><span class="btn-title"><span class="fas fa-file-pdf"></span> download pdf file</span></a>
                    </div>
                  </div>
                </div>
                <!--End Services Details Sidebar-->
              </div>
            </div>

            <!--Start Services Details Content-->
            <div class="col-xl-8 col-lg-8">
              <div class="services-details__content">
                <img class="w-100" src="images/resource/service-details.jpg" alt="" />
                <div class="h3 mt-4">Service Overview</div>
                <p>Lorem ipsum is simply free text used by copytyping refreshing. Neque porro est qui dolorem ipsum quia quaed inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Aelltes port lacus quis enim var sed efficitur turpis gilla sed sit amet finibus eros. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the ndustry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make </p>
                <p>When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged Lorem ipsum dolor sit amet consec tetur adipis icing elit  </p>
                <div class="content mt-40">
                  <div class="text">
                    <div class="h3">Service Center</div>
                    <p>Lorem ipsum is simply free text used by copytyping refreshing. Neque porro est qui dolorem ipsum quia quaed inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <blockquote class="blockquote-one">Lorem ipsum dolor sit amet, consectetur notted adipisicing elit sed do eiusmod remaining essentially unchanged Lorem ipsum dolor sit amet consec tetur</blockquote>
                  </div>
                  <div class="feature-list mt-4">
                    <div class="row clearfix">
                      <div class="col-lg-6 col-md-6 col-sm-12 column">
                        <img class="mb-3" src="images/resource/service-d1.jpg" alt="images" />
                        <p>Lorem ipsum dolor sit amet consec adipis elit Dolor repellat pariatur temporibus doloribus hic conse quatur copy typing refreshing</p>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 column">
                        <img class="mb-3" src="images/resource/service-d2.jpg" alt="images" />
                        <p>Lorem ipsum dolor sit amet consec adipis elit Dolor repellat pariatur temporibus doloribus hic conse quatur copy typing refreshing</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" mt-25">
                  <div class="h3">Frequently Asked Question</div>
                  <p>Lorem ipsum is simply free text used by copytyping refreshing. Neque porro est qui dolorem ipsum quia quaed inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                  <ul class="accordion-box wow fadeInRight">
                    <!--Block-->
                    <li class="accordion block">
                      <div class="acc-btn" style="color: var(--theme-color-black);">Is my technology allowed on tech?
                        <div class="icon fa fa-plus"></div>
                      </div>
                      <div class="acc-content">
                        <div class="content">
                          <div class="text">There are many variations of passages the majority have suffered alteration in some fo injected humour, or randomised words believable.</div>
                        </div>
                      </div>
                    </li>
                    <!--Block-->
                    <li class="accordion block active-block">
                      <div class="acc-btn active" style="color: var(--theme-color-black);">How to soft launch your business?
                        <div class="icon fa fa-plus"></div>
                      </div>
                      <div class="acc-content current">
                        <div class="content">
                          <div class="text">There are many variations of passages the majority have suffered alteration in some fo injected humour, or randomised words believable.</div>
                        </div>
                      </div>
                    </li>
                    <!--Block-->
                    <li class="accordion block">
                      <div class="acc-btn" style="color: var(--theme-color-black);">How to turn visitors into contributors
                        <div class="icon fa fa-plus"></div>
                      </div>
                      <div class="acc-content">
                        <div class="content">
                          <div class="text">There are many variations of passages the majority have suffered alteration in some fo injected humour, or randomised words believable.</div>
                        </div>
                      </div>
                    </li>
                    <!--Block-->
                    <li class="accordion block">
                      <div class="acc-btn" style="color: var(--theme-color-black);">How can i find my solutions?
                        <div class="icon fa fa-plus"></div>
                      </div>
                      <div class="acc-content">
                        <div class="content">
                          <div class="text">There are many variations of passages the majority have suffered alteration in some fo injected humour, or randomised words believable.</div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!--End Services Details Content-->
          </div>
        </div>
      </section>
      <!--End Services Details-->

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
</body>
</html>
