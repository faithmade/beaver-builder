(function($){

	FLBuilder.registerModuleHelper('button', {

		rules: {
			text: {
				required: true
			},
			link: {
				required: true
			},
			border_size: {
				required: true,
				number: true
			},
			bg_opacity: {
				required: true,
				number: true
			},
			font_size: {
				required: true,
				number: true
			},
			padding: {
				required: true,
				number: true
			},
			border_radius: {
				required: true,
				number: true
			}
		}
	});

})(jQuery);