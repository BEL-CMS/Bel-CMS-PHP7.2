(function($) {
	'use strict';

	$(document).ready(function($) {
		// Preloader
		setTimeout(function () {
			$('.preloader').fadeOut();
		}, 2000);

		// Back-to-top button
		$(window).on('scroll', function () {
            if ($(this).scrollTop() > 400) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }

            return false;
        });
		$('.back-to-top').on('click', function(e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: 0
			}, 700);
		});
	});
})(jQuery);
