<?php 

	// defaults
	$text_width             = !empty( $settings->text_width ) ? $settings->text_width : '50';
	$text_position          = isset( $settings->text_position ) ? $settings->text_position : 'left';
	$thumb_text_position    = isset( $settings->thumb_text_position ) && $settings->thumb_text_position == 'right' ? 'left' : 'right';
	$padding 		        = !empty( $settings->text_padding ) ? $settings->text_padding : '50';
	$text_bg_height         = !empty( $settings->text_bg_height ) ? $settings->text_bg_height : '100%';

 ?>

<?php if( $global_settings->responsive_enabled ) : ?>
	
	<?php if( isset( $settings->image_type ) && $settings->image_type == 'background' ) : ?>

		.fl-node-<?php echo $id; ?> .fl-post-slider-background .fl-post-slider-content{
			position: relative;
			z-index: 10;
			padding: <?php echo $padding ?>px;
		<?php if( !empty( $settings->text_color ) ) : ?>
			color: #<?php echo $settings->text_color ?>;
		<?php endif; ?>
		<?php if( !empty( $settings->text_bg_color ) ) : ?>
			background-color: #<?php echo $settings->text_bg_color ?>;
		<?php endif; ?>
		}

		.fl-node-<?php echo $id; ?> .fl-post-slider-background .fl-post-slider-content-bg{
			display: none;
			position: absolute;
			top: 0;
			z-index: 5;
		}

	<?php elseif( isset( $settings->image_type ) && $settings->image_type == 'thumb' ) : ?>

		.fl-node-<?php echo $id; ?> .fl-post-slider-thumb{
		<?php if( !empty( $settings->text_color ) ) : ?>
			color: #<?php echo $settings->text_color ?>;
		<?php endif; ?>
		<?php if( !empty( $settings->text_bg_color ) ) : ?>
			background-color: #<?php echo $settings->text_bg_color ?>;
		<?php endif; ?>
			padding: <?php echo $padding ?>px;
		}
		.fl-node-<?php echo $id; ?> .fl-photo-content{
			display: block;
		}
		.fl-node-<?php echo $id; ?> .fl-post-slider-img{
			padding: 0 0 <?php echo $padding; ?>px 0;
		}
		.fl-node-<?php echo $id; ?> .fl-photo-content img{
			max-width: 100%;
			vertical-align: top;
		}

	<?php endif; ?>

	.fl-node-<?php echo $id; ?> .fl-post-slider-no-thumb{
		padding: <?php echo $padding; ?>px;
	<?php if( !empty( $settings->text_color ) ) : ?>
		color: #<?php echo $settings->text_color ?>;
	<?php endif; ?>
	<?php if( !empty( $settings->text_bg_color ) ) : ?>
		background-color: #<?php echo $settings->text_bg_color ?>;
	<?php endif; ?>
	}

	@media ( min-width: <?php echo $global_settings->responsive_breakpoint ?>px ) {

		.fl-node-<?php echo $id; ?> .fl-post-slider-post {
			min-height: <?php echo $settings->height; ?>px;
		}

		.fl-node-<?php echo $id; ?> .fl-slide-bg-photo {
			display: block;
		}

		.fl-node-<?php echo $id; ?> .fl-post-slider-mobile-img {
			display: none;
		}

		<?php if( isset( $settings->image_type ) && $settings->image_type == 'background' ) : ?>

		<?php if( $text_bg_height == '100%' && in_array( $text_position, array( 'left', 'right' ) ) ) : ?>

			.fl-node-<?php echo $id; ?> .fl-post-slider-background .fl-post-slider-content{
				width: <?php echo $text_width ?>%;
				float: <?php echo $text_position ?>;
				background: transparent;
			}

			.fl-node-<?php echo $id; ?> .fl-post-slider-background .fl-post-slider-content-bg{
				display: block;
				<?php echo $text_position ?>: 0;
				width: <?php echo $text_width ?>%;
				height: 100%;
				<?php $module->render_slider_gradient_bg() ?>		
			}

		<?php else : ?>

			.fl-node-<?php echo $id; ?> .fl-post-slider-background .fl-post-slider-content{
				<?php if( in_array( $text_position, array( 'left', 'right' ) ) ): ?>
					width: <?php echo $text_width ?>%;
					float: <?php echo $text_position ?>;
					min-height: <?php echo $text_bg_height ?>;
				<?php else: ?>
					position: absolute;
					left: 0;
					right: 0;
					bottom: 0;
				<?php endif; ?>
				<?php $module->render_slider_gradient_bg() ?>		
			}

		<?php endif; ?>

		<?php elseif( isset( $settings->image_type ) && $settings->image_type == 'thumb' ) : ?>

			.fl-node-<?php echo $id; ?> .fl-post-slider-thumb{
				min-height: <?php echo $settings->height; ?>px;
				overflow: hidden;
			}
			.fl-node-<?php echo $id; ?> .fl-post-slider-thumb .fl-post-slider-content{
				<?php if( in_array( $settings->thumb_text_position, array( 'left', 'right' ) ) ): ?>
					width: <?php echo $text_width ?>%;
					float: <?php echo $thumb_text_position ?>;
				<?php endif; ?>
			}
			.fl-node-<?php echo $id; ?> .fl-post-slider-img{
				<?php if( in_array( $settings->thumb_text_position, array( 'left', 'right' ) ) ): ?>
					width: <?php echo ( 100 - $text_width ) ?>%;
					float: <?php echo $thumb_text_position ?>;
					<?php if( $thumb_text_position == 'left' ) : ?>
						padding: 0 <?php echo $padding; ?>px 0 0;
					<?php else : ?>
						padding: 0 0 0 <?php echo $padding; ?>px;
					<?php endif; ?>	

				<?php endif; ?>
			}

		<?php endif; ?>

	}

<?php else : ?>

	.fl-node-<?php echo $id; ?> .fl-post-slider-post {
		min-height: <?php echo $settings->height; ?>px;
	}

	<?php if( isset( $settings->image_type ) && $settings->image_type == 'background' ) : ?>

		.fl-node-<?php echo $id; ?> .fl-post-slider-background .fl-post-slider-content{
			position: relative;
			<?php if( in_array( $text_position, array( 'left', 'right' ) ) ): ?>
				width: <?php echo $text_width ?>%;
				float: <?php echo $text_position ?>;
			<?php else: ?>
				position: absolute;
				left: 0;
				right: 0;
				bottom: 0;
			<?php endif; ?>
				height: <?php echo $text_bg_height ?>;
				padding: <?php echo $padding; ?>px;
			<?php if( !empty( $settings->text_color ) ) : ?>
				color: #<?php echo $settings->text_color ?>;
			<?php endif; ?>
			<?php $module->render_slider_gradient_bg() ?>
		}

	<?php if( $text_bg_height == '100%' && in_array( $text_position, array( 'left', 'right' ) ) ) : ?>

		.fl-node-<?php echo $id; ?> .fl-post-slider-background .fl-post-slider-content{
			position: relative;
			width: <?php echo $text_width ?>%;
			float: <?php echo $text_position ?>;
			background: transparent;
		}

		.fl-node-<?php echo $id; ?> .fl-post-slider-background .fl-post-slider-content-bg{
			display: block;
			position: absolute;
			top: 0;
			<?php echo $text_position ?>: 0;
			width: <?php echo $text_width ?>%;
			height: 100%;
			<?php $module->render_slider_gradient_bg() ?>		
		}

	<?php else : ?>

		.fl-node-<?php echo $id; ?> .fl-post-slider-background .fl-post-slider-content{
			position: relative;
			<?php if( in_array( $text_position, array( 'left', 'right' ) ) ): ?>
				width: <?php echo $text_width ?>%;
				float: <?php echo $text_position ?>;
				height: <?php echo $text_bg_height ?>;
			<?php else: ?>
				position: absolute;
				left: 0;
				right: 0;
				bottom: 0;
			<?php endif; ?>
				padding: <?php echo $padding; ?>px;
			<?php if( !empty( $settings->text_color ) ) : ?>
				color: #<?php echo $settings->text_color ?>;
			<?php endif; ?>
			<?php $module->render_slider_gradient_bg() ?>
		}

	<?php endif; ?>

	<?php elseif( isset( $settings->image_type ) && $settings->image_type == 'thumb' ) : ?>

		.fl-node-<?php echo $id; ?> .fl-post-slider-thumb{
			min-height: <?php echo $settings->height; ?>px;
			padding: <?php echo $padding; ?>px;
			overflow: hidden;
			<?php if( !empty( $settings->text_color ) ) : ?>
				color: #<?php echo $settings->text_color ?>;
			<?php endif; ?>
			<?php if( !empty( $settings->text_bg_color ) ) : ?>
				background-color: #<?php echo $settings->text_bg_color ?>;
			<?php endif; ?>
		}
		.fl-node-<?php echo $id; ?> .fl-post-slider-thumb .fl-post-slider-content{
			<?php if( in_array( $settings->thumb_text_position, array( 'left', 'right' ) ) ): ?>
				width: <?php echo $text_width ?>%;
				float: <?php echo $thumb_text_position ?>;
			<?php endif; ?>
		}
		.fl-node-<?php echo $id; ?> .fl-photo-content{
			display: block;
		}
		.fl-node-<?php echo $id; ?> .fl-post-slider-img{
			<?php if( in_array( $settings->thumb_text_position, array( 'left', 'right' ) ) ): ?>
				width: <?php echo ( 100 - $text_width ) ?>%;
				float: <?php echo $thumb_text_position ?>;
				<?php if( $thumb_text_position == 'left' ) : ?>
					padding: 0 <?php echo $padding; ?>px 0 0;
				<?php else : ?>
					padding: 0 0 0 <?php echo $padding; ?>px;
				<?php endif; ?>	
			<?php endif; ?>
		}
		.fl-node-<?php echo $id; ?> .fl-photo-content img{
			width: 100% !important;
			vertical-align: top;
		}

	<?php endif; ?>

	.fl-node-<?php echo $id; ?> .fl-post-slider-no-thumb{
		padding: <?php echo $padding; ?>px;
	<?php if( !empty( $settings->text_color ) ) : ?>
		color: #<?php echo $settings->text_color ?>;
	<?php endif; ?>
	<?php if( !empty( $settings->text_bg_color ) ) : ?>
		background-color: #<?php echo $settings->text_bg_color ?>;
	<?php endif; ?>
	}
<?php endif; ?>


<?php if( !empty( $settings->link_color ) ) : ?>
.fl-node-<?php echo $id; ?> .fl-post-slider-content a{
	color: #<?php echo $settings->link_color ?>;
}
<?php endif; ?>

<?php if( !empty( $settings->link_hover_color ) ) : ?>
.fl-node-<?php echo $id; ?> .fl-post-slider-content a:hover{
	color: #<?php echo $settings->link_hover_color ?>;
}
<?php endif; ?>

<?php if( $settings->navigation == 'yes' ) : ?>
	.fl-node-<?php echo $id; ?> .fl-post-slider-navigation path{
		<?php if( !empty( $settings->text_color ) ) : ?>
			fill: #<?php echo $settings->text_color ?>;
		<?php endif; ?>
	}
<?php endif; ?>

<?php if( !empty( $settings->title_custom_size ) && $settings->title_size == 'custom' ) : ?>
	.fl-node-<?php echo $id; ?> .fl-post-slider-title{
		font-size: <?php echo $settings->title_custom_size ?>px;
	}
<?php endif; ?>