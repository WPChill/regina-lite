<?php

	// Set prefix
	$prefix = 'regina_lite';

	// Set Panel ID
	$panel_id = $prefix . '_panel_general';

	// Change panel for Site Title & Tagline Section
	$site_title        = $wp_customize->get_section( 'title_tagline' );
	$site_title->panel = $panel_id;

	// Remove sections from customizer front-view
	$wp_customize->remove_section( 'colors' );

	// Change panel for Background Image
	$site_title2        = $wp_customize->get_section( 'background_image' );
	$site_title2->panel = $panel_id;

	// Change panel for Static Front Page
	$site_title3        = $wp_customize->get_section( 'static_front_page' );
	$site_title3->panel = $panel_id;

	// Change priority for Site Title
	$site_title4           = $wp_customize->get_control( 'blogname' );
	$site_title4->priority = 15;

	// Change priority for Site Tagline
	$site_title5           = $wp_customize->get_control( 'blogdescription' );
	$site_title5->priority = 17;


	/***********************************************/
	/************** GENERAL OPTIONS  ***************/
	/***********************************************/


	$wp_customize->add_panel( $panel_id,
		array(
			'priority' => 29,
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'title' => esc_html__( 'Theme Options', 'regina-lite' ),
			'description' => esc_html__( 'You can change the site layout in this area as well as your contact details (the ones displayed in the header & footer) ', 'regina-lite' ),
		)
	);

	/***********************************************/
	/************** General Site Settings  ***************/
	/***********************************************/


	// upsell - section order
	$wp_customize->add_section( $prefix . '_order_section', array(
		'title'    => __( 'Section order', 'regina-lite' ),
		'priority' => 1,
		'panel' => $panel_id,
	) );

	$wp_customize->add_setting( $prefix . '_order_section', array(
		'sanitize_callback' => $prefix . '_sanitize_pro_version',
	) );
	$wp_customize->add_control( new Epsilon_Control_Upsell( $wp_customize, $prefix . '_order_section', array(
		'section'      => $prefix . '_order_section',
		'priority'     => 0,
		'options'      => array(
			esc_html__( 'Order Homepage Sections', 'regina-lite' ),
		),
		'requirements' => array(
			esc_html__( 'Drag & Drop section re-ordering is available in the PRO version of Regina.', 'regina-lite' ),
		),
		'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=regina-lite-welcome&tab=features' ),
		'button_text'  => esc_html__( 'See PRO vs Lite', 'regina-lite' ),
		'second_button_url'  => esc_url_raw( 'https://www.machothemes.com/theme/regina-pro/?utm_source=worg&utm_medium=customizer&utm_campaign=upsell' ),
		'second_button_text' => esc_html__( 'Get PRO now!', 'regina-lite' ),
		'separator' => ' or ',
	) ) );

	/* Logo */
	$wp_customize->add_section( $prefix . '_general_section' ,
		array(
			'title'       => esc_html__( 'Logo', 'regina-lite' ),
			'priority'    => 2,
			'panel'       => $panel_id,
		)
	);

	/* Company text logo */
	$wp_customize->add_setting($prefix . '_text_logo',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => esc_html__( 'Regina Lite', 'regina-lite' ),
		)
	);

	$wp_customize->add_control(
		$prefix . '_text_logo',
		array(
			'label'         => esc_html__( 'Enter company name', 'regina-lite' ),
			'description'   => esc_html__( 'This field is best used when you don\'t have a professional image logo', 'regina-lite' ),
			'section'       => $prefix . '_general_section',
			'priority'      => 2,
		)
	);

	/* Company Image Logo */
	$wp_customize->add_setting( $prefix . '_img_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_img_logo', array(
		'label'    => __( 'Company Image Logo:', 'regina-lite' ),
		'section'  => $prefix . '_general_section',
		'settings' => $prefix . '_img_logo',
	) ) );

	$custom_logo = $wp_customize->get_control( 'custom_logo' );
	if ( $custom_logo ) {
		$custom_logo->section = $prefix . '_general_section';
	}

	/***********************************************/
	/************** Contact Details  ***************/
	/***********************************************/

	$wp_customize->add_section( $prefix . '_general_contact_section' ,
		array(
			'title'       => esc_html__( 'Contact Details', 'regina-lite' ),
			//'description' => esc_html__( 'These are the contact details displayed in the header & footer of the website.', 'regina-lite' ),
			'priority'    => 3,
			'panel' => $panel_id,
		)
	);

	/* Facebook URL */
	$wp_customize->add_setting( $prefix . '_contact_bar_facebook_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_url( 'https://www.facebook.com/machothemes/' ),
		)
	);

	$wp_customize->add_control( $prefix . '_contact_bar_facebook_url',
		array(
			'label'   => esc_html__( 'Facebook URL', 'regina-lite' ),
			'description' => esc_html__( 'Will be displayed in the header contact bar.', 'regina-lite' ),
			'section' => $prefix . '_general_contact_section',
			'settings'   => $prefix . '_contact_bar_facebook_url',
			'priority' => 10,
		)
	);
	$wp_customize->selective_refresh->add_partial( $prefix . '_contact_bar_facebook_url', array(
		'selector' => '#sub-header .social-link-list li.regina-facebook',
		'render_callback' => 'pixova_render_facebook_link',
	) );

	/* Twitter URL */
	$wp_customize->add_setting( $prefix . '_contact_bar_twitter_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html( '#' ),
		)
	);

	$wp_customize->add_control( $prefix . '_contact_bar_twitter_url',
		array(
			'label'   => esc_html__( 'Twitter URL', 'regina-lite' ),
			'description' => esc_html__( 'Will be displayed in the header contact bar.', 'regina-lite' ),
			'section' => $prefix . '_general_contact_section',
			'settings'   => $prefix . '_contact_bar_twitter_url',
			'priority' => 10,
		)
	);
	$wp_customize->selective_refresh->add_partial( $prefix . '_contact_bar_twitter_url', array(
		'selector' => '#sub-header .social-link-list li.regina-twitter',
		'render_callback' => 'pixova_render_appointment_link',
	) );

	/* YouTube URL */
	$wp_customize->add_setting( $prefix . '_contact_bar_youtube_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html( '#' ),
		)
	);

	$wp_customize->add_control( $prefix . '_contact_bar_youtube_url',
		array(
			'label'   => esc_html__( 'YouTube URL', 'regina-lite' ),
			'description' => esc_html__( 'Will be displayed in the header contact bar.', 'regina-lite' ),
			'section' => $prefix . '_general_contact_section',
			'settings'   => $prefix . '_contact_bar_youtube_url',
			'priority' => 10,
		)
	);
	$wp_customize->selective_refresh->add_partial( $prefix . '_contact_bar_youtube_url', array(
		'selector' => '#sub-header .social-link-list li.regina-youtube',
		'render_callback' => 'pixova_render_youtube_link',
	) );

	/* LinkedIN URL */
	$wp_customize->add_setting( $prefix . '_contact_bar_linkedin_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html( '#' ),
		)
	);

	$wp_customize->add_control( $prefix . '_contact_bar_linkedin_url',
		array(
			'label'   => esc_html__( 'LinkedIN URL', 'regina-lite' ),
			'description' => esc_html__( 'Will be displayed in the header contact bar.', 'regina-lite' ),
			'section' => $prefix . '_general_contact_section',
			'settings'   => $prefix . '_contact_bar_linkedin_url',
			'priority' => 10,
		)
	);
	$wp_customize->selective_refresh->add_partial( $prefix . '_contact_bar_linkedin_url', array(
		'selector' => '#sub-header .social-link-list li.regina-linkedin',
		'render_callback' => 'pixova_render_linkedin_link',
	) );

	/* Instagram URL */
	$wp_customize->add_setting( $prefix . '_contact_bar_instagram_url',
		array(
			'sanitize_callback' => 'esc_url',
			'default' => esc_html( '#' ),
		)
	);

	$wp_customize->add_control( $prefix . '_contact_bar_instagram_url',
		array(
			'label'   => esc_html__( 'Instagram URL', 'regina-lite' ),
			'description' => esc_html__( 'Will be displayed in the header contact bar.', 'regina-lite' ),
			'section' => $prefix . '_general_contact_section',
			'settings'   => $prefix . '_contact_bar_instagram_url',
			'priority' => 10,
		)
	);
	$wp_customize->selective_refresh->add_partial( $prefix . '_contact_bar_instagram_url', array(
		'selector' => '#sub-header .social-link-list li.regina-instagram',
		'render_callback' => 'pixova_render_instagram_link',
	) );


	/* email */
	$wp_customize->add_setting( $prefix . '_email',
		array(
			'sanitize_callback' => 'sanitize_email',
			'default' => __( 'contact@site.com', 'regina-lite' ),
		)
	);

	$wp_customize->add_control( $prefix . '_email',
		array(
			'label'   => esc_html__( 'Email address', 'regina-lite' ),
			'description' => esc_html__( 'Will be displayed in the header & footer contact widget.', 'regina-lite' ),
			'section' => $prefix . '_general_contact_section',
			'settings'   => $prefix . '_email',
			'priority' => 10,
		)
	);
	$wp_customize->selective_refresh->add_partial( $prefix . '_email', array(
		'selector' => '#sub-header .contact-bar .regina-email a',
		'container_inclusive' => true,
		'render_callback' => 'pixova_render_email_link',
	) );


	/* phone number */
	$wp_customize->add_setting( $prefix . '_phone',
		array(
			'sanitize_callback' => $prefix . '_sanitize_number',
			'default' => '0 332 548 954',
		)
	);

	$wp_customize->add_control( $prefix . '_phone',
		array(
			'label'   => esc_html__( 'Phone number', 'regina-lite' ),
			'description' => esc_html__( 'Will be displayed in the header & footer contact widget.', 'regina-lite' ),
			'section' => $prefix . '_general_contact_section',
			'settings'   => $prefix . '_phone',
			'priority' => 12,
		)
	);
	$wp_customize->selective_refresh->add_partial( $prefix . '_phone', array(
		'selector' => '#sub-header .contact-bar .regina-phone',
	) );



	/***********************************************/
	/************** Footer Details  ***************/
	/***********************************************/
	$wp_customize->add_section( $prefix . '_general_footer_section' ,
		array(
			'title'       => esc_html__( 'Footer Details', 'regina-lite' ),
			'description' => esc_html__( 'Change the footer copyright message from here. Note: no HTML allowed.', 'regina-lite' ),
			'priority'    => 4,
			'panel' => $panel_id,
		)
	);

	# Footer Copyright: Checkbox
	$wp_customize->add_setting( $prefix . '_footer_theme_copyright_enable',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default' => 1,
		)
	);

	$wp_customize->add_control( new Epsilon_Control_Toggle( $wp_customize, $prefix . '_footer_theme_copyright_enable', array(
		'type' => 'epsilon-toggle',
		'label' => esc_html__( 'Enable footer theme copyright message', 'regina-lite' ),
		'description' => esc_html__( 'This will display the theme name with a back-link to the site of the theme developers. Leave it if you wish to give credit where it\'s due', 'regina-lite' ),
		'section'   => $prefix . '_general_footer_section',
		'settings'   => $prefix . '_footer_theme_copyright_enable',
		'priority' => 10,
	) ) );

	# Footer Copyrigt: Message
	$wp_customize->add_setting( $prefix . '_footer_copyright', array(
		'sanitize_callback' => 'wp_kses_post',
		'default'           => esc_html__( '&copy; Copyright 2016. All Rights Reserved.', 'regina-lite' ),
	) );

	$wp_customize->add_control( new Epsilon_Control_Text_Editor( $wp_customize, $prefix . '_footer_copyright', array(
		'label'   => esc_html__( 'Footer Copyright.', 'regina-lite' ),
		'description' => esc_html__( 'Will be displayed in the footer', 'regina-lite' ),
		'section' => $prefix . '_general_footer_section',
		'settings'   => $prefix . '_footer_copyright',
		'priority' => 11,
	) ) );
	$wp_customize->selective_refresh->add_partial( $prefix . '_footer_copyright', array(
		'selector' => '#sub-footer .copyright',
	) );
