(function($) {
	
	$(function() {
		
		<?php if($settings->layout == 'collage') : ?>
		$('.fl-node-<?php echo $id; ?> .fl-mosaicflow-content').mosaicflow({
			itemSelector: '.fl-mosaicflow-item',
			columnClass: 'fl-mosaicflow-col',
			minItemWidth: <?php echo $settings->photo_size; ?>
		});
		<?php else : ?>
		$('.fl-node-<?php echo $id; ?> .fl-gallery-item').wookmark({
			align: 'center',
			autoResize: true,
			container: $('.fl-node-<?php echo $id; ?> .fl-gallery'),
			offset: <?php echo $settings->photo_spacing; ?>,
			itemWidth: 150
		});
		<?php endif; ?>
		
		<?php if($settings->click_action == 'lightbox') : ?>
		$('.fl-node-<?php echo $id; ?> .fl-mosaicflow-content, .fl-node-<?php echo $id; ?> .fl-gallery').magnificPopup({
			closeBtnInside: false,
			delegate: '.fl-photo-content a',
			type: 'image',
			gallery: {
				enabled: true
			}
		});
		<?php endif; ?>
	});
	
})(jQuery);