<?php

/**
 * Helper class for overriding core templates with user
 * defined templates.
 *
 * @since 1.5.7.
 */
final class FLBuilderTemplatesOverride {

	/** 
	 * Renders the admin settings.
	 *
	 * @since 1.5.7
	 * @return void
	 */
	static public function render_admin_settings()
	{
		if ( is_network_admin() || ! is_multisite() ) {
			
			$site_id 		= self::get_source_site_id();
			$show_rows  	= self::show_rows();
			$show_modules  	= self::show_modules();
			
			include FL_BUILDER_DIR . 'includes/admin-settings-templates-override.php';
		}
	}

	/** 
	 * Saves the admin settings.
	 *
	 * @since 1.5.7
	 * @return void
	 */
	static public function save_admin_settings()
	{
		global $wpdb;
		
		// Templates override
		if ( is_network_admin() ) {
			
			$templates_override = sanitize_text_field( $_POST['fl-templates-override'] );
			
			if ( empty( $templates_override ) ) {
				$templates_override = false;
			}
			else if ( ! is_numeric( $templates_override ) ) {
				$templates_override = false;
				FLBuilderAdminSettings::add_error( __( "Error! Please enter a number for the site ID.", 'fl-builder' ) );
			}
			else if ( ! FLBuilderMultisite::blog_exists( $templates_override ) ) {
				$templates_override = false;
				FLBuilderAdminSettings::add_error( __( "Error! A site with that ID doesn't exist.", 'fl-builder' ) );
			}
			
			update_site_option( '_fl_builder_templates_override', $templates_override );
		}
		else if ( ! is_multisite() ) {
			
			if ( isset( $_POST['fl-templates-override'] ) ) {
				$templates_override = 1;
			}
			else {
				$templates_override = false;
			}
			
			update_site_option( '_fl_builder_templates_override', $templates_override );
		}
		
		// Row and module templates
		if ( is_network_admin() || ! is_multisite() ) {
			update_site_option( '_fl_builder_templates_override_rows', isset( $_POST['fl-templates-override-rows'] ) );
			update_site_option( '_fl_builder_templates_override_modules', isset( $_POST['fl-templates-override-modules'] ) );
		}
	}

	/** 
	 * Returns the ID of the source site or false.
	 *
	 * @since 1.5.7
	 * @return int|bool
	 */
	static public function get_source_site_id()
	{
		return get_site_option( '_fl_builder_templates_override', false );
	}

	/** 
	 * Checks to see if row templates should be shown in the builder panel.
	 *
	 * @since 1.6.3
	 * @return bool
	 */
	static public function show_rows()
	{
		return get_site_option( '_fl_builder_templates_override_rows', false );
	}

	/** 
	 * Checks to see if module templates should be shown in the builder panel.
	 *
	 * @since 1.6.3
	 * @return bool
	 */
	static public function show_modules()
	{
		return get_site_option( '_fl_builder_templates_override_modules', false );
	}

	/** 
	 * Returns data for overriding core templates in
	 * the template selector.
	 *
	 * @since 1.5.7
	 * @param string $type The type of user template to return.
	 * @return array|bool
	 */
	static public function get_selector_data( $type = 'layout' )
	{
		$site_id = self::get_source_site_id();
		
		if ( $site_id && $type ) {	
			
			if ( is_multisite() ) {
				switch_to_blog( $site_id );
			}
			
			$data = FLBuilderModel::get_user_templates( $type );
			
			if ( is_multisite() ) {
				restore_current_blog();
			}
		
			return count( $data['templates'] ) > 0 ? $data : false;
		}
		
		return false;
	}

	/** 
	 * Applies a user defined template instead 
	 * of a core template.
	 *
	 * @since 1.5.7
	 * @param int $template_id The post ID of the template to apply.
	 * @param bool $append Whether to append the new template or replacing the existing layout.
	 * @return bool
	 */
	static public function apply( $template_id = null, $append = false )
	{
		$site_id = self::get_source_site_id();
		
		if ( $site_id ) {
			
			if ( is_multisite() ) {
				switch_to_blog( $site_id );
			}
			
			$template_data = FLBuilderModel::get_layout_data( 'published', $template_id );
			
			if ( is_multisite() ) {
				restore_current_blog();
			}
			
			FLBuilderModel::apply_user_template( $template_id, $append, $template_data );
			
			return true;
		}
		
		return false;
	}

	/**
	 * Applies a node template that is defined as network-wide.
	 *
	 * @since 1.6.3
	 * @param int $template_id The node template post ID.
	 * @param string $parent_id The new parent node ID for the template.
	 * @param int $position The position of the template within the layout.
	 * @return void
	 */
	static public function apply_node( $template_id = null, $parent_id = null, $position = 0 )
	{
		$site_id = self::get_source_site_id();
		
		if ( $site_id ) {
			
			if ( is_multisite() ) {
				switch_to_blog( $site_id );
			}
			
			$template_data = FLBuilderModel::get_layout_data( 'published', $template_id );
			$type 		   = FLBuilderModel::get_user_template_type( $template_id );
			
			if ( is_multisite() ) {
				restore_current_blog();
			}
			
			return FLBuilderModel::apply_node_template( $template_id, $parent_id, $position, $template_data, $type, false );
		}
		
		return false;
	}
}