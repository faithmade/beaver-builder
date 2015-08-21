<?php

/**
 * A module that adds a simple subscribe form to your layout
 * with third party optin integration.
 *
 * @since 1.5.2
 */
class FLSubscribeFormModule extends FLBuilderModule {

	/** 
	 * @since 1.5.2
	 * @return void
	 */  
	public function __construct()
	{
		parent::__construct( array(
			'name'          => __( 'Subscribe Form', 'fl-builder' ),
			'description'   => __( 'Adds a simple subscribe form to your layout.', 'fl-builder' ),
			'category'      => __( 'Advanced Modules', 'fl-builder' ),
			'editor_export' => false
		));
		
		add_action( 'wp_ajax_fl_builder_subscribe_form_submit', array( $this, 'submit' ) );
		add_action( 'wp_ajax_nopriv_fl_builder_subscribe_form_submit', array( $this, 'submit' ) );
	}

	/** 
	 * Called via AJAX to submit the subscribe form. 
	 *
	 * @since 1.5.2
	 * @return string The JSON encoded response.
	 */  
	public function submit()
	{
		$name       = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : false;
		$email      = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : false;
		$node_id    = isset( $_POST['node_id'] ) ? sanitize_text_field( $_POST['node_id'] ) : false;
		$result     = array(
			'action'    => false,
			'error'     => false,
			'message'   => false,
			'url'       => false
		);
		
		if ( $email && $node_id ) {
			
			$module   = FLBuilderModel::get_module( $node_id );
			$settings = $module->settings;
			
			// Subscribe.
			$instance = FLBuilderServices::get_service_instance( $settings->service );
			$response = $instance->subscribe( $settings, $email, $name );
			
			// Check for an error from the service.
			if ( $response['error'] ) {
				$result['error'] = $response['error'];
			}
			// Setup the success data.
			else {
				
				$result['action'] = $settings->success_action;
				
				if ( 'message' == $settings->success_action ) {
					$result['message']  = $settings->success_message;
				}
				else {
					$result['url']  = $settings->success_url;
				}
			}
		}
		else {
			$result['error'] = __( 'There was an error subscribing. Please try again.', 'fl-builder' );
		}
		
		echo json_encode( $result );
		
		die();
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module( 'FLSubscribeFormModule', array(
	'general'       => array(
		'title'         => __( 'General', 'fl-builder' ),
		'sections'      => array(
			'service'       => array(
				'title'         => '',
				'file'          => FL_BUILDER_DIR . 'includes/service-settings.php',
				'services'      => 'autoresponder'
			),
			'structure'        => array(
				'title'         => __( 'Structure', 'fl-builder' ),
				'fields'        => array(
					'layout'        => array(
						'type'          => 'select',
						'label'         => __( 'Layout', 'fl-builder' ),
						'default'       => 'stacked',
						'options'       => array(
							'stacked'       => __( 'Stacked', 'fl-builder' ),
							'inline'        => __( 'Inline', 'fl-builder' ),
						)
					),
					'show_name'     => array(
						'type'          => 'select',
						'label'         => __( 'Name Field', 'fl-builder' ),
						'default'       => 'show',
						'options'       => array(
							'show'          => __( 'Show', 'fl-builder' ),
							'hide'          => __( 'Hide', 'fl-builder' ),
						)
					)
				)
			),
			'success'       => array(
				'title'         => __( 'Success', 'fl-builder' ),
				'fields'        => array(
					'success_action' => array(
						'type'          => 'select',
						'label'         => __( 'Success Action', 'fl-builder' ),
						'options'       => array(
							'message'       => __( 'Show Message', 'fl-builder' ),
							'redirect'      => __( 'Redirect', 'fl-builder' )
						),
						'toggle'        => array(
							'message'       => array(
								'fields'        => array( 'success_message' )
							),
							'redirect'      => array(
								'fields'        => array( 'success_url' )
							)
						),
						'preview'       => array(
							'type'             => 'none'  
						)
					),
					'success_message' => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false,
						'rows'          => 8,
						'default'       => __( 'Thanks for subscribing! Please check your email for further instructions.', 'fl-builder' ),
						'preview'       => array(
							'type'             => 'none'  
						)
					),
					'success_url'  => array(
						'type'          => 'link',
						'label'         => __( 'Success URL', 'fl-builder' ),
						'preview'       => array(
							'type'             => 'none'  
						)
					)
				)
			)
		)
	),
	'button'        => array(
		'title'         => __( 'Button', 'fl-builder' ),
		'sections'      => array(
			'btn_general'   => array(
				'title'         => '',
				'fields'        => array(
					'btn_text'      => array(
						'type'          => 'text',
						'label'         => __( 'Button Text', 'fl-builder' ),
						'default'       => __( 'Subscribe!', 'fl-builder' )
					),
					'btn_icon'      => array(
						'type'          => 'icon',
						'label'         => __( 'Button Icon', 'fl-builder' ),
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
			'btn_colors'     => array(
				'title'         => __( 'Button Colors', 'fl-builder' ),
				'fields'        => array(
					'btn_bg_color'  => array(
						'type'          => 'color',
						'label'         => __( 'Background Color', 'fl-builder' ),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __( 'Background Hover Color', 'fl-builder' ),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'btn_text_color' => array(
						'type'          => 'color',
						'label'         => __( 'Text Color', 'fl-builder' ),
						'default'       => '',
						'show_reset'    => true
					),
					'btn_text_hover_color' => array(
						'type'          => 'color',
						'label'         => __( 'Text Hover Color', 'fl-builder' ),
						'default'       => '',
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'btn_style'     => array(
				'title'         => __( 'Button Style', 'fl-builder' ),
				'fields'        => array(
					'btn_style'     => array(
						'type'          => 'select',
						'label'         => __( 'Style', 'fl-builder' ),
						'default'       => 'flat',
						'options'       => array(
							'flat'          => __( 'Flat', 'fl-builder' ),
							'gradient'      => __( 'Gradient', 'fl-builder' ),
							'transparent'   => __( 'Transparent', 'fl-builder' )
						),
						'toggle'        => array(
							'transparent'   => array(
								'fields'        => array( 'btn_bg_opacity', 'btn_border_size' )
							)
						)
					),
					'btn_border_size' => array(
						'type'          => 'text',
						'label'         => __( 'Border Size', 'fl-builder' ),
						'default'       => '2',
						'description'   => 'px',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					),
					'btn_bg_opacity' => array(
						'type'          => 'text',
						'label'         => __( 'Background Opacity', 'fl-builder' ),
						'default'       => '0',
						'description'   => '%',
						'maxlength'     => '3',
						'size'          => '5',
						'placeholder'   => '0'
					)
				)  
			),
			'btn_structure' => array(
				'title'         => __( 'Button Structure', 'fl-builder' ),
				'fields'        => array(
					'btn_font_size' => array(
						'type'          => 'text',
						'label'         => __( 'Font Size', 'fl-builder' ),
						'default'       => '14',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_padding'   => array(
						'type'          => 'text',
						'label'         => __( 'Padding', 'fl-builder' ),
						'default'       => '10',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'btn_border_radius' => array(
						'type'          => 'text',
						'label'         => __( 'Round Corners', 'fl-builder' ),
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