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

	// (function() {
	// 	var morphSearch = $('#morphsearch'),
	// 		navSearch = document.getElementsByClassName( 'nav-search' ),
	// 		input = $('input.morphsearch-input'),
	// 		// ctrlClose = $('div.morphsearch-close'),
	// 		isOpen = isAnimating = false,
	// 		// show/hide search area
	// 		toggleSearch = function(evt) {
	// 			// return if open and the input gets focused
	// 			// if( evt.type.toLowerCase() === 'focus' && isOpen ) return false;

	// 			var offsets = morphsearch.getBoundingClientRect();
	// 			if( isOpen ) {
	// 				classie.remove( morphSearch, 'open' );

	// 				// trick to hide input text once the search overlay closes 
	// 				// todo: hardcoded times, should be done after transition ends
	// 				if( input.value !== '' ) {
	// 					setTimeout(function() {
	// 						classie.add( morphSearch, 'hideInput' );
	// 						setTimeout(function() {
	// 							classie.remove( morphSearch, 'hideInput' );
	// 							input.value = '';
	// 						}, 300 );
	// 					}, 500);
	// 				}
					
	// 				input.blur();
	// 			}
	// 			else {
	// 				classie.add( morphSearch, 'open' );
	// 			}
	// 			isOpen = !isOpen;
	// 		};

	// 	// events
	// 	// navSearch.addEventListener( 'click', toggleSearch );

	// 	$('.nav-search').click(function(){
	// 		toggleSearch();

	// 		return false;
	// 	});

	// 	$('.morphsearch-close').click(function(){
	// 		toggleSearch();

	// 		return false;
	// 	});

	// 	// ctrlClose.addEventListener( 'click', toggleSearch );
	// 	// esc key closes search overlay
	// 	// keyboard navigation events
	// 	document.addEventListener( 'keydown', function( ev ) {
	// 		var keyCode = ev.keyCode || ev.which;
	// 		if( keyCode === 27 && isOpen ) {
	// 			toggleSearch(ev);
	// 		}
	// 	} );


	// 	/***** for demo purposes only: don't allow to submit the form *****/
	// 	// morphSearch.querySelector( 'button[type="submit"]' ).addEventListener( 'click', function(ev) { ev.preventDefault(); } );
	// })();


	/* ---------------------------------------------------------------------- */
	/*  Sliders
	/* ---------------------------------------------------------------------- */
	if( typeof bxSlider !== 'undefined' && $.isFunction(bxSlider) ) {
		$('#home-slider .bxslider').bxSlider({
			mode:'fade',
			nextText: '<span class="nc-icon-glyph arrows-1_bold-down"></span>',
			prevText: '<span class="nc-icon-glyph arrows-1_bold-up"></span>'
		});

		$('#home-slider .bx-wrapper .bx-controls').css({'margin-top' : '-' + ($('#home-slider .bx-wrapper .bx-controls').outerHeight() / 2) + 'px'});

		$('#testimonials-slider .bxslider').bxSlider({
			mode:'fade',		
			nextText: '<span class="nc-icon-glyph arrows-1_bold-right"></span>',
			prevText: '<span class="nc-icon-glyph arrows-1_bold-left"></span>'
	});
	}


	/* ---------------------------------------------------------------------- */
	/*  Back to Top & Waypoint
	/* ---------------------------------------------------------------------- */

	if( typeof bxSlider !== 'undefined' && $.isFunction(bxSlider) ) {
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
	}


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