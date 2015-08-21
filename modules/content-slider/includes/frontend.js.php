(function($) {

	$(function() {
	
		var slider = $('.fl-node-<?php echo $id; ?> .fl-content-slider').bxSlider({
			adaptiveHeight: true,
			auto: <?php if($settings->auto_play) echo 'true'; else echo 'false'; ?>,
			autoHover: true,
			autoControls: <?php if($settings->play_pause) echo 'true'; else echo 'false'; ?>,
			pause: <?php echo $settings->delay * 1000; ?>,
			mode: '<?php echo $settings->transition; ?>',
			speed: <?php echo $settings->speed * 1000; ?>,
			controls: <?php if($settings->arrows) echo 'true'; else echo 'false'; ?>,
			pager: <?php if($settings->dots) echo 'true'; else echo 'false'; ?>,
			video: true,
			onSliderLoad: function() { 
				$('.fl-node-<?php echo $id; ?> .fl-content-slider').addClass('fl-content-slider-loaded'); 
			}
		});
	   
		// Store a reference to the slider.
		slider.data('bxSlider', slider); 
	});

})(jQuery);