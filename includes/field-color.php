<div class="fl-color-picker<?php if(empty($value)) echo ' fl-color-picker-empty'; if(isset($field['class'])) echo ' ' . $field['class']; ?>">
	<div class="fl-color-picker-color fl-picker-<?php echo $name; ?>"></div>
	<?php if(isset($field['show_reset']) && $field['show_reset']) : ?>
	<div class="fl-color-picker-clear"></div>
	<?php endif; ?>
	<input name="<?php echo $name; ?>" type="hidden" value="<?php echo $value; ?>" class="fl-color-picker-value" />
</div>