<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('iblock');
 
 $arMonths=array(
	 '1'=>'Январь',
	 '2'=>'Февраль',
	 '3'=>'Март',
	 '4'=>'Апрель',
	 '5'=>'Май',
	 '6'=>'Июнь',
	 '7'=>'Июль',
	 '8'=>'Август',
	 '9'=>'Сентябрь',
	 '10'=>'Октябрь',
	 '11'=>'Ноябрь',
	 '12'=>'Декабрь',
 );

	
//ВЫБОРКА всех броней комнаты

function choose_reserves($post_id){
 
    CModule::IncludeModule('iblock');  
 
	$reserves_count = 0;
	$ar_reserves = array();
 
    $arSelect = Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=>6, "ACTIVE"=>"Y", "PROPERTY_room_id" => $post_id);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement()){

        $arFields = $ob->GetFields();
        $arProps  = $ob->GetProperties();

        $room_id = $arProps['room_id']['VALUE'];
	
		$ar_reserves[$room_id][$reserves_count]['start'] = $arProps['date_time_start']['VALUE'];
		$ar_reserves[$room_id][$reserves_count]['end'] = $arProps['date_time_end']['VALUE']; 
		$ar_reserves[$room_id][$reserves_count]['dates'] = json_decode($arProps['dates']['~VALUE']);
		
		$reserves_count++;
	}

	return $ar_reserves; 
}


//КАЛАНДАРЬ

function draw_calendar($month,$year,$ar_func_reserves, $post_id){

  if($month<10) $month='0'.$month;  //добавляем ноль перед месяцем
		
  /* Начало таблицы */
  $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
  /* Заглавия в таблице */
  $headings = array('Пн','Вт','Ср','Чт','Пт','Сб','Вс');
  $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';
  /* необходимые переменные дней и недель... */
  $running_day = date('w',mktime(0,0,0,$month,1,$year)); // порядковый номер дня недели первого от 0 до 6 (текущий день)
  
  if($running_day!=0) $running_day = $running_day - 1; 
   else $running_day=6; //вообще всегда надо отнимать, но это хак на случай если первое число на вс выпадет... хз как это работает ))) 
   
  $days_in_month = date('t',mktime(0,0,0,$month,1,$year)); // количество дней в месяце
  $days_in_this_week = 1;
  $day_counter = 0;
  $dates_array = array();
  
  /* первая строка календаря */
  $calendar.= '<tr class="calendar-row">';
  /* вывод пустых ячеек в сетке календаря до текущего дня*/
  for($x = 0; $x < $running_day; $x++):
    $calendar.= '<td class="calendar-day-np"> </td>';
    $days_in_this_week++;
  endfor;
  
  $reserved_days=0;
  
	
  /* дошли до чисел, будем их писать в первую строку */
  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
    
	
	$cur_date_reserved=false;
			
    $calendar.= '<td class="calendar-day">';
        /* Пишем номер в ячейку */
        $calendar.= '<div class="day-number">'.$list_day.'</div>';
	  
        /** ИЩЕМ СОВПАДЕНИЕ ДАТЫ СОБЫТИЯ С ТЕКУЩЕЙ ДАТОЙ **/
	  	
		$reserved_dates=array();
		$reserved_starts=array();
			
		//собираем все занятые даты в один массив
		if(!empty($ar_func_reserves)):		
		
			foreach($ar_func_reserves[$post_id] as $key => $reserve_interval){ 				
				//будем сохранять дату брони в ключе, а в значении будут все данные
				foreach($reserve_interval['dates'] as $reserved_date){				
					$reserved_dates[$reserved_date]['start']=$reserve_interval['start'];
					$reserved_dates[$reserved_date]['end']=$reserve_interval['end']; 			
				}			
				$reserved_starts[$reserve_interval['start']]=$reserve_interval['start'];		
			}
		endif;		
				
		
		//если вообще есть бронь на этот номер
		if(isset($reserved_dates)):		
			
			if($list_day<10) $list_day='0'.$list_day; //добавляем ноль перед днём
			
			$cur_date=$list_day.'.'.$month.'.'.$year;

			//чтобы когда не запрещаем регать на последнюю дату забронированного периода, все равно запрещать если это первая дата следующего периода
			$date_next = new DateTime($cur_date);
			$date_next->modify('+1 day');
			$cur_date_next=$date_next->format('d.m.Y');
		
			if(array_key_exists($cur_date,$reserved_dates) && ($reserved_dates[$cur_date]['end']!=$cur_date || 
			$reserved_dates[$cur_date]['end']==$cur_date && array_key_exists($cur_date,$reserved_starts)!==false || 
			$reserved_dates[$cur_date]['end']==$reserved_dates[$cur_date]['start'])
			/*($reserved_dates[$cur_date]['end']!=$cur_date  || 
			$reserved_dates[$cur_date_next]['start']==$cur_date || 
			$reserved_dates[$cur_date]['end']==$reserved_dates[$cur_date]['start'])*/){			
					
				$half_reserved_class='';
				$half_reserved_long='';
				
				if($reserved_dates[$cur_date]['start']==$cur_date && $reserved_dates[$cur_date]['end']!=$reserved_dates[$cur_date]['start'] || 
				$reserved_dates[$cur_date]['end']==$cur_date && array_key_exists($cur_date,$reserved_starts)!==false) $half_reserved_class='half_reserved';
				
				if(array_key_exists($cur_date_next,$reserved_dates) && $reserved_dates[$cur_date_next]['end']!=$cur_date_next && 
				intval(date('N', strtotime($cur_date)))!= 7) $half_reserved_long='half_reserved_long';

				$calendar.='<div class="day-reserved '.$half_reserved_class.' '.$half_reserved_long.'"></div>';
								
			}
			else {
			  $calendar.= '<div class="day-free"></div>';			  
			}		
			
		else: 	$calendar.='<div class="day-free"></div>';				
		
		endif;		
		
		
        $calendar.= str_repeat('<p> </p>',2); 
		
    $calendar.= '</td>';
	
    if($running_day == 6): // если дошли до вс закрываем строку
      $calendar.= '</tr>';
	  
	  $days_in_this_week = 0;  
      $running_day = -1; //это просто чтобы выравнить баланс  перед следующим увеличением
	  
      if(($day_counter+1) != $days_in_month): // если ещё не дошли до конца месяца то открываем слующую строку
        $calendar.= '<tr class="calendar-row">'; 		
	  else:	
		 $days_in_this_week=7; // хак на случай если конец месяца в вс выпадает, а при обнулении у нас доп строка вылазила
      endif;
	
    endif;
	
    $days_in_this_week++; 
	$running_day++; 
	$day_counter++;
		
  endfor;
  
  /* Выводим пустые ячейки в конце последней недели */
  if($days_in_this_week < 8):
    for($x = 1; $x <= (8 - $days_in_this_week); $x++):
      $calendar.= '<td class="calendar-day-np"> </td>';
    endfor;
  endif;
  
  /* Закрываем последнюю строку */
  $calendar.= '</tr>';
  /* Закрываем таблицу */
  $calendar.= '</table>';
  
  /* Все сделано, возвращаем результат */
  return $calendar;
}

	
	if(isset($_POST['month'])) $cur_post_month=$_POST['month']; 
	 else $cur_post_month=date('n');

	if(isset($_POST['year'])) $cur_post_year=$_POST['year']; 
	 else $cur_post_year=date('Y');
	
	if(isset($_POST['post_id'])) $cur_post_id=$_POST['post_id'];  
						
	$my_reserves = choose_reserves($cur_post_id);	

	if(isset($_POST['rooms_list']) && $_POST['rooms_list'] == 'Y'):?>

		<div class="cur_month_block">
			<a class="selected_month rooms_list_prev"><</a>
			<span class="rooms_list_choose_month"><?=$arMonths[$cur_post_month].' '.$cur_post_year;?></span>
			<a  class="rooms_list_next selected_month">></a>
		</div>

		<input class="cur_month_input" value="<?=$cur_post_month?>" style="display:none" />
		<input class="cur_year_input" value="<?=$cur_post_year?>" style="display:none" />

		<?	
		echo draw_calendar($cur_post_month,$cur_post_year,$my_reserves,$cur_post_id);

	else:

		if($cur_post_month<12){
			$next_post_month=$cur_post_month+1;
			$next_post_year=$cur_post_year;
		}
		else{
			$next_post_month=1;
			$next_post_year=$cur_post_year+1;
		}
		?>	
		
		<br>
		<div id="cur_month_block">
			<a id="prev" class="selected_month"> <<   </a>
			<b><?=$arMonths[$cur_post_month].' '.$cur_post_year.'   -   '.$arMonths[$next_post_month].' '.$next_post_year;?></b>
			<a class="selected_month" id="next">   >> </a>
			<img id="wait" src="/slider/load.gif">
		</div>

		<input id="cur_month_input" value="<?=$cur_post_month?>" style="display:none" />
		<input id="cur_year_input" value="<?=$cur_post_year?>" style="display:none" />
		<?	

		echo '<div class="row">';
		echo '<div class="col-12 col-md-6">';
			echo draw_calendar($cur_post_month,$cur_post_year,$my_reserves,$cur_post_id);
		echo '</div>';
		echo '<div class="col-12 col-md-6">';
			echo draw_calendar($next_post_month,$next_post_year,$my_reserves,$cur_post_id);
		echo '</div>';
		echo '</div>';

	endif;

?>



	