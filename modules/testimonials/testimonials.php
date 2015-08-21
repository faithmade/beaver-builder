<?php

/**
 * @class FLTestimonialsModule
 */
class FLTestimonialsModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Testimonials', 'fl-builder'),
			'description'   => __('An animated tesimonials area.', 'fl-builder'),
			'category'      => __('Advanced Modules', 'fl-builder')
		));

		$this->add_css('jquery-bxslider');
		$this->add_css('font-awesome');
		$this->add_js('jquery-bxslider');
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLTestimonialsModule', array(
	'general'      => array( // Tab
		'title'         => __('General', 'fl-builder'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'layout'       => array(
						'type'          => 'select',
						'label'         => __('Layout', 'fl-builder'),
						'default'       => 'compact',
						'options'       => array(
							'wide'             => __('Wide', 'fl-builder'),
							'compact'             => __('Compact', 'fl-builder')
						),
						'toggle'        => array(
							'compact'      => array(
								'sections'      => array('heading', 'arrow_nav')
							),
							'wide'      => array(
								'sections'      => array('dot_nav')
							)
						),
						'help' => __('Wide is for 1 column rows, compact is for multi-column rows.', 'fl-builder')
					)
				)
			),
			'heading'       => array( // Section
				'title'         => __('Heading', 'fl-builder'), // Section Title
				'fields'        => array( // Section Fields
					'heading'         => array(
						'type'          => 'text',
						'default'       => __( 'Testimonials', 'fl-builder' ),
						'label'         => __('Heading', 'fl-builder'),
						'preview'       => array(
							'type'          => 'text',
							'selector'      => '.fl-testimonials-heading'
						)
					),
					'heading_size'         => array(
						'type'          => 'text',
						'label'         => __('Heading Size', 'fl-builder'),
						'default'       => '24',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					)
				)
			),
			'slider'       => array( // Section
				'title'         => __('Slider Settings', 'fl-builder'), // Section Title
				'fields'        => array( // Section Fields
					'auto_play'     => array(
						'type'          => 'select',
						'label'         => __('Auto Play', 'fl-builder'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'fl-builder'),
							'1'             => __('Yes', 'fl-builder')
						)
					),
					'pause'         => array(
						'type'          => 'text',
						'label'         => __('Delay', 'fl-builder'),
						'default'       => '4',
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
					)
				)
			),
			'arrow_nav'       => array( // Section
				'title'         => '',
				'fields'        => array( // Section Fields
					'arrows'       => array(
						'type'          => 'select',
						'label'         => __('Show Arrows', 'fl-builder'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'fl-builder'),
							'1'             => __('Yes', 'fl-builder')
						),
						'toggle'        => array(
							'1'         => array(
								'fields'        => array('arrow_color')
							)
						)
					),
					'arrow_color'       => array(
						'type'          => 'color',
						'label'         => __('Arrow Color', 'fl-builder'),
						'default'       => '999999',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-testimonials-wrap .fa',
							'property'      => 'color'
						)
					)
				)
			),
			'dot_nav'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'dots'       => array(
						'type'          => 'select',
						'label'         => __('Show Dots', 'fl-builder'),
						'default'       => '1',
						'options'       => array(
							'0'             => __('No', 'fl-builder'),
							'1'             => __('Yes', 'fl-builder')
						),
						'toggle'        => array(
							'1'         => array(
								'fields'        => array('dot_color')
							)
						)
					),
					'dot_color'       => array(
						'type'          => 'color',
						'label'         => __('Dot Color', 'fl-builder'),
						'default'       => '999999',
						'show_reset'    => true
					)
				)
			)
		)
	),
	'testimonials'      => array( // Tab
		'title'         => __('Testimonials', 'fl-builder'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'testimonials'     => array(
						'type'          => 'form',
						'label'         => __('Testimonial', 'fl-builder'),
						'form'          => 'testimonials_form', // ID from registered form below
						'preview_text'  => 'testimonial', // Name of a field to use for the preview text
						'multiple'      => true
					),
				)
			)
		)
	)
));


/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('testimonials_form', array(
	'title' => __('Add Testimonial', 'fl-builder'),
	'tabs'  => array(
		'general'      => array( // Tab
			'title'         => __('General', 'fl-builder'), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array( // Section
					'title'         => '', // Section Title
					'fields'        => array( // Section Fields
						'testimonial'          => array(
							'type'          => 'editor',
							'label'         => ''
						)
					)
				)
			)
		)
	)
));