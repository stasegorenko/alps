<!DOCTYPE html> 
<html lang="ru"><head> 

	<?$APPLICATION->ShowHead();?>
    
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico"> 
   <title><?$APPLICATION->ShowTitle(false)?> </title> 
   
   <?
   $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/libs/jquery/jquery.min.js'); 
   
   $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/libs/slick/slick.css');
   $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/libs/slick/slick-theme.css');
   $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/libs/slick/slick.min.js'); 

   $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/libs/fancybox/dist/jquery.fancybox.min.css');
   $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/libs/fancybox/dist/jquery.fancybox.min.js');

   $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/main.css');
   
   $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/script.js'); 
   ?>  

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0FFEFNBKNM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0FFEFNBKNM');
  gtag('config', 'AW-666929627');
</script>

</head>




<script>(function () { var widget = document.createElement('script'); widget.defer = true; widget.dataset.pfId = '32e6716d-89f6-414c-ac64-948e73e2fcad'; widget.src = 'https://widget.yourgood.app/script/widget.js?id=32e6716d-89f6-414c-ac64-948e73e2fcad&now='+Date.now(); document.head.appendChild(widget); })()</script>

<!--	<a href="https://api.whatsapp.com/send?phone=77774015340"  target="_blank" rel="noopener noreferrer"><div type="button" class="whatsapp-button"><div class="text-button"><i class="fa fa-whatsapp" ></i><span>WA</span></div></div></a>

<style type="text/css">
.whatsapp-button {
    position: fixed;
    right: 2px;
    bottom: 35px;
    transform: translate(-50%, -50%);
    background: #25D366; /*цвет кнопки*/
    border-radius: 50%;
    width: 65px; /*ширина кнопки*/
    height: 65px; /*высота кнопки*/
    color: #fff;
    text-align: center;
    line-height: 67px; /*центровка иконки в кнопке*/
    font-size: 30px; /*размер иконки*/
    z-index: 9999;
	font-weight: bold;
}
.whatsapp-button a {
    color: #fff;
}
.whatsapp-button:before,
.whatsapp-button:after {
    content: " ";
    display: block;
    position: absolute;
    border: 50%;
    border: 1px solid #25D366; /*цвет анимированных волн от кнопки*/
    left: -20px;
    right: -20px;
    top: -20px;
    bottom: -20px;
    border-radius: 50%;
    animation: animate 1.5s linear infinite;
    opacity: 0;
    backface-visibility: hidden; 
}
 
.whatsapp-button:after{
    animation-delay: .5s;
}
 
@keyframes animate
{
    0%
    {
        transform: scale(0.5);
        opacity: 0;
    }
    50%
    {
        opacity: 1;
    }
    100%
    {
        transform: scale(1.2);
        opacity: 0;
    }
}
	</style>-->

<!-- WHATS APP-->
<!--<script>(function () { var widget = document.createElement('script'); widget.dataset.pfId = '32e6716d-89f6-414c-ac64-948e73e2fcad'; widget.src = 'https://widget.yourgood.app/script/widget.js?id=32e6716d-89f6-414c-ac64-948e73e2fcad&now='+Date.now(); document.head.appendChild(widget); })()</script>->
<!-- WHATS APP -->


<script>
(function(w,d,u){
var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
})(window,document,'https://cdn-ru.bitrix24.ru/b26421506/crm/tag/call.tracker.js');
</script>

<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1609735102809945');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1609735102809945&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->


<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(80974135, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/80974135" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->




<body>
 

<div id="panel">
    <?$APPLICATION->ShowPanel();?>
</div>
  
<section id="header">

   <div class="d-none d-md-block">
      <div class="d-none d-md-none menu">
         <nav class="container">
            <ul class="filter_cats_ul m-0 p-0 d-flex justify-content-between">
               <li><a href="/" class="root-item" id="top_menu_menu">Меню</a></li>
               <li><a href="/rooms/" class=" root-item" id="top_menu_book">Забронировать</a></li>
               <li><a href="/price/" class="root-item" id="top_menu_price">Цены</a></li>
               <li><a href="/contacts/" class="root-item" id="top_menu_contacts">Контакты</a></li> 
            </ul>
         </nav>

      </div>
   </div>


   <div class="container">
      <div id="mobileheader" >
         <div class="d-flex justify-content-between " id="mob_head">

            <div class="d-block d-md-none align-self-center header-mobile-menu position-relative ml-2">
               <div class="burger">
                  <i class="svg inline svg-inline-burger dark" aria-hidden="true">
                  <img src="<?=SITE_TEMPLATE_PATH?>/icons/burger_mobile.png" alt="">
                  </i> 
                  <i class="svg inline  svg-inline-close dark" aria-hidden="true">
                  <img class="close-svg" src="<?=SITE_TEMPLATE_PATH?>/icons/close.png" alt="">
                  </i>   
               </div>
            </div>

            <div class="align-self-center position-relative d-flex logo-wrap" >

               <div class=" text-center position-relative">
                  <a href="/" class="header-logo d-flex justify-content-start align-items-center">
                  <img src="/slider/logo.png" alt=""> 
                  </a>
               </div>

            </div>

            <div class="d-none d-md-block align-self-center header-search menu_alps">
                <div class="d-none d-md-flex menu" >
                  <nav class="container">
                     <ul class="filter_cats_ul ml-5 pl-5 d-flex justify-content-between">
                        <li><a href="/web-cameras/" class="root-item" id="top_menu_cam">Камера</a></li>
                     </ul>
                  </nav>
               </div>

            </div>

            <div class="d-none d-md-block align-self-center header-search menu_alps menu_alps_right">

               <div class="d-none d-md-flex menu " >
                  <nav class="container">
                     <ul class="filter_cats_ul m-0 p-0 d-flex justify-content-between">
                        <li><a href="/" class="root-item" id="top_menu_menu">Меню</a></li>
                        <li><a href="/rooms/" class=" root-item" id="top_menu_book">Забронировать</a></li>
                        <li><a href="/price/" class="root-item" id="top_menu_price">Цены</a></li>
                        <li><a href="/contacts/" class="root-item" id="top_menu_contacts">Контакты</a></li> 
                     </ul>
                  </nav>

               </div>


               <div class="d-none search-form">
                  <form id="search" action="/">
                     <input type="text" name="s" value="<?=htmlspecialchars($_REQUEST['s']);?>" autocomplete="off" id="title-search-input" maxlength="100" placeholder="Поиск">
                     <button class="search-popup-submit" type="submit"><img src="<?=SITE_TEMPLATE_PATH?>/icons/search_ico.png" alt=""></button>
                  </form>
               </div>

            </div>

            <div class="d-none call">
               <div class="d-none d-md-block align-self-center header-call">
                  <a style="letter-spacing:.5px;" href="tel:+77774015340">+7 (777) 401-53-40</a>
               </div>
               <div class="d-none d-md-block align-self-center header-callback">
                  <a href="/catalog/#" class="callback btn btn-primary" >Заказать звонок</a>
               </div>
               <div class="d-none d-md-none align-self-center header-callback" style="width:50px;">
                 

                  <div  class="bx-basket bx-opener ">
                     <!--'start_frame_cache_bx_basketFKauiI'-->
                     <div class="d-flex justify-content-between align-items-center">
                        <a class="position-relative ml-4" href="/cart/">
                        <span class="cart-image">
                           <span class="cart-count d-block">0</span>
                           <img class="cart-svg d-block" src="<?=SITE_TEMPLATE_PATH?>/icons/basket_ico_mob.png" alt="">
                        </span>
                        </a> 
                     </div>
                     <!--'end_frame_cache_bx_basketFKauiI'-->
                  </div>


               </div>


            </div>
            <div class="d-none d-md-none align-items-center justify-content-around header_tips_block mr-2">
                
               <div class="mr-3">
                  <div id="open_header_phones">
                     <div class="wrap_icon wrap_phones">
                        <!-- noindex -->
                        <i class="svg inline big svg-inline-phone" style="min-width: 18px; min-height: 18px;top: 1px;" aria-hidden="true">
                        <img src="<?=SITE_TEMPLATE_PATH?>/icons/phone_mobile.png">
                        </i>            
                        <div id="mobilePhone" class="dropdown-mobile-phone">
                           <div class="wrap">
                              <div class="more_phone title">
                                 <span class="no-decript dark-color ">Телефоны 
                                 <i class="svg inline  svg-inline-close dark dark-i" style="float: right;" aria-hidden="true">
                                 <img class="close-svg" src="<?=SITE_TEMPLATE_PATH?>/icons/close.png" alt="">
                                 </i>
                                 </span>
                              </div>
                              <div class="more_phone">
                                 <a class="dark-color no-decript" rel="nofollow" href="tel:77774015340">+7 (777) 401-53-40</a>
                              </div>
                              <div class="more_phone">
                                 <a rel="nofollow" class="dark-color no-decript callback" href="/catalog/" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback">Заказать звонок</a>
                              </div>
                           </div>
                        </div>
                        <!-- /noindex -->
                     </div>
                  </div>
               </div>
               <div class="mr-3">
                  <div id="open_header_search">
                     <div class="wrap_icon wrap_phones">
                        <i class="svg inline  svg-inline-search big" style="min-width: 18px; min-height: 18px;top: 1px;" aria-hidden="true">
                        <img src="<?=SITE_TEMPLATE_PATH?>/icons/search_mobile.png" alt="">
                        </i>
                        <div id="mobileSearch" class="dropdown-mobile-phone">
                           <div class="wrap">
                              <div class="more_phone title">
                                 <span class="no-decript dark-color " style="padding: 10px 0px 22px;"> 
                                 <i class="svg inline  svg-inline-close dark dark-i" style="float: right;" aria-hidden="true">
                                 <img class="close-svg" src="<?=SITE_TEMPLATE_PATH?>/icons/close.png" alt="">
                                 </i>
                                 </span>
                              </div>
                              <div class="more_phone" style="padding: 10px;">
                                 <div class="search-form">
                                    <form id="search_mob" action="/">
                                       <input type="text" name="s" value="" autocomplete="off" id="title-search-input_mob" maxlength="100" placeholder="Поиск">
                                       <button class="search-popup-submit" type="submit"><img src="<?=SITE_TEMPLATE_PATH?>/icons/search_ico.png" alt=""></button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>


         </div>
         <div id="mobilemenu" class="dropdown">
            <div class="scroller">
               <div class="wrap"> 


                  <nav class="menu top">
                     <ul class="top">  
                        <li><a href="/web-cameras/" class=" root-item" >WEB-Камера</a></li>
                        <li><a href="/rooms/" class=" root-item" style="background-color: orange;" >Забронировать</a></li>
                        <li><a href="/price/" class="root-item" >Цены</a></li>
                        <li><a href="/pavilions/">Аренда беседок</a></li>
                        <li><a href="/all-inclusive/">All Inclusive</a></li> 
                         <li class=" ">
                           <a href="/" class="parent">
                           <span>Горнолыжка</span>
                           <?/*?><span class="arrow"><i class="svg svg_triangle_right"></i></span><?*/?>
                           </a>
                           <ul class="dropdown_custom<?/*?>dropdown<?*/?>">
                              <?/*?><li class="menu_back"><a href=""><i class="svg svg-arrow-right"></i>Назад</a></li> <?*/?>                              
                              <li><a href="/worktime/">Подъемники и склоны</a></li>
                              <li><a href="/ski-school/">Горнолыжная школа</a></li>
                              <li><a href="/equipment-rent/">Снаряжение</a></li>     
                              <li><a href="/freeride/">Фрирайд</a></li>                                   
                           </ul>

                        </li>

                        <li><a href="/cafe/">Питание</a></li>
                        <li><a href="/spa/" class=" root-item" style="background-color: orange;">Пантолечение (СКИДКИ до 30%)</a></li>
                        <li><a href="/bathhouse/">Баня</a></li>
                        <!--<li><a href="/rope/">Веревочный парк</a></li>-->
                        <li><a href="/fishing/">Рыбалка</a></li>
                        <li><a href="/news/">Новости и акции</a></li>
                        <li><a href="/maps/">Схема курорта</a></li>
                        <li><a href="/contacts/" class="root-item" id="top_menu_contacts">Контакты</a></li>  

                     </ul>
                  </nav>
 
               </div>
            </div>
         </div>
      </div>
   </div> 

</section>
