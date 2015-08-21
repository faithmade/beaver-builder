<script type="text/html" id="tmpl-fl-row-overlay">
	<div class="fl-row-overlay fl-block-overlay<# if ( data.global ) { #> fl-block-overlay-global<# } #>" data-node="{{data.node}}">
		<div class="fl-block-overlay-header">
			<div class="fl-block-overlay-actions">
				<div class="fl-block-overlay-title"><?php _e('Row', 'fl-builder'); ?><# if ( data.global ) { #><span class="fl-block-overlay-title-global"><?php _e('Global', 'fl-builder'); ?></span><# } #></div>
				<?php if ( ! FLBuilderModel::is_post_user_template( 'row' ) && ! $simple_ui ) : ?>
				<i class="fl-block-move fa fa-arrows fl-tip" title="<?php _e('Move', 'fl-builder'); ?>"></i>
				<?php endif; ?>
				<i class="fl-block-settings fa fa-wrench fl-tip" title="<?php _e('Row Settings', 'fl-builder'); ?>"></i>
				<?php if ( ! FLBuilderModel::is_post_user_template( 'row' ) && ! $simple_ui ) : ?>
				<i class="fl-block-copy fa fa-copy fl-tip" title="<?php _e( 'Duplicate', 'fl-builder' ); ?>"></i>
				<i class="fl-block-remove fa fa-times fl-tip" title="<?php _e( 'Remove', 'fl-builder' ); ?>"></i>
				<?php endif; ?>
			</div>
			<div class="fl-clear"></div>
		</div>
	</div>
</script>
<!-- #tmpl-fl-row-overlay -->

<script type="text/html" id="tmpl-fl-col-overlay">
	<div class="fl-col-overlay fl-block-overlay<# if ( data.global ) { #> fl-block-overlay-global<# } #>">
		<div class="fl-block-overlay-header">
			<div class="fl-block-overlay-actions">
				<div class="fl-block-overlay-title"><?php _e( 'Column', 'fl-builder' ); ?><# if ( data.global ) { #><span class="fl-block-overlay-title-global"><?php _e('Global', 'fl-builder'); ?></span><# } #></div>
				<?php if ( ! $simple_ui ) : ?>
				<i class="fl-block-columns fa fa-wrench fl-tip" title="<?php _e( 'Column Settings', 'fl-builder' ); ?>"></i>
				<i class="fl-block-remove fa fa-times fl-tip" title="<?php _e( 'Remove', 'fl-builder' ); ?>"></i>
				<?php endif; ?>
			</div>
			<div class="fl-clear"></div>
		</div>
	</div>
</script>
<!-- #tmpl-fl-col-overlay -->

<script type="text/html" id="tmpl-fl-module-overlay">
	<div class="fl-module-overlay fl-block-overlay<# if ( data.global ) { #> fl-block-overlay-global<# } #>">
		<div class="fl-block-overlay-header">
			<div class="fl-block-overlay-actions">
				<div class="fl-block-overlay-title">{{data.moduleName}}<# if ( data.global ) { #><span class="fl-block-overlay-title-global"><?php _e('Global', 'fl-builder'); ?></span><# } #></div>
				<?php if ( ! FLBuilderModel::is_post_user_template( 'module' ) && ! $simple_ui ) : ?>
				<i class="fl-block-move fa fa-arrows fl-tip" title="<?php _e('Move', 'fl-builder'); ?>"></i>
				<?php endif; ?>
				<i class="fl-block-settings fa fa-wrench fl-tip" title="{{data.moduleName}} <?php _e('Settings', 'fl-builder'); ?>"></i>
				<?php if ( ! FLBuilderModel::is_post_user_template( 'module' ) && ! $simple_ui ) : ?>
				<i class="fl-block-copy fa fa-copy fl-tip" title="<?php _e( 'Duplicate', 'fl-builder' ); ?>"></i>
				<i class="fl-block-columns fa fa-columns fl-tip" title="<?php _e( 'Column Settings', 'fl-builder' ); ?>"></i>
				<i class="fl-block-remove fa fa-times fl-tip" title="<?php _e( 'Remove', 'fl-builder' ); ?>"></i>
				<?php endif; ?>
			</div>
			<div class="fl-clear"></div>
		</div>
	</div>
</script>
<!-- #tmpl-fl-module-overlay -->

<script type="text/html" id="tmpl-fl-actions-lightbox">
	<div class="fl-builder-actions {{data.className}}">
		<span class="fl-builder-actions-title">{{data.title}}</span>
		<# for( var i in data.buttons ) { #>
		<span class="fl-builder-{{i}}-button fl-builder-button fl-builder-button-large">{{data.buttons[ i ]}}</span>
		<# } #>
		<span class="fl-builder-cancel-button fl-builder-button fl-builder-button-primary fl-builder-button-large"><?php _e('Cancel', 'fl-builder'); ?></span>
	</div>
</script>
<!-- #tmpl-fl-actions-lightbox -->

<script type="text/html" id="tmpl-fl-alert-lightbox">
	<div class="fl-lightbox-message">{{data.message}}</div>
	<div class="fl-lightbox-footer">
		<span class="fl-builder-alert-close fl-builder-button fl-builder-button-large fl-builder-button-primary" href="javascript:void(0);"><?php _e('OK', 'fl-builder'); ?></span>
	</div>
</script>
<!-- #tmpl-fl-alert-lightbox -->

<script type="text/html" id="tmpl-fl-tour-lightbox">
	<div class="fl-builder-actions fl-builder-tour-actions">
		<span class="fl-builder-actions-title"><?php _e('Welcome! It looks like this might be your first time using the builder. Would you like to take a tour?', 'fl-builder'); ?></span>
		<span class="fl-builder-no-tour-button fl-builder-button fl-builder-button-large"><?php _e('No Thanks', 'fl-builder'); ?></span>
		<span class="fl-builder-yes-tour-button fl-builder-button fl-builder-button-primary fl-builder-button-large"><?php _e('Yes Please!', 'fl-builder'); ?></span>
	</div>
</script>
<!-- #tmpl-fl-tour-lightbox -->

<script type="text/html" id="tmpl-fl-video-lightbox">
	<div class="fl-lightbox-header">
		<h1><?php _e('Getting Started Video', 'fl-builder'); ?></h1>
	</div>
	<div class="fl-builder-getting-started-video">{{{data.video}}}</div>
	<div class="fl-lightbox-footer">
		<span class="fl-builder-settings-cancel fl-builder-button fl-builder-button-large fl-builder-button-primary" href="javascript:void(0);"><?php _e('Done', 'fl-builder'); ?></span>
	</div>
</script>
<!-- #tmpl-fl-video-lightbox -->

<script type="text/html" id="tmpl-fl-node-template-block">
	<span class="fl-builder-block fl-builder-block-saved-{{data.type}}<# if ( data.global ) { #> fl-builder-block-global<# } #>" data-id="{{data.id}}">
		<span class="fl-builder-block-title">{{data.name}}</span>
		<# if ( data.global ) { #>
		<div class="fl-builder-badge fl-builder-badge-global">
			<?php _ex( 'Global', 'Indicator for global node templates.', 'fl-builder' ); ?>
		</div>
		<# } #>
		<span class="fl-builder-node-template-actions">
			<a class="fl-builder-node-template-edit" href="{{data.link}}" target="_blank">
				<i class="fa fa-wrench"></i>
			</a>
			<a class="fl-builder-node-template-delete" href="javascript:void(0);">
				<i class="fa fa-times"></i>
			</a>
		</span>
	</span>
</script>
<!-- #tmpl-fl-node-template-block -->