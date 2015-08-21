<?php

/**
 * @class FLMapModule
 */
class FLMapModule extends FLBuilderModule {

	/** 
	 * @method __construct
	 */  
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Map', 'fl-builder'),
			'description'   => __('Display a Google map.', 'fl-builder'),
			'category'      => __('Advanced Modules', 'fl-builder')
		));
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLMapModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'address'       => array(
						'type'          => 'text',
						'label'         => __('Address', 'fl-builder'),
						'placeholder'   => __('1865 Winchester Blvd #202 Campbell, CA 95008', 'fl-builder'),
						'preview'         => array(
							'type'            => 'refresh'
						)
					),
					'height'        => array(
						'type'          => 'text',
						'label'         => __('Height', 'fl-builder'),
						'default'       => '400',
						'size'          => '5',
						'description'   => 'px'
					)
				)
			)
		)
	)
));