.fl-builder-content .fl-node-<?php echo $id; ?> .fl-pricing-table-features  {
	min-height: <?php echo $settings->min_height; ?>px;
}

<?php

for($i = 0; $i < count($settings->pricing_columns); $i++) :

	if(!is_object($settings->pricing_columns[$i])) continue;

	// Slide Settings
	$pricing_column = $settings->pricing_columns[$i];
?>

.fl-builder-content .fl-node-<?php echo $id; ?> .fl-pricing-table-column-<?php echo $i; ?> {
	border: 1px solid #<?php echo FLBuilderColor::adjust_brightness($pricing_column->background, 30, 'darken'); ?>;
	background: #<?php echo $pricing_column->background; ?>;
	margin-top: <?php echo $pricing_column->margin; ?>px;
}
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-pricing-table-column-<?php echo $i; ?> .fl-pricing-table-inner-wrap {
	background: #<?php echo $pricing_column->foreground; ?>;
	border: 1px solid #<?php echo FLBuilderColor::adjust_brightness($pricing_column->background, 30, 'darken'); ?>;
}
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-pricing-table-column-<?php echo $i; ?> h2 {
	font-size: <?php echo $pricing_column->title_size; ?>px;
}
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-pricing-table-column-<?php echo $i; ?> .fl-pricing-table-price {
	background: #<?php echo $pricing_column->column_background; ?>;
	color: #<?php echo $pricing_column->column_color; ?>;
	font-size: <?php echo $pricing_column->price_size; ?>px;
}
.fl-builder-content .fl-node-<?php echo $id; ?> .fl-pricing-table-column-<?php echo $i; ?> a.fl-button {
	background: #<?php echo $pricing_column->column_background; ?>;
	color: #<?php echo $pricing_column->column_color; ?>;
	border-color: #<?php echo FLBuilderColor::adjust_brightness($pricing_column->column_background, 20, 'darken'); ?>;
}

<?php

endfor;

?>
