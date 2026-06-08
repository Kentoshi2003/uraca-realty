<?php
require_once __DIR__ . '/includes/bootstrap.php';
$settings = cms_settings();
$homePage = cms_page('home');
$homeAbout = cms_section('home', 'about_intro');
$homeServices = cms_section('home', 'services_intro');
$homeFeatured = cms_section('home', 'featured_intro');
$homeTestimonials = cms_section('home', 'testimonials_intro');
$homeContact = cms_section('home', 'contact_intro');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  
  <!-- Primary SEO -->
  <title><?= e($homePage['meta_title']) ?></title>
  <meta name="description" content="<?= e($homePage['meta_description']) ?>" />
  <meta name="keywords" content="Uraca Realty, real estate Philippines, house and lot for sale, condos Philippines, property investment PH, buy house Philippines, real estate agent Philippines" />
  <meta name="author" content="Uraca Realty" />

  <!-- Mobile + Compatibility -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Canonical (VERY IMPORTANT FOR SEO) -->
    <link rel="canonical" href="https://uracarealtyph.com/" />

  <!-- Indexing -->
  <meta name="robots" content="index, follow" />

  <!-- Open Graph (Facebook / Messenger / LinkedIn) -->
  <meta property="og:title" content="<?= e($homePage['meta_title']) ?>" />
  <meta property="og:description" content="<?= e($homePage['meta_description']) ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://uracarealtyph.com/" />
  <meta property="og:image" content="<?= e(site_url($homePage['social_image'])) ?>" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= e($homePage['meta_title']) ?>" />
  <meta name="twitter:description" content="<?= e($homePage['meta_description']) ?>" />
  <meta name="twitter:image" content="<?= e(site_url($homePage['social_image'])) ?>" />

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

    <!-- <div class="preloader"></div> -->

    <!-- Back-to-top start -->
    <div class="back-to-top-wrapper">
      <button id="back_to_top" type="button" class="back-to-top-btn">
        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                    <li class="current"><a href="index.php">Home</a></li>
                    <li><a href="page-about.php">About Us</a></li>
                    <li><a href="page-services.php">Services</a></li>
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

        <!-- Hero Section -->
        <section class="hero-section">
          <div class="social-text">
            <a href="<?= e($settings['facebook_url']) ?>">facebook</a>
            <a href="<?= e($settings['whatsapp_url']) ?>">Whatsapp</a>
            <a href="<?= e($settings['instagram_url']) ?>">Instagram</a>
          </div>
          <div class="hero-1 bg-cover" style="background-image: url('images/banner/hero-bg-1-1.jpg');">
            <div class="hero-content">
              <div class="h1 hero-title wow fadeInUp" data-wow-delay="200ms"><?= e($homePage['hero_title']) ?></div>
              <a href="page-projects.php" class="btn-style-two wow fadeInUp" data-wow-delay="200ms">Browse Properties <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span></a>
            </div>
            <div class="hero-bottom-items wow fadeInUp">
              <div class="content">
                <div class="counter-items wow fadeInUp" data-wow-delay="100ms">
                  <div class="h6 wow fadeInUp" data-wow-delay="200ms">Client <br> Satisfaction</div>
                  <div class="h2 count-box wow fadeInUp" data-wow-delay="300ms"><span class="count-text" data-speed="3000" data-stop="98">20</span>%</div>
                </div>
                <div class="text wow fadeInUp" data-wow-delay="400ms"><?= e($homePage['hero_subtitle']) ?></div>
              </div>
              <div class="hero-image wow fadeInUp" data-wow-delay="500ms"><img src="images/banner/hero-image.jpg" alt=""></div>
            </div>
          </div>
        </section>

        <!-- About Section -->
        <section class="about-section fix pt-120 pb-120">
          <div class="container">
            <div class="row g-4">
              <div class="col-xl-7">
                <div class="about-block-one wow fadeInRight" data-wow-delay="300ms">
                  <div class="row g-4">
                    <div class="col-xl-5 col-md-6">
                      <div class="image-block1 position-relative overflow-hidden"><img data-speed="0.8" src="images/resource/about-1-1.jpg" alt=""></div>
                      <div class="image-block1 position-relative overflow-hidden style-bottom-0"><img data-speed="0.8" src="images/resource/about-1-2.jpg" alt=""></div>
                    </div>
                    <div class="col-xl-7 col-md-6">
                      <div class="image-block2 position-relative overflow-hidden"><img data-speed="0.8" src="images/resource/about-1-3.jpg" alt=""></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-5">
                <div class="about-block-content-one wow fadeInLeft" data-wow-delay="300ms">
                  <div class="sec-title mb-0">
                    <div class="h6 sub-title"><?= e($homeAbout['eyebrow']) ?></div>
                    <div class="h2 title tx-title tz-itm-title tz-itm-anim"><?= e($homeAbout['title']) ?></div>
                  </div>
                  <div class="text"><?= e($homeAbout['body']) ?></div>
                    <div class="about-list-items">
                      <div class="h4 title">Our Business Advantages</div>
                      <ul class="about-list">
                        <li>
                          <svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.5 0L7 3.5L3.5 7L0 3.5L3.5 0Z" fill="#595959"/>
                          </svg>
                          Trusted Market Expertise
                        </li>
                        <li>
                          <svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.5 0L7 3.5L3.5 7L0 3.5L3.5 0Z" fill="#595959"/>
                          </svg>
                          Local & Regional Market Knowledge
                        </li>
                        <li>
                          <svg width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.5 0L7 3.5L3.5 7L0 3.5L3.5 0Z" fill="#595959"/>
                          </svg>
                          Clear Pricing and Documentation
                        </li>
                      </ul>
                      <div class="about-button-items">
                      <a href="<?= e($homeAbout['button_url'] ?: 'page-about.php') ?>" class="btn-style-one">
                        <?= e($homeAbout['button_label'] ?: 'More About Us') ?>
                        <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
                      </a>
                      <div class="content-info">
                        <img src="images/resource/sign.png" alt="">
                        <div class="content">
                          <div class="h6 m-0"><?= e($settings['contact_name']) ?></div>
                          <div class="text-2">Owner/Realtor</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Service Section -->
        <section class="service-section pt-120 pb-90">
          <div class="floating-object bounce-y"><img src="images/resource/service-object.png" alt=""></div>
          <div class="auto-container px-xl-0">
            <div class="row">
              <div class="col-xl-7 mx-auto wow fadeInUp">
                <div class="sec-title text-center">
                  <div class="h6 sub-title"><?= e($homeServices['eyebrow']) ?></div>
                  <div class="h2 title tx-title tz-itm-title tz-itm-anim"><?= e($homeServices['title']) ?></div>
                </div>
              </div>
            </div>
            <div class="service-block-wraper">
              <?php render_cms_service_cards(4); ?>
            </div>
          </div>
        </section>
        <!-- End Service Section -->

        <!-- Project Section -->
        <section class="project-section pt-120 pb-50">
          <div class="auto-container">
            <div class="row">
              <div class="col-xl-6">
                <div class="sec-title wow fadeInUp">
                  <div class="h6 sub-title">categories</div>
                  <div class="h2 title tx-title tz-itm-title tz-itm-anim"><span>Explore</span> Our full range of property opportunities</div>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper three-grid-slider wow fadeInUp" data-wow-delay="200ms">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="project-block">
                  <div class="inner-block">
                    <div class="image-block">
                      <a class="image" href="page-house-and-lot.php">
                        <img src="images/Categories/House and Lot.png" alt="House and Lot">
                        <img src="images/Categories/House and Lot.png" alt="House and Lot">
                      </a>
                    </div>
                    <div class="content-block">
                      <div class="h4 title"><a href="page-house-and-lot.php">House and lot</a></div>
                      <a href="page-house-and-lot.php" class="read-more"><img src="images/icons/btn-icon-2.png" alt=""></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="project-block">
                  <div class="inner-block">
                    <div class="image-block">
                      <a class="image" href="page-prime-lots.php">
                        <img src="images/Categories/Prime Lots.png" alt="Prime Lots">
                        <img src="images/Categories/Prime Lots.png" alt="Prime Lots">
                      </a>
                    </div>
                    <div class="content-block">
                      <div class="h4 title"><a href="page-prime-lots.php">Prime Lots</a></div>
                      <a href="page-prime-lots.php" class="read-more"><img src="images/icons/btn-icon-2.png" alt=""></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="project-block">
                  <div class="inner-block">
                    <div class="image-block">
                      <a class="image" href="page-rentals.php">
                        <img src="images/Categories/Rentals.png" alt="Rentals">
                        <img src="images/Categories/Rentals.png" alt="Rentals">
                      </a>
                    </div>
                    <div class="content-block">
                      <div class="h4 title"><a href="page-rentals.php">Rentals</a></div>
                      <a href="page-rentals.php" class="read-more"><img src="images/icons/btn-icon-2.png" alt=""></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="project-block">
                  <div class="inner-block">
                    <div class="image-block">
                      <a class="image" href="page-construction.php">
                        <img src="images/Categories/Construction.png" alt="Construction">
                        <img src="images/Categories/Construction.png" alt="Construction">
                      </a>
                    </div>
                    <div class="content-block">
                      <div class="h4 title"><a href="page-construction.php">Construction</a></div>
                      <a href="page-construction.php" class="read-more"><img src="images/icons/btn-icon-2.png" alt=""></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Project Section -->

        <!-- Features Section -->
        <section class="feature-section pt-120 pb-60">
          <div class="auto-container">
            <div class="row">
              <div class="col-xl-7 mx-auto wow fadeInUp">
                <div class="sec-title text-center">
                  <div class="h6 sub-title"><?= e($homeFeatured['eyebrow'] ?: 'featured list') ?></div>
                  <div class="h2 title tx-title tz-itm-title tz-itm-anim"><?= e($homeFeatured['title'] ?: 'Featured Properties') ?></div>
                  <?php if (!empty($homeFeatured['body'])): ?><p class="text"><?= e($homeFeatured['body']) ?></p><?php endif; ?>
                </div>
              </div>
            </div>
            <?php render_cms_featured_properties(); ?>
          </div>
        </section>
        <section class="video-section pt-0">
          <div class="video-image overflow-hidden">
            <img data-speed="0.8" src="images/resource/video-1-1.jpg" alt="img">
            <div class="content">
              <a href="https://www.facebook.com/plugins/video.php?height=322&amp;href=https%3A%2F%2Fwww.facebook.com%2Freel%2F1394168952733138%2F&amp;show_text=false&amp;width=560&amp;t=0" class="play-now" data-fancybox="gallery" data-type="iframe" data-width="560" data-height="322" data-caption="">
                <i class="icon fa-solid fa-play"></i>
                <span class="ripple"></span>
              </a>
              <div class="h3 title tx-title tz-itm-title tz-itm-anim">Experience Our Professional Real Estate Approach</div>
            </div>
          </div>
        </section>
        <!-- Video Section End -->

        <!-- Floor Plan Section -->
        <section class="flore-plan-section pb-120">
          <div class="auto-container">
            <div class="row">
              <div class="col-xl-6 col-lg-7 mx-auto wow fadeInUp">
                <div class="sec-title text-center">
                  <div class="h6 sub-title">floor plans</div>
                  <div class="h2 title tx-title tz-itm-title tz-itm-anim"><span>Modern</span> Infrastructure & thoughtful living spaces</div>
                </div>
              </div>
            </div>
            <div class="floor-custom-tabs">
              <ul class="floor-tab-buttons">
                <li class="floor-tab-btn active" data-tab="#tab1">Paradise</li>
                <li class="floor-tab-btn" data-tab="#tab2">Deluxe</li>
                <li class="floor-tab-btn" data-tab="#tab3">Sunset</li>
                <li class="floor-tab-btn" data-tab="#tab4">Penthouse</li>
              </ul>
              <div class="floor-tab-contents">
                <div class="floor-tab-content active" id="tab1">
                  <div class="floor-plan-block">
                    <div class="inner-block overflow-hidden">
                      <img data-speed="0.8" class="image" src="images/resource/floor-1.jpg" alt="">
                      <div class="content-box">
                        <div class="image-box"><img src="images/resource/flooe-1.png" alt=""></div>
                        <div class="inner-box">
                          <div class="h3 title tx-title tz-itm-title tz-itm-anim">Paradise</div>
                          <div class="text">A spacious and well-balanced layout offering comfort, natural light, and efficient room planningâ€”ideal for families.</div>
                          <div class="h5" class="feature-title">Property Specifications</div>
                          <ul class="flor-feature-list">
                            <li>12 Ã— 12 Sq. Ft. Rooms</li>
                            <li>2 Built-in Wall Shelves</li>
                            <li>4 Large Windows</li>
                            <li>Modern Kitchen Layout</li>
                          </ul>
                          <a href="page-about.php" class="btn-style-one">
                            View 3d video
                            <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="floor-tab-content" id="tab2">
                  <div class="floor-plan-block">
                    <div class="inner-block overflow-hidden">
                      <img class="image" src="images/resource/floor-1.jpg" alt="">
                      <div class="content-box">
                        <div class="image-box"><img src="images/resource/flooe-1.png" alt=""></div>
                        <div class="inner-box">
                          <div class="h3 title tx-title tz-itm-title tz-itm-anim">Deluxe</div>
                          <div class="text">A spacious and well-balanced layout offering comfort, natural light, and efficient room planningâ€”ideal for families.</div>
                          <div class="h5" class="feature-title">Property Specifications</div>
                          <ul class="flor-feature-list">
                            <li>12 Ã— 12 Sq. Ft. Rooms</li>
                            <li>2 Built-in Wall Shelves</li>
                            <li>4 Large Windows</li>
                            <li>Modern Kitchen Layout</li>
                          </ul>
                          <a href="page-about.php" class="btn-style-one">
                            View 3d video
                            <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="floor-tab-content" id="tab3">
                  <div class="floor-plan-block">
                    <div class="inner-block overflow-hidden">
                      <img class="image" src="images/resource/floor-1.jpg" alt="">
                      <div class="content-box">
                        <div class="image-box"><img src="images/resource/flooe-1.png" alt=""></div>
                        <div class="inner-box">
                          <div class="h3 title tx-title tz-itm-title tz-itm-anim">Sunset</div>
                          <div class="text">A spacious and well-balanced layout offering comfort, natural light, and efficient room planningâ€”ideal for families.</div>
                          <div class="h5" class="feature-title">Property Specifications</div>
                          <ul class="flor-feature-list">
                            <li>12 Ã— 12 Sq. Ft. Rooms</li>
                            <li>2 Built-in Wall Shelves</li>
                            <li>4 Large Windows</li>
                            <li>Modern Kitchen Layout</li>
                          </ul>
                          <a href="page-about.php" class="btn-style-one">
                            View 3d video
                            <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="floor-tab-content" id="tab4">
                  <div class="floor-plan-block">
                    <div class="inner-block overflow-hidden">
                      <img class="image" src="images/resource/floor-1.jpg" alt="">
                      <div class="content-box">
                        <div class="image-box"><img src="images/resource/flooe-1.png" alt=""></div>
                        <div class="inner-box">
                          <div class="h3 title tx-title tz-itm-title tz-itm-anim">Penthouse</div>
                          <div class="text">A spacious and well-balanced layout offering comfort, natural light, and efficient room planningâ€”ideal for families.</div>
                          <div class="h5" class="feature-title">Property Specifications</div>
                          <ul class="flor-feature-list">
                            <li>12 Ã— 12 Sq. Ft. Rooms</li>
                            <li>2 Built-in Wall Shelves</li>
                            <li>4 Large Windows</li>
                            <li>Modern Kitchen Layout</li>
                          </ul>
                          <a href="page-about.php" class="btn-style-one">
                            View 3d video
                            <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Floor Plan Section -->

        <section class="testimonial-section pt-120 pb-60">
          <div class="container-fluid pl-40 pr-40">
            <div class="row">
              <div class="col-xl-6 col-lg-7 mx-auto wow fadeInUp">
                <div class="sec-title text-center">
                  <div class="h6 sub-title"><?= e($homeTestimonials['eyebrow']) ?></div>
                  <div class="h2 title tx-title tz-itm-title tz-itm-anim"><?= e($homeTestimonials['title']) ?></div>
                </div>
              </div>
            </div>
            <div class="row">
              <?php render_cms_testimonials(2); ?>
            </div>
          </div>
        </section>
        <!-- End Testimonial Section -->
        <!-- Faq Section -->
        <section class="faq-section pt-20 pb-120">
          <div class="auto-container">
            <div class="row g-4">
              <div class="col-xl-6">
                <div class="sec-title wow fadeInUp">
                  <div class="h6 sub-title">FAQs</div>
                  <div class="h2 title tx-title tz-itm-title tz-itm-anim"><span>Have</span> Questions in Your Mind?</div>
                </div>
                <div class="faq-block-one active wow fadeInUp" data-wow-delay="200ms">
                  <div class="title-box">
                    <div class="content">
                      <span class="count">01</span>
                      <div class="h5 title">Property Buying Assistance</div>
                    </div>
                    <span class="icon"><i class="fa-sharp fa-solid fa-plus"></i></span>
                  </div>
                  <div class="content-box show">
                    <div class="inner">
                      <div class="text">How can Uraca Realty help me find the right property? We take time to understand your budget, preferred location, and purposeâ€”whether for personal use or investment. Based on this, we recommend suitable properties in Davao City, Samal Island, and nearby areas, and guide you through viewing, selection, and closing.</div>
                    </div>
                  </div>
                </div>
                <div class="faq-block-one wow fadeInUp" data-wow-delay="300ms">
                  <div class="title-box">
                    <div class="content">
                      <span class="count">02</span>
                      <div class="h5 title">Property Selling Services</div>
                    </div>
                    <span class="icon"><i class="fa-sharp fa-solid fa-plus"></i></span>
                  </div>
                  <div class="content-box">
                    <div class="inner">
                      <div class="text">How do you help me sell my property faster? We assist with proper pricing, market positioning, and promotion to attract serious buyers. Our goal is to help you sell efficiently while securing the best possible value for your property.</div>
                    </div>
                  </div>
                </div>
                <div class="faq-block-one wow fadeInUp" data-wow-delay="400ms">
                  <div class="title-box">
                    <div class="content">
                      <span class="count">03</span>
                      <div class="h5 title">Rental & Leasing Solutions</div>
                    </div>
                    <span class="icon"><i class="fa-sharp fa-solid fa-plus"></i></span>
                  </div>
                  <div class="content-box">
                    <div class="inner">
                      <div class="text">Do you offer rental services for both tenants and property owners? Yes. We help clients find quality residential and commercial rentals, and we also assist property owners in connecting with reliable tenants for a smooth leasing process.</div>
                    </div>
                  </div>
                </div>
                <div class="faq-block-one mb-4 mb-xl-0 wow fadeInUp" data-wow-delay="500ms">
                  <div class="title-box">
                    <div class="content">
                      <span class="count">04</span>
                      <div class="h5 title">Investment & Property Guidance</div>
                    </div>
                    <span class="icon"><i class="fa-sharp fa-solid fa-plus"></i></span>
                  </div>
                  <div class="content-box">
                    <div class="inner">
                      <div class="text">Can you guide me if I want to invest in real estate? Absolutely. We provide practical advice on property value, location potential, and long-term growth opportunitiesâ€”helping you make informed and confident investment decisions.</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-8">
                <div class="faq-image-block-one wow fadeInUp" data-wow-delay="500ms">
                  <div class="image-block-1 wow fadeInUp overflow-hidden" data-wow-delay=".3s"><img data-speed="0.8" src="images/resource/faq-1-1.jpg" alt="img"></div>
                  <div class="image-block-2 wow fadeInRight overflow-hidden" data-wow-delay=".5s"><img data-speed="0.8" src="images/resource/faq-image-1-2.jpg" alt="img"></div>
                  <div class="image-block-3 wow fadeInUp overflow-hidden" data-wow-delay=".5s"><img data-speed="0.8" src="images/resource/faq-image-1-3.png" alt="img"></div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Faq Section -->

        <!-- Award Section -->
        <section class="award-section pt-0 pb-90">
          <div class="outer-wrapper">
            <div class="auto-container">
              <div class="row">
                <div class="col-xl-6 col-lg-8 mx-auto wow fadeInUp">
                  <div class="sec-title light text-center">
                    <div class="h6 sub-title">partners</div>
                    <div class="h2 title tx-title tz-itm-title tz-itm-anim"><span>Our</span> trusted partner developers</div>
                  </div>
                </div>
              </div>
              <div class="outer-box">
                <div class="award-block wow fadeInUp" data-wow-delay="100ms">
                  <div class="inner-block">
                    <div class="h5 award-year">Developer</div>
                    <div class="h4 award-title">Ayala Land</div>
                    <div class="h5 award-announced">Trusted Partner</div>
                    <a href="#" class="icon"><i class="fa-sharp-duotone fa-light fa-arrow-right-long"></i></a>
                  </div>
                </div>
                <div class="award-block wow fadeInUp" data-wow-delay="200ms">
                  <div class="inner-block">
                    <div class="h5 award-year">Developer</div>
                    <div class="h4 award-title">Megaworld</div>
                    <div class="h5 award-announced">Trusted Partner</div>
                    <a href="#" class="icon"><i class="fa-sharp-duotone fa-light fa-arrow-right-long"></i></a>
                  </div>
                </div>
                <div class="award-block wow fadeInUp" data-wow-delay="300ms">
                  <div class="inner-block">
                    <div class="h5 award-year">Developer</div>
                    <div class="h4 award-title">SM Prime</div>
                    <div class="h5 award-announced">Trusted Partner</div>
                    <a href="#" class="icon"><i class="fa-sharp-duotone fa-light fa-arrow-right-long"></i></a>
                  </div>
                </div>
                <div class="award-block wow fadeInUp" data-wow-delay="400ms">
                  <div class="inner-block">
                    <div class="h5 award-year">Developer</div>
                    <div class="h4 award-title">DMCI Homes</div>
                    <div class="h5 award-announced">Trusted Partner</div>
                    <a href="#" class="icon"><img src="images/icons/btn-icon-1.png" alt=""></a>
                  </div>
                </div>
                <div class="award-block wow fadeInUp" data-wow-delay="500ms">
                  <div class="inner-block">
                    <div class="h5 award-year">Developer</div>
                    <div class="h4 award-title">Robinsons Land</div>
                    <div class="h5 award-announced">Trusted Partner</div>
                    <a href="#" class="icon"><i class="fa-sharp-duotone fa-light fa-arrow-right-long"></i></a>
                  </div>
                </div>
                <div class="award-icons wow fadeInUp" data-wow-delay="600ms">
                  <div class="inner-block">
                    <img src="images/icons/award-1.png" alt="">
                    <img src="images/icons/award-2.png" alt="">
                    <img src="images/icons/award-3.png" alt="">
                    <img src="images/icons/award-4.png" alt="">
                    <img src="images/icons/award-5.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Award Section -->

        <!-- Team Plan Section -->
        <section class="team-section pt-40 pb-90">
          <div class="auto-container">
            <div class="row">
              <div class="col-xl-6 col-lg-7 mx-auto wow fadeInUp">
                <div class="sec-title text-center">
                  <div class="h6 sub-title">our team</div>
                  <div class="h2 title tx-title tz-itm-title tz-itm-anim mb-30"><span>The People</span> Who make our real estate work</div>
                  <a href="page-about.php" class="btn-style-one">
                    Learn About Us
                    <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
                  </a>
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-lg-4 col-sm-6">
                <div class="team-block">
                  <div class="inner-block wow fadeInUp" data-wow-delay="300ms">
                    <div class="image-box">
                      <div class="image">
                        <img src="images/resource/uraca-person.png" alt="">
                        <img src="images/resource/uraca-person.png" alt="">
                      </div>
                    </div>
                    <div class="content-box">
                      <div class="h4 title">Marylyn Grace Uraca</div>
                      <div class="text">Owner</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Team Plan Section -->

        <!-- Start Contact Section -->
        <section class="contact-section">
          <div class="contact-image fix"><img data-speed=".8" src="images/resource/contact-1-1.jpg" alt=""></div>
          <div class="contact-image2 fix"><img data-speed=".8" src="images/resource/contact-bg.png" alt=""></div>
          <div class="container">
            <div class="row align-items-center">
              <div class="col-xl-6">
                <div class="contact-content-1">
                  <div class="sec-title light">
                    <span class="h6 sub-title tz-sub-tilte tz-sub-anim tx-subTitle"><?= e($homeContact['eyebrow']) ?></span>
                    <div class="h2 title tx-title tz-itm-title tz-itm-anim tx-title sec_title  tz-itm-title tz-itm-anim"><?= e($homeContact['title']) ?></div>
                  </div>
                  <div class="contact-list-items">
                  <iframe  class="map w-100"  src="<?= e(validate_embed_url($settings['map_embed_url'], cms_default_settings()['map_embed_url'])) ?>"></iframe>
                    <div class="list-wrapper">
                      <div class="contact-list wow fadeInUp" data-wow-delay=".4s">
                        <div class="h4 title">Location:</div>
                        <div class="contact-box">
                          <div class="icon"><i class="fa-sharp fa-light fa-location-dot"></i></div>
                          <div class="text"><?= e($settings['address']) ?></div>
                        </div>
                      </div>
                      <div class="contact-list wow fadeInUp" data-wow-delay=".6s">
                        <div class="h4 title">Email:</div>
                        <div class="contact-box">
                          <div class="icon"><i class="fa-classic fa-light fa-envelope"></i></div>
                          <div>
                            <a href="mailto:<?= e($settings['email']) ?>" class="d-block"><?= e($settings['email']) ?></a>
                            <a href="<?= e(phone_href($settings['phone'])) ?>"><?= e($settings['phone']) ?></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 ps-xl-0">
                <div class="contact-form-style-1">
                  <?php render_public_flash(); ?>
                  <form id="contact_form" name="contact_form" class="contact-form-box" action="contact-submit.php" method="post">
                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                    <input type="hidden" name="source_page" value="index.php">
                    <div class="row g-4">
                      <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                        <div class="form-clt">
                          <label>Your Name</label>
                          <input name="form_name" class="form-control" type="text" placeholder="Your Name *">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                        <div class="form-clt">
                          <label>Email Address</label>
                          <input name="form_email" class="form-control" type="email" placeholder="Email Address *">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".6s">
                        <div class="form-clt">
                          <label>Phone Number</label>
                          <input name="form_phone" class="form-control" type="text" placeholder="Phone *">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".7s">
                        <div class="form-clt">
                          <label>Select Service</label>
                          <input name="form_subject" class="form-control" type="text" placeholder="Subject (Optional)">
                        </div>
                      </div>
                      <div class="col-lg-12 wow fadeInUp" data-wow-delay=".8s">
                        <div class="form-clt">
                          <label>Message</label>
                          <textarea class="form-control" name="form_message" placeholder="Type Your Message" rows="9"></textarea>
                        </div>
                      </div>
                      <div class="col-lg-12 wow fadeInUp" data-wow-delay=".9s">
                        <div class="contact-button">
                          <input name="form_botcheck" class="form-control" type="hidden" value="">
                          <button type="submit" class="btn-style-one" data-loading-text="Please wait...">
                            Send Message
                            <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End Contact Section -->

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
                <p class="copyright-text">Â© Copyright 2026 by Uraca Realty</p>
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
