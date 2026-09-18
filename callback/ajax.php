<?php
   
include($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
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
   

  ob_start(); 

  ?>


<style type="text/css">

  .vote_table{
      width: 100%;
  }
  .vote_table td {
      border: 1px solid black;
      padding: 10px 20px; 
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

</style>

  <table class="vote_table" border="1" cellpadding="5">

    <tr class="vote_table_head">
      
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

$ttext=ob_get_contents();
ob_clean();
 

$sendemail='stasegorenko@mail.ru, turist_alex@mail.ru';//'altay.manager@yandex.ru'; 
$mail['charset'] = 'utf-8';
$mail['from'] = 'Сайт "Альпы" <zakaz@altay.kz>'; 
$mail['subject'] = 'голосование';

$mail['header'] = "MIME-Version: 1.0\n"
."From: " . $mail['from'] . "\n"
."X-Priority: 3\n"
."X-Mailer: Mailer\n"
."Content-Transfer-Encoding: 8bit\n"
."Content-Type: text/html; charset=" . $mail['charset'] . "\n";

if(mail($sendemail, $mail['subject'], $ttext, $mail['header'])) echo 'Спасибо за заявку. Мы обязательно свяжемся с Вами в ближайшее время.';

 else echo 'Ошибка';
 
?>