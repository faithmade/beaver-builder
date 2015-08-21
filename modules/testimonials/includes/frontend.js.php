(function($) {

	// Clear the controls in case they were already created.
	$('.fl-node-<?php echo $id; ?> .fl-slider-next').empty();
	$('.fl-node-<?php echo $id; ?> .fl-slider-prev').empty();
	
	// Create the slider.
	$('.fl-node-<?php echo $id; ?> .fl-testimonials').bxSlider({
		autoStart : <?php echo $settings->auto_play ?>,
		auto : true,
		adaptiveHeight: true,
		pause : <?php echo $settings->pause * 1000; ?>,
		mode : '<?php echo $settings->transition; ?>',
		speed : <?php echo $settings->speed * 1000;  ?>,
		pager : <?php echo ($settings->layout == 'wide') ? $settings->dots : 0; ?>,
		nextSelector : '.fl-node-<?php echo $id; ?> .fl-slider-next',
		prevSelector : '.fl-node-<?php echo $id; ?> .fl-slider-prev',
		nextText: '<i class="fa fa-chevron-circle-right"></i>',
		prevText: '<i class="fa fa-chevron-circle-left"></i>',
		controls : <?php echo ($settings->layout == 'compact') ? $settings->arrows : 0; ?>,
		onSliderLoad: function() { 
			$('.fl-node-<?php echo $id; ?> .fl-testimonials').addClass('fl-testimonials-loaded'); 
		}
	});

})(jQuery);