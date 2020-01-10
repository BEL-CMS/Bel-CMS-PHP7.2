(function($){
    var $dp_handle = $('.dropdown-handle');

    $dp_handle.on('click', toggleSettings);

    function toggleSettings() {
        var $this = $(this),
            $dp = $this.siblings('.dropdown');

        if($dp.hasClass('closed')) {
            $dp.removeClass('closed');
            $this.addClass('active');
        } else {
            $dp.addClass('closed');
            $this.removeClass('active');
        }
    }
})(jQuery);