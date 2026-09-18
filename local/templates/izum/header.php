<!DOCTYPE html> 
<html lang="ru"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<?$APPLICATION->ShowHead();?>
    
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

   <meta name="description" content="Самый живописный санаторий Восточного Казахстана. Комфортабельные номера и множество лечебных направлений.">
   <meta name="keywords" itemprop="keywords" content="санаторий изумрудный, изумрудный, алтайские альпы, усть каменогорск, горнолыжные базы казахстана, аренда беседок, санатории казахстана, пантовые ванны, пантолечение, реабилитация, аренда домиков, аренда номеров, гостиница, отдых на природе" />
       
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
         
</head>


<!-- WHATS APP-->
<script>(function () { var widget = document.createElement('script'); widget.dataset.pfId = '32e6716d-89f6-414c-ac64-948e73e2fcad'; widget.src = 'https://widget.yourgood.app/script/widget.js?id=32e6716d-89f6-414c-ac64-948e73e2fcad&now='+Date.now(); document.head.appendChild(widget); })()</script>
<!-- WHATS APP -->

<script>
	(function(w,d,u){
		var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
		var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
	})(window,document,'https://cdn-ru.bitrix24.ru/b26421506/crm/tag/call.tracker.js');
</script>


<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(84970528, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/84970528" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


<body>
 

<div id="panel">
    <?$APPLICATION->ShowPanel();?>
</div>

<div id="app">

<div class="top_menu_back"></div>

<section id="header" style="position: fixed; top: 0; z-index: 2; width: 100%;">

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
      <div id="mobileheader" style="position: relative;">
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
                        <!--<li><a href="/vaucher/">Скачать пропуск</a></li>--> 
                        <li><a href="/rooms/" class=" root-item" >Забронировать номер</a></li>
                        <li><a href="/pavilions/" class="root-item" >Аренда беседок</a></li>
                        <li><a href="/rooms/">Проживание</a></li> 
                        <li><a href="/cure/">Лечебные процедуры</a></li>
                        <li><a href="/all-inclusive/">Проживание + Лечение</a></li> 
                        <li><a href="/activities/">Развлечения</a></li> 
                        <li><a href="/bathhouse/" class=" root-item" >Баня</a></li>
                        <li><a href="/price/" class="root-item" >Цены</a></li> 
                        <li><a href="/contacts/" class="root-item" id="top_menu_contacts">Контакты</a></li>
                        <!--<li><a href="/callback/" class="root-item" id="top_menu_contacts">Оценить санаторий</a></li>-->   

                     </ul>
                  </nav>
                  
               </div>
            </div>
         </div>
      </div>
   </div> 

</section>
