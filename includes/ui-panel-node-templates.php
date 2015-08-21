<div class="fl-builder-blocks-separator"></div>

<?php if ( ! FLBuilderModel::is_post_user_template( 'row' ) ) : ?>
<div id="fl-builder-blocks-saved-rows" class="fl-builder-blocks-section fl-builder-blocks-node-template">
	<span class="fl-builder-blocks-section-title">
		<?php _e('Saved Rows', 'fl-builder'); ?>
		<i class="fa fa-chevron-down"></i>
	</span>
	<div class="fl-builder-blocks-section-content fl-builder-saved-rows">
		<?php if ( 0 === count( $saved_rows ) ) : ?>
		<span class="fl-builder-block-no-node-templates"><?php _e( 'No saved rows found.', 'fl-builder' ); ?></span>
		<?php endif; ?>
		<?php foreach ( $saved_rows as $saved_row ) : ?>
		<span class="fl-builder-block fl-builder-block-saved-row<?php if ( $saved_row['global'] ) echo ' fl-builder-block-global'; ?>" data-id="<?php echo $saved_row['id']; ?>">
			<span class="fl-builder-block-title"><?php echo $saved_row['name']; ?></span>
			<?php if ( $saved_row['global'] ) : ?>
			<div class="fl-builder-badge fl-builder-badge-global">
				<?php _ex( 'Global', 'Indicator for global node templates.', 'fl-builder' ); ?>
			</div>
			<?php endif; ?>
			<span class="fl-builder-node-template-actions">
				<a class="fl-builder-node-template-edit" href="<?php echo add_query_arg( 'fl_builder', '', $saved_row['link'] ); ?>" target="_blank">
					<i class="fa fa-wrench"></i>
				</a>
				<a class="fl-builder-node-template-delete" href="javascript:void(0);">
					<i class="fa fa-times"></i>
				</a>
			</span>
		</span>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>

<div id="fl-builder-blocks-saved-modules" class="fl-builder-blocks-section fl-builder-blocks-node-template">
	<span class="fl-builder-blocks-section-title">
		<?php _e('Saved Modules', 'fl-builder'); ?>
		<i class="fa fa-chevron-down"></i>
	</span>
	<div class="fl-builder-blocks-section-content fl-builder-saved-modules">
		<?php if ( 0 === count( $saved_modules ) ) : ?>
		<span class="fl-builder-block-no-node-templates"><?php _e( 'No saved modules found.', 'fl-builder' ); ?></span>
		<?php endif; ?>
		<?php foreach ( $saved_modules as $saved_module ) : ?>
		<span class="fl-builder-block fl-builder-block-saved-module<?php if ( $saved_module['global'] ) echo ' fl-builder-block-global'; ?>" data-id="<?php echo $saved_module['id']; ?>">
			<span class="fl-builder-block-title"><?php echo $saved_module['name']; ?></span>
			<?php if ( $saved_module['global'] ) : ?>
			<div class="fl-builder-badge fl-builder-badge-global">
				<?php _ex( 'Global', 'Indicator for global node templates.', 'fl-builder' ); ?>
			</div>
			<?php endif; ?>
			<span class="fl-builder-node-template-actions">
				<a class="fl-builder-node-template-edit" href="<?php echo $saved_module['link']; ?>" target="_blank">
					<i class="fa fa-wrench"></i>
				</a>
				<a class="fl-builder-node-template-delete" href="javascript:void(0);">
					<i class="fa fa-times"></i>
				</a>
			</span>
		</span>
		<?php endforeach; ?>
	</div>
</div>