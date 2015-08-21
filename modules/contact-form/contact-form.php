<?php

/**
 * @class FLHtmlModule
 */
class FLContactFormModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'           => __('Contact Form', 'fl-builder'),
			'description'    => __('A very simple contact form.', 'fl-builder'),
			'category'       => __('Advanced Modules', 'fl-builder'),
			'editor_export'  => false
		));

		add_action('wp_ajax_fl_builder_email', array($this, 'send_mail'));
		add_action('wp_ajax_nopriv_fl_builder_email', array($this, 'send_mail'));
	}

	/**
	 * @method send_mail
	 */
	static public function send_mail($params = array()) {

		// Get the contact form post data

		$subject = (isset($_POST['subject']) ? $_POST['subject'] : __('Contact Form Submission', 'fl-builder'));
		$mailto = (isset($_POST['mailto']) ? $_POST['mailto'] : null);

		// Build the email
		$template = "";

		if (isset($_POST['name']))  $template .= "Name: $_POST[name] \r\n";
		if (isset($_POST['email'])) $template .= "Email: $_POST[email] \r\n";
		if (isset($_POST['phone'])) $template .= "Phone: $_POST[phone] \r\n";

		$template .= __('Message', 'fl-builder') . ": \r\n" . $_POST['message'];

		// Double check the mailto email is proper and send
		if ($mailto && filter_var($mailto, FILTER_VALIDATE_EMAIL)) {
			wp_mail($mailto, $subject, $template);
			die('1');
		} else {
			die($mailto);
		}
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLContactFormModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'mailto_email'     => array(
						'type'          => 'text',
						'label'         => __('Send To Email', 'fl-builder'),
						'default'       => '',
						'placeholder'   => __('example@mail.com', 'fl-builder'),
						'help'          => __('The contact form will send to this e-mail', 'fl-builder'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'name_toggle'   => array(
						'type'          => 'select',
						'label'         => __('Name Field', 'fl-builder'),
						'default'       => 'show',
						'options'       => array(
							'show'      => __('Show', 'fl-builder'),
							'hide'      => __('Hide', 'fl-builder'),
						)
					),
					'subject_toggle'   => array(
						'type'          => 'select',
						'label'         => __('Subject Field', 'fl-builder'),
						'default'       => 'hide',
						'options'       => array(
							'show'      => __('Show', 'fl-builder'),
							'hide'      => __('Hide', 'fl-builder'),
						)
					),
					'email_toggle'   => array(
						'type'          => 'select',
						'label'         => __('Email Field', 'fl-builder'),
						'default'       => 'show',
						'options'       => array(
							'show'      => __('Show', 'fl-builder'),
							'hide'      => __('Hide', 'fl-builder'),
						)
					),
					'phone_toggle'   => array(
						'type'          => 'select',
						'label'         => __('Phone Field', 'fl-builder'),
						'default'       => 'hide',
						'options'       => array(
							'show'      => __('Show', 'fl-builder'),
							'hide'      => __('Hide', 'fl-builder'),
						)
					),
				)
			)
		)
	)
));
