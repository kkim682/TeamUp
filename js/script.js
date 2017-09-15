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
                inverted: false,
                onHidden: function(){
                    $('#login-form').find('input[type=password],input[type=text]').val('');
                }
            })
            .modal('show');
    });

    $('#signUp-bttn,#getStarted-bttn').click(function () {
        $('#signUp-modal')
            .modal({
                inverted: false,
                onHidden: function(){
                    $('#signUp-form').find('input[type=password],input[type=text]').val('');
                    $('#signUp-form').find('input[type=checkbox]').prop('checked', false);
                }            
        })
            .modal('show');
    });

    $('#newCourse-bttn').click(function () {
        $('#newCourse-modal')
            .modal({
                inverted: false,
                onHidden: function(){
                    $('#newCourse-form').find('input[type=text]').val('');
                }
            })
            .modal('show');
    });
    
    $('.cancel').click(function () {
        $('.ui.modal')
            .modal('hide');
    });

});
