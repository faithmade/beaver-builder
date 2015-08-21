<?php

/**
 * @class FLRichTextModule
 */
class FLPricingTableModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Pricing Table', 'fl-builder'),
			'description'   => __('A simple pricing table generator.', 'fl-builder'),
			'category'      => __('Advanced Modules', 'fl-builder')
		));
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLPricingTableModule', array(
	'columns'      => array(
		'title'         => __('Pricing Boxes', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'pricing_columns'     => array(
						'type'         => 'form',
						'label'        => __('Pricing Box', 'fl-builder'),
						'form'         => 'pricing_column_form',
						'preview_text' => 'title',
						'multiple'     => true
					),
				)
			)
		)
	),
	'style'       => array(
		'title'         => __('Style', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'spacing'   => array(
						'type'          => 'select',
						'label'         => __('Box Spacing', 'fl-builder'),
						'default'       => 'wide',
						'options'       => array(
							'wide'      => __('Wide', 'fl-builder'),
							'tight'      => __('Tight', 'fl-builder')
						)
					),
					'min_height'   => array(
						'type'          => 'text',
						'label'         => __('Features Min Height', 'fl-builder'),
						'default'       => '0',
						'size'          => '5',
						'description'   => 'px',
						'help'          => __('Use this to normalize the height of your boxes when they have different numbers of features.', 'fl-builder')
					),
					'border_size'   => array(
						'type'          => 'select',
						'label'         => __('Border Size', 'fl-builder'),
						'default'       => 'wide',
						'options'       => array(
							'wide'      => _x( 'Wide', 'Border size.', 'fl-builder' ),
							'tight'      => _x( 'Tight', 'Border size.', 'fl-builder' )
						)
					)
				)
			)
		)
	)
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('pricing_column_form', array(
	'title' => __( 'Add Pricing Box', 'fl-builder' ),
	'tabs'  => array(
		'general'      => array(
			'title'         => __('General', 'fl-builder'),
			'sections'      => array(
				'title'       => array(
					'title'         => __( 'Title', 'fl-builder' ),
					'fields'        => array(
						'title'          => array(
							'type'          => 'text',
							'label'         => __('Title', 'fl-builder'),
						),
						'title_size'        => array(
							'type'          => 'text',
							'label'         => __('Title Size', 'fl-builder'),
							'default'       => '24',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						),
					),
				),
				'price-box'       => array(
					'title'         => __( 'Price Box', 'fl-builder' ),
					'fields'        => array(
						'price'          => array(
							'type'          => 'text',
							'label'         => __('Price', 'fl-builder'),
						),
						'duration'          => array(
							'type'          => 'text',
							'label'         => __('Duration', 'fl-builder'),
							'placeholder'   => __( 'per Year', 'fl-builder' )
						),
						'price_size'        => array(
							'type'          => 'text',
							'label'         => __('Price Size', 'fl-builder'),
							'default'       => '31',
							'maxlength'     => '3',
							'size'          => '4',
							'description'   => 'px'
						)
					)
				),
				'button'       => array(
					'title'         => __( 'Button', 'fl-builder' ),
					'fields'        => array(
						'button_text'          => array(
							'type'          => 'text',
							'label'         => __('Button Text', 'fl-builder')
						),
						'button_url'          => array(
							'type'          => 'link',
							'label'         => __('Button URL', 'fl-builder')
						)
					)
				),
				'features'       => array(
					'title'         => _x( 'Features', 'Price features displayed in pricing box.', 'fl-builder' ),
					'fields'        => array(
						'features'          => array(
							'type'          => 'text',
							'label'         => '',
							'placeholder'   => __( 'One feature per line. HTML is okay.', 'fl-builder' ),
							'multiple'      => true
						)
					)
				)
			)
		),
		'style'      => array(
			'title'         => __('Style', 'fl-builder'),
			'sections'      => array(
				'style'       => array(
					'title'         => 'Style',
					'fields'        => array(
						'background'          => array(
							'type'          => 'color',
							'label'         => __('Box Background', 'fl-builder'),
							'default'       => 'F2F2F2'
						),
						'foreground'          => array(
							'type'          => 'color',
							'label'         => __('Box Foreground', 'fl-builder'),
							'default'       => 'ffffff'
						),
						'column_background'  => array(
							'type'          => 'color',
							'default'       => '66686b',
							'label'         => __('Accent Color', 'fl-builder'),
						),
						'column_color'          => array(
							'type'          => 'color',
							'default'       => 'ffffff',
							'label'         => __('Accent Text Color', 'fl-builder')
						),
						'margin'        => array(
							'type'          => 'text',
							'label'         => __('Box Top Margin', 'fl-builder'),
							'default'       => '0',
							'maxlength'     => '3',
							'size'          => '3',
							'description'   => 'px'
						)
					)
				)
			)
		)
	)
));

