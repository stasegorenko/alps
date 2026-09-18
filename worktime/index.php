<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Склоны");
$APPLICATION->SetPageProperty("keywords", "Канатная дорога, склон, могул, учебный, слалом, серпантин, 3ккд, альпы, тренировочный, профи");
$APPLICATION->SetPageProperty("description", "Пять канатных дорог, а также: просторные горнолыжные склоны на любой вкус и цвет.");
$APPLICATION->SetTitle("Горнолыжные склоны");
?>



<div class="position-relative">
  <a data-fancybox="gallery_slopes_banner" href="/slider/slopes_banner.png">          
    <img src="/slider/slopes_banner.png" style="width: 100%;"> 
    <svg viewBox="0 0 24 24" id="zoom"><title>zoom</title><path fill="currentColor" d="M21 19.59l-5.4-5.4a7 7 0 1 0-1.41 1.41l5.4 5.4zM10 15a5 5 0 1 1 5-5 5 5 0 0 1-5 5zm3-4.57h-2.57V13h-.86v-2.57H7v-.86h2.57V7h.86v2.57H13z"></path></svg>         
  </a>
</div>


<div class="container">

  <div class="row mt-2 mt-md-5">

    <div class="col-12 col-md-5 mb-md-0 mb-4">  </div>

    <div class="col-12 col-md-7">

      <div class="row">

        <div class="col-12 col-md-3" style="padding: 0 5px 0 0 !important;">
          <span class="kd_title">Работа Канатных Дорог</span>
        </div>

        <div class="col-12 col-md-9"> 
          <? 
          include 'small.php';  
          ?>

        </div>

      </div>

    </div>

  </div>

  <div style="clear: both;"></div>

  <div class="d-md-flex d-block justify-content-end">

    <div id="kkd_ajax_trigger_price_div" class="mr-md-3">
      <!--<img id="kkd_ajax_trigger" src="/slider/schedule_button.png" style="float: right;margin:30px 0; cursor: pointer;">-->
      <a id="kkd_ajax_trigger_price" class="what_included" href="/pdf/kanatki_price.pdf" target="_blank" >
        <span  style="background-color: #ff7300; ">Прайс - лист</span> 
      </a>
    </div>  

    <div id="kkd_ajax_trigger_div">
      <!--<img id="kkd_ajax_trigger" src="/slider/schedule_button.png" style="float: right;margin:30px 0; cursor: pointer;">-->
      <a id="kkd_ajax_trigger" class="what_included"  >
        <span>Расписание</span> 
      </a>
    </div> 
  </div>

  <div style="clear: both;"></div>
 
</div>



<section class="mt-3 mb-5" style="background-color: #3d5f71;">

  <div class="container">
    <div id="kkd_ajax">
      <?
      //include 'ajax.php';  
      ?>
    </div>          
  </div>

  <script>

    $(document).on('click', "#kkd_ajax_trigger", function(){

      if($('#kkd_ajax').is(':visible')) {
        $("#kkd_ajax").html('');                   
        $("#kkd_ajax").hide();
        return;
      }

      $.post(
        '/worktime/ajax.php',
        { 
        },
        function(data) { 

          //var taget_div = $('.kd_div', $.parseHTML(data)); 
          $('#kkd_ajax').html(data);
          $('#kkd_ajax').slideDown();
        }
      )

      return false;

    });

  </script>

</section>


<div class="container">

  <div class="position-relative">
    <a data-fancybox="gallery_slopes_banner" href="/slider/slopes.png">          
      <img src="/slider/slopes.png" style="width: 100%;"> 
      <svg viewBox="0 0 24 24" id="zoom"><title>zoom</title><path fill="currentColor" d="M21 19.59l-5.4-5.4a7 7 0 1 0-1.41 1.41l5.4 5.4zM10 15a5 5 0 1 1 5-5 5 5 0 0 1-5 5zm3-4.57h-2.57V13h-.86v-2.57H7v-.86h2.57V7h.86v2.57H13z"></path></svg>         
    </a>
  </div> 

</div>


<section class="mt-4" style="background-color: #f7f7f7;">
  
  <div class="container slopes_info">
    <div class="row"> 

      <div class="col-12 col-md-4">
        <h2>Канатные дороги</h2>
        <p>В виду географического положения, канатные дороги (подъемники) расположены в двух горных массивах, захватывая при этом восточную и западную их стороны. </p>   
        <p>Все канатные дороги можно разделить на два типа:<br>  1. «Бугельные, или как их еще называют - якорные подъемники» <br>2. «Кресельные подъемники». </p>                
      </div>           
      <div class="col-12 col-md-4">
        <h2>БКД «МАСТЕР»</h2>
        <p>Высота у нижней разворотной станции - 640 метров над уровнем моря. <br>Высота на верхней разворотной станции - 840 метров над уровнем моря. <br>Длина канатной дороги: - 730 м. <br>Время подъема: 4,5 мин. <br>Перепад высот:  - 200 м. <br>Максимальный уклон: 33,6% <br>Средний уклон: 22,3% <br>Количество мест за 1 подъем – 46</p>                
      </div>           
      <div class="col-12 col-md-4">
        <h2>БКД «СТАРТ»</h2>
        <p>Высота у нижней разворотной станции - 680 м (над уровнем моря).<br> Высота на верхней разворотной станции - 810 м (над уровнем моря).<br> Длина канатной дороги - 764 м.<br> Время подъема: 4,4 мин.<br> Перепад высот: - 150 м. <br>Максимальный уклон: 16,4%<br> Средний уклон: 10,1%<br> Количество мест за 1 подъем – 44</p>                
      </div>           
      <div class="col-12 col-md-4">
        <h2>ККД  КАРУСЕЛЬ 1</h2>
        <p>Высота у приводной станции - 670 м (над уровнем моря). <br>Высота на верхней разворотной станции - 870 м (над уровнем моря). <br>Длина канатной дороги - 950 м. <br>Перепад высот - 200 м. <br>Максимальный уклон: 26,9% <br>Средний уклон: 16,2%<br> Количество мест в 1 сторону - 84. </p>                
      </div>           
      <div class="col-12 col-md-4">
        <h2>ККД  КАРУСЕЛЬ 2</h2>
        <p>Высота у приводной станции - 860 м (над уровнем моря). <br>Высота на верхней разворотной станции - 980 м (над уровнем моря). <br>Длина канатной дороги - 900 м. <br>Перепад высот: - 120 м.<br> Максимальный уклон: 30,4% <br>Средний уклон: 16,5% <br>Количество мест в 1 сторону - 84. </p>                
      </div>          
      <div class="col-12 col-md-4">
        <h2>БКД ЭХО</h2>
          <p>Высота у приводной станции –980  (над уровнем моря).<br>
          Высота на верхней разворотной станции - 1006 м (над уровнем моря).<br>
          Длина канатной дороги - 180 м.<br>
          Перепад высот: - 26 м.<br>
          Максимальный уклон: 30%<br>
          Средний уклон: 18%<br>
          Количество мест в 1 сторону - 10.</p>  
               
      </div>
    </div>

  </div>

</section>


  <div class="container mt-4">
    Ведется строительство новых канатных дорог в северном направлении. Данные канатные дороги обеспечат доступ к склону «Алтайский», наиболее оптимальному по протяженности (2000 метров) и перепаду высот (360 метров). Также канатные дороги откроют райдерам новые возможности в дисциплине «Фрирайд». Напомним, что сейчас посетить данный участок  маршрута возможно лишь воспользовавшись услугой подъема на Ратраке (Специальном транспортном средстве на гусеничном ходу, используемом для подготовки горнолыжных склонов и лыжных трасс).<br><br>
    Один подъем на Ратраке для группы райдеров из 15 человек составит 20 000 KZT

  </div>

<div class="common_header_div  mt-5">

  <div class="container">

    <div class="row">
      
      <div class="col-12 ">
        <span class="common_page_title" style="color: #fff;">Склоны</span>
      </div>                

    </div>
 
  </div>

</div>








<div class="container mb-5">


   <div class="slopes_list_mob_hidden">
   
    <div class="row mt-5 pt-md-1 pt-0 mb-md-4">
            
      <div class="col-12 col-md-6 order-md-1 order-2">
        <h3>Склон «Панорама»</h3>
        <div class="slopes_desc_mob_hidden">
          <p>Склон "Панорама" это новая трасса, замыкающая логистическую цепочку между кресельными канатными дорогами Карусель 1(ККД 3) и Карусель 2 (ККД 4). Географически, склон находится в самом потрясающем месте Горнолыжного курорта, ведь именно он берет свое начало с наивысшей отметки.
          Панорама идеально подходит не только для новичков, но и для опытных райдеров, которые с полной ответственностью подходят к разминочным спускам.
          <br>-  Длина склона - 1000м., но благодаря прямому соединению с склоном "Серпантин", можно промчаться все 2 200 метров.
          <br>- Перепад высот - 130м., с учетом склона "Серпантин" - 330м.</p>
        </div>
          
      </div>
      <div class="col-12 col-md-6 order-md-2 order-1 mb-3" style="text-align: center;">
        <iframe width="560" height="450" src="https://www.youtube.com/embed/YGAsnP4S2pc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div>

    </div>

    <div class="mob_more_button">  
      <p class="mob_more_button_open">Подробнеe</p>
      <p class="mob_more_button_close">Скрыть</p>
    </div> 

  </div> 

  <div class="slopes_list_mob_hidden">
   
    <div class="row mt-5 pt-md-1 pt-0 mb-md-4">
            
      <div class="col-12 col-md-6 order-md-1 order-2">
        <h3>Склон «Учебный»</h3>
        <div class="slopes_desc_mob_hidden">
          <p>На наш взгляд, именно так должен выглядеть учебный склон на горнолыжном курорте. <br> - Широкое полотно спуска; <br>- Очень маленький перепад высоты (Склон сильно пологий);<br> - Помимо основного подъемника, на склоне работает "Беби-Лифт", что позволяет ученикам, отрабатывать навыки на небольшом промежутке склона, не тратя силы на подъём!<br> - Освещение горнолыжного склона при занятиях в вечернее время.<br> Длина склона - 600м. Перепад высот - 50м.</p>
        </div>
          
      </div>
      <div class="col-12 col-md-6 order-md-2 order-1 mb-3" style="text-align: center;">
        <iframe width="560" height="450" src="https://www.youtube.com/embed/8uDn2ATP4-A" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div>

    </div>

    <div class="mob_more_button">  
      <p class="mob_more_button_open">Подробнеe</p>
      <p class="mob_more_button_close">Скрыть</p>
    </div> 

  </div> 


  <div class="slopes_list_mob_hidden">
   
    <div class="row mt-5 pt-md-1 pt-0 mb-md-4">
            
      <div class="col-12 col-md-6 order-md-1 order-2">
        <h3>Склон «Тренировочный»</h3>
        <div class="slopes_desc_mob_hidden">
          <p>800 метров комфортного спуска на горных лыжах или сноуборде с перепадом высот 150 метров... Трасса не подходит для любителей экстрима, ведь здесь нет каких-либо препятствий и дополнительных возможностей в виде фрирайда, зато склон идеально подходит для тренировок по карвингу, упражнений по укладкам и работе в свитче.  
            <br>За счет угла наклона и своей ширины, склон легко прощает большинство ошибок спортсмена, позволяя использовать широкий радиус поворота и проскальзывание. <br>Длина склона - 800м. Перепад высот - 150м.   </p>
        </div>
          
      </div>
      <div class="col-12 col-md-6 order-md-2 order-1 mb-3" style="text-align: center;">
        <iframe width="560" height="450" src="https://www.youtube.com/embed/IdvEOLc4No8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div>

    </div>

    <div class="mob_more_button">  
      <p class="mob_more_button_open">Подробнеe</p>
      <p class="mob_more_button_close">Скрыть</p>
    </div> 

  </div> 



  <div class="slopes_list_mob_hidden">
   
    <div class="row mt-5 pt-md-1 pt-0 mb-md-4">
            
      <div class="col-12 col-md-6 order-md-1 order-2">
        <h3>Склон «Профи»</h3>
        <div class="slopes_desc_mob_hidden">
          <p>"Профи" - это склон красного цвета. Угол уклона, придает спуску не только драйва, но и в разы повышает его сложность.<br>  Не смотря на то, что полотно склона широкое и прямое, спуск не желает прощать большинство ошибок горнолыжников. В целом спуск проходит в постоянной динамике, молниеносно сменяя обстановку. Склон получил широкую популярность среди спортсменов лыжников и сноубордистов в дисциплинах «Слалом» и «Слалом ГИГАНТ».<br> Длина склона - 1300м. Перепад высот - 200м. <br>Не рекомендуется для новичков!  </p>
        </div>
          
      </div>
      <div class="col-12 col-md-6 order-md-2 order-1 mb-3" style="text-align: center;">
        <iframe width="560" height="450" src="https://www.youtube.com/embed/YGm_9sSWlOo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div>

    </div>

    <div class="mob_more_button">  
      <p class="mob_more_button_open">Подробнеe</p>
      <p class="mob_more_button_close">Скрыть</p>
    </div> 

  </div>



  <div class="slopes_list_mob_hidden">
   
    <div class="row mt-5 pt-md-1 pt-0 mb-md-4">
            
      <div class="col-12 col-md-6 order-md-1 order-2">
        <h3>Склон «Серпантин»</h3>
        <div class="slopes_desc_mob_hidden">
          <p>Склон "Серпантин" или как его еще называют «Доллар» это один из самых излюбленных горнолыжниками маршрут спуска в Алтайских Альпах. <br> Благодаря тому, что до вершины склона курсирует кресельный подъемник, спуск заслужил свою популярность у достаточно широкой аудитории райдеров, как среди начинающих лыжников и сноубордистов, так и среди спортсменов. <br>  На сегодняшний день это самый широкий склон в арсенале курорта. 
           <br>Длина склона - 1200м. Перепад высот - 200м.</p>
        </div>
          
      </div>
      <div class="col-12 col-md-6 order-md-2 order-1 mb-3" style="text-align: center;">
        <iframe width="560" height="450" src="https://www.youtube.com/embed/5BXIoRFE0hE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div>

    </div>

    <div class="mob_more_button">  
      <p class="mob_more_button_open">Подробнеe</p>
      <p class="mob_more_button_close">Скрыть</p>
    </div> 

  </div>



  <div class="slopes_list_mob_hidden">
   
    <div class="row mt-5 pt-md-1 pt-0 mb-md-4">
            
      <div class="col-12 col-md-6 order-md-1 order-2">
        <h3>Склон «Вектор»</h3>
        <div class="slopes_desc_mob_hidden">
          <p>Склон "Вектор" это горнолыжная трасса, которая расположена в правой части 3-его кресельного подъемника. Ввиду своего географического положения, данный горнолыжный склон не получил широкой популярности, чем с большим удовольствием пользуются некоторые горнолыжники. К тому времени, как большинство склонов уже разбиты, на «Векторе» остается еще вельветовая поверхность, а сам склон практически нетронут. К тому же дуга спуска проходит в одном из самых живописных мест в Алтайских Альпах.<br> - Угол уклона 25%; Длина склона - 1300м. <br>Перепад высот - 200м.</p> 
        </div>
          
      </div>
      <div class="col-12 col-md-6 order-md-2 order-1 mb-3" style="text-align: center;">
        <iframe width="560" height="450" src="https://www.youtube.com/embed/Jc4PKSUpWhk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div>

    </div>

    <div class="mob_more_button">  
      <p class="mob_more_button_open">Подробнеe</p>
      <p class="mob_more_button_close">Скрыть</p>
    </div> 

  </div>


  <div class="slopes_list_mob_hidden">
   
    <div class="row mt-5 pt-md-1 pt-0 mb-md-4">
            
      <div class="col-12 col-md-6 order-md-1 order-2">
        <h3>Склон «Альпийский»</h3>
        <div class="slopes_desc_mob_hidden">
          <p>Склон "Альпийский" - это самый продолжительный склон горнолыжного курорта "Алтайские Альпы".<br>  Склон хорош во многих аспектах, но ключевой его особенностью является - логистическая связь между 3-ей, 4-ой кресельными канатными дорогами и 1-ым подъемником бугельного типа. Начальная часть спуска (до посадочной станции 4-ой кресельной канатной дороги) идеально подходит для малоопытных лыжников и сноубордистов.<br>  Длина склона - 2400м. Перепад высот - 350м. </p> 
        </div>
          
      </div>
      <div class="col-12 col-md-6 order-md-2 order-1 mb-3" style="text-align: center;">
        <iframe width="560" height="450" src="https://www.youtube.com/embed/-fLkbCtAAfc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div>

    </div>

    <div class="mob_more_button">  
      <p class="mob_more_button_open">Подробнеe</p>
      <p class="mob_more_button_close">Скрыть</p>
    </div> 

  </div>
 

</div>


<script type="text/javascript">
    
  $(document).on('click','.mob_more_button p',function(){

    var parent_room_div=$(this).closest('.slopes_list_mob_hidden');
    var target_div=$('.slopes_desc_mob_hidden',parent_room_div); 

    if(target_div.is(':visible')){
      $('.mob_more_button_open',parent_room_div).show();
      $('.mob_more_button_close',parent_room_div).hide(); 
    }
    else{
      $('.mob_more_button_open',parent_room_div).hide();
      $('.mob_more_button_close',parent_room_div).show(); 
    }
    target_div.slideToggle();
  });

 
</script>

 
<style type="text/css">
  .table th, .table td{
    padding: 3px 0 !important;
    border-top: 0;
  }
  .table th{
    width: 50px;
  }
  .panel-heading {
    padding: 5px 10px;
    width: 100%;
    color: #3d5f71;
    background-color: #dddddd;
    text-align: center;
    margin-bottom: 5px;
    font-weight: bold;
  }
  .panel-heading h3 {
    margin: 0;
    font-weight: bold;
    font-size: 20px;
  }
  .weekdays {
    font-weight: bold;
    padding: 0px 5px;
    line-height: 25px;
    text-align: center;
    width: 42px;
    color: #3d5f71;
    font-size: 22px;
    background-color: #dddddd;
    text-transform: capitalize;
  }
  .day_state { 
    padding: 0px 5px;
    line-height: 25px;
    text-align: left;
    width: 100%;
    color: #dddddd;
    font-size: 16px; 
    text-transform: capitalize;
  }
  .panel .btn{
    color: white;
    border: solid 1px white;
  }
</style>
 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>