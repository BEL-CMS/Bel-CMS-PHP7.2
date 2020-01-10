(function($){
    /*---------------------
		STARRED TOGGLE
	---------------------*/
    var $starred = $('.starred');

    $starred.on('click', toggleStarred);

    function toggleStarred() {
        var $this = $(this);

        $this
            .children('img[alt^="star"]')
            .each(function(){
                var $star = $(this);

                $star
                    .toggleClass('visible')
                    .toggleClass('hidden')
            });
    }

    /*-----------------------
		NEW MESSAGE POPUP
	-----------------------*/
    $('.open-new-message').magnificPopup({
        type: 'inline',
        removalDelay: 300,
		mainClass: 'mfp-fade',
        closeMarkup: '<div class="close-btn mfp-close"><svg class="svg-plus"><use xlink:href="#svg-plus"></use></svg></div>'
    });
})(jQuery);