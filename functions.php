<?php
/**
 * regina-lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package regina-lite
 */

if ( ! function_exists( 'regina_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
	function regina_lite_setup() {
		/**
		 *	Require Once
		 */
		require_once( 'inc/components/nav-walker/class.mt-nav-walker.php' );
		require_once( 'inc/components/pagination/class.mt-pagination.php' );
		require_once( 'inc/components/author-box/class.mt-author-box.php' );
		require_once( 'inc/components/breadcrumb/class.mt-breadcrumb.php' );
		require_once( 'inc/components/entry-meta/class.mt-entry-meta.php' );
		require_once( 'inc/components/related-posts/class.mt-related-posts.php' );
		require_once( 'inc/components/contact-bar/class.mt-contact-bar.php' );
		require_once( 'inc/customizer/customizer.php' );

		require_once( 'inc/template-tags.php' );
		require_once( 'inc/extras.php' );
		require_once( 'inc/customizer/customizer.php' );
		require_once( 'inc/jetpack.php' );

		require_once( 'widgets/widget-recent-posts.php' );
		require_once( 'widgets/widget-categories.php' );
		require_once( 'widgets/widget-recent-comments.php' );
		require_once( 'widgets/widget-contact.php' );
		require_once( 'widgets/widget-address.php' );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on regina-lite, use a find and replace
		 * to change 'regina-lite' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'regina-lite', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 *	Custom Header
		 */
		$custom_header_args = array(
			'default-image'	=> get_template_directory_uri() . '/layout/images/page-headers/blog.jpg',
			'width'			=> '1682',
			'height'		=> '562'
		);
		add_theme_support( 'custom-header', $custom_header_args );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'	=> esc_html__( 'Primary Menu', 'regina-lite' ),
			'secondary'	=> esc_html__( 'Secondary Menu', 'regina-lite' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Add image sizes
		 * @link http://codex.wordpress.org/Function_Reference/add_image_size
		 */
		add_image_size( 'regina-lite-blog', 750, 419, true );
		add_image_size( 'regina-lite-related-posts', 230, 231, true );
	}
	add_action( 'after_setup_theme', 'regina_lite_setup' );
endif; // regina_lite_setup

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function regina_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'regina_lite_content_width', 750 );
}
add_action( 'after_setup_theme', 'regina_lite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function regina_lite_widgets_init() {
	// Blog Sidebar
	register_sidebar( array(
		'name'			=> esc_html__( 'Blog Sidebar', 'regina-lite' ),
		'id'			=> 'blog-sidebar',
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3>',
		'after_title'	=> '</h3>'
	) );

	// Footer Sidebar 1
	register_sidebar( array(
		'name'			=> esc_html__( 'Footer Sidebar 1', 'regina-lite' ),
		'id'			=> 'footer-sidebar-1',
		'before_widget'	=> '<div id="%1$s" class="block %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h6><small>',
		'after_title'	=> '</small></h6>'
	) );

	// Footer Sidebar 2
	register_sidebar( array(
		'name'			=> esc_html__( 'Footer Sidebar 2', 'regina-lite' ),
		'id'			=> 'footer-sidebar-2',
		'before_widget'	=> '<div id="%1$s" class="block %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h6><small>',
		'after_title'	=> '</small></h6>'
	) );

	// Footer Sidebar 3
	register_sidebar( array(
		'name'			=> esc_html__( 'Footer Sidebar 3', 'regina-lite' ),
		'id'			=> 'footer-sidebar-3',
		'before_widget'	=> '<div id="%1$s" class="block %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h6><small>',
		'after_title'	=> '</small></h6>'
	) );

	// Footer Sidebar 4
	register_sidebar( array(
		'name'			=> esc_html__( 'Footer Sidebar 4', 'regina-lite' ),
		'id'			=> 'footer-sidebar-4',
		'before_widget'	=> '<div id="%1$s" class="block %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h6><small>',
		'after_title'	=> '</small></h6>'
	) );
}
add_action( 'widgets_init', 'regina_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function regina_lite_scripts() {

	// Google Fonts
	$google_fonts_args = array(
		'family'	=> 'Lato:400,700|Montserrat:400,700'
	);

	// WP Register Style
	wp_register_style( 'google-fonts', add_query_arg( $google_fonts_args, "//fonts.googleapis.com/css" ), array(), null );

	// WP Enqueue Style
	//wp_enqueue_style( 'bxSlider-css', get_template_directory_uri() . '/layout/css/bxSlider.css', array(), 'all' );
    wp_enqueue_style( 'regina-lite-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'regina-lite-bootstrap', get_template_directory_uri() . '/layout/css/bootstrap.css', array(), '', 'all' );
	wp_enqueue_style( 'regina-lite-mobile', get_template_directory_uri() . '/layout/css/mobile.css', array(), '', 'all' );
	wp_enqueue_style( 'google-fonts' );

	// WP Enqueue Script
	wp_enqueue_script( 'regina-lite-jquery.bxslider.min', get_template_directory_uri() .'/layout/js/plugins/bxslider/jquery.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'regina-lite-jquery.lazyload.min', get_template_directory_uri() . '/layout/js/plugins/lazyload/jquery.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'regina-lite-jquery.waypoints.min', get_template_directory_uri() . '/layout/js/plugins/waypoints/jquery.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'regina-lite-navigation', get_template_directory_uri() . '/layout/js/plugins/navigation/navigation.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'regina-lite-skip-link-focus-fix', get_template_directory_uri() . '/layout/js/plugins/skip-link-focus-fix/skip-link-focus-fix.js', array( 'jquery' ), '20130115', true );
	wp_enqueue_script( 'regina-lite-custom', get_template_directory_uri() . '/layout/js/custom.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'regina_lite_scripts' );

#
# More Themes Functionality
#
if( !function_exists( 'regina_lite_more_themes_styles' ) ) {
    /**
     *
     */
    function regina_lite_more_themes_styles() {
        wp_enqueue_style('more-theme-style', get_template_directory_uri() . '/layout/css/more-themes.min.css');
    }
}

# Add upsell page to the menu.
if( !function_exists( 'regina_lite_add_upsell' ) ) {
    /**
     *
     */
    function regina_lite_lite_add_upsell() {

        $page = add_theme_page(
            __( 'More Themes', 'regina-lite' ),
            __( 'More Themes', 'regina-lite' ),
            'administrator',
            'macho-themes',
            'regina_lite_display_upsell'
        );

        add_action( 'admin_print_styles-' . $page, 'regina_lite_more_themes_styles' );
    }

    add_action( 'admin_menu', 'regina_lite_lite_add_upsell', 11 );
}


# Define markup for the upsell page.
if( !function_exists( 'regina_lite_display_upsell' ) ) {
    function regina_lite_display_upsell() {

        // Set template directory uri
        $directory_uri = get_template_directory_uri();
        ?>
        <div class="wrap">
            <div class="container-fluid">
                <div id="upsell_container">
                    <div class="row">
                        <div id="upsell_header" class="col-md-12">

                            <a href="http://www.machothemes.com/" target="_blank">
                                <img
                                    src="<?php echo get_template_directory_uri(); ?>/layout/images/upsell/macho-themes-logo.png"/>
                            </a>



                            <h3><?php echo __( 'Simple. Powerful. Flexible. That\'s how we at', 'regina-lite'). sprintf('<a href="%s" target=="_blank" rel="nofollow">', 'http://www.machothemes.com'). __(' Macho Themes', 'regina-lite'). '</a>'. __(' build all of our themes.', 'regina-lite' ); ?></h3>

                        </div>
                    </div>
                    <div id="upsell_themes" class="row">
                        <?php

                        // Set the argument array with author name.
                        $args = array(
                            'author' => 'cristianraiber-1',
                        );

                        // Set the $request array.
                        $request = array(
                            'body' => array(
                                'action'  => 'query_themes',
                                'request' => serialize( (object) $args )
                            )
                        );

                        $themes       = regina_lite_get_themes( $request );
                        $active_theme = wp_get_theme()->get( 'Name' );
                        $counter      = 1;

                        // For currently active theme.
                        foreach ( $themes->themes as $theme ) {
                            if ( $active_theme == $theme->name ) { ?>

                                <div id="<?php echo $theme->slug; ?>" class="theme-container col-md-6 col-lg-4">
                                    <div class="image-container">
                                        <img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"/>

                                        <div class="theme-description">
                                            <p><?php echo $theme->description; ?></p>
                                        </div>
                                    </div>
                                    <div class="theme-details active">
											<span
                                                class="theme-name"><?php echo $theme->name . ':' . __( ' Current theme', 'regina-lite' ); ?></span>
                                        <a class="button button-secondary customize right" target="_blank"
                                           href="<?php echo get_site_url() . '/wp-admin/customize.php' ?>"><?php _e( 'Customize', 'regina-lite' ); ?></a>
                                    </div>
                                </div>

                                <?php
                                $counter ++;
                                break;
                            }
                        }

                        // For all other themes.
                        foreach ( $themes->themes as $theme ) {
                            if ( $active_theme != $theme->name ) {

                                // Set the argument array with author name.
                                $args = array(
                                    'slug' => $theme->slug,
                                );

                                // Set the $request array.
                                $request = array(
                                    'body' => array(
                                        'action'  => 'theme_information',
                                        'request' => serialize( (object) $args )
                                    )
                                );

                                $theme_details = regina_lite_get_themes( $request );
                                ?>

                                <div id="<?php echo $theme->slug; ?>"
                                     class="theme-container col-md-6 col-lg-4 <?php echo $counter % 3 == 1 ? 'no-left-megin' : ""; ?>">
                                    <div class="image-container">
                                        <img class="theme-screenshot" src="<?php echo $theme->screenshot_url ?>"/>

                                        <div class="theme-description">
                                            <p><?php echo $theme->description; ?></p>
                                        </div>
                                    </div>
                                    <div class="theme-details">
                                        <span class="theme-name"><?php echo $theme->name; ?></span>

                                        <!-- Check if the theme is installed -->
                                        <?php if ( wp_get_theme( $theme->slug )->exists() ) { ?>

                                            <!-- Activate Button -->
                                            <a class="button button-primary activate right"
                                               href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug ); ?>">Activate</a>
                                        <?php } else {

                                            // Set the install url for the theme.
                                            $install_url = add_query_arg( array(
                                                'action' => 'install-theme',
                                                'theme'  => $theme->slug,
                                            ), self_admin_url( 'update.php' ) );
                                            ?>
                                            <!-- Install Button -->
                                            <a data-toggle="tooltip" data-placement="bottom"
                                               title="<?php echo 'Downloaded ' . number_format( $theme_details->downloaded ) . ' times'; ?>"
                                               class="button button-primary install right"
                                               href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>"><?php _e( 'Install Now', 'regina-lite' ); ?></a>
                                        <?php } ?>

                                        <!-- Preview button -->
                                        <a class="button button-secondary preview right" target="_blank"
                                           href="<?php echo $theme->preview_url; ?>"><?php _e( 'Live Preview', 'regina-lite' ); ?></a>
                                    </div>
                                </div>
                                <?php
                                $counter ++;
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }
}

# Get all Macho Themes themes by using WP API.
if( !function_exists( 'regina_lite_get_themes' ) ) {
    function regina_lite_get_themes( $request ) {

        // Generate a cache key that would hold the response for this request:
        $key = 'riba-lite_' . md5( serialize( $request ) );

        // Check transient. If it's there - use that, if not re fetch the theme
        if ( false === ( $themes = get_transient( $key ) ) ) {

            // Transient expired/does not exist. Send request to the API.
            $response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

            // Check for the error.
            if ( ! is_wp_error( $response ) ) {

                $themes = unserialize( wp_remote_retrieve_body( $response ) );


                if ( ! is_object( $themes ) && ! is_array( $themes ) ) {

                    // Response body does not contain an object/array
                    return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
                }

                // Set transient for next time... keep it for 24 hours should be good
                set_transient( $key, $themes, 60 * 60 * 24 );
            } else {
                // Error object returned
                return $response;
            }
        }

        return $themes;
    }
}