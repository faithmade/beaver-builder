<?php

/**
 * Network admin settings for the page builder.
 *
 * @since 1.0
 */
final class FLBuilderMultisiteSettings {

	/**
	 * Initializes the network admin settings page for multisite installs.
	 *
	 * @since 1.0
	 * @return void
	 */
	static public function init()
	{
		add_action( 'network_admin_menu', 'FLBuilderMultisiteSettings::menu' );
			
		if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 'fl-builder-multisite-settings' ) {
			add_action( 'admin_enqueue_scripts', 'FLBuilderAdminSettings::styles_scripts' );
			FLBuilderAdminSettings::save();
		}
	}

	/**
	 * Renders the network admin menu for multisite installs.
	 *
	 * @since 1.0
	 * @return void
	 */
	static public function menu()
	{
		$title = FLBuilderModel::get_branding();
		$cap   = 'manage_network_plugins';
		$slug  = 'fl-builder-multisite-settings';
		$func  = 'FLBuilderAdminSettings::render';
		
		add_submenu_page( 'settings.php', $title, $title, $cap, $slug, $func );
	}
}