(function($){

	FLBuilder.registerModuleHelper('contact-form', {

		rules: {
			mailto_email: {
				email: true,
				required: true
			}
		}
	});

})(jQuery);