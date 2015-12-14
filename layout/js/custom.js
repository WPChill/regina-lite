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
	/*  Lazyload
	/* ---------------------------------------------------------------------- */

	if (typeof $.fn.lazyload !== 'undefined') {
		$('.lazy').show().lazyload({
			effect : "fadeIn",
			skip_invisible : true
		});
	}

	/* ---------------------------------------------------------------------- */
	/*  Logo Text Position
	/* ---------------------------------------------------------------------- */
	var headerRowHeight = $( '#header .container .row, #header .container-fluid .row' ).height();
	var logoTextHeight = $( '#header .container #logo, #header .container-fluid #logo' ).height();
	$( '#header .container #logo, #header .container-fluid #logo' ).css( 'margin-top', ( headerRowHeight - logoTextHeight ) / 2 );

});