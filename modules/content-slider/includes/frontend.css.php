.fl-node-<?php echo $id; ?> .fl-content-slider,
.fl-node-<?php echo $id; ?> .fl-slide {
	min-height: <?php echo $settings->height; ?>px;
}
.fl-node-<?php echo $id; ?> .fl-slide-foreground {
	margin: 0 auto;
	max-width: <?php echo $settings->max_width; ?>px;
}
<?php

for($i = 0; $i < count($settings->slides); $i++) {

	// Make sure we have a slide.
	if(!is_object($settings->slides[$i])) {
		continue;
	}

	// Slide Settings 
	$slide = $settings->slides[$i]; 
	
	// Slide Background Color
	if($slide->bg_layout == 'color' && !empty($slide->bg_color)) {
		echo '.fl-node-'. $id .' .fl-slide-'. $i;
		echo ' { background-color: #'. $slide->bg_color .'; }';
	}
	
	// Foreground Photo/Video
	if($slide->content_layout == 'photo' || $slide->content_layout == 'video') {
	
		$photo_width = 100 - $slide->text_width;
		
		// Foreground Photo/Video Width
		if($slide->text_position != 'center') {
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-photo-wrap ';
			echo '{ width: '. $photo_width .'%; }';
		}
		
		// Foreground Photo/Video Margins
		if($slide->text_position == 'left') {
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-photo ';
			echo '{ margin-right: '. $slide->text_margin_left .'px; ';
			echo 'margin-top: '. $slide->text_margin_top .'px; ';
			echo 'margin-bottom: '. $slide->text_margin_bottom .'px; }'; 
		}
		else if($slide->text_position == 'center') {
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-photo ';
			echo '{ margin-left: '. $slide->text_margin_left .'px; ';
			echo 'margin-right: '. $slide->text_margin_right .'px; ';
			echo 'margin-bottom: '. $slide->text_margin_bottom .'px; }'; 
		}
		else if($slide->text_position == 'right') {
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-photo ';
			echo '{ margin-left: '. $slide->text_margin_right .'px; ';
			echo 'margin-top: '. $slide->text_margin_top .'px; ';
			echo 'margin-bottom: '. $slide->text_margin_bottom .'px; }'; 
		}
	}
	
	// Text Width and Margins
	if($slide->content_layout != 'none') {
	
		// Content wrap width
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-content-wrap ';
		echo '{ width: '. $slide->text_width .'%; }';
		
		// Margins
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-content ';
		echo '{ margin-right: '. $slide->text_margin_right .'px; ';
		echo 'margin-left: '. $slide->text_margin_left .'px; ';
		
		// 100% height, don't use top/bottom margins
		if($slide->text_bg_height == '100%' && !empty($slide->text_bg_color)) {
		
			// Content height
			echo ' min-height: '. $settings->height .'px; }';
			
			// Content wrap height
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-content-wrap ';
			echo '{ min-height: '. $settings->height .'px; }';
		}
		// Auto height, use top/bottom margins
		else {
			echo 'margin-top: '. $slide->text_margin_top .'px; ';
			echo 'margin-bottom: '. $slide->text_margin_bottom .'px; }'; 
		}
	}
	
	// Text Styles
	if($slide->title_size == 'custom') {
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-title ';
		echo '{ font-size: '. $slide->title_custom_size .'px; }';
	}
		
	// Text Color
	if(!empty($slide->text_color)) {
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-title, ';
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-text, ';
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-text * ';
		echo '{ color: #'. $slide->text_color .'; }';
	}
	
	// Text BG Color
	if(!empty($slide->text_bg_color)) {
		$r = hexdec(substr($slide->text_bg_color,0,2));
		$g = hexdec(substr($slide->text_bg_color,2,2));
		$b = hexdec(substr($slide->text_bg_color,4,2));
		$a = $slide->text_bg_opacity/100;
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-content ';
		echo '{ background-color: rgba('.$r.','.$g.','.$b.','.$a.'); padding: 30px; }';
	}
	
	// Text Shadow
	if($slide->text_shadow) {
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-title, ';
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-text ';
		echo '{ text-shadow: 0 0 5px rgba(0,0,0,0.3); }';
	}        
	
	// Responsive Text Styles
	if($global_settings->responsive_enabled) {
		echo '@media (max-width: '. $global_settings->responsive_breakpoint .'px) { ';
		
		// Responsive Text Color
		if(!empty($slide->r_text_color)) {
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-title, ';
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-text, ';
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-text * ';
			echo '{ color: #'. $slide->r_text_color .'; }';
		}
		else {
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-title, ';
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-text, ';
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-text * ';
			echo '{ color: inherit; }';
		}
		
		// Responsive Text BG Color
		if(!empty($slide->r_text_bg_color)) {
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-content ';
			echo '{ background-color: #'. $slide->r_text_bg_color .'; }';
		}
		else {
			echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-content ';
			echo '{ background-color: transparent; }';
		}
		
		// Responsive Text Shadow
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-title, ';
		echo '.fl-node-'. $id .' .fl-slide-'. $i .' .fl-slide-text ';
		echo '{ text-shadow: none; }';
		
		echo ' }';
	}
	
	// Button Styles
	if($slide->cta_type == 'button') {
		
		if ( ! isset( $slide->btn_style ) ) {
			$slide->btn_style = 'flat';
		}

		FLBuilder::render_module_css('button', $id . ' .fl-slide-'. $i, array(
			'align'             => '',
			'bg_color'          => $slide->btn_bg_color,
			'bg_hover_color'    => $slide->btn_bg_hover_color,
			'bg_opacity'        => isset( $slide->btn_bg_opacity ) ? $slide->btn_bg_opacity : 0,
			'border_radius'     => $slide->btn_border_radius,
			'border_size'       => isset( $slide->btn_border_size ) ? $slide->btn_border_size : 2,
			'font_size'         => $slide->btn_font_size,
			'icon'              => isset( $slide->btn_icon ) ? $slide->btn_icon : '',
			'icon_position'     => isset( $slide->btn_icon_position ) ? $slide->btn_icon_position : '',
			'link'              => $slide->link,
			'link_target'       => $slide->link_target,
			'padding'           => $slide->btn_padding,
			'style'             => ( isset( $slide->btn_3d ) && $slide->btn_3d ) ? 'gradient' : $slide->btn_style,
			'text'              => $slide->cta_text,
			'text_color'        => $slide->btn_text_color,
			'text_hover_color'  => $slide->btn_text_hover_color,
			'width'             => 'auto'
		));
	}
}