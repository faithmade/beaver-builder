( function( $ ) {

	FLBuilder.registerModuleHelper( 'subscribe-form', {

		rules: {
			btn_text: {
				required: true
			},
			btn_font_size: {
				required: true,
				number: true
			},
			btn_padding: {
				required: true,
				number: true
			},
			btn_border_radius: {
				required: true,
				number: true
			},
			service: {
				required: true
			}
		},
		
		init: function()
		{
			var form      = $( '.fl-builder-settings' ),
				action    = form.find( 'select[name=success_action]' );
				
			this._actionChanged();
			
			action.on( 'change', this._actionChanged );
		},
		
		submit: function()
		{
			var form    = $( '.fl-builder-settings' ),
				service = form.find( '.fl-builder-service-select' ),
				account = form.find( '.fl-builder-service-account-select' ),
				list    = form.find( '.fl-builder-service-list-select' );
				
			if ( 0 === account.length ) {
				FLBuilder.alert( FLBuilderStrings.subscriptionModuleConnectError );
				return false;
			}
			else if ( '' == account.val() || 'add_new_account' == account.val() ) {
				FLBuilder.alert( FLBuilderStrings.subscriptionModuleAccountError );
				return false;
			}
			else if ( ( 0 === list.length || '' == list.val() ) && 'email-address' != service.val() ) {
				FLBuilder.alert( FLBuilderStrings.subscriptionModuleListError );
				return false;
			}
			
			return true;
		},
		
		_actionChanged: function()
		{
			var form      = $( '.fl-builder-settings' ),
				action    = form.find( 'select[name=success_action]' ).val(),
				url       = form.find( 'input[name=success_url]' );
				
			url.rules('remove');
				
			if ( 'redirect' == action ) {
				url.rules( 'add', { required: true } );
			}
		}
	});

})(jQuery);