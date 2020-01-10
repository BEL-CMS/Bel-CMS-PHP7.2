(function($) {
	/*-----------------
		TWEETS
	-----------------*/	
	$('.tweets').tweet({
	    modpath: 'js/vendor/twitter/',
	    count: 2,
	    loading_text: 'Loading twitter feed...',
		username:'odindesign_tw',
		template: '<p class="feed-text">{text}</p><p class="feed-timestamp">{time}</p>'
	});
})(jQuery);