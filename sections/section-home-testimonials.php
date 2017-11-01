<?php
/**
 *  The template for dispalying the Testimonials on Home page.
 *
 * @package    WordPress
 * @subpackage regina-lite
 */
?>
<?php
// Get Theme Mod for Testimonials Panel
$testimonials_general_image1           = get_theme_mod( 'regina_lite_testimonials_general_image1' );
$testimonials_general_image2           = get_theme_mod( 'regina_lite_testimonials_general_image2' );
$testimonials_general_image3           = get_theme_mod( 'regina_lite_testimonials_general_image3' );
$testimonials_general_image4           = get_theme_mod( 'regina_lite_testimonials_general_image4' );
$testimonials_testimonial1_description = get_theme_mod( 'regina_lite_testimonials_testimonial1_description' );
$testimonials_testimonial1_image       = get_theme_mod( 'regina_lite_testimonials_testimonial1_image' );
$testimonials_testimonial1_name        = get_theme_mod( 'regina_lite_testimonials_testimonial1_name' );
$testimonials_testimonial1_position    = get_theme_mod( 'regina_lite_testimonials_testimonial1_position' );
$testimonials_testimonial2_description = get_theme_mod( 'regina_lite_testimonials_testimonial2_description' );
$testimonials_testimonial2_image       = get_theme_mod( 'regina_lite_testimonials_testimonial2_image' );
$testimonials_testimonial2_name        = get_theme_mod( 'regina_lite_testimonials_testimonial2_name' );
$testimonials_testimonial2_position    = get_theme_mod( 'regina_lite_testimonials_testimonial2_position' );
$testimonials_testimonial3_description = get_theme_mod( 'regina_lite_testimonials_testimonial3_description' );
$testimonials_testimonial3_image       = get_theme_mod( 'regina_lite_testimonials_testimonial3_image' );
$testimonials_testimonial3_name        = get_theme_mod( 'regina_lite_testimonials_testimonial3_name' );
$testimonials_testimonial3_position    = get_theme_mod( 'regina_lite_testimonials_testimonial3_position' );
$testimonials_testimonial4_description = get_theme_mod( 'regina_lite_testimonials_testimonial4_description' );
$testimonials_testimonial4_image       = get_theme_mod( 'regina_lite_testimonials_testimonial4_image' );
$testimonials_testimonial4_name        = get_theme_mod( 'regina_lite_testimonials_testimonial4_name' );
$testimonials_testimonial4_position    = get_theme_mod( 'regina_lite_testimonials_testimonial4_position' );
$testimonials_testimonial5_description = get_theme_mod( 'regina_lite_testimonials_testimonial5_description' );
$testimonials_testimonial5_image       = get_theme_mod( 'regina_lite_testimonials_testimonial5_image' );
$testimonials_testimonial5_name        = get_theme_mod( 'regina_lite_testimonials_testimonial5_name' );
$testimonials_testimonial5_position    = get_theme_mod( 'regina_lite_testimonials_testimonial5_position' );

$image_id_1 = regina_lite_get_attachment_id( $testimonials_testimonial1_image );
// get image meta by ID
$image_alt_1 = get_post_meta( $image_id_1, '_wp_attachment_image_alt', true );

$image_id_2 = regina_lite_get_attachment_id( $testimonials_testimonial2_image );
// get image meta by ID
$image_alt_2 = get_post_meta( $image_id_2, '_wp_attachment_image_alt', true );

$image_id_3 = regina_lite_get_attachment_id( $testimonials_testimonial3_image );
// get image meta by ID
$image_alt_3 = get_post_meta( $image_id_3, '_wp_attachment_image_alt', true );

$image_id_4 = regina_lite_get_attachment_id( $testimonials_testimonial4_image );
// get image meta by ID
$image_alt_4 = get_post_meta( $image_id_4, '_wp_attachment_image_alt', true );

$image_id_general_1 = regina_lite_get_attachment_id( $testimonials_general_image1 );
// get image meta by ID
$image_alt_general_1 = get_post_meta( $image_id_general_1, '_wp_attachment_image_alt', true );

$image_id_general_2 = regina_lite_get_attachment_id( $testimonials_general_image2 );
// get image meta by ID
$image_alt_general_2 = get_post_meta( $image_id_general_2, '_wp_attachment_image_alt', true );

$image_id_general_3 = regina_lite_get_attachment_id( $testimonials_general_image3 );
// get image meta by ID
$image_alt_general_3 = get_post_meta( $image_id_general_3, '_wp_attachment_image_alt', true );

$image_id_general_4 = regina_lite_get_attachment_id( $testimonials_general_image4 );
// get image meta by ID
$image_alt_general_4 = get_post_meta( $image_id_general_4, '_wp_attachment_image_alt', true );


?>
<section id="home-testimonials">
	<div class="testimonials">
		<span class="icon nc-icon-glyph ui-2_chat-round-content"></span>
		<div id="testimonials-slider">
			<ul class="bxslider">
				<?php if ( $testimonials_testimonial1_description || $testimonials_testimonial1_image || $testimonials_testimonial1_name || $testimonials_testimonial1_position ) : ?>
					<li class="testimonial-1">
						<?php if ( $testimonials_testimonial1_description ) : ?>
							<div class="quote"><?php echo wp_kses_post( $testimonials_testimonial1_description ); ?></div>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial1_image ) : ?>
							<img src="<?php echo esc_url( $testimonials_testimonial1_image ); ?>" alt="<?php echo esc_attr( $image_alt_1 ); ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial1_name ) : ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial1_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial1_position ) : ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial1_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( $testimonials_testimonial2_description || $testimonials_testimonial2_image || $testimonials_testimonial2_name || $testimonials_testimonial2_position ) : ?>
					<li class="testimonial-2">
						<?php if ( $testimonials_testimonial2_description ) : ?>
							<div class="quote"><?php echo wp_kses_post( $testimonials_testimonial2_description ); ?></div>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial2_image ) : ?>
							<img src="<?php echo esc_url( $testimonials_testimonial2_image ); ?>" alt="<?php echo esc_attr( $image_alt_2 ); ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial2_name ) : ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial2_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial2_position ) : ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial2_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( $testimonials_testimonial3_description || $testimonials_testimonial3_image || $testimonials_testimonial3_name || $testimonials_testimonial3_position ) : ?>
					<li class="testimonial-3">
						<?php if ( $testimonials_testimonial3_description ) : ?>
							<div class="quote"><?php echo wp_kses_post( $testimonials_testimonial3_description ); ?></div>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial3_image ) : ?>
							<img src="<?php echo esc_url( $testimonials_testimonial3_image ); ?>" alt="<?php echo esc_attr( $image_alt_3 ); ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial3_name ) : ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial3_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial3_position ) : ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial3_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( $testimonials_testimonial4_description || $testimonials_testimonial4_image || $testimonials_testimonial4_name || $testimonials_testimonial4_position ) : ?>
					<li class="testimonial-4">
						<?php if ( $testimonials_testimonial4_description ) : ?>
							<div class="quote"><?php echo wp_kses_post( $testimonials_testimonial4_description ); ?></div>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial4_image ) : ?>
							<img src="<?php echo esc_url( $testimonials_testimonial4_image ); ?>" alt="<?php echo esc_attr( $image_alt_4 ); ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial4_name ) : ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial4_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial4_position ) : ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial4_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( $testimonials_testimonial5_description || $testimonials_testimonial5_image || $testimonials_testimonial5_name || $testimonials_testimonial5_position ) : ?>
					<li class="testimonial-5">
						<?php if ( $testimonials_testimonial5_description ) : ?>
							<div class="quote"><?php echo wp_kses_post( $testimonials_testimonial5_description ); ?></div>
						<?php endif; ?>
						<?php if ( $testimonials_testimonial5_image ) : ?>
							<img src="<?php echo esc_url( $testimonials_testimonial5_image ); ?>" alt="<?php echo esc_attr( $image_alt_4 ); ?>" width="90">
						<?php endif; ?>
						<?php if ( $testimonials_testimonial5_name ) : ?>
							<h5 class="name"><?php echo esc_html( $testimonials_testimonial5_name ); ?></h5>
						<?php endif ?>
						<?php if ( $testimonials_testimonial5_position ) : ?>
							<p class="position"><?php echo esc_html( $testimonials_testimonial5_position ); ?></p>
						<?php endif; ?>
					</li>
				<?php endif; ?>
			</ul>
		</div><!--#testimonials-slider-->
	</div><!--.testimonials-->
	<ul class="images">
		<?php if ( $testimonials_general_image1 ) : ?>
			<li class="testimonial-image-1">
				<img src="<?php echo esc_url( $testimonials_general_image1 ); ?>" data-original="<?php echo esc_url( $testimonials_general_image1 ); ?>" alt="<?php echo esc_attr( $image_alt_general_1 ); ?>" class="lazy">
			</li>
		<?php endif; ?>
		<?php if ( $testimonials_general_image2 ) : ?>
			<li class="testimonial-image-2">
				<img src="<?php echo esc_url( $testimonials_general_image2 ); ?>" data-original="<?php echo esc_url( $testimonials_general_image2 ); ?>" alt="<?php echo esc_attr( $image_alt_general_2 ); ?>" class="lazy">
			</li>
		<?php endif; ?>
		<?php if ( $testimonials_general_image3 ) : ?>
			<li class="testimonial-image-3">
				<img src="<?php echo esc_url( $testimonials_general_image3 ); ?>" data-original="<?php echo esc_url( $testimonials_general_image3 ); ?>" alt="<?php echo esc_attr( $image_alt_general_3 ); ?>" class="lazy">
			</li>
		<?php endif; ?>
		<?php if ( $testimonials_general_image4 ) : ?>
			<li class="testimonial-image-4">
				<img src="<?php echo esc_url( $testimonials_general_image4 ); ?>" data-original="<?php echo esc_url( $testimonials_general_image4 ); ?>" alt="<?php echo esc_attr( $image_alt_general_4 ); ?>" class="lazy">
			</li>
		<?php endif; ?>
	</ul>
	<div class="clear"></div>
</section><!--#home-testimonials-->
