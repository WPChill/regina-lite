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
	global $regina_required_actions;
	$hooray = true;
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
			?>
			<div class="regina-action-required-box">
				<?php if ( ! $hidden ) : ?>
					<span data-action="dismiss" class="dashicons dashicons-visibility regina-required-action-button"
						  id="<?php echo esc_attr( $regina_required_action_value['id'] ); ?>"></span>
				<?php else : ?>
					<span data-action="add" class="dashicons dashicons-hidden regina-required-action-button"
						  id="<?php echo esc_attr( $regina_required_action_value['id'] ); ?>"></span>
				<?php endif; ?>
				<h3><?php if ( ! empty( $regina_required_action_value['title'] ) ) : echo esc_html( $regina_required_action_value['title'] );
endif; ?></h3>
				<p>
					<?php if ( ! empty( $regina_required_action_value['description'] ) ) : echo esc_html( $regina_required_action_value['description'] );
endif; ?>
					<?php if ( ! empty( $regina_required_action_value['help'] ) ) : echo '<br/>' . wp_kses_post( $regina_required_action_value['help'] );
endif; ?>
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
					<p class="plugin-card-<?php echo esc_attr( $regina_required_action_value['plugin_slug'] ) ?> action_button <?php echo ( 'install' !== $active['needs'] && $active['status'] ) ? 'active' : '' ?>">
						<a data-slug="<?php echo esc_attr( $regina_required_action_value['plugin_slug'] ) ?>"
						   class="<?php echo esc_attr( $class ); ?>"
						   href="<?php echo esc_url( $url ) ?>"> <?php echo esc_html( $label ) ?> </a>
					</p>
					<?php
				};
				?>
			</div>
			<?php
			$hooray = false;
		endforeach;
	endif;

	if ( $hooray ) :
		echo '<span class="hooray">' . __( 'Hooray! There are no required actions for you right now.', 'regina-lite' ) . '</span>';
	endif;
	?>

</div>
