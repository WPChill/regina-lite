<?php

	// Set Panel ID
	$panel_id = $prefix . '_panel_general';

	// Set prefix
	$prefix = 'regina_lite';

	/***********************************************/
	/************** Settings  ***************/
	/***********************************************/


	/* Advanced */
	$wp_customize->add_section(
		$prefix . '_advanced_section',
		array(
			'title' => esc_html__( 'Advanced Settings', 'regina-lite' ),
			'panel' => $panel_id,
		)
	);

	/* Page Header Background Image */
	$wp_customize->add_setting(
		$prefix . '_page_header_bg',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => '',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			$prefix . '_page_header_bg',
			array(
				'label'       => __( 'Page Header Image:', 'regina-lite' ),
				'description' => __( 'Image to be used as background for all page titles. ', 'regina-lite' ),
				'section'     => $prefix . '_advanced_section',
			)
		)
	);

	/* Book Appointment Button Label */
	$wp_customize->add_setting(
		$prefix . '_book_appointment_button_label',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Book Appointment', 'regina-lite' ),
		)
	);
	$wp_customize->add_control(
		$prefix . '_book_appointment_button_label',
		array(
			'label'       => esc_html__( 'Book Appointment Button Label:', 'regina-lite' ),
			'description' => esc_html__( 'This setting will affect all instances of the Book Appointment button.', 'regina-lite' ),
			'section'     => $prefix . '_advanced_section',
			'type'        => 'text',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		$prefix . '_book_appointment_button_label', array(
			'selector' => '#navigation .appointment-url',
		)
	);

	/* Book Appointment URL */
	$wp_customize->add_setting(
		$prefix . '_contact_bar_bookappointmenturl', array(
			'sanitize_callback' => 'esc_url',
			'default'           => '#',
		)
	);

	$wp_customize->add_control(
		$prefix . '_contact_bar_bookappointmenturl', array(
			'label'       => esc_html__( 'Book Appointment URL:', 'regina-lite' ),
			'description' => esc_html__( 'Enter the URL you want to use for the book appointment button.', 'regina-lite' ),
			'section'     => $prefix . '_advanced_section',
			'settings'    => $prefix . '_contact_bar_bookappointmenturl',
		)
	);

	/* Enable Site Preloader*/
	$wp_customize->add_setting(
		$prefix . '_enable_site_preloader',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);

	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_enable_site_preloader', array(
				'type'        => 'epsilon-toggle',
				'label'       => esc_html__( 'Enable site preloader', 'regina-lite' ),
				'description' => esc_html__( 'Initial status: enabled', 'regina-lite' ),
				'section'     => $prefix . '_advanced_section',
			)
		)
	);



