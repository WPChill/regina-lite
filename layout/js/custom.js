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