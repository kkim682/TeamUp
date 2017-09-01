$(document).ready(function () {

    $('#menu').click(function () {
        $('.ui.sidebar').sidebar('setting', 'transition', 'overlay').sidebar('toggle');
    });

    
    $('.ui.modal')
  .modal({
    allowMultiple: false
  });
    
    

    $('#login').click(function () {
        $('.ui.modal.login')
            .modal({
                inverted: false
            })
            .modal('show');
    });

    $('#signUp,#getStarted').click(function () {
        $('.ui.modal.signUp')
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
