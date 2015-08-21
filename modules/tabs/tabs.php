<?php

/**
 * @class FLTabsModule
 */
class FLTabsModule extends FLBuilderModule {

	/** 
	 * @method __construct
	 */  
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Tabs', 'fl-builder'),
			'description'   => __('Display a collection of tabbed content.', 'fl-builder'),
			'category'      => __('Advanced Modules', 'fl-builder')
		));
		
		$this->add_css('font-awesome');
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLTabsModule', array(
	'items'         => array(
		'title'         => __('Items', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'items'         => array(
						'type'          => 'form',
						'label'         => __('Item', 'fl-builder'),
						'form'          => 'items_form', // ID from registered form below
						'preview_text'  => 'label', // Name of a field to use for the preview text
						'multiple'      => true
					),
				)
			)
		)
	),
	'style'        => array(
		'title'         => __('Style', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(                              
					'layout'        => array(
						'type'          => 'select',
						'label'         => __('Layout', 'fl-builder'),
						'default'       => 'horizontal',
						'options'       => array(
							'horizontal'    => __('Horizontal', 'fl-builder'),
							'vertical'      => __('Vertical', 'fl-builder'),
						)
					),                             
					'border_color'  => array(
						'type'          => 'color',
						'label'         => __('Border Color', 'fl-builder'),
						'default'       => 'e5e5e5'
					),    
				)
			)
		)
	)
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('items_form', array(
	'title' => __('Add Item', 'fl-builder'),
	'tabs'  => array(
		'general'      => array(
			'title'         => __('General', 'fl-builder'),
			'sections'      => array(
				'general'       => array(
					'title'         => '',
					'fields'        => array(       
						'label'         => array(
							'type'          => 'text',
							'label'         => __('Label', 'fl-builder')
						)
					)
				),
				'content'       => array(
					'title'         => __('Content', 'fl-builder'),
					'fields'        => array( 
						'content'       => array(
							'type'          => 'editor',
							'label'         => ''
						)
					)
				)
			)
		)
	)
));