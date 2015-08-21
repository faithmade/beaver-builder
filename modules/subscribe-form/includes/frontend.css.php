.fl-subscribe-form .fl-form-field input,
.fl-subscribe-form .fl-form-field input[type=text] {
	font-size: <?php echo $settings->btn_font_size; ?>px;
	line-height: <?php echo $settings->btn_font_size + 2; ?>px;
	padding: <?php echo $settings->btn_padding . 'px ' . ( $settings->btn_padding * 2 ) . 'px'; ?>;
	border-radius: <?php echo $settings->btn_border_radius; ?>px;
	-moz-border-radius: <?php echo $settings->btn_border_radius; ?>px;
	-webkit-border-radius: <?php echo $settings->btn_border_radius; ?>px;
}
.fl-subscribe-form-inline .fl-form-field input,
.fl-subscribe-form-inline .fl-form-field input[type=text] {
	height: <?php echo ( $settings->btn_padding * 2 )  + ( $settings->btn_font_size + 4 ); ?>px;
}
.fl-subscribe-form-inline a.fl-button {
	height: <?php echo ( $settings->btn_padding * 2 )  + ( $settings->btn_font_size + 4 ); ?>px;
	line-height: <?php echo $settings->btn_font_size; ?>px !important;
}

<?php
	
FLBuilder::render_module_css('button', $id, array(
	'align'             => '',
	'bg_color'          => $settings->btn_bg_color,
	'bg_hover_color'    => $settings->btn_bg_hover_color,
	'bg_opacity'        => $settings->btn_bg_opacity,
	'border_radius'     => $settings->btn_border_radius,
	'border_size'       => $settings->btn_border_size,
	'font_size'         => $settings->btn_font_size,
	'icon'              => $settings->btn_icon,
	'icon_position'     => $settings->btn_icon_position,
	'link'              => '#',
	'link_target'       => '_self',
	'padding'           => $settings->btn_padding,
	'style'             => $settings->btn_style,
	'text'              => $settings->btn_text,
	'text_color'        => $settings->btn_text_color,
	'text_hover_color'  => $settings->btn_text_hover_color,
	'width'             => 'full'
));