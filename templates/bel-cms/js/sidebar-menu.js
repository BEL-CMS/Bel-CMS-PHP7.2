(function($) {
	var $sidebar_handle = $('.sidebar-menu-item > a');

	$sidebar_handle.on( 'click', toggleDropdown );

	function toggleDropdown(e) {
		e.preventDefault();
		var $dropdown = $(this).parent().find('.sidebar-menu-dropdown');

		closeActiveDropdowns( $dropdown );

		$dropdown
			.toggleClass('active')
			.slideToggle( 200 );
	}


	function closeActiveDropdowns( immutable ) {
		$('.sidebar-menu-dropdown').each( function() {
			var $this = $(this);

			if( $this.hasClass('active') && ($this[0] !== immutable[0]) ) {
				$this
					.slideToggle( 200 )
					.removeClass('active');
			}
		});
	}

})(jQuery);