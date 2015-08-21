(function($){

	FLBuilder.registerModuleHelper('testimonials', {

		rules: {
			'testimonials[]': {
				required: true
			},
			pause: {
				number: true,
				required: true
			},
			speed: {
				number: true,
				required: true
			}
		}
	});

})(jQuery);