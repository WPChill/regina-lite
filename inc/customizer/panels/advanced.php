<?php

    // Set Panel ID
    $panel_id = 'regina_lite_panel_advanced';

    // Set prefix
    $prefix = 'regina_lite';

    /***********************************************/
    /************** Settings  ***************/
    /***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 35,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Advanced Options', 'regina-lite' )
        )
    );

    /* Advanced */
    $wp_customize->add_section( $prefix.'_advanced_section' ,
        array(
            'title'       => esc_html__( 'Settings', 'regina-lite' ),
            'panel' 	  => $panel_id
        )
    );


    /* Enable Site Preloader*/
    $wp_customize->add_setting( $prefix.'_enable_site_preloader',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new regina_lite_Disabled_Custom_Control(
        $wp_customize,
        $prefix.'_enable_site_preloader',
            array(
                'type'	=> 'checkbox',
                'label' => esc_html__('Enable site preloader', 'regina-lite'),
                'description' => esc_html__('Initial status: enabled', 'regina-lite'),
                'section' => $prefix.'_advanced_section',
            )
        )
    );

    /* Enable SmothScroll */
    $wp_customize->add_setting( $prefix.'_enable_site_smoothscroll',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new regina_lite_Disabled_Custom_Control(
	    $wp_customize,
        $prefix.'_enable_site_smoothscroll',
	        array(
	            'type'	=> 'checkbox',
	            'label' => esc_html__('Enable smoothscroll', 'regina-lite'),
	            'description' => esc_html__('Initial status: enabled', 'regina-lite'),
	            'section' => $prefix.'_advanced_section',
	        )
	    )
    );


    /* Enable Image LazyLoad Behavior */
    $wp_customize->add_setting( $prefix.'_enable_site_lazyload',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );

    $wp_customize->add_control(
        $prefix.'_enable_site_lazyload',
        array(
            'type'	=> 'checkbox',
            'label' => esc_html__('Enable Lazy Load behavior for images ?', 'regina-lite'),
            'description' => esc_html__('Initial status: enabled. If you don\'t like the fact that images are being loaded as you scroll them into view, uncheck this.', 'regina-lite'),
            'section' => $prefix.'_advanced_section',
        )
    );