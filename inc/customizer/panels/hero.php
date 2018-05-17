<?php
// Set Panel ID
$panel_id = 'regina_lite_hero_panel';

// Set Prefix
$prefix = 'regina_lite';

$wp_customize->add_section(
	$panel_id, array(
		'title'    => esc_html__( 'Hero Section', 'regina-lite' ),
		'panel'    => 'regina_lite_frontpage_sections',
		'priority' => 10,
	)
);

$hero_image = $wp_customize->get_control( 'header_image' );
if ( $hero_image ) {
	$hero_image->section = $panel_id;
}

/* Show this section? */
$wp_customize->add_setting(
	$prefix . '_top_box_show',
	array(
		'sanitize_callback' => $prefix . '_sanitize_checkbox',
		'default'           => 1,
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Toggle(
		$wp_customize, $prefix . '_top_box_show', array(
			'type'    => 'epsilon-toggle',
			'label'   => esc_html__( 'Show the blue box?', 'regina-lite' ),
			'section' => $panel_id,
		)
	)
);

/* Title */
$wp_customize->add_setting(
	$prefix . '_top_box_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => __( 'We help people, like you.', 'regina-lite' ),
	)
);
$wp_customize->add_control(
	$prefix . '_top_box_title', array(
		'label'           => esc_html__( 'Title:', 'regina-lite' ),
		'section'         => $panel_id,
		'active_callback' => 'regina_lite_check_blue_box',
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_top_box_title', array(
		'selector' => '#call-out h1',
	)
);

/* Description */
$wp_customize->add_setting(
	$prefix . '_top_box_description', array(
		'sanitize_callback' => 'wp_kses_post',
		'default'           => __( 'Our team of specialists is ready to help you. Book an appointment now!', 'regina-lite' ),
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Text_Editor(
		$wp_customize, $prefix . '_top_box_description', array(
			'label'           => esc_html__( 'Description:', 'regina-lite' ),
			'section'         => $panel_id,
			'active_callback' => 'regina_lite_check_blue_box',
		)
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_top_box_description', array(
		'selector' => '#call-out p',
	)
);

$wp_customize->add_setting(
	$prefix . '_top_box_bookappointmenturl', array(
		'sanitize_callback' => 'esc_url',
		'default'           => esc_url( '#' ),
	)
);

$wp_customize->add_control(
	$prefix . '_top_box_bookappointmenturl',
	array(
		'label'           => esc_html__( 'Book Aappointment URL:', 'regina-lite' ),
		'description'     => esc_html__( 'Tip: Use full URLs here instead of relative ones.', 'regina-lite' ),
		'section'         => $panel_id,
		'settings'        => $prefix . '_top_box_bookappointmenturl',
		'active_callback' => 'regina_lite_check_blue_box',
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_top_box_bookappointmenturl', array(
		'selector'            => '#call-out a.button',
		'container_inclusive' => true,
		'render_callback'     => 'pixova_render_appointment_link',
	)
);
