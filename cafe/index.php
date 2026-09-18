<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Питание");
$APPLICATION->SetPageProperty("keywords", "вкусная еда, домашняя кухня, атмосферное кафе, сугроб, альпийское");
$APPLICATION->SetPageProperty("description", "Где вкусно покушать на курорте? К Вашим услугам - Два атмосферных кафе");
$APPLICATION->SetTitle("Питание в Кафе");
?>


<img src="/slider/cafe/banner_cafe.jpg" style="width: 100%" class="inner-hero__video d-md-block d-none"></img>

<img src="/slider/cafe/banner_cafe_mob.jpg" style="width: 100%" class="inner-hero__video d-md-none d-block"></img>
<!--<img style="width: 100%;" src="/slider/cafe/banner_cafe.jpg">-->



<div class="cottages_search_div mt-0"  style="margin: 0; padding: 0;">
  <div class="container">
    <div class="row">          
      <div class="col-12 ">
        <span class="contacts_page_title" style="color: #fff; margin-top: 10px; margin-bottom: 10px;">Альпийское кафе</span>
      </div>
    </div>     
  </div>
</div>

<div class="blue_back"> 

   <div class="container container_narrow"> 

      <div class="row mt-3 mb-4">
          
          <div class="col-12 col-md-8 mb-3"> 

            <p style="text-align: left;">Альпийское кафе расположено на исторической территории базы, в центральном гостиничном корпусе. 
            <br> Помещение кафе частично разделено на два этажа. Первый этаж – это большой основной зал с высокими потолками на 100 посадочных мест и четыре отдельные беседки «берёзовая роща». Свое название наша «роща» получила благодаря берёзовым декоративным стойкам, напоминающим настоящий берёзовый лес. Также на первом этаже расположен электрокамин, у которого можно погреться в холодную погоду или просто сделать красивое фото. 
            <br> Второй этаж представляет собой так называемую «террасу» на 20 персон, с 4-ех местными столиками. 
            <br>Круглый год в Альпийском кафе проводится множество различных мероприятий. Большой зал отлично подходит для проведения вечеринок, больших торжеств или просто посиделок с друзьями, корпоративных мероприятий и других культурно-массовых развлечений. Здесь можно заказать комплексный обед или выбрать блюдо из меню. Вкусная домашняя кухня из Европейских и Национальных блюд не оставит равнодушным ни одного гостя. Салаты, первые и вторые блюда, казахский чай с алтайским мёдом или вкусный компот из натуральных фруктов, выпечка, блинчики, вкусные и полезные завтраки – и это только малая часть того, что есть в Альпийском кафе. Никаких полуфабрикатов и ГМО, готовим только из свежих и натуральных продуктов, выращенных на местных фермах Восточного-Казахстана.  
            <br>Также в кафе работает бар с большим выбором алкогольной и безалкогольной продукции. </p>                

          </div>

          <div class="col-12 col-md-4 d-flex justify-content-start flex-wrap pl-md-5" >  

            <div>
              <p class="cafe_common_price">Средний чек на комплексное питание</p>
              <p class="price_p"><span class="instructor_price">6 000 KZT</span></p>
            </div>
            
            <div class="mt-3 mb-4">
              <p class="cafe_common_price">Средний чек на один прием пищи</p>
              <p class="price_p"><span class="instructor_price">2 500 KZT</span></p>
            </div>

            <div class="cafe_base_prices">
              <div class="d-flex justify-content-start align-items-center mb-4">
                <div class="mr-3">
                  <img src="/slider/cafe/wifi_gold.png"  >
                </div>
                <div>
                  <span style="color: #ffe700;">Зона WI-FI</span>
                </div>
              </div>

              <div class="d-flex justify-content-start align-items-center mb-4">
                <div class="mr-3">
                  <img src="/slider/cafe/beznal_gold.png">
                </div>
                <div>
                  <span style="color: #ffe700;">Оплата картой</span>
                </div>
              </div>

              <div class="d-flex justify-content-start align-items-center mb-4">
                <div class="mr-3">
                  <img src="/slider/cafe/nal_gold.png"  >
                </div>
                <div>
                  <span style="color: #ffe700;">Оплата наличными</span>
                </div>
              </div>

            </div>

          </div>


      </div>

  </div>

</div>



<div class="slider_special dots-over">
      
    <div class="item"> 
      <a href="/slider/cafe/alps1.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/alps1.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/alps2.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/alps2.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/alps3.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/alps3.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/alps4.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/alps4.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/alps5.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/alps5.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/alps6.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/alps6.jpg"></a>
    </div>
</div>
 

<script type="text/javascript"> 

  $('.slider_special').slick({
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

</script>


<div class="cottages_search_divas mt-5" style="background-color: #fff; margin: 0; padding: 0;">
  <div class="container">
    <div class="row">          
      <div class="col-12 ">
        <span class="contacts_page_title" style="color: #000;">Кафе сугроб</span>
      </div>
    </div>     
  </div>
</div>

<div class="white_back"> 

   <div class="container container_narrow"> 

	    <div class="row mt-3 mb-4">
          
          <div class="col-12 col-md-8" style="text-align: left;">
             
            <p>Кафе Сугроб расположено в восточной части Горнолыжного курорта Алтайские Альпы. Рядом с 3-й кресельной канатной дорогой, ведь после катания на горных лыжах так хочется погреться, перекусить и выпить горячего чая. Кафе достаточно «молодое», и было открыто в конце 2017 года, но сразу же нашло свою популярность среди гостей за уютную атмосферу и вкусную еду.</p>  
            <p>Кафе разделено на 3 зоны.<br> Первая, сразу слева от входа – Фуд-Корт, где гости могут быстро перекусить и продолжить нарезать дугообразный рисунок на склоне! Шаурма от Шефа, хот-доги и гамбургеры, салаты, горячие и холодные напитки – всё это вы можете покушать в нашем Фуд-Корте.</p>

            <p>В основном здании, есть специально отведенное место для хранения Вашего инвентаря, откуда через коридор пролегает путь во вторую часть кафе. Небольшое уютное помещение с настоящим дровяным камином, столиками и скамьями. Особую изюминку этому залу придают декоративные стволы берёз. Здесь же расположен бар, в котором большой выбор алкогольных и безалкогольных напитков, коктейлей и натуральный кофе.  </p>

            <p>На втором этаже кафе «Сугроб» расположен самый большой его зал на 50 персон. Комфортные кожаные диванчики. Нередко помещение используется гостями для проведения торжеств и корпоративов с небольшим количеством гостей.  Еда кафе разнообразная и вкусная. Всегда свежая выпечка, первые и вторые горячие блюда, шашлык, салаты и гарниры. Блюда национальной кухни из мяса халяль.</p>
             

          </div>


          <div class="col-12 col-md-4 d-flex justify-content-start flex-wrap pl-md-5" >  
            
            <div class="mt-4 mt-md-0 mb-4">
              <p class="cafe_common_price">Средний чек на один прием пищи</p>
              <p class="price_p"><span class="instructor_price">3 200 KZT</span></p>
            </div>

            <div class="cafe_base_prices">
              <div class="d-flex justify-content-start align-items-center mb-4">
                <div class="mr-3">
                  <img src="/slider/cafe/wifi_green.png"  >
                </div>
                <div>
                  <span style="color: #7bb832;">Зона WI-FI</span>
                </div>
              </div>

              <div class="d-flex justify-content-start align-items-center mb-4">
                <div class="mr-3">
                  <img src="/slider/cafe/beznal_green.png">
                </div>
                <div>
                  <span style="color: #7bb832;">Оплата картой</span>
                </div>
              </div>

              <div class="d-flex justify-content-start align-items-center mb-4">
                <div class="mr-3">
                  <img src="/slider/cafe/nal_green.png"  >
                </div>
                <div>
                  <span style="color: #7bb832;">Оплата наличными</span>
                </div>
              </div>

            </div>

          </div>

      </div>

  </div>

</div>



<div class="slider_special2 dots-over">
      
    <div class="item"> 
      <a href="/slider/cafe/sug 1.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/sug 1.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/sug 2.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/sug 2.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/sug 3.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/sug 3.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/sug 4.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/sug 4.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/sug 5.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/sug 5.jpg"></a>
    </div>
    <div class="item"> 
      <a href="/slider/cafe/sug 6.jpg" data-fancybox="gallery_22"><img src="/slider/cafe/sug 6.jpg"></a>   
    </div>

</div>

<style type="text/css">
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

<script type="text/javascript"> 

  $('.slider_special2').slick({
    dots: false,
    //lazyLoad: 'ondemand',
    infinite: true,
    arrows: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    //centerMode: true,
    //centerPadding: '150px',
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

</script>


<script type="text/javascript">
	$(document).on('click', '.what_included', function(){
		$(this).parent().next().slideToggle();
	});
</script>

<style type="text/css">
  .cafe_base_prices img{
    width: 45px;
  }
  .prices_div{        
    margin: 40px 0;
  }
	.what_included{
		margin: 20px 0 30px 0;
    cursor: pointer;
	}
  .what_included span{
    font-size: 16px;
    background-color: #7ab734;
    color: white;
    padding: 10px 30px;
    border-radius: 20px;
  }
  .price_p{
    font-size: 20px; 
    margin: 10px 0;  
  }
	.instructor_price{
		font-size: 44px;
		line-height: 30px;
	}
  .cafe_common_price{
    text-transform: uppercase;
    font-size: 24px;
    line-height: 22px;
  }
	@media (max-width: 768px){
  	.instructor_price{
  		display: block;
      line-height: 30px;
  	}
  	.what_included{
  		margin: 20px 0 30px 0 !important;
  	}
  }
  .blue_back{
    background-color: #3d5f75;
    padding: 20px 0;
  }
  .blue_back *{ 
    color: white;
    text-align: left;
  }
  .white_back{ 
    padding: 20px 0;
  }
  .white_back *{
    text-align: left;
    color: #000;
  }
</style>




<img style="width: 100%;" src="/slider/cafe/coffee_banner.jpg">

 


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>