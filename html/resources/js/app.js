$(function() {
    


    $('#btnMenu').on('click', function() {
        $('#menu').addClass('active');
    });

    $('#btnMenuClose').on('click', function() {
        $('#menu').removeClass('active');
    });


    $('.link_section').on('click', function() {
        if($('#menu').hasClass('active')){
            $('#menu').removeClass('active');
        }
    });


});