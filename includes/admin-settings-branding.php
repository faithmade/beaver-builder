<div id="fl-branding-form" class="fl-settings-form">

	<h3 class="fl-settings-form-header"><?php _e('Branding', 'fl-builder'); ?></h3>

	<form action="<?php FLBuilderAdminSettings::render_form_action( 'branding' ); ?>" method="post">

		<p><?php _e('White label the page builder by entering a custom name below.', 'fl-builder'); ?></p>
		<input type="text" name="fl-branding" value="<?php echo esc_html(FLBuilderModel::get_branding()); ?>" class="regular-text" />

		<p><?php _e('Additionally, you may also add a custom icon by entering the URL of an image below. Leave the field blank if you do not wish to use an icon.', 'fl-builder'); ?></p>
		<input type="text" name="fl-branding-icon" value="<?php echo esc_html(FLBuilderModel::get_branding_icon()); ?>" class="regular-text" />

		<p class="submit">
			<input type="submit" name="update" class="button-primary" value="<?php esc_attr_e( 'Save Branding', 'fl-builder' ); ?>" />
			<?php wp_nonce_field('branding', 'fl-branding-nonce'); ?>
		</p>
	</form>

</div>