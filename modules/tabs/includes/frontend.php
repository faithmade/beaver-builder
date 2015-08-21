<div class="fl-tabs fl-tabs-<?php echo $settings->layout; ?> fl-clearfix">

	<div class="fl-tabs-labels fl-clearfix">
		<?php for($i = 0; $i < count($settings->items); $i++) : if(!is_object($settings->items[$i])) continue; ?>
		<div class="fl-tabs-label<?php if($i == 0) echo ' fl-tab-active'; ?>" data-index="<?php echo $i; ?>">
			<?php echo $settings->items[$i]->label; ?>
		</div>
		<?php endfor; ?>
	</div>
	
	<div class="fl-tabs-panels fl-clearfix">
		<?php for($i = 0; $i < count($settings->items); $i++) : if(!is_object($settings->items[$i])) continue; ?>
		<div class="fl-tabs-panel"<?php if ( ! empty( $settings->id ) ) echo ' id="' . sanitize_html_class( $settings->id ) . '-' . $i . '"'; ?>>
			<div class="fl-tabs-label fl-tabs-panel-label<?php if($i == 0) echo ' fl-tab-active'; ?>" data-index="<?php echo $i; ?>">
				<span><?php echo $settings->items[$i]->label; ?></span>
				<i class="fa<?php if($i > 0) echo ' fa-plus'; ?>"></i>
			</div>
			<div class="fl-tabs-panel-content<?php if($i == 0) echo ' fl-tab-active'; ?>" data-index="<?php echo $i; ?>">
				<?php echo $settings->items[$i]->content; ?>
			</div>
		</div>
		<?php endfor; ?>
	</div>
	
</div>