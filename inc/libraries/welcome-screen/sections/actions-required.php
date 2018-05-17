<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Actions required
 */

wp_enqueue_style( 'plugin-install' );
wp_enqueue_script( 'plugin-install' );
wp_enqueue_script( 'updates' );
?>

<div class="feature-section action-required demo-import-boxed" id="plugin-filter">

	<?php
	global $regina_required_actions, $regina_recommended_plugins;
	$hooray              = true;
	$nr_actions_required = 0;
	$nr_action_dismissed = 0;
	if ( ! empty( $regina_required_actions ) ) :

		/* regina_show_required_actions is an array of true/false for each required action that was dismissed */
		$regina_show_required_actions = get_option( 'regina_show_required_actions' );

		foreach ( $regina_required_actions as $regina_required_action_key => $regina_required_action_value ) :
			$hidden = false;
			if ( isset( $regina_show_required_actions[ $regina_required_action_value['id'] ] ) && false === $regina_show_required_actions[ $regina_required_action_value['id'] ] ) {
				$hidden = true;
			}
			if ( isset( $regina_required_action_value['check'] ) && $regina_required_action_value['check'] ) {
				continue;
			}
			$nr_actions_required ++;
			if ( $hidden ) {
				$nr_action_dismissed ++;
			}
			?>
			<div class="regina-action-required-box action-required-box">
				<?php if ( ! $hidden ) : ?>
					<span data-action="dismiss" class="dashicons dashicons-visibility regina-required-action-button required-action-button"
						  id="<?php echo esc_attr( $regina_required_action_value['id'] ); ?>"></span>
				<?php else : ?>
					<span data-action="add" class="dashicons dashicons-hidden regina-required-action-button required-action-button"
						  id="<?php echo esc_attr( $regina_required_action_value['id'] ); ?>"></span>
				<?php endif; ?>
				<h3>
				<?php
				if ( ! empty( $regina_required_action_value['title'] ) ) :
					echo esc_html( $regina_required_action_value['title'] );
endif;
?>
</h3>
				<p>
					<?php
					if ( ! empty( $regina_required_action_value['description'] ) ) :
						echo esc_html( $regina_required_action_value['description'] );
endif;
?>
					<?php
					if ( ! empty( $regina_required_action_value['help'] ) ) {
						if ( is_array( $regina_required_action_value['help'] ) && is_a( $regina_required_action_value['help'][0], 'Epsilon_Import_Data' ) ) {
							$class = $regina_required_action_value['help'][0];
							$func  = $regina_required_action_value['help'][1];

							echo $class->$func();
						} else {
							echo '<br/>' . wp_kses_post( $regina_required_action_value['help'] );
						}
					}
					?>
				</p>
				<?php
				if ( ! empty( $regina_required_action_value['plugin_slug'] ) ) {
					$active = $this->check_active( $regina_required_action_value['plugin_slug'] );
					$url    = $this->create_action_link( $active['needs'], $regina_required_action_value['plugin_slug'] );
					$label  = '';

					switch ( $active['needs'] ) {
						case 'install':
							$class = 'install-now button';
							$label = __( 'Install', 'regina-lite' );
							break;
						case 'activate':
							$class = 'activate-now button button-primary';
							$label = __( 'Activate', 'regina-lite' );
							break;
						case 'deactivate':
							$class = 'deactivate-now button';
							$label = __( 'Deactivate', 'regina-lite' );
							break;
					}

					?>
					<p class="plugin-card-<?php echo esc_attr( $regina_required_action_value['plugin_slug'] ); ?> action_button <?php echo ( 'install' !== $active['needs'] && $active['status'] ) ? 'active' : ''; ?>">
						<a data-slug="<?php echo esc_attr( $regina_required_action_value['plugin_slug'] ); ?>"
						   class="<?php echo esc_attr( $class ); ?>"
						   href="<?php echo esc_url( $url ); ?>"> <?php echo esc_html( $label ); ?> </a>
					</p>
					<?php
				};
				?>
			</div>
			<?php
			$hooray = false;
		endforeach;
	endif;

	$nr_recommended_plugins = 0;
	if ( 0 == $nr_actions_required || $nr_actions_required == $nr_action_dismissed ) :
		$regina_show_recommended_plugins = get_option( 'regina_show_recommended_plugins' );
		foreach ( $regina_recommended_plugins as $slug => $plugin_opt ) {

			if ( ! $plugin_opt['recommended'] ) {
				continue;
			}
			if ( Regina_Notify_System::has_plugin( $slug ) ) {
				continue;
			}
			if ( 0 == $nr_recommended_plugins ) {
				echo '<h3 class="hooray">' . __( 'Hooray! There are no required actions for you right now. But you can make your theme more powerful with next actions: ', 'regina-lite' ) . '</h3>';
			}
			$nr_recommended_plugins ++;
			echo '<div class="regina-action-required-box">';
			if ( isset( $regina_show_recommended_plugins[ $slug ] ) && false === $regina_show_recommended_plugins[ $slug ] ) :
			?>
				<span data-action="add" class="dashicons dashicons-hidden regina-recommended-plugin-button"
					  id="<?php echo esc_attr( $slug ); ?>"></span>
			<?php else : ?>
				<span data-action="dismiss" class="dashicons dashicons-visibility regina-recommended-plugin-button"
					  id="<?php echo esc_attr( $slug ); ?>"></span>
			<?php
			endif;
			$active = $this->check_active( $slug );
			$url    = $this->create_action_link( $active['needs'], $slug );
			$info   = $this->call_plugin_api( $slug );
			$label  = '';
			$class  = '';
switch ( $active['needs'] ) {
	case 'install':
		$class = 'install-now button';
		$label = __( 'Install', 'regina-lite' );
		break;
	case 'activate':
		$class = 'activate-now button button-primary';
		$label = __( 'Activate', 'regina-lite' );
		break;
	case 'deactivate':
		$class = 'deactivate-now button';
		$label = __( 'Deactivate', 'regina-lite' );
		break;
}
			?>
			<h3><?php echo $label . ': ' . $info->name; ?></h3>
			<p>
				<?php echo $info->short_description; ?>
			</p>
			<p class="plugin-card-<?php echo esc_attr( $slug ); ?> action_button <?php echo ( 'install' !== $active['needs'] && $active['status'] ) ? 'active' : ''; ?>">
				<a data-slug="<?php echo esc_attr( $slug ); ?>"
				   class="<?php echo $class; ?>"
				   href="<?php echo esc_url( $url ); ?>"> <?php echo $label; ?> </a>
			</p>
			<?php
			echo '</div>';
		}// End foreach().
	endif;

	if ( $hooray && 0 == $nr_recommended_plugins ) :
		echo '<span class="hooray">' . __( 'Hooray! There are no required actions for you right now.', 'regina-lite' ) . '</span>';
	endif;
	?>

</div>
