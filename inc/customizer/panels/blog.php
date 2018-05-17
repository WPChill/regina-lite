<?php

	// Set Panel ID
	$panel_id = 'regina_lite_panel_blog';

	// Set prefix
	$prefix = 'regina_lite';

	/***********************************************/
	/************** BLOG OPTIONS  ***************/
	/***********************************************/

	$wp_customize->add_panel(
		$panel_id, array(
			'priority'       => 29,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Blog Settings', 'regina-lite' ),
		)
	);

	$wp_customize->add_section(
		new Regina_Section_Upsell(
			$wp_customize, $prefix . '_blog_upsell', array(
				'panel'              => $panel_id,
				'priority'           => 0,
				'options'            => array(
					esc_html__( 'Categories Page Options', 'regina-lite' ),
					esc_html__( 'Tags Page Options', 'regina-lite' ),
					esc_html__( 'Author Page Options', 'regina-lite' ),
					esc_html__( 'Archives Page Options', 'regina-lite' ),
					esc_html__( 'Search Page Options', 'regina-lite' ),
				),
				'requirements'       => array(
					esc_html__( 'On the categories\' page you can select the layout of the page: with/without sidebar,  add a header image, enable or disable the breadcrumbs.', 'regina-lite' ),
					esc_html__( 'On the Tags\' page you can select the layout of the page: with/without sidebar,  add a header image, enable or disable the breadcrumbs.', 'regina-lite' ),
					esc_html__( 'On the Author\'s page you can select the layout of the page: with/without sidebar,  add a header image, enable or disable the breadcrumbs.', 'regina-lite' ),
					esc_html__( 'On the Archives\' page you can select the layout of the page: with/without sidebar,  add a header image, enable or disable the breadcrumbs.', 'regina-lite' ),
					esc_html__( 'On the Search\'s page you can select the layout of the page: with/without sidebar,  add a header image, enable or disable the breadcrumbs.', 'regina-lite' ),
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
		$prefix . '_single_post_section',
		array(
			'title'       => esc_html__( 'Single Post Options', 'regina-lite' ),
			'description' => esc_html__( 'Control various blog options from here. Most of the options from this panel refer to the blog single page view. If you\'re not familiar with that term, please perform a Google search.', 'regina-lite' ),
			'panel'       => $panel_id,
		)
	);

	/* Posted on on single blog posts */
	$wp_customize->add_setting(
		$prefix . '_enable_post_posted_on_blog_posts',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_enable_post_posted_on_blog_posts', array(
				'type'        => 'epsilon-toggle',
				'label'       => esc_html__( 'Posted on meta on single blog post', 'regina-lite' ),
				'description' => esc_html__( 'This will disable the posted on zone as well as the author name', 'regina-lite' ),
				'section'     => $prefix . '_single_post_section',
			)
		)
	);

	$wp_customize->selective_refresh->add_partial(
		$prefix . '_enable_post_posted_on_blog_posts', array(
			'selector' => '.single-post .entry-meta',
		)
	);

	/* Post Category on single blog posts */
	$wp_customize->add_setting(
		$prefix . '_enable_post_category_blog_posts',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_enable_post_category_blog_posts', array(
				'type'            => 'epsilon-toggle',
				'label'           => esc_html__( 'Category meta on single blog post', 'regina-lite' ),
				'description'     => esc_html__( 'This will disable the posted in zone.', 'regina-lite' ),
				'section'         => $prefix . '_single_post_section',
				'active_callback' => 'regina_lite_check_postmeta',
			)
		)
	);

	/* Post Tags on single blog posts */
	$wp_customize->add_setting(
		$prefix . '_enable_post_tags_blog_posts',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_enable_post_tags_blog_posts', array(
				'type'        => 'epsilon-toggle',
				'label'       => esc_html__( 'Tags meta on single blog post', 'regina-lite' ),
				'description' => esc_html__( 'This will disable the tagged with zone.', 'regina-lite' ),
				'section'     => $prefix . '_single_post_section',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		$prefix . '_enable_post_tags_blog_posts', array(
			'selector' => '.single-post ul.post-tags',
		)
	);

	/* Author Info Box on single blog posts */
	$wp_customize->add_setting(
		$prefix . '_enable_author_box_blog_posts',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_enable_author_box_blog_posts', array(
				'type'        => 'epsilon-toggle',
				'label'       => esc_html__( 'Author info box on single blog post', 'regina-lite' ),
				'description' => esc_html__( 'Displayed right at the end of the post', 'regina-lite' ),
				'section'     => $prefix . '_single_post_section',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		$prefix . '_enable_author_box_blog_posts', array(
			'selector' => '.single-post #post-author',
		)
	);

	/***********************************************/
	/************** Breadcrumb Settings  ***************/
	/***********************************************/
	$wp_customize->add_setting(
		$prefix . '_breadcrumb_text', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Regina_Text_Custom_Control(
			$wp_customize, $prefix . '_breadcrumb_text', array(
				'label'       => __( 'Breadcrumbs Settings', 'regina-lite' ),
				'description' => __( 'Settings related to breadcrumbs on single post', 'regina-lite' ),
				'section'     => $prefix . '_single_post_section',
			)
		)
	);

	/* Breadcrumbs on single blog posts */
	$wp_customize->add_setting(
		$prefix . '_enable_post_breadcrumbs',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_enable_post_breadcrumbs', array(
				'type'        => 'epsilon-toggle',
				'label'       => esc_html__( 'Breadcrumbs on single blog posts', 'regina-lite' ),
				'description' => esc_html__( 'This will disable the breadcrumbs', 'regina-lite' ),
				'section'     => $prefix . '_single_post_section',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		$prefix . '_enable_post_breadcrumbs', array(
			'selector' => '.single-post #breadcrumb',
		)
	);

	/* BreadCrumb Menu:  post category */
	$wp_customize->add_setting(
		$prefix . '_blog_breadcrumb_menu_post_category', array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 0,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_blog_breadcrumb_menu_post_category', array(
				'type'            => 'epsilon-toggle',
				'label'           => esc_html__( 'Show post category ?', 'regina-lite' ),
				'description'     => esc_html__( 'Show the post category in the breadcrumb ?', 'regina-lite' ),
				'section'         => $prefix . '_single_post_section',
				'active_callback' => 'regina_lite_check_breadcrumbs',
			)
		)
	);


	/***********************************************/
	/************** Related Blog Settings  ***************/
	/***********************************************/

	$wp_customize->add_setting(
		$prefix . '_related_post_text', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => '',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Regina_Text_Custom_Control(
			$wp_customize, $prefix . '_related_post_text', array(
				'label'       => __( 'Related Posts Settings', 'regina-lite' ),
				'description' => __( 'Control various related posts settings from here. For a demo-like experience, we recommend you don\'t change these settings.', 'regina-lite' ),
				'section'     => $prefix . '_single_post_section',
			)
		)
	);

	/*  related posts carousel */
	$wp_customize->add_setting(
		$prefix . '_enable_related_blog_posts', array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_enable_related_blog_posts', array(
				'type'        => 'epsilon-toggle',
				'label'       => esc_html__( 'Related posts carousel ?', 'regina-lite' ),
				'description' => esc_html__( 'Displayed after the author box', 'regina-lite' ),
				'section'     => $prefix . '_single_post_section',
			)
		)
	);
	$wp_customize->selective_refresh->add_partial(
		$prefix . '_enable_related_blog_posts', array(
			'selector' => '.single-post #related-posts',
		)
	);

	/* Number of related posts to display at once  */
	$wp_customize->add_setting(
		$prefix . '_howmany_blog_posts', array(
			'sanitize_callback' => 'absint',
			'default'           => 3,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Slider(
			$wp_customize, $prefix . '_howmany_blog_posts', array(
				'type'            => 'epsilon-slider',
				'label'           => esc_html__( 'How many blog posts to display in the carousel at once ?', 'regina-lite' ),
				'description'     => esc_html__( 'No more than 4 posts at once;', 'regina-lite' ),
				'choices'         => array(
					'min'  => 1,
					'max'  => 4,
					'step' => 1,
				),
				'section'         => $prefix . '_single_post_section',
				'default'         => 3,
				'active_callback' => 'regina_lite_check_related_posts',
			)
		)
	);

	/*  related posts title */
	$wp_customize->add_setting(
		$prefix . '_enable_related_title_blog_posts', array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_enable_related_title_blog_posts', array(
				'type'            => 'epsilon-toggle',
				'label'           => esc_html__( 'Show posts title in the carousel?', 'regina-lite' ),
				'section'         => $prefix . '_single_post_section',
				'active_callback' => 'regina_lite_check_related_posts',
			)
		)
	);

	/*  related posts date */
	$wp_customize->add_setting(
		$prefix . '_enable_related_date_blog_posts',
		array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_enable_related_date_blog_posts', array(
				'type'            => 'epsilon-toggle',
				'label'           => esc_html__( 'Show posts date  ?', 'regina-lite' ),
				'section'         => $prefix . '_single_post_section',
				'active_callback' => 'regina_lite_check_related_posts',
			)
		)
	);


	/* Auto play carousel */
	$wp_customize->add_setting(
		$prefix . '_autoplay_blog_posts', array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 1,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_autoplay_blog_posts', array(
				'type'            => 'epsilon-toggle',
				'label'           => esc_html__( 'Autoplay related carousel ?', 'regina-lite' ),
				'section'         => $prefix . '_single_post_section',
				'active_callback' => 'regina_lite_check_related_posts',
			)
		)
	);

	/* Display pagination ?  */
	$wp_customize->add_setting(
		$prefix . '_pagination_blog_posts', array(
			'sanitize_callback' => $prefix . '_sanitize_checkbox',
			'default'           => 0,
		)
	);
	$wp_customize->add_control(
		new Epsilon_Control_Toggle(
			$wp_customize, $prefix . '_pagination_blog_posts', array(
				'type'            => 'epsilon-toggle',
				'label'           => esc_html__( 'Display pagination controls ?', 'regina-lite' ),
				'description'     => esc_html__( 'Will be displayed as navigation bullets', 'regina-lite' ),
				'section'         => $prefix . '_single_post_section',
				'active_callback' => 'regina_lite_check_related_posts',
			)
		)
	);
