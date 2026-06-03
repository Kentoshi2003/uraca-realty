<?php
require_once __DIR__ . '/includes/bootstrap.php';
$settings = cms_settings();
$aboutPage = cms_page('about');
$aboutIntro = cms_section('about', 'about_intro');
$aboutMission = cms_section('about', 'mission');
$aboutVision = cms_section('about', 'vision');
$testimonials = cms_testimonials();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  
  <!-- Primary SEO -->
  <title><?= e($aboutPage['meta_title']) ?></title>
  <meta name="description" content="<?= e($aboutPage['meta_description']) ?>" />
  <meta name="keywords" content="Uraca Realty, real estate Philippines, house and lot for sale, condos Philippines, property investment PH, buy house Philippines, real estate agent Philippines" />
  <meta name="author" content="Uraca Realty" />

  <!-- Mobile + Compatibility -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Canonical (VERY IMPORTANT FOR SEO) -->
    <link rel="canonical" href="https://uracarealtyph.com/page-about.php" />

  <!-- Indexing -->
  <meta name="robots" content="index, follow" />

  <!-- Open Graph (Facebook / Messenger / LinkedIn) -->
  <meta property="og:title" content="<?= e($aboutPage['meta_title']) ?>" />
  <meta property="og:description" content="<?= e($aboutPage['meta_description']) ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://uracarealtyph.com/" />
  <meta property="og:image" content="<?= e(site_url($aboutPage['social_image'])) ?>" />

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= e($aboutPage['meta_title']) ?>" />
  <meta name="twitter:description" content="<?= e($aboutPage['meta_description']) ?>" />
  <meta name="twitter:image" content="<?= e(site_url($aboutPage['social_image'])) ?>" />

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
                  <li class="current"><a href="page-about.php">About Us</a></li>
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

      <!-- Start main-content -->
      <section class="page-title">
        <div class="large-container">
          <div class="title-outer text-center">
            <div class="h1 title">About Us</div>
            <ul class="page-breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li>About Us</li>
            </ul>
          </div>
        </div>
      </section>
      <!-- end main-content -->

      <!-- Start about-section -->
      <section class="about-section-two fix pt-120 pb-90 bg-white">
        <div class="bg-pattern"><img src="images/background/about-bg-patternt2.png" alt=""></div>
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-6">
              <div class="about-block-content-two wow fadeInLeft" data-wow-delay="300ms">
                <div class="sec-title">
                  <div class="h6 sub-title"><?= e($aboutIntro['eyebrow']) ?></div>
                  <div class="h2 title"><?= e($aboutIntro['title']) ?></div>
                </div>
                <div class="default-tabs tabs-box">
                  <!-- Tab Btns -->
                  <div class="tab-btns tab-buttons">
                    <button data-tab="#prod-choose" class="tab-btn active-btn">Why choose us</button>
                    <button data-tab="#prod-benefits" class="tab-btn">Our Mission &amp; Vision</button>
                  </div>
                  <!-- Tabs Container -->
                  <div class="tabs-content">
                    <!-- Tab -->
                    <div class="tab active-tab" id="prod-choose">
                      <div class="tab-inner-content">
                        <div class="content">
                          <div class="h2 title">WHY CHOOSE URACA REALTY</div>
                          <div class="text">
                            <p><?= e($aboutIntro['body']) ?></p>
                            <p>With over a decade of experience in the industry, we have successfully assisted clients across Luzon, Visayas, and Mindanao, with a strong focus on Davao City and Samal Island. Our journey started from the ground up—built on dedication, market knowledge, and genuine client relationships.</p>
                          </div>
                          <div class="info-box">
                            <div class="h5 title">Core Strengths</div>
                            <ul class="list-style-two">
                              <li><span>+</span> Strategic Property Matching</li>
                              <li><span>+</span> Residential &amp; Investment Properties</li>
                              <li><span>+</span> Market Expertise &amp; Insights</li>
                              <li><span>+</span> Property Consultation &amp; Guidance</li>
                            </ul>
                          </div>
                          <a href="page-about.php" class="btn-style-two">More About Us
                            <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- Tab -->
                    <div class="tab" id="prod-benefits">
                      <div class="tab-inner-content">
                        <div class="content">
                          <div class="h5 title">MISSION &amp; VISION</div>
                          <div class="text">
                            <div class="h6">Our Mission</div>
                            <p><?= e($aboutMission['body']) ?></p>
                            <div class="h6">Our Vision</div>
                            <p><?= e($aboutVision['body']) ?></p>
                          </div>
                          <div class="info-box">
                            <div class="h5 title">Why Clients Trust Us</div>
                            <ul class="list-style-two">
                              <li><span>?</span> Over 10 years of real estate experience</li>
                              <li><span>?</span> Verified and carefully selected listings</li>
                              <li><span>?</span> Strong presence in Davao &amp; Samal markets</li>
                              <li><span>?</span> Client-focused and transparent process</li>
                              <li><span>?</span> End-to-end assistance (inquiry to closing)</li>
                            </ul>
                          </div>
                          <a href="page-about.php" class="btn-style-two">More About Us
                            <span class="arrow-right"><img src="images/icons/btn-icon-1.png" alt=""></span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-7 col-lg-6">
              <div class="about-image-content-box">
                <div class="about-block-two wow fadeInRight" data-wow-delay="300ms">
                  <div class="rotate-logo">
                    <div class="circle-text-wrap">
                      <svg viewBox="0 0 200 200" class="circle-text">
                        <!-- circular path -->
                        <defs><path id="circlePath" d="M 100,100 m -70,0 a 70,70 0 1,1 140,0 a 70,70 0 1,1 -140,0"/></defs>
                        <!-- text around circle -->
                        <text>
                          <textPath href="#circlePath" startOffset="0" textLength="440" lengthAdjust="spacingAndGlyphs" style="letter-spacing: 0px;">
                            URACA REALTY PH • URACA REALTY PH •
                          </textPath>
                        </text>
                      </svg>
                      <!-- center logo -->
                      <div class="center-logo">
                        <img src="images/favicon-large.png" alt="">
                      </div>
                    </div>
                  </div>
                  <div class="image-block1 overflow-hidden"><img data-speed="0.8" src="images/resource/about-2-1.jpg" alt=""></div>
                  <div class="image-block2 overflow-hidden"><img data-speed="0.8" src="images/resource/about-2-2.jpg" alt=""></div>
                  <div class="content-info">
                    <img src="images/resource/sign.png" alt="">
                    <div class="content">
                      <h6 class="m-0">Marylyn Grace Uraca</h6>
                      <div class="text-2">Owner/Realtor</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End about-section-h3 -->

      <!-- Rooms Section -->
      <section class="property-room-feature pt-120 pb-120">
        <div class="auto-container">
          <div class="sec-title text-center">
            <div class="h6 sub-title">Inside</div>
            <div class="h2 title"><span>A Closer Look</span> Inside the Residence</div>
          </div>
          <div class="property-room-outer">
            <div class="room-btn-wrapper">
              <button class="room-list-btn" data-room="guest">
                <span class="room-number">01.</span>
                <span class="room-name">Guest Room</span>
                <img src="images/icons/right-arrow.svg" alt="" class="room-arrow" />
              </button>
              <button class="room-list-btn active" data-room="living">
                <span class="room-number">02.</span>
                <span class="room-name">Living Room</span>
                <img src="images/icons/right-arrow.svg" alt="" class="room-arrow" />
              </button>
              <button class="room-list-btn" data-room="kitchen">
                <span class="room-number">03.</span>
                <span class="room-name">Kitchen</span>
                <img src="images/icons/right-arrow.svg" alt="" class="room-arrow" />
              </button>
              <button class="room-list-btn" data-room="kids">
                <span class="room-number">04.</span>
                <span class="room-name">Kids Room</span>
                <img src="images/icons/right-arrow.svg" alt="" class="room-arrow" />
              </button>
              <button class="room-list-btn" data-room="master">
                <span class="room-number">05.</span>
                <span class="room-name">Master Bedroom</span>
                <img src="images/icons/right-arrow.svg" alt="" class="room-arrow" />
              </button>
              <button class="room-list-btn" data-room="bathroom">
                <span class="room-number">06.</span>
                <span class="room-name">Bathroom</span>
                <img src="images/icons/right-arrow.svg" alt="" class="room-arrow" />
              </button>
            </div>
            <div class="room-content-wrapper">
              <!-- Guest Room -->
              <div class="room-image-box overflow-hidden" data-room-content="guest">
                <img data-speed="0.8" src="images/resource/feautre1-2.jpg" alt="Guest Room" />
                <a href="#" class="room-video-btn" data-fancybox="gallery"><span>View 3d<br />video</span></a>
                <div class="inner-box">
                  <div class="room-content-overlay">
                    <div class="h4 room-title">Comfortable Guest Room</div>
                    <div class="room-description">A welcoming space designed for visitors, featuring elegant furnishings and thoughtful amenities for a restful stay.</div>
                  </div>
                  <div class="room-features-box">
                    <ul class="room-features-list">
                      <li>Queen Size Bed</li>
                      <li>Private Bathroom</li>
                      <li>Walk-in Closet</li>
                      <li>Reading Nook</li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Living Room -->
              <div class="room-image-box overflow-hidden active" data-room-content="living">
                <img data-speed="0.8" src="images/resource/property-room-feature-1.jpg" alt="Living Room" />
                <a href="#" class="room-video-btn" data-fancybox="gallery"><span>View 3d<br />video</span></a>
                <div class="inner-box">
                  <div class="room-content-overlay">
                    <div class="h4 room-title">Spacious Living Area</div>
                    <div class="room-description">An open-concept living space designed for relaxation and entertainment, featuring high ceilings and seamless indoor-outdoor flow.</div>
                  </div>
                  <div class="room-features-box">
                    <ul class="room-features-list">
                      <li>Open Layout Design</li>
                      <li>Floor-to-Ceiling Windows</li>
                      <li>Smart Lighting System</li>
                      <li>Premium Flooring</li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Kitchen -->
              <div class="room-image-box overflow-hidden" data-room-content="kitchen">
                <img data-speed="0.8" src="images/resource/feautre1-3.jpg" alt="Kitchen" />
                <a href="#" class="room-video-btn" data-fancybox="gallery"><span>View 3d<br />video</span></a>
                <div class="inner-box">
                  <div class="room-content-overlay">
                    <div class="h4 room-title">Modern Kitchen</div>
                    <div class="room-description">A chef's dream kitchen with state-of-the-art appliances, ample counter space, and elegant cabinetry for culinary excellence.</div>
                  </div>
                  <div class="room-features-box">
                    <ul class="room-features-list">
                      <li>Stainless Steel Appliances</li>
                      <li>Granite Countertops</li>
                      <li>Island Breakfast Bar</li>
                      <li>Walk-in Pantry</li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Kids Room -->
              <div class="room-image-box overflow-hidden" data-room-content="kids">
                <img data-speed="0.8" src="images/resource/feautre1-4.jpg" alt="Kids Room" />
                <a href="#" class="room-video-btn" data-fancybox="gallery"><span>View 3d<br />video</span></a>
                <div class="inner-box">
                  <div class="room-content-overlay">
                    <div class="h4 room-title">Playful Kids Room</div>
                    <div class="room-description">A vibrant and safe space designed for children to play, learn, and grow with creative storage solutions and fun design elements.</div>
                  </div>
                  <div class="room-features-box">
                    <ul class="room-features-list">
                      <li>Built-in Storage</li>
                      <li>Study Area</li>
                      <li>Play Zone</li>
                      <li>Safety Features</li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Master Bedroom -->
              <div class="room-image-box overflow-hidden" data-room-content="master">
                <img data-speed="0.8" src="images/resource/feautre1-5.jpg" alt="Master Bedroom" />
                <a href="#" class="room-video-btn" data-fancybox="gallery"><span>View 3d<br />video</span></a>
                <div class="inner-box">
                  <div class="room-content-overlay">
                    <div class="h4 room-title">Luxurious Master Bedroom</div>
                    <div class="room-description">A serene retreat featuring a spacious layout, premium finishes, and a private ensuite bathroom for ultimate comfort.</div>
                  </div>
                  <div class="room-features-box">
                    <ul class="room-features-list">
                      <li>King Size Bed</li>
                      <li>Ensuite Bathroom</li>
                      <li>Walk-in Closet</li>
                      <li>Private Balcony</li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Bathroom -->
              <div class="room-image-box overflow-hidden" data-room-content="bathroom">
                <img data-speed="0.8" src="images/resource/feautre1-6.jpg" alt="Bathroom" />
                <a href="#" class="room-video-btn" data-fancybox="gallery"><span>View 3d<br />video</span></a>
                <div class="inner-box">
                  <div class="room-content-overlay">
                    <div class="h4 room-title">Spa-Like Bathroom</div>
                    <div class="room-description">A luxurious bathroom experience with premium fixtures, elegant tile work, and thoughtful design for daily relaxation.</div>
                  </div>
                  <div class="room-features-box">
                    <ul class="room-features-list">
                      <li>Rainfall Shower</li>
                      <li>Freestanding Tub</li>
                      <li>Double Vanity</li>
                      <li>Heated Floors</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Rooms Section -->

      <!-- Testimonial Section -->
      <section class="testimonial-section-two pt-120 pb-20">
        <div class="auto-container">
          <div class="row">
            <div class="col-xl-7 mx-auto">
              <div class="sec-title text-center mb-30">
                <div class="h6 sub-title">testimonial</div>
                <div class="h2 title"><span>Proven</span> Results through client satisfaction</div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="swiper testimonial-slider">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="testimonial-block-two">
                      <div class="inner-box">
                        <div class="logo"><i class="fa-classic fas fa-quote-left"></i></div>
                        <div class="text testimonial-cms-text"><?= e($testimonials[0]['quote'] ?? 'Uraca Realty helped our family compare homes around Davao City without pressure. Marylyn explained the documents clearly, scheduled viewings around our work hours, and guided us until we felt confident with our decision.') ?></div>
                        <div class="author-info">
                          <div class="thumb"><img src="<?= e(validate_asset_path($testimonials[0]['image_path'] ?? '', 'images/resource/testimonial-ana.jpg')) ?>" alt="<?= e($testimonials[0]['client_name'] ?? 'Ana') ?>"></div>
                          <div class="info">
                            <div class="h6 name"><?= e($testimonials[0]['client_name'] ?? 'Ana') ?></div>
                            <div class="designation"><?= e($testimonials[0]['client_role'] ?? 'First-time Home Buyer, Davao City') ?></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="testimonial-block-two">
                      <div class="inner-box">
                        <div class="logo"><i class="fa-classic fas fa-quote-left"></i></div>
                        <div class="text testimonial-cms-text"><?= e($testimonials[1]['quote'] ?? 'We wanted to sell our property in Buhangin but were unsure about pricing and buyer screening. Uraca Realty gave practical market advice, handled inquiries professionally, and helped us move forward with a serious buyer.') ?></div>
                        <div class="author-info">
                          <div class="thumb"><img src="<?= e(validate_asset_path($testimonials[1]['image_path'] ?? '', 'images/resource/testimonial-ramon.jpg')) ?>" alt="<?= e($testimonials[1]['client_name'] ?? 'Ramon') ?>"></div>
                          <div class="info">
                            <div class="h6 name"><?= e($testimonials[1]['client_name'] ?? 'Ramon') ?></div>
                            <div class="designation"><?= e($testimonials[1]['client_role'] ?? 'Property Seller, Buhangin') ?></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slider-info">
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Testimonial Section -->

      <!-- Start feature-Section-Home-2 -->

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
</body>
</html>
