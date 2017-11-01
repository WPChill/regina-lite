<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Recommended Plugins
 */
global $regina_required_actions, $regina_recommended_plugins;

wp_enqueue_style( 'plugin-install' );
wp_enqueue_script( 'plugin-install' );
wp_enqueue_script( 'updates' );
add_thickbox();
?>

<div class="feature-section recommended-plugins three-col demo-import-boxed" id="plugin-filter">
	<?php foreach ( $regina_recommended_plugins as $plugin => $prop ) { ?>
		<?php
		$info   = $this->call_plugin_api( $plugin );
		$icon   = $this->check_for_icon( $info->icons );
		$active = $this->check_active( $plugin );
		$url    = $this->create_action_link( $active['needs'], $plugin );
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

		if ( ! empty( $prop['tracking_url'] ) ) {
			$url   = $prop['tracking_url'];
			$class = 'button';
			$label = __( 'Install', 'regina-lite' );
		}

		?>
		<div class="col plugin_box">
			<?php if ( $prop['recommended'] ) : ?>
				<span class="recommended"><?php _e( 'Recommended', 'regina-lite' ); ?></span>
			<?php endif; ?>
			<img src="<?php echo esc_attr( $icon ); ?>" alt="plugin box image">
			<span
				class="version"><?php echo __( 'Version:', 'regina-lite' ); ?><?php echo esc_html( $info->version ); ?></span>
			<span
				class="separator">|</span> <?php echo wp_kses_post( $info->author ); ?>
			<div
				class="action_bar <?php echo ( 'install' !== $active['needs'] && $active['status'] ) ? 'active' : ''; ?>">
				<span
					class="plugin_name"><?php echo ( 'install' !== $active['needs'] && $active['status'] ) ? 'Active: ' : ''; ?><?php echo esc_html( $info->name ); ?></span>
			</div>
			<span
				class="plugin-card-<?php echo esc_attr( $plugin ); ?> action_button <?php echo ( 'install' !== $active['needs'] && $active['status'] ) ? 'active' : ''; ?>">
				<a data-slug="<?php echo esc_attr( $plugin ); ?>" <?php echo ( ! empty( $prop['tracking_url'] ) ) ? ' target="_blank" ' : ''; ?>
				   class="<?php echo esc_attr( $class ); ?>"
				   href="<?php echo esc_url( $url ); ?>"> <?php echo esc_attr( $label ); ?> </a>
			</span>
		</div>
	<?php
}// End foreach().
	?>
</div>
