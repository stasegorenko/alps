<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");

global $DB;
date_default_timezone_set('Asia/Almaty');
?>
 
<?php
include 'func.php';
include 'times.php';  
 
$output = '';
$message = '';   

$weekdays = array(array('воскресенье','вс'),array('понедельник','пн'),array('вторник','вт'),array('среда','ср'),array('четверг','чт'),array('пятница','пт'),array('суббота','сб'));
  
$config = new config($DB);

$state = $config->get('state');
$message = $config->get('message');
$time = strtotime(date('d.m.Y H:i'));
   
if(isset($_POST['state'])) {
  $config->set('state', $_POST['state']);
  $state = $config->get('state');
}
if(isset($_POST['text'])) {
  $config->set('message', $_POST['text']);
  $message = $config->get('message');
}
  
$states = array('работает', 'плановое отключение', 'аварийное отключение', 'погодные условия', 'работает непланово');
 
$full_states = array();

//перебираем все возможные дни и их расписания ... и тут же отлавливаем из расписания что происходит с кд на текущий момент
foreach($times as $k => $v) {

  $status = 0;
  
  if(!empty($v[date('w', $time)])) { 

    // //если текущее время больше (позднее) чем время начала и меньше (раньше) конца  
    // if((date('H:i', $time) >= $v[date('w', $time)][0] && date('H:i', $time) < $v[date('w', $time)][1])
    // // или если есть ночные катания  + те же условия
    // || (!empty($v[date('w', $time)][2]) && !empty($v[date('w', $time)][3]) && date('H:i', $time) >= $v[date('w', $time)][2] && date('H:i', $time) < $v[date('w', $time)][3]))
 
    //если текущее время больше (позднее) чем время начала и меньше (раньше) конца  
    if($time >= strtotime(date('d.m.Y').' '.$v[date('w', $time)][0]) 
    && $time < strtotime(date('d.m.Y').' '.$v[date('w', $time)][1])){ 
      $status = 1;
    } 
  }
  if($state[$k] != 0) $status = 0; // если массив $state с бд наполнен не нулём, то там что - то есть, что говорит о том что кд отключена
  if($state[$k] == 4) $status = 1;
  
  $full_states[$k] = $status; 
}


$output .= '<div class="row kkd">';
   
//тут рисуется таблица!
foreach($times as $k => $v) {

  $status = $full_states[$k];

  $output .= '
<div class="col-md-3 col-sm-6">
<div class="panel panel-default ' . ($status == 0 ? 'stop' : 'run') . '" id="d' . $k . '">
  <div class="panel-heading">
    <h3 class="panel-title">' . $cables[$k] . '</h3>
  </div>
  
  <div class="panel-body">';
  
  if($status == 0) {
    $output .= '<div style="padding:5px 10px;margin:0 0 10px;" class="bg-danger"><strong>Сейчас:</strong> не работает';
    $output .= $state[$k] != 0 ? ', ' . $states[$state[$k]] : '';
    $output .= '</div>';
  }
  else {
    $output .= '<div style="padding:5px 10px;margin:0 0 10px;" class="bg-success"><strong>Сейчас:</strong> работает</div>';
  }
  
  $output .= '<table class="table table-striped">';
  
  foreach($v as $d => $t) {
    
    $output .= '<tr' . (date('w', $time) == $d ? (empty($t) ?  ' class="danger"' : ($status == 1 ? ' class="success"' : ' class="info"')) : '') . '><th title="' . $weekdays[$d][0] . '"><div class="weekdays">' . $weekdays[$d][1] . '</div></th>';
    
    if(!empty($t)) {
      if(!empty($t[1])) $output .= '<td><div class="day_state">' . $t[0] . ' - ' . $t[1] . '';
      else $output .= '<td><div class="day_state">' . $t[0];
      if(!empty($t[2]) && !empty($t[3])) {
        $output .= ', ' . $t[2] . ' - ' . $t[3] . '';// &mdash; ночные катания
      }
      $output .= '</div></td>';
    }
    else $output .= '<td> - </td>';
    $output .= '</tr>';
  }
  
  $output .= '</table>';
  

  $output .= '<form class="state_change" action="" method="post">';
  
  //зададим массив состояний и укажем зависимость для иконок  
    $states_icons=array(
    
    0=>'<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Работает',
    1=>'<span class="glyphicon glyphicon-time" aria-hidden="true"></span> Плановое отключение',
    2=>'<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Аварийное отключение',
    3=>'<span class="glyphicon glyphicon-cloud" aria-hidden="true"></span> По погодным условиям',
    4=>'<span class="glyphicon glyphicon-play" aria-hidden="true"></span> Включена специально', 
    
    );
  
    
  if($state[$k]!='') $state_to_print=$states_icons[$state[$k]]; 
  else $state_to_print='<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Работает';
    
  $output .= '<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="'. $k .'" 
    aria-expanded="true">'. $state_to_print.'  <span class="caret"></span> </button>

    <input type="hidden" name="state[' . $k . ']" value="' . $state[$k] . '" />
    <ul class="dropdown-menu" role="menu" id="dropdownMenu_' . $k . '" >
    <li role="presentation"><a role="menuitem" tabindex="1"  data-state="0"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Работает</a></li>
    <li role="presentation"><a role="menuitem" tabindex="2"  data-state="1"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Плановое отключение</a></li>
    <li role="presentation"><a role="menuitem" tabindex="3"  data-state="2"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Аварийное отключение</a></li>
    <li role="presentation"><a role="menuitem" tabindex="4"  data-state="3"><span class="glyphicon glyphicon-cloud" aria-hidden="true"></span> По погодным условиям</a></li>
    <li role="presentation"><a role="menuitem" tabindex="5"  data-state="4"><span class="glyphicon glyphicon-play" aria-hidden="true"></span> Включена специально</a></li>
    </ul>
    </div>';

  $output .= '<div style="clear:both;"></div>';


  $output .= '</div></div></div>';
}

 
$output .= '</div>
  <button style="border: solid 1px white; margin-top: 20px;" class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Сохранить</button>
  </form><div class="clearfix"></div> ';

echo $output; 
?>


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
    font-size: 24px;
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
  
  .kkd{
    background-color: #3d5f71; 
    padding: 10px;  
    margin:20px;
  }
</style>

<script type="text/javascript">
  jQuery(document).ready(function($) {
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
  });
</script>

  


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>