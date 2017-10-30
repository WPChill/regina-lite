<?php
/**
 *  The template for displaying the Features on Home page.
 *
 * @package    WordPress
 * @subpackage regina-lite
 */
?>
<?php
// Get Theme Mod for Features Panel
$top_box_show                  = get_theme_mod( 'regina_lite_top_box_show', 1 );
$top_box_title                 = get_theme_mod( 'regina_lite_top_box_title' );
$top_box_description           = get_theme_mod( 'regina_lite_top_box_description' );
$top_box_bookappointmenturl    = get_theme_mod( 'regina_lite_top_box_bookappointmenturl' );
$features_general_title        = get_theme_mod( 'regina_lite_features_general_title' );
$features_general_description  = get_theme_mod( 'regina_lite_features_general_description' );
$features_general_button_text  = get_theme_mod( 'regina_lite_features_general_button_text' );
$features_general_button_url   = get_theme_mod( 'regina_lite_features_general_button_url' );
$features_feature1_title       = get_theme_mod( 'regina_lite_features_feature1_title' );
$features_feature1_description = get_theme_mod( 'regina_lite_features_feature1_description' );
$features_feature1_buttonurl   = get_theme_mod( 'regina_lite_features_feature1_buttonurl' );
$features_feature2_title       = get_theme_mod( 'regina_lite_features_feature2_title' );
$features_feature2_description = get_theme_mod( 'regina_lite_features_feature2_description' );
$features_feature2_buttonurl   = get_theme_mod( 'regina_lite_features_feature2_buttonurl' );
$features_feature3_title       = get_theme_mod( 'regina_lite_features_feature3_title' );
$features_feature3_description = get_theme_mod( 'regina_lite_features_feature3_description' );
$features_feature3_buttonurl   = get_theme_mod( 'regina_lite_features_feature3_buttonurl' );
$features_feature4_title       = get_theme_mod( 'regina_lite_features_feature4_title' );
$features_feature4_description = get_theme_mod( 'regina_lite_features_feature4_description' );
$features_feature4_buttonurl   = get_theme_mod( 'regina_lite_features_feature4_buttonurl' );
$book_appointment_button_label = get_theme_mod( 'regina_lite_book_appointment_button_label' );
?>
<div class="container">
	<div class="row">
		<?php if ( 1 == $top_box_show ) : ?>
			<div class="col-lg-8 col-md-12 col-lg-offset-2">
				<div id="call-out" class="clear">
					<?php if ( $top_box_title ) : ?>
						<h1><?php echo esc_html( $top_box_title ); ?></h1>
					<?php endif; ?>
					<?php if ( $top_box_description ) : ?>
						<div><?php echo wp_kses_post( $top_box_description ); ?></div>
					<?php endif; ?>
					<br />
					<?php if ( $top_box_bookappointmenturl ) : ?>
						<a href="<?php echo esc_url( $top_box_bookappointmenturl ); ?>" class="button white outline" title="<?php echo esc_attr( $book_appointment_button_label ); ?>"><?php echo esc_attr( $book_appointment_button_label ); ?>
							<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
					<?php endif; ?>
				</div><!--#call-out-->
			</div><!--.col-md-8-->
		<?php endif; ?>
		<div id="services-title-block" class="col-xs-12" style="
		<?php
		if ( 1 != $top_box_show ) :
			echo 'margin-top: 100px;';
endif;
?>
">
			<div class="section-info">
				<?php if ( $features_general_title ) : ?>
					<h2><?php echo esc_html( $features_general_title ); ?></h2>
					<hr>
				<?php endif; ?>
				<?php if ( $features_general_description ) : ?>
					<div><?php echo wp_kses_post( $features_general_description ); ?></div>
				<?php endif; ?>
			</div><!--.section-info-->
		</div><!--.col-xs-12-->
		<section id="services-block" class="home content-block">
			<div class="spacer-5x visible-sm visible-xs"></div>
			<div class="col-lg-3 col-sm-6 service-1">
				<div class="service">
					<div class="icon">
						<span class="nc-icon-outline health_heartbeat-16"></span>
					</div>
					<?php if ( $features_feature1_title ) : ?>
						<h3><?php echo esc_html( $features_feature1_title ); ?></h3>
					<?php endif; ?>
					<?php if ( $features_feature1_description ) : ?>
						<div><?php echo wp_kses_post( $features_feature1_description ); ?></div>
					<?php endif; ?>
					<br>
					<?php if ( $features_feature1_buttonurl ) : ?>
						<a href="<?php echo esc_url( $features_feature1_buttonurl ); ?>" class="link small"><?php _e( 'Read more', 'regina-lite' ); ?>
							<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
					<?php endif; ?>
				</div><!--.service-->
			</div><!--.col-lg-3-->
			<div class="col-lg-3 col-sm-6 service-2">
				<div class="service">
					<div class="icon">
						<span class="nc-icon-outline food_apple"></span>
					</div>
					<?php if ( $features_feature2_title ) : ?>
						<h3><?php echo esc_html( $features_feature2_title ); ?></h3>
					<?php endif; ?>
					<?php if ( $features_feature2_description ) : ?>
						<div><?php echo wp_kses_post( $features_feature2_description ); ?></div>
					<?php endif; ?>
					<br>
					<?php if ( $features_feature2_buttonurl ) : ?>
						<a href="<?php echo esc_url( $features_feature2_buttonurl ); ?>" class="link small"><?php _e( 'Read more', 'regina-lite' ); ?>
							<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
					<?php endif; ?>
				</div><!--.service-->
			</div><!--.col-lg-3-->
			<div class="col-lg-3 col-sm-6 service-3">
				<div class="service">
					<div class="icon">
						<span class="nc-icon-outline health_hospital-32"></span>
					</div>
					<?php if ( $features_feature3_title ) : ?>
						<h3><?php echo esc_html( $features_feature3_title ); ?></h3>
					<?php endif; ?>
					<?php if ( $features_feature3_description ) : ?>
						<div><?php echo wp_kses_post( $features_feature3_description ); ?></div>
					<?php endif; ?>
					<br>
					<?php if ( $features_feature3_buttonurl ) : ?>
						<a href="<?php echo esc_url( $features_feature3_buttonurl ); ?>" class="link small"><?php _e( 'Read more', 'regina-lite' ); ?>
							<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
					<?php endif; ?>
				</div><!--.service-->
			</div><!--.col-lg-3-->
			<div class="col-lg-3 col-sm-6 service-4">
				<div class="service">
					<div class="icon">
						<span class="nc-icon-outline health_brain"></span>
					</div>
					<?php if ( $features_feature4_title ) : ?>
						<h3><?php echo esc_html( $features_feature4_title ); ?></h3>
					<?php endif; ?>
					<?php if ( $features_feature4_description ) : ?>
						<div><?php echo wp_kses_post( $features_feature4_description ); ?></div>
					<?php endif; ?>
					<br>
					<?php if ( $features_feature4_buttonurl ) : ?>
						<a href="<?php echo esc_url( $features_feature4_buttonurl ); ?>" class="link small"><?php _e( 'Read more', 'regina-lite' ); ?>
							<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
					<?php endif; ?>
				</div><!--.service-->
			</div><!--.col-lg-3-->
			<?php if ( $features_general_button_text && $features_general_button_url ) : ?>
				<div class="col-xs-12 text-center">
					<a href="<?php echo esc_url( $features_general_button_url ); ?>" class="button dark outline" title="<?php echo esc_attr( $features_general_button_text ); ?>"><?php echo esc_html( $features_general_button_text ); ?>
						<span class="nc-icon-glyph arrows-1_bold-right"></span></a>
				</div>
			<?php endif; ?>
			<div class="clear"></div>
		</section><!--#services-block-->
	</div><!--.row-->
</div><!--.container-->
