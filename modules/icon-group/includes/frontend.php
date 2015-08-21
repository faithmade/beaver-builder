<div class="fl-icon-group fl-icon-group-<?php echo $settings->align; ?>">
<?php

foreach($settings->icons as $icon) {

	if(!is_object($icon)) {
		continue;
	}

	$icon_settings = array(
	'bg_color'       => $settings->bg_color,
		'bg_hover_color' => $settings->bg_hover_color,
		'color'          => $settings->color,
		'exclude_wrapper'=> true,
		'hover_color'    => $settings->hover_color,
		'icon'           => $icon->icon,
		'link'           => $icon->link,
		'link_target'    => '_blank',
		'size'           => $settings->size,
		'text'           => '',
		'three_d'        => $settings->three_d
	);
	
	FLBuilder::render_module_html('icon', $icon_settings);
}

?>
</div>