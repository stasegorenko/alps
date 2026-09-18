$(document).on('input', 'input', function(e){

    var placeholder = $(this).next();

    if($(this).val() != '')
        placeholder.addClass('upper');
    else
        placeholder.removeClass('upper'); 
});
