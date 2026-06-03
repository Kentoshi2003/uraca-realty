(function ($) {
  'use strict';

  var isListingCategoryPage = document.body.getAttribute('data-listing-page') === 'category';
  if (isListingCategoryPage) {
    return;
  }

  /* ================================
       Smooth Scroller And Title Animation Js Start
    ================================ */
    if ($('#smooth-wrapper').length && $('#smooth-content').length) {
        gsap.registerPlugin(ScrollTrigger, ScrollSmoother, SplitText);

        gsap.config({
            nullTargetWarn: false,
        });

        let smoother = ScrollSmoother.create({
            wrapper: "#smooth-wrapper",
            content: "#smooth-content",
            smooth: 2,
            effects: true,
            smoothTouch: 0.1,
            normalizeScroll: false,
            ignoreMobileResize: true,
        });
    }

   if (typeof gsap !== "undefined") {
        gsap.registerPlugin(ScrollTrigger, SplitText);

        let mm = gsap.matchMedia();

        mm.add("(min-width: 1200px)", () => {

            let splits = [];

            // ===== tz-sub-tilte =====
            $('.tz-sub-tilte').each(function (index, el) {

            let split = new SplitText(el, {
                type: "lines,words,chars",
                linesClass: "split-line"
            });

            splits.push(split);

            gsap.set(split.chars, {
                opacity: 0,
                x: 7
            });

            gsap.to(split.chars, {
                scrollTrigger: {
                trigger: el,
                start: "top 90%",
                end: "top 60%",
                scrub: 1
                },
                x: 0,
                opacity: 1,
                duration: 0.7,
                stagger: 0.2
            });
            });

            // ===== tz-itm-title =====
            $('.tz-itm-title').each(function (index, el) {

            let split = new SplitText(el, {
                type: "lines,words,chars",
                linesClass: "split-line"
            });

            splits.push(split);

            gsap.set(split.chars, {
                opacity: 0.3,
                x: -7
            });

            gsap.to(split.chars, {
                scrollTrigger: {
                trigger: el,
                start: "top 92%",
                end: "top 60%",
                scrub: 1
                },
                x: 0,
                opacity: 1,
                duration: 0.7,
                stagger: 0.2
            });
            });

            // 🔥 MOST IMPORTANT PART
            ScrollTrigger.refresh();

            // 🔥 cleanup on breakpoint change
            return () => {
            splits.forEach(split => split.revert());
            ScrollTrigger.getAll().forEach(st => st.kill());
            };

        });
    }


  setTimeout(function() {
    gsap.registerPlugin(ScrollTrigger);

    // animation1
    const tm_gsap_split_text = document.querySelector(".tm-split-text");
    if(tm_gsap_split_text) {
      setTimeout(function () {
        var st = $('document').find(".tm-split-text");
        if(st.length == 0) return;
        gsap.registerPlugin(SplitText);
        st.each(function(index, el) {
          el.split = new SplitText(el, {
            type: "lines,words,chars",
            linesClass: "split-line"
          });
          gsap.set(el, { perspective: 400 });

          if( $(el).hasClass('split-in-fade') ){
            $(el).addClass('active');
            gsap.set(el.split.chars, {
              opacity: 0,
              ease: "Back.easeOut",
            });
          }
          if( $(el).hasClass('split-in-right') ){
            gsap.set(el.split.chars, {
              opacity: 0,
              x: "50",
              ease: "Back.easeOut",
            });
          }
          if( $(el).hasClass('split-in-left') ){
            gsap.set(el.split.chars, {
              opacity: 0,
              x: "-50",
              ease: "circ.out",
            });
          }
          if( $(el).hasClass('split-in-up') ){
            gsap.set(el.split.chars, {
              opacity: 0,
              y: "80",
              ease: "circ.out",
            });
          }
          if( $(el).hasClass('split-in-down') ){
            gsap.set(el.split.chars, {
              opacity: 0,
              y: "-80",
              ease: "circ.out",
            });
          }
          if( $(el).hasClass('split-in-rotate') ){
            gsap.set(el.split.chars, {
              opacity: 0,
              rotateX: "50deg",
              ease: "circ.out",
            });
          }
          if( $(el).hasClass('split-in-scale') ){
            gsap.set(el.split.chars, {
              opacity: 0,
              scale: "0.5",
              ease: "circ.out",
            });
          }
          el.anim = gsap.to(el.split.chars, {
            scrollTrigger: {
              trigger: el,
              toggleActions: "restart pause resume reverse",
              start: "top 90%",
            },
            x: "0",
            y: "0",
            rotateX: "0",
            scale: 1,
            opacity: 1,
            duration: 0.8,
            stagger: 0.02,
          });
        });
      }, 200);
    }


  }, 2300);


})(jQuery);
