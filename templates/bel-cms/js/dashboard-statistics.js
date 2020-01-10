(function($){
    function range(start, count) {
    	return Array.apply(0, Array(count))
    		.map(function (element, index) {
				if ( index < 9 ) {
					return String( '0' + ( index + start ) );
				}
    			return String(index + start);  
		});
    }

	Chart.defaults.global.defaultFontFamily = "'Titillium Web', sans-serif";
	Chart.defaults.global.defaultFontColor = "#888";
	Chart.defaults.global.defaultFontSize = 11;

	var ctx = $('.main-activity-chart'),
		data = {
			type: 'bar',
			data: {
				labels: range(1, 31),
				datasets: [
					{
						label: 'Sales',
						data: [15, 9, 4, 7, 6, 8, 4, 0, 6, 5, 0, 0, 8, 9, 6, 7, 4, 3, 0, 10, 14, 8, 9, 7, 8, 3, 6, 7, 4, 6, 10],
						backgroundColor: "#00d7b3"
					}
				]
			},
			options: {
				legend: {
					display: false
				},
				tooltips: {
					backgroundColor: "#2b373a",
					titleFontSize: 0,
					titleSpacing: 0,
					titleMarginBottom: -7,
					bodyFontSize: 10,
					bodyFontStyle: 'bold',
					bodySpacing: 0,
					cornerRadius: 2,
					xPadding: 12,
					yPadding: 14,
					displayColors: false
				},
				scales: {
					xAxes: [
						{
							stacked: true,
							barThickness: 16,
							gridLines: {
								display:false,
								color: "rgba(255,255,255,0)",
							}
						}
					],
					yAxes: [
						{
							stacked: true,
							gridLines: {
								color: "rgba(235, 235, 235, .5)",
								drawBorder: false,
								drawTicks: false,
								zeroLineColor: "rgba(235, 235, 235, .5)"
							}
						}
					]
				}
			}
		},
        mainActivityChart = new Chart(ctx, data);

    var ctx2 = $('.main-activity-pie-chart'),
        data2 = {
            type: 'doughnut',
            data: {
                datasets: [
                    {
                        data: [60, 30],
                        borderWidth: [ 0 , 0 ],
                        backgroundColor: [
                            "#03f1b6",
                            "#108fe9"
                        ],
                        hoverBackgroundColor: [
                            "#03f1b6",
                            "#108fe9"
                        ]
                    }
                ]
            },
            options: {
                legend: {
					display: false
				},
                tooltips: {
                    enabled: false
                },
                cutoutPercentage: 70
            }
        },
        mainActivityPieChart = new Chart(ctx2, data2);

	var ctx3 = $('.colors-pie-chart'),
		data3 = {
			type: 'doughnut',
			data: {
				datasets: [
					{
						data: [37, 47, 16],
						borderWidth: [ 0 , 0, 0 ],
						backgroundColor: [
							"#7c5ac2",
							"#03f1b6",
							"#108fe9"
						],
						hoverBackgroundColor: [
							"#7c5ac2",
							"#03f1b6",
							"#108fe9"
						]
					}
				]
			},
			options: {
				legend: {
					display: false
				},
				tooltips: {
					enabled: false
				},
				cutoutPercentage: 75
			}
		},
		colorsPieChart = new Chart(ctx3, data3);

	var lineBars = [
		{ name: 'pg1', percent: 86 },
		{ name: 'pg2', percent: 60 },
		{ name: 'pg3', percent: 95 }
	];

	lineBars.forEach(function( pg ){
		$('.' + pg.name).xmlinefill({
			percent: pg.percent,
			fillWidth: 10,
			gradient: true,
			gradientColors: ['#10fac0', '#1cbdf9'],
			speed: 2,
			outline: true,
			outlineColor: "#eff0f4",
			resizable: true
		});
	});

	var ctx4 = $('.social-media-chart'),
		data4 = {
			type: 'bar',
			data: {
				labels: ['\uf09a','\uf099','\uf0d5','\uf09e'],
				datasets: [
					{
						label: '',
						data: [ 350, 310, 325, 220 ],
						backgroundColor: [
							"#3b64a3",
							"#39d1ed",
							"#ee2857",
							"#fbce32"
						]
					}, 
					{
						label: '',
						data: [ 50, 70, 25, 70 ],
						backgroundColor: [
							"#5781c2",
							"#64e6fe",
							"#fd527b",
							"#ffe177"
						]
					},
					{
						label: '',
						data: [ 100, 70, 120, 80 ],
						backgroundColor: [
							"#dde8f7",
							"#a8f1ff",
							"#ff9eb5",
							"#ffeeb3"
						]
					}
				]
			},
			options: {
				legend: {
					display: false
				},
				tooltips: {
					backgroundColor: "#2b373a",
					titleFontSize: 0,
					titleSpacing: 0,
					titleMarginBottom: -7,
					bodyFontSize: 10,
					bodyFontStyle: 'bold',
					bodySpacing: 0,
					cornerRadius: 2,
					xPadding: 12,
					yPadding: 14,
					displayColors: false
				},
				scales: {
					xAxes: [
						{
							stacked: true,
							barThickness: 34,
							gridLines: {
								display: false
							},
							ticks: {
								fontFamily: 'FontAwesome',
								fontColor: "#b2b2b2"
							}
						}
					],
					yAxes: [
						{
							stacked: true,
							gridLines: {
								color: "rgba(235, 235, 235, 1)",
								borderDash: [ 5, 1 ],
								drawBorder: false,
								drawTicks: false,
								zeroLineColor: "rgba(235, 235, 235, 1)"
							}
						}
					]
				}
			}
		},
		socialMediaChart = new Chart(ctx4, data4);

	var ctx5 = $('.single-bar-chart'),
		data5 = {
			type: 'bar',
			data: {
				labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
				datasets: [
					{
						label: 'Value 02',
						data: [ 300, 400, 310, 500, 390, 420, 270 ],
						backgroundColor: "#00d7b3"
					}, 
					{
						label: 'Value 01',
						data: [ 280, 210, 200, 170, 220, 170, 280 ],
						backgroundColor: "#108fe9"
					},
					{
						label: '',
						data: [ 120, 90, 190, 30, 90, 110, 150 ],
						backgroundColor: "#eff0f4"
					}
				]
			},
			options: {
				legend: {
					display: false
				},
				tooltips: {
					backgroundColor: "#2b373a",
					titleFontSize: 0,
					titleSpacing: 0,
					titleMarginBottom: -7,
					bodyFontSize: 10,
					bodyFontStyle: 'bold',
					bodySpacing: 0,
					cornerRadius: 2,
					xPadding: 12,
					yPadding: 14,
					displayColors: false
				},
				scales: {
					xAxes: [
						{
							stacked: true,
							barThickness: 16,
							gridLines: {
								display: false,
								color: "rgba(255,255,255,0)",
							}
						}
					],
					yAxes: [
						{
							stacked: true,
							gridLines: {
								display: false,
								color: "rgba(255,255,255,0)",
							}
						}
					]
				}
			}
		},
		singleBarChart = new Chart(ctx5, data5);

	var ctx6 = $('.lines-graph-chart'),
		data6 = {
			type: 'line',
			data: {
				labels: range(1, 31),
				datasets: [
					{
						label: "Sales",
						data: [32, 42, 38, 40, 25, 28, 24, 14, 15, 5, 18, 15, 32, 30, 37, 25, 23, 27, 22, 20, 15, 40, 45, 34, 38, 50, 30, 35, 30, 30, 24],
						fill: true,
						lineTension: 0,
						backgroundColor: "rgba(16, 143, 233, .4)",
						borderColor: "#108fe9",
						borderCapStyle: 'butt',
						borderDash: [],
						borderDashOffset: 0.0,
						borderJoinStyle: 'bevel',
						pointBorderColor: "#fff",
						pointBackgroundColor: "#108fe9",
						pointBorderWidth: 1,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "#2b373a",
						pointHoverBorderWidth: 6,
						pointRadius: 4,
						pointHitRadius: 10
					}
				]
			},
			options: {
				legend: {
					display: false
				},
				tooltips: {
					backgroundColor: "#2b373a",
					titleFontSize: 0,
					titleSpacing: 0,
					titleMarginBottom: -7,
					bodyFontSize: 10,
					bodyFontStyle: 'bold',
					bodySpacing: 0,
					cornerRadius: 2,
					xPadding: 12,
					yPadding: 14,
					displayColors: false
				},
				scales: {
					xAxes: [
						{
							gridLines: {
								display: false
							}
						}
					],
					yAxes: [
						{
							gridLines: {
								color: "#ebebeb",
								borderDash: [ 7, 2 ],
								drawBorder: false,
								drawTicks: false,
								zeroLineColor: "rgba(235, 235, 235, .5)"
							}
						}
					]
				}
			}
		},
		linesGraphChart = new Chart(ctx6, data6);

	var ctx7 = $('.double-bar-chart'),
		data7 = {
			type: 'bar',
			data: {
				labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				datasets: [
					{
						label: '$',
						data: [640, 500, 560, 690, 670, 560, 610, 530, 700, 550, 680, 510 ],
						backgroundColor: "#108fe9"
					}, 
					{
						label: '$',
						data: [700, 510, 600, 640, 750, 510, 650, 600.43, 610, 600, 640, 590 ],
						backgroundColor: "#00d7b3"
					}
				]
			},
			options: {
				legend: {
					display: false
				},
				tooltips: {
					backgroundColor: "#2b373a",
					titleFontSize: 10,
					titleFontColor: "#16ffd8",
					titleSpacing: 0,
					titleMarginBottom: 6,
					bodyFontSize: 10,
					bodyFontStyle: 'bold',
					bodySpacing: 0,
					cornerRadius: 2,
					xPadding: 12,
					yPadding: 12,
					displayColors: false
				},
				scales: {
					xAxes: [
						{
							barThickness: 16,
							gridLines: {
								display: false
							}
						}
					],
					yAxes: [
						{
							gridLines: {
								display: false
							},
							ticks: {
								beginAtZero: true
							}
						}
					]
				}
			}
		},
		doubleBarChart = new Chart(ctx7, data7);

	var ctx8 = $('.waves-chart'),
		data8 = {
			type: 'line',
			data: {
				labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				datasets: [
					{
						data: [310, 420, 250, 340, 370, 250, 300, 270, 230, 390, 290, 380],
						label: "$",
						fill: true,
						lineTension: 0.5,
						backgroundColor: "rgba(16, 143, 233, .8)",
						borderColor: "#108fe9",
						borderCapStyle: 'butt',
						borderDash: [],
						borderDashOffset: 0,
						borderJoinStyle: 'bevel',
						pointBorderColor: "#fff",
						pointBackgroundColor: "#108fe9",
						pointBorderWidth: 0,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "#2b373a",
						pointHoverBorderWidth: 6,
						pointRadius: 0,
						pointHitRadius: 10
					},
					{
						data: [580, 410, 700, 340, 250, 510, 520, 480, 680, 410, 490, 580],
						fill: true,
						label: "$",
						lineTension: 0.5,
						backgroundColor: "rgba(234, 46, 104, .8)",
						borderColor: "#ea2e68",
						borderCapStyle: 'bevel',
						borderDash: [],
						borderDashOffset: 0,
						borderJoinStyle: 'bevel',
						pointBorderColor: "#fff",
						pointBackgroundColor: "#ea2e68",
						pointBorderWidth: 0,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "#2b373a",
						pointHoverBorderWidth: 6,
						pointRadius: 0,
						pointHitRadius: 10
					}
				]
			},
			options: {
				legend: {
					display: false
				},
				tooltips: {
					backgroundColor: "#2b373a",
					titleFontSize: 10,
					titleFontColor: "#16ffd8",
					titleSpacing: 0,
					titleMarginBottom: 6,
					bodyFontSize: 10,
					bodyFontStyle: 'bold',
					bodySpacing: 0,
					cornerRadius: 2,
					xPadding: 12,
					yPadding: 12,
					displayColors: false
				},
				scales: {
					xAxes: [
						{
							gridLines: {
								color: "#ebebeb",
								drawBorder: false,
								zeroLineColor: "rgba(235, 235, 235, .5)"
							}
						}
					],
					yAxes: [
						{
							gridLines: {
								display: false
							},
							ticks: {
								beginAtZero: true
							}
						}
					]
				}
			}
		},
		wavesChart = new Chart(ctx8, data8);

	var ctx9 = $('.two-lines-chart'),
		data9 = {
			type: 'line',
			data: {
				labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				datasets: [
					{
						data: [10, 12, 9, 11, 15, 12, 13, 9, 12, 10, 12, 17],
						label: "Sales",
						fill: false,
						lineTension: 0,
						borderWidth: 4,
						borderColor: "#108fe9",
						borderCapStyle: 'butt',
						borderDash: [],
						borderDashOffset: 0,
						borderJoinStyle: 'bevel',
						pointBorderColor: "#108fe9",
						pointBackgroundColor: "#fff",
						pointBorderWidth: 4,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "#108fe9",
						pointHoverBorderWidth: 4,
						pointRadius: 5,
						pointHitRadius: 10
					},
					{
						data: [8, 4, 11, 6, 9, 7, 8, 6, 8, 4, 2, 12],
						fill: false,
						label: "Sales",
						lineTension: 0,
						borderColor: "#ffdc1b",
						borderCapStyle: 'bevel',
						borderDash: [],
						borderDashOffset: 0,
						borderJoinStyle: 'bevel',
						pointBorderColor: "#ffdc1b",
						pointBackgroundColor: "#fff",
						pointBorderWidth: 4,
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "#ffdc1b",
						pointHoverBorderWidth: 4,
						pointRadius: 5,
						pointHitRadius: 10
					}
				]
			},
			options: {
				legend: {
					display: false
				},
				tooltips: {
					backgroundColor: "#2b373a",
					titleFontSize: 0,
					titleSpacing: 0,
					titleMarginBottom: -7,
					bodyFontSize: 10,
					bodyFontStyle: 'bold',
					bodySpacing: 0,
					cornerRadius: 2,
					xPadding: 12,
					yPadding: 12,
					displayColors: false
				},
				scales: {
					xAxes: [
						{
							gridLines: {
								color: "rgba(235, 235, 235, .5)",
								drawBorder: false,
								zeroLineColor: "rgba(235, 235, 235, .5)"
							}
						}
					],
					yAxes: [
						{
							gridLines: {
								color: "rgba(235, 235, 235, .5)",
								drawBorder: false,
								zeroLineColor: "rgba(235, 235, 235, .5)"
							},
							ticks: {
								beginAtZero: true
							}
						}
					]
				}
			}
		},
		twoLinesChart = new Chart(ctx9, data9);

	$('.bounce-pie-chart').xmpiechart({
		width: 200,
		height: 200,
		percent: 68,
		color: "#7c5ac2",
		fillWidth: 8,
		speed: 2,
		outline: true,
		linkPercent: '.bounce-perc-link'
	});

	var countryPieCharts = [
			{ name: 'cc1', percent: [55, 45] },
			{ name: 'cc2', percent: [60, 40] },
			{ name: 'cc3', percent: [70, 30] },
			{ name: 'cc4', percent: [74, 26] },
			{ name: 'cc5', percent: [76, 24] },
			{ name: 'cc6', percent: [80, 20] },
			{ name: 'cc7', percent: [85, 15] },
			{ name: 'cc8', percent: [90, 10] }
		],
		countryPieChartsData = {
			type: 'doughnut',
			data: {
				datasets: [
					{
						data: [],
						borderWidth: [ 0 , 0 ],
						backgroundColor: [
							"#7c5ac2",
							"#ffdc1b"
						],
						hoverBackgroundColor: [
							"#7c5ac2",
							"#ffdc1b"
						]
					}
				]
			},
			options: {
				legend: {
					display: false
				},
				tooltips: {
					enabled: false
				},
				cutoutPercentage: 70
			}
		};

	countryPieCharts.forEach(function(item){
		countryPieChartsData.data.datasets[0].data = item.percent;
		var ctx = $('.'+item.name);
		new Chart(ctx, countryPieChartsData); 
	});

	$('.numbers-slider').bxSlider({
		controls: false,
		auto: true,
		pause: 2000,
		pagerCustom: '.slider-pager'
	});
})(jQuery);