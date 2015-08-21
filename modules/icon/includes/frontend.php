<?php if(!isset($settings->exclude_wrapper)) : ?>
<span class="fl-icon-wrap">
<?php endif; ?>
	<span class="fl-icon">
		<?php if(!empty($settings->link)) : ?>
		<a href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>">
		<?php endif; ?>
		<i class="<?php echo $settings->icon; ?>"></i> 
		<?php if(!empty($settings->link)) : ?></a><?php endif; ?>
	</span>
	
	<?php if(!empty($settings->text)) : ?>
	<span class="fl-icon-text">
		<?php if(!empty($settings->link)) : ?>
		<a href="<?php echo $settings->link; ?>" target="<?php echo $settings->link_target; ?>">
		<?php endif; ?>
		<?php echo $settings->text; ?>
		<?php if(!empty($settings->link)) : ?></a><?php endif; ?>
	</span>
	<?php endif; ?>
<?php if(!isset($settings->exclude_wrapper)) : ?>
</span>
<?php endif; ?>