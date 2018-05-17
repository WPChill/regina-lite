<?php

$custom_header = get_custom_header();

if ( ! isset( $custom_header->url ) || '' == $custom_header->url ) {
	return;
}

$url = $custom_header->url;

// get image meta by ID
$image_alt = get_bloginfo( 'name' );
if ( isset( $custom_header->attachment_i ) ) {
	$image_meta = get_post_meta( $custom_header->attachment_id );
	$image_alt  = $image_meta['_wp_attachment_image_alt']['0'];
}

?>

<div id="home-slider" class="clear">
	<ul class="clear">
		<li>
			<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
		</li>
	</ul>
	<div class="clear"></div>
</div><!--/#home-slider.clear-->
