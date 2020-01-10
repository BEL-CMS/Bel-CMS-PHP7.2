(function($) {
    $('body').xmalert({ 
        x: 'right',
        y: 'bottom',
        xOffset: 30,
        yOffset: 30,
        alertSpacing: 40,
        fadeDelay: 0.3,
        autoClose: false,
        template: 'survey',
        title: 'Alerts & Notifications',
        paragraph: 'We added alerts & notifications to the template!.<br>Try our previewer and code generator and use them in your page!',
        timestamp: '',
        imgSrc: 'images/dashboard/alert-logo.png',
        buttonSrc: [ 'alerts-notifications.html' ],
        buttonText: 'Check it <span class="primary">out!</span>',
    });
})(jQuery);