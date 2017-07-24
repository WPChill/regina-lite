<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package regina-lite
 */
?>
<article class="post">
	<h2 class="title"><?php _e( 'Nothing Found', 'regina-lite' ); ?></h2>
	<div class="body">
		<p><?php printf( wp_kses_post( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'regina-lite' ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	</div>
</article><!--.post-->
