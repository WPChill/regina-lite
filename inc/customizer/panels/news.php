<?php


/***********************************************/
/************** Latest News  ***************/
/***********************************************/

$wp_customize->add_panel( 'regina_lite_panel_news', array(
		'priority'       => 56,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Latest News Section', 'regina-lite' ),
	) );

$wp_customize->add_section( 'regina_lite_news_general', array(
		'title'    => esc_html__( 'Section Options', 'regina-lite' ),
		'priority' => 1,
		'panel'    => 'regina_lite_panel_news',
	) );


/* Section Title */
$wp_customize->add_setting( 'regina_lite_news_section_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( 'Latest news', 'regina-lite' ),
		'transport'         => 'postMessage',
	) );

$wp_customize->add_control( 'regina_lite_news_section_title', array(
		'label'    => esc_html__( 'Section title', 'regina-lite' ),
		'section'  => 'regina_lite_news_general',
		'priority' => 1,
	) );

/* Section Sub-Title */
$wp_customize->add_setting( 'regina_lite_news_section_sub_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( 'Straight from our blog', 'regina-lite' ),
		'transport'         => 'postMessage',
	) );

$wp_customize->add_control( 'regina_lite_news_section_sub_title', array(
		'label'    => esc_html__( 'Section sub-title', 'regina-lite' ),
		'section'  => 'regina_lite_news_general',
		'priority' => 2,
	) );

/* Number of post per slide */
$wp_customize->add_setting( 'regina_lite_news_section_no_posts_per_slide', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( '2', 'regina-lite' ),
		'transport'         => 'refresh',
	) );

$wp_customize->add_control( 'regina_lite_news_section_no_posts_per_slide', array(
		'label'   => esc_html__( 'Number of post per slide', 'regina-lite' ),
		'section' => 'regina_lite_news_general',
		'default' => esc_html( 4 ),
	) );
$wp_customize->add_control( 'regina_lite_news_section_no_posts_per_slide', array(
		'type'    => 'select',
		'choices' => array(
			'1' => esc_html( 1 ),
			'2' => esc_html( 2 ),
			'4' => esc_html( 4 ),
		),
		'label'   => esc_html__( 'Number of post per slide', 'regina-lite' ),
		'section' => 'regina_lite_news_general',
	) );