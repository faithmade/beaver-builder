<?php 
	
	// set defaults
	$layout         = isset( $settings->layout ) ? $settings->layout : 'grid';
	$autoplay       = !empty( $settings->speed ) ? $settings->speed * 1000 : '1000';
	$speed          = !empty( $settings->transition_duration ) ? $settings->transition_duration * 1000 : '1000';
	$slide_width    = !empty( $settings->slide_width ) ? $settings->slide_width : 300;
	$space_between  = isset( $settings->space_between ) ? $settings->space_between : 30;

 ?>

(function($) {

	$(function() {

	    new FLBuilderPostCarousel({
	    	id: '<?php echo $id ?>',
	    	layout: '<?php echo $layout ?>',
        <?php if( isset( $settings->navigation ) && $settings->navigation == 'yes' ): ?>
			navigationControls: true,
	    <?php endif; ?>
			slideWidth: <?php echo $slide_width ?>,
	    	settings: {
	        <?php if( isset( $settings->transition ) ): ?>
		        mode: 'horizontal',
		    <?php endif; ?>
	        <?php if( isset( $settings->pagination ) && $settings->pagination == 'no' ): ?>
		        pager: false,
		    <?php endif; ?>
	        <?php if( isset( $settings->auto_play ) ): ?>
		        auto: <?php echo $settings->auto_play ?>,
		    <?php else : ?>
		    	auto: false,
		    <?php endif; ?>
		        pause: <?php echo $autoplay ?>,
		        speed: <?php echo $speed ?>,
	        <?php if( isset( $settings->carousel_loop ) ): ?>
		        infiniteLoop: <?php echo $settings->carousel_loop ?>,
		    <?php else : ?>
		        infiniteLoop: false,
		    <?php endif; ?>
		    	adaptiveHeight: true,
		    	controls: false,
		    	autoHover: true,
		    	slideMargin: <?php echo $space_between ?>,
			    moveSlides: 1,
	    	}
	    });

	});

})(jQuery);