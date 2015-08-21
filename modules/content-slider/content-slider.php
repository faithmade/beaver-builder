<?php

/**
 * @class FLContentSliderModule
 */
class FLContentSliderModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Content Slider', 'fl-builder'),
			'description'   => __('Displays multiple slides with an optional heading and call to action.', 'fl-builder'),
			'category'      => __('Advanced Modules', 'fl-builder')
		));

		$this->add_css('jquery-bxslider');
		$this->add_js('jquery-bxslider');
	}

	/**
	 * @method render_background
	 */
	public function render_background($slide)
	{
		// Background photo
		if($slide->bg_layout == 'photo' && !empty($slide->bg_photo_src)) {

			echo '<div class="fl-slide-bg-photo" style="background-image: url(' . $slide->bg_photo_src . ');">';

			if(!empty($slide->link) && $slide->cta_type == 'none') {
				echo '<a href="' . $slide->link . '" target="' . $slide->link_target. '"></a>';
			}

			echo '</div>';
		}

		// Background video
		elseif($slide->bg_layout == 'video' && !empty($slide->bg_video)) {
			echo '<div class="fl-slide-bg-video">' . $slide->bg_video . '</div>';
		}
	}

	/**
	 * @method render_content
	 */
	public function render_content($slide)
	{
		if($slide->content_layout != 'none' && $slide->bg_layout != 'video') {

			echo '<div class="fl-slide-content-wrap">';
			echo '<div class="fl-slide-content">';

			if(!empty($slide->title)) {
				echo '<' . $slide->title_tag . ' class="fl-slide-title">' . $slide->title . '</' . $slide->title_tag . '>';
			}
			if(!empty($slide->text)) {
				echo '<div class="fl-slide-text">' . $slide->text . $this->render_link($slide) . '</div>';
			}

			$this->render_button($slide);

			echo '</div>';
			echo '</div>';
		}
	}

	/**
	 * @method render_media
	 */
	public function render_media($slide)
	{
		// Photo
		if($slide->content_layout == 'photo' && !empty($slide->fg_photo_src)) {
			echo '<div class="fl-slide-photo-wrap">';
			echo '<div class="fl-slide-photo">';
			echo '<img class="fl-slide-photo-img" src="' . $slide->fg_photo_src . '" />';
			echo '</div>';
			echo '</div>';
		}
		// Video
		elseif($slide->content_layout == 'video' && !empty($slide->fg_video)) {
			echo '<div class="fl-slide-photo-wrap">';
			echo '<div class="fl-slide-photo">' . $slide->fg_video . '</div>';
			echo '</div>';
		}
	}

	/**
	 * @method render_mobile_media
	 */
	public function render_mobile_media($slide)
	{
		// Photo
		if($slide->content_layout == 'photo') {

			$src = '';

			if($slide->r_photo_type == 'main' && !empty($slide->fg_photo_src)) {
				$src = $slide->fg_photo_src;
			}
			else if($slide->r_photo_type == 'another' && !empty($slide->r_photo_src)) {
				$src = $slide->r_photo_src;
			}

			if(!empty($src)) {
				echo '<div class="fl-slide-mobile-photo">';
				echo '<img class="fl-slide-mobile-photo-img" src="' . $src . '" />';
				echo '</div>';
			}
		}
		// Video
		elseif($slide->content_layout == 'video' && !empty($slide->fg_video)) {
			echo '<div class="fl-slide-mobile-photo">' . $slide->fg_video . '</div>';
		}
		// BG Photo
		elseif($slide->bg_layout == 'photo') {

			$src = '';

			if($slide->r_photo_type == 'main' && !empty($slide->bg_photo_src)) {
				$src = $slide->bg_photo_src;
			}
			else if($slide->r_photo_type == 'another' && !empty($slide->r_photo_src)) {
				$src = $slide->r_photo_src;
			}

			if(!empty($src)) {
				echo '<div class="fl-slide-mobile-photo">';
				echo '<img class="fl-slide-mobile-photo-img" src="' . $src . '" />';
				echo '</div>';
			}
		}
	}

	/**
	 * @method render_link
	 */
	public function render_link($slide)
	{
		if($slide->cta_type == 'link') {
			return '<a href="' . $slide->link . '" target="' . $slide->link_target . '" class="fl-slide-cta-link">' . $slide->cta_text . '</a>';
		}
	}

	/**
	 * @method render_button
	 */
	public function render_button($slide)
	{
		if($slide->cta_type == 'button') {
			
			if ( ! isset( $slide->btn_style ) ) {
				$slide->btn_style = 'flat';
			}

			$btn_settings = array(
				'align'             => '',
				'bg_color'          => $slide->btn_bg_color,
				'bg_hover_color'    => $slide->btn_bg_hover_color,
				'bg_opacity'        => isset( $slide->btn_bg_opacity ) ? $slide->btn_bg_opacity : 0,
				'border_radius'     => $slide->btn_border_radius,
				'border_size'       => isset( $slide->btn_border_size ) ? $slide->btn_border_size : 2,
				'font_size'         => $slide->btn_font_size,
				'icon'              => isset( $slide->btn_icon ) ? $slide->btn_icon : '',
				'icon_position'     => isset( $slide->btn_icon_position ) ? $slide->btn_icon_position : 'before',
				'link'              => $slide->link,
				'link_target'       => $slide->link_target,
				'padding'           => $slide->btn_padding,
				'style'             => ( isset( $slide->btn_3d ) && $slide->btn_3d ) ? 'gradient' : $slide->btn_style,
				'text'              => $slide->cta_text,
				'text_color'        => $slide->btn_text_color,
				'text_hover_color'  => $slide->btn_text_hover_color,
				'width'             => 'auto'
			);

			echo '<div class="fl-slide-cta-button">';
			FLBuilder::render_module_html('button', $btn_settings);
			echo '</div>';
		}
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLContentSliderModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
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
						'help'          => __('This setting is the minimum height of the content slider. Content will expand the height automatically.', 'fl-builder')
					),
					'auto_play'     => array(
						'type'          => 'select',
						'label'         => __('Auto Play', 'fl-builder'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'fl-builder'),
							'1'             => __('Yes', 'fl-builder')
						),
						'toggle'        => array(
							'1'             => array(
								'fields'        => array('play_pause')
							)
						)
					),
					'play_pause'    => array(
						'type'          => 'select',
						'label'         => __('Show Play/Pause', 'fl-builder'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'fl-builder'),
							'1'             => __('Yes', 'fl-builder')
						)
					),
					'delay'         => array(
						'type'          => 'text',
						'label'         => __('Delay', 'fl-builder'),
						'default'       => '5',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'fl-builder' )
					),
					'transition'    => array(
						'type'          => 'select',
						'label'         => __('Transition', 'fl-builder'),
						'default'       => 'slide',
						'options'       => array(
							'horizontal'    => _x( 'Slide', 'Transition type.', 'fl-builder' ),
							'fade'          => __( 'Fade', 'fl-builder' )
						)
					),
					'speed'         => array(
						'type'          => 'text',
						'label'         => __('Transition Speed', 'fl-builder'),
						'default'       => '0.5',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => _x( 'seconds', 'Value unit for form field of time in seconds. Such as: "5 seconds"', 'fl-builder' )
					),
					'arrows'       => array(
						'type'          => 'select',
						'label'         => __('Show Arrows', 'fl-builder'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'fl-builder'),
							'1'             => __('Yes', 'fl-builder')
						)
					),
					'dots'          => array(
						'type'          => 'select',
						'label'         => __('Show Dots', 'fl-builder'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'fl-builder'),
							'1'             => __('Yes', 'fl-builder')
						)
					)
				)
			),
			'advanced'      => array(
				'title'         => __('Advanced', 'fl-builder'),
				'fields'        => array(
					'max_width'     => array(
						'type'          => 'text',
						'label'         => __('Max Content Width', 'fl-builder'),
						'default'       => '1100',
						'maxlength'     => '4',
						'size'          => '5',
						'description'   => 'px',
						'help'          => __('The max width that the content area will be within your slides.', 'fl-builder')
					)
				)
			)
		)
	),
	'slides'       => array(
		'title'         => __('Slides', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'slides'        => array(
						'type'          => 'form',
						'label'         => __('Slide', 'fl-builder'),
						'form'          => 'content_slider_slide', // ID from registered form below
						'preview_text'  => 'label', // Name of a field to use for the preview text
						'multiple'      => true
					)
				)
			)
		)
	)
));

/**
 * Register the slide settings form.
 */
FLBuilder::register_settings_form('content_slider_slide', array(
	'title' => __('Slide Settings', 'fl-builder'),
	'tabs'  => array(
		'general'        => array( // Tab
			'title'         => __('General', 'fl-builder'), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array(
					'title'     => '',
					'fields'    => array(
						'label'         => array(
							'type'          => 'text',
							'label'         => __('Slide Label', 'fl-builder'),
							'help'          => __('A label to identify this slide on the Slides tab of the Content Slider settings.', 'fl-builder')
						)
					)
				),
				'background' => array(
					'title'     => __('Background Layout', 'fl-builder'),
					'fields'    => array(
						'bg_layout'     => array(
							'type'          => 'select',
							'label'         => __('Type', 'fl-builder'),
							'default'       => 'photo',
							'help'          => __('This setting is for the entire background of your slide.', 'fl-builder'),
							'options'       => array(
								'photo'         => __('Photo', 'fl-builder'),
								'video'         => __('Video', 'fl-builder'),
								'color'         => __('Color', 'fl-builder'),
								'none'          => _x( 'None', 'Background type.', 'fl-builder' )
							),
							'toggle'        => array(
								'photo'         => array(
									'fields'        => array('bg_photo'),
									'sections'      => array('content', 'text')
								),
								'color'         => array(
									'fields'        => array('bg_color'),
									'sections'      => array('content', 'text')
								),
								'video'         => array(
									'fields'        => array('bg_video')
								),
								'none'          => array(
									'sections'      => array('content', 'text')
								)
							)
						),
						'bg_photo'      => array(
							'type'          => 'photo',
							'label'         => __('Background Photo', 'fl-builder')
						),
						'bg_color'      => array(
							'type'          => 'color',
							'label'         => __('Background Color', 'fl-builder'),
							'show_reset'    => true
						),
						'bg_video'      => array(
							'type'          => 'textarea',
							'label'         => __('Background Video Code', 'fl-builder'),
							'rows'          => '6'
						)
					)
				),
				'content'      => array(
					'title'         => __('Content Layout', 'fl-builder'),
					'fields'        => array(
						'content_layout' => array(
							'type'          => 'select',
							'label'         => __('Type', 'fl-builder'),
							'default'       => 'none',
							'help'          => __('This allows you to add content over or in addition to the background selection above. The location of the content layout can be selected in the style tab.', 'fl-builder'),
							'options'       => array(
								'text'          => __('Text', 'fl-builder'),
								'photo'         => __('Text &amp; Photo', 'fl-builder'),
								'video'         => __('Text &amp; Video', 'fl-builder'),
								'none'          => _x( 'None', 'Content type.', 'fl-builder' )
							),
							'toggle'        => array(
								'text'          => array(
									'fields'        => array('title', 'text'),
									'sections'      => array('text')
								),
								'photo'         => array(
									'fields'        => array('title', 'text', 'fg_photo'),
									'sections'      => array('text')
								),
								'video'         => array(
									'fields'        => array('title', 'text', 'fg_video'),
									'sections'      => array('text')
								)
							)
						),
						'fg_photo'      => array(
							'type'          => 'photo',
							'label'         => __('Photo', 'fl-builder')
						),
						'fg_video'      => array(
							'type'          => 'textarea',
							'label'         => __('Video Embed Code', 'fl-builder'),
							'rows'          => '6'
						),
						'title'         => array(
							'type'          => 'text',
							'label'         => __('Heading', 'fl-builder')
						),
						'text'          => array(
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 16
						)
					)
				)
			)
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
							'type'              => 'text',
							'label'             => __('Heading Size', 'fl-builder'),
							'default'           => '24',
							'maxlength'         => '3',
							'size'              => '4',
							'description'       => 'px'
						)
					)
				),
				'text_position' => array(
					'title'         => __('Text Position', 'fl-builder'),
					'fields'        => array(
						'text_position' => array(
							'type'          => 'select',
							'label'         => __('Position', 'fl-builder'),
							'default'       => 'top-left',
							'help'          => __('The position will move the content layout selections left, right or center over the background of the slide.', 'fl-builder'),
							'options'       => array(
								'left'          => __('Left', 'fl-builder'),
								'center'        => __('Center', 'fl-builder'),
								'right'         => __('Right', 'fl-builder')
							)
						),
						'text_width'   => array(
							'type'          => 'text',
							'label'         => __('Width', 'fl-builder'),
							'default'       => '50',
							'description'   => '%',
							'maxlength'     => '3',
							'size'          => '5'
						),
						'text_margin_top' => array(
							'type'          => 'text',
							'label'         => __('Top Margin', 'fl-builder'),
							'default'       => '60',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5'
						),
						'text_margin_bottom' => array(
							'type'          => 'text',
							'label'         => __('Bottom Margin', 'fl-builder'),
							'default'       => '60',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5'
						),
						'text_margin_left' => array(
							'type'          => 'text',
							'label'         => __('Left Margin', 'fl-builder'),
							'default'       => '60',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5'
						),
						'text_margin_right' => array(
							'type'          => 'text',
							'label'         => __('Right Margin', 'fl-builder'),
							'default'       => '60',
							'description'   => 'px',
							'maxlength'     => '4',
							'size'          => '5'
						)
					)
				),
				'text_style'    => array(
					'title'         => __('Text Colors', 'fl-builder'),
					'fields'        => array(
						'text_color'    => array(
							'type'          => 'color',
							'label'         => __('Text Color', 'fl-builder'),
							'default'       => 'ffffff',
							'show_reset'    => true
						),
						'text_shadow'   => array(
							'type'          => 'select',
							'label'         => __('Text Shadow', 'fl-builder'),
							'default'       => '0',
							'options'       => array(
								'0'             => __('No', 'fl-builder'),
								'1'             => __('Yes', 'fl-builder')
							)
						),
						'text_bg_color'    => array(
							'type'          => 'color',
							'label'         => __('Text Background Color', 'fl-builder'),
							'help'          => __('The color applies to the overlay behind text over the background selections.', 'fl-builder'),
							'show_reset'    => true
						),
						'text_bg_opacity' => array(
							'type'          => 'text',
							'label'         => __('Text Background Opacity', 'fl-builder'),
							'default'       => '70',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => '%'
						),
						'text_bg_height' => array(
							'type'          => 'select',
							'label'         => __('Text Background Height', 'fl-builder'),
							'default'       => 'auto',
							'help'          => __('Auto will allow the overlay to fit however long the text content is. 100% will fit the overlay to the top and bottom of the slide.', 'fl-builder'),
							'options'       => array(
								'auto'          => _x( 'Auto', 'Background height.', 'fl-builder' ),
								'100%'          => '100%'
							)
						)
					)
				)
			)
		),
		'cta'           => array(
			'title'         => __('Call To Action', 'fl-builder'),
			'sections'      => array(
				'link'          => array(
					'title'         => __('Link', 'fl-builder'),
					'fields'        => array(
						'link'          => array(
							'type'          => 'link',
							'label'         => __('Link', 'fl-builder'),
							'help'          => __('The link applies to the entire slide. If choosing a call to action type below, this link will also be used for the text or button.', 'fl-builder')
						),
						'link_target'   => array(
							'type'          => 'select',
							'label'         => __('Link Target', 'fl-builder'),
							'default'       => '_self',
							'options'       => array(
								'_self'         => __('Same Window', 'fl-builder'),
								'_blank'        => __('New Window', 'fl-builder')
							)
						)
					)
				),
				'cta'           => array(
					'title'         => __('Call to Action', 'fl-builder'),
					'fields'        => array(
						'cta_type'      => array(
							'type'          => 'select',
							'label'         => __('Type', 'fl-builder'),
							'default'       => 'none',
							'options'       => array(
								'none'          => _x( 'None', 'Call to action.', 'fl-builder' ),
								'link'          => __('Link', 'fl-builder'),
								'button'        => __('Button', 'fl-builder')
							),
							'toggle'        => array(
								'none'          => array(),
								'link'          => array(
									'fields'        => array('cta_text')
								),
								'button'        => array(
									'fields'        => array('cta_text', 'btn_icon', 'btn_icon_position'),
									'sections'      => array('btn_colors', 'btn_structure')
								)
							)
						),
						'cta_text'      => array(
							'type'          => 'text',
							'label'         => __('Text', 'fl-builder')
						),
						'btn_icon'      => array(
							'type'          => 'icon',
							'label'         => __('Button Icon', 'fl-builder'),
							'show_remove'   => true
						),
						'btn_icon_position' => array(
							'type'          => 'select',
							'label'         => __('Button Icon Position', 'fl-builder'),
							'default'       => 'before',
							'options'       => array(
								'before'        => __('Before Text', 'fl-builder'),
								'after'         => __('After Text', 'fl-builder')
							)
						)
					)
				),
				'btn_colors'     => array(
					'title'         => __('Button Colors', 'fl-builder'),
					'fields'        => array(
						'btn_bg_color'  => array(
							'type'          => 'color',
							'label'         => __('Background Color', 'fl-builder'),
							'default'       => 'f7f7f7',
							'show_reset'    => true
						),
						'btn_bg_hover_color' => array(
							'type'          => 'color',
							'label'         => __('Background Hover Color', 'fl-builder'),
							'show_reset'    => true
						),
						'btn_text_color' => array(
							'type'          => 'color',
							'label'         => __('Text Color', 'fl-builder'),
							'default'       => '333333',
							'show_reset'    => true
						),
						'btn_text_hover_color' => array(
							'type'          => 'color',
							'label'         => __('Text Hover Color', 'fl-builder'),
							'show_reset'    => true
						)
					)
				),
				'btn_style'     => array(
					'title'         => __('Button Style', 'fl-builder'),
					'fields'        => array(
						'btn_style'     => array(
							'type'          => 'select',
							'label'         => __('Style', 'fl-builder'),
							'default'       => 'flat',
							'options'       => array(
								'flat'          => __('Flat', 'fl-builder'),
								'gradient'      => __('Gradient', 'fl-builder'),
								'transparent'   => __('Transparent', 'fl-builder')
							),
							'toggle'        => array(
								'transparent'   => array(
									'fields'        => array('btn_bg_opacity', 'btn_border_size')
								)
							)
						),
						'btn_border_size' => array(
							'type'          => 'text',
							'label'         => __('Border Size', 'fl-builder'),
							'default'       => '2',
							'description'   => 'px',
							'maxlength'     => '3',
							'size'          => '5',
							'placeholder'   => '0'
						),
						'btn_bg_opacity' => array(
							'type'          => 'text',
							'label'         => __('Background Opacity', 'fl-builder'),
							'default'       => '0',
							'description'   => '%',
							'maxlength'     => '3',
							'size'          => '5',
							'placeholder'   => '0'
						)
					)  
				),
				'btn_structure' => array(
					'title'         => __('Button Structure', 'fl-builder'),
					'fields'        => array(
						'btn_font_size' => array(
							'type'          => 'text',
							'label'         => __('Font Size', 'fl-builder'),
							'default'       => '16',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						),
						'btn_padding'   => array(
							'type'          => 'text',
							'label'         => __('Padding', 'fl-builder'),
							'default'       => '14',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						),
						'btn_border_radius' => array(
							'type'          => 'text',
							'label'         => __('Border Radius', 'fl-builder'),
							'default'       => '6',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						)
					)
				)
			)
		),
		'mobile'        => array(
			'title'         => _x( 'Mobile', 'Module settings form tab. Display on mobile devices.', 'fl-builder' ),
			'sections'      => array(
				'r_photo'       => array(
					'title'         => __('Mobile Photo', 'fl-builder'),
					'fields'        => array(
						'r_photo_type'  => array(
							'type'          => 'select',
							'label'         => __('Type', 'fl-builder'),
							'default'       => 'main',
							'help'          => __('You can choose a different photo that the slide will change to on mobile devices or no photo if desired.', 'fl-builder'),
							'options'       => array(
								'main'          => __('Use Main Photo', 'fl-builder'),
								'another'       => __('Choose Another Photo', 'fl-builder'),
								'none'          => __('No Photo', 'fl-builder')
							),
							'toggle'        => array(
								'another'       => array(
									'fields'        => array('r_photo')
								)
							)
						),
						'r_photo'    => array(
							'type'          => 'photo',
							'label'         => __('Photo', 'fl-builder')
						)
					)
				),
				'r_text_style'   => array(
					'title'         => __('Mobile Text Colors', 'fl-builder'),
					'fields'        => array(
						'r_text_color'  => array(
							'type'          => 'color',
							'label'         => __('Text Color', 'fl-builder'),
							'default'       => 'ffffff',
							'show_reset'    => true
						),
						'r_text_bg_color' => array(
							'type'          => 'color',
							'label'         => __('Text Background Color', 'fl-builder'),
							'default'       => '333333',
							'show_reset'    => true
						)
					)
				)
			)
		)
	)
));