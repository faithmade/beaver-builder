.fl-node-<?php echo $id; ?> .fl-separator {
	border-top:<?php echo $settings->height; ?>px <?php echo $settings->style; ?> #<?php echo $settings->color; ?>;
	filter: alpha(opacity = <?php echo $settings->opacity; ?>);
	opacity: <?php echo $settings->opacity/100; ?>;
}