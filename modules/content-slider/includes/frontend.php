<div class="fl-content-slider">
	<?php 
	
	for($i = 0; $i < count($settings->slides); $i++) : 
	
		if(!is_object($settings->slides[$i])) {
			continue;
		}
		else {
			$slide = $settings->slides[$i]; 
		}
	?>
	<div class="fl-slide fl-slide-<?php echo $i; ?> fl-slide-text-<?php echo $slide->text_position; ?>">
		<?php 
		
		// Mobile photo or video
		$module->render_mobile_media($slide);
		
		// Background photo or video
		$module->render_background($slide);
		
		?>
		<div class="fl-slide-foreground clearfix">
			<?php 
			
			// Content
			$module->render_content($slide);
			
			// Foreground photo or video
			$module->render_media($slide);
			
			?>
		</div>
		<div class="fl-clear"></div>
	</div>
	<?php endfor; ?>
</div>