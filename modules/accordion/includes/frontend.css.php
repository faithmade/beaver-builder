.fl-node-<?php echo $id; ?> .fl-accordion-item {

	border: 1px solid #<?php echo $settings->border_color; ?>;
	
	<?php if($settings->item_spacing == 0) : ?>

	border-bottom: none;
	
	<?php else : ?>
	
	margin-bottom: <?php echo $settings->item_spacing; ?>px;
	
	<?php endif; ?>
}

<?php if($settings->item_spacing == 0) : ?>

.fl-node-<?php echo $id; ?> .fl-accordion-item:last-child {
	border-bottom: 1px solid #<?php echo $settings->border_color; ?>;
}

<?php endif; ?>