(function($){
    /*---------------------------
		RECOMMENDATION POPUP
	---------------------------*/
    $('.open-recommendation-form').magnificPopup({
        type: 'inline',
        removalDelay: 300,
		mainClass: 'mfp-fade',
        closeMarkup: '<div class="close-btn mfp-close"><svg class="svg-plus"><use xlink:href="#svg-plus"></use></svg></div>'
    });
})(jQuery);