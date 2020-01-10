(function($){
	$('.linked-radio').on( 'click', infoToggle );

	function infoToggle() {
		var $this = $(this),
			selectedOption = $this.prop('for');

		$this.siblings('.pm-text').not('.' + selectedOption).slideUp();
		$this.next().slideDown();
	}
})(jQuery);