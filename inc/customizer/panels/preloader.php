<?php

	// requires
	require get_template_directory() . '/inc/customizer/custom-controls/pro-controls-selector.php';

    // Set Panel ID
    $panel_id = 'regina_lite_panel_preloader';

    // Set prefix
    $prefix = 'rl';

// @todo: add preloader text font-family control

    /***********************************************/
    /************** GENERAL OPTIONS  ***************/
    /***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 28,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Preloader Options', 'regina-lite' ),
            'description' => esc_html__('This panel allows you to control the way the site pre-loader looks', 'regina-lite'),
        )
    );

    /* Layout */
    $wp_customize->add_section( $prefix.'_preloader_general_section' ,
        array(
            'title'       => esc_html__( 'General', 'regina-lite' ),
            'description' => esc_html__( 'Change pre-loader text color, background-color as well as the text message that\'s being displayed.', 'regina-lite'),
            'panel' 	  => $panel_id
        )
    );


    /* Preloader Text */
    $wp_customize->add_setting($prefix.'_preloader_text',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => esc_html__('Loading', 'regina-lite'),
        )
    );

    $wp_customize->add_control( new regina_lite_Disabled_Custom_Control(
        $wp_customize,
        $prefix.'_preloader_text',
	        array(
	            'type'          => 'text',
	            'label' 		=> esc_html__('Preloader text', 'regina-lite'),
	            'description'   => esc_html__('Current text: Loading', 'regina-lite'),
	            'section' 		=> $prefix.'_preloader_general_section',
	        )
	    )
    );



    /* Preloader Progress Color */
    $wp_customize->add_setting($prefix.'_preloader_progress_color',
        array(
            'sanitize_callback' => $prefix.'_sanitize_hex_color',
            'default' => '#000',
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
            $prefix.'_preloader_progress_color',
            array(
                'label' 		=> esc_html__('Preloader Loading Color', 'regina-lite'),
                'description'   => esc_html__('Current value: #000 (black)', 'regina-lite'),
                'section' 		=> $prefix.'_preloader_general_section',
            )
        )
    );

    /* Preloader BG Color */
    $wp_customize->add_setting($prefix.'_preloader_bg_color',
        array(
            'sanitize_callback' => $prefix.'_sanitize_hex_color',
            'default' => '#FFF'
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
    $prefix.'_preloader_bg_color',
            array(

                'label' 		=> esc_html__('Preloader background color', 'regina-lite'),
                'description'   => esc_html__('Current color: #FFF (white) ', 'regina-lite'),
                'section' 		=> $prefix.'_preloader_general_section',
            )
        )
    );

    /* Preloader Text Color */
    $wp_customize->add_setting($prefix.'_preloader_text_color',
        array(
            'sanitize_callback' => $prefix.'_sanitize_hex_color',
            'default' => '#000'
        )
    );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
        $prefix.'_preloader_text_color',
            array(
                'label' 		=> esc_html__('Preloader text color', 'regina-lite'),
                'description'   => esc_html__('Current color: #000 (black) ', 'regina-lite'),
                'section' 		=> $prefix.'_preloader_general_section',
            )
        )
    );


/***********************************************/
/************** Preloader Styles  ***************/
/***********************************************/


    /* Styles  */
    $wp_customize->add_section( $prefix.'_preloader_styles_section' ,
        array(
            'title'       => esc_html__( 'Styles', 'regina-lite' ),
            'description' => esc_html__( 'This section allows you to pick your preloader style. More styles are available in the PRO version', 'regina-lite'),
            'panel' 	  => $panel_id
        )
    );

    /* Preloader Text */
    $wp_customize->add_setting($prefix.'_preloader_style',
        array(
            'sanitize_callback' => 'sanitize_text_field',
            'default' => esc_html__('Loading', 'regina-lite'),
        )
    );

    $wp_customize->add_control(
        $prefix.'_preloader_style',

        array(
            'type' => 'select',
            'choices' => array(
              'default' => esc_html__('Default', 'regina-lite'),
            ),
            'label' 		=> esc_html__('Preloader style', 'regina-lite'),
            'description'   => esc_html__('Current style: Default', 'regina-lite'),
            'section' 		=> $prefix.'_preloader_styles_section',
        )
    );

