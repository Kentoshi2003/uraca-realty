var THEMEMASCOT = {};
(function($) {

	"use strict";

	var isListingCategoryPage = document.body.getAttribute("data-listing-page") === "category";


  THEMEMASCOT.isRTL = {
    check: function() {
      if( $( "html" ).attr("dir") === "rtl" ) {
        return true;
      } else {
        return false;
      }
    }
  };

  THEMEMASCOT.isLTR = {
    check: function() {
      if( $( "html" ).attr("dir") !== "rtl" ) {
        return true;
      } else {
        return false;
      }
    }
  };

	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.preloader').length){
			$('.preloader').delay(200).fadeOut(500);
		}
	}
	$(document).ready(function () {
    $(".preloader-loaded").addClass("loaded");
    if ($(".preloader-loaded").hasClass("loaded")) {
      $("#preloader").delay(750).queue(function () {
        $(this).remove();
      });
    }
  });

	//Update Header Style and Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.header-style-one');
			var scrollLink = $('.scroll-to-top');
			var sticky_header = $('.main-header .sticky-header');
			if (windowpos > 100) {
				sticky_header.addClass("fixed-header animated slideInDown");
				scrollLink.fadeIn(300);
			}else {
				sticky_header.removeClass("fixed-header animated slideInDown");
				scrollLink.fadeOut(300);
			}
			if (windowpos > 1) {
				siteHeader.addClass("fixed-header");
			}else {
				siteHeader.removeClass("fixed-header");
			}
		}
	}
	headerStyle();


	// Backtotop Js
	function back_to_top() {
	var btn = $('#back_to_top');
	var btn_wrapper = $('.back-to-top-wrapper');
	var windowOn = $(window); // Define windowOn properly

	windowOn.on('scroll', function () {
		if (windowOn.scrollTop() > 300) {
			btn_wrapper.addClass('back-to-top-btn-show');
		} else {
			btn_wrapper.removeClass('back-to-top-btn-show');
		}
	});

	btn.on('click', function (e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, 300); // Removed quotes from 300, since it's a number
	});
	}

	back_to_top();

	//Submenu Dropdown Toggle
	if($('.main-header li.dropdown ul').length){
		$('.main-header .navigation li.dropdown').append('<div class="dropdown-btn"><i class="fa fa-angle-down"></i></div>');
	}

	//Mobile Nav Hide Show
	if($('.mobile-menu').length){

		var mobileMenuContent = $('.main-header .main-menu .navigation').html();

		$('.mobile-menu .navigation').append(mobileMenuContent);
		$('.sticky-header .navigation').append(mobileMenuContent);
		$('.mobile-menu .close-btn').on('click', function() {
			$('body').removeClass('mobile-menu-visible');
		});

		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('ul').slideToggle(500);
			$(this).toggleClass('active');
		});

		//Menu Toggle Btn
		$('.mobile-nav-toggler').on('click', function() {
			$('body').addClass('mobile-menu-visible');
		});

		//Menu Toggle Btn
		$('.mobile-menu .menu-backdrop, .mobile-menu .close-btn').on('click', function() {
			$('body').removeClass('mobile-menu-visible');
		});

	}

	//Header Search
	if($('.search-btn').length) {
		$('.search-btn').on('click', function() {
			$('.main-header').addClass('moblie-search-active');
		});
		$('.close-search, .search-back-drop').on('click', function() {
			$('.main-header').removeClass('moblie-search-active');
		});
	}

	//service-carousel One
	if ($('.banner-slider-one').length) {
		var swiper = new Swiper(".banner-slider-one", {
			slidesPerView: 1,
			spaceBetween: 0,
			speed: 600,
			loop: true,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
	}

  if ($('.testimonial-slider-2').length > 0) {
    const testimonialSlider2 = new Swiper(".testimonial-slider-2", {
      spaceBetween: 30,
      speed: 1300,
      loop: true,
      autoplay: {
        delay: 2000,
        disableOnInteraction: false,
      },
			navigation: {
        nextEl: ".array-next",
        prevEl: ".array-prev",
      },
    });
 	}

	if ($('.three-grid-slider').length) {
	  const swiper = new Swiper(".three-grid-slider", {
	    loop: true,
	    spaceBetween: 30,
	    slidesPerView: 3,
	    speed: 800,
	    grabCursor: true,
	    watchOverflow: true,
	    breakpoints: {
	      0: {
	        slidesPerView: 1,
	        centeredSlides: false,
	      },
	      736: {
	        slidesPerView: 2.2,
	        centeredSlides: true,
	      },
	      992: {
	        slidesPerView: 3,
	        centeredSlides: false,
	      },
	      1200: {
	        slidesPerView: 3,
	      },
	    },
	    pagination: {
	      el: ".three-grid-slider .swiper-pagination",
	      clickable: true,
	    },
	    navigation: {
	      nextEl: ".three-grid-slider .swiper-button-next",
	      prevEl: ".three-grid-slider .swiper-button-prev",
	    },
	  });
	}

	if ($('.service-one-slider').length) {
		var swiper = new Swiper(".service-one-slider", {
			speed:1500,
			loop: true,
			slidesPerView: 1,
			spaceBetween: 0,
			breakpoints: {
				320: {
					slidesPerView: 1,
				},
				576: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 2,
				},
				992: {
					slidesPerView: 3,
				},
				1023: {
					slidesPerView: 3,
				},
				1400: {
					slidesPerView: 4,
				},
			},
			// Navigation arrows
			navigation: {
				nextEl: '.slider-next',
				prevEl: '.slider-prev',
			},
		});
	}

	$(function () {
    if ($(window).width() < 991) {
      $('.contact-content-1 .sec-title').removeClass('light');
    }
	});

	// Background image area start here ***
	$("[data-background").each(function() {
	  $(this).css(
	    "background-image",
	    "url( " + $(this).attr("data-background") + "  )"
	  );
	});

	// Background image hover change area start here ***
	$(".service-block").hover(function() {
	  let newBackground = $(this).data("bg");
	  $(".services-section .outer-box")
	   .attr("data-background", newBackground)
	   .css("background-image", "url(" + newBackground + ")");
	});

	if ($('.swiper-slide .service-block .inner-box').length) {
    $(document).ready(function() {
      const $stepBlocks = $('.swiper-slide .service-block .inner-box');
      let $lastActiveBlock = $stepBlocks.eq(2); // Start with 2nd div active

      // Initialize - set middle block active
      $stepBlocks.removeClass('active');
      $lastActiveBlock.addClass('active');

      // Hover handling using .on()
      $stepBlocks.on('mouseenter', function() {
        $stepBlocks.removeClass('active');
        $(this).addClass('active');
        $lastActiveBlock = $(this);
      });

      $stepBlocks.on('mouseleave', function() {
        $stepBlocks.removeClass('active');
        $lastActiveBlock.addClass('active');
      });
		});
	}

	if ($('.team-block1').length) {
    var $team_block = $('.team-block1 .inner-block');
    $($team_block).on('mouseenter', function (e) {
      $(this).find('.content .social-icon').stop().slideDown(300);
      return false;
    });
    $($team_block).on('mouseleave', function (e) {
      $(this).find('.content .social-icon').stop().slideUp(300);
      return false;
    });
	}

	// 21. Image Reveal Animation  used
  if (!isListingCategoryPage) {
    let imgs_reveal = document.querySelectorAll(".img-reveal");

    imgs_reveal.forEach((container) => {
      let image = container.querySelector("img");
      let tl = gsap.timeline({
        scrollTrigger: {
          trigger: container,
          toggleActions: "restart none none reset"
        }
      });

      tl.set(container, { autoAlpha: 1 });
      tl.from(container, 1.5, {
        xPercent: -100,
        ease: Power2.out
      });
      tl.from(image, 1.5, {
        xPercent: 100,
        scale: 1.3,
        delay: -1.5,
        ease: Power2.out
      });
    });
  }
		
	
	//	Testimonial carousel One
	if ($('.testimonial-slider').length) {
		var swiper = new Swiper(".testimonial-slider", {
			slidesPerView: 1,
			spaceBetween: 0,
			speed: 600,
			loop: true,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
	}

	//>> Footer Instagram Slider Start <<//
	if($('.footer-instagram-slider').length > 0) {
		const footerInstagramSlider = new Swiper(".footer-instagram-slider", {
			spaceBetween: 10,
			speed: 1300,
			loop: true,
			autoplay: {
				delay: 2000,
				disableOnInteraction: false,
			},
			breakpoints: {
				1199: {
					slidesPerView: 5,
				},
				991: {
					slidesPerView: 4,
				},
				767: {
					slidesPerView: 3,
				},
				575: {
					slidesPerView: 2,
				},
				0: {
					slidesPerView: 1,
				},
			},
		});
	}

  // Project Image Slider
  if ($(".project-image-slider").length) {
    var swiper = new Swiper(".project-image-slider", {
      slidesPerView: 2,
      spaceBetween: 30,
      speed: 600,
      loop: true,
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        576: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 1,
        },
        992: {
          slidesPerView: 2,
        },
        1023: {
          slidesPerView: 2,
        },
      },
    });
  }

  // Service Slider
	if ($('.five-grid-slider').length) {
	  const swiper = new Swiper(".five-grid-slider", {
	    grabCursor: true,
	    loop: true,
	    slidesPerView: 5,
	    spaceBetween: 16,
	    speed: 800,
	    watchOverflow: true,
	    breakpoints: {
	      0: {
	        slidesPerView: 1,
	        centeredSlides: false,
	      },
	      500: {
	        slidesPerView: 2,
	      },
	      768: {
	        slidesPerView: 3,
	        centeredSlides: true,
	      },
	      992: {
	        slidesPerView: 4,
	        centeredSlides: false,
	      },
	      1200: {
	        slidesPerView: 5,
	      },
	    },

	    pagination: {
	      el: ".five-grid-slider .swiper-pagination",
	      clickable: true,
	    },

	    navigation: {
	      nextEl: ".five-grid-slider .swiper-button-next",
	      prevEl: ".five-grid-slider .swiper-button-prev",
	    },
	  });
	}

  function show_secondary_price(pricing_tables){
    pricing_tables.addClass('show-secondary-price');
    var pricing_btn = pricing_tables.find('.btn');
    var secondary_btn_url = pricing_btn.data("secondary-link");
    pricing_btn.attr("href", secondary_btn_url);
  }
  function hide_secondary_price(pricing_tables){
    pricing_tables.removeClass('show-secondary-price');
    var pricing_btn = pricing_tables.find('.btn');
    var normal_btn_url = pricing_btn.data("normal-link");
    pricing_btn.attr("href", normal_btn_url);
  }

  //smart btn
  var TM_Pricing_Switcher_Smart = function ($scope) {
    var pricing_smart_switcher = $('.tm-pricing-smart-switcher, .tm-pricing-plan-switcher');
    if( pricing_smart_switcher.length > 0 ) {
      pricing_smart_switcher.find("[data-pricing-trigger]").on("click", function (e) {
        var $self = $(e.target);
        $self.toggleClass("secondary-active");
        var pricing_tables = $self.parents("section").find(".tm-pricing-table");

        if( $self.hasClass( 'secondary-active' ) ) {
          show_secondary_price(pricing_tables);
        } else {
          hide_secondary_price(pricing_tables);
        }
      });
    }
  };

  //round, flat btn
  var TM_Pricing_Switcher_Btn = function ($scope) {
    var pricing_btn_switcher = $('.tm-pricing-smart-switcher-button');
    if( pricing_btn_switcher.length > 0 ) {
      pricing_btn_switcher.find("[data-pricing-trigger]").on("click", function (e) {
        var target_id = $(this).data('show');
        var $self = $(e.target);
        pricing_btn_switcher.find("[data-pricing-trigger]").removeClass("active");
        $(this).addClass("active");
        var pricing_tables = $self.parents("section").find(".tm-pricing-table");

        if( target_id == "year" ) {
          show_secondary_price(pricing_tables);
        } else {
          hide_secondary_price(pricing_tables);
        }
      });
    }
  };

	if ($('.product-details .bxslider').length) {
		$('.product-details .bxslider').bxSlider({
        nextSelector: '.product-details #slider-next',
        prevSelector: '.product-details #slider-prev',
        nextText: '<i class="fa fa-angle-right"></i>',
        prevText: '<i class="fa fa-angle-left"></i>',
        mode: 'fade',
        auto: 'true',
        speed: '700',
        pagerCustom: '.product-details .slider-pager .thumb-box'
    });
	};

	if ($('.room-section-h1-two .bxslider').length) {
		$('.room-section-h1-two .bxslider').bxSlider({
        nextSelector: '.room-section-h1-two #slider-next',
        prevSelector: '.room-section-h1-two #slider-prev',
        nextText: '<i class="fa fa-angle-right"></i>',
        prevText: '<i class="fa fa-angle-left"></i>',
        mode: 'fade',
        auto: 'true',
        speed: '1000',
        pagerCustom: '.room-section-h1-two .slider-pager .thumb-box'
    });
	};

	//Distance Range Slider
	if ($('.distance-range-slider').length) {
		$(".distance-range-slider").slider({
			range: true,
			min: 0,
			max: 2000,
			values: [0, 1500],
			slide: function (event, ui){
				$("input.range-amount").val(ui.values[0] + " - " + ui.values[1]);
			}
		});
		$("input.range-amount").val($(".distance-range-slider").slider("values", 0) + " - " + $(".distance-range-slider").slider("values", 1));
	}

  $(".quantity-box .add").on("click", function () {
    if ($(this).prev().val() < 999) {
      $(this)
        .prev()
        .val(+$(this).prev().val() + 1);
    }
  });
  $(".quantity-box .sub").on("click", function () {
    if ($(this).next().val() > 1) {
      if ($(this).next().val() > 1)
        $(this)
        .next()
        .val(+$(this).next().val() - 1);
    }
  });

	//Price Range Slider
	if($('.price-range-slider').length){
		$( ".price-range-slider" ).slider({
			range: true,
			min: 10,
			max: 99,
			values: [ 10, 60 ],
			slide: function( event, ui ) {
			$( "input.property-amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
			}
		});

		$( "input.property-amount" ).val( $( ".price-range-slider" ).slider( "values", 0 ) + " - $" + $( ".price-range-slider" ).slider( "values", 1 ) );
	}


	//Accordion Box
	if ($(".title-box").length) {
		$(".title-box").on("click", function () {
			var $clickedItem = $(this).closest(".faq-block-one");

			if ($clickedItem.hasClass("active")) {
				$clickedItem
					.removeClass("active")
					.find(".content-box")
					.slideUp()
					.removeClass("show");
			} else {
				$(".faq-block-one")
					.removeClass("active")
					.find(".content-box")
					.slideUp()
					.removeClass("show");
				$clickedItem
					.addClass("active")
					.find(".content-box")
					.slideDown()
					.addClass("show");
			}
		});
	}
	if ($(".title-box").length) {
		$(".title-box").on("click", function () {
			var $clickedItem = $(this).closest(".faq-block-two");

			if ($clickedItem.hasClass("active")) {
				$clickedItem
					.removeClass("active")
					.find(".content-box")
					.slideUp()
					.removeClass("show");
			} else {
				$(".faq-block-two")
					.removeClass("active")
					.find(".content-box")
					.slideUp()
					.removeClass("show");
				$clickedItem
					.addClass("active")
					.find(".content-box")
					.slideDown()
					.addClass("show");
			}
		});
	}

	// Floor Tab Content Home Layout 1
  $(function () {
    $('.floor-tab-btn').on('click', function () {
      let target = $(this).data('tab');

      // active button
      $('.floor-tab-btn').removeClass('active');
      $(this).addClass('active');

      // content switch
      $('.floor-tab-content').removeClass('active');
      $(target).addClass('active');
    });
  });

	// Floor Tab Content Home Layout 1
  $(function () {
    $('.floor-tab-btn-two').on('click', function () {
      let target = $(this).data('tab');

      // active button
      $('.floor-tab-btn-two').removeClass('active');
      $(this).addClass('active');

      // content switch
      $('.floor-tab-content-two').removeClass('active');
      $(target).addClass('active');
    });
  });

	//Accordion Box
	if ($('.accordion-box').length) {
		$(".accordion-box").on('click', '.acc-btn', function () {

			var outerBox = $(this).parents('.accordion-box');
			var target = $(this).parents('.accordion');

			if ($(this).hasClass('active') !== true) {
				$(outerBox).find('.accordion .acc-btn').removeClass('active ');
			}

			if ($(this).next('.acc-content').is(':visible')) {
				return false;
			} else {
				$(this).addClass('active');
				$(outerBox).children('.accordion').removeClass('active-block');
				$(outerBox).find('.accordion').children('.acc-content').slideUp(300);
				target.addClass('active-block');
				$(this).next('.acc-content').slideDown(300);
			}
		});
	}

	// Location Award Content Active
	if($('.location-block .inner-box').length) {
		$('.location-block .inner-box').on('mouseenter', function() {
			$(this).addClass('active');
			$('.inner-box').removeClass('active');
		});
		$('.location-block .inner-box').on('mouseleave', function() {
			$(this).addClass('active');
		});
	}

	// Property Room Features Home layout 2 Functionality
	(function () {
	  const navItems = document.querySelectorAll(".room-list-btn");
	  const roomContainers = document.querySelectorAll(".room-image-box");
	  navItems.forEach((item) => {
	    item.addEventListener("click", function () {
	      const roomType = this.getAttribute("data-room");

	      // Don't do anything if clicking the same active item
	      if (this.classList.contains("active")) {
	        return;
	      }

	      // Find current active container
	      const currentActive = document.querySelector(".room-image-box.active");
	      const targetContainer = document.querySelector(`.room-image-box[data-room-content="${roomType}"]`);

	      if (!targetContainer) return;

	      // Update active state
	      navItems.forEach((nav) => nav.classList.remove("active"));
	      this.classList.add("active");

	      // Slide out current container
	      if (currentActive) {
	        currentActive.classList.remove("active");
	        currentActive.classList.add("slide-out");
	      }

	      // Wait for slide-out animation, then show new container
	      setTimeout(() => {
	        if (currentActive) {
	          currentActive.classList.remove("slide-out");
	        }

	        // Show new container with slide-in animation
	        targetContainer.classList.remove("slide-out");
	        targetContainer.classList.add("slide-in");

	        setTimeout(() => {
	          targetContainer.classList.remove("slide-in");
	          targetContainer.classList.add("active");
	        }, 10);
	      }, 500);
	    });
	  });
	})();

	//Jquery Knob animation  // Pie Chart Animation
	if ($('.dial').length) {
		$('.dial').appear(function () {
			var elm = $(this);
			var color = elm.attr('data-fgColor');
			var perc = elm.attr('value');

			elm.knob({
				'value': 0,
				'min': 0,
				'max': 100,
				'skin': 'tron',
				'readOnly': true,
				'thickness': 0.15,
				'dynamicDraw': true,
				'displayInput': false
			});

			$({ value: 0 }).animate({ value: perc }, {
				duration: 2000,
				easing: 'swing',
				progress: function () {
					elm.val(Math.ceil(this.value)).trigger('change');
				}
			});

			//circular progress bar color
			$(this).append(function () {
				// elm.parent().parent().find('.circular-bar-content').css('color',color);
				//elm.parent().parent().find('.circular-bar-content .txt').text(perc);
			});

		}, { accY: 20 });
	}


	//Fact Counter + Text Count
	if($('.count-box').length){
		$('.count-box').appear(function(){

			var $t = $(this),
				n = $t.find(".count-text").attr("data-stop"),
				r = parseInt($t.find(".count-text").attr("data-speed"), 10);

			if (!$t.hasClass("counted")) {
				$t.addClass("counted");
				$({
					countNum: $t.find(".count-text").text()
				}).animate({
					countNum: n
				}, {
					duration: r,
					easing: "linear",
					step: function() {
						$t.find(".count-text").text(Math.floor(this.countNum));
					},
					complete: function() {
						$t.find(".count-text").text(this.countNum);
					}
				});
			}

		},{accY: 0});
	}

	

	//Dropdown Button
	$('.pricing-tabs .tab-buttons .yearly').on('click', function() {
		$('.round').addClass('boll-right');
	});
	
	//Dropdown Button
	$('.pricing-tabs .tab-buttons .monthly').on('click', function() {
		$('.round').removeClass('boll-right');
	});

	//Tabs Box
	if ($('.tabs-box').length) {
		$('.tabs-box .tab-buttons .tab-btn').on('click', function (e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));

			if ($(target).is(':visible')) {
				return false;
			} else {
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab animated fadeIn');
				$(target).fadeIn(300);
				$(target).addClass('active-tab animated fadeIn');
			}
		});
	}

	//Progress Bar
	if ($('.progress-line').length) {
		$('.progress-line').appear(function () {
			var el = $(this);
			var percent = el.data('width');
			$(el).css('width', percent + '%');
		}, { accY: 0 });
	}

	//LightBox / Fancybox
	if($('.lightbox-image').length) {
		$('.lightbox-image').fancybox({
			openEffect  : 'fade',
			closeEffect : 'fade',
			helpers : {
				media : {}
			}
		});
	}

	// Scroll to a Specific Div
	if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			});
		});
	}

	// Home 1 Destination js
	var swiper = new Swiper(".destination-active", {
		speed:1500,
		loop: true,
		slidesPerView: 1,
		autoplay: {
			delay: 3000,            // time between slides (in ms)
			disableOnInteraction: false, // keep autoplay after user interactions
			pauseOnMouseEnter: false,    // optional: autoplay won't pause on hover
		},
		// Navigation arrows
		navigation: {
			nextEl: '.slider-next',
			prevEl: '.slider-prev',
		},
		// pagination
		pagination: {
			el: ".destination-dots",
			clickable:true,
		},
	});

	// Home 1 Destination js
	var swiper = new Swiper(".testimonial-active-home-two", {
		speed:1500,
		loop: true,
		slidesPerView: 1,
		spaceBetween: 50,
		autoplay: {
			delay: 3000,            // time between slides (in ms)
			disableOnInteraction: false, // keep autoplay after user interactions
			pauseOnMouseEnter: false,    // optional: autoplay won't pause on hover
		},
		// Navigation arrows
		navigation: {
			nextEl: '.slider-next',
			prevEl: '.slider-prev',
		},
		// pagination
		pagination: {
			el: ".blog-slider-pagination",
			clickable:true,
		},
	});


	// Aos Animation
	AOS.init();

	// Elements Animation
	if($('.wow').length){
		var wow = new WOW(
		  {
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       false,       // trigger animations on mobile devices (default is true)
			live:         true       // act on asynchronously loaded content (default is true)
		  }
		);
		wow.init();
	}

	// count Bar
	if ($(".count-bar").length) {
		$(".count-bar").appear(
			function () {
					var el = $(this);
					var percent = el.data("percent");
					$(el).css("width", percent).addClass("counted");
				}, {
					accY: -50
			}
		);
	}

	//Image Reveal Animation
	if(!isListingCategoryPage && $('.reveal').length){
		gsap.registerPlugin(ScrollTrigger);
		let revealContainers = document.querySelectorAll(".reveal");
		revealContainers.forEach((container) => {
			let image = container.querySelector("img");
			let tl = gsap.timeline({
				scrollTrigger: {
				trigger: container,
				toggleActions: "play none none none"
				}
			});
			tl.set(container, { autoAlpha: 1 });
			tl.from(container, 1.5, {
				xPercent: -100,
				ease: Power2.out
			});
			tl.from(image, 1.5, {
				xPercent: 100,
				scale: 1.3,
				delay: -1.5,
				ease: Power2.out
			});
		});
	}

	if (!isListingCategoryPage) {
		document.querySelectorAll(".scroll-text").forEach((section) => {
			let tl = gsap.timeline({
				scrollTrigger: {
				trigger: section,
				start: "top 100%",
				end: "bottom top",
				scrub: 1,
				markers: false,
				},
			});
			tl.from(section.querySelector(".text1"), { xPercent: 20 })
			.from(section.querySelector(".text2"), { xPercent: -20 }, 0);
			tl.from(section.querySelector(".scroll-anim-top"), { yPercent: 10 }, 0)
			.from(section.querySelector(".scroll-anim-bottom"), { yPercent: -10 }, 0);
		});
	}

	//Bg Parallax
	if(!isListingCategoryPage && $('.bg-parallax').length){
		gsap.to(".bg-parallax", {
			backgroundPosition: "70% 75%",
			ease: "ease1",
			scrollTrigger: {
			trigger: ".bg-parallax",
			start: "top bottom",
			end: "bottom top",
			scrub: 1
			}
		});
	}

		// Select2 Dropdown
	$('.custom-select').select2({
		minimumResultsForSearch: 7,
	});

	//Gallery Filters
	 if($('.filter-list').length){
	 	 $('.filter-list').mixItUp({});
	 }

	//Custom Data Attributes
	if($('[data-tm-bg-color]').length){
		$('[data-tm-bg-color]').each(function() {
		  $(this).css("cssText", "background-color: " + $(this).data("tm-bg-color") + " !important;");
		});
	}

	if($('.scroll-to-fixed-parent').length){
	  var scroll_childs = $('.scroll-to-fixed-child');
	  for (var i = 0, length = scroll_childs.length; i < length; i++) {
	    var scroll_child = $(scroll_childs[i]);
	    scroll_child.scrollToFixed({
	      marginTop: $('header').outerHeight(true) + 10,
	      zIndex: 2,
	      spacerClass: 'd-none',
	      removeOffsets: true,
	      limit: function() {
	        var parent = this.parents('.scroll-to-fixed-parent');
	        return parent.offset().top + parent.outerHeight(true) - this.outerHeight(true) - 20;
	      }
	    });
	  }
	 }

  /* ---------------------------------------------------------------------- */
  /* ----------- Activate Menu Item on Reaching Different Sections ---------- */
  /* ---------------------------------------------------------------------- */
  var $onepage_nav = $('.onepage-nav');
  var $sections = $('section');
  var $window = $(window);
  function TM_activateMenuItemOnReach() {
	  if( $onepage_nav.length > 0 ) {
	    var cur_pos = $window.scrollTop() + 2;
	    var nav_height = $onepage_nav.outerHeight();
	    $sections.each(function() {
	      var top = $(this).offset().top - nav_height - 80,
	        bottom = top + $(this).outerHeight();

	      if (cur_pos >= top && cur_pos <= bottom) {
	        $onepage_nav.find('a').parent().removeClass('current').removeClass('active');
	        $sections.removeClass('current').removeClass('active');
	        $onepage_nav.find('a[href="#' + $(this).attr('id') + '"]').parent().addClass('current').addClass('active');
	      }

	      if (cur_pos <= nav_height && cur_pos >= 0) {
	        $onepage_nav.find('a').parent().removeClass('current').removeClass('active');
	        $onepage_nav.find('a[href="#header"]').parent().addClass('current').addClass('active');
	      }
	    });
	  }
	}

	// Piechart for property single page
  document.addEventListener("DOMContentLoaded", function () {

    const canvas = document.getElementById("mortgageChart");

    if (!canvas) return;

    const ctx = canvas.getContext("2d");

    const data = {
      labels: [
        "Down Payment",
        "Loan Amount",
        "Monthly Mortgage Payment",
        "Property Tax",
        "Home Insurance",
        "PMI",
        "Monthly HOA Fees"
      ],
      datasets: [{
        data: [15900, 90100, 522.54, 106, 166.67, 0, 250],
        backgroundColor: [
          "#ff4d7e",
          "#3399ff",
          "#ffcc33",
          "#36a2eb",
          "#99cc33",
          "#00cccc",
          "#ff9900"
        ],
        borderWidth: 0
      }]
    };

    const options = {
      cutout: "75%",
      plugins: {
        legend: {
          display: false
        }
      }
    };

    new Chart(ctx, {
      type: "doughnut",
      data: data,
      options: options
    });

  });

  $(function () {
    var defaultItem = $('.property-feature-block .inner-box.active');
    $('.property-feature-block .inner-box').hover(
      function () {
        $('.property-feature-block .inner-box').removeClass('active');
        $(this).addClass('active');
      },
      function () {
        $('.property-feature-block .inner-box').removeClass('active');
        defaultItem.addClass('active');
      }
    );
  });


/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */

	$(window).on('scroll', function() {
		headerStyle();
		TM_activateMenuItemOnReach();
	});

/* ==========================================================================
   When document is loading, do
   ========================================================================== */

	$(window).on('load', function() {
		handlePreloader();
		TM_Pricing_Switcher_Smart();
  	TM_Pricing_Switcher_Btn();
	});

})(window.jQuery);
