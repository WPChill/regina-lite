<?php
// Set Panel ID
$panel_id = 'regina_lite_ourteam_panel';

// Set Prefix
$prefix = 'regina_lite';

/***********************************************/
/****************** OUR TEAM *******************/
/***********************************************/
$wp_customize->add_panel(
	new Regina_Custom_Panel(
		$wp_customize, $panel_id, array(
			'priority'       => 30,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Our Team', 'regina-lite' ),
			'description'    => esc_html__( 'Control all the Team Section settings from this panel. Adding more members to the team is a PRO feature only.', 'regina-lite' ),
			'panel'          => 'regina_lite_frontpage_sections',
		)
	)
);

/***********************************************/
/************ GENERAL SECTION ******************/
/***********************************************/


$wp_customize->add_section(
	$prefix . '_ourteam_general', array(
		'title' => esc_html__( 'General', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

// Upsell
$wp_customize->add_section(
	new Regina_Section_Upsell(
		$wp_customize, $prefix . '_ourteam_pro', array(
			'panel'              => $panel_id,
			'options'            => array(
				esc_html__( 'Unlimited Members', 'regina-lite' ),
			),
			'requirements'       => array(
				esc_html__( 'In Regina PRO you can add how many members you want.', 'regina-lite' ),
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
		$wp_customize, $prefix . '_ourteam_general_show',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Toggle(
		$wp_customize, $prefix . '_ourteam_general_show', array(
			'type'    => 'epsilon-toggle',
			'label'   => esc_html__( 'Show this section?', 'regina-lite' ),
			'section' => $prefix . '_ourteam_general',
		)
	)
);

/* Title */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_general_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Our team can help you!', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_general_title',
		array(
			'label'   => esc_html__( 'Title:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_general',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_general_title', array(
		'selector' => '#team-section-block .section-info h2',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_general_description',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_ourteam_general_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_general',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_general_description', array(
		'selector' => '#team-section-block .section-info p',
	)
);

/***********************************************/
/************ TEAM MEMBER 1 SECTION ************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_ourteam_teammember1',
	array(
		'title' => esc_html__( 'Team Member #1', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Image */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember1_image', array(
			'default'           => get_template_directory_uri() . '/layout/images/team/team-member-1.jpg',
			'sanitize_callback' => 'esc_url',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_ourteam_teammember1_image', array(
			'label'    => __( 'Image:', 'regina-lite' ),
			'section'  => $prefix . '_ourteam_teammember1',
			'settings' => $prefix . '_ourteam_teammember1_image',
		)
	)
);


/* Name */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember1_name',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Dr. Steve Leeson', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember1_name',
		array(
			'label'   => esc_html__( 'Name:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember1',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember1_name', array(
		'selector' => '#team-block .member-1 .name',
	)
);

/* Position */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember1_position',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember1_position',
		array(
			'label'   => esc_html__( 'Position:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember1',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember1_position', array(
		'selector' => '#team-block .member-1 .position',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember1_description',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Dr. Steve Leeson was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_ourteam_teammember1_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember1',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember1_description', array(
		'selector' => '#team-block .member-1 .hover .description p',
	)
);

/* Button URL */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember1_buttonurl',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember1_buttonurl',
		array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_ourteam_teammember1',
			'settings' => $prefix . '_ourteam_teammember1_buttonurl',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember1_buttonurl', array(
		'selector'            => '#team-block .member-1 .hover .read-more a',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_member1_link',
	)
);

/***********************************************/
/************ TEAM MEMBER 2 SECTION ************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_ourteam_teammember2',
	array(
		'title' => esc_html__( 'Team Member #2', 'regina-lite' ),
		//'description' => esc_html__( 'Team Member #2 Section description.', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Image */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember2_image', array(
			'default'           => get_template_directory_uri() . '/layout/images/team/team-member-2.jpg',
			'sanitize_callback' => 'esc_url',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_ourteam_teammember2_image', array(
			'label'    => __( 'Image:', 'regina-lite' ),
			'section'  => $prefix . '_ourteam_teammember2',
			'settings' => $prefix . '_ourteam_teammember2_image',
		)
	)
);

/* Name */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember2_name',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Dr. Amanda Riss', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember2_name',
		array(
			'label'   => esc_html__( 'Name:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember2',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember2_name', array(
		'selector' => '#team-block .member-2 .name',
	)
);

/* Position */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember2_position',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember2_position',
		array(
			'label'   => esc_html__( 'Position:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember2',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember2_position', array(
		'selector' => '#team-block .member-2 .position',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember2_description',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Dr. Amanda Riss was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_ourteam_teammember2_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember2',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember2_description', array(
		'selector' => '#team-block .member-2 .hover .description p',
	)
);

/* Button URL */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember2_buttonurl',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember2_buttonurl',
		array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_ourteam_teammember2',
			'settings' => $prefix . '_ourteam_teammember2_buttonurl',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember2_buttonurl', array(
		'selector'            => '#team-block .member-2 .hover .read-more a',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_member2_link',
	)
);

/***********************************************/
/************ TEAM MEMBER 3 SECTION ************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_ourteam_teammember3',
	array(
		'title' => esc_html__( 'Team Member #3', 'regina-lite' ),
		//'description' => esc_html__( 'Team Member #3 Section description.', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Image */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember3_image', array(
			'default'           => get_template_directory_uri() . '/layout/images/team/team-member-3.jpg',
			'sanitize_callback' => 'esc_url',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_ourteam_teammember3_image', array(
			'label'    => __( 'Image:', 'regina-lite' ),
			'section'  => $prefix . '_ourteam_teammember3',
			'settings' => $prefix . '_ourteam_teammember3_image',
		)
	)
);

/* Name */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember3_name',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Dr. Mick Harold', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember3_name',
		array(
			'label'   => esc_html__( 'Name:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember3',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember3_name', array(
		'selector' => '#team-block .member-3 .name',
	)
);

/* Position */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember3_position',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember3_position',
		array(
			'label'   => esc_html__( 'Position:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember3',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember3_position', array(
		'selector' => '#team-block .member-3 .position',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember3_description',
		array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Dr. Mick Harold was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_ourteam_teammember3_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember3',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember3_description', array(
		'selector' => '#team-block .member-3 .hover .description p',
	)
);

/* Button URL */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember3_buttonurl',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember3_buttonurl',
		array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_ourteam_teammember3',
			'settings' => $prefix . '_ourteam_teammember3_buttonurl',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember3_buttonurl', array(
		'selector'            => '#team-block .member-3 .hover .read-more a',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_member3_link',
	)
);

/***********************************************/
/************ TEAM MEMBER 4 SECTION ************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_ourteam_teammember4',
	array(
		'title' => esc_html__( 'Team Member #4', 'regina-lite' ),
		//'description' => esc_html__( 'Team Member #4 Section description.', 'regina-lite' ),
		'panel' => $panel_id,
	)
);

/* Image */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember4_image', array(
			'default'           => get_template_directory_uri() . '/layout/images/team/team-member-4.jpg',
			'sanitize_callback' => 'esc_url',
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Upload(
		$wp_customize, $prefix . '_ourteam_teammember4_image', array(
			'label'    => __( 'Image:', 'regina-lite' ),
			'section'  => $prefix . '_ourteam_teammember4',
			'settings' => $prefix . '_ourteam_teammember4_image',
		)
	)
);

/* Name */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember4_name',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Dr. Jenna Crew', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember4_name',
		array(
			'label'   => esc_html__( 'Name:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember4',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember4_name', array(
		'selector' => '#team-block .member-4 .name',
	)
);

/* Position */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember4_position',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Cardiac Clinic, Primary Healthcare', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember4_position',
		array(
			'label'   => esc_html__( 'Position:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember4',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember4_position', array(
		'selector' => '#team-block .member-4 .position',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember4_description', array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'Dr. Jenna Crew was born and raised in Texas, USA. He received a Bachelor of Science degree in Chemistry from the University of Houston and a...', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_ourteam_teammember4_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_ourteam_teammember4',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember4_description', array(
		'selector' => '#team-block .member-4 .hover .description p',
	)
);

/* Button URL */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_ourteam_teammember4_buttonurl',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_ourteam_teammember4_buttonurl',
		array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_ourteam_teammember4',
			'settings' => $prefix . '_ourteam_teammember4_buttonurl',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_ourteam_teammember4_buttonurl', array(
		'selector'            => '#team-block .member-4 .hover .read-more a',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_member4_link',
	)
);
