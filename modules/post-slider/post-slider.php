<?php

/**
 * @class FLPostSliderModule
 */
class FLPostSliderModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Posts Slider', 'fl-builder'),
			'description'   => __('Display a slider of your WordPress posts.', 'fl-builder'),
			'category'      => __('Advanced Modules', 'fl-builder'),
			'editor_export' => false,
			'enabled'       => true
		));

		$this->add_css('jquery-bxslider');
		$this->add_js('jquery-bxslider');
	}

	/**
	 * Full attachment image url.
	 *
	 * Gets a post ID and returns the url for the 'full' size of the attachment
	 * set as featured image.
	 * 
	 * @param  int $id 	 The post ID.
	 * @since  1.5.9
	 * @return string    The featured image url for the 'full' size.
	 */
	public function get_full_img_src( $id ){
		$thumb_id = get_post_thumbnail_id( $id );
		$img = wp_get_attachment_image_src( $thumb_id, 'full' );
		return $img[0];
	}

	/**
	 * Get the featured image data.
	 *
	 * Gets a post ID and returns an array containing the featured image data.
	 * 
	 * @param  int $id 	 The post ID.
	 * @since  1.5.9
	 * @return array    The image data.
	 */	
	protected function _get_img_data( $id ){

		$thumb_id = get_post_thumbnail_id( $id );

		return FLBuilderPhoto::get_attachment_data( $thumb_id );

	}


	/**
	 * Build post slider array.
	 *
	 * Get all the query parameters and build an array with posts ID's as keys
	 * and the featured image's url (in 'full size') as values.
	 *
	 * @since 	1.5.9
	 * @return 	array 	the array with all the posts ID's and featured image url's.
	 * 
	 */
	public function _build_posts_array(){

		// checks if the post_slides array is cached
		if( !isset( $this->post_slides ) ){

			// if not, create it
			$this->post_slides = array();

			// check if we have selected posts
			if( empty( $this->settings->posts_post ) ){

				// if not, create a default query with it
				$settings = !empty( $this->settings ) ? $this->settings : new stdClass();			
				// set WP_Query "fields" arg as 'ids' to return less information
				$settings->fields = 'ids';

				// Get the query data.
				$query = FLBuilderLoop::query( $settings );
				
				// build the post_slides array with post id's and featured image url's
				foreach( $query->posts as $key => $id ){
					$this->post_slides[ $id ] = $this->get_full_img_src( $id );
				}

			} else{

				// if yes, get the selected posts and build the post_slides array
				$slides = explode( ',', $this->settings->posts_post );

				foreach( $slides as $key => $id ){
					$this->post_slides[$id] = $this->get_full_img_src( $id );
				}

			}
		}

		return $this->post_slides;
	}


	/**
	 * The uncropped url.
	 *
	 * Get's a post ID and returns the uncropped url for its featured image.
	 * 
	 * @param  int $id    The post ID.
	 * @since  1.5.9
	 * @return string     The featured image url for the 'full' size.
	 */
	public function _get_uncropped_url( $id ){
		$posts = $this->_build_posts_array();
		return $posts[$id];
	}

	/**
	 * Render thumbnail image.
	 *
	 * Get's the post ID and renders the html markup for the featured image
	 * in the desired cropped size.
	 * 
	 * @param  int $id    The post ID.
	 * @since  1.5.9
	 * @return void
	 */
	public function render_img( $id ) {

		// check if image_type is set
		if( isset( $this->settings->image_type ) ){

			// check if the choosed image type for featured image is "thumb" or "background"
			if( $this->settings->image_type == 'thumb' ){

				// get image source and data
				$src = $this->_get_uncropped_url( $id );
				$photo_data = $this->_get_img_data( $id );

				// get alignment option, otherwise set the default to "left"
				$align = isset( $this->settings->thumb_text_position ) ? $this->settings->thumb_text_position : 'left';

				// set params
				$photo_settings = array(
					'align'         => $align,
					'crop'          => $this->settings->thumb_crop,
					'link_type'     => 'url',
					'link_url'      => get_the_permalink( $id ),
					'photo'         => $photo_data,
					'photo_src'     => $src,
					'photo_source'  => 'library'
				);

				// render image
				echo '<div class="fl-post-slider-img">';
				FLBuilder::render_module_html( 'photo', $photo_settings );
				echo '</div>';

			} elseif( $this->settings->image_type == 'background' ){

				// if background is selected as image size, render background markup
				echo '<div class="fl-slide-bg-photo fl-post-no-height" style="background-image: url('. $this->get_full_img_src( $id ) .')"></div>';
				echo '<div class="fl-post-slider-content-bg fl-post-no-height"></div>';
			}

		}

	}


	/**
	 * Render thumbnail image for mobile.
	 *
	 * Get's the post ID and renders the html markup for the featured image
	 * in the desired cropped size.
	 * 
	 * @param  int $id    The post ID.
	 * @since  1.5.9
	 * @return void
	 */
	public function render_mobile_img( $id ) {

		// check if image_type is set
		if( isset( $this->settings->image_type ) ){

			// check if "background" is choosed as image type for featured image
			if( $this->settings->image_type == 'background' ){

				// get image source and data
				$src = $this->_get_uncropped_url( $id );
				$photo_data = $this->_get_img_data( $id );

				// set params
				$photo_settings = array(
					'align'         => 'center',
					'link_type'     => 'url',
					'link_url'      => get_the_permalink( $id ),
					'photo'         => $photo_data,
					'photo_src'     => $src,
					'photo_source'  => 'library'
				);

				// render image
				echo '<div class="fl-post-slider-mobile-img">';
				FLBuilder::render_module_html( 'photo', $photo_settings );
				echo '</div>';

			}

		}

	}


	/**
	 * Render slider title.
	 *
	 * Get's the post ID and renders the html markup for the slider title
	 * 
	 * @param  int $id    The post ID.
	 * @since  1.5.9
	 * @return void
	 */
	public function render_post_title( $id ) {

		// get choosed tag, otherwise set default to h2
		$tag = !empty( $this->settings->title_tag ) ? $this->settings->title_tag : 'h2';

		// build markup
		$title = '<' . $tag . ' class="fl-post-slider-title" itemprop="headline">';
		$title .= '<a href="'. get_the_permalink( $id ) .'" rel="bookmark" title="'. the_title_attribute( array( 'echo' => false, 'post' => $id ) ) .'">'. get_the_title( $id ) .'</a>';
		$title .= '</' . $tag . '>';

		echo $title;

	}


	/**
	 * Get slider css class.
	 *
	 * Get's the post ID, checks if the post has a thumbnail and the image_type
	 * setting, and then returns the specific slider class.
	 * 
	 * @param  int $id    The post ID.
	 * @since  1.5.9
	 * @return string     The slider class.
	 */
	public function get_slider_class( $id ){

		// check if the post has a featured image, and if the slider module is set to show it 
		if( has_post_thumbnail( $id ) && $this->settings->show_thumb == 'show' ){

			// if so, check if image_type is set and return it, otherwise set the default to "no-thumb"
			if( isset( $this->settings->image_type ) ){
				return $this->settings->image_type;
			} else{
				return 'no-thumb';
			}
		} else{
			return 'no-thumb';
		}
	}


	/**
	 * Render the css code for background with gradients.
	 *
	 * @since  1.5.9
	 * @return void
	 */
	public function render_slider_gradient_bg(){

		if( empty( $this->settings->text_bg_color ) || empty( $this->settings->text_bg_opacity ) )
			return;

		// set defaults
		$color_start = 'rgba('. implode( ',', FLBuilderColor::hex_to_rgb( $this->settings->text_bg_color ) ) .','. ( $this->settings->text_bg_opacity/100 ) .')';
		$color_end = 'rgba('. implode( ',', FLBuilderColor::hex_to_rgb( $this->settings->text_bg_color ) ) .',0)';

		// check if bg_gradient is set to "yes"
		if( isset( $this->settings->bg_gradient ) && $this->settings->bg_gradient == 'yes' ){

			// if so, set positions for each vendor prefix
			if( isset( $this->settings->text_position ) ){
				switch ( $this->settings->text_position ) {
					case 'left':
						$direction = 'left';
						$wk_direction = 'left top, right top';
						$ie_direction = 'to right';
						break;
					case 'right':
						$direction = 'right';
						$wk_direction = 'right top, left top';
						$ie_direction = 'to left';
						break;
					case 'bottom':
						$direction = 'bottom';
						$wk_direction = 'left bottom, left top';
						$ie_direction = 'to top';
						break;
					
				}
			}

			// build csss gradient code
			$bg =  'background: #'. $this->settings->text_bg_color .';';
			$bg .= 'background: -ms-linear-gradient('. $direction .', '. $color_start .' 0%, '. $color_end .' 100%);';
			$bg .= 'background: -moz-linear-gradient('. $direction .', '. $color_start .' 0%, '. $color_end .' 100%);';
			$bg .= 'background: -o-linear-gradient('. $direction .', '. $color_start .' 0%, '. $color_end .' 100%);';
			$bg .= 'background: -webkit-gradient(linear, '. $wk_direction .', color-stop(0, '. $color_start .'), color-stop(1, '. $color_end .'));';
			$bg .= 'background: -webkit-linear-gradient('. $direction .', '. $color_start .' 0%, '. $color .' 100%);';
			$bg .= 'background: linear-gradient('. $ie_direction .', '. $color_start .' 0%, '. $color_end .' 100%);';

		} else{

			// if gradient isn't selected, set the background with default values
			$bg =  'background-color: #'. $this->settings->text_bg_color .';';
			$bg .= 'background-color: '. $color_start .';';
		}

		echo $bg;
	}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLPostSliderModule', array(
	'slider'      => array(
		'title'         => __('Slider', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Height', 'fl-builder'),
						'default'       => '400',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => 'px',
						'help'          => __('This setting is the minimum height of the post slider. Content will expand the height automatically.', 'fl-builder')
					),
					'auto_play'     => array(
						'type'          => 'select',
						'label'         => __('Auto Play', 'fl-builder'),
						'default'       => 'true',
						'options'       => array(
							'false'         => __('No', 'fl-builder'),
							'true'          => __('Yes', 'fl-builder')
						)
					),
					'speed'         => array(
						'type'          => 'text',
						'label'         => __('Delay', 'fl-builder'),
						'default'       => '5',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'fl-builder' )
					),
					'transition'     => array(
						'type'          => 'select',
						'label'         => __('Transition', 'fl-builder'),
						'default'       => 'horizontal',
						'options'       => array(
							'fade'              => __('Fade', 'fl-builder'),
							'horizontal'   		=> __('Slide', 'fl-builder'),
						)
					),
					'slider_loop'     => array(
						'type'          => 'select',
						'label'         => __('Loop', 'fl-builder'),
						'default'       => 'false',
						'options'       => array(
							'false'            	=> __('No', 'fl-builder'),
							'true'				=> __('Yes', 'fl-builder'),
						)
					),
					'transitionDuration' => array(
						'type'          => 'text',
						'label'         => __('Transition Speed', 'fl-builder'),
						'default'       => '1',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'fl-builder' )
					),
					'posts_per_page' => array(
						'type'          => 'text',
						'label'         => __('Number of Posts', 'fl-builder'),
						'default'       => '10',
						'size'          => '4'
					),
				)
			),
			'controls'       => array(
				'title'         => __('Slider Controls', 'fl-builder'),
				'fields'        => array(
					'pagination'     => array(
						'type'          => 'select',
						'label'         => __('Show Dots', 'fl-builder'),
						'default'       => 'yes',
						'options'       => array(
							'no'			=> __('No', 'fl-builder'),
							'yes'       	=> __('Yes', 'fl-builder'),
						)
					),
					'navigation'     => array(
						'type'          => 'select',
						'label'         => __('Show Arrows', 'fl-builder'),
						'default'       => 'no',
						'options'       => array(
							'no'            => __('No', 'fl-builder'),
							'yes'        	=> __('Yes', 'fl-builder'),
						),
						'toggle'		=> array(
							'yes'			=> array(
								'fields'		=> ( 'nav_arrow_color' )
							)
						)
					),
				)
			),

		)
	),
	'layout'        => array(
		'title'         => __( 'Layout', 'fl-builder' ),
		'sections'      => array(
			'featured_img' => array(
				'title'         => '',
				'fields'        => array(
					'show_thumb'    => array(
						'type'          => 'select',
						'label'         => __( 'Show Featured Image?', 'fl-builder' ),
						'default'       => 'show',
						'options'       => array(
							'show'		    => __( 'Show', 'fl-builder' ),
							'hide'          => __( 'Hide', 'fl-builder' )
						),
						'toggle'        => array(
							'show'    => array(
								'sections'      => array( 'image' ),
								'fields'        => array( 'text_position', 'text_width' )
							),
						)
					),
				)
			),
			'image'        => array(
				'title'         => __( 'Featured Image', 'fl-builder' ),
				'fields'        => array(
					'image_type'    => array(
						'type'          => 'select',
						'label'         => __( 'Image', 'fl-builder' ),
						'default'       => 'background',
						'options'       => array(
							'background'    => __( 'Background', 'fl-builder' ),
							'thumb'         => __( 'Thumbnail', 'fl-builder' )
						),
						'toggle'        => array(
							'background'    => array(
								'fields'        => array( 'text_position' )
							),
							'thumb'         => array(
								'fields'        => array( 'thumb_crop', 'thumb_text_position' )
							)
						)
					),
					'thumb_crop'    => array(
						'type'          => 'select',
						'label'         => __( 'Crop', 'fl-builder' ),
						'default'       => 'none',
						'options'       => array(
							'none'          => _x( 'None', 'Crop.', 'fl-builder' ),
							'landscape'     => __( 'Landscape', 'fl-builder' ),
							'panorama'      => __( 'Panorama', 'fl-builder' ),
							'portrait'      => __( 'Portrait', 'fl-builder' ),
							'square'        => __( 'Square', 'fl-builder' ),
							'circle'        => __( 'Circle', 'fl-builder' )
						)
					),
				)
			),
			'info'          => array(
				'title'         => __( 'Post Info', 'fl-builder' ),
				'fields'        => array(
					'show_author'   => array(
						'type'          => 'select',
						'label'         => __( 'Author', 'fl-builder' ),
						'default'       => '1',
						'options'       => array(
							'1'             => __( 'Show', 'fl-builder' ),
							'0'             => __( 'Hide', 'fl-builder' )
						)
					),
					'show_date'     => array(
						'type'          => 'select',
						'label'         => __( 'Date', 'fl-builder' ),
						'default'       => '1',
						'options'       => array(
							'1'             => __( 'Show', 'fl-builder' ),
							'0'             => __( 'Hide', 'fl-builder' )
						),
						'toggle'        => array(
							'1'             => array(
								'fields'        => array( 'date_format' )
							)
						)
					),
					'date_format'   => array(
						'type'          => 'select',
						'label'         => __( 'Date Format', 'fl-builder' ),
						'default'       => 'M j, Y',
						'options'       => array(
							// Note for developer: I would personally add this as a text field with a default value of get_option( 'date_format' )
							'M j, Y'        => date( 'M j, Y' ),
							'F j, Y'        => date( 'F j, Y' ),
							'm/d/Y'         => date( 'm/d/Y' ),
							'm-d-Y'         => date( 'm-d-Y' ),
							'd M Y'         => date( 'd M Y' ),
							'd F Y'         => date( 'd F Y' ),
							'Y-m-d'         => date( 'Y-m-d' ),
							'Y/m/d'         => date( 'Y/m/d' ),
						)
					),
					'show_comments' => array(
						'type'          => 'select',
						'label'         => __('Comments', 'fl-builder'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Show', 'fl-builder'),
							'0'             => __('Hide', 'fl-builder')
						)
					),
				)
			),
			'content'       => array(
				'title'         => __( 'Content', 'fl-builder' ),
				'fields'        => array(
					'show_content'  => array(
						'type'          => 'select',
						'label'         => __('Content', 'fl-builder'),
						'default'       => '1',
						'options'       => array(
							'1'             => __('Show', 'fl-builder'),
							'0'             => __('Hide', 'fl-builder')
						)
					),
					'show_more_link' => array(
						'type'          => 'select',
						'label'         => __('More Link', 'fl-builder'),
						'default'       => '0',
						'options'       => array(
							'1'             => __('Show', 'fl-builder'),
							'0'             => __('Hide', 'fl-builder')
						)
					),
					'more_link_text' => array(
						'type'          => 'text',
						'label'         => __('More Link Text', 'fl-builder'),
						'default'       => __('Read More', 'fl-builder'),
					),
				)
			)
		),
	),

	'style'         => array( // Tab
		'title'         => __('Style', 'fl-builder'), // Tab title
		'sections'      => array( // Tab Sections
			'title'         => array(
				'title'         => __('Heading', 'fl-builder'),
				'fields'        => array(
					'title_tag'     => array(
						'type'          => 'select',
						'label'         => __('Heading Tag', 'fl-builder'),
						'default'       => 'h2',
						'options'       => array(
							'h1'            => 'h1',
							'h2'            => 'h2',
							'h3'            => 'h3',
							'h4'            => 'h4',
							'h5'            => 'h5',
							'h6'            => 'h6'
						)
					),
					'title_size'    => array(
						'type'          => 'select',
						'label'         => __('Heading Size', 'fl-builder'),
						'default'       => 'default',
						'options'       => array(
							'default'       =>  __('Default', 'fl-builder'),
							'custom'        =>  __('Custom', 'fl-builder')
						),
						'toggle'        => array(
							'custom'        => array(
								'fields'        => array('title_custom_size')
							)
						)
					),
					'title_custom_size' => array(
						'type'          => 'text',
						'label'         => __('Heading Size', 'fl-builder'),
						'default'       => '24',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
					)
				)
			),
			'text_position' => array(
				'title'         => __('Text', 'fl-builder'),
				'fields'        => array(
					'text_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'fl-builder'),
						'default'       => 'left',
						'help'          => __('The position will move the content layout selections left, right or bottom over the background of the slide.', 'fl-builder'),
						'options'       => array(
							'left'          => __('Left', 'fl-builder'),
							'right'         => __('Right', 'fl-builder'),
							'bottom'        => __('Bottom', 'fl-builder'),
						),
						'toggle'        => array(
							'left'        => array(
								'fields'        => array('text_width')
							),
							'right'        => array(
								'fields'        => array('text_width')
							)
						)
					),
					'thumb_text_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'fl-builder'),
						'default'       => 'left',
						'help'          => __('The position will move the content layout selections left or right or center of the thumbnail of the slide.', 'fl-builder'),
						'options'       => array(
							'left'          => __('Left', 'fl-builder'),
							'right'         => __('Right', 'fl-builder'),
						),
						'toggle'        => array(
							'left'        => array(
								'fields'        => array('text_width')
							),
							'right'        => array(
								'fields'        => array('text_width')
							)
						)
					),
					'text_width'   => array(
						'type'          => 'text',
						'label'         => __('Text Width', 'fl-builder'),
						'default'       => '50',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5'
					),
					'text_padding' => array(
						'type'          => 'text',
						'label'         => __('Text Padding', 'fl-builder'),
						'default'       => '50',
						'description'   => 'px',
						'maxlength'     => '4',
						'size'          => '5'
					),
				)
			),
			'text_style'    => array(
				'title'         => __('Colors', 'fl-builder'),
				'fields'        => array(
					'text_color'    => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'fl-builder'),
						'show_reset'    => true,
						'default'		=> 'ffffff',
						'preview'		=> array(
							'type'			=> 'css',
							'rules'			=> array(
								array(
									'selector'	=> '.fl-post-slider-background .fl-post-slider-content, .fl-post-slider-thumb, .fl-post-slider-no-thumb',
									'property'	=> 'color',
								)
							)
						)
					),
					'link_color'    => array(
						'type'          => 'color',
						'label'         => __('Link Color', 'fl-builder'),
						'show_reset'    => true,
						'default'		=> 'cccccc',
						'preview'		=> array(
							'type'			=> 'css',
							'rules'			=> array(
								array(
									'selector'	=> '.fl-post-slider-content a',
									'property'	=> 'color',
								)
							)
						)

					),
					'link_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Link Hover Color', 'fl-builder'),
						'default'		=> 'ffffff',
						'show_reset'    => true
					),
					'text_bg_color' => array(
						'type'          => 'color',
						'label'         => __('Text Background Color', 'fl-builder'),
						'help'          => __('The color applies to the overlay behind text over the background selections.', 'fl-builder'),
						'default'		=> '333333',
						'show_reset'    => true
					),
					'text_bg_opacity' => array(
						'type'          => 'text',
						'label'         => __('Text Background Opacity', 'fl-builder'),
						'default'       => '50',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => '%'
					),
					'bg_gradient' => array(
						'type'          => 'select',
						'label'         => __('Text Background Gradient', 'fl-builder'),
						'default'       => 'no',
						'options'       => array(
							'no'           => __( 'No', 'fl-builder' ),
							'yes'          => __( 'Yes', 'fl-builder' ),
						)
					),
					'text_bg_height' => array(
						'type'          => 'select',
						'label'         => __('Text Background Height', 'fl-builder'),
						'default'       => '100%',
						'help'          => __('Auto will allow the overlay to fit however long the text content is. 100% will fit the overlay to the top and bottom of the slide.', 'fl-builder'),
						'options'       => array(
							'auto'          => _x( 'Auto', 'Background height.', 'fl-builder' ),
							'100%'          => '100%'
						)
					),
				)
			)
		)
	),

	'content'   => array(
		'title'         => __('Content', 'fl-builder'),
		'file'          => FL_BUILDER_DIR . 'includes/loop-settings.php',
	)
));