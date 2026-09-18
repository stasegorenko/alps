<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("TITLE", "Один из лучших горнолыжных курортов СНГ");
$APPLICATION->SetPageProperty("keywords", "Горнолыжный курорт, горнолыжка, горные лыжи, сноуборд, фрирайд, альпы");
$APPLICATION->SetPageProperty("description", "Лучшее горнолыжное путешествие. Разнообразные горнолыжные склоны, огромный выбор инвентаря, комфортабельное проживание и невероятно-вкусное питание.");
$APPLICATION->SetTitle("Горнолыжный курорт Алтайские Альпы");
?>

<video src="<?=SITE_TEMPLATE_PATH?>/video/main-summer.mp4" class="inner-hero__video d-md-block d-none" preload="auto" muted playsinline autoplay="autoplay" loop="loop"></video>
<video src="<?=SITE_TEMPLATE_PATH?>/video/main_mob-summer.mp4" class="inner-hero__video d-md-none d-block" preload="auto" muted playsinline autoplay="autoplay" loop="loop"></video>



<!--ВИДЖЕТ ПОГОДЫ-->

<div class="container"> 

  <div class="row mt-4">

<?
$url = "https://api.openweathermap.org/data/2.5/weather?q=Ognevka&appid=a4d03b0f36f3e1e0d5fb4aa394ad739b&units=metric";
 
$response = file_get_contents($url);
 
$weatherData = json_decode($response);
  
if ($weatherData) 
{   
  $windDir = 'Западный';
  $windDeg = $weatherData->wind->deg;

  if($windDeg >= 315 || $windDeg < 45)
    $windDir = 'Северный';
  elseif($windDeg >= 45 && $windDeg < 135)
    $windDir = 'Восточный';
  elseif($windDeg >= 135 && $windDeg < 225)
    $windDir = 'Южный';
  elseif($windDeg >= 225 && $windDeg < 315)
    $windDir = 'Западный';
 
?> 

<!--<div class="col-12 col-md-5 mb-md-0 mb-4 pl-5">
	<div class="d-flex justify-content-start main_page_weather" >
		
		<div class=" " style="width: 60px;">		
			<img src="/slider/main/termom_icon.png" style="">
		</div>
		<div class=" " style="margin-top: 25px;">

			<div class="d-flex justify-content-start mb-4" >
				<img src="/slider/main/wind_icon.png" style="">
				<div class="wind_text"><?=$windDir?>, <?=round($weatherData->wind->speed)?> м/с</div> 		
			</div>
			<div class="d-flex justify-content-start" >
				<img src="/slider/main/degrees_icon.png" style="">
				<div class="degrees_text"><?=round($weatherData->main->temp)?>°C</div>			
			</div>

		</div>
	</div>

</div> 

<?
}
?>

<!--ВИДЖЕТ ПОГОДЫ-->

<!--ВИДЖЕТ КАНАТНЫХ ДОРОГ ВЕРНЫЙ-->
   <!-- <div class="col-12 col-md-7">

      <div class="row" style="margin-top: -15px;">

        <div class="col-12 col-md-3" style="padding: 10px !important;">
          <span class="kd_title kd_title_desc">Работа Канатных Дорог</span>
        </div>

        <div class="col-12 col-md-9">      
          <? 
          require_once($_SERVER['DOCUMENT_ROOT']."/worktime/small.php"); 
          ?>
      </div>

    </div>

  </div>

</div>-->
<!--ВИДЖЕТ КАНАТНЫХ ДОРОГ ВЕРНЫЙ-->



<!--<div class="callback_vidjet">
  <div class="col-md-3 cart_form">
    <p class="bottom_menu_caption">Заказать звонок</p>
    <form id="order_send_form" name="order_send_form" action="/">
      <div class="form-group mt-3">
        <input type="text" required id="order_send_name" class="form-control" placeholder="Имя">
      </div>
      <div class="form-group mt-3">
        <input type="numb" required id="order_send_email" class="form-control" placeholder="Телефон">
      </div>
      <div class="form-group mt-3">
       <textarea style="height: 75px;" required placeholder="Сообщение" id="order_send_message" class="form-control"></textarea>
      </div>
     <input type="submit" id="order_send" name="order_apply" class="btn-submit text-uppercase" value="Отправить">

    </form>
  </div>
</div>


<style type="text/css">
.callback_vidjet .form-control  {
  background-color: white;
  border-color: gray;
  color: gray;
}
.callback_vidjet .bottom_menu_caption {
color: grey;
margin-top: 20%;
text-align: center;
}

.callback_vidjet #order_send {

width: 100%;
height: 50px;

}
.callback_vidjet {
display: none; }
@media only screen
and (min-device-width : 320px)
and (max-device-width : 480px){ .callback_vidjet { display: inline; }}
}
</style>-->

<!--<div class="callback_whatsapp">
    <div class="d-md-flex d-block justify-content-around">
      <div class="prices_div"> 
        <a href="https://wa.me/77774015340" >Написать на WhatsApp</a>
    </div>
 </div>
</div>    
<style type="text/css">
  .callback_whatsapp a{
    text-decoration: none; 
    color: white; 
    background-color: #7ab734; 
    height: 50px; 
    display: block; 
    width: 92%; 
    text-align: center; 
    font-size: 20px; 
    margin: 0 15px 0 15px; 
    padding: 14px; 
    margin-bottom: 20%;
  }
  .callback_whatsapp {
    display: none; }
    @media only screen
    and (min-device-width : 320px)
    and (max-device-width : 480px){ .callback_whatsapp { display: inline; }}
}
 </style> -->
</div>



<!--ПАНТОЛЕЧЕНИЕ ЗАГОЛОВОК-->
<div class="container pt-3"> 


        <div class="row main_title_div" >

          <div class="col-12">
            <H1 class="main_title">ПАНТОЛЕЧЕНИЕ</H1>
          </div>

          <div class="col-12" style="padding: 10px 0 0 0px !important;">
            <span class="kd_title">Бренд Восточного Казахстана</span>
          </div>

        </div>
</div>
<style type="text/css">
          @font-face {
            font-family: "BebasNeue";
            src: url("/pdf/BebasNeue-Regular-Bold.ttf");
            font-style: normal;
            font-weight: normal; 
          }
          .main_title_div{
             margin:25px auto;
             color: #4C4C4C;
          }
          .main_title{
            font-size: 100px;
            line-height: 70px;
           font-family: BebasNeue, sans-serif;
           text-align: center;
           display: block;
          }
          .kd_title {
            font-size: 30px;
            color: #4C4C4C;
            text-transform: uppercase;
            word-break: break-word;
            text-align: center;
            display: block;
            line-height: 26px;
          }
          @media(max-width:768px){

            .main_title{
              font-size: 50px;
              line-height: 20px;
              color: #4C4C4C;
            }
            .main_title_div > div{
              align-items: center;
            }
            .kd_title {
              font-size: 20px;
              line-height: 14px;

              color: #4C4C4C;
            }
          }
        </style>

<!--ПАНТОЛЕЧЕНИЕ ЗАГОЛОВОК-->

 
<div class=" mt-5 pt-md-3 pt-0 mb-4"> 
  <div class="row ">

    <div class="col-12 col-md-6">
      <p> Круглый год Горнолыжный курорт «Алтайские Альпы» с восточным радушием и европейским сервисом встречает любителей активного отдыха и тех, кто желает провести свой отпуск с пользой для здоровья в окружении красивейшей природы. Каждое время года здесь – это время  открытий и непередаваемой красоты. Весной горы покрыты ярким ковром трав. В разгар лета зеленые склоны усыпаны ягодами смородины, шиповника, малины и земляники, аромат которых разлит в чистейшем горном воздухе. Осень на Алтае – особый сезон. Смешанный лес переливается всей палитрой красок, завораживая взгляды и сердца. Ну, а с первыми снежинками «Алтайские Альпы» преображаются в один из самых популярных горнолыжных курортов Казахстана. Лыжники и сноубордисты со всего мира, ежегодно стекаются на горнолыный курорт в поиске настоящего снега и незабываемых эмоций. Стоит отметить, что абонемент на канатные дороги и ценник в отеле значительно ниже, чем у горнолыжных гигантов, расположившихся по-соседству.</p>
    </div>
    <div class="col-12 col-md-6">
      <iframe style="width: 100%;" width="560" height="450" src="https://www.youtube.com/embed/4sWmtLJcORo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

  </div>
</div>  



</div>  



<div class="main_services mb-0 mt-5" >

  <div class="container">

    <div class="row">

     <div class="col-6 col-md-2">
        <div>                            
          <a href="/worktime/">
            <img class="main_serv" src="/slider/main/kd.png">
            <img class="hover_serv" src="/slider/main/kd2.png">
          </a>
        </div>
        <div class="main_services_counts mob_services_counts" >
          <div>5</div>
          <div>канатных дорог</div>                    
        </div>
      </div>
     <div class="col-6 col-md-2">
        <div>                            
          <a href="/equipment-rent/">
            <img class="main_serv" src="/slider/main/rent.png" >
            <img class="hover_serv" src="/slider/main/rent2.png" >
          </a>
        </div>
        <div class="main_services_counts mob_services_counts" >
          <div>2</div>
          <div>проката снаряжения</div>
        </div>
      </div>
     <div class="col-6 col-md-2">
        <div>                            
          <a href="/worktime/">
            <img class="main_serv" src="/slider/main/hillside.png" >
            <img class="hover_serv" src="/slider/main/hillside2.png" >
          </a>
        </div>
        <div class="main_services_counts mob_services_counts" >
          <div>12</div>
          <div>укатанных склонов</div>
        </div>
      </div>
     <div class="col-6 col-md-2">
        <div>                            
          <a href="/rooms/">
            <img class="main_serv" src="/slider/main/house.png" >
            <img class="hover_serv" src="/slider/main/house2.png" >
          </a>
        </div>
        <div class="main_services_counts mob_services_counts" >
          <div>43</div>
          <div>гостевых номера</div>
        </div>
      </div>
     <div class="col-6 col-md-2">
        <div>                            
          <a href="/cafe/">
            <img class="main_serv" src="/slider/main/cafe.png" >
            <img class="hover_serv" src="/slider/main/cafe2.png" >
          </a>
        </div>
        <div class="main_services_counts mob_services_counts" >
          <div>2</div>
          <div>кафе</div>
        </div>
      </div>
     <div class="col-6 col-md-2">
        <div>                               
          <a href="/pavilions/">
            <img class="main_serv" src="/slider/main/hut.png" >
            <img class="hover_serv" src="/slider/main/hut2.png" >
          </a>                         
        </div>
        <div class="main_services_counts mob_services_counts" >
          <div>12</div>
          <div>теплых беседок</div>
        </div>
      </div>

    </div>

  </div>

</div>


<div class="main_services_counts mb-0 mt-0 d-md-block d-none" >

  <div class="container">

    <div class="row">
     <div class="col-6 col-md-2">
        <div>5</div>
        <div>канатных дорог</div>
      </div>
     <div class="col-6 col-md-2">
        <div>2</div>
        <div>проката снаряжения</div>
      </div>
     <div class="col-6 col-md-2">
        <div>12</div>
        <div>укатанных склонов</div>
      </div>
     <div class="col-6 col-md-2">
        <div>43</div>
        <div>гостевых номера</div>
      </div>
     <div class="col-6 col-md-2">
        <div>2</div>
        <div>кафе</div>
      </div>
     <div class="col-6 col-md-2">
        <div>12</div>
        <div>теплых беседок</div>
      </div>
    </div>

  </div>

</div>



<div class="container">  

<div class="mt-5 mb-3">


<div class="row mb-4">
  
  <div class="col-12 col-md-6">            
    <h2>Почему мы?</h2> 
    <p>Горнолыжный курорт «Алтайские Альпы» является одним из значимых объектов зимнего отдыха на рынке туристических услуг Казахстана благодаря ряду особенностей, которые делают его очень привлекательным для любителей лыж и сноуборда:</p>
     <p>1. Более длинный горнолыжный сезон. Пока жители южных городов баюкают свое снаряжение в ожидании первого обильного снегопада, в «Алтайских Альпах» сезон в самом разгаре. Уже в ноябре высота снежного покрова здесь достигает полутора метров! Снег идет регулярно в течение всего сезона, который длится обычно до середины апреля, и нет надобности «подсыпать» трассы, и тем более нет необходимости использовать снеговые пушки для искусственного снега. Многие гости, катавшиеся на горнолыжных курортах Европы крайне удивлялись нашему мягкому и необледенелому снегу, а дело вот в чем: обледенелое покрытие трасс сильно усложняет управлеяемость горными лыжами и сноубордом. Особенно заметно это для начинающих и продолжающих лыжников и сноубордистов.</p>
  </div>
  <div class="col-12 col-md-6">
    <iframe style="width: 100%; margin-top: 55px;" width="560" height="450" src="https://www.youtube.com/embed/FGGwKXo7A9w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>

</div>


<div class="row mb-4">
  
  <div class="col-12 col-md-6">
    <p>2. Широкое разнообразие склонов и канатных дорог. Территория нашего курорта славится изобилием склонов различной степени сложности — от «зеленых» до «черных» трасс. Огромное внимание уделяется пологим склонам для обучения горным лыжам и сноуборду. Количество канатных дорог растет из года в год, позволяя тем самым минимизировать очереди. Все трассы для профессионального уровня катания имеют международный сертификат FIS.  Для экстремалов так же найдется много мест для получения своей порции адреналина, в том числе и спуски по целине и лесу. Говоря о фрирайде в наших широтах, можно смело выделить в отдельный пункт - количестве снега, в соотношении к количеству катающихся. Хороший паудер (Пушистый, легкий снег) после снегопада - обеспечивает внетрассовых райдеров недельным развлечением. Если говорить простым языком, то снега выпадает в таком количестве, что его даже раскатывать не успевают. <br> Одним из преимуществ нашего курорта является отсутствие очередей на канатных дорогах, кататься можно свободно, никто друг другу не мешает и это большой плюс. </p>
  </div>
  <div class="col-12 col-md-6">
    <iframe style="width: 100%;" width="560" height="450" src="https://www.youtube.com/embed/XeDw1vXlp6E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>

</div>


<div class="row mb-3">
  
  <div class="col-12 col-md-6">
    <p>3. Отличный сервис. Каждому клиенту мы предлагаем широкий спектр дополнительных услуг, среди которых:<br> - Прокат снаряжения (лыж и сноубордов); <br>предоставление теплых беседок для шашлыков или просто дружеских посиделок в приятной компании;<br> - Проживание в комфортабельных альпийских домиках с уютными номерами и живописными видами за окном;<br> - Вкусное и сытное питание в наших кафе; <br>- Процедуры курортно-санаторного лечения,</p>   <p>4. Доступные цены и выгодные акции. Одним из главных преимуществ нашего курорта являются доступные цены. Мы гарантируем, что как минимум на территории Казахстана вы точно не найдете горнолыжного комплекса, более выгодного по соотношению «цена-качество»! <br> Алтайские Альпы единственный горнолыжный курорт в Казахстане, который предлагает своим гостям самый выгодный тур по системе «Всё включено».</p>
  </div>
  <div class="col-12 col-md-6">
    <iframe style="width: 100%;" width="560" height="450" src="https://www.youtube.com/embed/_c8IGaVEWhY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>

</div>


</div> 


</div>

 
<style type="text/css">

 .item_rev {
   border-radius: 10px;
   overflow: auto;
   height: 100%;
   box-shadow: 0px 3px 6px #0000003d;
   position: relative;
 }
.item_rev img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
 .inner-item{
   height: 100%;
   overflow: hidden;
   padding-bottom: 60px;
   background: #3d5f73;
   color: white;
 }

 .item_rev .title {
    text-align: left;
    text-decoration: none;
    color: #000;
    padding: 15px;    
    position: relative;
    background: white;
    text-transform: uppercase;
    font-size: 20px;
    font-weight: bold;
}
 .item_rev .title a{
    color: #000;
 }
 .item_rev .text_block {
    text-align: left;
    text-decoration: none; 
    padding: 20px;  
    height: 100px;
    overflow: hidden;
    text-overflow: ellipsis;
    position: relative;  
}
.news_row .item_rev:nth-child(2n) .inner-item{
   background: #f7f7f7;
   color: black;
} 
.news_row .item_rev:nth-child(2n) .what_included span{
   background: transparent !important;
   color: #3d5f73 !important; 
} 
.what_included a{ 
   text-decoration: none;
    font-size: 16px;
}

.what_included{
   position: absolute !important;
   width: 100%;
   bottom: 0;
   padding-right: 30px;
   margin: 15px 0 10px !important;
   text-align: left;
} 
.what_included span {
    background-color: transparent;
    color: white;
    padding: 10px 30px 13px 20px;
    border-radius: 20px;
    width: 80%;
    display: block;
    margin: 0;
    font-size: 16px;
    text-decoration: underline;
} 
.what_included:hover span{
  box-shadow: none !important;
}

.news_row > div {
  margin-bottom: 30px;
  padding-bottom: 30px !important;
} 

.image.shine{
   height: 310px;
}   

.slider_special_rew{
    margin: 40px 0;
}
.slider_special_rew img{
  width: 100%; 
}
.slider_special_rew .slick-slide{
  margin: 0 10px 0 10px;
}

@media(max-width:768px){

  .slick-prev{
      left: 5px !important;
    }
  .slick-next{
    right: 35px;
  }
  .slider_special .slick-slide, .slider_special2 .slick-slide{
    margin: 0 5px 0 5px !important;
  }
  .what_included a{
    font-size: 16px;
  }
  .what_included{
    padding-right: 0px;
  }
  .what_included span{
    padding: 10px !important;
  }
  .image.shine{
    height: 250px;
  }
  .item_rev .text_block{
    padding: 10px !important;
    height: 75px !important;
  }
  .item_rev .title {
    font-size: 16px !important;
    padding: 10px !important;
    height: 40px;
    display: flex;
    align-items: center;
  }
  .inner-item{
    padding-bottom: 55px;
  }

}


</style>



<!--

<div class="slider_special2  dots-over">
      
    <div class="item"> 
      <a href="/slider/gallery/m1.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m1.jpg"></a>
    </div> 
    <div class="item"> 
      <a href="/slider/gallery/m2.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m2.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/gallery/m3.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m3.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/gallery/m4.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m4.jpg"></a>
	</div>
    <div class="item"> 
      <a href="/slider/gallery/m5.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m5.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/gallery/m6.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m6.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/gallery/m7.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m7.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/gallery/m8.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m8.jpg"></a>
	</div>
    <div class="item"> 
      <a href="/slider/gallery/m9.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m9.jpg"></a>
	</div>
    <div class="item"> 
      <a href="/slider/gallery/m10.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m10.jpg"></a>
    </div>
	<div class="item"> 
      <a href="/slider/gallery/m11.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m11.jpg"></a>
    </div>
	<div class="item"> 
      <a href="/slider/gallery/m12.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m12.jpg"></a>
    </div>
	    <div class="item"> 
      <a href="/slider/gallery/m13.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m13.jpg"></a>
    </div>
	    <div class="item"> 
      <a href="/slider/gallery/m14.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m14.jpg"></a>
    </div>
	    <div class="item"> 
      <a href="/slider/gallery/m15.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m15.jpg"></a>
    </div>
	    <div class="item"> 
      <a href="/slider/gallery/m16.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m16.jpg"></a>
    </div>
	    <div class="item"> 
      <a href="/slider/gallery/m17.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m17.jpg"></a>
    </div>
	    <div class="item"> 
      <a href="/slider/gallery/m18.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m18.jpg"></a>
    </div>
	    <div class="item"> 
      <a href="/slider/gallery/m19.jpg" data-fancybox="gallery_22"><img src="/slider/gallery/m19.jpg"></a>
    </div>
	

</div>-->


<style type="text/css">

/* @font-face {
  font-family: "BebasNeue";
  src: url("/pdf/BebasNeue-Regular-Bold.ttf");
  font-style: normal;
  font-weight: normal; 
} */


  .inner-hero__video {
      width: 100%;
      height: auto;
      margin-top: 0px;
  }

    #main_page_top_iframe{
      width: 100%;
      height: 550px;
    }

   .slider img{
      width: 100%;
   } 
   .slider .slick-dots li button {
       border-radius: 50%;
       border: 2px solid #3d5e73 !important;
       width: 17px;
       height: 17px;
   }
   .slider .slick-dots li.slick-active button {
       background: linear-gradient(0deg, #3d5e73, #3d5e73), #FFFFFF;
   }
   .slider .slick-dots li button {
     /* font-size: 0; */
     /* line-height: 0; */
     display: block;
     width: 20px;
     height: 20px;
     padding: 5px;
     cursor: pointer;
     color: transparent;
     border: 0;
     outline: none;
     background: transparent;
   }
   .slider .slick-dots li button:before{
      content: ''  !important;
   }
   .slider .slick-dots{
      bottom: 40px !important;
   }

   body{
    background-color: #fff !important; 
   }





  .slider_special, .slider_special2{
    margin: 40px 0;
  }
  .slider_special img, .slider_special2 img{
    width: 100%;
    margin: 10px;
  }
  .slider_special .slick-slide, .slider_special2 .slick-slide{
    margin: 0 10px 0 0;
  }

  .slick-next{
    right: 35px;
  }
  .slick-prev{
    left: 35px;
    z-index: 1;
  }
  .slick-prev:before {
    content: '';
    background-image: url('/slider/arrow_left_color.png');
    background-size: 100%;
    background-repeat: no-repeat;
    width: 30px;
    height:30px;
    position: absolute;
    top: 50%;
    top: -30%;
  }
  .slick-prev:hover:before {
    content: '';
    background-image: url('/slider/arrow_left_color_push.png'); 
  }
  .slick-next:before {
    content: '';
    background-image: url('/slider/arrow_right_color.png');
    background-size: 100%;
    background-repeat: no-repeat;
    width: 30px;
    height:30px;
    position: absolute;
    top: -30%;
  }
  .slick-next:hover:before {
    content: '';
    background-image: url('/slider/arrow_right_color_push.png'); 
  }


</style>
 



<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>