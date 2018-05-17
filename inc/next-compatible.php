<?php
/**
 *  Next compatible functionality: over 4.4.2
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4.2', '>' ) ) {

	/*
	 * Custom Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'height'      => 80,
			'flex-width'  => true,
			'header-text' => false,
		)
	);

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

	// Check for old widgets
	$widgets_updated = get_option( 'regina-widgets-removed', false );
	if ( ! $widgets_updated ) {

		$all_sidebars = get_option( 'sidebars_widgets' );

		$contact_widget = get_option( 'widget_regina_lite_contact' );
		$address_widget = get_option( 'widget_regina_lite_address' );

		if ( ! empty( $contact_widget ) && ! empty( $address_widget ) ) {

			$text_widgets = get_option( 'widget_text' );
			if ( isset( $text_widgets['_multiwidget'] ) ) {
				$aux = $text_widgets;
				unset( $aux['_multiwidget'] );
				$keys = array_keys( $aux );
			} else {
				$keys = array_keys( $text_widgets );
			}

			$text_widget_index = intval( end( $keys ) ) + 1;

			foreach ( $all_sidebars as $sidebar_key => $sidebar ) {
				if ( is_array( $sidebar ) ) {
					foreach ( $sidebar as $widget_key => $widget ) {
						if ( strpos( $widget, 'regina_lite_contact' ) !== false ) {

							$args           = array(
								'title'  => '',
								'text'   => '',
								'filter' => 1,
								'visual' => 1,
							);
							$current_index  = str_replace( 'regina_lite_contact-', '', $widget );
							$current_widget = $contact_widget[ $current_index ];

							// print_r( $current_widget );

							if ( isset( $current_widget['title'] ) ) {
								$args['title'] = $current_widget['title'];
							}

							if ( isset( $current_widget['phone'] ) && '' != $current_widget['phone'] ) {
								$args['text'] .= '<p><span class="nc-icon-glyph tech_mobile-button white"></span>&nbsp;&nbsp; ' . $current_widget['phone'] . '</p>';
							}

							if ( isset( $current_widget['email'] ) && '' != $current_widget['email'] ) {
								$args['text'] .= '<p><span class="nc-icon-glyph ui-1_email-83 white"></span>&nbsp;&nbsp; <a href="mailto:' . $current_widget['email'] . '" title="contact@mediplus.com">' . $current_widget['email'] . '</a></p>';
							}

							$social_html = '';
							if ( isset( $current_widget['facebook_link'] ) && '' != $current_widget['facebook_link'] ) {
								$social_html .= '<li><a href="' . $current_widget['facebook_link'] . '" title="Facebook" target="_blank"><span class="nc-icon-glyph socials-1_logo-facebook"></span></a></li>';
							}

							if ( isset( $current_widget['twitter_link'] ) && '' != $current_widget['twitter_link'] ) {
								$social_html .= '<li><a href="' . $current_widget['twitter_link'] . '" title="Twitter" target="_blank"><span class="nc-icon-glyph socials-1_logo-twitter"></span></a></li>';
							}

							if ( isset( $current_widget['linkedin_link'] ) && '' != $current_widget['linkedin_link'] ) {
								$social_html .= '<li><a href="' . $current_widget['linkedin_link'] . '" title="LinkedIn" target="_blank"><span class="nc-icon-glyph socials-1_logo-linkedin"></span></a></li>';
							}

							if ( isset( $current_widget['youtube_link'] ) && '' != $current_widget['youtube_link'] ) {
								$social_html .= '<li><a href="' . $current_widget['youtube_link'] . '" title="YouTube" target="_blank"><span class="nc-icon-glyph socials-1_logo-youtube"></span></a></li>';
							}

							if ( isset( $current_widget['instagram_link'] ) && '' != $current_widget['instagram_link'] ) {
								$social_html .= '<li><a href="' . $current_widget['instagram_link'] . '" title="Instagram" target="_blank"><span class="nc-icon-glyph socials-1_logo-instagram"></span></a></li>';
							}

							if ( '' != $social_html ) {
								$args['text'] .= '<ul class="social-link-list">' . $social_html . '</ul>';
							}

							$text_widgets[ $text_widget_index ]          = $args;
							$all_sidebars[ $sidebar_key ][ $widget_key ] = 'text-' . $text_widget_index;
							$text_widget_index++;

						} elseif ( strpos( $widget, 'regina_lite_address' ) !== false ) {

							$args           = array(
								'title'  => '',
								'text'   => '',
								'filter' => 1,
								'visual' => 1,
							);
							$current_index  = str_replace( 'regina_lite_address-', '', $widget );
							$current_widget = $address_widget[ $current_index ];

							if ( isset( $current_widget['title'] ) ) {
								$args['title'] = $current_widget['title'];
							}

							if ( isset( $current_widget['address'] ) ) {
								$args['text'] = $current_widget['address'];
							}

							$text_widgets[ $text_widget_index ]          = $args;
							$all_sidebars[ $sidebar_key ][ $widget_key ] = 'text-' . $text_widget_index;
							$text_widget_index++;
						}
					}
				}
			}

			// Update sidebar
			update_option( 'sidebars_widgets', $all_sidebars );
			update_option( 'widget_text', $text_widgets );
			delete_option( 'widget_regina_lite_contact' );
			delete_option( 'widget_regina_lite_address' );
			update_option( 'regina-widgets-removed', 1 );

		}
	}
}// End if().
