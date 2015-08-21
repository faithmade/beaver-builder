(function($){

	FLBuilder.registerModuleHelper('gallery', {
		
		rules: {
			photo_spacing: {
				number: true,
				required: true
			}
		},
		
		init: function()
		{
			var form    = $('.fl-builder-settings'),
				source  = form.find('select[name=source]');
			
			source.on('change', this._sourceChanged);
			this._sourceChanged();
		},
		
		_sourceChanged: function()
		{
			var form    = $('.fl-builder-settings'),
				photos  = form.find('input[name=photos]'),
				feedUrl = form.find('input[name=feed_url]'),
				source  = form.find('select[name=source]').val();
				
			photos.rules('remove');
			feedUrl.rules('remove');
			
			if(source == 'wordpress') {
				photos.rules('add', {
					required: true
				});
			}
			else if(source == 'smugmug') {
				feedUrl.rules('add', {
					required: true,
					url: true
				});
			}
		}
	});

})(jQuery);