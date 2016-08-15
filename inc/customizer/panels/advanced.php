<?php

    // Set Panel ID
    $panel_id = $prefix.'_panel_general';

    // Set prefix
    $prefix = 'regina_lite';

    /***********************************************/
    /************** Settings  ***************/
    /***********************************************/


    /* Advanced */
    $wp_customize->add_section( $prefix.'_advanced_section' ,
        array(
            'title'       => esc_html__( 'Advanced Settings', 'regina-lite' ),
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
    $wp_customize->add_control(
        $prefix.'_enable_site_preloader',
            array(
                'type'	=> 'checkbox',
                'label' => esc_html__('Enable site preloader', 'regina-lite'),
                'description' => esc_html__('Initial status: enabled', 'regina-lite'),
                'section' => $prefix.'_advanced_section'
            )
    );


    // Enable Search Icon in Header
    $wp_customize->add_setting( $prefix . '_enable_site_search_icon',
        array(
            'sanitize_callback' => $prefix . '_sanitize_checkbox',
            'default'           => 1
        )
    );

    $wp_customize->add_control(
        $prefix . '_enable_site_search_icon',
            array(
                'type'          => 'checkbox',
                'label'         => esc_html__( 'Enable search box in header?', 'regina-lite' ),
                'description'   => esc_html__( 'Initial status: enabled. If you don\'t like the fact that the search form is shown in the header, un-check this.', 'regina-lite' ),
                'section'       => $prefix . '_advanced_section'
            )
    );
