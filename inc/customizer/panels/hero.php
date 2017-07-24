<?php
// Set Panel ID
$panel_id = 'regina_lite_hero_panel';

// Set Prefix
$prefix = 'regina_lite';

$wp_customize->add_panel( new Regina_Custom_Panel( $wp_customize, $panel_id, array(
	'priority'          => 1,
	'capability'        => 'edit_theme_options',
	'theme_supports'    => '',
	'title'             => esc_html__( 'Hero Section', 'regina-lite' ),
	'panel' => 'regina_lite_frontpage_sections',
) ) );

// Change panel for Header Image
$hero_image = $wp_customize->get_section( 'header_image' );
if ( $hero_image ) {
	$hero_image->panel = 'regina_lite_hero_panel';
	$hero_image->priority = 1;
	$hero_image->title = esc_html__( 'Hero Image', 'regina-lite' );
}


/***********************************************/
/**************** BOX **************************/
/***********************************************/
$wp_customize->add_section( $prefix . '_top_box', array(
	'title'       => esc_html__( 'Blue Box on Hero Image', 'regina-lite' ),
	'description' => esc_html__( 'Use this section for your main call-to-action text.', 'regina-lite' ),
	'panel'       => $panel_id,
) );

/* Show this section? */
$wp_customize->add_setting( $prefix . '_top_box_show',
	array(
		'sanitize_callback' => $prefix . '_sanitize_checkbox',
		'default'           => 1,
	)
);
$wp_customize->add_control( new Epsilon_Control_Toggle( $wp_customize, $prefix . '_top_box_show', array(
	'type'          => 'epsilon-toggle',
	'label'         => esc_html__( 'Show the blue box?', 'regina-lite' ),
	'section'       => $prefix . '_top_box',
) ) );

/* Title */
$wp_customize->add_setting($prefix . '_top_box_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => __( 'We help people, like you.', 'regina-lite' ),

	)
);
$wp_customize->add_control(
	$prefix . '_top_box_title',
	array(
		'label'         => esc_html__( 'Title:', 'regina-lite' ),
		'section'       => $prefix . '_top_box',
	)
);
$wp_customize->selective_refresh->add_partial( $prefix . '_top_box_title', array(
	'selector' => '#call-out h1',
) );

/* Description */
$wp_customize->add_setting($prefix . '_top_box_description', array(
	'sanitize_callback' => 'wp_kses_post',
	'default'           => __( 'Our team of specialists is ready to help you. Book an appointment now!', 'regina-lite' ),
) );
$wp_customize->add_control( new Epsilon_Control_Text_Editor( $wp_customize, $prefix . '_top_box_description', array(
	'label'         => esc_html__( 'Description:', 'regina-lite' ),
	'section'       => $prefix . '_top_box',
) ) );
$wp_customize->selective_refresh->add_partial( $prefix . '_top_box_description', array(
	'selector' => '#call-out p',
) );

$wp_customize->add_setting( $prefix . '_top_box_bookappointmenturl', array(
	'sanitize_callback' => 'esc_url',
	'default'           => esc_url( '#' ),
) );

$wp_customize->add_control( $prefix . '_top_box_bookappointmenturl',
	array(
		'label'         => esc_html__( 'Book Aappointment URL:', 'regina-lite' ),
		'description'   => esc_html__( 'Tip: Use full URLs here instead of relative ones.', 'regina-lite' ),
		'section'       => $prefix . '_top_box',
		'settings'      => $prefix . '_top_box_bookappointmenturl',
	)
);
$wp_customize->selective_refresh->add_partial( $prefix . '_top_box_bookappointmenturl', array(
	'selector' => '#call-out a.button',
	'container_inclusive' => true,
	'render_callback' => 'pixova_render_appointment_link',
) );
