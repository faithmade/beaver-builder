<form class="fl-builder-settings fl-template-selector">
	<div class="fl-lightbox-header">
		
		<h1><?php _e('Layout Templates', 'fl-builder'); ?></h1>
		
		<?php if ( $enabled_templates == 'enabled' || ( $enabled_templates == 'core' && count( $templates['categorized'] ) > 1 ) ) : ?>
		<div class="fl-template-category-filter fl-builder-settings-fields">
			<select class="fl-template-category-select" name="fl-template-category-select">
				
				<?php if($enabled_templates == 'enabled' || $enabled_templates == 'core') : ?>
					<?php $i = 0; foreach ( $templates['categorized'] as $slug => $category ) : ?>
					<option value="fl-builder-settings-tab-<?php echo $slug; ?>"><?php echo $category['name']; ?></option>
					<?php $i++; endforeach; ?>
				<?php endif; ?>
		
				<?php if($enabled_templates == 'enabled' || $enabled_templates == 'user') : ?>
				<option value="fl-builder-settings-tab-yours"><?php _e('Your Templates', 'fl-builder'); ?></option>
				<?php endif; ?>
				
			</select>
		</div>
		<?php endif; ?>
		
	</div>
	<div class="fl-builder-settings-fields fl-nanoscroller">
		<div class="fl-nanoscroller-content">

			<?php $i = 0; if($enabled_templates == 'enabled' || $enabled_templates == 'core') : ?>
			
				<?php foreach ( $templates['categorized'] as $slug => $category ) : ?>
				<div id="fl-builder-settings-tab-<?php echo $slug; ?>" class="fl-builder-settings-tab<?php if ( 0 === $i ) echo ' fl-active'; ?>">
					<div class="fl-builder-settings-section">
						<?php $k = 0; foreach ( $category['templates'] as $template ) : ?>
						<div class="fl-template-preview<?php if(($k + 1) % 3 === 0) echo ' fl-last'; ?>" data-id="<?php echo $template['id']; ?>">
							<div class="fl-template-image">
								<img src="<?php echo $template['image']; ?>" />
							</div>
							<span><?php echo $template['name']; ?></span>
						</div>
						<?php $k++; endforeach; ?>
					</div>
				</div>
				<?php $i++; endforeach; ?>

			<?php endif; ?>

			<?php if($enabled_templates == 'enabled' || $enabled_templates == 'user') : ?>

			<div id="fl-builder-settings-tab-yours" class="fl-builder-settings-tab">

				<div class="fl-builder-settings-section">

					<p class="fl-builder-settings-message fl-user-templates-message"><?php _e('You haven\'t saved any templates yet! To do so, create a layout and save it as a template under <strong>Tools &rarr; Save Template</strong>.', 'fl-builder'); ?></p>

					<?php if(count($user_templates['templates']) > 0) : ?>
					<div class="fl-user-templates">
						<div class="fl-user-template" data-id="blank">
							<span class="fl-user-template-name"><?php _ex( 'Blank', 'Template name.', 'fl-builder' ); ?></span>
							<div class="fl-clear"></div>
						</div>
						<?php foreach($user_templates['categorized'] as $category) : ?>
						
						<div class="fl-user-template-category">
							<?php if ( count( $user_templates['categorized'] ) > 1 ) : ?>
							<div class="fl-user-template-category-name"><?php echo $category['name']; ?></div>
							<?php endif; ?>
							<?php foreach($category['templates'] as $template) : ?>
							<div class="fl-user-template" data-id="<?php echo $template['id']; ?>">
								<div class="fl-user-template-actions">
									<a class="fl-user-template-edit" href="<?php echo add_query_arg('fl_builder', '', get_permalink($template['id'])); ?>"><?php _e('Edit', 'fl-builder'); ?></a>
									<a class="fl-user-template-delete" href="javascript:void(0);" onclick="return false;"><?php _e('Delete', 'fl-builder'); ?></a>
								</div>
								<span class="fl-user-template-name"><?php echo $template['name']; ?></span>
								<div class="fl-clear"></div>
							</div>
							<?php endforeach; ?>
						</div>
							
						<?php endforeach; ?>
						<div class="fl-clear"></div>
					</div>
					<?php endif; ?>

				</div>
			</div>

			<?php endif; ?>

		</div>
	</div>
	<div class="fl-lightbox-footer">
		<span class="fl-builder-settings-cancel fl-builder-button fl-builder-button-large" href="javascript:void(0);" onclick="return false;"><?php _e('Cancel', 'fl-builder'); ?></span>
	</div>
</form>