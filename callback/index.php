<?php //get_header(); 

include($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/twentyfifteen/header.php');
?>

<!--<img style="width: 100%;" src="top.jpg">-->
<div id="seven_days">
  <img src="banner.jpg"  style="width: 100%" class="inner-hero__video"></img>
</div>

<div style="background: #3d5f75 !important;">

<div class="container mt-5 mb-5">

  <? 
  //сохранение результата
  if($_POST['vote_submit']=='Отправить'){

    /*echo '<pre>';
    print_r($_POST);
    echo '</pre>';*/

    // Создаем бронь на оплаченные даты
    $post_data = array(
      'post_type' => 'votes',   
      'post_title'    => 'vote from '.date('d.m.Y H:i:s'),
      'post_content'  => 'votes',
      'post_status'   => 'publish',
      //'post_author'   => 1,
    );

    // Вставляем данные в БД
    $post_id = wp_insert_post( $post_data, false );

    if(isset($_POST['vote_clear'])) update_post_meta( $post_id, 'clear', $_POST['vote_clear']);
    if(isset($_POST['vote_lift'])) update_post_meta( $post_id, 'lift', $_POST['vote_lift']);
    if(isset($_POST['vote_rooms'])) update_post_meta( $post_id, 'rooms', $_POST['vote_rooms']);
    if(isset($_POST['vote_food'])) update_post_meta( $post_id, 'food', $_POST['vote_food']);
    if(isset($_POST['vote_personal'])) update_post_meta( $post_id, 'personal', $_POST['vote_personal']);
    if(isset($_POST['vote_slopes'])) update_post_meta( $post_id, 'slopes', $_POST['vote_slopes']);
    if(isset($_POST['vote_rent'])) update_post_meta( $post_id, 'rent', $_POST['vote_rent']);
    update_post_meta( $post_id, 'vote_date', date('d.m.Y H:i:s'));

      
    if($post_id) $result='Данные успешно сохранены';
     else $result='Ошибка';

  }
  ?>


  <?//вывод результата

 
//if(is_user_logged_in() || $_POST['ajax_']=="Y"): 

  //echo '<div style="margin:10px 0;">вы авторизованы!</div>';
  

  //if($_POST['ajax_']=="Y") ob_start();


  date_default_timezone_set('Asia/Almaty'); 
   

  $args = array(
    'post_type' => 'votes',
    'posts_per_page' => 1000, 
    'meta_query' => array(
      array(
        'key'     => 'vote_date',
        'value'   => date('d.m.Y'),
        'type'    => 'date',
        'compare' => '='
      ),
    ),
  );

  $posts_obj = new WP_Query($args);
  $recent_posts_array=$posts_obj->posts; 
   
  ?>

  <table class="vote_table mt-5 mb-5 <?if(!is_user_logged_in()):?> d-none <?endif;?>">

    <tr class="vote_table_head">
<!-- 
      <td>№</td>
      <td>питание</td>
      <td>проживание</td>
      <td>чистота</td>
      <td>персонал</td>
      <td>лечение</td>
      <td>цены</td>
      <td></td>
 -->

      <td>№</td>
      <td>склоны</td>
      <td>прокаты</td>
      <td>подъемники</td>
      <td>выжливость</td>
      <td>питание</td>
      <td>проживание</td>
      <td>чистота</td>
      <td></td>


    </tr>
   
  <?  
  $i=1;
  foreach( $recent_posts_array as $my_post ){

    /*echo '<pre>';
    print_r($my_post);
    echo '</pre>';*/

    $vote_date=get_post_meta($my_post->ID, "vote_date")[0];    
   
    $vote_clear=get_post_meta($my_post->ID, "clear")[0];  
    if(trim($vote_clear)!='') $ar_vote_clear[]=$vote_clear;
    $vote_slopes=get_post_meta($my_post->ID, "slopes")[0];
    if(trim($vote_slopes)!='') $ar_vote_slopes[]=$vote_slopes;
    $vote_rooms=get_post_meta($my_post->ID, "rooms")[0];
    if(trim($vote_rooms)!='') $ar_vote_rooms[]=$vote_rooms;
    $vote_food=get_post_meta($my_post->ID, "food")[0];
    if(trim($vote_food)!='') $ar_vote_food[]=$vote_food;
    $vote_personal=get_post_meta($my_post->ID, "personal")[0];
    if(trim($vote_personal)!='') $ar_vote_personal[]=$vote_personal;
    $vote_lift=get_post_meta($my_post->ID, "lift")[0];
    if(trim($vote_lift)!='') $ar_vote_lift[]=$vote_lift;   
    $vote_rent=get_post_meta($my_post->ID, "rent")[0];
    if(trim($vote_rent)!='') $ar_vote_rent[]=$vote_rent;   
    ?> 

    <tr>
      <td><?=$i;?></td>
      <td><?=$vote_slopes;?></td>
      <td><?=$vote_rent;?></td>
      <td><?=$vote_lift;?></td>
      <td><?=$vote_food;?></td>
      <td><?=$vote_rooms;?></td>
      <td><?=$vote_clear;?></td>
      <td><?=$vote_personal;?></td>
      <td><?=$vote_date;?></td>
    </tr>

    <? 
    $i++;
  }
  ?> 

    <tr class="vote_table_div">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>

    <tr class="vote_table_footer">
      <td>Сумма:</td>
      <td><?=array_sum($ar_vote_slopes);?></td>
      <td><?=array_sum($ar_vote_rent);?></td>
      <td><?=array_sum($ar_vote_lift);?></td>
      <td><?=array_sum($ar_vote_personal);?></td>
      <td><?=array_sum($ar_vote_food);?></td>
      <td><?=array_sum($ar_vote_rooms);?></td>
      <td><?=array_sum($ar_vote_clear);?></td>
    </tr>
    <tr class="vote_table_footer">
      <td>Кол-во:</td>
      <td><?=count($ar_vote_slopes);?></td>
      <td><?=count($ar_vote_rent);?></td>
      <td><?=count($ar_vote_lift);?></td>
      <td><?=count($ar_vote_personal);?></td>
      <td><?=count($ar_vote_food);?></td>
      <td><?=count($ar_vote_rooms);?></td>
      <td><?=count($ar_vote_clear);?></td>
    </tr>
    <tr class="vote_table_footer">
      <td>Среднее:</td>
      <td><?=round((array_sum($ar_vote_slopes)/count($ar_vote_slopes)),1);?></td>
      <td><?=round((array_sum($ar_vote_rent)/count($ar_vote_rent)),1);?></td>
      <td><?=round((array_sum($ar_vote_lift)/count($ar_vote_lift)),1);?></td>
      <td><?=round((array_sum($ar_vote_personal)/count($ar_vote_personal)),1);?></td>
      <td><?=round((array_sum($ar_vote_food)/count($ar_vote_food)),1);?></td>
      <td><?=round((array_sum($ar_vote_rooms)/count($ar_vote_rooms)),1);?></td>
      <td><?=round((array_sum($ar_vote_clear)/count($ar_vote_clear)),1);?></td>
    </tr>

  </table>


<?
/*if($_POST['ajax_']=="Y"){
  $str=ob_get_contents();
  ob_clean();
} 
echo $str;*/
?>


<?//endif;

?>


  <form method="post">

    <p style="font-size: 35px;line-height: 35px;text-align: center; color: white;">Пожалуйста, ОЦЕНИТЕ работу курорта сегодня.</p>
    <p style="font-size: 25px;line-height: 25px;text-align: center; color: white; margin-bottom: 50px;">Это поможет нам сделать Ваш отдых лучше!</p>

    <div class="row list"> 

      <div class="col-md-3 col-12">

        <img src="Иконки/склоны.png">

        <p class="avg"><?=round((array_sum($ar_vote_slopes)/count($ar_vote_slopes)),1);?></p>
        <p class="title">склоны</p>

        <input type="radio" name="vote_slopes" value="1">
        <input type="radio" name="vote_slopes" value="2">
        <input type="radio" name="vote_slopes" value="3">
        <input type="radio" name="vote_slopes" value="4">
        <input type="radio" name="vote_slopes" value="5">
        
      </div>  

      <div class="col-md-3 col-12">

        <img src="Иконки/прокаты.png">

        <p class="avg"><?=round((array_sum($ar_vote_rent)/count($ar_vote_rent)),1);?></p>
        <p class="title">прокаты</p>

        <input type="radio" name="vote_rent" value="1">
        <input type="radio" name="vote_rent" value="2">
        <input type="radio" name="vote_rent" value="3">
        <input type="radio" name="vote_rent" value="4">
        <input type="radio" name="vote_rent" value="5">

      </div>

      <div class="col-md-3 col-12">

        <img src="Иконки/подъемники.png">

        <p class="avg"><?=round((array_sum($ar_vote_lift)/count($ar_vote_lift)),1);?></p>
        <p class="title">подъемники</p>

        <input type="radio" name="vote_lift" value="1">
        <input type="radio" name="vote_lift" value="2">
        <input type="radio" name="vote_lift" value="3">
        <input type="radio" name="vote_lift" value="4">
        <input type="radio" name="vote_lift" value="5">

      </div>


      <div class="col-md-3 col-12">
        
        <img src="Иконки/вежливость.png">

        <p class="avg"><?=round((array_sum($ar_vote_personal)/count($ar_vote_personal)),1);?></p>
        <p class="title">вежливость</p>

        <input type="radio" name="vote_personal" value="1">
        <input type="radio" name="vote_personal" value="2">
        <input type="radio" name="vote_personal" value="3">
        <input type="radio" name="vote_personal" value="4">
        <input type="radio" name="vote_personal" value="5">

      </div>


    </div>

    <div class="row list"> 

 
      <div class="col-md-4 col-12">

        <img src="Иконки/питание.png">

        <p class="avg"><?=round((array_sum($ar_vote_food)/count($ar_vote_food)),1);?></p>
        <p class="title">питание</p>

        <input type="radio" name="vote_food" value="1">
        <input type="radio" name="vote_food" value="2">
        <input type="radio" name="vote_food" value="3">
        <input type="radio" name="vote_food" value="4">
        <input type="radio" name="vote_food" value="5">

      </div>

      <div class="col-md-4 col-12">

        <img src="Иконки/проживание.png">

        <p class="avg"><?=round((array_sum($ar_vote_rooms)/count($ar_vote_rooms)),1);?></p>
        <p class="title">проживание</p>

        <input type="radio" name="vote_rooms" value="1">
        <input type="radio" name="vote_rooms" value="2">
        <input type="radio" name="vote_rooms" value="3">
        <input type="radio" name="vote_rooms" value="4">
        <input type="radio" name="vote_rooms" value="5">
        
      </div>

      <div class="col-md-4 col-12">

        <img src="Иконки/чистота.png">

        <p class="avg"><?=round((array_sum($ar_vote_clear)/count($ar_vote_clear)),1);?></p>
        <p class="title">чистота</p>

        <input type="radio" name="vote_clear" value="1">
        <input type="radio" name="vote_clear" value="2">
        <input type="radio" name="vote_clear" value="3">
        <input type="radio" name="vote_clear" value="4">
        <input type="radio" name="vote_clear" value="5">
     
      </div>
 
    </div>

    <input type="submit" class="btn-submit mt-5 mb-5" style="position: relative; top: 20px;" name="vote_submit" value="Отправить">

  </form>

</div>

</div>

<div class="container mt-5 mb-5">
  <p class="mt-5 font-weight-bold">Вы всегда можете оставить свой отзыв о нас на одном из популярных информационных ресурсов. Поделитесь своим мнением с другими отдыхающими.</p>
  

  <div class="row list services">
   
    <div class="col-md-3 col-12">
      <a href=""><img src="сервисы/google.png"></a>
    </div>
    <div class="col-md-3 col-12">
      <a href=""><img src="сервисы/Skiru.png"></a>
    </div>
    <div class="col-md-3 col-12">
      <a href=""><img src="сервисы/tripadvisor.png"></a>
    </div>
    <div class="col-md-3 col-12">
      <a href=""><img src="сервисы/яндекс.png"></a>
    </div>

  </div>

</div>





<style type="text/css">

  .vote_table{
      width: 100%;
  }
  .vote_table td {
      border: 1px solid white;
      padding: 10px 20px; 
      color:white; 
  }

  .vote_table .vote_table_head td {
      font-weight: bold;
  }
  .vote_table .vote_table_footer td {
      font-style: italic; 
  } 
  .vote_table .vote_table_footer:last-child td { 
      background: #ff730052;
      font-weight: bold;
      text-decoration: underline;
  }
  .vote_table_div td{    
      background: #ccc;
  }

  .btn-submit{
    background: rgb(255 115 0);
    border-radius: 20px !important;
    font-size: 25px !important;
    text-transform: uppercase;
    display: block;
    margin: auto;
    padding: 15px 50px !important;
  }
  .list{
    max-width: 650px;
    margin:auto;
  }
  .list > div{
    text-align: center;
    margin:30px 0;
  }
  .list img{
    height: 65px;
  }
  .list.services{
    align-items: center;
    max-width: inherit;
  }
  .list.services img{    
    height: auto;
  } 
 

  .avg {
    background-color: #87c766;
    color: black;
    width: 35px;
    margin: 15px auto;
    padding: 5px 0px;
    text-align: center;
  }
  .title{
    font-size: 22px;    
    text-transform: capitalize;
    color: white;
  }
  input[type="radio"]{
    position: relative;
    margin:10px;
    cursor:pointer;
   -webkit-appearance: none;
   -moz-appearance:    none;
   appearance:         none;
  }
  input[type="radio"]::after{
    content:'';
    position: absolute;
    width: 20px;
    height: 20px;
    padding:2px 5px;
    background-color: transparent;
    color: white;
    top: -5px;
    left: -2px;
    text-align: center;
    border-radius: 50%;
  }
  input[type="radio"]:checked::after{ 
    background-color: rgb(255 115 0); 
  }
  input[value="1"]::after{
    content:'1';
  }
  input[value="2"]::after{
    content:'2';
  }
  input[value="3"]::after{
    content:'3';
  }
  input[value="4"]::after{
    content:'4';
  }
  input[value="5"]::after{
    content:'5';
  }

</style>



<script type="text/javascript">
  /*jQuery(document).ready(function($) {
    $(document).on('click','.dropdown-menu a',function(){   
      var state=$(this).attr('data-state');
      var target_input=$(this).parent().parent().prev();    
      target_input.val(state);    
      var span_to_show=$(this).html();
      target_input.prev().html(span_to_show);     
    });
        
    $(document).on('click','.dropdown-toggle',function(){  
      var cable=$(this).attr('data-toggle');    
      $('#dropdownMenu_'+cable).toggle();
    });
  });*/
</script>

 
<?
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/twentyfifteen/footer.php');?>



