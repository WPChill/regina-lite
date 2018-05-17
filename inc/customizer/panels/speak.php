<?php
// Set Panel ID
$panel_id = 'regina_lite_speak_panel';

// Set Prefix
$prefix = 'regina_lite';


/***********************************************/
/************ GENERAL SECTION *******************/
/***********************************************/
$wp_customize->add_section(
	$prefix . '_speak_general',
	array(
		'title'       => esc_html__( 'Speak With Our Doctors', 'regina-lite' ),
		'description' => esc_html__( 'This section is mostly used as a final call-to-action. Be mindful of the text you enter here and make sure they\'re phrased in such a way that they draw attention.', 'regina-lite' ),
		'priority'    => 50,
		'panel'       => 'regina_lite_frontpage_sections',
	)
);

/* Show this section? */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_speak_general_show',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Toggle(
		$wp_customize, $prefix . '_speak_general_show', array(
			'type'    => 'epsilon-toggle',
			'label'   => esc_html__( 'Show this section?', 'regina-lite' ),
			//'description'   => esc_html__('Speak Show description.', 'regina-lite'),
			'section' => $prefix . '_speak_general',
		)
	)
);

/* Title */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_speak_general_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => __( 'Speak with our doctors', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_speak_general_title',
		array(
			'label'   => esc_html__( 'Title:', 'regina-lite' ),
			//'description'   => esc_html__('Title description.','regina-lite'),
			'section' => $prefix . '_speak_general',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_speak_general_title', array(
		'selector' => '#speak-with-our-doctors .section-info h2',
	)
);

/* Description */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_speak_general_description', array(
			'sanitize_callback' => 'wp_kses_post',
			'default'           => __( 'We offer various services lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.', 'regina-lite' ),
		)
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_speak_general_description', array(
			'label'   => esc_html__( 'Description:', 'regina-lite' ),
			'section' => $prefix . '_speak_general',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_speak_general_description', array(
		'selector' => '#speak-with-our-doctors .section-info p',
	)
);

/* Button URL */
$wp_customize->add_setting(
	new Regina_Custom_Setting(
		$wp_customize, $prefix . '_speak_general_buttonurl',
		array(
			'sanitize_callback' => 'esc_url',
			'default'           => esc_url( '#' ),
		)
	)
);
$wp_customize->add_control(
	new Regina_Custom_Control(
		$wp_customize, $prefix . '_speak_general_buttonurl', array(
			'label'    => esc_html__( 'Button URL:', 'regina-lite' ),
			'section'  => $prefix . '_speak_general',
			'settings' => $prefix . '_speak_general_buttonurl',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_speak_general_buttonurl', array(
		'selector'            => '#speak-with-our-doctors .section-info a',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_spd_link',
	)
);
