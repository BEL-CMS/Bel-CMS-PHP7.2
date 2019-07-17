$( document ).ready(function() {
    "use strict";
    // Basic
    $('#basicTree').jstree({
		'core' : {
			'themes' : {
				'responsive': true
			}
		},
        'types' : {
            'default' : {
                'icon' : 'fas fa-folder'
            },
            'file' : {
                'icon' : 'far fa-file'
            }
        },
        'plugins' : ['types']
    });
});