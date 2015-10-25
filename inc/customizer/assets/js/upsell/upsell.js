/**
 * Upsell notice for theme
 */
 
( function( $ ) {


	// Add Upgrade Message
	if ('undefined' !== typeof prefixL10n) {
		upsell = $('<a class="upsell-link"></a>')
			.attr('href', prefixL10n.prefixURL)
			.attr('target', '_blank')
			.text(prefixL10n.prefixLabel)
		;

        upsellBanner = $('<a class="upsell-banner")</a>')
            .attr('href', prefixL10n.prefixURL)
            .attr('target', '_blank')
            .html('<img src=' + prefixL10n.prefixImageURL + '>')
        ;

 
		setTimeout(function () {
			$('#customize-header-actions').prepend(upsell);
            $('#accordion-section-themes').append(upsellBanner);
		}, 200);
 
		// Remove accordion click event
		$('.upsell-link, .upsell-banner').on('click', function(e) {
			e.stopPropagation();
		});
	}
 
} )( jQuery );