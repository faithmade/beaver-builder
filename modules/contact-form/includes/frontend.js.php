(function($) {

	$(function() {

	  var theForm	  = $('.fl-node-<?php echo $id; ?> .fl-contact-form'),
		  submit	  = $('.fl-node-<?php echo $id; ?> .fl-contact-form-submit'),
		  name		  = $('.fl-node-<?php echo $id; ?> .fl-name input'),
		  email		  = $('.fl-node-<?php echo $id; ?> .fl-email input'),
		  phone		  = $('.fl-node-<?php echo $id; ?> .fl-phone input'),
		  subject	  = $('.fl-node-<?php echo $id; ?> .fl-subject input'),
		  message	  = $('.fl-node-<?php echo $id; ?> .fl-message textarea'),
		  mailto	  = $('.fl-node-<?php echo $id; ?> .fl-mailto input'),
		  ajaxurl	  = wpAjaxUrl,
		  email_regex = /\S+@\S+\.\S+/,
		  isValid	  = true;

	  submit.click(function(e) {
		e.preventDefault();

		// End if button is disabled (sent already)
		if ($(this).hasClass('fl-disabled')) {
		  return;
		}

		// reset this each time the button is clicked
		isValid = true;

		// "validate" the name
		if(name.length) {
		  if (name.val() === '') {
			isValid = false;
			name.parent().addClass('fl-error');
		  } else if (name.parent().hasClass('fl-error')) {
			name.parent().removeClass('fl-error');
		  }
		}

		// validate the email
		if(email.length) {
		  if (email.val() === '' || !email_regex.test(email.val())) {
			isValid = false;
			email.parent().addClass('fl-error');
		  } else if (email.parent().hasClass('fl-error')) {
			email.parent().removeClass('fl-error');
		  }
		}

		// "validate" the subject..just make sure it's there
		if(subject.length) {
		  if (subject.val() === '') {
			isValid = false;
			subject.parent().addClass('fl-error');
		  } else if (subject.parent().hasClass('fl-error')) {
			subject.parent().removeClass('fl-error');
		  }
		}

		// validate the phone..just make sure it's there
		if(phone.length) {
		  if (phone.val() === '') {
			isValid = false;
			phone.parent().addClass('fl-error');
		  } else if (phone.parent().hasClass('fl-error')) {
			phone.parent().removeClass('fl-error');
		  }
		}

		// "validate" the message..just make sure it's there
		if (message.val() === '') {
		  isValid = false;
		  message.parent().addClass('fl-error');
		} else if (message.parent().hasClass('fl-error')) {
		  message.parent().removeClass('fl-error');
		}

		// end if we're invalid, otherwise go on..
		if (!isValid) {
		  return false;
		} else {

		  // disable send button
		  submit.addClass('fl-disabled');

		  // post the form data
		  $.post(ajaxurl, {
			action: 'fl_builder_email',
			name: $('.fl-node-<?php echo $id; ?> .fl-name input').val(),
			subject: $('.fl-node-<?php echo $id; ?> .fl-subject input').val(),
			email: $('.fl-node-<?php echo $id; ?> .fl-email input').val(),
			phone: $('.fl-node-<?php echo $id; ?> .fl-phone input').val(),
			mailto: $('.fl-node-<?php echo $id; ?> .fl-mailto').val(),
			message: $('.fl-node-<?php echo $id; ?> .fl-message textarea').val()
		  }, function (response) {

			// On success show the success message
			if (response === '1') {
			  $('.fl-node-<?php echo $id; ?> .fl-send-error').fadeOut();
			  $('.fl-node-<?php echo $id; ?> .fl-success').fadeIn();

			// On failure show fail message and re-enable the send button
			} else {
			  submit.removeClass('fl-disabled');
			  $('.fl-node-<?php echo $id; ?> .fl-send-error').fadeIn();
			  return false;
			}

		  });
		}

	  });
	});

})(jQuery);
