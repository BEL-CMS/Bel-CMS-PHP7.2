(function($){
	$('.accordion').xmaccordion({
		startOn: 2,
		speed: 500
	});

	$('.pie-chart1').xmpiechart({
		width: 176,
		height: 176,
		percent: 24,
		fillWidth: 8,
		gradient: true,
		gradientColors: ['#ff6589', '#f92552'],
		speed: 2,
		outline: true,
		linkPercent: '.percent'
	});

	$('.img-gallery').on('click', function(){
		$('.gallery-items').magnificPopup('open');
	});

	$('.gallery-items').magnificPopup({
		delegate: 'span',
		type: 'image',
		removalDelay: 300,
		mainClass: 'mfp-fade',
		gallery: {
			enabled: true,
			arrowMarkup: '<div class="slide-control %dir% mfp-arrow-%dir%"><svg class="svg-arrow"><use xlink:href="#svg-arrow"></use></svg></div>'
		}
	});

	/*-----------------
		COUNTDOWN
	-----------------*/	
	$('.bid-countdown').xmcountdown({
		width: 50,
		height: 50,
		fillWidth: 4,
		gradient: true,
		gradientColors: ['#f21c5e','#00dcdd'],
		targetDate: new Date(2017, 4, 1),
		daysText: "Days",
		hoursText: "Hours",
		minutesText: "Mins",
		secondsText: "Secs",
		outline: true
	});

})(jQuery);