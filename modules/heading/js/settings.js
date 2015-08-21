(function($){

	FLBuilder.registerModuleHelper('heading', {

		rules: {
			heading: {
				required: true
			}
		},
		
		init: function()
		{
			var form = $('.fl-builder-settings');
			
			// Init validation events.
			this._fontSizeChanged();
			this._mobileFontSizeChanged();
			
			// Validation events.
			form.find('select[name=font_size]').on('change', this._fontSizeChanged);
			form.find('select[name=r_font_size]').on('change', this._mobileFontSizeChanged);
		},
		
		_fontSizeChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				fontSize    = form.find('select[name=font_size]').val(),
				customSize  = form.find('input[name=custom_font_size]');
				
			customSize.rules('remove');
			
			if(fontSize == 'custom') {
				customSize.rules('add', { 
					number: true,
					required: true 
				});
			}
		},
		
		_mobileFontSizeChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				fontSize    = form.find('select[name=r_font_size]').val(),
				customSize  = form.find('input[name=r_custom_font_size]');
				
			customSize.rules('remove');
			
			if(fontSize == 'custom') {
				customSize.rules('add', { 
					number: true,
					required: true 
				});
			}
		}
	});

})(jQuery);