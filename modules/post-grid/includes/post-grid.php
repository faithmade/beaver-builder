<div class="fl-post-grid-post" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">

	<?php if(has_post_thumbnail() && $settings->show_image) : ?>
	<div class="fl-post-grid-image">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail($settings->image_size); ?>
		</a>
	</div>
	<?php endif; ?>

	<div class="fl-post-grid-text">

		<h2 class="fl-post-grid-title" itemprop="headline">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</h2>

		<?php if($settings->show_author || $settings->show_date) : ?>
		<div class="fl-post-grid-meta">
			<?php if($settings->show_author) : ?>
				<span class="fl-post-grid-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
				<?php

				printf(
					_x( 'By %s', '%s stands for author name.', 'fl-builder' ),
					'<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" itemprop="url"><span itemprop="name">' . get_the_author_meta( 'display_name', get_the_author_meta( 'ID' ) ) . '</span></a>'
				);

				?>
				</span>
			<?php endif; ?>
			<?php if($settings->show_date) : ?>
				<?php if($settings->show_author) : ?>
					<span> | </span>
				<?php endif; ?>
				<span class="fl-post-feed-date" itemprop="datePublished" datetime="<?php echo the_time('Y-m-d'); ?>">
					<?php the_time($settings->date_format); ?>
				</span>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if($settings->show_content) : ?>
		<div class="fl-post-grid-content">
			<?php the_excerpt(); ?>
			<?php if($settings->show_more_link) : ?>
			<a class="fl-post-grid-more" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $settings->more_link_text; ?></a>
			<?php endif; ?>
		</div>
		<?php endif; ?>

	</div>

</div>