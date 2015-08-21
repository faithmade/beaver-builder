<?php

/**
 * @class FLSeparatorModule
 */
class FLSeparatorModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Separator', 'fl-builder'),
			'description'   => __('A divider line to separate content.', 'fl-builder'),
			'category'      => __('Basic Modules', 'fl-builder'),
			'editor_export' => false
		));
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLSeparatorModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'fl-builder'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'color'         => array(
						'type'          => 'color',
						'label'         => __('Color', 'fl-builder'),
						'default'       => 'cccccc',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-separator',
							'property'      => 'border-top-color'
						)
					),
					'opacity'    => array(
						'type'          => 'text',
						'label'         => __('Opacity', 'fl-builder'),
						'default'       => '100',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-separator',
							'property'      => 'opacity',
							'unit'          => '%'
						)
					),
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Height', 'fl-builder'),
						'default'       => '1',
						'maxlength'     => '2',
						'size'          => '3',
						'description'   => 'px',
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-separator',
							'property'      => 'border-top-width',
							'unit'          => 'px'
						)
					),
					'style'         => array(
						'type'          => 'select',
						'label'         => __('Style', 'fl-builder'),
						'default'       => 'solid',
						'options'       => array(
							'solid'         => _x( 'Solid', 'Border type.', 'fl-builder' ),
							'dashed'        => _x( 'Dashed', 'Border type.', 'fl-builder' ),
							'dotted'        => _x( 'Dotted', 'Border type.', 'fl-builder' ),
							'double'        => _x( 'Double', 'Border type.', 'fl-builder' )
						),
						'preview'       => array(
							'type'          => 'css',
							'selector'      => '.fl-separator',
							'property'      => 'border-top-style'
						),
						'help'          => __('The type of border to use. Double borders must have a height of at least 3px to render properly.', 'fl-builder'),
					)
				)
			)
		)
	)
));