(function($){
    var $alert_user = $('.alert-user'),
        $alert_admin = $('.alert-admin'),
        $alert_tip = $('.alert-tip'),
        $alert_info = $('.alert-info'),
        $alert_success = $('.alert-success'),
        $alert_error = $('.alert-error');

    $alert_user.on('click', function(e){
        e.preventDefault();
        $('body').xmalert({ 
            x: 'right',
            y: 'bottom',
            xOffset: 30,
            yOffset: 30,
            alertSpacing: 20,
            lifetime: 6000,
            fadeDelay: 0.3,
            template: 'item',
            title: '<span class="bold">MeganV.</span> added <span class="bold">Pixel Diamond Gaming Shop</span> to favourites',
            timestamp: '2 hours ago',
            imgSrc: 'images/avatars/avatar_02.jpg',
            iconClass: 'icon-heart'
        });
    });

    $alert_admin.on('click', function(e){
        e.preventDefault();
        $('body').xmalert({ 
            x: 'right',
            y: 'bottom',
            xOffset: 30,
            yOffset: 30,
            alertSpacing: 50,
            lifetime: 6000,
            fadeDelay: 0.3,
            template: 'survey',
            title: 'What would you improve?',
            paragraph: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.',
            timestamp: '2 hours ago',
            imgSrc: 'images/dashboard/alert-logo.png',
            buttonSrc: [ '#','#' ],
            buttonText: 'Take the <span class="primary">Survey!</span>',
        });
    });

    $alert_tip.on('click', function(e){
        e.preventDefault();
        $('body').xmalert({ 
            x: 'right',
            y: 'bottom',
            xOffset: 30,
            yOffset: 30,
            alertSpacing: 20,
            lifetime: 6000,
            fadeDelay: 0.3,
            template: 'review',
            title: 'New Fast Checkout',
            paragraph: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.',
            timestamp: '14 hours ago',
            buttonSrc: [ '#','#' ],
        });
    });

    $alert_info.on('click', function(e){
        e.preventDefault();
        $('body').xmalert({ 
            x: 'right',
            y: 'top',
            xOffset: 30,
            yOffset: 30,
            alertSpacing: 40,
            lifetime: 6000,
            fadeDelay: 0.3,
            template: 'messageInfo',
            title: 'Info Alert Box',
            paragraph: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.',
        });
    });

    $alert_success.on('click', function(e){
        e.preventDefault();
        $('body').xmalert({ 
            x: 'right',
            y: 'top',
            xOffset: 30,
            yOffset: 30,
            alertSpacing: 40,
            lifetime: 6000,
            fadeDelay: 0.3,
            template: 'messageSuccess',
            title: 'Success Alert Box',
            paragraph: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.',
        });
    });

    $alert_error.on('click', function(e){
        e.preventDefault();
        $('body').xmalert({ 
            x: 'right',
            y: 'top',
            xOffset: 30,
            yOffset: 30,
            alertSpacing: 40,
            lifetime: 6000,
            fadeDelay: 0.3,
            template: 'messageError',
            title: 'Error Alert Box',
            paragraph: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.',
        });
    });

    /*------------------
		PROMO POPUP
	------------------*/
    $('.promo-popup').magnificPopup({
        type: 'inline',
        removalDelay: 300,
		mainClass: 'mfp-fade',
        closeMarkup: '<div class="close-btn mfp-close"><svg class="svg-plus"><use xlink:href="#svg-plus"></use></svg></div>'
    });
})(jQuery);