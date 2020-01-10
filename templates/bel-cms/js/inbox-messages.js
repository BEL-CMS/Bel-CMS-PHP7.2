(function($){
    var $inbox_messages = $('.inbox-message');

    changeInboxVersion();

    // TODO: Remove when going on production
    // This is for live preview resize feedback
    $(window).resize( changeInboxVersion );

    function changeInboxVersion() {
        if (window.matchMedia('(min-width: 1260px)').matches) {
            // >= 1260px
            $inbox_messages.each(function(){
                var $this = $(this);
                if ( !$this.hasClass('v2') ) return;

                $this.removeClass('v2');
            });
        } else {
            // < 1260px
            $inbox_messages.each(function(){
                var $this = $(this);
                if ( $this.hasClass('v2') ) return;

                $this.addClass('v2');
            });
        }
    }
})(jQuery);