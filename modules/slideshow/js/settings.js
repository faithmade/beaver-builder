(function($){

	FLBuilder.registerModuleHelper('slideshow', {
		
		rules: {
			height: {
				number: true,
				required: true
			},
			speed: {
				number: true,
				required: true
			},
			transitionDuration: {
				number: true,
				required: true
			}
		},
		
		init: function()
		{
			var form    = $('.fl-builder-settings'),
				source  = form.find('select[name=source]'),
				navType = form.find('select[name=nav_type]');
			
			// Init validation events.
			this._sourceChanged();
			this._navTypeChanged();
			
			// Validation events.
			source.on('change', this._sourceChanged);
			navType.on('change', this._navTypeChanged);
		},
		
		_sourceChanged: function()
		{
			var form    = $('.fl-builder-settings'),
				source  = form.find('select[name=source]').val(),
				photos  = form.find('input[name=photos]'),
				feedUrl = form.find('input[name=feed_url]');
				
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
		},
		
		_navTypeChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				thumbsSize  = form.find('input[name=thumbs_size]'),
				navType     = form.find('select[name=nav_type]').val();
				
			thumbsSize.rules('remove');
			
			if(navType != 'none') {
				thumbsSize.rules('add', {
					number: true,
					required: true
				});
			}
		}
	});

})(jQuery);