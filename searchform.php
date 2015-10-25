<?php
/**
 *	The template for displaying the Search Form.
 *
 *	@package regina-lite
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<input type="text" class="search-field" placeholder="<?php _e( 'Search', 'regina-lite' ); ?>" value="<?php echo get_search_query() ?>" name="s" title="<php _e( 'Search for:', 'regina-lite' ); ?>" />
	</label>
	<button class="search-btn" type="submit"><span class="nc-icon-outline ui-1_zoom"></span></button>
</form>
<form role="search" method="get" id="morphsearch" class="morphsearch" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" placeholder="<?php _e( 'Search', 'regina-lite' ); ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php _e( 'Search for ', 'regina-lite' ); ?>" />
    <div class="morphsearch-close"><span class="nc-icon-glyph ui-1_bold-remove"></span></div>
</form>