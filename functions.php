<?php
/**
 * regina-lite functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
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
		 *    Require Once
		 */
		require_once( 'inc/components/nav-walker/class-mtl-extended-menu-walker.php' );
		require_once( 'inc/components/pagination/class-mtl-pagination-output.php' );
		require_once( 'inc/components/author-box/class-mtl-author-box-output.php' );
		require_once( 'inc/components/breadcrumb/class-regina-breadcrumbs.php' );
		require_once( 'inc/components/entry-meta/class-mtl-entry-meta-output.php' );
		require_once( 'inc/components/related-posts/class-mtl-related-posts-output.php' );
		require_once( 'inc/components/contact-bar/class-mtl-contact-bar-output.php' );
		require_once( 'inc/customizer/customizer.php' );

		require_once( 'inc/template-tags.php' );
		require_once( 'inc/extras.php' );
		require_once( 'inc/customizer/class-regina-lite-helper.php' );
		require_once( 'inc/customizer/customizer-active-callbacks.php' );
		require_once( 'inc/customizer/customizer.php' );
		require_once( 'inc/jetpack.php' );

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
		 *    Custom Header
		 */
		$custom_header_args = array(
			'default-image' => get_template_directory_uri() . '/layout/images/home/slide-1.jpg',
			'width'         => '1920',
			'height'        => '560',
			'header-text'   => false,
		);
		add_theme_support( 'custom-header', $custom_header_args );

		// Custom Background
		$custom_background_args = array(
			'default-color'      => '#fff',
			'default-image'      => false,
			'default-repeat'     => false,
			'default-position-x' => false,
			'default-attachment' => false,
		);
		add_theme_support( 'custom-background', $custom_background_args );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'   => esc_html__( 'Primary Menu', 'regina-lite' ),
				'secondary' => esc_html__( 'Secondary Menu', 'regina-lite' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Add selective refresh
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Add image sizes
		 * @link http://codex.wordpress.org/Function_Reference/add_image_size
		 */
		add_image_size( 'regina-lite-blog', 750, 419, true );
		add_image_size( 'regina-lite-related-posts', 230, 231, true );
		add_image_size( 'regina-lite-homepage-blog-posts', 250, 250, true );
		add_image_size( 'regina-lite-slider-image-sizes', 1682, 560, true );

		/**
		 *  Next compatible
		 */
		require get_template_directory() . '/inc/next-compatible.php';

		/*******************************************/
		/*************  Welcome screen *************/
		/*******************************************/

		if ( is_admin() ) {

			global $regina_required_actions, $regina_recommended_plugins;
			require_once get_template_directory() . '/inc/libraries/class-regina-notify-system.php';
			require_once get_template_directory() . '/inc/libraries/welcome-screen/inc/class-epsilon-import-data.php';

			$regina_recommended_plugins = array(
				'kiwi-social-share'        => array(
					'recommended' => false,
				),
				'modula-best-grid-gallery' => array(
					'recommended' => true,
				),
				'simple-author-box'        => array(
					'recommended' => true,
				),
			);

			/**
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 *
			 */
			$regina_required_actions = array(
				array(
					'id'          => 'regina-lite-import-data',
					'title'       => esc_html__( 'Easy 1-click theme setup', 'regina-lite' ),
					'description' => esc_html__( 'Clicking the button below will add settings/widgets and recommended plugins to your WordPress installation. Click advanced to customize the import process.', 'regina-lite' ),
					'help'        => array( Epsilon_Import_Data::get_instance(), 'generate_import_data_container' ),
					'check'       => Regina_Notify_System::check_installed_data(),
				),
				array(
					'id'          => 'regina-lite-fix-homepage',
					'title'       => esc_html__( 'Fix Homepage', 'regina-lite' ),
					'description' => esc_html__( 'We have made some changes to how the Homepage works in Regina. Now you need to create a page and use the "Homepage Template" and set it as a static front page. You can also make this automatically by pushing the button below.', 'regina-lite' ),
					'help'        => '<p><a id="regina-fix-homepage" href="#" class="button button-primary" style="text-decoration: none;"> ' . esc_html__( 'Fix Homepage', 'epsilon-framework' ) . '</a><span class="spinner" style="float:none"></span></p>',
					'check'       => Regina_Notify_System::show_fix_action(),
				),
			);

			if ( is_customize_preview() ) {
				$url                                = 'themes.php?page=%1$s-welcome&tab=%2$s';
				$regina_required_actions[0]['help'] = '<a class="button button-primary" id="" href="' . esc_url( admin_url( sprintf( $url, 'regina', 'recommended-actions' ) ) ) . '">' . __( 'Easy 1-click theme setup', 'regina-lite' ) . '</a>';
			}

			require get_template_directory() . '/inc/libraries/welcome-screen/class-regina-welcome-screen.php';
		}// End if().

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
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'regina-lite' ),
			'id'            => 'blog-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);

	// Footer Sidebar 1
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar 1', 'regina-lite' ),
			'id'            => 'footer-sidebar-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6><small>',
			'after_title'   => '</small></h6>',
		)
	);

	// Footer Sidebar 2
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar 2', 'regina-lite' ),
			'id'            => 'footer-sidebar-2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6><small>',
			'after_title'   => '</small></h6>',
		)
	);

	// Footer Sidebar 3
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar 3', 'regina-lite' ),
			'id'            => 'footer-sidebar-3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6><small>',
			'after_title'   => '</small></h6>',
		)
	);

	// Footer Sidebar 4
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar 4', 'regina-lite' ),
			'id'            => 'footer-sidebar-4',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6><small>',
			'after_title'   => '</small></h6>',
		)
	);
}

add_action( 'widgets_init', 'regina_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function regina_lite_scripts() {

	$enable_site_lazyload = get_theme_mod( 'regina_lite_enable_site_lazyload', 1 );
	$preloader_enabled    = get_theme_mod( 'regina_lite_enable_site_preloader', 1 );

	// Google Fonts
	$google_fonts_args = array(
		'family' => 'Lato:400,700%7CMontserrat:400,700',
	);

	// WP Register Style
	wp_register_style( 'google-fonts', add_query_arg( $google_fonts_args, '//fonts.googleapis.com/css' ), array(), null );

	// WP Enqueue Style
	wp_enqueue_style( 'bxslider-css', get_template_directory_uri() . '/layout/css/bxslider.min.css', array(), 'all' );
	wp_enqueue_style( 'regina-lite-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'regina-lite-main-css', get_template_directory_uri() . '/layout/css/styles.min.css', array(), '', 'all' );
	wp_enqueue_style( 'regina-lite-bootstrap', get_template_directory_uri() . '/layout/css/bootstrap.min.css', array(), '', 'all' );
	wp_enqueue_style( 'regina-lite-mobile', get_template_directory_uri() . '/layout/css/mobile.min.css', array(), '', 'all' );

	wp_enqueue_style( 'regina-lite-owl-carousel', get_template_directory_uri() . '/layout/css/owl-carousel.css', array(), '', 'all' );
	wp_enqueue_style( 'regina-lite-owl-theme', get_template_directory_uri() . '/layout/css/owl-theme.css', array(), '', 'all' );

	wp_enqueue_style( 'google-fonts' );

	// WP Enqueue Script
	if ( 1 == $preloader_enabled && ! is_customize_preview() ) {
		wp_enqueue_script( 'pace-min-js', get_template_directory_uri() . '/layout/js/plugins/pace/pace.min.js', array( 'jquery' ), '', false );
		wp_enqueue_script(
			'regina-lite-preloader', get_template_directory_uri() . '/layout/js/preloader.min.js', array(
				'jquery',
				'pace-min-js',
			), '', false
		);
		wp_enqueue_style( 'regina-lite-pace', get_template_directory_uri() . '/layout/css/pace.min.css', array(), '', 'all' );
	}

	wp_enqueue_script( 'regina-lite-jquery.bxslider.min', get_template_directory_uri() . '/layout/js/plugins/bxslider/bxslider.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'regina-lite-owl-carousel-min', get_template_directory_uri() . '/layout/js/plugins/owl-carousel/owl-carousel.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script(
		'regina-lite-scripts', get_template_directory_uri() . '/layout/js/plugins.js', array(
			'jquery',
			'regina-lite-owl-carousel-min',
		), '', true
	);

	wp_localize_script(
		'regina-lite-scripts', 'ReginaLite', array(
			'prevText' => __( 'prev', 'regina-lite' ),
			'nextText' => __( 'next', 'regina-lite' ),
		)
	);

	if ( 1 == $enable_site_lazyload ) {
		wp_enqueue_script( 'regina-lite-jquery.lazyload.min', get_template_directory_uri() . '/layout/js/plugins/lazyload/lazyload.min.js', array( 'jquery' ), '', true );
	}

	wp_enqueue_script( 'regina-lite-jquery.waypoints.min', get_template_directory_uri() . '/layout/js/plugins/waypoints/waypoints.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'regina-lite-navigation', get_template_directory_uri() . '/layout/js/plugins/navigation/navigation.min.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'regina-lite-skip-link-focus-fix', get_template_directory_uri() . '/layout/js/plugins/skip-link-focus-fix/skip-link-focus-fix.js', array( 'jquery' ), '20130115', true );
	wp_enqueue_script( 'regina-lite-custom', get_template_directory_uri() . '/layout/js/custom.min.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'regina_lite_scripts' );

#
#  Move comment field to bottom
#
add_filter( 'comment_form_fields', 'regina_lite_move_comment_field_to_bottom' );
function regina_lite_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}

// Add Epsilon Framework
require_once get_template_directory() . '/inc/libraries/epsilon-framework/class-epsilon-autoloader.php';
$args = array(
	'controls' => array( 'slider', 'toggle', 'upsell', 'text-editor' ),
	// array of controls to load
	'sections' => array( 'recommended-actions' ),
	// array of sections to load
	'path'     => '/inc/libraries',
	// path to your epsilon framework in your theme, e.g. theme-name*/inc/libraries*/epsilon-framework
	'backup'   => false,
);

new Epsilon_Framework( $args );

