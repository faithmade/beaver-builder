<?php

// Get the query data.
$query  = FLBuilderLoop::query( $settings );
$layout = isset( $settings->layout ) ? $settings->layout : 'grid';

// Render the posts.
if( $query->have_posts() ) :

?>

	<div class="fl-post-carousel fl-post-carousel-<?php echo $layout ?>" itemscope="itemscope" itemtype="http://schema.org/Blog">
		<div class="fl-post-carousel-wrapper">
			<?php

			while( $query->have_posts() ) {

				$query->the_post();

				include $module->dir . 'includes/post-' . $layout . '-loop.php';

			}

			?>
		</div>
		<?php

		// Render the navigation.
		if( $settings->navigation == 'yes' && $query->have_posts() ) : ?>
			<div class="fl-post-carousel-navigation">
				<a class="carousel-prev" href="#"><div class="fl-post-carousel-svg-container"><?php include FL_BUILDER_DIR .'img/svg/arrow-left.svg'; ?></div></a>
				<a class="carousel-next" href="#"><div class="fl-post-carousel-svg-container"><?php include FL_BUILDER_DIR .'img/svg/arrow-right.svg'; ?></div></a>
			</div>
		<?php endif; ?>
	</div>

	<div class="fl-clear"></div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>