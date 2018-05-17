<?php
// Set Panel ID
$panel_id = 'regina_lite_testimonials_panel';

// Set Prefix
$prefix = 'regina_lite';

/***********************************************/
/****************** OUR TEAM *******************/
/***********************************************/
$wp_customize->add_panel(
	new Regina_Custom_Panel(
		$wp_customize, $panel_id, array(
			'priority'       => 40,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Testimonials', 'regina-lite' ),
			'description'    => esc_html__( 'Control all the Testimonial Section settings from this panel. Adding more testimonials is possible only in the PRO version of Regina.', 'regina-lite' ),
			'panel'          => 'regina_lite_frontpage_sections',
		)
	)
);

/***********************************************/
/************ GENERAL SECTION *******************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_testimonials_general', array(
		'title' => esc_html__( 'General', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

// Upsell
$wp_customize->add_section(
	new Regina_Section_Upsell(
		$wp_customize, $prefix . '_testimonials_pro', array(
			'panel'              => $panel_id,
			'options'            => array(
				esc_html__( 'Unlimited Testimonials', 'regina-lite' ),
			),
			'requirements'       => array(
				esc_html__( 'In Regina PRO you can add how many testimonials you want.', 'regina-lite' ),
			),
			'button_url'         => esc_url_raw( get_admin_url() . 'themes.php?page=regina-welcome&tab=features' ),
			'button_text'        => esc_html__( 'See PRO vs Lite', 'regina-lite' ),
			'second_button_url'  => esc_url_raw( 'https://www.machothemes.com/theme/regina-pro/?utm_source=worg&utm_medium=customizer&utm_campaign=upsell' ),
			'second_button_text' => esc_html__( 'Get PRO now!', 'regina-lite' ),
			'separator'          => ' or ',
			'priority'           => 0,
		)
	)
);

/* Show this section? */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_general_show', array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Toggle(
		$wp_customize, $prefix . '_testimonials_general_show', array(
			'type'    => 'epsilon-toggle',
			'label'   => esc_html__( 'Show this section?', 'regina-lite' ),
			'section' => $prefix . '_testimonials_general',
		)
	)
);

/* Image #1 */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_general_image1', array(
			'default'           => get_template_directory_uri() . '/layout/images/home/testimonial-1.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	)
);

$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_testimonials_general_image1', array(
			'label'    => __( 'Image #1:', 'regina-lite' ),
			'section'  => $prefix . '_testimonials_general',
			'settings' => $prefix . '_testimonials_general_image1',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_general_image1', array(
		'selector'        => '#home-testimonials .testimonial-image-1',
		'render_callback' => 'pixova_render_testimonial_image1',
	)
);

/* Image #2 */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_general_image2', array(
			'default'           => get_template_directory_uri() . '/layout/images/home/testimonial-2.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_testimonials_general_image2', array(
			'label'    => __( 'Image #2:', 'regina-lite' ),
			'section'  => $prefix . '_testimonials_general',
			'settings' => $prefix . '_testimonials_general_image2',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_general_image2', array(
		'selector'        => '#home-testimonials .testimonial-image-2',
		'render_callback' => 'pixova_render_testimonial_image2',
	)
);

/* Image #3 */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_general_image3', array(
			'default'           => get_template_directory_uri() . '/layout/images/home/testimonial-3.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_testimonials_general_image3', array(
			'label'    => __( 'Image #3:', 'regina-lite' ),
			'section'  => $prefix . '_testimonials_general',
			'settings' => $prefix . '_testimonials_general_image3',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_general_image3', array(
		'selector'        => '#home-testimonials .testimonial-image-3',
		'render_callback' => 'pixova_render_testimonial_image3',
	)
);

/* Image #4 */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_general_image4', array(
			'default'           => get_template_directory_uri() . '/layout/images/home/testimonial-4.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_testimonials_general_image4', array(
			'label'    => __( 'Image #4:', 'regina-lite' ),
			'section'  => $prefix . '_testimonials_general',
			'settings' => $prefix . '_testimonials_general_image4',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_general_image4', array(
		'selector'        => '#home-testimonials .testimonial-image-4',
		'render_callback' => 'pixova_render_testimonial_image4',
	)
);

/***********************************************/
/************ TESTIMONIAL #1 SECTION ***********/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_testimonials_testimonial1', array(
		'title'       => esc_html__( 'Testimonial #1', 'regina-lite' ),
		'description' => esc_html__( 'Testimonial #1 Section description.', 'regina-lite' ),
		'panel'       => $panel_id,
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial1_description', array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_testimonials_testimonial1_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial1',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial1_description', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-1 .quote',
	)
);


/* Image */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial1_image', array(
			'default'           => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_testimonials_testimonial1_image', array(
			'label'    => __( 'Image:', 'regina-lite' ),
			'section'  => $prefix . '_testimonials_testimonial1',
			'settings' => $prefix . '_testimonials_testimonial1_image',
		)
	)
);


/* Name */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial1_name', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Jenny Royal', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial1_name', array(
			'label'   => esc_html__( 'Name:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial1',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial1_name', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-1 .name',
	)
);


/* Position */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial1_position', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Manager @ REQ', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial1_position', array(
			'label'   => esc_html__( 'Position:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial1',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial1_position', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-1 .position',
	)
);


/***********************************************/
/************ TESTIMONIAL #2 SECTION ***********/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_testimonials_testimonial2', array(
		'title' => esc_html__( 'Testimonial #2', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial2_description', array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_testimonials_testimonial2_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial2',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial2_description', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-2 .quote',
	)
);

/* Image */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial2_image', array(
			'default'           => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_testimonials_testimonial2_image', array(
			'label'    => __( 'Image:', 'regina-lite' ),
			'section'  => $prefix . '_testimonials_testimonial2',
			'settings' => $prefix . '_testimonials_testimonial2_image',
		)
	)
);

/* Name */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial2_name', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Jenny Royal', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial2_name', array(
			'label'   => esc_html__( 'Name:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial2',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial2_name', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-2 .name',
	)
);

/* Position */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial2_position', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Manager @ REQ', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial2_position', array(
			'label'   => esc_html__( 'Position:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial2',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial2_position', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-2 .position',
	)
);

/***********************************************/
/************ TESTIMONIAL #3 SECTION ***********/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_testimonials_testimonial3', array(
		'title' => esc_html__( 'Testimonial #3', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial3_description', array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_testimonials_testimonial3_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial3',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial3_description', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-2 .quote',
	)
);

/* Image */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial3_image', array(
			'default'           => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_testimonials_testimonial3_image', array(
			'label'    => __( 'Image:', 'regina-lite' ),
			'section'  => $prefix . '_testimonials_testimonial3',
			'settings' => $prefix . '_testimonials_testimonial3_image',
		)
	)
);

/* Name */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial3_name', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Jenny Royal', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial3_name', array(
			'label'   => esc_html__( 'Name:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial3',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial3_name', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-3 .name',
	)
);

/* Position */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial3_position', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Manager @ REQ', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial3_position', array(
			'label'   => esc_html__( 'Position:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial3',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial3_position', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-3 .position',
	)
);

/***********************************************/
/************ TESTIMONIAL #4 SECTION ***********/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_testimonials_testimonial4', array(
		'title' => esc_html__( 'Testimonial #4', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial4_description', array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_testimonials_testimonial4_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial4',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial4_description', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-4 .quote',
	)
);

/* Image */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial4_image', array(
			'default'           => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_testimonials_testimonial4_image', array(
			'label'    => __( 'Image:', 'regina-lite' ),
			'section'  => $prefix . '_testimonials_testimonial4',
			'settings' => $prefix . '_testimonials_testimonial4_image',
		)
	)
);

/* Name */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial4_name', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Jenny Royal', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial4_name', array(
			'label'   => esc_html__( 'Name:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial4',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial4_name', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-4 .name',
	)
);

/* Position */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial4_position', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Manager @ REQ', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial4_position', array(
			'label'   => esc_html__( 'Position:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial4',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial4_position', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-4 .position',
	)
);

/***********************************************/
/************ TESTIMONIAL #5 SECTION ***********/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_testimonials_testimonial5', array(
		'title' => esc_html__( 'Testimonial #5', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial5_description', array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_testimonials_testimonial5_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial5',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial5_description', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-5 .quote',
	)
);

/* Image */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial5_image', array(
			'default'           => get_template_directory_uri() . '/layout/images/home/testimonial-quote.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_testimonials_testimonial5_image', array(
			'label'    => __( 'Image:', 'regina-lite' ),
			'section'  => $prefix . '_testimonials_testimonial5',
			'settings' => $prefix . '_testimonials_testimonial5_image',
		)
	)
);

/* Name */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial5_name', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Jenny Royal', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial5_name', array(
			'label'   => esc_html__( 'Name:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial5',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial5_name', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-5 .name',
	)
);

/* Position */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_testimonials_testimonial5_position', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Manager @ REQ', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_testimonials_testimonial5_position', array(
			'label'   => esc_html__( 'Position:', 'regina-lite' ),
			'section' => $prefix . '_testimonials_testimonial5',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_testimonials_testimonial5_position', array(
		'selector' => '#testimonials-slider .bxslider .testimonial-5 .position',
	)
);
