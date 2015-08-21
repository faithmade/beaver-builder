<?php

FLBuilder::render_module_css('icon', $id, array(
	'align'          => '',
	'bg_color'       => $settings->bg_color,
	'bg_hover_color' => $settings->bg_hover_color,
	'color'          => $settings->color,
	'hover_color'    => $settings->hover_color,
	'icon'           => '',
	'link'           => '',
	'link_target'    => '',
	'size'           => $settings->size,
	'text'           => '',
	'three_d'        => $settings->three_d
));

?>

/* Left */
.fl-node-<?php echo $id; ?> .fl-icon-group-left .fl-icon {
	margin-right: <?php echo $settings->spacing; ?>px;
}

/* Center */
.fl-node-<?php echo $id; ?> .fl-icon-group-center .fl-icon {
	margin-left: <?php echo $settings->spacing; ?>px;
	margin-right: <?php echo $settings->spacing; ?>px;
}

/* Right */
.fl-node-<?php echo $id; ?> .fl-icon-group-right .fl-icon {
	margin-left: <?php echo $settings->spacing; ?>px;
}