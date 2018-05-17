<?php
/**
 * Epsilon Import Data Class
 *
 * @package MedZone
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Epsilon_Import_Data
 */
class Epsilon_Import_Data {
	/**
	 * Array of plugins to register
	 *
	 * @var array
	 */
	public $plugins;

	public $import_options = array();

	/**
	 * Array of widgets index for when we will insert widgets
	 *
	 * @var array
	 */
	public $widgets = array();

	/**
	 * Epsilon_Import_Data constructor.
	 *
	 * @param array $args
	 */
	public function __construct( $args = array() ) {
		$this->plugins = array();
		$this->handle_json();
	}

	/**
	 * @param array $args
	 *
	 * @return Epsilon_Import_Data
	 */
	public static function get_instance( $args = array() ) {
		static $inst;
		if ( ! $inst ) {
			$inst = new Epsilon_Import_Data( $args );
		}

		return $inst;
	}

	/**
	 * Get the JSON, Parse IT and figure out content
	 *
	 * @param string $path
	 *
	 * @return bool|array|mixed
	 */
	public function handle_json( $path = '' ) {
		if ( empty( $path ) ) {
			$path = dirname( dirname( __FILE__ ) ) . '/data/demo.json';
		}

		if ( ! file_exists( $path ) ) {
			return false;
		}

		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		$json = $wp_filesystem->get_contents( $path );
		$json = json_decode( $json, true );

		/**
		 * In case the json could not be decoded, we return a new stdClass
		 */
		if ( null === $json ) {
			return false;
		}

		$this->import_options = $json;
	}

	/**
	 * Build the HTML Container
	 */
	public function generate_import_data_container() {
		$html  = '<p><a class="button button-primary epsilon-ajax-button" id="add_default_sections" href="#">' . __( 'Click me to start the set-up process!', 'epsilon-framework' ) . '</a>';
		$html .= '<a class="button epsilon-hidden-content-toggler" href="#" data-toggle="welcome-hidden-content">' . __( 'Advanced', 'epsilon-framework' ) . '</a></p>';
		$html .= '<div class="import-content-container" id="welcome-hidden-content">';

		$plugins_html = '';
		foreach ( $this->plugins as $slug => $name ) {
			if ( ! Bonkers_Helper::has_plugin( $slug ) ) {
				$plugins_html .= $this->generate_checkbox( $slug, 'plugins', $name );
			}
		}

		if ( '' != $plugins_html ) {
			$html .= '<div class="checkbox-group">';
			$html .= '<h4>' . __( 'Plugins', 'epsilon-framework' ) . '</h4>';
			$html .= $plugins_html;
			$html .= '</div>';
		}

		foreach ( $this->import_options as $section_id => $section ) {
			$html .= '<div class="checkbox-group">';
			$html .= '<h4>' . $section['title'] . '</h4>';
			foreach ( $section['options'] as $option ) {
				$html .= $this->generate_checkbox( $option['action'], 'regina_options', $option['title'] );
			}
			$html .= '</div>';
		}

		$html .= '</div>';

		return $html;
	}

	/**
	 * Generate HTML for a checkbox
	 *
	 * @param $id
	 * @param index
	 * @param $label
	 *
	 * @return string
	 */
	private function generate_checkbox( $id, $index, $label ) {
		$string = '<label><input checked data-slug="%1$s" type="checkbox" class="demo-checkboxes" value="%1$s" name="%2$s"/>%3$s</label>';

		return sprintf( $string, $id, $index, $label );
	}

	/**
	 * Check if we have a static page and if not add one
	 */
	public function set_frontpage() {
		$home = get_page_by_title( 'Homepage' );
		$blog = get_page_by_title( 'Blog' );

		if ( null === $home ) {
			$id = wp_insert_post(
				array(
					'post_title'  => __( 'Homepage', 'epsilon-framework' ),
					'post_type'   => 'page',
					'post_status' => 'publish',
				)
			);

			update_post_meta( $id, '_wp_page_template', 'page-templates/template-homepage.php' );

			update_option( 'page_on_front', $id );
			update_option( 'show_on_front', 'page' );
		} else {
			update_option( 'page_on_front', $home->ID );
			update_option( 'show_on_front', 'page' );
		}

		if ( null === $blog ) {
			$id = wp_insert_post(
				array(
					'post_title'  => __( 'Blog', 'epsilon-framework' ),
					'post_type'   => 'page',
					'post_status' => 'publish',
				)
			);

			update_option( 'page_for_posts', $id );
		} else {
			update_option( 'page_for_posts', $blog->ID );
		}

	}

	/**
	 * Handle import
	 *
	 * @param string $args JSON String
	 *
	 * @return string
	 *
	 * @todo receive "argument" with methods name
	 */
	public static function import_theme_content( $args = '' ) {
		$arr      = array();
		$instance = self::get_instance();

		foreach ( $args as $action ) {
			if ( method_exists( $instance, $action ) ) {
				$instance->{$action}();
			}
		}

		// update_option( 'regina_lite_import_content', 1 );

		return 'ok';
	}

	/**
	 * Add widgets to a certain sidebar
	 *
	 * @param $sidebar
	 * @param $widgets
	 *
	 */
	public function add_widgets_to_sidebar( $sidebar, $widgets ) {

		if ( is_active_sidebar( $sidebar ) ) {
			return;
		}

		$sidebar_widgets = array();
		foreach ( $widgets as $widget_options ) {
			$widget_id = $widget_options['id'];
			unset( $widget_options['id'] );

			if ( ! isset( $this->widgets[ $widget_id ] ) ) {
				$this->widgets[ $widget_id ] = get_option( "widget_{$widget_id}" );
			}

			if ( empty( $this->widgets[ $widget_id ] ) || ( count( $this->widgets[ $widget_id ] ) == 1 && isset( $this->widgets[ $widget_id ]['_multiwidget'] ) ) ) {
				$this->widgets[ $widget_id ] = array(
					1 => $widget_options,
				);
			} else {
				array_push( $this->widgets[ $widget_id ], $widget_options );
			}

			$widget_index = $widget_id . '-' . end( array_keys( $this->widgets[ $widget_id ] ) );
			array_push( $sidebar_widgets, $widget_index );

		}

		foreach ( $this->widgets as $widget_id => $widgets ) {
			update_option( "widget_{$widget_id}", $widgets );
		}

		$sidebars             = get_option( 'sidebars_widgets' );
		$sidebars[ $sidebar ] = $sidebar_widgets;
		update_option( 'sidebars_widgets', $sidebars );

		$this->widgets = array();

	}

	/**
	 * Add demo content for Welcome section
	 */
	public function populate_hero_section() {

		$options = array(
			'regina_lite_top_box_title'              => wp_kses_post( 'We help people, like you.' ),
			'regina_lite_top_box_description'        => esc_html( 'Our team of specialists is ready to help you. Book an appointment now!' ),
			'regina_lite_top_box_bookappointmenturl' => esc_url_raw( '#' ),
		);

		foreach ( $options as $option_name => $value ) {
			$current_value = get_theme_mod( $option_name );
			if ( ! $current_value ) {
				set_theme_mod( $option_name, $value );
			}
		}

	}

	/**
	 * Add demo content for Service section
	 */
	public function populate_services_section() {

		$page_id = Regina_Lite_Helper::get_setting_page_id();

		$options = array(
			'regina_lite_features_general_title'        => esc_html( 'Our Services' ),
			'regina_lite_features_general_description'  => esc_html( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.' ),
			'regina_lite_features_general_button_text'  => esc_html( 'Our Services' ),
			'regina_lite_features_general_button_url'   => esc_url_raw( '#' ),
			'regina_lite_features_feature1_title'       => esc_html( 'Free Support' ),
			'regina_lite_features_feature1_description' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.' ),
			'regina_lite_features_feature1_buttonurl'   => esc_url_raw( '#' ),
			'regina_lite_features_feature2_title'       => esc_html( 'Medical Care' ),
			'regina_lite_features_feature2_description' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.' ),
			'regina_lite_features_feature2_buttonurl'   => esc_url_raw( '#' ),
			'regina_lite_features_feature3_title'       => esc_html( 'Life Care' ),
			'regina_lite_features_feature3_description' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.' ),
			'regina_lite_features_feature3_buttonurl'   => esc_url_raw( '#' ),
			'regina_lite_features_feature4_title'       => esc_html( 'Nervous System' ),
			'regina_lite_features_feature4_description' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.' ),
			'regina_lite_features_feature4_buttonurl'   => esc_url_raw( '#' ),
		);

		$settings = get_post_meta( $page_id, 'regina-settings', true );
		if ( ! is_array( $settings ) ) {
			$settings = array();
		}
		foreach ( $options as $option_name => $value ) {
			if ( ! isset( $settings[ $option_name ] ) ) {
				$settings[ $option_name ] = $value;
			}
		}
		update_post_meta( $page_id, 'regina-settings', $settings );

	}

	/**
	 * Add demo content for Image section
	 */
	public function populate_team_section() {

		$page_id = Regina_Lite_Helper::get_setting_page_id();

		$options = array(
			'regina_lite_ourteam_general_title'           => esc_html( 'Our team can help you!' ),
			'regina_lite_ourteam_general_description'     => esc_html( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.' ),
			'regina_lite_ourteam_teammember1_image'       => esc_url( get_template_directory_uri() . '/layout/images/team/team-member-1.jpg' ),
			'regina_lite_ourteam_teammember1_name'        => esc_html( 'Dr. Steve Leeson' ),
			'regina_lite_ourteam_teammember1_position'    => esc_html( 'Cardiac Clinic, Primary Healthcare' ),
			'regina_lite_ourteam_teammember1_description' => esc_html( 'Dr. Steve Leeson was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...' ),
			'regina_lite_ourteam_teammember1_buttonurl'   => esc_url_raw( '#' ),
			'regina_lite_ourteam_teammember2_image'       => esc_url( get_template_directory_uri() . '/layout/images/team/team-member-2.jpg' ),
			'regina_lite_ourteam_teammember2_name'        => esc_html( 'Dr. Amanda Riss' ),
			'regina_lite_ourteam_teammember2_position'    => esc_html( 'Cardiac Clinic, Primary Healthcare' ),
			'regina_lite_ourteam_teammember2_description' => esc_html( 'Dr. Amanda Riss was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...' ),
			'regina_lite_ourteam_teammember2_buttonurl'   => esc_url_raw( '#' ),
			'regina_lite_ourteam_teammember3_image'       => esc_url( get_template_directory_uri() . '/layout/images/team/team-member-3.jpg' ),
			'regina_lite_ourteam_teammember3_name'        => esc_html( 'Dr. Mick Harold' ),
			'regina_lite_ourteam_teammember3_position'    => esc_html( 'Cardiac Clinic, Primary Healthcare' ),
			'regina_lite_ourteam_teammember3_description' => esc_html( 'Dr. Mick Harold was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...' ),
			'regina_lite_ourteam_teammember3_buttonurl'   => esc_url_raw( '#' ),
			'regina_lite_ourteam_teammember4_image'       => esc_url( get_template_directory_uri() . '/layout/images/team/team-member-4.jpg' ),
			'regina_lite_ourteam_teammember4_name'        => esc_html( 'Dr. Jenna Crew' ),
			'regina_lite_ourteam_teammember4_position'    => esc_html( 'Cardiac Clinic, Primary Healthcare' ),
			'regina_lite_ourteam_teammember4_description' => esc_html( 'Dr. Jenna Crew was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...' ),
			'regina_lite_ourteam_teammember4_buttonurl'   => esc_url_raw( '#' ),
		);

		$settings = get_post_meta( $page_id, 'regina-settings', true );
		if ( ! is_array( $settings ) ) {
			$settings = array();
		}
		foreach ( $options as $option_name => $value ) {
			if ( ! isset( $settings[ $option_name ] ) ) {
				$settings[ $option_name ] = $value;
			}
		}
		update_post_meta( $page_id, 'regina-settings', $settings );

	}

	/**
	 * Add demo content for Phone section
	 */
	public function populate_testimonials_section() {

		$page_id = Regina_Lite_Helper::get_setting_page_id();

		$options = array(
			'regina_lite_testimonials_general_image1'     => esc_url( get_template_directory_uri() . '/layout/images/home/testimonial-1.jpg' ),
			'regina_lite_testimonials_general_image2'     => esc_url( get_template_directory_uri() . '/layout/images/home/testimonial-2.jpg' ),
			'regina_lite_testimonials_general_image3'     => esc_url( get_template_directory_uri() . '/layout/images/home/testimonial-3.jpg' ),
			'regina_lite_testimonials_general_image4'     => esc_url( get_template_directory_uri() . '/layout/images/home/testimonial-4.jpg' ),
			'regina_lite_testimonials_testimonial1_description' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.' ),
			'regina_lite_testimonials_testimonial1_image' => esc_url( get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' ),
			'regina_lite_testimonials_testimonial1_name'  => esc_html( 'Jenny Royal' ),
			'regina_lite_testimonials_testimonial1_position' => esc_html( 'Manager @ REQ' ),
			'regina_lite_testimonials_testimonial2_description' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.' ),
			'regina_lite_testimonials_testimonial2_image' => esc_url( get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' ),
			'regina_lite_testimonials_testimonial2_name'  => esc_html( 'Jenny Royal' ),
			'regina_lite_testimonials_testimonial2_position' => esc_html( 'Manager @ REQ' ),
			'regina_lite_testimonials_testimonial3_description' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.' ),
			'regina_lite_testimonials_testimonial3_image' => esc_url( get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' ),
			'regina_lite_testimonials_testimonial3_name'  => esc_html( 'Jenny Royal' ),
			'regina_lite_testimonials_testimonial3_position' => esc_html( 'Manager @ REQ' ),
			'regina_lite_testimonials_testimonial4_description' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.' ),
			'regina_lite_testimonials_testimonial4_image' => esc_url( get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' ),
			'regina_lite_testimonials_testimonial4_name'  => esc_html( 'Jenny Royal' ),
			'regina_lite_testimonials_testimonial4_position' => esc_html( 'Manager @ REQ' ),
			'regina_lite_testimonials_testimonial5_description' => esc_html( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.' ),
			'regina_lite_testimonials_testimonial5_image' => esc_url( get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg' ),
			'regina_lite_testimonials_testimonial5_name'  => esc_html( 'Jenny Royal' ),
			'regina_lite_testimonials_testimonial5_position' => esc_html( 'Manager @ REQ' ),
		);

		$settings = get_post_meta( $page_id, 'regina-settings', true );
		if ( ! is_array( $settings ) ) {
			$settings = array();
		}
		foreach ( $options as $option_name => $value ) {
			if ( ! isset( $settings[ $option_name ] ) ) {
				$settings[ $option_name ] = $value;
			}
		}
		update_post_meta( $page_id, 'regina-settings', $settings );

	}

	/**
	 * Add demo content for CTA section
	 */
	public function populate_swods_section() {

		$page_id = Regina_Lite_Helper::get_setting_page_id();

		$options = array(
			'regina_lite_speak_general_title'       => esc_html( 'Speak with our doctors' ),
			'regina_lite_speak_general_description' => esc_html( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.' ),
			'regina_lite_speak_general_buttonurl'   => esc_url_raw( '#' ),
		);

		$settings = get_post_meta( $page_id, 'regina-settings', true );
		if ( ! is_array( $settings ) ) {
			$settings = array();
		}
		foreach ( $options as $option_name => $value ) {
			if ( ! isset( $settings[ $option_name ] ) ) {
				$settings[ $option_name ] = $value;
			}
		}
		update_post_meta( $page_id, 'regina-settings', $settings );

	}

	/**
	 * Add demo content for Video section
	 */
	public function populate_news_section() {

		$options = array(
			'regina_lite_news_section_title'     => esc_html( 'Your success is our most important priority' ),
			'regina_lite_news_section_sub_title' => esc_html( 'Your success is our most important priority' ),
		);

		$settings = get_post_meta( $page_id, 'regina-settings', true );
		if ( ! is_array( $settings ) ) {
			$settings = array();
		}
		foreach ( $options as $option_name => $value ) {
			if ( ! isset( $settings[ $option_name ] ) ) {
				$settings[ $option_name ] = $value;
			}
		}
		update_post_meta( $page_id, 'regina-settings', $settings );

	}

	/**
	 * Add demo content for Subscribe section
	 */
	public function add_footer_widgets() {

		$footer_1 = array(
			array(
				'id'     => 'text',
				'title'  => esc_html__( 'About Regina Lite', 'regina-lite' ),
				'text'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.', 'regina-lite' ),
				'filter' => 1,
				'visual' => 1,
			),
		);
		$footer_2 = array(
			array(
				'id'    => 'meta',
				'title' => esc_html( '' ),
			),
		);
		$footer_3 = array(
			array(
				'id'     => 'text',
				'title'  => esc_html__( 'Contact', 'regina-lite' ),
				'text'   => wp_kses_post( '<p><span class="nc-icon-glyph tech_mobile-button white"></span>&nbsp;&nbsp; (650) 652-8500</p><p><span class="nc-icon-glyph ui-1_email-83 white"></span>&nbsp;&nbsp; <a href="mailto: contact@mediplus.com" title="contact@mediplus.com">contact@mediplus.com</a></p><ul class="social-link-list"><li><a href="#" title="Facebook" target="_blank"><span class="nc-icon-glyph socials-1_logo-facebook"></span></a></li><li><a href="#" title="Twitter" target="_blank"><span class="nc-icon-glyph socials-1_logo-twitter"></span></a></li><li><a href="#" title="LinkedIn" target="_blank"><span class="nc-icon-glyph socials-1_logo-linkedin"></span></a></li><li><a href="#" title="YouTube" target="_blank"><span class="nc-icon-glyph socials-1_logo-youtube"></span></a></li><li><a href="#" title="Instagram" target="_blank"><span class="nc-icon-glyph socials-1_logo-instagram"></span></a></li></ul>' ),
				'filter' => 1,
				'visual' => 1,
			),
		);
		$footer_4 = array(
			array(
				'id'     => 'text',
				'title'  => esc_html__( 'Address', 'regina-lite' ),
				'text'   => wp_kses_post( '<span class="nc-icon-glyph location_pin white" style="float:left;"></span><p style="float:left; margin:-7px 0 0 10px;">Medplus<br>33 Farlane Street<br>Keilor East<br>VIC 3033, New York</p>' ),
				'filter' => 1,
				'visual' => 1,
			),
		);

		$this->add_widgets_to_sidebar( 'footer-sidebar-1', $footer_1 );
		$this->add_widgets_to_sidebar( 'footer-sidebar-2', $footer_2 );
		$this->add_widgets_to_sidebar( 'footer-sidebar-3', $footer_3 );
		$this->add_widgets_to_sidebar( 'footer-sidebar-4', $footer_4 );

	}

}
