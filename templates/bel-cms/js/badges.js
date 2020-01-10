(function($) {
	var badges = [
		{ name: 'badge-progress1', percent: 100	},
		{ name: 'badge-progress2', percent: 100 },
		{ name: 'badge-progress3', percent: 100 },
		{ name: 'badge-progress4', percent: 84 },
		{ name: 'badge-progress5', percent: 0 },
		{ name: 'badge-progress6', percent: 100 },
		{ name: 'badge-progress7', percent: 32 },
		{ name: 'badge-progress8', percent: 100 },
		{ name: 'badge-progress9', percent: 89 },
		{ name: 'badge-progress10', percent: 58 },
		{ name: 'badge-progress11', percent: 100 },
		{ name: 'badge-progress12', percent: 0 },
		{ name: 'badge-progress13', percent: 100 },
		{ name: 'badge-progress14', percent: 100 },
		{ name: 'badge-progress15', percent: 0 },
		{ name: 'badge-progress16', percent: 81 },
		{ name: 'badge-progress17', percent: 0 },
		{ name: 'badge-progress18', percent: 0 },
		{ name: 'badge-progress19', percent: 62 },
		{ name: 'badge-progress20', percent: 84 },
		{ name: 'badge-progress21', percent: 0 },
		{ name: 'badge-progress22', percent: 0 },
		{ name: 'badge-progress23', percent: 83 },
		{ name: 'badge-progress24', percent: 100 },
		{ name: 'badge-progress25', percent: 0 },
		{ name: 'badge-progress26', percent: 0 },
		{ name: 'badge-progress27', percent: 100 },
		{ name: 'badge-progress28', percent: 61 }
	];

	badges.forEach( function( badge ) {
		$('.'+badge.name).xmlinefill({
			width: 150,
			percent: badge.percent,
			fillWidth: 6,
			gradient: true,
			gradientColors: ['#10fac0', '#1cbdf9'],
			speed: 2,
			outline: true
		});
	});
})(jQuery);