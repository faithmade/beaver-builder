<?php

// Get the query data.
$query = FLBuilderLoop::query( $settings );

// Render the posts.
if( $query->have_posts() ) :

?>

	<div class="fl-post-slider" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="fl-post-slider-wrapper">
			
			<?php

				while( $query->have_posts() ) {

					$query->the_post();

					include $module->dir . 'includes/post-loop.php';

				}

				?>
		</div>
	<?php

	// Render the navigation.
	if( $settings->navigation == 'yes' && $query->have_posts() ) : ?>
		<div class="fl-post-slider-navigation">
			<a class="slider-prev" href="#"><div class="fl-post-slider-svg-container"><?php include FL_BUILDER_DIR .'img/svg/arrow-left.svg'; ?></div></a>
			<a class="slider-next" href="#"><div class="fl-post-slider-svg-container"><?php include FL_BUILDER_DIR .'img/svg/arrow-right.svg'; ?></div></a>
		</div>
	<?php endif; ?>
	</div>
	<div class="fl-clear"></div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>