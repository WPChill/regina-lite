<?php
/**
 *  Next compatible functionality: over 4.4.2
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4.2', '>' ) ) {

	/*
     * Custom Logo
     */
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'flex-width'  => true,
		'header-text' => false,
	) );

	// If a logo has been set previously, update to use logo feature introduced in WordPress 4.5
	if ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'regina_lite_img_logo', false ) ) {
		$logo = attachment_url_to_postid( get_theme_mod( 'regina_lite_img_logo', false ) );

		if ( is_int( $logo ) ) {
			set_theme_mod( 'custom_logo', $logo );
		}

		remove_theme_mod( 'regina_lite_img_logo' );
	}

	// Logo
	function regina_lite_custom_logo() {
		$img_logo  = get_theme_mod( 'regina_lite_img_logo' );
		$text_logo = get_theme_mod( 'regina_lite_text_logo', __( 'Regina Lite', 'regina-lite' ) );

		$output = '';

		if ( function_exists( 'has_custom_logo' ) ) {
			if ( has_custom_logo() ) {
				$output .= get_custom_logo();
			} else {
				$output .= '<a href="' . esc_url( get_site_url() ) . '" title="' . esc_attr( get_bloginfo( 'title' ) ) . '"><span class="logo-title">' . esc_html( $text_logo ) . '</span></a>';
			}
		} elseif ( $img_logo ) {
			$output .= '<a href="' . esc_url( get_site_url() ) . '" title="' . esc_attr( get_bloginfo( 'title' ) ) . '"><img src="' . esc_url( $img_logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" /></a>';
		} else {
			$output .= '<a href="' . esc_url( get_site_url() ) . '" title="' . esc_attr( get_bloginfo( 'title' ) ) . '"><span class="logo-title">' . esc_html( $text_logo ) . '</span></a>';
		}
		echo $output;
	}

	// Register Customizer
	add_action( 'customize_register', 'regina_lite_customize_register_442', 50 );
	function regina_lite_customize_register_442( $wp_customize ) {
		// Remove Setting
		$wp_customize->remove_setting( 'regina_lite_img_logo' );

		// Remove Control
		$wp_customize->remove_control( 'regina_lite_img_logo' );
	}
}// End if().
