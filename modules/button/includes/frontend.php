<div class="<?php echo $module->get_classname(); ?>">
	<a href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>" class="fl-button" role="button">
		<?php if ( ! empty( $settings->icon ) && ( 'before' == $settings->icon_position || ! isset( $settings->icon_position ) ) ) : ?>
		<i class="fl-button-icon fl-button-icon-before fa <?php echo $settings->icon; ?>"></i>
		<?php endif; ?>
		<span class="fl-button-text"><?php echo $settings->text; ?></span>
		<?php if ( ! empty( $settings->icon ) && 'after' == $settings->icon_position ) : ?>
		<i class="fl-button-icon fl-button-icon-after fa <?php echo $settings->icon; ?>"></i>
		<?php endif; ?>
	</a>
</div>