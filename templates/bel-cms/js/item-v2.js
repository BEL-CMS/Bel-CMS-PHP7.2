(function($){
	$('.accordion').xmaccordion({
		startOn: 2,
		speed: 500
	});

	$('.pie-chart1').xmpiechart({
		width: 44,
		height: 44,
		percent: 24,
		fillWidth: 4,
		gradient: true,
		gradientColors: ['#ff6589', '#f92552'],
		speed: 2,
		outline: true,
		linkPercent: '.percent'
	});

	$('.pie-chart2').xmpiechart({
		width: 44,
		height: 44,
		percent: 86,
		fillWidth: 4,
		gradient: true,
		gradientColors: ['#10fac0', '#1cbdf9'],
		speed: 2,
		outline: true,
		linkPercent: '.percent'
	});

	$('.pie-chart3').xmpiechart({
		width: 44,
		height: 44,
		percent: 100,
		fillWidth: 4,
		color: "#ffc000",
		speed: 2,
		outline: true,
		linkPercent: '.percent'
	});
})(jQuery);