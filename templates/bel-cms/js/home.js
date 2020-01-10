(function($) {
	var productCarousel_1 = '#pl-1',
		productCarousel_2 = '#pl-2',
		productCarousel_3 = '#pl-3',
		productCarousel_4 = '#pl-4',
		productCarousel_5 = '#pl-5';

	var defaults = {
		items: 4,
		itemWidth: 300,
		itemsDesktop: [1260, 3],
		itemsTablet: [930, 2],
		itemsMobile: [620, 1],
		navigation: true,
		navigationText: false
	}

	$(productCarousel_1).owlCarousel(defaults);
	$(productCarousel_2).owlCarousel(defaults);
	$(productCarousel_3).owlCarousel(defaults);
	$(productCarousel_4).owlCarousel(defaults);
	$(productCarousel_5).owlCarousel(defaults);

	function nextSlide(e) {
		e.preventDefault();
		e.data.owlObject.next();
	}

	function prevSlide(e) {
		e.preventDefault();
		e.data.owlObject.prev();
	}

	function registerCarousels(carousels) {
		for(var i=0; i<carousels.length; i++) {
			var id = carousels[i],
				owl = $(id).data('owlCarousel');

			$(id).parent().find('.slide-control.right').on('click', {owlObject: owl}, nextSlide);
			$(id).parent().find('.slide-control.left').on('click', {owlObject: owl}, prevSlide);
		}
	}

	var carousels = [ productCarousel_1, productCarousel_2, productCarousel_3, productCarousel_4, productCarousel_5 ];
	registerCarousels(carousels);
})(jQuery);