$(document).ready(function () {

    $('#menu').click(function () {
        $('.ui.sidebar').sidebar('setting', 'transition', 'overlay').sidebar('toggle');
    });


    $('.ui.modal')
        .modal({
            allowMultiple: false
        });


    $('#login-bttn').click(function () {
        $('#login-modal')
            .modal({
                inverted: false
            })
            .modal('show');
    });

    $('#signUp-bttn,#getStarted-bttn').click(function () {
        $('#signUp-modal')
            .modal({
                inverted: false,
                allowMultiple: false
            })
            .modal('show');
    });

    $('.cancel').click(function () {
        $('.ui.modal')
            .modal('hide');
    });

});
