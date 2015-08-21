<?php if($settings->layout == 'collage') : ?>
<div class="fl-mosaicflow">
	<div class="fl-mosaicflow-content">
		<?php foreach($module->get_photos() as $photo) : ?>
		<div class="fl-mosaicflow-item">
		<?php 
		
		FLBuilder::render_module_html('photo', array(
			'crop'          => false,
			'link_target'   => '_self',
			'link_type'     => $settings->click_action == 'none' ? '' : 'url',
			'link_url'      => $settings->click_action == 'none' ? '' : $photo->link,
			'photo'         => $photo,
			'photo_src'     => $photo->src,
			'show_caption'  => $settings->show_captions
		)); 
		
		?>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="fl-clear"></div>
</div>
<?php else : ?>
<div class="fl-gallery">
	<?php foreach($module->get_photos() as $photo) : ?>
	<div class="fl-gallery-item">
	<?php 
	
	FLBuilder::render_module_html('photo', array(
		'crop'          => false,
		'link_target'   => '_self',
		'link_type'     => $settings->click_action == 'none' ? '' : 'url',
		'link_url'      => $settings->click_action == 'none' ? '' : $photo->link,
		'photo'         => $photo,
		'photo_src'     => $photo->src,
		'show_caption'  => $settings->show_captions
	)); 
	
	?>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>