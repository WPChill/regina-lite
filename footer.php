<?php

	$check_footer_theme_copyright_enable = get_theme_mod( 'regina_lite_footer_theme_copyright_enable', 1 );
	$text_footer_theme_copyright_message = get_theme_mod( 'regina_lite_footer_copyright', esc_html__( '&copy; Copyright 2016. All Rights Reserved.', 'regina-lite' ) )

?>
<footer id="footer">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
				</div><!--.col-sm-3-->
			<?php } ?>

			<?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
				</div><!--.col-sm-3-->
			<?php } ?>

			<?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
				</div><!--.col-lg-3-->
			<?php } ?>

			<?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) { ?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
				</div><!--.col-lg-3-->
			<?php } ?>

			<a href="#" class="back-to-top"><span class="nc-icon-glyph arrows-1_bold-up"></span></a>
		</div><!--.row-->
	</div><!--.container-->
</footer><!--#footer-->

<footer id="sub-footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<?php
				if ( 1 == $check_footer_theme_copyright_enable ) {
					echo sprintf( 'Theme: <a href="%s" target="_blank" rel="nofollow" title="Regina Lite">Regina Lite</a>', esc_url( 'http://www.machothemes.com/themes/regina-lite/' ) ) . ' &middot; ';
					echo 'Built by: Macho Themes ';
				}
				if ( $text_footer_theme_copyright_message ) {
					echo '<span class="copyright">' . $text_footer_theme_copyright_message . '</span>';
				}
				?>
			</div>
		</div><!--.row-->
	</div><!--.container-->
</footer><!--#sub-footer-->
<?php wp_footer(); ?>
</body>
</html>
