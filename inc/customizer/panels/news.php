<?php


/***********************************************/
/************** Latest News  ***************/
/***********************************************/


$wp_customize->add_section(
	'regina_lite_news_general', array(
		'title'       => esc_html__( 'Latest News', 'regina-lite' ),
		'description' => esc_html__( 'Latest News Section is displayed as a slider on the homepage. Controls from this section are applied to that slider.', 'regina-lite' ),
		'priority'    => 60,
		'panel'       => 'regina_lite_frontpage_sections',
	)
);

/* Show this section? */
$wp_customize->add_setting(
	$prefix . '_latest_news_show',
	array(
		'sanitize_callback' => $prefix . '_sanitize_checkbox',
		'default'           => 1,
	)
);
$wp_customize->add_control(
	new Epsilon_Control_Toggle(
		$wp_customize, $prefix . '_latest_news_show', array(
			'type'    => 'epsilon-toggle',
			'label'   => esc_html__( 'Show this section?', 'regina-lite' ),
			'section' => 'regina_lite_news_general',
		)
	)
);


/* Section Title */
$wp_customize->add_setting(
	'regina_lite_news_section_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( 'Latest news', 'regina-lite' ),
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'regina_lite_news_section_title', array(
		'label'   => esc_html__( 'Section title', 'regina-lite' ),
		'section' => 'regina_lite_news_general',
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_news_section_title', array(
		'selector' => '#section-news .section-info h2',
	)
);

/* Section Sub-Title */
$wp_customize->add_setting(
	'regina_lite_news_section_sub_title', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => esc_html__( 'Straight from our blog', 'regina-lite' ),
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_control(
	'regina_lite_news_section_sub_title', array(
		'label'   => esc_html__( 'Section sub-title', 'regina-lite' ),
		'section' => 'regina_lite_news_general',
	)
);
$wp_customize->selective_refresh->add_partial(
	$prefix . '_news_section_sub_title', array(
		'selector' => '#section-news .section-info p',
	)
);

/* Number of post per slide */
$wp_customize->add_setting(
	'regina_lite_news_section_no_posts_per_slide', array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => 4,
		'transport'         => 'refresh',
	)
);

$wp_customize->add_control(
	new Epsilon_Control_Slider(
		$wp_customize, 'regina_lite_news_section_no_posts_per_slide', array(
			'type'    => 'epsilon-slider',
			'choices' => array(
				'min'  => 1,
				'max'  => 4,
				'step' => 1,
			),
			'label'   => esc_html__( 'Number of post per slide', 'regina-lite' ),
			'section' => 'regina_lite_news_general',
		)
	)
);
