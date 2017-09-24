$(document).ready(function () {

    $('#menu').click(function () {
        $('#sideMenu').sidebar('setting', 'transition', 'overlay').sidebar('toggle');
    });

    $('.team').click(function () {
        $('#infoSidebar').sidebar('setting', 'transition', 'overlay').sidebar('toggle');
    });

    $('.ui.modal')
        .modal({
            allowMultiple: false
        });


    $('#login-bttn').click(function () {
        $('#login-modal')
            .modal({
                inverted: false,
                onHidden: function () {
                    $('#login-form').find('input[type=password],input[type=text]').val('');
                }
            })
            .modal('show');
    });

    $('#signUp-bttn,#getStarted-bttn').click(function () {
        $('#signUp-modal')
            .modal({
                inverted: false,
                onHidden: function () {
                    $('#signUp-form').find('input[type=password],input[type=text]').val('');
                    $('#signUp-form').find('input[type=checkbox]').prop('checked', false);
                }
            })
            .modal('show');
    });

    $('.cancel').click(function () {
        $('.ui.modal')
            .modal('hide');
    });


    $('.top.menu .item').tab();


    //Course
    $('#createCourse-bttn').click(function () {
        $('#createCourse-modal')
            .modal({
                inverted: false,
                onHidden: function () {
                    $('#createCourse-form').find('input[type=text]').val('');
                }
            })
            .modal('show');
    });

    $('#joinCourse-bttn').click(function () {
        $('#joinCourse-modal')
            .modal({
                inverted: false,
                onHidden: function () {
                    $('#joinCourse-form').find('input[type=text]').val('');
                }
            })
            .modal('show');
    });

    $("#courseCode").on("keydown", function (e) {
        return e.which !== 32;
    });

    $(".course").click(function () {
        //$("#courseList").hide();
        //$("#coursePage").show();
    })


});
