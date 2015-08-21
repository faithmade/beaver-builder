<?php

/**
 * @class FLIconGroupModule
 */
class FLIconGroupModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Icon Group', 'fl-builder'),
			'description'   => __('Display a group of linked Font Awesome icons.', 'fl-builder'),
			'category'      => __('Advanced Modules', 'fl-builder'),
			'editor_export' => false
		));
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLIconGroupModule', array(
	'icons'         => array(
		'title'         => __('Icons', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'icons'         => array(
						'type'          => 'form',
						'label'         => __('Icon', 'fl-builder'),
						'form'          => 'icon_group_form', // ID from registered form below
						'preview_text'  => 'icon', // Name of a field to use for the preview text
						'multiple'      => true
					)
				)
			)
		)
	),
	'style'         => array( // Tab
		'title'         => __('Style', 'fl-builder'), // Tab title
		'sections'      => array( // Tab Sections
			'colors'        => array( // Section
				'title'         => __('Colors', 'fl-builder'), // Section Title
				'fields'        => array( // Section Fields
					'color'         => array(
						'type'          => 'color',
						'label'         => __('Color', 'fl-builder'),
						'show_reset'    => true
					),
					'hover_color' => array(
						'type'          => 'color',
						'label'         => __('Hover Color', 'fl-builder'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'bg_color'      => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'fl-builder'),
						'show_reset'    => true
					),
					'bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'fl-builder'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'three_d'       => array(
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
			'structure'     => array( // Section
				'title'         => __('Structure', 'fl-builder'), // Section Title
				'fields'        => array( // Section Fields
					'size'          => array(
						'type'          => 'text',
						'label'         => __('Size', 'fl-builder'),
						'default'       => '30',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'spacing'       => array(
						'type'          => 'text',
						'label'         => __('Spacing', 'fl-builder'),
						'default'       => '10',
						'maxlength'     => '2',
						'size'          => '4',
						'description'   => 'px'
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'fl-builder'),
						'default'       => 'center',
						'options'       => array(
							'center'        => __('Center', 'fl-builder'),
							'left'          => __('Left', 'fl-builder'),
							'right'         => __('Right', 'fl-builder')
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
FLBuilder::register_settings_form('icon_group_form', array(
	'title' => __('Add Icon', 'fl-builder'),
	'tabs'  => array(
		'general'       => array( // Tab
			'title'         => __('General', 'fl-builder'), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array( // Section
					'title'         => '', // Section Title
					'fields'        => array( // Section Fields
						'icon'          => array(
							'type'          => 'icon',
							'label'         => __('Icon', 'fl-builder')
						),
						'link'          => array(
							'type'          => 'link',
							'label'         => __('Link', 'fl-builder')
						)
					)
				)
			)
		)
	)
));