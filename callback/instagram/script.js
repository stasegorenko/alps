$(document).ready(function(){

    $('.slider').slick({
        dots: false,
        arrows: false,
        infinite: true,
        fade: true,
        cssEase: 'linear',
        speed: 1500,
        autoplay: true,
        autoplaySpeed: 3000,
        slidesToShow: 1,
        slidesToScroll: 1
    });


    // $('input').each(function(e){

    //     console.log($(this));

    //     var placeholder = $(this).next();
    
    //     if($(this).val() != '')
    //         placeholder.addClass('upper');
    //     else
    //         placeholder.removeClass('upper'); 
    // });
     

});


$(document).on('input', 'input', function(e){

    var placeholder = $(this).next();

    if($(this).val() != '')
        placeholder.addClass('upper');
    else
        placeholder.removeClass('upper'); 
});

