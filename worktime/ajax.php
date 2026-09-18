<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php"); 
     
global $DB;

date_default_timezone_set('Asia/Almaty');

include 'times.php';  

$weekdays = array(array('воскресенье','вс'),array('понедельник','пн'),array('вторник','вт'),array('среда','ср'),array('четверг','чт'),array('пятница','пт'),array('суббота','сб'));
  
$output = '<div class="row kd_div">';

//тут уже рисуется таблица!
foreach($times as $k => $v) {
  
  if($k==1 || $k==3) $output .= '<div class="col-md-4 col-12 d-flex flex-wrap justify-content-center text-center">';

  if($k==1) $output .= '<p>Дневные катания БКД</p>';
  if($k==3) $output .= '<p>Дневные катания ККД</p>';

  $output .= ' 
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">' . $cables[$k] . '</h3>
      </div>
  
      <div class="panel-body">';
  
    $output .= '<table class="table table-striped">';
  
  foreach($v as $d => $t) { 

    $output .= '<tr><th><div class="weekdays">'.$weekdays[$d][1].'</th>';

    if(!empty($t)) {
      if(!empty($t[1])) $output .= '<td><div class="day_state">' . $t[0] . ' - ' . $t[1] . '';
      else $output .= '<td><div class="day_state">' . $t[0]; 
      $output .= '</div></td>';
    }
    else $output .= '<td> - </td>';
    $output .= '</tr>';
  }
  
  $output .= '</table></div></div>';      

  if($k==2 || $k==4) $output .= '</div>';

}

$output .= '<div class="col-md-4 col-12 d-flex flex-wrap justify-content-center text-center">';

foreach($night_times as $v) { 

  $output .= '<p>Ночные катания</p>';

  $output .= ' 
  <div class="panel panel-default" style="width:100%;"  >
  <div class="panel-heading">
    <h3 class="panel-title">ККД-3</h3>
  </div>
  
  <div class="panel-body">';
  
  $output .= '<table class="table table-striped">';
  
  foreach($v as $d => $t) { 

    $output .= '<tr><th><div class="weekdays">' . $weekdays[$d][1] . '</div></th>';          

    if(!empty($t)) {
      if(!empty($t[0]) && !empty($t[1])){
          $output .= '<td><div class="day_state">' . $t[0] . ' - ' . $t[1].'</div></td>';
      } 
      else $output .= '<td><div class="day_state">' . $t[0];          
    }
    else $output .= '<td><div class="day_state">НЕТ</div></td>';
      
    $output .= '</tr>';

  }
  
  $output .= '</table></div></div>'; 
}

$output .= '</div></div>';
 
echo $output; ?>


 