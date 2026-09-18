$(document).on('click', '.toolbar_nav', function(e){

    var popup = $(this).next();

    if(popup.hasClass('upper'))
        popup.removeClass('upper'); 
    else
        popup.addClass('upper');
});
