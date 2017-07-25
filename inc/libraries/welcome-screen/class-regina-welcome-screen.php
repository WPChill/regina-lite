<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Welcome Screen Class
 */
class Regina_Welcome_Screen {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {
		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'regina_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'regina_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'regina_welcome_style_and_scripts' ) );

		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_regina_dismiss_required_action', array(
			$this,
			'regina_dismiss_required_action_callback',
		) );
		add_action( 'wp_ajax_nopriv_regina_dismiss_required_action', array(
			$this,
			'regina_dismiss_required_action_callback',
		) );
		add_action( 'wp_ajax_regina_dismiss_recommended_plugins', array(
			$this,
			'regina_dismiss_recommended_plugins_callback'
		) );

		/**
		 * Set the blog / static page automatically
		 */
		add_action( 'admin_init', array( $this, 'regina_set_pages' ) );
	}

	/**
	 * Set the latest blog / static page automatically
	 */
	public function regina_set_pages() {
		if ( ! empty( $_GET ) ) {
			/**
			 * Check action
			 */
			if ( ! empty( $_GET['action'] ) && 'set_page_automatic' === $_GET['action'] ) {
				$active_tab = $_GET['tab'];
				$about      = get_page_by_title( 'Homepage' );
				update_option( 'page_on_front', $about->ID );
				update_option( 'show_on_front', 'page' );

				// Set the blog page
				$blog = get_page_by_title( 'Blog' );
				update_option( 'page_for_posts', $blog->ID );

				wp_redirect( self_admin_url( 'themes.php?page=regina-welcome&tab=' . $active_tab ) );
			}
		}
	}

	/**
	 * Creates the dashboard page
	 *
	 * @see   add_theme_page()
	 * @since 1.8.2.4
	 */
	public function regina_welcome_register_menu() {
		$action_count = $this->count_actions();
		$title        = $action_count > 0 ? __( 'About Regina', 'regina-lite' ) . '<span class="badge-action-count">' . esc_html( $action_count ) . '</span>' : __( 'About Regina', 'regina-lite' );

		add_theme_page( __( 'About regina', 'regina-lite' ), $title, 'edit_theme_options', 'regina-welcome', array(
			$this,
			'regina_welcome_screen',
		) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 *
	 */
	public function regina_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'regina_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 *
	 */
	public function regina_welcome_admin_notice() {
		?>
		<div class="updated notice is-dismissible">
			<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Regina! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'regina-lite' ), '<a href="' . esc_url( admin_url( 'themes.php?page=regina-welcome' ) ) . '">', '</a>' ); ?></p>
			<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=regina-welcome' ) ); ?>" class="button"
				  style="text-decoration: none;"><?php _e( 'Get started with Regina', 'regina-lite' ); ?></a></p>
		</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 *
	 */
	public function regina_welcome_style_and_scripts( $hook_suffix ) {

		wp_enqueue_style( 'regina-welcome-screen', get_template_directory_uri() . '/inc/libraries/welcome-screen/assets/css/welcome.css' );
		wp_enqueue_script( 'regina-welcome-screen', get_template_directory_uri() . '/inc/libraries/welcome-screen/assets/js/welcome.js', array( 'jquery' ) );

		wp_localize_script( 'regina-welcome-screen', 'reginaWelcomeScreenObject', array(
			'nr_actions_required'      => absint( $this->count_actions() ),
			'ajaxurl'                  => esc_url( admin_url( 'admin-ajax.php' ) ),
			'template_directory'       => esc_url( get_template_directory_uri() ),
			'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.', 'regina-lite' ),
		) );

	}

	/**
	 * Load scripts for customizer page
	 *
	 */
	public function regina_welcome_scripts_for_customizer() {

		wp_enqueue_style( 'regina-welcome-screen-customizer', get_template_directory_uri() . '/inc/libraries/welcome-screen/assets/css/welcome_customizer.css' );
		wp_enqueue_script( 'regina-welcome-screen-customizer', get_template_directory_uri() . '/inc/libraries/welcome-screen/assets/js/welcome_customizer.js', array( 'jquery' ), '20120206', true );

		wp_localize_script( 'regina-welcome-screen-customizer', 'reginaWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => absint( $this->count_actions() ),
			'aboutpage'           => esc_url( admin_url( 'themes.php?page=regina-welcome&tab=recommended_actions' ) ),
			'customizerpage'      => esc_url( admin_url( 'customize.php#recommended_actions' ) ),
			'themeinfo'           => __( 'View Theme Info', 'regina-lite' ),
		) );
	}

	/**
	 * Dismiss required actions
	 *
	 * @since 1.8.2.4
	 */
	public function regina_dismiss_required_action_callback() {

		global $regina_required_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo $action_id; /* this is needed and it's the id of the dismissable required action */

		if ( ! empty( $action_id ) ) :

			/* if the option exists, update the record for the specified id */
			if ( get_option( 'regina_show_required_actions' ) ) :

				$regina_show_required_actions = get_option( 'regina_show_required_actions' );

				switch ( $_GET['todo'] ) {
					case 'add';
						$regina_show_required_actions[ $action_id ] = true;
						break;
					case 'dismiss';
						$regina_show_required_actions[ $action_id ] = false;
						break;
				}

				update_option( 'regina_show_required_actions', $regina_show_required_actions );

				/* create the new option,with false for the specified id */
			else :

				$regina_show_required_actions_new = array();

				if ( ! empty( $regina_required_actions ) ) :

					foreach ( $regina_required_actions as $regina_required_action ) :

						if ( $regina_required_action['id'] == $action_id ) :
							$regina_show_required_actions_new[ $regina_required_action['id'] ] = false;
						else :
							$regina_show_required_actions_new[ $regina_required_action['id'] ] = true;
						endif;

					endforeach;

					update_option( 'regina_show_required_actions', $regina_show_required_actions_new );

				endif;

			endif;

		endif;

		die(); // this is required to return a proper result
	}

	public function regina_dismiss_recommended_plugins_callback() {
		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;
		echo $action_id; /* this is needed and it's the id of the dismissable required action */
		if ( ! empty( $action_id ) ):
			/* if the option exists, update the record for the specified id */
			$regina_show_recommended_plugins = get_option( 'regina_show_recommended_plugins' );
				
				switch ( $_GET['todo'] ) {
					case 'add';
						$regina_show_recommended_plugins[ $action_id ] = true;
						break;
					case 'dismiss';
						$regina_show_recommended_plugins[ $action_id ] = false;
						break;
				}
				update_option( 'regina_show_recommended_plugins', $regina_show_recommended_plugins );
			/* create the new option,with false for the specified id */
		endif;
		die(); // this is required to return a proper result
	}


	/**
	 *
	 */
	public function count_actions() {
		global $regina_required_actions;

		$regina_show_required_actions = get_option( 'regina_show_required_actions' );
		if ( ! $regina_show_required_actions ) {
			$regina_show_required_actions = array();
		}

		$i = 0;
		foreach ( $regina_required_actions as $action ) {
			$true      = false;
			$dismissed = false;

			if ( ! $action['check'] ) {
				$true = true;
			}

			if ( ! empty( $regina_show_required_actions ) && isset( $regina_show_required_actions[ $action['id'] ] ) && ! $regina_show_required_actions[ $action['id'] ] ) {
				$true = false;
			}

			if ( $true ) {
				$i ++;
			}
		}

		return $i;
	}


	/**
	 * @param $slug
	 *
	 * @return array|mixed|object|WP_Error
	 */
	public function call_plugin_api( $slug ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
		$call_api = get_transient( 'regina_plugin_information_transient_' . $slug );

		if ( false === $call_api ) {
			$call_api = plugins_api( 'plugin_information', array(
				'slug'   => $slug,
				'fields' => array(
					'downloaded'        => false,
					'rating'            => false,
					'description'       => false,
					'short_description' => true,
					'donate_link'       => false,
					'tags'              => false,
					'sections'          => true,
					'homepage'          => true,
					'added'             => false,
					'last_updated'      => false,
					'compatibility'     => false,
					'tested'            => false,
					'requires'          => false,
					'downloadlink'      => false,
					'icons'             => true,
				),
			) );
			set_transient( 'regina_plugin_information_transient_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
		}

		return $call_api;
	}

	/**
	 * @param $slug
	 *
	 * @return array
	 */
	public function check_active( $slug ) {
		if ( file_exists( ABSPATH . 'wp-content/plugins/' . $slug . '/' . $slug . '.php' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			$needs = is_plugin_active( $slug . '/' . $slug . '.php' ) ? 'deactivate' : 'activate';

			return array(
				'status' => is_plugin_active( $slug . '/' . $slug . '.php' ),
				'needs' => $needs,
			);
		}

		return array(
			'status' => false,
			'needs' => 'install',
		);
	}

	/**
	 * @param $arr
	 *
	 * @return mixed
	 */
	public function check_for_icon( $arr ) {
		if ( ! empty( $arr['svg'] ) ) {
			$plugin_icon_url = $arr['svg'];
		} elseif ( ! empty( $arr['2x'] ) ) {
			$plugin_icon_url = $arr['2x'];
		} elseif ( ! empty( $arr['1x'] ) ) {
			$plugin_icon_url = $arr['1x'];
		} else {
			$plugin_icon_url = $arr['default'];
		}

		return $plugin_icon_url;
	}

	/**
	 * @param $state
	 * @param $slug
	 *
	 * @return string
	 */
	public function create_action_link( $state, $slug ) {
		switch ( $state ) {
			case 'install':
				return wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'install-plugin',
							'plugin' => $slug,
						),
						network_admin_url( 'update.php' )
					),
					'install-plugin_' . $slug
				);
				break;
			case 'deactivate':
				return add_query_arg( array(
					'action'        => 'deactivate',
					'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
					'plugin_status' => 'all',
					'paged'         => '1',
					'_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . $slug . '/' . $slug . '.php' ),
				), network_admin_url( 'plugins.php' ) );
				break;
			case 'activate':
				return add_query_arg( array(
					'action'        => 'activate',
					'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
					'plugin_status' => 'all',
					'paged'         => '1',
					'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $slug . '/' . $slug . '.php' ),
				), network_admin_url( 'plugins.php' ) );
				break;
		}
	}

	/**
	 * Welcome screen content
	 *
	 * @since 1.8.2.4
	 */
	public function regina_welcome_screen() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );

		$regina      = wp_get_theme();
		$active_tab   = isset( $_GET['tab'] ) ? $_GET['tab'] : 'getting_started';
		$action_count = $this->count_actions();

		?>

		<div class="wrap about-wrap epsilon-wrap">

			<h1><?php echo __( 'Welcome to regina! - Version ', 'regina-lite' ) . esc_html( $regina['Version'] ); ?></h1>

			<div
				class="about-text"><?php echo esc_html__( 'regina is now installed and ready to use! Get ready to build something beautiful. We hope you enjoy it! We want to make sure you have the best experience using regina and that is why we gathered here all the necessary information for you. We hope you will enjoy using regina, as much as we enjoy creating great products.', 'regina-lite' ); ?></div>

			<div class="wp-badge epsilon-welcome-logo"></div>


			<h2 class="nav-tab-wrapper wp-clearfix">
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=regina-welcome&tab=getting_started' ) ); ?>"
				   class="nav-tab <?php echo 'getting_started' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__( 'Getting Started', 'regina-lite' ); ?></a>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=regina-welcome&tab=recommended_actions' ) ); ?>"
				   class="nav-tab <?php echo 'recommended_actions' == $active_tab ? 'nav-tab-active' : ''; ?> "><?php echo esc_html__( 'Recommended Actions', 'regina-lite' ); ?>
					<?php echo $action_count > 0 ? '<span class="badge-action-count">' . esc_html( $action_count ) . '</span>' : '' ?></a>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=regina-welcome&tab=recommended_plugins' ) ); ?>"
				   class="nav-tab <?php echo 'recommended_plugins' == $active_tab ? 'nav-tab-active' : ''; ?> "><?php echo esc_html__( 'Recommended Plugins', 'regina-lite' ); ?></a>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=regina-welcome&tab=support' ) ); ?>"
				   class="nav-tab <?php echo 'support' == $active_tab ? 'nav-tab-active' : ''; ?> "><?php echo esc_html__( 'Support', 'regina-lite' ); ?></a>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=regina-welcome&tab=features' ) ); ?>"
				   class="nav-tab <?php echo 'features' == $active_tab ? 'nav-tab-active' : ''; ?> "><?php echo esc_html__( 'Lite vs PRO', 'regina-lite' ); ?></a>
			</h2>

			<?php
			switch ( $active_tab ) {
				case 'getting_started':
					require_once get_template_directory() . '/inc/libraries/welcome-screen/sections/getting-started.php';
					break;
				case 'recommended_actions':
					require_once get_template_directory() . '/inc/libraries/welcome-screen/sections/actions-required.php';
					break;
				case 'recommended_plugins':
					require_once get_template_directory() . '/inc/libraries/welcome-screen/sections/recommended-plugins.php';
					break;
				case 'support':
					require_once get_template_directory() . '/inc/libraries/welcome-screen/sections/support.php';
					break;
				case 'features':
					require_once get_template_directory() . '/inc/libraries/welcome-screen/sections/features.php';
					break;
				default:
					require_once get_template_directory() . '/inc/admin/welcome-screen/sections/getting-started.php';
					break;
			}
			?>


		</div><!--/.wrap.about-wrap-->

		<?php
	}
}

new Regina_Welcome_Screen();
