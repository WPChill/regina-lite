jQuery(document).ready(function($){
	/* ---------------------------------------------------------------------- */
	/*  Menu
	/* ---------------------------------------------------------------------- */

	$('.mobile-nav-btn').click(function(){
		$('#navigation').slideToggle();
	});


	/* ---------------------------------------------------------------------- */
	/*  Morph Search
	/* ---------------------------------------------------------------------- */

	$('.nav-search').click(function(){
		$('#morphsearch').addClass('open');

		return false;
	});

	$('.morphsearch-close').click(function(){
		$('#morphsearch').removeClass('open');

		return false;
	});

	/* ---------------------------------------------------------------------- */
	/*  OWL Carousel
	/* ---------------------------------------------------------------------- */
	if (typeof $.fn.owlCarousel !== 'undefined') {

        $('.owlCarousel').each(function ( index ) {

            var sliderSelector = '#owlCarousel-' + $(this).data('slider-id'); // this is the slider selector
            var sliderItems         = $(this).data('slider-items');
            var sliderSpeed         = $(this).data('slider-speed');
            var sliderAutoPlay      = $(this).data('slider-auto-play');
            var sliderNavigation    = $(this).data('slider-navigation');
            var sliderPagination    = $(this).data('slider-pagination');
            var sliderSingleItem    = $(this).data('slider-single-item');

            // auto play
            if(sliderAutoPlay == 0 || sliderAutoPlay == 'false') {
                sliderAutoPlay = false;
            } else {
                sliderAutoPlay = true;
            }

            // pager
            if(sliderPagination == 0 || sliderPagination == 'false') {
                sliderPagination = false;
            } else {
                sliderPagination = true;
            }

            // navigation
            if(sliderNavigation == 0 || sliderNavigation == 'false') {
                sliderNavigation = false;
            } else {
                sliderNavigation = true;
            }

            // Custom Navigation events outside of the owlCarousel mark-up
            $(".mt-owl-next").on('click', function(){
                $(sliderSelector).trigger('owl.next');
            })
            $(".mt-owl-prev").on('click', function(){
                $(sliderSelector).trigger('owl.prev');
            })



            // instantiate the slider with all the options
            $(sliderSelector).owlCarousel({

                items: sliderItems,
                slideSpeed: sliderSpeed,
                navigation : sliderNavigation,
                autoPlay: sliderAutoPlay,
                pagination: sliderPagination,
                navigationText: [ // custom navigation text (instead of bullets). navigationText : false to disable arrows / bullets
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ]
            });

        });

    } // end

	/* ---------------------------------------------------------------------- */
	/*  Sliders
	/* ---------------------------------------------------------------------- */
	if( typeof $.fn.bxSlider !== 'undefined' ) {

		$('.bxslider').each(function(){
            $(this).bxSlider({
                mode: 'fade',
                nextText: '<span class="nc-icon-glyph arrows-1_bold-right"></span>',
                prevText: '<span class="nc-icon-glyph arrows-1_bold-left"></span>'
            })
	    });
    }


	/* ---------------------------------------------------------------------- */
	/*  Back to Top & Waypoint
	/* ---------------------------------------------------------------------- */


		$('.back-to-top').on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
			 	}, 1000
			);
		});

		$('#footer').waypoint(function(){
			$('.back-to-top').fadeIn(1000);
		}, { offset: '50%' });



	/* ---------------------------------------------------------------------- */
	/*  Appointment Modal
	/* ---------------------------------------------------------------------- */

	var modal = (function(){
	    var 
	    method = {},
	    $overlay,
	    $modal,
	    $close;

	    $overlay = $('#modal-overlay');
	    $modal = $('#appointment-modal');
	    $close = $('#appointment-modal .close-btn');

	    $modal.hide();
	    $overlay.hide();

	    method.open = function(){
    	   $modal.fadeIn();
    	   $overlay.fadeIn();

    	   $modal.css({'margin-top' : '-' + ($modal.outerHeight() / 2) + 'px'});
	    };

	    method.close = function(){
	    	$modal.fadeOut();
    	    $overlay.fadeOut();
	    };

	    $close.click(function(e){
	        e.preventDefault();
	        method.close();
	    });

	    return method;
	}());

	$('a[rel="appointment-modal"]').click(function(){
		modal.open();
		return false;
	});



	/* ---------------------------------------------------------------------- */
	/*  Lazyload
	/* ---------------------------------------------------------------------- */

	if (typeof $.fn.lazyload !== 'undefined') {
		$('.lazy').show().lazyload({
			effect : "fadeIn",
			skip_invisible : true
		});
	}


	/* ---------------------------------------------------------------------- */
	/*  Accordion
	/* ---------------------------------------------------------------------- */

    var accordionUL = $('.accordion .inner'),
		accordionLink  = $('.accordion a');
     
    accordionUL.hide();

    accordionLink.click(function(e) {
        e.preventDefault();
        if(!$(this).hasClass('active')) {
            accordionLink.removeClass('active');
            accordionUL.filter(':visible').slideUp('normal');
            $(this).addClass('active').next().stop(true,true).slideDown('normal');
        } else {
            $(this).removeClass('active');
            $(this).next().stop(true,true).slideUp('normal');
        }
    });


	/* ---------------------------------------------------------------------- */
	/*  Height Functions
	/* ---------------------------------------------------------------------- */

	function setHeights() {
		
			// only set the height of last block on the team members page, after the LazyLoad has finished
			$('img.lazy').load( function() {

				var aboutHeight = $('#we-care-block .image').outerHeight();
				var teamHeight = $('.team-member').outerHeight();

				$('.team-join').css({ height : teamHeight});	

				if ($(window).width() > 992) {
					$('#we-care-block .content').css({ height: aboutHeight });
				}
			})
			
	}


	/* ---------------------------------------------------------------------- */
	/*  Init Functions
	/* ---------------------------------------------------------------------- */

	setHeights();
	if( typeof modalInit !== 'undefined' && $.isFunction(modalInit) ) {
		modalInit();
	}

	/* ---------------------------------------------------------------------- */
	/*  Logo Text Position
	/* ---------------------------------------------------------------------- */
	var headerRowHeight = $( '#header .container .row, #header .container-fluid .row' ).height();
	var logoTextHeight = $( '#header .container #logo, #header .container-fluid #logo' ).height();
	$( '#header .container #logo, #header .container-fluid #logo' ).css( 'margin-top', ( headerRowHeight - logoTextHeight ) / 2 );

});