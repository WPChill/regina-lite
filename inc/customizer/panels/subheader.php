<?php
// Set Panel ID
$panel_id = 'regina_lite_subheader_panel';

// Set Prefix
$prefix = 'regina_lite';

/***********************************************/
/************** SUBHEADER **********************/
/***********************************************/
$wp_customize->add_panel( $panel_id,
	array(
		'priority'			=> 50,
		'capability'		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'				=> esc_html__( 'Subheader Panel', 'regina-lite' ),
		'description'		=> esc_html__( 'Subheader Panel description.', 'regina-lite' ),
	)
);

/***********************************************/
/**************** IMAGES SECTION ***************/
/***********************************************/
$wp_customize->add_section( $prefix.'_subheader_images' ,
    array(
        'title'       => esc_html__( 'Images', 'regina-lite' ),
        'description' => esc_html__( 'Images Section description.', 'regina-lite' ),
        'panel' 	  => $panel_id
    )
);

/* Show this section? */
$wp_customize->add_setting( $prefix.'_subheader_images_show',
    array(
        'sanitize_callback'	=> $prefix.'_sanitize_checkbox',
        'default'			=> 1
    )
);
$wp_customize->add_control(
    $prefix.'_subheader_images_show',
    array(
        'type'			=> 'checkbox',
        'label'			=> esc_html__('Show this section?', 'regina-lite'),
        'description'	=> esc_html__('Subheader Images Show description.', 'regina-lite'),
        'section'		=> $prefix.'_subheader_images',
    )
);

/* Image 1 */
$wp_customize->add_setting( $prefix . '_subheader_images_image1', array( 'default' => get_template_directory_uri() . '/layout/images/home/slide-1.jpg', 'sanitize_callback' => 'esc_url' ) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $prefix . '_subheader_images_image1', array(
    'label'    => __( 'Image #1:', 'regina-lite' ),
    'section'  => $prefix.'_subheader_images',
    'settings' => $prefix . '_subheader_images_image1',
) ) );

/***********************************************/
/**************** BOX **************************/
/***********************************************/
$wp_customize->add_section( $prefix.'_subheader_box' ,
    array(
        'title'       => esc_html__( 'Box', 'regina-lite' ),
        'description' => esc_html__( 'Box Section description.', 'regina-lite' ),
        'panel' 	  => $panel_id
    )
);

/* Show this section? */
$wp_customize->add_setting( $prefix.'_subheader_box_show',
    array(
        'sanitize_callback'	=> $prefix.'_sanitize_checkbox',
        'default'			=> 1
    )
);
$wp_customize->add_control(
    $prefix.'_subheader_box_show',
    array(
        'type'			=> 'checkbox',
        'label'			=> esc_html__('Show this section?', 'regina-lite'),
        'description'	=> esc_html__('Subheader Images Show description.', 'regina-lite'),
        'section'		=> $prefix.'_subheader_box',
    )
);

/* Title */
$wp_customize->add_setting($prefix.'_subheader_box_title',
    array(
        'sanitize_callback'	=> 'sanitize_text_field',
        'default'			=> __( 'We help people, like you.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_subheader_box_title',
    array(
        'label'			=> esc_html__('Title:', 'regina-lite'),
        'description'	=> esc_html__('Title description,','regina-lite'),
        'section'		=> $prefix.'_subheader_box',
    )
);

/* Description */
$wp_customize->add_setting($prefix.'_subheader_box_description',
    array(
        'sanitize_callback'	=> 'sanitize_text_field',
        'default'			=> __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'regina-lite' )
    )
);
$wp_customize->add_control(
    $prefix.'_subheader_box_description',
    array(
        'label'			=> esc_html__('Description:', 'regina-lite'),
        'description'	=> esc_html__('Description description,','regina-lite'),
        'section'		=> $prefix.'_subheader_box',
        'type'			=> 'textarea'
    )
);

$wp_customize->add_setting( $prefix.'_subheader_box_bookappointmenturl',
	array(
		'sanitize_callback'	=> 'esc_url',
		'default'			=> esc_url('#')
	)
);

$wp_customize->add_control( $prefix.'_subheader_box_bookappointmenturl',
	array(
		'label'			=> esc_html__( 'Book Aappointment URL:', 'regina-lite' ),
		'description'	=> esc_html__('Book Aappointment URL description.', 'regina-lite'),
		'section'		=> $prefix.'_subheader_box',
		'settings'		=> $prefix.'_subheader_box_bookappointmenturl',
	)
);
?>