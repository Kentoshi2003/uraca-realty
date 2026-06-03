<?php
require_once __DIR__ . '/includes/bootstrap.php';
$settings = cms_settings();
$servicesPage = cms_page('services');
$servicesIntro = cms_section('services', 'services_intro');
$cmsServices = cms_services();
?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="canonical" href="https://uracarealtyph.com/page-services.php" />

  <!-- Indexing -->
  <meta name="robots" content="index, follow" />

  <!-- Open Graph (Facebook / Messenger / LinkedIn) -->
  <meta property="og:title" content="<?= e($servicesPage['meta_title']) ?>" />
  <meta property="og:description" content="<?= e($servicesPage['meta_description']) ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://uracarealtyph.com/" />
  <meta property="og:image" content="<?= e(site_url($servicesPage['social_image'])) ?>" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= e($servicesPage['meta_title']) ?>" />
  <meta name="twitter:description" content="<?= e($servicesPage['meta_description']) ?>" />
  <meta name="twitter:image" content="<?= e(site_url($servicesPage['social_image'])) ?>" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
  <link rel="icon" href="images/favicon.png" type="image/x-icon" />

  <!-- Styles -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <style>
    .services-overview-grid .service-block-wraper {
      gap: 18px;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      justify-items: center;
    }
    .services-overview-grid .service-block-one {
      display: flex;
      justify-content: center;
    }
    .services-overview-grid .service-block-one .inner-block {
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 304px;
      max-width: 304px;
      padding: 26px 28px 30px;
    }
    .services-overview-grid .service-block-one .inner-block .icon {
      font-size: 52px;
      margin-bottom: 8px;
    }
    .services-overview-grid .service-block-one .inner-block .title {
      line-height: 1.2;
      margin-bottom: 10px;
      min-height: 62px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .services-overview-grid .service-block-one .inner-block .title a {
      display: block;
    }
    .services-overview-grid .service-block-one .inner-block .text {
      line-height: 1.5;
      max-width: 232px;
      display: -webkit-box;
      -webkit-line-clamp: 4;
      line-clamp: 4;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    @media (max-width: 1299.98px) {
      .services-overview-grid .service-block-wraper {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }
    @media (max-width: 767.98px) {
      .services-overview-grid .service-block-wraper {
        grid-template-columns: 1fr;
      }
      .services-overview-grid .service-block-one .inner-block {
        height: auto;
        min-height: 304px;
      }
    }
  </style>

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
            <div class="h2 title">Send Email</div>
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
            <div class="h1 title">Services</div>
            <ul class="page-breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li>Services</li>
            </ul>
          </div>
        </div>
      </section>
      <!-- end main-content -->

      <!-- Services Section -->
      <section class="service-section services-overview-grid pt-120 pb-120 border-0">
        <div class="auto-container">
          <div class="service-block-wraper">
            <?php render_cms_service_cards(8); ?>
          </div>        </div>
      </section>
      <!-- End Services Section -->

      <!--Start Services Details-->
      <section class="services-details pt-100 pb-100" id="service-details">
        <div class="container">
          <div class="row">
            <!--Start Services Details Sidebar-->
            <div class="col-xl-4 col-lg-4">
              <div class="service-sidebar">
                <!--Start Services Details Sidebar Single-->
                <div class="sidebar-widget service-sidebar-single">
                  <div class="sidebar-service-list">
                    <ul>
                      <li><a href="#service-details" class="current"><i class="fas fa-angle-right"></i><span>Property Buying</span></a></li>
                      <li class="current"><a href="#service-details"><i class="fas fa-angle-right"></i><span>Real Estate Marketing</span></a></li>
                      <li><a href="#service-details"><i class="fas fa-angle-right"></i><span>Luxury Home Sales</span></a></li>
                      <li><a href="#service-details"><i class="fas fa-angle-right"></i><span>Relocation Services</span></a></li>
                      <li><a href="#service-details"><i class="fas fa-angle-right"></i><span>Property Legal Assistance</span></a></li>
                      <li><a href="#service-details"><i class="fas fa-angle-right"></i><span>Home Loan Consultation</span></a></li>
                    </ul>
                  </div>
                  <div class="service-details-help">
                    <div class="help-shape-1"></div>
                    <div class="help-shape-2"></div>
                    <div class="h3 help-title">Contact with <br /> us for any <br /> advice</div>
                    <div class="help-icon"><span class=" lnr-icon-phone-handset"></span></div>
                    <div class="help-contact">
                      <p>Need help? Talk to an expert</p>
                      <a href="<?= e(phone_href($settings['phone'])) ?>"><?= e($settings['phone']) ?></a>
                    </div>
                  </div>
                  <!--Start Services Details Sidebar Single-->
                  <div class="sidebar-widget service-sidebar-single mt-4">
                    <div class="service-sidebar-single-btn wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1200m">
                      <a href="#" class="theme-btn btn-style-one d-grid"><span class="btn-title"><span class="fas fa-file-pdf"></span> Download Service Brochure</span></a>
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
                <p>At Uraca Realty, we are committed to delivering reliable and personalized real estate services built on trust, professionalism, and market understanding. We know that every client has unique needs, which is why we take time to listen, guide, and recommend the most suitable property solutions.</p>
                <p>With more than a decade of experience in the industry, we have helped clients across Luzon, Visayas, and Mindanao, with strong market familiarity in Davao City and Samal Island. From property acquisition to selling and leasing, our focus is always on making the process smoother, clearer, and more rewarding for our clients.</p>
                <p>We believe that real estate is more than just transactions — it is about helping people make confident decisions for their homes, businesses, and future investments.</p>
                <div class="content mt-40">
                  <div class="text">
                    <div class="h3">Service Center</div>
                    <p>At Uraca Realty, our Service Center is dedicated to providing hands-on support for every step of your real estate journey. Whether you are buying, selling, renting, or planning to build, we ensure that every transaction is handled with care, clarity, and professionalism.</p>
                    <p>With over a decade of experience and strong local expertise in Davao City and Samal Island, we guide clients through the entire process—from property selection to final decision-making—making it simple, secure, and stress-free.</p>
                    <p>We believe that real estate is not just about properties, but about helping people make the right move at the right time.</p>
                    <div class="feature-list mt-4">
                      <div class="h5">What We Do for You</div>
                      <ul class="list-style-two mt-3">
                        <li><span>✔</span> Personalized property recommendations based on your needs</li>
                        <li><span>✔</span> Guidance in buying, selling, and renting properties</li>
                        <li><span>✔</span> Support in documentation and transaction process</li>
                        <li><span>✔</span> Reliable advice for property investments</li>
                        <li><span>✔</span> Assistance in construction planning and coordination</li>
                      </ul>
                    </div>
                    <div class="mt-4">
                      <div class="h5">Why Work With Us</div>
                      <p>Uraca Realty is led by a hands-on broker who prioritizes client relationships, transparency, and results. Every client is treated with attention and care, ensuring you receive honest guidance and real value in every transaction.</p>
                    </div>
                  </div>
                  <div class="feature-list mt-4">
                    <div class="row clearfix">
                      <div class="col-lg-6 col-md-6 col-sm-12 column">
                        <img class="mb-3" src="images/resource/service-d1.jpg" alt="Personalized Property Guidance" />
                        <div class="h6">Personalized Property Guidance</div>
                        <p>We take time to understand your needs and match you with the right property that fits your goals and lifestyle.</p>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12 column">
                        <img class="mb-3" src="images/resource/service-d2.jpg" alt="Trusted Local Expertise" />
                        <div class="h6">Trusted Local Expertise</div>
                        <p>With strong experience in Davao City and Samal Island, we help you discover properties with real value and potential.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" mt-25">
                  <div class="h3">Frequently Asked Questions</div>
                  <p>We understand that real estate decisions can be complex. Here are some of the most common questions we receive to help guide you.</p>
                  <ul class="accordion-box wow fadeInRight">
                    <!--Block-->
                    <li class="accordion block">
                      <div class="acc-btn" style="color: var(--theme-color-black);">How do I start buying a property?
                        <div class="icon fa fa-plus"></div>
                      </div>
                      <div class="acc-content">
                        <div class="content">
                          <div class="text">Start by identifying your budget, preferred location, and purpose (home or investment). Uraca Realty will guide you through property selection, site visits, and the entire process until closing.</div>
                        </div>
                      </div>
                    </li>
                    <!--Block-->
                    <li class="accordion block">
                      <div class="acc-btn" style="color: var(--theme-color-black);">Can you help me sell my property faster?
                        <div class="icon fa fa-plus"></div>
                      </div>
                      <div class="acc-content">
                        <div class="content">
                          <div class="text">Yes. We assist with proper pricing, property presentation, and targeted marketing to attract serious buyers and close deals efficiently.</div>
                        </div>
                      </div>
                    </li>
                    <!--Block-->
                    <li class="accordion block">
                      <div class="acc-btn" style="color: var(--theme-color-black);">Do you offer rental services?
                        <div class="icon fa fa-plus"></div>
                      </div>
                      <div class="acc-content">
                        <div class="content">
                          <div class="text">Yes. We help clients find residential and commercial rental properties, and assist property owners in connecting with reliable and verified tenants.</div>
                        </div>
                      </div>
                    </li>
                    <!--Block-->
                    <li class="accordion block">
                      <div class="acc-btn" style="color: var(--theme-color-black);">Do you assist with documentation and legal process?
                        <div class="icon fa fa-plus"></div>
                      </div>
                      <div class="acc-content">
                        <div class="content">
                          <div class="text">Yes. We guide clients through the required documentation and coordinate the process to ensure smooth and secure transactions.</div>
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
                        <div class="list-info"><a href="tel:+639185305683">+63 918-5305-683</a></div>
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
