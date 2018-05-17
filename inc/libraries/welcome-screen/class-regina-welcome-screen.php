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
	public function __construct( $config = array() ) {

		$theme = wp_get_theme();

		/**
		 * Configure our welcome screen
		 */
		$this->theme_name  = $theme->get( 'Name' );
		$this->theme_slug  = $theme->get( 'TextDomain' );
		$this->author_logo = get_template_directory_uri() . '/inc/libraries/welcome-screen/assets/img/macho-themes-logo.svg';

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'regina_welcome_register_menu' ) );

		/* activation notice */
		// add_action( 'load-themes.php', array( $this, 'regina_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'regina_welcome_style_and_scripts' ) );

		/* ajax callback for dismissable required actions */
		add_action(
			'wp_ajax_regina_dismiss_required_action', array(
				$this,
				'regina_dismiss_required_action_callback',
			)
		);
		add_action(
			'wp_ajax_nopriv_regina_dismiss_required_action', array(
				$this,
				'regina_dismiss_required_action_callback',
			)
		);
		add_action(
			'wp_ajax_regina_dismiss_recommended_plugins', array(
				$this,
				'regina_dismiss_recommended_plugins_callback',
			)
		);

		/**
		 * Ajax callbacks
		 */
		add_action(
			'wp_ajax_welcome_screen_ajax_callback', array(
				$this,
				'welcome_screen_ajax_callback',
			)
		);
		add_action(
			'wp_ajax_nopriv_welcome_screen_ajax_callback', array(
				$this,
				'welcome_screen_ajax_callback',
			)
		);

		add_action( 'wp_ajax_regina_set_frontpage', array( $this, 'set_frontpage' ) );
		add_action( 'wp_ajax_nopriv_regina_set_frontpage', array( $this, 'set_frontpage' ) );

		/**
		 * Set the blog / static page automatically
		 */
		add_action( 'admin_init', array( $this, 'regina_set_pages' ) );

		/**
		 * Add the notice in the admin backend
		 */
		$this->add_admin_notice();
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

		add_theme_page(
			__( 'About regina', 'regina-lite' ), $title, 'edit_theme_options', 'regina-welcome', array(
				$this,
				'regina_welcome_screen',
			)
		);
	}

	private function add_admin_notice() {
		if ( ! class_exists( 'Epsilon_Notifications' ) ) {
			return;
		}
		$this->notice = '';
		if ( empty( $this->notice ) ) {
			if ( ! empty( $this->author_logo ) ) {
				$this->notice .= '<img src="' . $this->author_logo . '" class="epsilon-author-logo" />';
			}
			/* Translators: Notice Title */
			$this->notice .= '<h1>' . sprintf( esc_html__( 'Welcome to %1$s', 'epsilon-framework' ), $this->theme_name ) . '</h1>';
			$this->notice .= '<p>';

			if ( Regina_Notify_System::show_fix_action() ) {
				$this->notice .=
					sprintf( /* Translators: Notice */
						esc_html__( 'Welcome! Thank you for choosing %3$s! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'epsilon-framework' ),
						'<a href="' . esc_url( admin_url( 'themes.php?page=regina-welcome' ) ) . '">',
						'</a>',
						$this->theme_name
					);
				$this->notice .= '</p>';
				/* Translators: Notice URL */
				$this->notice .= '<p><a href="' . esc_url( admin_url( 'themes.php?page=regina-welcome&tab=recommended_actions' ) ) . '" class="button button-primary button-hero" style="text-decoration: none;"> ' . sprintf( esc_html__( 'Get started with %1$s', 'epsilon-framework' ), $this->theme_name ) . '</a></p>';
			} else {
				$this->notice .= esc_html__( 'We have made some changes to how the Homepage works in Regina. Now you need to create a page and use the "Homepage Template" and set it as a static front page. You can also make this automatically by pushing the button below.', 'epsilon-framework' );
				$this->notice .= '</p>';
				/* Translators: Notice URL */
				$this->notice .= '<p><a id="regina-fix-homepage" href="#" class="button button-primary" style="text-decoration: none;"> ' . esc_html__( 'Fix Homepage', 'epsilon-framework' ) . '</a><span class="spinner" style="float:none"></span></p>';
			}
		}

		$notifications = Epsilon_Notifications::get_instance();

		if ( ! Regina_Notify_System::is_homepage_seted() ) {

			$notifications->add_notice(
				array(
					'id'      => 'regina_welcome_notice',
					'type'    => 'notice epsilon-big',
					'message' => $this->notice,
				)
			);

		}

	}

	/**
	 * Load welcome screen css and javascript
	 *
	 */
	public function regina_welcome_style_and_scripts( $hook_suffix ) {

		wp_enqueue_style( 'regina-welcome-screen', get_template_directory_uri() . '/inc/libraries/welcome-screen/assets/css/welcome.css' );
		wp_enqueue_script( 'regina-welcome-screen', get_template_directory_uri() . '/inc/libraries/welcome-screen/assets/js/welcome.js', array( 'jquery' ) );

		wp_localize_script(
			'regina-welcome-screen', 'reginaWelcomeScreenObject', array(
				'ajaxurl'                  => esc_url( admin_url( 'admin-ajax.php' ) ),
				'nr_actions_required'      => absint( $this->count_actions() ),
				'template_directory'       => esc_url( get_template_directory_uri() ),
				'no_required_actions_text' => esc_html__( 'Hooray! There are no required actions for you right now.', 'epsilon-framework' ),
				'ajax_nonce'               => wp_create_nonce( 'welcome_nonce' ),
				'activating_string'        => esc_html__( 'Activating', 'epsilon-framework' ),
				'body_class'               => 'appearance_page_regina-welcome',
				'no_actions'               => esc_html__( 'Hooray! There are no required actions for you right now.', 'epsilon-framework' ),
			)
		);

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
					case 'add':
						$regina_show_required_actions[ $action_id ] = true;
						break;
					case 'dismiss':
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
		if ( ! empty( $action_id ) ) :
			/* if the option exists, update the record for the specified id */
			$regina_show_recommended_plugins = get_option( 'regina_show_recommended_plugins' );

			switch ( $_GET['todo'] ) {
				case 'add':
					$regina_show_recommended_plugins[ $action_id ] = true;
					break;
				case 'dismiss':
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
			$call_api = plugins_api(
				'plugin_information', array(
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
				)
			);
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
				'needs'  => $needs,
			);
		}

		return array(
			'status' => false,
			'needs'  => 'install',
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
				return add_query_arg(
					array(
						'action'        => 'deactivate',
						'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
						'plugin_status' => 'all',
						'paged'         => '1',
						'_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . $slug . '/' . $slug . '.php' ),
					), network_admin_url( 'plugins.php' )
				);
				break;
			case 'activate':
				return add_query_arg(
					array(
						'action'        => 'activate',
						'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
						'plugin_status' => 'all',
						'paged'         => '1',
						'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $slug . '/' . $slug . '.php' ),
					), network_admin_url( 'plugins.php' )
				);
				break;
		}
	}

	/**
	 * AJAX Handler
	 */
	public function welcome_screen_ajax_callback() {
		if ( isset( $_POST['args'], $_POST['args']['nonce'] ) && ! wp_verify_nonce( sanitize_key( $_POST['args']['nonce'] ), 'welcome_nonce' ) ) {
			wp_die(
				wp_json_encode(
					array(
						'status' => false,
						'error'  => esc_html__( 'Not allowed', 'epsilon-framework' ),
					)
				)
			);
		}

		$args_action = array_map( 'sanitize_text_field', wp_unslash( $_POST['args']['action'] ) );

		if ( count( $args_action ) !== 2 ) {
			wp_die(
				wp_json_encode(
					array(
						'status' => false,
						'error'  => esc_html__( 'Not allowed', 'epsilon-framework' ),
					)
				)
			);
		}

		if ( ! class_exists( $args_action[0] ) ) {
			wp_die(
				wp_json_encode(
					array(
						'status' => false,
						'error'  => esc_html__( 'Class does not exist', 'epsilon-framework' ),
					)
				)
			);
		}

		$class  = $args_action[0];
		$method = $args_action[1];
		$args   = array();

		if ( is_array( $_POST['args']['args'] ) ) {
			$args = Epsilon_Sanitizers::array_map_recursive( 'sanitize_text_field', wp_unslash( $_POST['args']['args'] ) );
		}

		$response = $class::$method( $args );

		if ( is_array( $response ) ) {
			wp_die( wp_json_encode( $response ) );
		}

		if ( 'ok' === $response ) {
			wp_die(
				wp_json_encode(
					array(
						'status'  => true,
						'message' => 'ok',
					)
				)
			);
		}

		wp_die(
			wp_json_encode(
				array(
					'status'  => false,
					'message' => 'nok',
				)
			)
		);
	}

	/**
	 * Handle a required action
	 *
	 * @param array $args Argument array.
	 *
	 * @return string;
	 */
	public static function handle_required_action( $args = array() ) {
		$actions_left = get_option( 'regina_show_required_actions', array() );

		if ( 'dismiss' === $args['do'] ) {
			$actions_left[ $args['id'] ] = false;
		} else {
			$actions_left[ $args['id'] ] = true;
		}

		update_option( 'regina_show_required_actions', $actions_left );

		return 'ok';
	}

	public static function handle_required_plugin( $args = array() ) {
		$actions_left = get_option( 'regina_show_recommended_plugins', array() );

		if ( 'dismiss' === $args['do'] ) {
			$actions_left[ $args['id'] ] = false;
		} else {
			$actions_left[ $args['id'] ] = true;
		}

		update_option( 'regina_show_recommended_plugins', $actions_left );

		return 'ok';
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

		$regina       = wp_get_theme();
		$active_tab   = isset( $_GET['tab'] ) ? $_GET['tab'] : 'getting_started';
		$action_count = $this->count_actions();

		?>

		<div class="wrap about-wrap epsilon-wrap">

			<h1><?php echo __( 'Welcome to Regina Lite - v', 'regina-lite' ) . esc_html( $regina['Version'] ); ?></h1>

			<div
				class="about-text"><?php echo esc_html__( 'Regina Lite is now installed and ready to use! Get ready to build something beautiful. We hope you enjoy it! We want to make sure you have the best experience using regina and that is why we gathered here all the necessary information for you. We hope you will enjoy using Regina Lite, as much as we enjoy creating great products.', 'regina-lite' ); ?></div>

			<div class="wp-badge epsilon-welcome-logo"></div>


			<h2 class="nav-tab-wrapper wp-clearfix">
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=regina-welcome&tab=getting_started' ) ); ?>"
				   class="nav-tab <?php echo 'getting_started' == $active_tab ? 'nav-tab-active' : ''; ?>"><?php echo esc_html__( 'Getting Started', 'regina-lite' ); ?></a>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=regina-welcome&tab=recommended_actions' ) ); ?>"
				   class="nav-tab <?php echo 'recommended_actions' == $active_tab ? 'nav-tab-active' : ''; ?> "><?php echo esc_html__( 'Recommended Actions', 'regina-lite' ); ?>
					<?php echo $action_count > 0 ? '<span class="badge-action-count">' . esc_html( $action_count ) . '</span>' : ''; ?></a>
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

	public function set_frontpage() {

		if ( isset( $_POST['setfrontpage'] ) ) {

			$home = get_page_by_title( 'Homepage' );
			$blog = get_page_by_title( 'Blog' );

			if ( null === $home ) {
				$id = wp_insert_post(
					array(
						'post_title'  => __( 'Homepage', 'epsilon-framework' ),
						'post_type'   => 'page',
						'post_status' => 'publish',
					)
				);

				update_post_meta( $id, '_wp_page_template', 'page-templates/template-homepage.php' );

				update_option( 'page_on_front', $id );
				update_option( 'show_on_front', 'page' );
			} else {
				update_option( 'page_on_front', $home->ID );
				update_option( 'show_on_front', 'page' );
			}

			if ( null === $blog ) {
				$id = wp_insert_post(
					array(
						'post_title'  => __( 'Blog', 'epsilon-framework' ),
						'post_type'   => 'page',
						'post_status' => 'publish',
					)
				);

				update_option( 'page_for_posts', $id );
			} else {
				update_option( 'page_for_posts', $blog->ID );
			}

			echo 'ok';
			die();

		}

		echo 'nok';
		die();

	}

}

new Regina_Welcome_Screen();
