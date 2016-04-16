(function ($) {
	"use strict";

    jQuery(document).ready(function($){
         /*---
         * Full Screen Banner
         *---------------*/
        $(window).on('resizeEnd', function () {
            $("#fullscreen-banner, #homeSliderArea").height($(window).height());
        });

        $(window).on('resize', function () {
            if (this.resizeTO) clearTimeout(this.resizeTO);
            this.resizeTO = setTimeout(function () {
                $(this).trigger('resizeEnd');
            }, 300);
        }).trigger("resize");

        /*---
        * Sticky & One Page Nav Menu
        *---------------*/
        $('#mainmenu').sticky({topSpacing:0});
				var windowWidth = $(window).width();
				if( windowWidth < 768 ){
						$('#mobileMenu').sticky({topSpacing:0});
				}
				if($.fn.onePageNav){
						$('.navbar-nav').onePageNav({
								currentClass : 'active',
								scrollSpeed : 600
						});
				}


				/*---
        * Mobile Menu
        *---------------*/
				if($.fn.meanmenu){
					$('#mobileMenu nav').meanmenu({
							meanMenuContainer : '#mobileMenu',
							onePage : true,
							meanScreenWidth : 768
					});
				}

        /*---
        * jQuery Smooth Scroll
        *-------------------------*/
       $('.scroll-down').on('click', function(event) {
           var $anchor = $($(this).attr('href')).offset().top - 70;
           $('body, html').animate({scrollTop : $anchor}, 600);
					 event.preventDefault();
           return false;
       });
        /*---
        * Contact Form Textarea Height
        *--------------------------------*/
        var inputHeight = $('.leave-inputs').height();
        $('.leave-comments textarea').css('min-height', inputHeight - 18 + 'px');

         /*---
         * Scroll Bottom To Top
         *-------------------------*/
        jQuery('#scrollTop').on('click', function(){
            jQuery("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });

         /*---
         * VenoBox Activator
         *-----------------------*/
        $('#video, .popUpbtn').venobox();

				/*---
				* Counter Activator By Waypoint
				*----------------------------------*/
				jQuery('.counter').counterUp({
						time: 10000
				});
        /*---
        * DonutChart Activator By Waypoint
        *----------------------------------*/
        jQuery('.chart').each(function() {
            jQuery(this).donutchart({
                'size': 148,
                'fgColor': '#333333',
                'donutwidth': 10,
                'textsize': 30
            });
        });
        jQuery('.chart-trigger').waypoint(function() {
            jQuery(this).find('.chart').donutchart("animate");
        }, {
            offset: '100%'
        });

        /*---
        * OWL CAROUSEL
        *------------------*/
				if($.fn.slick ){

						$("#homeSlider").slick({
								autoplay:true,
								autoplaySpeed:10000,
								speed:900,
								slidesToShow:1,
								slidesToScroll:1,
								pauseOnHover:false,
								dots:false,
								pauseOnDotsHover:true,
								cssEase:'linear',
								fade:true,
								draggable:false,
								prevArrow:'<button class="PrevArrow"></button>',
								nextArrow:'<button class="NextArrow"></button>',
						});

				}

        if($.fn.owlCarousel) {

            $('.clients-say-slider').owlCarousel({
                items: 2,
								autoplay: true,
								responsive: {

										// Mobile Layout
										0: {
												items: 1
										},
										768 : {
												items : 2
										}

								}
            });

            $('.sponsors-slider').owlCarousel({
                items: 4,
								autoplay: true,
								loop: true,
								responsive: {

										// Mobile Layout
										0: {
												items: 2
										},
										768 : {
												items : 3
										},
										970 : {
												items : 4
										}

								}
            });

            $('.portfolio-slider').owlCarousel({
                items: 2,
                controlsClass: 'portfolio-controls'
            });
        };
        
        // VIDEO PLAYER
        
        // Home Video Only
			jQuery("#fullscreen-banner, .video-area").find('.videoPlayer').parent().addClass("playing");

      jQuery(".videoPlayer").parent().addClass("showcontrols");

  		jQuery(".videoPlayer").each(function(){

  			var element = jQuery(this),
  				_mmVideo = element[0];


  			_mmVideo.addEventListener('ended', function () {
  				element.parent().removeClass("playing");
  			}, false);

  			_mmVideo.addEventListener('pause', function () {
  				element.parent().removeClass("playing");
  			}, false);

  			_mmVideo.addEventListener('play', function () {
  				element.parent().addClass("playing");
  			}, false);

  		});



  		jQuery(".player-controls .playerBtn").on('click', function(){
  			var element = jQuery(this),
  				_mmVideo = element.parent().siblings(".videoPlayer")[0];
  			if(_mmVideo.paused){
  				_mmVideo.play();
  			}else{
  				_mmVideo.pause();
  			}
  		});

    });
    

		// preloader
		$(window).load(function(){
				$('body').css('overflow-y', 'visible');
				$('#preloader').fadeOut('slow', function(){
						$(this).remove();
				});
		});

})(jQuery);
