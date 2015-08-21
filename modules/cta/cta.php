<?php

/**
 * @class FLCtaModule
 */
class FLCtaModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Call to Action', 'fl-builder'),
			'description'   => __('Display a heading, subheading and a button.', 'fl-builder'),
			'category'      => __('Advanced Modules', 'fl-builder')
		));
	}

	/**
	 * @method get_classname
	 */
	public function get_classname()
	{
		$classname = 'fl-cta-wrap fl-cta-' . $this->settings->layout;

		if($this->settings->layout == 'stacked') {
			$classname .= ' fl-cta-' . $this->settings->alignment;
		}

		return $classname;
	}

	/**
	 * @method render_button
	 */
	public function render_button()
	{
		$btn_settings = array(
			'align'             => '',
			'bg_color'          => $this->settings->btn_bg_color,
			'bg_hover_color'    => $this->settings->btn_bg_hover_color,
			'bg_opacity'        => $this->settings->btn_bg_opacity,
			'border_radius'     => $this->settings->btn_border_radius,
			'border_size'       => $this->settings->btn_border_size,
			'font_size'         => $this->settings->btn_font_size,
			'icon'              => $this->settings->btn_icon,
			'icon_position'		=> $this->settings->btn_icon_position,
			'link'              => $this->settings->btn_link,
			'link_target'       => $this->settings->btn_link_target,
			'padding'           => $this->settings->btn_padding,
			'style'             => $this->settings->btn_style,
			'text'              => $this->settings->btn_text,
			'text_color'        => $this->settings->btn_text_color,
			'text_hover_color'  => $this->settings->btn_text_hover_color,
			'width'             => $this->settings->layout == 'stacked' ? 'auto' : 'full'
		);

		FLBuilder::render_module_html('button', $btn_settings);
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLCtaModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
		'sections'      => array(
			'title'         => array(
				'title'         => '',
				'fields'        => array(
					'title'         => array(
						'type'          => 'text',
						'label'         => __('Heading', 'fl-builder'),
						'default'       => __('Ready to find out more?', 'fl-builder'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-cta-title'
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
						'default'       => __('Drop us a line today for a free quote!', 'fl-builder'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-cta-text-content'
						)
					)
				)
			)
		)
	),
	'style'        => array(
		'title'         => __('Style', 'fl-builder'),
		'sections'      => array(
			'structure'     => array(
				'title'         => __('Structure', 'fl-builder'),
				'fields'        => array(
					'layout'        => array(
						'type'          => 'select',
						'label'         => __('Layout', 'fl-builder'),
						'default'       => 'inline',
						'options'       => array(
							'inline'        => __('Inline', 'fl-builder'),
							'stacked'       => __('Stacked', 'fl-builder')
						),
						'toggle'        => array(
							'stacked'       => array(
								'fields'        => array('alignment')
							)
						)
					),
					'alignment'     => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'fl-builder'),
						'default'       => 'center',
						'options'       => array(
							'left'      =>  __('Left', 'fl-builder'),
							'center'    =>  __('Center', 'fl-builder'),
							'right'     =>  __('Right', 'fl-builder')
						)
					),
					'spacing'       => array(
						'type'          => 'text',
						'label'         => __('Spacing', 'fl-builder'),
						'default'       => '0',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-module-content',
							'property'      => 'padding',
							'unit'          => 'px'
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
			),
			'colors'        => array(
				'title'         => __('Colors', 'fl-builder'),
				'fields'        => array(
					'text_color'    => array(
						'type'          => 'color',
						'label'         => __('Text Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true
					),
					'bg_color'      => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'fl-builder'),
						'default'       => '',
						'show_reset'    => true
					),
					'bg_opacity'    => array(
						'type'          => 'text',
						'label'         => __('Background Opacity', 'fl-builder'),
						'default'       => '100',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5'
					)
				)
			)
		)
	),
	'button'        => array(
		'title'         => __('Button', 'fl-builder'),
		'sections'      => array(
			'btn_text'      => array(
				'title'         => '',
				'fields'        => array(
					'btn_text'      => array(
						'type'          => 'text',
						'label'         => __('Text', 'fl-builder'),
						'default'       => __('Click Here', 'fl-builder'),
						'preview'         => array(
							'type'            => 'text',
							'selector'        => '.fl-button-text'
						)
					),
					'btn_icon'      => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'fl-builder'),
						'show_remove'   => true
					),
					'btn_icon_position' => array(
						'type'          => 'select',
						'label'         => __('Icon Position', 'fl-builder'),
						'default'       => 'before',
						'options'       => array(
							'before'        => __('Before Text', 'fl-builder'),
							'after'         => __('After Text', 'fl-builder')
						)
					)
				)
			),
			'btn_link'      => array(
				'title'         => __('Button Link', 'fl-builder'),
				'fields'        => array(
					'btn_link'      => array(
						'type'          => 'link',
						'label'         => __('Link', 'fl-builder'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'btn_link_target' => array(
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
						'default'       => '12',
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
						'description'   => 'px',
						'preview'         => array(
							'type'            => 'css',
							'selector'        => 'a.fl-button',
							'property'        => 'border-radius',
							'unit'            => 'px'
						)
					)
				)
			)
		)
	)
));