(function($){

	FLBuilder.registerModuleHelper('map', {

		rules: {
			address: {
				required: true
			},
			height: {
				required: true,
				number: true
			}
		},
		
		init: function()
		{
			var form   = $('.fl-builder-settings'),
				height = form.find('input[name=height]');
			
			height.on('keyup', this._previewHeight);
		},
		
		_previewHeight: function()
		{
			var form   = $('.fl-builder-settings'),
				height = form.find('input[name=height]').val(),
				iframe = $(FLBuilder.preview.classes.node + ' iframe');
			
			if(!isNaN(height)) {
				iframe.attr('height', height + 'px');
			}
		}
	});

})(jQuery);