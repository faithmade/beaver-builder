.fl-node-<?php echo $id; ?> <?php echo $settings->tag; ?>.fl-heading {
	text-align: <?php echo $settings->alignment; ?>;
	<?php if($settings->font_size == 'custom') : ?>
	font-size: <?php echo $settings->custom_font_size; ?>px;
	<?php endif; ?>
}
<?php if(!empty($settings->color)) : ?>
.fl-node-<?php echo $id; ?> <?php echo $settings->tag; ?>.fl-heading a,
.fl-node-<?php echo $id; ?> <?php echo $settings->tag; ?>.fl-heading .fl-heading-text,
.fl-node-<?php echo $id; ?> <?php echo $settings->tag; ?>.fl-heading .fl-heading-text * {
	color: #<?php echo $settings->color; ?>;
}
<?php endif; ?>
<?php if($global_settings->responsive_enabled && ($settings->r_font_size == 'custom' || $settings->r_alignment == 'custom')) : ?>
@media (max-width: <?php echo $global_settings->responsive_breakpoint; ?>px) {
	
	<?php if($settings->r_font_size == 'custom') : ?>
	.fl-node-<?php echo $id; ?> <?php echo $settings->tag; ?>.fl-heading {
		font-size: <?php echo $settings->r_custom_font_size; ?>px;
	}
	<?php endif; ?>
	
	<?php if($settings->r_alignment == 'custom') : ?>
	.fl-node-<?php echo $id; ?> <?php echo $settings->tag; ?>.fl-heading {
		text-align: <?php echo $settings->r_custom_alignment; ?>;
	}
	<?php endif; ?>
}    
<?php endif; ?>