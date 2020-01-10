(function($){
	/*-----------------------
		DASHBOARD OPTIONS
	-----------------------*/
	var $db_options_handler = $('.db-options-button'),
		$closeIcon = $db_options_handler.children('img[alt="close-icon"]'),
		$optionsIcon = $db_options_handler.children('img[alt="db-list-right"]'),
		$header = $('.dashboard-header'),
		visibleHeight = $header.height(),
		totalHeight = getElementHeight($header);

	$db_options_handler.on('click', toggleDashboardOptions);

	function toggleDashboardOptions() {	
		if ($header.hasClass('retracted')) {
			// TODO: Remove this when page is going to production
			// This is here just for live preview responsive auto update
			$header = $('.dashboard-header'); // X Remove on production
			visibleHeight = $header.height(); // X Remove on production
			totalHeight = getElementHeight($header); // X Remove on production

			$header
				.removeClass('retracted')
				.addClass('unretracted')
				.css({
					'max-height': totalHeight + 'px'
				});
			$closeIcon.show();
			$optionsIcon.hide();
		} else {
			$header
				.removeClass('unretracted')
				.addClass('retracted')
				.css({
					'max-height': visibleHeight + 'px'
				});
			$closeIcon.hide();
			$optionsIcon.show();
		}
	}

	function getElementHeight($element) {
		// clone element to measure it
		var $clonedElement = $element.clone(),
			height = 0;

		$clonedElement.css({
			'max-height': '1000px',
			'position': 'absolute',
			'top': '-10000px',
			'left': '-10000px'
		})

		$clonedElement = $clonedElement.appendTo($('body'));
		height = $clonedElement.height();
		// remove cloned element from DOM
		$clonedElement.remove();

		return height;
	}

	/*-----------------
		PIE CHARTS
	-----------------*/
    $('.pie-chart1').xmpiechart({
		width: 20,
		height: 20,
		percent: 80,
		fillWidth: 2,
		color: "#00d7b3",
		speed: 2,
		outline: true,
        animateOnScroll: false
	});

    $('.pie-chart2').xmpiechart({
		width: 20,
		height: 20,
		percent: 40,
		fillWidth: 2,
		color: "#e61852",
		speed: 2,
		outline: true,
        animateOnScroll: false
	});

    $('.pie-chart3').xmpiechart({
		width: 20,
		height: 20,
		percent: 80,
		fillWidth: 2,
		color: "#00d7b3",
		speed: 2,
		outline: true,
        animateOnScroll: false
	});
})(jQuery);