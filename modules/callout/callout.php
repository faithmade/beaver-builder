<?php

/**
 * @class FLCalloutModule
 */
class FLCalloutModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Callout', 'fl-builder'),
			'description'   => __('A heading and snippet of text with an optional link, icon and image.', 'fl-builder'),
			'category'      => __('Advanced Modules', 'fl-builder')
		));
	}

	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Cache the photo data.
		if(!empty($settings->photo)) {

			$data = FLBuilderPhoto::get_attachment_data($settings->photo);

			if($data) {
				$settings->photo_data = $data;
			}
		}

		return $settings;
	}

	/**
	 * @method delete
	 */
	public function delete()
	{
		// Delete photo module cache.
		if($this->settings->image_type == 'photo' && !empty($this->settings->photo_src)) {
			$module_class = get_class(FLBuilderModel::$modules['photo']);
			$photo_module = new $module_class();
			$photo_module->settings = new stdClass();
			$photo_module->settings->photo_source = 'library';
			$photo_module->settings->photo_src = $this->settings->photo_src;
			$photo_module->settings->crop = $this->settings->photo_crop;
			$photo_module->delete();
		}
	}

	/**
	 * @method get_classname
	 */
	public function get_classname()
	{
		$classname = 'fl-callout fl-callout-' . $this->settings->align;

		if($this->settings->image_type == 'photo') {
			$classname .= ' fl-callout-has-photo fl-callout-photo-' . $this->settings->photo_position;
		}
		else if($this->settings->image_type == 'icon') {
			$classname .= ' fl-callout-has-icon fl-callout-icon-' . $this->settings->icon_position;
		}

		return $classname;
	}

	/**
	 * @method render_title
	 */
	public function render_title()
	{
		echo '<' . $this->settings->title_tag . ' class="fl-callout-title">';

		$this->render_image('left-title');

		echo '<span>';

		if(!empty($this->settings->link)) {
			echo '<a href="' . $this->settings->link . '" target="' . $this->settings->link_target . '" class="fl-callout-title-link">';
		}

		echo $this->settings->title;

		if(!empty($this->settings->link)) {
			echo '</a>';
		}

		echo '</span>';

		$this->render_image('right-title');

		echo '</' . $this->settings->title_tag . '>';
	}

	/**
	 * @method render_text
	 */
	public function render_text()
	{
		echo '<div class="fl-callout-text">' . $this->settings->text . '</div>';
	}

	/**
	 * @method render_link
	 */
	public function render_link()
	{
		if($this->settings->cta_type == 'link') {
			echo '<a href="' . $this->settings->link . '" target="' . $this->settings->link_target . '" class="fl-callout-cta-link">' . $this->settings->cta_text . '</a>';
		}
	}

	/**
	 * @method render_button
	 */
	public function render_button()
	{
		if($this->settings->cta_type == 'button') {

			$btn_settings = array(
				'align'             => '',
				'bg_color'          => $this->settings->btn_bg_color,
				'bg_hover_color'    => $this->settings->btn_bg_hover_color,
				'bg_opacity'        => $this->settings->btn_bg_opacity,
				'border_radius'     => $this->settings->btn_border_radius,
				'border_size'       => $this->settings->btn_border_size,
				'font_size'         => $this->settings->btn_font_size,
				'icon'              => $this->settings->btn_icon,
				'icon_position'     => $this->settings->btn_icon_position,
				'link'              => $this->settings->link,
				'link_target'       => $this->settings->link_target,
				'padding'           => $this->settings->btn_padding,
				'style'             => $this->settings->btn_style,
				'text'              => $this->settings->cta_text,
				'text_color'        => $this->settings->btn_text_color,
				'text_hover_color'  => $this->settings->btn_text_hover_color,
				'width'             => $this->settings->btn_width
			);

			echo '<div class="fl-callout-button">';
			FLBuilder::render_module_html('button', $btn_settings);
			echo '</div>';
		}
	}

	/**
	 * @method render_image
	 */
	public function render_image($position)
	{
		if($this->settings->image_type == 'photo' && $this->settings->photo_position == $position) {

			if(empty($this->settings->photo)) {
				return;
			}

			$photo_data = FLBuilderPhoto::get_attachment_data($this->settings->photo);

			if(!$photo_data) {
				$photo_data = $this->settings->photo_data;
			}

			$photo_settings = array(
				'align'         => 'center',
				'crop'          => $this->settings->photo_crop,
				'link_target'   => $this->settings->link_target,
				'link_type'     => 'url',
				'link_url'      => $this->settings->link,
				'photo'         => $photo_data,
				'photo_src'     => $this->settings->photo_src,
				'photo_source'  => 'library'
			);

			echo '<div class="fl-callout-photo">';
			FLBuilder::render_module_html('photo', $photo_settings);
			echo '</div>';
		}
		else if($this->settings->image_type == 'icon' && $this->settings->icon_position == $position) {

			$icon_settings = array(
				'bg_color'       => $this->settings->icon_bg_color,
				'bg_hover_color' => $this->settings->icon_bg_hover_color,
				'color'          => $this->settings->icon_color,
				'exclude_wrapper'=> true,
				'hover_color'    => $this->settings->icon_hover_color,
				'icon'           => $this->settings->icon,
				'link'           => $this->settings->link,
				'link_target'    => $this->settings->link_target,
				'size'           => $this->settings->icon_size,
				'text'           => '',
				'three_d'        => $this->settings->icon_3d
			);

			FLBuilder::render_module_html('icon', $icon_settings);
		}
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLCalloutModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
		'sections'      => array(
			'title'         => array(
				'title'         => '',
				'fields'        => array(
					'title'         => array(
						'type'          => 'text',
						'label'         => __('Heading', 'fl-builder'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-callout-title'
						)
					)
				)
			),
			'text'          => array(
				'title'         => __('Text', 'fl-builder'),
				'fields'        => array(
					'text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-callout-text'
						)
					)
				)
			)
		)
	),
	'style'         => array(
		'title'         => __('Style', 'fl-builder'),
		'sections'      => array(
			'overall_structure' => array(
				'title'         => __('Structure', 'fl-builder'),
				'fields'        => array(
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Overall Alignment', 'fl-builder'),
						'default'       => 'left',
						'options'       => array(
							'center'        => __('Center', 'fl-builder'),
							'left'          => __('Left', 'fl-builder'),
							'right'         => __('Right', 'fl-builder')
						),
						'help'          => __('The alignment that will apply to all elements within the callout.', 'fl-builder'),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'title_structure' => array(
				'title'         => __( 'Heading Structure', 'fl-builder' ),
				'fields'        => array(
					'title_tag'     => array(
						'type'          => 'select',
						'label'         => __('Heading Tag', 'fl-builder'),
						'default'       => 'h3',
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
						'label'             => __('Heading Custom Size', 'fl-builder'),
						'default'           => '24',
						'maxlength'         => '3',
						'size'              => '4',
						'description'       => 'px'
					)
				)
			)
		)
	),
	'image'         => array(
		'title'         => __('Image', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'image_type'    => array(
						'type'          => 'select',
						'label'         => __('Image Type', 'fl-builder'),
						'default'       => 'photo',
						'options'       => array(
							'none'          => _x( 'None', 'Image type.', 'fl-builder' ),
							'photo'         => __('Photo', 'fl-builder'),
							'icon'          => __('Icon', 'fl-builder')
						),
						'toggle'        => array(
							'none'          => array(),
							'photo'         => array(
								'sections'      => array('photo')
							),
							'icon'          => array(
								'sections'      => array('icon', 'icon_colors', 'icon_structure')
							)
						)
					)
				)
			),
			'photo'         => array(
				'title'         => __('Photo', 'fl-builder'),
				'fields'        => array(
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Photo', 'fl-builder')
					),
					'photo_crop'    => array(
						'type'          => 'select',
						'label'         => __('Crop', 'fl-builder'),
						'default'       => '',
						'options'       => array(
							''              => _x( 'None', 'Crop', 'fl-builder' ),
							'landscape'     => __('Landscape', 'fl-builder'),
							'panorama'      => __('Panorama', 'fl-builder'),
							'portrait'      => __('Portrait', 'fl-builder'),
							'square'        => __('Square', 'fl-builder'),
							'circle'        => __('Circle', 'fl-builder')
						)
					),
					'photo_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'fl-builder'),
						'default'       => 'above-title',
						'options'       => array(
							'above-title'   => __('Above Heading', 'fl-builder'),
							'below-title'   => __('Below Heading', 'fl-builder'),
							'left'          => __('Left of Text and Heading', 'fl-builder'),
							'right'         => __('Right of Text and Heading', 'fl-builder')
						)
					)
				)
			),
			'icon'          => array(
				'title'         => __('Icon', 'fl-builder'),
				'fields'        => array(
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'fl-builder')
					),
					'icon_position' => array(
						'type'          => 'select',
						'label'         => __('Position', 'fl-builder'),
						'default'       => 'left-title',
						'options'       => array(
							'above-title'   => __('Above Heading', 'fl-builder'),
							'below-title'   => __('Below Heading', 'fl-builder'),
							'left-title'    => __( 'Left of Heading', 'fl-builder' ),
							'right-title'   => __( 'Right of Heading', 'fl-builder' ),
							'left'          => __('Left of Text and Heading', 'fl-builder'),
							'right'         => __('Right of Text and Heading', 'fl-builder')
						)
					)
				)
			),
			'icon_colors'   => array(
				'title'         => __('Icon Colors', 'fl-builder'),
				'fields'        => array(
					'icon_color'    => array(
						'type'          => 'color',
						'label'         => __('Color', 'fl-builder'),
						'show_reset'    => true
					),
					'icon_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Hover Color', 'fl-builder'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'icon_bg_color' => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'fl-builder'),
						'show_reset'    => true
					),
					'icon_bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'fl-builder'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'icon_3d'       => array(
						'type'          => 'select',
						'label'         => __('Gradient', 'fl-builder'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'fl-builder'),
							'1'             => __('Yes', 'fl-builder')
						)
					)
				)
			),
			'icon_structure' => array(
				'title'         => __('Icon Structure', 'fl-builder'),
				'fields'        => array(
					'icon_size'     => array(
						'type'          => 'text',
						'label'         => __('Size', 'fl-builder'),
						'default'       => '30',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
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
						'help'          => __('The link applies to the entire module. If choosing a call to action type below, this link will also be used for the text or button.', 'fl-builder'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'link_target'   => array(
						'type'          => 'select',
						'label'         => __('Link Target', 'fl-builder'),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __('Same Window', 'fl-builder'),
							'_blank'        => __('New Window', 'fl-builder')
						),
						'preview'       => array(
							'type'          => 'none'
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
							'link'          => __('Text', 'fl-builder'),
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
						'label'         => __('Text', 'fl-builder'),
						'default'		=> __('Read More', 'fl-builder'),
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
						'default'       => '',
						'show_reset'    => true
					),
					'btn_bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'btn_text_color' => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_text_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Text Hover Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
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
					'btn_width'     => array(
						'type'          => 'select',
						'label'         => __('Button Width', 'fl-builder'),
						'default'       => 'auto',
						'options'       => array(
							'auto'          => _x( 'Auto', 'Width.', 'fl-builder' ),
							'full'          => __('Full Width', 'fl-builder')
						)
					),
					'btn_font_size' => array(
						'type'          => 'text',
						'label'         => __('Font Size', 'fl-builder'),
						'default'       => '14',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_padding'   => array(
						'type'          => 'text',
						'label'         => __('Padding', 'fl-builder'),
						'default'       => '10',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_border_radius' => array(
						'type'          => 'text',
						'label'         => __('Round Corners', 'fl-builder'),
						'default'       => '4',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					)
				)
			)
		)
	)
));