<form class="fl-contact-form">

	<?php if ($settings->name_toggle == 'show') : ?>
	<div class="fl-input-group fl-name">
		<label for="fl-name"><?php _ex( 'Name', 'Contact form field label.', 'fl-builder' );?></label>
		<span class="fl-contact-error"><?php _e('Please enter your name.', 'fl-builder');?></span>
		<input type="text" name="fl-name" value="" placeholder="<?php esc_attr_e( 'Your name', 'fl-builder' ); ?>" />
	</div>
	<?php endif; ?>

	<?php if ($settings->subject_toggle == 'show') : ?>
	<div class="fl-input-group fl-subject">
		<label for="fl-subject"><?php _e('Subject', 'fl-builder');?></label>
		<span class="fl-contact-error"><?php _e('Please enter a subject.', 'fl-builder');?></span>
		<input type="text" name="fl-subject" value="" placeholder="<?php esc_attr_e( 'Subject', 'fl-builder' ); ?>" />
	</div>
	<?php endif; ?>

	<?php if ($settings->email_toggle == 'show') : ?>
	<div class="fl-input-group fl-email">
		<label for="fl-email"><?php _e('Email', 'fl-builder');?></label>
		<span class="fl-contact-error"><?php _e('Please enter a valid email.', 'fl-builder');?></span>
		<input type="email" name="fl-email" value="" placeholder="<?php esc_attr_e( 'Your email', 'fl-builder' ); ?>" />
	</div>
	<?php endif; ?>

	<?php if ($settings->phone_toggle == 'show') : ?>
	<div class="fl-input-group fl-phone">
		<label for="fl-phone"><?php _e('Phone', 'fl-builder');?></label>
		<span class="fl-contact-error"><?php _e('Please enter a valid phone number.', 'fl-builder');?></span>
		<input type="tel" name="fl-phone" value="" placeholder="<?php esc_attr_e( 'Your phone', 'fl-builder' ); ?>" />
	</div>
	<?php endif; ?>

	<div class="fl-input-group fl-message">
		<label for="fl-message"><?php _e('Your Message', 'fl-builder');?></label>
		<span class="fl-contact-error"><?php _e('Please enter a message.', 'fl-builder');?></span>
		<textarea name="fl-message" placeholder="<?php esc_attr_e( 'Your message', 'fl-builder' ); ?>"></textarea>
	</div>

	<input type="text" value="<?php echo $settings->mailto_email; ?>" style="display: none;" class="fl-mailto">

	<input type="submit" value="<?php esc_attr_e( 'Send', 'fl-builder' ); ?>" class="fl-contact-form-submit" />
	<span class="fl-success" style="display:none;"><?php _e( 'Message Sent!', 'fl-builder' ); ?></span>
	<span class="fl-send-error" style="display:none;"><?php _e( 'Message failed. Please try again.', 'fl-builder' ); ?></span>
</form>
