jQuery(document).ready(function($){

	$('#belcms_main_user_left_menu li a').click(function(event) {
		event.preventDefault();
		var id = $(this).attr('href').replace('#', '');
		$('#belcms_main_user_left_menu li a').each(function() {
			$(this).removeClass('active');
		});
	});
});