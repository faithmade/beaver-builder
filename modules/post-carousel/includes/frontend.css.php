<?php 

	$layout		      = isset( $settings->layout ) ? $settings->layout : 'grid';
	$text_bg_color    = !empty( $settings->text_bg_color ) ? $settings->text_bg_color : 'ffffff';
	$text_bg_opacity  = !empty( $settings->text_bg_opacity ) ? $settings->text_bg_opacity : '100';
	$text_bg          = 'rgba('. implode( ',', FLBuilderColor::hex_to_rgb( $text_bg_color ) ) .','. ( $text_bg_opacity/100 ) .')';
	$posts_per_view   = !empty( $settings->posts_per_view ) ? $settings->posts_per_view : 3;
	$icon_position    = isset( $settings->post_icon_position ) ? $settings->post_icon_position : 'above'; 

 ?>

<?php if( isset( $settings->equal_height ) && $settings->equal_height == 'yes' && $layout == 'grid' ) : ?>
	.fl-node-<?php echo $id; ?> .fl-post-carousel-wrapper{
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
	}
<?php endif; ?>

.fl-node-<?php echo $id; ?> .fl-post-carousel .fl-post-carousel-post {
    width: <?php echo round( ( 100 / $posts_per_view ), 2 ) ?>%;
}

.fl-node-<?php echo $id; ?> .fl-post-carousel .fl-post-carousel-post:nth-child(-n+<?php echo $posts_per_view ?>) {
    position: relative;
}

<?php if( $layout == 'grid' ) : ?>

	<?php if( !empty( $settings->text_color ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-post-carousel{
		color: #<?php echo $settings->text_color ?>;
	}
	<?php endif; ?>

	.fl-node-<?php echo $id; ?> .fl-post-carousel-post{
		background-color: #<?php echo $text_bg_color; ?>;
		background-color: <?php echo $text_bg; ?>;
	}

	<?php if( !empty( $settings->link_color ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-post-carousel-text a{
		color: #<?php echo $settings->link_color ?>;
	}
	<?php endif; ?>

	<?php if( !empty( $settings->link_hover_color ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-post-carousel-text a:hover{
		color: #<?php echo $settings->link_hover_color ?>;
	}
	<?php endif; ?>

<?php elseif( $layout == 'gallery' ) : ?>

	<?php if( !empty( $settings->link_hover_color ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-post-carousel-link,
	.fl-node-<?php echo $id; ?> .fl-post-carousel-link .fl-post-carousel-title{
		color: #<?php echo $settings->link_hover_color ?>;
	}
	<?php endif; ?>

	.fl-node-<?php echo $id; ?> .fl-post-carousel-text-wrap{
		background-color: #<?php echo $text_bg_color; ?>;
		background-color: <?php echo $text_bg; ?>;
	}

<?php endif; ?>

<?php if( isset( $settings->navigation ) && $settings->navigation == 'yes' ): ?>

	<?php if( $layout == 'grid' ) : ?>
	.fl-node-<?php echo $id ?> .fl-post-carousel {
		padding: 0 48px;
	}
	<?php endif; ?>
	
	.fl-node-<?php echo $id; ?> .fl-post-carousel-navigation path{
	<?php if( $layout == 'gallery' && !empty( $settings->link_hover_color ) ) : ?>
		fill: #<?php echo $settings->link_hover_color ?>;
	<?php else: ?>
		fill: currentColor;
	<?php endif; ?>
	}

<?php endif; ?>

<?php if( isset( $settings->post_has_icon ) && $settings->post_has_icon == 'yes' ): ?>

	<?php if( $layout == 'gallery' ) : ?>

		.fl-node-<?php echo $id ?> .fl-post-carousel-gallery .fl-carousel-icon{
		<?php if( $icon_position == 'above' ) : ?>
			margin-bottom: 10px;
		<?php else : ?>
			margin-top: 10px;
		<?php endif; ?>
		}
		
		<?php if( !empty( $settings->post_icon_size ) || !empty( $settings->post_icon_color ) ) : ?>
			.fl-node-<?php echo $id ?> .fl-post-carousel-gallery .fl-carousel-icon i,
			.fl-node-<?php echo $id ?> .fl-post-carousel-gallery .fl-carousel-icon i:before {
			<?php if( !empty( $settings->post_icon_size ) ) : ?>
				width: <?php echo $settings->post_icon_size ?>px;
				height: <?php echo $settings->post_icon_size ?>px;
				font-size: <?php echo $settings->post_icon_size ?>px;
			<?php endif; ?>
			<?php if( !empty( $settings->post_icon_color ) ) : ?>
				color: #<?php echo $settings->post_icon_color ?>;
			<?php endif; ?>
			}
		<?php endif; ?>

	<?php endif; ?>	

<?php endif; ?>

<?php if( isset( $settings->hover_transition ) && $settings->hover_transition != 'fade' && $layout == 'gallery' ) : ?>
	.fl-node-<?php echo $id ?> .fl-post-carousel-gallery .fl-post-carousel-text{
	<?php if( $settings->hover_transition == 'slide-up' ) : ?>
		-webkit-transform: translate3d(-50%,-30%,0); 
		   -moz-transform: translate3d(-50%,-30%,0); 
		    -ms-transform: translate(-50%,-30%); 
				transform: translate3d(-50%,-30%,0); 		
	<?php elseif( $settings->hover_transition == 'slide-down' ) : ?>
		-webkit-transform: translate3d(-50%,-70%,0); 
		   -moz-transform: translate3d(-50%,-70%,0); 
		    -ms-transform: translate(-50%,-70%); 
				transform: translate3d(-50%,-70%,0); 		
	<?php elseif( $settings->hover_transition == 'scale-up' ) : ?>
		-webkit-transform: translate3d(-50%,-50%,0) scale(.7); 
		   -moz-transform: translate3d(-50%,-50%,0) scale(.7); 
		    -ms-transform: translate(-50%,-50%) scale(.7); 
				transform: translate3d(-50%,-50%,0) scale(.7); 
	<?php elseif( $settings->hover_transition == 'scale-down' ) : ?>
		-webkit-transform: translate3d(-50%,-50%,0) scale(1.3); 
		   -moz-transform: translate3d(-50%,-50%,0) scale(1.3); 
		    -ms-transform: translate(-50%,-50%) scale(1.3); 
				transform: translate3d(-50%,-50%,0) scale(1.3); 
	<?php endif; ?>
	}

<?php endif; ?>