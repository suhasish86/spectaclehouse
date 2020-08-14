function popmessage(type = 'success', nTitle = '', nMsg = '') {

    var nFrom = 'top';
    var nAlign = 'center';
    var nIcons = '';
    var nType = type;
    var nAnimIn = 'animated fadeInDown';
    var nAnimOut = 'animated fadeOutUp';

    $.growl({
        icon: nIcons,
        title: nTitle,
        message: nMsg,
        url: ''
    }, {
        element: 'body',
        type: nType,
        allow_dismiss: true,
        placement: {
            from: nFrom,
            align: nAlign
        },
        offset: {
            x: 20,
            y: 85
        },
        spacing: 10,
        z_index: 1031,
        delay: 2500,
        timer: 1000,
        url_target: '_blank',
        mouse_over: false,
        animate: {
            enter: nAnimIn,
            exit: nAnimOut
        },
        icon_type: 'class',
        template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Close</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#" data-growl="url"></a>' +
            '</div>'
    });
}