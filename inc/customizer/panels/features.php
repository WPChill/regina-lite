<?php
// Set Panel ID
$panel_id = 'regina_lite_features_panel';

// Set Prefix
$prefix = 'regina_lite';

/***********************************************/
/************** FEATURES ***********************/
/***********************************************/
$wp_customize->add_panel(
	new Regina_Custom_Panel(
		$wp_customize, $panel_id, array(
			'priority'       => 20,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Our Services', 'regina-lite' ),
			'description'    => esc_html__( 'Control everything related to the Services section from this panel. Custom Colors & Icons are a PRO feature only.', 'regina-lite' ),
			'panel'          => 'regina_lite_frontpage_sections',
		)
	)
);



/***********************************************/
/************ GENERAL SECTION ******************/
/***********************************************/
$wp_customize->add_section(
	new Regina_Section_Upsell(
		$wp_customize, $prefix . '_features_pro', array(
			'panel'              => $panel_id,
			'options'            => array(
				esc_html__( 'Custom Icons', 'regina-lite' ),
				esc_html__( 'Unlimited Services', 'regina-lite' ),
			),
			'requirements'       => array(
				esc_html__( 'Regina PRO comes bundled with over 700 premium icons. You can also upload your own custom icons.', 'regina-lite' ),
				esc_html__( 'In Regina PRO you can add how many services you want.', 'regina-lite' ),
			),
			'button_url'         => esc_url_raw( get_admin_url() . 'themes.php?page=regina-welcome&tab=features' ),
			'button_text'        => esc_html__( 'See PRO vs Lite', 'regina-lite' ),
			'second_button_url'  => esc_url_raw( 'https://www.machothemes.com/theme/regina-pro/?utm_source=worg&utm_medium=customizer&utm_campaign=upsell' ),
			'second_button_text' => esc_html__( 'Get PRO now!', 'regina-lite' ),
			'separator'          => ' or ',
		)
	)
);

$wp_customize->add_section(
	$prefix . '_features_general', array(
		'title' => esc_html__( 'General', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Show this section? */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_subheader_features_show',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Toggle(
		$wp_customize, $prefix . '_subheader_features_show', array(
			'type'    => 'epsilon-toggle',
			'label'   => esc_html__( 'Show this section?', 'regina-lite' ),
			'section' => $prefix . '_features_general',
		)
	)
);

/* Title */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_general_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Our Services', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_general_title',
		array(
			'label'   => esc_html__( 'Title:', 'regina-lite' ),
			'section' => $prefix . '_features_general',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_general_title', array(
		'selector' => '#services-title-block h2',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_general_description',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_features_general_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_features_general',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_general_description', array(
		'selector' => '#services-title-block p',
	)
);

/* Button Text */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_general_button_text',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Our Services', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_general_button_text',
		array(
			'label'   => esc_html__( 'Button Text:', 'regina-lite' ),
			'section' => $prefix . '_features_general',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_general_button_text', array(
		'selector' => '#services-block > .col-xs-12 > a.button',
	)
);

/* Button URL */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_general_button_url',
		array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_general_button_url',
		array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_features_general',
			'settings' => $prefix . '_features_general_button_url',
		)
	)
);

/***********************************************/
/************ FEATURE 1 SECTION ****************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_features_feature1',
	array(
		'title' => esc_html__( 'Feature #1', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Title */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature1_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Free Support', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_feature1_title',
		array(
			'label'   => esc_html__( 'Title:', 'regina-lite' ),
			'section' => $prefix . '_features_feature1',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature1_title', array(
		'selector' => '#services-block .service-1 h3',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature1_description',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_features_feature1_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_features_feature1',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature1_description', array(
		'selector' => '#services-block .service-1 p',
	)
);

$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature1_buttonurl',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_feature1_buttonurl',
		array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_features_feature1',
			'settings' => $prefix . '_features_feature1_buttonurl',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature1_buttonurl', array(
		'selector'            => '#services-block .service-1 a.link',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_feature1_link',
	)
);

/***********************************************/
/************ FEATURE 2 SECTION ****************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_features_feature2',
	array(
		'title' => esc_html__( 'Feature #2', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Title */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature2_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Medical Care', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_feature2_title',
		array(
			'label'   => esc_html__( 'Title:', 'regina-lite' ),
			'section' => $prefix . '_features_feature2',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature2_title', array(
		'selector' => '#services-block .service-2 h3',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature2_description',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_features_feature2_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_features_feature2',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature2_description', array(
		'selector' => '#services-block .service-2 p',
	)
);

$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature2_buttonurl',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_feature2_buttonurl',
		array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_features_feature2',
			'settings' => $prefix . '_features_feature2_buttonurl',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature2_buttonurl', array(
		'selector'            => '#services-block .service-2 a.link',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_feature2_link',
	)
);

/***********************************************/
/************ FEATURE 3 SECTION ****************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_features_feature3',
	array(
		'title' => esc_html__( 'Feature #3', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Title */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature3_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Life Care', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_feature3_title',
		array(
			'label'   => esc_html__( 'Title:', 'regina-lite' ),
			'section' => $prefix . '_features_feature3',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature3_title', array(
		'selector' => '#services-block .service-3 h3',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature3_description',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_features_feature3_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_features_feature3',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature3_description', array(
		'selector' => '#services-block .service-3 p',
	)
);

$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature3_buttonurl',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_feature3_buttonurl',
		array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_features_feature3',
			'settings' => $prefix . '_features_feature3_buttonurl',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature3_buttonurl', array(
		'selector'            => '#services-block .service-3 a.link',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_feature3_link',
	)
);

/***********************************************/
/************ FEATURE 4 SECTION ****************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_features_feature4',
	array(
		'title' => esc_html__( 'Feature #4', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Title */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature4_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Nervous System', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_feature4_title',
		array(
			'label'   => esc_html__( 'Title:', 'regina-lite' ),
			'section' => $prefix . '_features_feature4',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature4_title', array(
		'selector' => '#services-block .service-4 h3',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature4_description',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_features_feature4_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_features_feature4',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature4_description', array(
		'selector' => '#services-block .service-4 p',
	)
);

$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_features_feature4_buttonurl',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_features_feature4_buttonurl',
		array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_features_feature4',
			'settings' => $prefix . '_features_feature4_buttonurl',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_features_feature4_buttonurl', array(
		'selector'            => '#services-block .service-4 a.link',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_feature4_link',
	)
);
