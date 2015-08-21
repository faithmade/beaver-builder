<?php 
	
	// set defaults
	$type 			= isset( $settings->menu_layout ) ? $settings->menu_layout : 'horizontal';
	$mobile 		= isset( $settings->mobile_toggle ) ? $settings->mobile_toggle : 'expanded';

 ?>

(function($) {

	$(function() {

	    new FLBuilderMenu({
	    	id: '<?php echo $id ?>',
	    	type: '<?php echo $type ?>',
	    	mobile: '<?php echo $mobile ?>',
			breakPoints: {
				medium: <?php echo $global_settings->medium_breakpoint ?>,
				small: <?php echo $global_settings->responsive_breakpoint ?>
			}
	    });

	});

})(jQuery);