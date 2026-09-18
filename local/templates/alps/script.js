jQuery(function($) {
    let body = $('body')
    let searchPopup = $('#search-popup') 
    let callback = $('#callback')
    let mobMenu = $('#mobilemenu')

    // search
    body.on('click', '#search-icon', function() {
        searchPopup.show()
        $('#search-form').find('input').focus()
    })

    body.on('click', '#sp-close', function() {
        searchPopup.hide()
    }) 
 
    body.on('click', '.auth-close', function() {
 
        callback.hide();   
        $('#my_register').hide();  
		$('#conditions_arrive').hide();
		$('#conditions_cashback').hide();  
		$('#room_pay_popup').hide(); 
		$('#main_menu ').hide();  
		$('#bath_pay_popup ').hide(); 
		

        return false;
    }) 

    // callback
    body.on('click', '.callback', function() {
       
        callback.show();
        mobMenu.hide();

        $('#mobilePhone').slideUp();

        return false;
    })

    // menu
    body.on('click', '#top_menu_menu', function() {
       
        $("#main_menu").show(); 
        mobMenu.hide(); 

        return false;
    })


    body.on('click', '#oc-close', function() {

        oneClick.hide(); 
        $("#main_menu").hide(); 
 
        return false;
    }) 

    body.on('click', '#mob-menu-close', function() {
        mobMenu.hide()
    }) 
      
    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
          "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ))
        return matches ? decodeURIComponent(matches[1]) : undefined
    } 

    $(document).on('click', '.filter_link', function(event) {

        var cur_parent=$(this).parent();
        var submenu=$('.side_submenu',cur_parent);

        if(cur_parent.hasClass('active')){
            cur_parent.removeClass('active');  
            submenu.slideUp();
        }      
        else {
            cur_parent.addClass('active');  
            submenu.slideDown();
        }      

        //submenu.slideToggle();

        return false;

    });
  

    /*  --- Bind mobile menu  --- */
    var $mobileMenu = $("#mobilemenu, #mobileheadersimple");
    $mobileMenu.isOpen = false;
    if($mobileMenu.length){
        $mobileMenu.isOpen = $mobileMenu.hasClass('show')
        $mobileMenu.isLeftSide = $mobileMenu.hasClass('leftside')
        $mobileMenu.isDowndrop = $mobileMenu.find('>.scroller').hasClass('downdrop')

        $(document).on('click', '#mobileheader .burger', function(){
            SwipeMobileMenu()
        })

        if($mobileMenu.isLeftSide){
            $mobileMenu.parent().append('<div id="mobilemenu-overlay"></div>')
            var $mobileMenuOverlay = $('#mobilemenu-overlay')

            $mobileMenuOverlay.click(function(){
                if($mobileMenu.isOpen){
                    CloseMobileMenu()
                }
            });

            $(document).swiperight(function(e) {
                if(!$(e.target).closest('.flexslider').length && !$(e.target).closest('.swipeignore').length && !$(e.target).closest('ymaps').length){
                    OpenMobileMenu()
                }
            });

            $(document).swipeleft(function(e) {
                if(!$(e.target).closest('.flexslider').length && !$(e.target).closest('.swipeignore').length && !$(e.target).closest('ymaps').length){
                    CloseMobileMenu()
                }
            });
        }
        else{
            $(document).on('click', '#mobileheader', function(e){
                if(!$(e.target).closest('#mobilemenu').length && !$(e.target).closest('.burger').length && $mobileMenu.isOpen){
                    CloseMobileMenu()
                }
            });
        }

        $(document).on('click', '#mobilemenu .menu a,#mobilemenu .social-icons a', function(e){
            var $this = $(this)
            if($this.hasClass('parent')){
                e.preventDefault()

                var parent_li=$(this).parent();

                $('.dropdown_custom',parent_li).slideToggle(); 

                /*if(!$mobileMenu.isDowndrop){
                    $this.closest('li').addClass('expanded')
                    MoveMobileMenuWrapNext()

                }
                else{
                    if(!$this.closest('li').hasClass('expanded')){
                        $this.closest('li').addClass('expanded')
                    }
                    else{
                        $this.closest('li').removeClass('expanded')
                    }
                }*/
            }
            else{
                if(!$this.hasClass('city_item')){
                    var href = $this.attr('href')
                    if(typeof href !== 'undefined' && href.length){
                        e.preventDefault()
                        window.location.href = href
                        //window.location.reload()
                    }
                }

                if(!$this.closest('.menu_back').length){
                    CloseMobileMenu()
                }
            }
        })

        /*
        $(document).on('click', '#mobilemenu .dropdown .menu_back', function(e){
            e.preventDefault()
            var $this = $(this)
            MoveMobileMenuWrapPrev()
            setTimeout(function(){
                $this.closest('.expanded').removeClass('expanded')
            }, 400)
        })


        $(document).on('click', '.svg-inline-phone', function(e){
            e.preventDefault()

            $('#mobilePhone').slideDown();
        })
        $(document).on('click', '.svg-inline-search', function(e){
            e.preventDefault()

            $('#mobileSearch').slideDown();
        })

        $(document).on('click', '.svg-inline-close', function(e){
            e.preventDefault()

            $('#mobilePhone').slideUp();
            $('#mobileSearch').slideUp();
        })*/        



        OpenMobileMenu = function(){
            //CloseMobilePhone();

            if(!$mobileMenu.isOpen){
                // hide styleswitcher
                if($('.style-switcher').hasClass('active')){
                    $('.style-switcher .switch').trigger('click')
                }
                $('.style-switcher .switch').hide()

                if($mobileMenu.isLeftSide){
                    // show overlay
                    setTimeout(function(){
                        $mobileMenuOverlay.fadeIn('fast')
                    }, 100)

                    // fix body
                    $('body').css({'overflow-y':'hidden'});
                }
                else{
                    // scroll body to top & set fixed
                    $('body').scrollTop(0).css({position: 'fixed'})


                    // set menu top = bottom of header
                    $mobileMenu.css({top: + ($('#mobileheader').height() + $('#mobileheader').offset().top) + 'px'})

                    // change burger icon
                    $('#mobileheader .burger').addClass('c')
                }

                // show menu
                $mobileMenu.addClass('show')
                $mobileMenu.isOpen = true;

                if(!$mobileMenu.isDowndrop){
                    var $wrap = $mobileMenu.find('.wrap').first()
                    var params =  $wrap.data('params')
                    if(typeof params === 'undefined'){
                        params = {
                            depth: 0,
                            scroll: {},
                            height: {}
                        }
                    }
                    $wrap.data('params', params)
                }
            }
        }

        CloseMobileMenu = function(){
            if($mobileMenu.isOpen){
                // hide menu
                $mobileMenu.removeClass('show')
                $mobileMenu.isOpen = false

                // show styleswitcher
                $('.style-switcher .switch').show()

                if($mobileMenu.isLeftSide){
                    // unfix body
                    $('body').css({'overflow-y':'auto'});

                    // hide overlay
                    setTimeout(function(){
                        $mobileMenuOverlay.fadeOut('fast')
                    }, 100)
                }
                else{
                    // change burger icon
                    $('#mobileheader .burger').removeClass('c')

                    // body unset fixed
                    $('body').css({position: ''})
                }

                if(!$mobileMenu.isDowndrop){
                    setTimeout(function(){
                        var $scroller = $mobileMenu.find('.scroller').first()
                        var $wrap = $mobileMenu.find('.wrap').first()
                        var params =  $wrap.data('params')
                        params.depth = 0
                        $wrap.data('params', params).attr('style', '')
                        $mobileMenu.scrollTop(0)
                        $scroller.css('height', '')
                    }, 400)
                }
            }
        } 

        SwipeMobileMenu = function(){
            if($mobileMenu.isOpen){
                CloseMobileMenu()
            }
            else{
                OpenMobileMenu()
            }
        }

       /* MoveMobileMenuWrapNext = function(){
            if(!$mobileMenu.isDowndrop){
                var $scroller = $mobileMenu.find('.scroller').first()
                var $wrap = $mobileMenu.find('.wrap').first()
                if($wrap.length){
                    var params =  $wrap.data('params')
                    var $dropdownNext = $mobileMenu.find('.expanded>.dropdown').eq(params.depth)
                    if($dropdownNext.length){
                        // save scroll position
                        params.scroll[params.depth] = parseInt($mobileMenu.scrollTop())

                        // height while move animating
                        params.height[params.depth + 1] = Math.max($dropdownNext.height(), (!params.depth ? $wrap.height() : $mobileMenu.find('.expanded>.dropdown').eq(params.depth - 1).height()))
                        $scroller.css('height', params.height[params.depth + 1] + 'px')

                        // inc depth
                        ++params.depth

                        // translateX for move
                        $wrap.css('transform', 'translateX(' + -100 * params.depth + '%)')

                        // scroll to top
                        setTimeout(function() {
                            $mobileMenu.animate({scrollTop : 0}, 200);
                        }, 100)

                        // height on enimating end
                        var h = $dropdownNext.height()
                        setTimeout(function() {
                            if(h){
                                $scroller.css('height', h + 'px')
                            }
                            else{
                                $scroller.css('height', '')
                            }
                        }, 200)
                    }

                    $wrap.data('params', params)
                }
            }
        }

        MoveMobileMenuWrapPrev = function(){
            if(!$mobileMenu.isDowndrop){
                var $scroller = $mobileMenu.find('.scroller').first()
                var $wrap = $mobileMenu.find('.wrap').first()
                if($wrap.length){
                    var params =  $wrap.data('params')
                    if(params.depth > 0){
                        var $dropdown = $mobileMenu.find('.expanded>.dropdown').eq(params.depth - 1)
                        if($dropdown.length){
                            // height while move animating
                            $scroller.css('height', params.height[params.depth] + 'px')

                            // dec depth
                            --params.depth

                            // translateX for move
                            $wrap.css('transform', 'translateX(' + -100 * params.depth + '%)')

                            // restore scroll position
                            setTimeout(function() {
                                $mobileMenu.animate({scrollTop : params.scroll[params.depth]}, 200);
                            }, 100)

                            // height on enimating end
                            var h = (!params.depth ? false : $mobileMenu.find('.expanded>.dropdown').eq(params.depth - 1).height())
                            setTimeout(function() {
                                if(h){
                                    $scroller.css('height', h + 'px')
                                }
                                else{
                                    $scroller.css('height', '')
                                }
                            }, 200)
                        }
                    }

                    $wrap.data('params', params)
                }
            }
        }
        */
    }
    /*  --- END Bind mobile menu  --- */


    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
          //lazyLoad: 'ondemand',
        arrows: true,
  
    autoplay: true,
    autoplaySpeed: 1500,
        dots: true,
        fade: true, 
        swipe: true,
        infinite: false,
        adaptiveHeight: true,
        prevArrow: '<button type="button" class="slick-prev-custom"></button>',
        nextArrow: '<button type="button" class="slick-next-custom"></button>',
      }); 


      
  $('.slider_special2').slick({
    dots: false,
    //lazyLoad: 'ondemand',
    infinite: true,
    arrows: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    centerMode: true,
    centerPadding: '50px',
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 5,
          centerMode: false
        }
      },
      {
        breakpoint: 1250,
        settings: {
          slidesToShow: 3,
          centerMode: true
        }
      },
      {
        breakpoint: 950,
        settings: {
          slidesToShow: 2,
          centerMode: true
        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 1,
          centerMode: true
        }
      }
    ]
  });


  
  $('.slider_special_rew').slick({
    dots: false,
    //lazyLoad: 'ondemand',
    infinite: false,
    arrows: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    centerMode: false,
    initialSlide:1,
    //centerPadding: '50px',
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 4,
          centerMode: false
        }
      },
      {
        breakpoint: 1250,
        settings: {
          slidesToShow: 3,
          centerMode: false
        }
      },
      {
        breakpoint: 950,
        settings: {
          slidesToShow: 2,
          centerMode: false
        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 1,
          centerMode: true,
          centerPadding: '50px'
        }
      }
    ]
  });




});

 