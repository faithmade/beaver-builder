( function ( $ ) {
	
	var FLSubscribeForm = {
		
		init: function()
		{
			$( '.fl-subscribe-form' ).each( FLSubscribeForm._initForm );
		},
		
		_initForm: function()
		{
			var form    = $( this ),
				button  = form.find( 'a.fl-button' );
				
			button.on( 'click', FLSubscribeForm._submitButtonClicked );
		},
		
		_submitButtonClicked: function( e )
		{
			var form = $( this ).closest( '.fl-subscribe-form' );
			
			e.preventDefault();
			
			FLSubscribeForm._submitForm( form );
		},
		
		_submitForm: function( form )
		{
			var postId      = form.closest( '.fl-builder-content' ).data( 'post-id' ),
				nodeId      = form.closest( '.fl-module' ).data( 'node' ),
				button      = form.find( '.fl-form-button' ),
				buttonText  = button.find( '.fl-button-text' ).text(),
				waitText    = button.data( 'wait-text' ),
				name        = form.find( 'input[name=fl-subscribe-form-name]' ),
				email       = form.find( 'input[name=fl-subscribe-form-email]' ),
				re          = /\S+@\S+\.\S+/,
				valid       = true;
			
			if ( button.hasClass( 'fl-form-button-disabled' ) ) {
				return; // Already submitting
			}
			if ( name.length > 0 && name.val() == '' ) {
				name.addClass( 'fl-form-error' );
				name.siblings( '.fl-form-error-message' ).show();
				valid = false;
			}
			if ( '' == email.val() || ! re.test( email.val() ) ) {
				email.addClass( 'fl-form-error' );
				email.siblings( '.fl-form-error-message' ).show();
				valid = false;
			}
			
			if ( valid ) {
				
				form.find( '> .fl-form-error-message' ).hide();
				button.find( '.fl-button-text' ).text( waitText );
				button.data( 'original-text', buttonText );
				button.addClass( 'fl-form-button-disabled' );
				
				$.post( wpAjaxUrl, {
					action  : 'fl_builder_subscribe_form_submit',
					name    : name.val(),
					email   : email.val(),
					post_id : postId,
					node_id : nodeId
				}, function( response ) {
					FLSubscribeForm._submitFormComplete( form, response );
				});
			}
		},
		
		_submitFormComplete: function( form, response )
		{
			var data        = JSON.parse( response ),
				button      = form.find( '.fl-form-button' ),
				buttonText  = button.data( 'original-text' );
				
			if ( data.error ) {
				
				if ( data.error ) {
					form.find( '> .fl-form-error-message' ).text( data.error );
				}
				
				form.find( '> .fl-form-error-message' ).show();
				button.removeClass( 'fl-form-button-disabled' );
				button.find( '.fl-button-text' ).text( buttonText );
			}
			else if ( 'message' == data.action ) {
				form.find( '> *' ).hide();
				form.append( '<div class="fl-form-success-message">' + data.message + '</div>' );
			}
			else if ( 'redirect' == data.action ) {
				window.location.href = data.url;
			}
		}
	};
	
	$( FLSubscribeForm.init );
	
})( jQuery );