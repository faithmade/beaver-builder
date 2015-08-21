(function($){

	FLBuilder.registerModuleHelper('social-buttons', {

		rules: {
			custom_url: {
				required: true,
				url: true
			},
		},

		init: function()
		{
			var form    = $('.fl-builder-settings'),
				type    = form.find('select[name=url_type]');
			
			// Init validation events.
			this._typeChanged();
			
			// Validation events.
			type.on('change', this._typeChanged);
		},
		
		_typeChanged: function()
		{
			var form         = $('.fl-builder-settings'),
				type         = form.find('select[name=url_type]').val(),
				custom_url   = form.find('input[name=custom_url]');

			custom_url.rules('remove');
			
			if(type == 'custom') {
				custom_url.rules('add', {
					required: true,
					url: true
				});
			}
		}
	});

})(jQuery);