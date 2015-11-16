<?php

function regina_lite_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';


	/**********************************************/
	/*************** INIT ************************/
	/**********************************************/

    /* Preloader Site Panel */
    /*
    require_once get_template_directory() . '/inc/customizer/panels/preloader.php';
    */

    /* General Site Panel */
    require_once get_template_directory() . '/inc/customizer/panels/site.php';

    /* Blog Panel */
    require_once get_template_directory() . '/inc/customizer/panels/blog.php';

    /* Post Formats Panel */
    require_once get_template_directory() . '/inc/customizer/panels/post-formats.php';

    /* Advanced Panel */
    require_once get_template_directory() . '/inc/customizer/panels/advanced.php';

    /* Features Panel */
    require_once get_template_directory() . '/inc/customizer/panels/features.php';

    /* Our Team Panel */
    require_once get_template_directory() . '/inc/customizer/panels/our-team.php';

    /* Testimonials Panel */
    require_once get_template_directory() . '/inc/customizer/panels/testimonials.php';

    /* Speak Panel */
    require_once get_template_directory() . '/inc/customizer/panels/speak.php';

}
add_action( 'customize_register', 'regina_lite_customize_register');

if( !function_exists( 'regina_lite_sanitize_number' ) ) {
    /**
     * Simple function used to sanitize numbers
     *
     * @param $input
     * @return mixed
     */
    function regina_lite_sanitize_number( $input ) {
        return force_balance_tags( $input );
    }
}

if( !function_exists( 'regina_lite_sanitize_file_url' ) ) {
    /**
     * Function to sanitize file URLS
     *
     * Used mostly for sanitizing image field types
     *
     * @param $url
     * @return string
     */
    function regina_lite_sanitize_file_url($url)
    {

        $output = '';

        $filetype = wp_check_filetype($url);
        if ($filetype["ext"]) {
            $output = esc_url($url);
        }

        return $output;
    }
}


if( !function_exists( 'regina_lite_sanitize_radio_buttons' ) ) {
    /**
     * Simple function to validate choices from radio buttons
     *
     * @param $input
     * @return string
     */
    function regina_lite_sanitize_radio_buttons( $input, $setting ) {

        global $wp_customize;

        $control = $wp_customize->get_control( $setting->id );

        if ( array_key_exists( $input, $control->choices ) ) {
            return $input;
        } else {
            return $setting->default;
        }
    }
}

if( !function_exists( 'regina_lite_sanitize_checkbox' ) ) {
    /**
     * Function to sanitize checkboxes
     *
     * @param $value
     * @return int
     */
    function regina_lite_sanitize_checkbox($value)
    {
        if ($value == 1) {
            return 1;
        } else {
            return 0;
        }
    }
}
if( !function_exists( 'regina_lite_customizer_js_load' ) ) {
    /**
     * Function to load JS into the customizer
     */
    function regina_lite_customizer_js_load()
    {

        // Customizer JS
        wp_enqueue_script( 'rl-customizer-script', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array('jquery', 'customize-controls'), '1.0', true);

        add_action('customize_controls_enqueue_scripts', 'regina_lite_customizer_js_load');
    }
}

if( !function_exists( 'regina_lite_customizer_preview_js' ) ) {
    /**
     * Function to load JS into the customizer preview
     */
    function regina_lite_customizer_preview_js()
    {
        // Customizer preview JS
        wp_enqueue_script( 'rl-customizer-script', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array('customize-preview'), '1.0', true);

    }

    add_action('customize_preview_init', 'regina_lite_customizer_preview_js');
}


if( !function_exists( 'regina_lite_customizer_css_load' ) ) {
    /**
     * Function to load CSS into the customizer
     */
    function regina_lite_customizer_css_load() {
        wp_enqueue_style(   'rl-general-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/css/riba-lite.css');
        wp_enqueue_style('mt-customizer-css', get_template_directory_uri() .'/inc/customizer/assets/css/pro/pro-version.css');

    }

    add_action('customize_controls_print_styles', 'regina_lite_customizer_css_load');
}