<?php
if ( class_exists( 'WP_Customize_Setting' ) && ! class_exists( 'Regina_Custom_Setting' ) ) {
	class Regina_Custom_Setting extends WP_Customize_Setting {

		public $type = 'epsilon_page';

		public function get_root_value( $default = null ) {
			$setting_value = Regina_Lite_Helper::get_regina_setting( $this->id );
			if ( false === $setting_value ) {
				$customizer_value = get_theme_mod( $this->id );
				if ( $customizer_value ) {
					return $customizer_value;
				}
				return $default;
			} else {
				return $setting_value;
			}
		}

		public function preview() {
			if ( $this->is_previewed ) {
				return false;
			}
			$this->is_previewed = true;
			add_filter( "theme_mod_{$this->id}", array( $this, 'filter_previewed_wp_get_from_epsilon_page' ), 11 );
			return true;
		}

		public function filter_previewed_wp_get_from_epsilon_page( $original ) {

			$customized_value = $this->post_value( null );
			if ( ! is_null( $customized_value ) ) {
				$original = $customized_value;
			}
			return $original;
		}

	}
} // End if().
