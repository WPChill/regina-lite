<?php

class Regina_Lite_Helper {

	public static $regina_settings;
	public static $regina_fields = array(
		'regina_lite_subheader_features_show',
		'regina_lite_features_general_title',
		'regina_lite_features_general_description',
		'regina_lite_features_general_button_text',
		'regina_lite_features_general_button_url',
		'regina_lite_features_feature1_title',
		'regina_lite_features_feature1_description',
		'regina_lite_features_feature1_buttonurl',
		'regina_lite_features_feature2_title',
		'regina_lite_features_feature2_description',
		'regina_lite_features_feature2_buttonurl',
		'regina_lite_features_feature3_title',
		'regina_lite_features_feature3_description',
		'regina_lite_features_feature3_buttonurl',
		'regina_lite_features_feature4_title',
		'regina_lite_features_feature4_description',
		'regina_lite_features_feature4_buttonurl',
		'regina_lite_ourteam_general_show',
		'regina_lite_ourteam_general_title',
		'regina_lite_ourteam_general_description',
		'regina_lite_ourteam_teammember1_image',
		'regina_lite_ourteam_teammember1_name',
		'regina_lite_ourteam_teammember1_description',
		'regina_lite_ourteam_teammember1_position',
		'regina_lite_ourteam_teammember1_buttonurl',
		'regina_lite_ourteam_teammember2_image',
		'regina_lite_ourteam_teammember2_name',
		'regina_lite_ourteam_teammember2_description',
		'regina_lite_ourteam_teammember2_position',
		'regina_lite_ourteam_teammember2_buttonurl',
		'regina_lite_ourteam_teammember3_image',
		'regina_lite_ourteam_teammember3_name',
		'regina_lite_ourteam_teammember3_description',
		'regina_lite_ourteam_teammember3_position',
		'regina_lite_ourteam_teammember3_buttonurl',
		'regina_lite_ourteam_teammember4_image',
		'regina_lite_ourteam_teammember4_name',
		'regina_lite_ourteam_teammember4_description',
		'regina_lite_ourteam_teammember4_position',
		'regina_lite_ourteam_teammember4_buttonurl',
		'regina_lite_testimonials_general_show',
		'regina_lite_testimonials_general_image1',
		'regina_lite_testimonials_general_image2',
		'regina_lite_testimonials_general_image3',
		'regina_lite_testimonials_general_image4',
		'regina_lite_testimonials_testimonial1_description',
		'regina_lite_testimonials_testimonial1_image',
		'regina_lite_testimonials_testimonial1_name',
		'regina_lite_testimonials_testimonial1_position',
		'regina_lite_testimonials_testimonial2_description',
		'regina_lite_testimonials_testimonial2_image',
		'regina_lite_testimonials_testimonial2_name',
		'regina_lite_testimonials_testimonial2_position',
		'regina_lite_testimonials_testimonial3_description',
		'regina_lite_testimonials_testimonial3_image',
		'regina_lite_testimonials_testimonial3_name',
		'regina_lite_testimonials_testimonial3_position',
		'regina_lite_testimonials_testimonial4_description',
		'regina_lite_testimonials_testimonial4_image',
		'regina_lite_testimonials_testimonial4_name',
		'regina_lite_testimonials_testimonial4_position',
		'regina_lite_testimonials_testimonial5_description',
		'regina_lite_testimonials_testimonial5_image',
		'regina_lite_testimonials_testimonial5_name',
		'regina_lite_testimonials_testimonial5_position',
		'regina_lite_speak_general_show',
		'regina_lite_speak_general_title',
		'regina_lite_speak_general_description',
		'regina_lite_speak_general_buttonurl',
	);


	public static function parse_regina_settings() {

		$regina_settings = get_post_meta( Regina_Lite_Helper::get_setting_page_id(), 'regina-settings', true );

		if ( is_array( $regina_settings ) ) {
			return $regina_settings;
		}
		return array();

	}

	public static function get_regina_setting( $setting, $default = false ) {

		if ( in_array( $setting, Regina_Lite_Helper::$regina_fields ) ) {
			$regina_settings = Regina_Lite_Helper::parse_regina_settings();
			if ( isset( $regina_settings[ $setting ] ) ) {
				return $regina_settings[ $setting ];
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	// static method in order to get settings from page
	// use $arguments[0] if value doesn't exist.
	public static function __callStatic( $name, $arguments ) {

		$settings_id   = str_replace( '_get_', '', $name );
		$setting_value = Regina_Lite_Helper::get_regina_setting( $settings_id );

		if ( false === $setting_value ) {
			return $arguments[0];
		} else {
			return $setting_value;
		}

	}

	public static function create_content_from_options() {

		$data = get_post_meta( Regina_Lite_Helper::get_setting_page_id(), 'regina-settings', true );

		$sections = array(
			array(
				'title'  => __( 'Services Section', 'regina-lite' ),
				'fields' => array(
					'regina_lite_subheader_features_show' => __( 'Sho/Hide Services Section', 'regina-lite' ),
					'regina_lite_features_general_title'  => __( 'Section Title', 'regina-lite' ),
					'regina_lite_features_general_description' => __( 'Section Description', 'regina-lite' ),
					'regina_lite_features_general_button_text' => __( 'Section Button Text', 'regina-lite' ),
					'regina_lite_features_general_button_url' => __( 'Section Button URL', 'regina-lite' ),
					'regina_lite_features_feature1_title' => __( 'Service 1 Title', 'regina-lite' ),
					'regina_lite_features_feature1_description' => __( 'Service 1 Description', 'regina-lite' ),
					'regina_lite_features_feature1_buttonurl' => __( 'Service 1 Button URL', 'regina-lite' ),
					'regina_lite_features_feature2_title' => __( 'Service 2 Title', 'regina-lite' ),
					'regina_lite_features_feature2_description' => __( 'Service 2 Description', 'regina-lite' ),
					'regina_lite_features_feature2_buttonurl' => __( 'Service 2 Button URL', 'regina-lite' ),
					'regina_lite_features_feature3_title' => __( 'Service 3 Title', 'regina-lite' ),
					'regina_lite_features_feature3_description' => __( 'Service 3 Description', 'regina-lite' ),
					'regina_lite_features_feature3_buttonurl' => __( 'Service 3 Button URL', 'regina-lite' ),
					'regina_lite_features_feature4_title' => __( 'Service 4 Title', 'regina-lite' ),
					'regina_lite_features_feature4_description' => __( 'Service 4 Description', 'regina-lite' ),
					'regina_lite_features_feature4_buttonurl' => __( 'Service 4 Button URL', 'regina-lite' ),
				),
			),
			array(
				'title'  => __( 'Our Team Section', 'regina-lite' ),
				'fields' => array(
					'regina_lite_ourteam_general_show'     => __( 'Sho/Hide Section', 'regina-lite' ),
					'regina_lite_ourteam_general_title'    => __( 'Section Title', 'regina-lite' ),
					'regina_lite_ourteam_general_description' => __( 'Section Description', 'regina-lite' ),
					'regina_lite_ourteam_teammember1_image' => __( 'Member 1 Image', 'regina-lite' ),
					'regina_lite_ourteam_teammember1_name' => __( 'Member 1 Name', 'regina-lite' ),
					'regina_lite_ourteam_teammember1_description' => __( 'Member 1 Description', 'regina-lite' ),
					'regina_lite_ourteam_teammember1_buttonurl' => __( 'Member 1 Button URL', 'regina-lite' ),
					'regina_lite_ourteam_teammember2_image' => __( 'Member 2 Image', 'regina-lite' ),
					'regina_lite_ourteam_teammember2_name' => __( 'Member 2 Name', 'regina-lite' ),
					'regina_lite_ourteam_teammember2_description' => __( 'Member 2 Description', 'regina-lite' ),
					'regina_lite_ourteam_teammember2_buttonurl' => __( 'Member 2 Button URL', 'regina-lite' ),
					'regina_lite_ourteam_teammember3_image' => __( 'Member 3 Image', 'regina-lite' ),
					'regina_lite_ourteam_teammember3_name' => __( 'Member 3 Name', 'regina-lite' ),
					'regina_lite_ourteam_teammember3_description' => __( 'Member 3 Description', 'regina-lite' ),
					'regina_lite_ourteam_teammember3_buttonurl' => __( 'Member 3 Button URL', 'regina-lite' ),
					'regina_lite_ourteam_teammember4_image' => __( 'Member 4 Image', 'regina-lite' ),
					'regina_lite_ourteam_teammember4_name' => __( 'Member 4 Name', 'regina-lite' ),
					'regina_lite_ourteam_teammember4_description' => __( 'Member 4 Description', 'regina-lite' ),
					'regina_lite_ourteam_teammember4_buttonurl' => __( 'Member 4 Button URL', 'regina-lite' ),
				),
			),
			array(
				'title'  => __( 'Testimonials Section', 'regina-lite' ),
				'fields' => array(
					'regina_lite_testimonials_general_show' => __( 'Sho/Hide Section', 'regina-lite' ),
					'regina_lite_testimonials_general_image1' => __( 'Gallery Image 1', 'regina-lite' ),
					'regina_lite_testimonials_general_image2' => __( 'Gallery Image 2', 'regina-lite' ),
					'regina_lite_testimonials_general_image3' => __( 'Gallery Image 3', 'regina-lite' ),
					'regina_lite_testimonials_general_image4' => __( 'Gallery Image 4', 'regina-lite' ),
					'regina_lite_testimonials_testimonial1_description' => __( 'Testimonial 1 Content', 'regina-lite' ),
					'regina_lite_testimonials_testimonial1_image' => __( 'Testimonial 1 Image', 'regina-lite' ),
					'regina_lite_testimonials_testimonial1_name' => __( 'Testimonial 1 Person Name', 'regina-lite' ),
					'regina_lite_testimonials_testimonial1_position' => __( 'Testimonial 1 Person Position', 'regina-lite' ),
					'regina_lite_testimonials_testimonial2_description' => __( 'Testimonial 2 Content', 'regina-lite' ),
					'regina_lite_testimonials_testimonial2_image' => __( 'Testimonial 2 Image', 'regina-lite' ),
					'regina_lite_testimonials_testimonial2_name' => __( 'Testimonial 2 Person Name', 'regina-lite' ),
					'regina_lite_testimonials_testimonial2_position' => __( 'Testimonial 2 Person Position', 'regina-lite' ),
					'regina_lite_testimonials_testimonial3_description' => __( 'Testimonial 3 Content', 'regina-lite' ),
					'regina_lite_testimonials_testimonial3_image' => __( 'Testimonial 3 Image', 'regina-lite' ),
					'regina_lite_testimonials_testimonial3_name' => __( 'Testimonial 3 Person Name', 'regina-lite' ),
					'regina_lite_testimonials_testimonial3_position' => __( 'Testimonial 3 Person Position', 'regina-lite' ),
					'regina_lite_testimonials_testimonial4_description' => __( 'Testimonial 4 Content', 'regina-lite' ),
					'regina_lite_testimonials_testimonial4_image' => __( 'Testimonial 4 Image', 'regina-lite' ),
					'regina_lite_testimonials_testimonial4_name' => __( 'Testimonial 4 Person Name', 'regina-lite' ),
					'regina_lite_testimonials_testimonial4_position' => __( 'Testimonial 4 Person Position', 'regina-lite' ),
					'regina_lite_testimonials_testimonial5_description' => __( 'Testimonial 5 Content', 'regina-lite' ),
					'regina_lite_testimonials_testimonial5_image' => __( 'Testimonial 5 Image', 'regina-lite' ),
					'regina_lite_testimonials_testimonial5_name' => __( 'Testimonial 5 Person Name', 'regina-lite' ),
					'regina_lite_testimonials_testimonial5_position' => __( 'Testimonial 5 Person Position', 'regina-lite' ),
				),
			),
			array(
				'title'  => __( 'Recent Works Section', 'regina-lite' ),
				'fields' => array(
					'regina_lite_speak_general_show'      => __( 'Sho/Hide Section', 'regina-lite' ),
					'regina_lite_speak_general_title'     => __( 'Section Title', 'regina-lite' ),
					'regina_lite_speak_general_description' => __( 'Section Description', 'regina-lite' ),
					'regina_lite_speak_general_buttonurl' => __( 'Section Button URL', 'regina-lite' ),
				),
			),
		);

		$content = '';
		foreach ( $sections as $section ) {
			$section_content = '';
			foreach ( $section['fields'] as $field_key => $field_name ) {
				if ( isset( $data[ $field_key ] ) && '' != $field_key ) {
					$section_content .= $field_name . ': ' . $data[ $field_key ] . '<br>';
				}
			}
			if ( '' != $section_content ) {
				if ( '' != $content ) {
					$content .= '<br>';
				}
				$content .= $section['title'] . '<br><br>';
				$content .= $section_content;
			}
		}

		if ( '' != $content ) {
			$regina_settings_page_args = array(
				'ID'           => Regina_Lite_Helper::get_setting_page_id(),
				'post_content' => $content,
			);
			wp_update_post( $regina_settings_page_args );
		}

	}

	public static function get_setting_page_id() {

		$page_id = get_option( 'regina-settings-id' );
		if ( $page_id ) {
			return $page_id;
		} else {

			$page_args = array(
				'post_title'  => 'Regina Settings',
				'post_status' => 'draft',
				'post_type'   => 'page',
				'post_author' => 0,
			);

			$page_id = wp_insert_post( $page_args );

			if ( ! is_wp_error( $page_id ) ) {
				update_option( 'regina-settings-id', $page_id );
				return $page_id;
			}
		}

	}

}

foreach ( Regina_Lite_Helper::$regina_fields as $regina_setting ) {
	add_filter( "customize_sanitize_js_{$regina_setting}", array( 'Regina_Lite_Helper', "_get_{$regina_setting}" ) );
	add_filter( "theme_mod_{$regina_setting}", array( 'Regina_Lite_Helper', "_get_{$regina_setting}" ) );
}

add_action( 'customize_save_after', array( 'Regina_Lite_Helper', 'create_content_from_options' ) );

add_action( 'add_meta_boxes', 'regina_remove_editor_for_regina_settings', 20, 2 );
function regina_remove_editor_for_regina_settings( $post_type, $post ) {

	if ( 'page' != $post_type ) {
		return;
	}

	$regina_page_id = get_option( 'regina-settings-id' );

	if ( $regina_page_id && $regina_page_id == $post->ID ) {
		add_action( 'edit_form_after_title', 'regina_setting_page_notice' );
		remove_post_type_support( $post_type, 'editor' );
	}

}

function regina_setting_page_notice() {
	echo '<div class="notice notice-warning inline"><p>' . __( 'You are currently editing the page that hold your theme settings. Please don\'t delete it', 'regina-lite' ) . '</p></div>';
}

add_filter( 'display_post_states', 'add_states_for_regina_settings_page', 10, 2 );
function add_states_for_regina_settings_page( $post_states, $post ) {

	if ( intval( get_option( 'regina-settings-id' ) ) === $post->ID ) {
		$post_states['regina_setting_page'] = __( 'Theme Settings Page. Don\'t delete it.', 'regina-lite' );
		unset( $post_states['draft'] );
	}

	return $post_states;

}

add_action( 'customize_update_epsilon_page', 'regina_lite_save_custom_setting', 10, 2 );
function regina_lite_save_custom_setting( $value, $setting ) {

	$existing_settings = Regina_Lite_Helper::parse_regina_settings();
	$key               = $setting->id;

	$existing_settings[ $key ] = $value;

	update_post_meta( Regina_Lite_Helper::get_setting_page_id(), 'regina-settings', $existing_settings );

	return true;

}
