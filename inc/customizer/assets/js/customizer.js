/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Sections highlight
	wp.customize.bind('preview-ready', function () {

		wp.customize.preview.bind( 'section-highlight', function( data ) {
			var selectors = {
				'regina_lite_hero_panel' : '#home-slider',
				'regina_lite_speak_general' : '#speak-with-our-doctors',
				'regina_lite_news_general' : '#section-news',
				'regina_lite_features_panel' : '#services-title-block',
				'regina_lite_ourteam_panel' : '#team-section-block',
				'regina_lite_testimonials_panel' : '#home-testimonials',
			};

			// Only on the front page.
			if ( ! $( selectors[ data.section ] ).length ) {
				return;
			}

			// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
			if ( true === data.expanded ) {
				$.scrollTo( $( selectors[ data.section ] ), {
					duration: 600,
				});
			}
		});

	});

} )( jQuery );
