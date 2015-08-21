<?php 

	$spacing          = $settings->horizontal_spacing > 10 ? $settings->horizontal_spacing : 10;
	$padding_vertical = $settings->vertical_spacing > 10 ? $settings->vertical_spacing : 10;
	$padding 		  = !empty( $settings->horizontal_spacing ) ? $settings->horizontal_spacing : 0; 
	$width 			  = ( $padding + 14 );
	$height 		  = ceil( ( ( $padding * 2 ) + 14 ) * 0.65 );
?>


<?php //overall styling of the menu / submenu ?>

.fl-node-<?php echo $id; ?> .fl-menu .menu{
	<?php 
	
		$menu_raw_color = !empty( $settings->menu_bg_color ) ? $settings->menu_bg_color : 'transparent';
		$menu_opacity   = !empty( $settings->menu_bg_opacity ) ? $settings->menu_bg_opacity : '100';
		$menu_color     = 'rgba('. implode( ',', FLBuilderColor::hex_to_rgb( $menu_raw_color ) ) .','. ( $menu_opacity/100 ) .')';
	
		if( !empty( $settings->text_size ) ) {
			echo 'font-size: '. $settings->text_size .'px;';
		}
		if( !empty( $settings->text_transform ) ) {
			echo 'text-transform: '. $settings->text_transform  .';';
		}
		if( !empty( $settings->font_weight ) ) {
			echo 'font-weight: '. $settings->font_weight .';';
		}
		if( !empty( $settings->menu_bg_color ) ) {
			echo 'background-color: #'. $menu_raw_color .';';
			echo 'background-color: '. $menu_color .';';
		}
	?>
}

<?php if( !empty( $settings->submenu_bg_color ) || $settings->drop_shadow == 'yes' ) : ?>
.fl-node-<?php echo $id; ?> .fl-menu .sub-menu{
	<?php 

		$submenu_raw_color = !empty( $settings->submenu_bg_color ) ? $settings->submenu_bg_color : 'transparent';
		$submenu_opacity   = !empty( $settings->submenu_bg_opacity ) ? $settings->submenu_bg_opacity : '100';
		$submenu_color     = 'rgba('. implode( ',', FLBuilderColor::hex_to_rgb( $submenu_raw_color ) ) .','. ( $submenu_opacity/100 ) .')';

		if( !empty( $settings->submenu_bg_color ) ) {
			echo 'background-color: #'. $submenu_raw_color .';';
			echo 'background-color: '. $submenu_color .';';
		}
		if( !$global_settings->responsive_enabled && $settings->drop_shadow == 'yes' ) {
			echo '-webkit-box-shadow: 0 1px 20px rgba(0,0,0,0.1);';
			echo '-ms-box-shadow: 0 1px 20px rgba(0,0,0,0.1);';
			echo 'box-shadow: 0 1px 20px rgba(0,0,0,0.1);';
		}
	?>
}
<?php endif ?>

<?php if( $global_settings->responsive_enabled && $settings->drop_shadow == 'yes' ) : ?>
	@media ( min-width: <?php echo $global_settings->responsive_breakpoint ?>px ) {
		.fl-node-<?php echo $id; ?> .fl-menu .sub-menu{
			<?php 
				echo '-webkit-box-shadow: 0 1px 20px rgba(0,0,0,0.1);';
				echo '-ms-box-shadow: 0 1px 20px rgba(0,0,0,0.1);';
				echo 'box-shadow: 0 1px 20px rgba(0,0,0,0.1);';
			?>
		}
	}
<?php endif; ?>

<?php // Toggle icon =================================================================// ?>
.fl-node-<?php echo $id; ?> .fl-menu .fl-menu-toggle{
	position: absolute;
	top: 50%;
	right: 0;
	cursor: pointer;
}

<?php // Toggle - Arrows / None ?>
<?php if( ( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->menu_layout == 'accordion' && $settings->submenu_click_toggle == 'arrows' ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-menu .fl-menu-toggle:before{
		content: '';
		position: absolute;
		right: 50%;
		top: 50%;
		z-index: 1;
		display: block;
		width: 9px;
		height: 9px;
		margin: -5px -5px 0 0;
		border-right: 2px solid;
		border-bottom: 2px solid;
		-webkit-transform-origin: right bottom;
			-ms-transform-origin: right bottom;
			    transform-origin: right bottom;
		-webkit-transform: translateX( -5px ) rotate( 45deg );
			-ms-transform: translateX( -5px ) rotate( 45deg );
				transform: translateX( -5px ) rotate( 45deg );
	}

	.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu.fl-active > .fl-has-submenu-container .fl-menu-toggle{
		-webkit-transform: rotate( -180deg );
			-ms-transform: rotate( -180deg );
				transform: rotate( -180deg );
	}

<?php // Toggle - Plus ?>
<?php elseif( ( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->submenu_hover_toggle == 'plus' ) || ( $settings->menu_layout == 'accordion' && $settings->submenu_click_toggle == 'plus' ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-menu .fl-menu-toggle:before,
	.fl-node-<?php echo $id; ?> .fl-menu .fl-menu-toggle:after{
		content: '';
		position: absolute;
		z-index: 1;
		display: block;
		border-color: #333;
	}
	.fl-node-<?php echo $id; ?> .fl-menu .fl-menu-toggle:before{
		left: 50%;
		top: 50%;
		width: 12px;
		border-top: 3px solid;
		-webkit-transform: translate( -50%, -50% );
			-ms-transform: translate( -50%, -50% );
				transform: translate( -50%, -50% );
	}

	.fl-node-<?php echo $id; ?> .fl-menu .fl-menu-toggle:after{
		left: 50%;
		top: 50%;
		border-left: 3px solid;
		height: 12px;
		-webkit-transform: translate( -50%, -50% );
			-ms-transform: translate( -50%, -50% );
				transform: translate( -50%, -50% );
	}

	.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu.fl-active > .fl-has-submenu-container .fl-menu-toggle:after{
		display: none;
	}
<?php endif ?>

<?php // if layout is responsive =================================================================// ?>

<?php if( !empty( $settings->menu_align ) && $settings->menu_align == 'center' ) : ?>
	.fl-node-<?php echo $id; ?> .fl-menu{
		text-align: center;
	}
<?php endif; ?>

<?php if( $global_settings->responsive_enabled ) : ?>

	<?php if( ( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->submenu_hover_toggle == 'none' ) ) : ?>
		.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu-container a{
			padding-right: <?php echo $width ?>px;
		}
	<?php endif; ?>

	<?php // Submenu - horizontal or vertical ?>
	<?php if( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) ) : ?>
		.fl-node-<?php echo $id; ?> .menu .fl-has-submenu .sub-menu{
			display: none;
		}
	<?php endif; ?>

	.fl-node-<?php echo $id; ?> .fl-menu li{
		border-top: 1px solid transparent;
	}	
	.fl-node-<?php echo $id; ?> .fl-menu li:first-child{
		border-top: none;
	}

	@media ( min-width: <?php echo $global_settings->responsive_breakpoint ?>px ) {

		<?php // if menu is horizontal ?>
		<?php if( $settings->menu_layout == 'horizontal' ) : ?>
			.fl-node-<?php echo $id; ?> .menu > li{ float: left; }

			.fl-node-<?php echo $id; ?> .menu li{
				border-left: 1px solid transparent;
				border-top: none;
			}

			.fl-node-<?php echo $id; ?> .menu li:first-child{
				border: none;
			}
			.fl-node-<?php echo $id; ?> .menu li li{
				border-top: 1px solid transparent;
				border-left: none;
			}

			.fl-node-<?php echo $id; ?> .menu .fl-has-submenu .sub-menu{
				position: absolute;
				top: 100%;
				left: 0;
				z-index: 10;
				visibility: hidden;
				opacity: 0;
			}

			.fl-node-<?php echo $id; ?> .fl-has-submenu .fl-has-submenu .sub-menu{
				top: 0;
				left: 100%;
			}

			<?php if( !empty( $settings->menu_align ) && $settings->menu_align != 'default' ) : ?>
				.fl-node-<?php echo $id; ?> .fl-menu .menu{
					<?php 
						if( in_array( $settings->menu_align, array( 'left', 'right' ) ) ) {
							echo 'float: '. $settings->menu_align .';';
						} elseif( $settings->menu_align == 'center' ) {
							echo 'display: inline-block;';
						}
					?>
				}
			<?php endif; ?>

		<?php // if menu is vertical ?>
		<?php elseif( $settings->menu_layout == 'vertical' ) : ?>

			.fl-node-<?php echo $id; ?> .menu .fl-has-submenu .sub-menu{
				position: absolute;
				top: 0;
				left: 100%;
				z-index: 10;
				visibility: hidden;
				opacity: 0;
			}

		<?php endif; ?>

		<?php // if menu is horizontal or vertical ?>
		<?php if( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) ) : ?>

			.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu .sub-menu{
				display: block;
				-webkit-transition: all .3s;
					-ms-transition: all .3s;
						transition: all .3s;
			}

			.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu:hover > .sub-menu{
				visibility: visible;
				opacity: 1;
			}

			.fl-node-<?php echo $id; ?> .menu .fl-has-submenu.fl-menu-submenu-right .sub-menu{
				top: 100%;
				left: inherit;
				right: 0;
			}

			.fl-node-<?php echo $id; ?> .menu .fl-has-submenu .fl-has-submenu.fl-menu-submenu-right .sub-menu{
				top: 0;
				left: inherit;
				right: 100%;
			}

			.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu.fl-active > .fl-has-submenu-container .fl-menu-toggle{
				-webkit-transform: none;
					-ms-transform: none;
						transform: none;
			}

			<?php //change selector depending on layout ?>
			<?php if( $settings->submenu_hover_toggle == 'arrows' ) : ?>
				<?php if( $settings->menu_layout == 'horizontal' ) : ?>
				.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu .fl-has-submenu .fl-menu-toggle:before{
				<?php elseif( $settings->menu_layout == 'vertical' ) : ?>
				.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu .fl-menu-toggle:before{
				<?php endif; ?>
					-webkit-transform: translateY( -5px ) rotate( -45deg );
						-ms-transform: translateY( -5px ) rotate( -45deg );
							transform: translateY( -5px ) rotate( -45deg );
				}
			<?php endif; ?>

			<?php if( $settings->submenu_hover_toggle == 'none' ) : ?>
				.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu-container a{
					padding-right: <?php echo $spacing ?>px;
				}
				.fl-node-<?php echo $id; ?> .fl-menu .fl-menu-toggle{
					display: none;
				}
			<?php endif; ?>

		<?php endif; ?>

		<?php if( $settings->mobile_toggle != 'expanded' ) : ?>
			.fl-node-<?php echo $id; ?> .fl-menu-mobile-toggle{
				display: none;
			}
		<?php endif; ?>

	}

<?php else : ?>

	<?php // if menu is horizontal ?>
	<?php if( $settings->menu_layout == 'horizontal' ) : ?>

		.fl-node-<?php echo $id; ?> .fl-menu .menu > li{ float: left; }

		.fl-node-<?php echo $id; ?> .menu li{
			border-left: 1px solid transparent;
		}

		.fl-node-<?php echo $id; ?> .menu li:first-child{
			border: none;
		}

		.fl-node-<?php echo $id; ?> .menu li li{
			border-top: 1px solid transparent;
			border-left: none;
		}

		<?php if( !empty( $settings->menu_align ) && $settings->menu_align != 'default' ) : ?>
			.fl-node-<?php echo $id; ?> .fl-menu .menu{
				<?php 
					if( in_array( $settings->menu_align, array( 'left', 'right' ) ) ) {
						echo 'float: '. $settings->menu_align .';';
					} elseif( $settings->menu_align == 'center' ) {
						echo 'display: inline-block;';
					}
				?>
			}
		<?php endif; ?>

	<?php endif; ?>

	<?php // if menu is horizontal or vertical ?>
	<?php if( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) ) : ?>

		.fl-node-<?php echo $id; ?> .menu .fl-has-submenu .sub-menu{
			position: absolute;
			top: 100%;
			left: 0;
			z-index: 10;
			visibility: hidden;
			opacity: 0;
		}

		.fl-node-<?php echo $id; ?> .menu .fl-has-submenu .fl-has-submenu .sub-menu{
			top: 0;
			left: 100%;
		}

		.fl-node-<?php echo $id; ?> .fl-menu .menu.fl-toggle-arrows .fl-has-submenu .fl-has-submenu .fl-menu-toggle:before{
			-webkit-transform: translateY( -2px ) rotate( -45deg );
				-ms-transform: translateY( -2px ) rotate( -45deg );
					transform: translateY( -2px ) rotate( -45deg );
		}

		.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu .sub-menu{
			-webkit-transition: all .3s;
				-ms-transition: all .3s;
					transition: all .3s;
		}

		.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu:hover > .sub-menu{
			visibility: visible;
			opacity: 1;
		}

		<?php if( $settings->submenu_hover_toggle == 'none' ) : ?>
			.fl-node-<?php echo $id; ?> .fl-menu .fl-has-submenu-container a{
				padding-right: <?php echo $spacing ?>px;
			}
			.fl-menu .fl-menu .fl-menu-toggle{
				display: none;
			}
		<?php endif; ?>

	<?php endif; ?>

	<?php if( $settings->mobile_toggle != 'expanded' ) : ?>
		.fl-node-<?php echo $id; ?> .fl-menu-mobile-toggle{
			display: none;
		}
	<?php endif; ?>

<?php endif ?>

<?php // links =================================================================// ?>

<?php if( !empty( $settings->horizontal_spacing ) && !empty( $settings->vertical_spacing ) ) : ?>

.fl-node-<?php echo $id; ?> .menu a{
	padding-left: <?php echo $settings->horizontal_spacing ?>px;
	padding-right: <?php echo $settings->horizontal_spacing ?>px;
	padding-top: <?php echo $settings->vertical_spacing ?>px;
	padding-bottom: <?php echo $settings->vertical_spacing ?>px;
}
<?php endif; ?>

<?php if( !empty( $settings->link_color ) ) : ?>
.fl-node-<?php echo $id; ?> .menu > li > a,
.fl-node-<?php echo $id; ?> .menu > li > .fl-has-submenu-container > a,
.fl-node-<?php echo $id; ?> .sub-menu > li > a,
.fl-node-<?php echo $id; ?> .sub-menu > li > .fl-has-submenu-container > a{
	color: #<?php echo $settings->link_color ?>;
	<?php if( !empty( $settings->link_bg_color ) ) : ?>
		background-color: #<?php echo $settings->link_bg_color ?>;
	<?php endif; ?>
}

	<?php if( isset( $settings->link_color ) ) : ?>
		
		<?php if( ( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->menu_layout == 'accordion' && $settings->submenu_click_toggle == 'arrows' ) ) : ?>
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-arrows .fl-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-none .fl-menu-toggle:before {
			border-color: #<?php echo $settings->link_color ?>;
		}
		<?php elseif( ( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->submenu_hover_toggle == 'plus' ) || ( $settings->menu_layout == 'accordion' && $settings->submenu_click_toggle == 'plus' ) ) : ?>
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-plus .fl-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-plus .fl-menu-toggle:after{
			border-color: #<?php echo $settings->link_color ?>;
		}
		<?php endif; ?>
	<?php endif; ?>

<?php endif; ?>

<?php // links - hover/active =================================================================// ?>

<?php if( !empty( $settings->link_hover_bg_color ) || $settings->link_hover_color ) : ?>
.fl-node-<?php echo $id; ?> .menu > li > a:hover,
.fl-node-<?php echo $id; ?> .menu > li > .fl-has-submenu-container:hover > a,
.fl-node-<?php echo $id; ?> .sub-menu > li > a:hover,
.fl-node-<?php echo $id; ?> .sub-menu > li > .fl-has-submenu-container:hover > a,
.fl-node-<?php echo $id; ?> .menu > li.current-menu-item > a,
.fl-node-<?php echo $id; ?> .menu > li.current-menu-item > .fl-has-submenu-container > a,
.fl-node-<?php echo $id; ?> .sub-menu > li.current-menu-item > a,
.fl-node-<?php echo $id; ?> .sub-menu > li.current-menu-item > .fl-has-submenu-container > a{
	<?php 
		if( !empty( $settings->link_hover_bg_color ) ) {
			echo 'background-color: #'. $settings->link_hover_bg_color .';';
		}
		if( !empty( $settings->link_hover_color ) ) {
			echo 'color: #'. $settings->link_hover_color .';';
		}
	?>
}
<?php endif ?>

<?php if( !empty( $settings->link_hover_color ) ) : ?>
		<?php if( ( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->menu_layout == 'accordion' && $settings->submenu_click_toggle == 'arrows' ) ) : ?>
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-arrows .fl-has-submenu-container:hover > .fl-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-arrows li.current-menu-item >.fl-has-submenu-container > .fl-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-none .fl-has-submenu-container:hover > .fl-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-none li.current-menu-item >.fl-has-submenu-container > .fl-menu-toggle:before{
			border-color: #<?php echo $settings->link_hover_color ?>;
		}
		<?php elseif( ( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->submenu_hover_toggle == 'plus' ) || ( $settings->menu_layout == 'accordion' && $settings->submenu_click_toggle == 'plus' ) ) : ?>
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-plus .fl-has-submenu-container:hover > .fl-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-plus li.current-menu-item > .fl-has-submenu-container > .fl-menu-toggle:before,
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-plus .fl-has-submenu-container:hover > .fl-menu-toggle:after,
		.fl-node-<?php echo $id; ?> .fl-menu .fl-toggle-plus li.current-menu-item > .fl-has-submenu-container > .fl-menu-toggle:after{
			border-color: #<?php echo $settings->link_hover_color ?>;
		}
	<?php endif; ?>

<?php endif; ?>

<?php // submenu toggle =================================================================// ?>

<?php if( ( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) && in_array( $settings->submenu_hover_toggle, array( 'arrows', 'none' ) ) ) || ( $settings->menu_layout == 'accordion' && $settings->submenu_click_toggle == 'arrows' ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-menu-<?php echo $settings->menu_layout ?>.fl-toggle-arrows .fl-has-submenu-container a{
		padding-right: <?php echo $width ?>px;
	}
	.fl-node-<?php echo $id; ?> .fl-menu-<?php echo $settings->menu_layout ?>.fl-toggle-arrows .fl-menu-toggle,
	.fl-node-<?php echo $id; ?> .fl-menu-<?php echo $settings->menu_layout ?>.fl-toggle-none .fl-menu-toggle{
		width: <?php echo $height ?>px;
		height: <?php echo $height ?>px;
		margin: -<?php echo $height/2 ?>px 0 0;
	}
	.fl-node-<?php echo $id; ?> .fl-menu-horizontal.fl-toggle-arrows .fl-menu-toggle,
	.fl-node-<?php echo $id; ?> .fl-menu-horizontal.fl-toggle-none .fl-menu-toggle,
	.fl-node-<?php echo $id; ?> .fl-menu-vertical.fl-toggle-arrows .fl-menu-toggle,
	.fl-node-<?php echo $id; ?> .fl-menu-vertical.fl-toggle-none .fl-menu-toggle{
		width: <?php echo $width ?>px;
		height: <?php echo $height ?>px;
		margin: -<?php echo $height/2 ?>px 0 0;
	}
<?php elseif( ( in_array( $settings->menu_layout, array( 'horizontal', 'vertical' ) ) && $settings->submenu_hover_toggle == 'plus' ) || ( $settings->menu_layout == 'accordion' && $settings->submenu_click_toggle == 'plus' ) ) : ?>
	.fl-node-<?php echo $id; ?> .fl-menu-<?php echo $settings->menu_layout ?>.fl-toggle-plus .fl-has-submenu-container a{
		padding-right: <?php echo $width ?>px;
	}

	.fl-node-<?php echo $id; ?> .fl-menu-accordion.fl-toggle-plus .fl-menu-toggle{
		width: <?php echo $height ?>px;
		height: <?php echo $height ?>px;
		margin: -<?php echo $height/2 ?>px 0 0;
	}
	.fl-node-<?php echo $id; ?> .fl-menu-horizontal.fl-toggle-plus .fl-menu-toggle,
	.fl-node-<?php echo $id; ?> .fl-menu-vertical.fl-toggle-plus .fl-menu-toggle{
		width: <?php echo $width ?>px;
		height: <?php echo $height ?>px;
		margin: -<?php echo $height/2 ?>px 0 0;
	}
<?php endif; ?>

<?php // separators =================================================================// ?>
<?php if( isset( $settings->show_separator ) && $settings->show_separator == 'yes' ) : ?>
	<?php 

		$separator_raw_color = !empty( $settings->separator_color ) ? $settings->separator_color : '000000';
		$separator_opacity   = !empty( $settings->separator_opacity ) ? $settings->separator_opacity : '100';
		$separator_color     = 'rgba('. implode( ',', FLBuilderColor::hex_to_rgb( $separator_raw_color ) ) .','. ( $separator_opacity/100 ) .')';

	 ?>
	.fl-node-<?php echo $id; ?> .menu.fl-menu-<?php echo $settings->menu_layout ?> li,
	.fl-node-<?php echo $id; ?> .menu.fl-menu-horizontal li li{
		border-color: #<?php echo $separator_raw_color; ?>;
		border-color: <?php echo $separator_color; ?>;
	}
<?php endif; ?>

<?php // mobile toggle button =================================================================// ?>

<?php if( isset( $settings->mobile_toggle ) && $settings->mobile_toggle != 'expanded' ) : ?>
	<?php if( !empty( $settings->menu_align ) && $settings->menu_align != 'default' ) : ?>
		.fl-node-<?php echo $id; ?> .fl-menu-mobile-toggle{
			<?php 
				if( in_array( $settings->menu_align, array( 'left', 'right' ) ) ) {
					echo 'float: '. $settings->menu_align .';';
				}
			?>
		}
	<?php endif; ?>

	.fl-node-<?php echo $id; ?> .fl-menu-mobile-toggle{
		<?php 
			if( !empty( $settings->text_size ) ) {
				echo 'font-size: '. $settings->text_size .'px;';
			}
			if( isset( $settings->text_transform ) ) {
				echo 'text-transform: '. $settings->text_transform  .';';
			}
			if( isset( $settings->font_weight ) ) {
				echo 'font-weight: '. $settings->font_weight .';';
			}
			if( !empty( $settings->link_color ) ) {
				echo 'color: #'. $settings->link_color .';';
			}
			if( !empty( $settings->menu_bg_color ) ) {
				echo 'background-color: #'. $settings->menu_bg_color .';';
			}

		?>
		border-color: rgba( 0,0,0,0.1 ); 
	}
	.fl-node-<?php echo $id; ?> .fl-menu-mobile-toggle rect{
		<?php 
			if( !empty( $settings->link_color ) ) {
				echo 'fill: #'. $settings->link_color .';';
			}
		?>
	}
	.fl-node-<?php echo $id; ?> .fl-menu-mobile-toggle:hover,
	.fl-node-<?php echo $id; ?> .fl-menu-mobile-toggle.fl-active{
		<?php 
			if( !empty( $settings->link_hover_color ) ) {
				echo 'color: #'. $settings->link_hover_color .';';
			}
			if( !empty( $settings->link_hover_bg_color ) ) {
				echo 'background-color: #'. $settings->link_hover_bg_color .';';
			}
		?>
	}

	.fl-node-<?php echo $id; ?> .fl-menu-mobile-toggle:hover rect,
	.fl-node-<?php echo $id; ?> .fl-menu-mobile-toggle.fl-active rect{
		<?php 
			if( !empty( $settings->link_hover_color ) ) {
				echo 'fill: #'. $settings->link_hover_color .';';
			}
		?>
	}
<?php endif; ?>

<?php if( isset( $settings->mobile_button_label ) && $settings->mobile_button_label == 'no' ) : ?>
	.fl-node-<?php echo $id; ?> .fl-menu .fl-menu-mobile-toggle.hamburger .fl-menu-mobile-toggle-label{
		display: none;
	}
<?php endif; ?>