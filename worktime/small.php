<?php
include 'func.php';  
include 'times.php'; 
global $DB;
  
date_default_timezone_set('Asia/Almaty');
 
$config = new config($DB);

$state = $config->get('state'); 
$time = strtotime(date('d.m.Y H:i'));

$simple_states = array(); 

//перебираем все возможные дни и их расписания ... и тут же отлавливаем из расписания что происходит с кд на текущий момент
foreach($times as $k => $v) {

  $status = 0;
  
  if(!empty($v[date('w', $time)])) {
	   //если текущее время больше (позднее) чем время начала и меньше (раньше) конца  
	   if($time >= strtotime(date('d.m.Y').' '.$v[date('w', $time)][0]) 
	   && $time < strtotime(date('d.m.Y').' '.$v[date('w', $time)][1])){ 
		 $status = 1;
	   } 
  }
  if($state[$k] != 0) $status = 0; // если массив $state с бд наполнен не нулём, то там что - то есть, что говорит о том что кд отключена
  if($state[$k] == 4) $status = 1;
   
  $simple_states[$k] = $status;
}

 
  
$output .= '<div class="row lift_fill">';
 
$output .= '<div class="col-12 col-md-3">
				<div class="row">
					<div class="col-6 col-md-12">БКД-1</div>
						<div class="col-6 col-md-12"> ';
$output .= $simple_states[1] == 1 ? '<span class="kd_on">работает</span></div></div></div>' : '<span class="kd_off">не работает</span></div></div></div>';

$output .= ' <div class="col-12 col-md-3">
				<div class="row">
					<div class="col-6 col-md-12">БКД-2</div>
						<div class="col-6 col-md-12"> ';
$output .= $simple_states[2] == 1 ? '<span class="kd_on">работает</span></div></div></div>' : '<span class="kd_off">не работает</span></div></div></div>';
 
$output .= ' <div class="col-12 col-md-3">
				<div class="row">
					<div class="col-6 col-md-12">ККД-3</div>
						<div class="col-6 col-md-12"> ';
$output .= $simple_states[3] == 1 ? '<span class="kd_on">работает</span></div></div></div>' : '<span class="kd_off">не работает</span></div></div></div>';
 
$output .= ' <div class="col-12 col-md-3">
				<div class="row">
					<div class="col-6 col-md-12">ККД-4</div>
						<div class="col-6 col-md-12"> ';
$output .= $simple_states[4] == 1 ? '<span class="kd_on">работает</span></div></div></div>' : '<span class="kd_off">не работает</span></div></div></div>';

$output .= ' </div>';
 
?> 

<?php echo $output; ?>
	  
  