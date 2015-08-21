<div class="fl-accordion fl-accordion-<?php echo $settings->label_size; if ( $settings->collapse ) echo ' fl-accordion-collapse'; ?>">
	<?php for ( $i = 0; $i < count( $settings->items ); $i++ ) : if ( empty( $settings->items[ $i ] ) ) continue; ?>
	<div class="fl-accordion-item"<?php if ( ! empty( $settings->id ) ) echo ' id="' . sanitize_html_class( $settings->id ) . '-' . $i . '"'; ?>>
		<div class="fl-accordion-button">
			<span class="fl-accordion-button-label"><?php echo $settings->items[ $i ]->label; ?></span>
			<i class="fl-accordion-button-icon fa fa-plus"></i>
		</div>
		<div class="fl-accordion-content fl-clearfix"><?php echo $settings->items[ $i ]->content; ?></div>
	</div>
	<?php endfor; ?>
</div>