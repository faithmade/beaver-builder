<?php

if($settings->three_d) {
	$bg_grad_start = FLBuilderColor::adjust_brightness($settings->bg_color, 30, 'lighten');
	$border_color = FLBuilderColor::adjust_brightness($settings->bg_color, 20, 'darken');
}
if($settings->three_d && !empty($settings->bg_hover_color)) {
	$bg_hover_grad_start = FLBuilderColor::adjust_brightness($settings->bg_hover_color, 30, 'lighten');
	$border_hover_color = FLBuilderColor::adjust_brightness($settings->bg_hover_color, 20, 'darken');
}

?>
<?php // Alignment ?>
<?php if(!isset($settings->exclude_wrapper)) : ?>
.fl-node-<?php echo $id; ?>.fl-module-icon {
	text-align: <?php echo $settings->align; ?>
}
<?php endif; ?>
.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon i,
.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon i:before {
	<?php if($settings->color) : ?>
	color: #<?php echo $settings->color; ?>;
	<?php endif; ?>
	font-size: <?php echo $settings->size; ?>px;
	height: auto;
	width: auto;
	<?php if($settings->bg_color) : // Rounded Styles ?>
	background: #<?php echo $settings->bg_color; ?>;
	border-radius: 100%;
	-moz-border-radius: 100%;
	-webkit-border-radius: 100%;
	line-height: <?php echo $settings->size * 1.75; ?>px;
	height: <?php echo $settings->size * 1.75; ?>px;
	width: <?php echo $settings->size * 1.75; ?>px;
	text-align: center;
	<?php endif; ?>
	<?php if($settings->bg_color && $settings->three_d) : // 3D Styles ?>
	background: -moz-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%, #<?php echo $settings->bg_color; ?> 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $bg_grad_start; ?>), color-stop(100%,#<?php echo $settings->bg_color; ?>)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #<?php echo $bg_grad_start; ?> 0%,#<?php echo $settings->bg_color; ?> 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $bg_grad_start; ?>', endColorstr='#<?php echo $settings->bg_color; ?>',GradientType=0 ); /* IE6-9 */
	border: 1px solid #<?php echo $border_color; ?>;
	<?php endif; ?>
}
.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon i:hover,
.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon i:hover:before,
.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon a:hover i,
.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon a:hover i:before {
	<?php if(!empty($settings->bg_hover_color)) : ?>
	background: #<?php echo $settings->bg_hover_color; ?>;
	<?php endif; ?>
	<?php if($settings->three_d && !empty($settings->bg_hover_color)) : // 3D Styles ?>
	background: -moz-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%, #<?php echo $settings->bg_hover_color; ?> 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#<?php echo $bg_hover_grad_start; ?>), color-stop(100%,#<?php echo $settings->bg_hover_color; ?>)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #<?php echo $bg_hover_grad_start; ?> 0%,#<?php echo $settings->bg_hover_color; ?> 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#<?php echo $bg_hover_grad_start; ?>', endColorstr='#<?php echo $settings->bg_hover_color; ?>',GradientType=0 ); /* IE6-9 */
	border: 1px solid #<?php echo $border_hover_color; ?>;
	<?php endif; ?>
	<?php if(!empty($settings->hover_color)) : ?>
	color: #<?php echo $settings->hover_color; ?>;
	<?php endif; ?>
}
.fl-node-<?php echo $id; ?> .fl-module-content .fl-icon-text {
	height: <?php echo $settings->size * 1.75; ?>px;
}