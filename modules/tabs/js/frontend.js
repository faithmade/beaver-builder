(function($) {

	var FLTabs = {
		
		init: function()
		{
			$('.fl-tabs-labels .fl-tabs-label').click(FLTabs._labelClick);
			$('.fl-tabs-panels .fl-tabs-label').click(FLTabs._responsiveLabelClick);
			
			if($('.fl-tabs-vertical').length > 0) {
				FLTabs._resize();
				$(window).resize(FLTabs._resize);
			}
		},
		
		_labelClick: function()
		{
			var label       = $(this),
				index       = label.data('index'),
				wrap        = label.closest('.fl-tabs'),
				allIcons    = wrap.find('.fl-tabs-label .fa'),
				icon        = wrap.find('.fl-tabs-label[data-index="' + index + '"] .fa');
			
			// Toggle the responsive icons.
			allIcons.addClass('fa-plus');
			icon.removeClass('fa-plus');
			
			// Toggle the tabs.
			wrap.find('.fl-tab-active').removeClass('fl-tab-active');
			wrap.find('.fl-tabs-label[data-index="' + index + '"]').addClass('fl-tab-active');
			wrap.find('.fl-tabs-panel-content[data-index="' + index + '"]').addClass('fl-tab-active');
			wrap.find('.fl-tabs-panel-content').css('display', '');
		},
		
		_responsiveLabelClick: function()
		{
			var label           = $(this),
				wrap            = label.closest('.fl-tabs'),
				index           = label.data('index'),
				content         = label.siblings('.fl-tabs-panel-content'),
				activeContent   = wrap.find('.fl-tabs-panel-content.fl-tab-active'),
				activeIndex     = activeContent.data('index'),
				allIcons        = wrap.find('.fl-tabs-label .fa'),
				icon            = label.find('.fa');
			
			// Should we proceed?
			if(index == activeIndex) {
				return;
			}
			if(wrap.hasClass('fl-tabs-animation')) {
				return;
			}
			
			// Toggle the icons.
			allIcons.addClass('fa-plus');
			icon.removeClass('fa-plus');
			
			// Run the animations.
			wrap.addClass('fl-tabs-animation');
			activeContent.slideUp('normal');
			
			content.slideDown('normal', function(){
				
				wrap.find('.fl-tab-active').removeClass('fl-tab-active');
				wrap.find('.fl-tabs-label[data-index="' + index + '"]').addClass('fl-tab-active');
				content.addClass('fl-tab-active');
				wrap.removeClass('fl-tabs-animation');
				
				if(label.offset().top < $(window).scrollTop() + 100) {
					$('html, body').animate({ scrollTop: label.offset().top - 100 }, 500, 'swing');
				}
			});
		},
		
		_resize: function()
		{
			$('.fl-tabs-vertical').each(FLTabs._resizeVertical);
		},
		
		_resizeVertical: function()
		{
			var wrap    = $(this),
				labels  = wrap.find('.fl-tabs-labels'),
				panels  = wrap.find('.fl-tabs-panels');
				
			panels.css('min-height', labels.height() + 'px');
		}
	};
	
	$(function(){ FLTabs.init(); });
	
})(jQuery);