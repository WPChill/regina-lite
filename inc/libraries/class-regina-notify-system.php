<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Regina_Notify_System extends Epsilon_Notify_System {

	/**
	 * @return bool
	 */
	public static function is_template_front_page() {
		$page_id = get_option( 'page_on_front' );

		return get_page_template_slug( $page_id ) == 'page-templates/template-homepage.php' ? true : false;
	}

	/**
	 * @return bool
	 */
	public static function is_homepage_seted() {

		if ( ! Regina_Notify_System::is_not_static_page() ) {
			return false;
		}

		if ( ! Regina_Notify_System::is_template_front_page() ) {
			return false;
		}

		return true;

	}

	public static function has_old_content() {

		$fields     = Regina_Lite_Helper::$regina_fields;
		$theme_mods = get_theme_mods();
		foreach ( $fields as $field ) {
			if ( in_array( $field, $theme_mods ) ) {
				return true;
			}
		}

		return false;

	}

	public static function show_fix_action() {

		if ( self::has_old_content() && ! self::is_homepage_seted() ) {
			return false;
		}
		return true;

	}

	public static function has_content() {

		$content = get_post_meta( Regina_Lite_Helper::get_setting_page_id(), 'regina-settings', true );

		if ( empty( $content ) ) {
			return false;
		}

		return true;

	}

	public static function check_installed_data() {

		$import = get_option( 'regina_lite_import_content' );

		if ( $import ) {
			return true;
		}

		if ( self::has_old_content() || self::has_content() ) {
			return true;
		}

		return false;

	}

	/**
	 * @return bool
	 */
	public static function has_plugin( $slug = null ) {

		$check = array(
			'installed' => self::check_plugin_is_installed( $slug ),
			'active'    => self::check_plugin_is_active( $slug ),
		);

		if ( ! $check['installed'] || ! $check['active'] ) {
			return false;
		}

		return true;
	}

}
