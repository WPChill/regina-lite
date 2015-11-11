<?php

// Set Panel ID
$panel_id = 'regina_lite_panel_formats';

// Set prefix
$prefix = 'rl';

/***********************************************/
/************** Post Formats  ***************/
/***********************************************/


    $wp_customize->add_panel( $panel_id,
        array(
            'priority' => 32,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => esc_html__( 'Archive Blog Post Settings', 'regina-lite' ),
            'description' => esc_html__('This section allows you to control various settings specific to each post-format. Making changes in these sections will be reflected on the homepage.', 'regina-lite'),
        )
    );

    /***********************************************/
    /************** Standard Settings  ***************/
    /***********************************************/


    $wp_customize->add_section( $prefix.'_post_standard_format_section' ,
        array(
            'title'       => esc_html__( 'Standard', 'regina-lite' ),
            'description' => esc_html__( 'Post format: Standard (or default) settings', 'regina-lite'),
            'panel' 	  => $panel_id
        )
    );


    /* Enable Author Name  */
    $wp_customize->add_setting( $prefix.'_post_standard_enable_author',
        array(
            'sanitize_callback' => $prefix.'_sanitize_checkbox',
            'default' => 1
        )
    );
    $wp_customize->add_control( new regina_lite_Disabled_Custom_Control(
        $wp_customize,
        $prefix.'_post_standard_enable_author',
            array(
                'type'	=> 'checkbox',
                'label' => esc_html__('Enable Author', 'regina-lite'),
                'description' => esc_html__('Initial status: enabled', 'regina-lite'),
                'section' => $prefix.'_post_standard_format_section',
            )
        )
    );