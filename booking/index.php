<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("booking");

?>

<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/libs/datetimepicker/jquery.datetimepicker.css" >
<script src="<?=SITE_TEMPLATE_PATH?>/libs/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
<?

//переменные для расчета общей загрузки
$GLOBALS['all_sucсess']=0;
$GLOBALS['rooms_count']=0;


/* КАЛАНДАРЬ --> */

function draw_calendar($month,$year,$ar_func_reserves,$ar_func_rooms,$room_type){
		
	global $USER;
	
	 if($month<10) $month='0'.$month; //добавляем ноль перед месяцем		
		
	 $sucсess=0;//переменная для расчета загрузки за месяц
	 
	 $headings = array(
		0=>'Вс',
		1=>'Пн',
		2=>'Вт',
		3=>'Ср',
		4=>'Чт',
		5=>'Пт',
		6=>'Сб',
	);

	 /* необходимые переменные дней и недель... */
	  $running_day = date('w',mktime(0,0,0,$month,1,$year)); // порядковый номер дня недели первого от 0 до 6 (текущий день)
	  //$running_day--;
	  
	  $days_in_month = date('t',mktime(0,0,0,$month,1,$year)); // количество дней в месяце
	  
	  $calendar.= '<table class="calendar"><tr class="calendar-row"><td class="calendar-day first-col" ><b>'.$room_type.'</b></td>'; 
	  
	  // сначала заполняем в шапке все числа месяца
		  for($list_day = 1; $list_day <= $days_in_month; $list_day++):
			$calendar.= '<td class="calendar-day">';
			  /* Пишем номер в ячейку */
			  
			  if($running_day==0 || $running_day==6) $heading_class='heading_class';
			   else $heading_class='';
			  
			  $calendar.= '<div class="day-number '.$heading_class.'">'.$list_day.'<br><span class="days_of_week ">'.$headings[$running_day].'</span></div>';
			  //$calendar.= str_repeat('<p> </p>',2);      
			$calendar.= '</td>';
			
			$running_day++;
			if($running_day==7) $running_day=0;
			
		  endfor;
		  
	  $calendar.= '</tr>';
	  
	  
	  //запускаем цикл по комнатам всем
	  
		foreach($ar_func_rooms as $room_id => $room_info):
	  	  
		    $reserved_dates = array(); // для каждой комнаты - свой массив
		    $spec_dates = array(); // для каждой комнаты - свой массив крайних дат	
			$dates_to_check = array();
			
			//если для текущей комнаты есть бронь
			if(!empty($ar_func_reserves[$room_id])):
			
				//собираем все занятые даты в один массив
				foreach($ar_func_reserves[$room_id] as $key => $reserve_interval){ // $reserve_interval это по сути одна бронь
										
					//собираем все крайние даты в один массив чтобы вычислить не совпадают ли на одну дату по 2 брони
					$spec_dates['start_dates'][$key][] = $reserve_interval['start'];					
					//а чтобы в случае брони на один день не было ненужных клеток закрашено, проверяем это
					if($reserve_interval['start'] != $reserve_interval['end']) $spec_dates['end_dates'][] = $reserve_interval['end'];
											
					//будем сохранять дату брони в ключе, а в значении будут все данные
					//получается что для каждого дня, для каждой клеточки все записываем
					foreach($reserve_interval['dates'] as $reserved_date){
										
						$reserved_dates[$reserved_date]['start']=$reserve_interval['start'];
						$reserved_dates[$reserved_date]['end']=$reserve_interval['end'];
						$reserved_dates[$reserved_date]['arrival']=$reserve_interval['arrival'];
						$reserved_dates[$reserved_date]['departure']=$reserve_interval['departure'];
						$reserved_dates[$reserved_date]['book_id']=$reserve_interval['book_id'];
						$reserved_dates[$reserved_date]['fio']=$reserve_interval['fio'];
						$reserved_dates[$reserved_date]['prepayment']=$reserve_interval['prepayment'];
						$reserved_dates[$reserved_date]['deal_id']=$reserve_interval['deal_id'];
						//$reserved_dates[$reserved_date]['phone']=$reserve_interval['phone'];
						//$reserved_dates[$reserved_date]['email']=$reserve_interval['email'];
						//$reserved_dates[$reserved_date]['people']=$reserve_interval['people'];
						
					}					
				}
				 
			endif;
		  
					
			//смотрим сколько совпадений и показываем даты на которые совпали 2 брони... 			
			foreach($spec_dates['start_dates'] as $book_key => $start_dates){				
				foreach($start_dates as $start_date){
					if(!empty($spec_dates['end_dates'])){
						$found_key = array_search($start_date, $spec_dates['end_dates']);
						if($found_key !== false) $dates_to_check[$book_key] = $spec_dates['end_dates'][$found_key]; 
						// echo $spec_dates['end_dates'][$found_key].' - '.$book_key;
					}
				}				
			}
					
		  
			//НАЧИНАЕМ РИСОВАТЬ!!!
		  
			//в первый столбик пишем номер и инфу базовую
			$calendar.= '<tr room_title="'.$room_info['title'].'" id="room_'.$room_id.'" class="calendar-row">
				<td class="calendar-day-first-col"><span class="room_number">'.$room_info['room_numb'].'</span>
				<span class="room_beds"> '.$room_info['beds'].'</span></td>';
		  
		    // дошли до чисел, будем их писать в первую строку
			for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		  
				$calendar.= '<td class="calendar-day">';
			
				//если вообще есть бронь на этот номер
				if(isset($reserved_dates)):
						
					if($list_day<10) $list_day='0'.$list_day; //добавляем ноль перед днём	
					
					$cur_date=$list_day.'.'.$month.'.'.$year;	
						 
					if(array_key_exists($cur_date,$reserved_dates)){	
					
						$sucсess++;//переменная для расчета загрузки
						
						$reserved_style='';  // для того чтобы выделить первый день брони
						$info_move_style=''; // смещение для всплывающего окна, когда с правого края оно вылазит
						
						$prepayment_style=''; 
						if($reserved_dates[$cur_date]['prepayment'] == 'да') $prepayment_style='prepayment';

						//проверяем есть ли на текущую дату вторая бронь						
						$double_reserve_key = array_search($cur_date, $dates_to_check);
						
						//если нет - рисуем обычную начальную клетку (теперь половинчатую!)
						if($double_reserve_key === false){
							if($cur_date == $reserved_dates[$cur_date]['start']) $reserved_style = 'style="border-left:solid 3px green;width:50%; z-index:1; left:50%;"';
							if($cur_date == $reserved_dates[$cur_date]['end'] && $cur_date != $reserved_dates[$cur_date]['start']){
								$reserved_style='style="left:-50%;"';
								//даем возможность с этой даты начать следующую бронь
								$calendar.= '<div id="'.$list_day.'.'.$month.'.'.$year.' 12:00" class="day-free"></div>';
							}
						}	
						//если есть - проверяем записалась ли сюда именно начальная дата? если да - выводим смещенную клетку начальную, и пол конечной
						elseif($dates_to_check[$double_reserve_key]==$reserved_dates[$cur_date]['start']){						 
							$reserved_style='style="border-left:solid 3px green; z-index:1; width:50%; left:50%;"';
							$calendar.='<div class="day-reserved '.$prepayment_style.'"></div>';
						}
						else
						{	// если записалась конечная дата, то её выводим полностью, а заранее рисуем кусок начальной проебанной даты						
						
							$double_reserve_date=$ar_func_reserves[$room_id][$double_reserve_key];
						
							$reserved_style='style="border-left:solid 3px green; z-index:1; width:50%; left:50%;"';	
							
							$calendar.='<div class="day-reserved '.$prepayment_style.'" '.$reserved_style.' id="'.$double_reserve_date['book_id'].'"></div>';
							
							$calendar.='<div class="day-reserved-info" '.$info_move_style.' id="'.$double_reserve_date[$cur_date]['book_id'].'-info">';
							
								$calendar.='<p style="font-weight:bold;" id="'.$double_reserve_date['book_id'].'-dates">'.$double_reserve_date['start'].' '.$double_reserve_date['arrival'].' - '.$double_reserve_date['end'].' '.$double_reserve_date['departure'].'</p>';
									
								if($reserved_dates[$cur_date]['deal_id'] != '')
									$calendar.='<p><a target="_blank" href="https://altaykz.bitrix24.kz/crm/deal/details/'.$double_reserve_date[$cur_date]['deal_id'].'/">Перейти к сделке >></a></p>';
								elseif($USER->IsAdmin()) {
									$calendar.='<a class="book_info_edit">Ред.</a><a class="book_delete">Удалить</a>';
									$calendar.='<p class="d-none" id="'.$double_reserve_date[$cur_date]['book_id'].'-fio">'.$double_reserve_date[$cur_date]['fio'].'</p>';
								}
								//$calendar.='<p id="'.$double_reserve_date['book_id'].'-people">Количество отдыхающих: '.$double_reserve_date['people'].'</p>';
								//$calendar.='<p id="'.$double_reserve_date['book_id'].'-phone">Телефон: '.$double_reserve_date['phone'].'</p>';
								//$calendar.='<p id="'.$double_reserve_date['book_id'].'-email">E-mail: '.$double_reserve_date['email'].'</p>';
								$calendar.='<a class="book_info_close">X</a>';								
								
							$calendar.='</div>';	

							$reserved_style='';
							
						}
							 
						
						if($list_day>20) $info_move_style='style="left:-245px;"';						
												
						$calendar.='<div class="day-reserved '.$prepayment_style.'" '.$reserved_style.' id="'.$reserved_dates[$cur_date]['book_id'].'"></div>';
						
						$calendar.='<div class="day-reserved-info" '.$info_move_style.' id="'.$reserved_dates[$cur_date]['book_id'].'-info">';
						
							$calendar.='<p style="font-weight:bold;" id="'.$reserved_dates[$cur_date]['book_id'].'-dates">'.$reserved_dates[$cur_date]['start'].' '.$reserved_dates[$cur_date]['arrival'].' - '.$reserved_dates[$cur_date]['end'].' '.$reserved_dates[$cur_date]['departure'].'</p>';
										
							if($reserved_dates[$cur_date]['deal_id'] != '')				
								$calendar.='<p><a target="_blank" href="https://altaykz.bitrix24.kz/crm/deal/details/'.$reserved_dates[$cur_date]['deal_id'].'/">Перейти к сделке >></a></p>';
							elseif($USER->IsAdmin()) {
								$calendar.='<a class="book_info_edit">Ред.</a><a class="book_delete">Удалить</a>';
								$calendar.='<p class="d-none" id="'.$reserved_dates[$cur_date]['book_id'].'-fio">'.$reserved_dates[$cur_date]['fio'].'</p>';
							}
							//$calendar.='<p id="'.$reserved_dates[$cur_date]['book_id'].'-people">Количество отдыхающих: '.$reserved_dates[$cur_date]['people'].'</p>';
							//$calendar.='<p id="'.$reserved_dates[$cur_date]['book_id'].'-phone">Телефон: '.$reserved_dates[$cur_date]['phone'].'</p>';
							//$calendar.='<p id="'.$reserved_dates[$cur_date]['book_id'].'-email">E-mail: '.$reserved_dates[$cur_date]['email'].'</p>';
							$calendar.='<a class="book_info_close">X</a>';
							
							
						$calendar.='</div>';						
						
					}
					else {
					  $calendar.= '<div id="'.$list_day.'.'.$month.'.'.$year.' 12:00" class="day-free"></div>';					  
					}		
					 
				else: 	$calendar.='<div id="'.$list_day.'.'.$month.'.'.$year.' 12:00" class="day-free"></div>';
				
				endif;
				
				
				$calendar.= str_repeat('<p> </p>',2);      
						  
				$calendar.= '</td>';
				
			endfor;
		  
		  $calendar.= '</tr>';
		  
		endforeach;
	  
	/* Закрываем таблицу 
	  $calendar.= '</table>';  

	  $zagruzka = $sucсess / $days_in_month / count($ar_func_rooms ?? []) * 100;
	//$zagruzka=$sucсess/$days_in_month/count($ar_func_rooms)*100;

	  $calendar.= '<p><b>Загрузка: '.round($zagruzka).'%</b></p>'; 

	  $GLOBALS['all_sucсess']=$GLOBALS['all_sucсess']+$sucсess;	
	  $GLOBALS['rooms_count']=$GLOBALS['rooms_count']+count($ar_func_rooms);

	return $calendar;*/
	$calendar .= '</table>';  

		$rooms_count = count($ar_func_rooms ?? []);

		if ($rooms_count > 0 && $days_in_month > 0) {
 		   $zagruzka = ($sucсess / ($days_in_month * $rooms_count)) * 100;
		} else {
	    $zagruzka = 0;
		}

		$calendar .= '<p><b>Загрузка: '.round($zagruzka).'%</b></p>'; 

		$GLOBALS['all_sucсess'] += $sucсess;	
		$GLOBALS['rooms_count'] += $rooms_count;

		return $calendar;
		}

 /* <-- КАЛАНДАРЬ */

?>

<div class="container mt-5 mb-5"> 

	<?
	if(isset($_GET['month'])) $cur_month=$_GET['month'];
	 else $cur_month=date('n');
	 
	if(isset($_GET['yearr'])) $cur_year=$_GET['yearr'];
	 else $cur_year=date('Y');
	?>

	<form method="get">
		<select name="month">	
		
			<?
			$Month_r = array( 
				"1" => "Январь", 
				"2" => "Февраль", 
				"3" => "Март", 
				"4" => "Апрель", 
				"5" => "Май", 
				"6" => "Июнь", 
				"7" => "Июль", 
				"8" => "Август", 
				"9" => "Сентябрь", 
				"10" => "Октябрь", 
				"11" => "Ноябрь", 
				"12" => "Декабрь"
			);
			
			$cur_month_def=$cur_month;
			$cur_year_def=$cur_year;
			
			$filter_date_i=0;
			
			for($i=$cur_month_def-3; $i<$cur_month_def+12; $i++){
				
				if($i>12) {
					$my_year=$cur_year_def+1;
					$my_month=$i-12;
				}
				elseif($i<1){
					$my_year=$cur_year_def-1;
					$my_month=$i+12;
				}
				else {
					$my_year=$cur_year_def;
					$my_month=$i;
				}
		
				if($cur_month==$my_month && $cur_year==$my_year) $sel='selected';
				 else $sel='';
				
				echo '<option '.$sel.' year='.$my_year.' value="'.$my_month.'">'.$Month_r[$my_month].' '.$my_year.'</option>';
					
				//задаем значения для фильтра по датам начала брони, чтобы не перебирать за все годы базу, а только крайние 3 месяца
				if($filter_date_i==1) $filter_start_date=$my_year.'-'.$my_month.'-01';
				if($filter_date_i==4) $filter_end_date=$my_year.'-'.$my_month.'-01';
				$filter_date_i++;
								
			}			
			?>
			
		</select>
		<input type="text" name="yearr" style="display:none;" value="<?=$cur_year?>">
		<input type="submit" value="Перейти" />
	</form>

		
	<?php
	//ВЫБОРКА  всех броней для всех комнат  

    CModule::IncludeModule('iblock'); 
    
    $recent_posts_array = array();
 
	$reserves_count = 0;
	$ar_reserves = array();
 
    $arSelect = Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_*");
    $arFilter = Array("IBLOCK_ID"=> IBLOCK_ALPS_BOOKING, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement()){

        $arFields = $ob->GetFields();
        $arProps  = $ob->GetProperties();

        $room_id = $arProps['room_id']['VALUE'];

		$ar_reserves[$room_id][$reserves_count]['dates'] = json_decode($arProps['dates']['~VALUE']);
		$ar_reserves[$room_id][$reserves_count]['start'] = $arProps['date_time_start']['VALUE']; 
		$ar_reserves[$room_id][$reserves_count]['end'] = $arProps['date_time_end']['VALUE'];  
		$ar_reserves[$room_id][$reserves_count]['arrival'] = $arProps['arrival']['VALUE'];   
		$ar_reserves[$room_id][$reserves_count]['departure'] = $arProps['departure']['VALUE'];
		$ar_reserves[$room_id][$reserves_count]['book_id'] = $arFields['ID'];
		$ar_reserves[$room_id][$reserves_count]['fio'] = $arProps['fio']['VALUE'];
		$ar_reserves[$room_id][$reserves_count]['prepayment'] = $arProps['prepayment']['VALUE'];
		$ar_reserves[$room_id][$reserves_count]['deal_id'] = $arProps['deal_id']['VALUE'];
		
		//$ar_reserves[$room_id][$reserves_count]['phone'] = $arProps['phone']['VALUE']; 
		//$ar_reserves[$room[0]][$reserves_count]['email'] = $arProps['book_id']['VALUE'];
		//$ar_reserves[$room_id][$reserves_count]['people'] = $arProps['people']['VALUE']; 
		
		$reserves_count++;

    }
 
	// echo '<pre>'; 
	// print_r($ar_reserves);
	// echo '</pre>';
                    

	//ВЫБОРКА номеров  		
 	// для схемы номеров сразу создаем массив в котором ключ - это номер комнаты, а значение - массив с id и урлом
	$hvars=array();		
    
    $arSelect = Array("ID", "NAME", "PROPERTY_NUMID","PROPERTY_BEDS","PROPERTY_BEDS_MAX", "IBLOCK_SECTION_ID");
    $arFilter = Array("IBLOCK_ID"=> IBLOCK_ALPS_ROOMS, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array('property_NUMID' => 'ASC'), $arFilter, false, false, $arSelect);
    while($arFields = $res->GetNext()){

		$beds = $arFields['PROPERTY_BEDS_VALUE'].' мест';
		if($arFields['PROPERTY_BEDS_MAX_VALUE'] > $arFields['PROPERTY_BEDS_VALUE']) 
			$beds = $arFields['PROPERTY_BEDS_VALUE'].'-'.$arFields['PROPERTY_BEDS_MAX_VALUE'].' мест';
 
        $hvars[$arFields['IBLOCK_SECTION_ID']][$arFields['ID']]=array( 
            'title' => $arFields['NAME'],
            'room_numb' => $arFields['PROPERTY_NUMID_VALUE'],
            'beds' => $beds,
        );
    }
  							
	//получаем массив в котором ключ - это номер комнаты, а значение - массив с координатами на схеме и описанием
	//include($_SERVER['DOCUMENT_ROOT'].'/booking/ndata.php'); 
	 
    ?>	 
	     
	<a class="test" style="display:none" href="#booking_form">test</a>
  
	<div class="booking">
		  		 
		<? 
		$sect_list = array();
		$db_sect_list = CIBlockSection::GetList(Array('SORT' => 'ASC'), Array('IBLOCK_ID' =>IBLOCK_ALPS_ROOMS ), false);  
		while($ar_result = $db_sect_list->GetNext()) {
			$sect_list[$ar_result['ID']] = $ar_result['NAME']; 
		} 

		foreach($sect_list as $sect_id => $sect_title){  
			echo draw_calendar($cur_month,$cur_year,$ar_reserves,$hvars[$sect_id], $sect_title);			 
		}
		?>
 				
		<?				
		$days_in_month = date('t',mktime(0,0,0,$cur_month,1,$cur_year));
		$global_zagruzka=$GLOBALS['all_sucсess']/$GLOBALS['rooms_count']/$days_in_month*100; 		
		?>		
		<hr>
		<p><b>Загрузка по всем номерам: <?=round($global_zagruzka)?>%</b></p>
	</div>

</div>

	<?
	/*
	echo '<pre>';
	print_r($ar_reserves);
	echo '</pre>';
	*/
	?> 
											

	<!-- ФОРМА БРОНИРОВАНИЯ start--> 

	<div style="display:none">
		<div id="booking_form" >
			
			<p><b>Забронировать:</b> <span id="room_title"> </span></p> 
			 			
			<table>				
				<tr><td>Дата заезда</td>  <td> <input id="booking_date_from" autocomplete="off" type="text" value="" /></td></tr>
				<tr><td>Дата выезда</td>  <td><input id="booking_date_to" autocomplete="off" type="text" value="" /></td></tr>					
				<tr><td>ФИО</td>  <td><input id="booking_fio" type="text" autocomplete="off" value=""  /></td></tr>
				<!-- 
					<tr><td>Количество отдыхающих</td>  <td><input id="booking_clients_numb" type="number" value="1"  /></td></tr>
					<tr><td>Телефон</td>  <td><input id="booking_phone" type="text" value=""  /></td></tr>
				<tr><td>E-mail</td>  <td><input id="booking_email" type="text" value=""  /></td></tr> -->
				
			</table>
			
			<input style="display:none;" type="text" id="room_id" />						
			<input style="display:none;" type="text" id="book_id" /> <br><br>
			
			<a style="left:150px;" id="book_send" class="book_btn">Сохранить</a>
			<img id="wait" src="<?=SITE_TEMPLATE_PATH?>/icons/load.gif">
			
			<br><br>
			<div style="text-align:center;" id="response"></div>
			
		</div>
	</div>
	  
	 
	<!-- ФОРМА БРОНИРОВАНИЯ  end   --> 


<script type="text/javascript">

jQuery(document).ready(function($) {
    
    // календари в полях
    jQuery.datetimepicker.setLocale('ru');

    jQuery(function(){
     jQuery('#booking_date_from').datetimepicker({
      format:'d.m.Y H:i',
      formatDate:'d.m.Y',
      onShow:function( ct ){
       this.setOptions({
        maxDate:jQuery('#booking_date_to').val()?jQuery('#booking_date_to').val():false
       })
      },
     });
     
     jQuery('#booking_date_to').datetimepicker({
      format:'d.m.Y H:i',
      formatDate:'d.m.Y',
      onShow:function( ct ){
       this.setOptions({
        minDate:jQuery('#booking_date_from').val()?jQuery('#booking_date_from').val():false
       })
      },
     });
    });
 
    $('.test').fancybox();
   
	<?if($USER->IsAdmin()):?>

		$(document).on('click', ".day-free", function(){
		
			/*очистка формы*/				
			$("#booking_form input").each(function(){ 
				$(this).val(''); 
			});
			
			var room=$(this).parent().parent().attr('id')		
			var room_title=$(this).parent().parent().attr('room_title'); 
			var ar_room=room.split('_');
			var room_post_id=ar_room[1];
			
			var data=$(this).attr('id');		
			
			$("#room_id").val(room_post_id);		
			$("#room_title").html(room_title);	 	
			$("#booking_date_from").val(data);		
			//$("#booking_date_to").val(data);
			
			$('.test').click();
		
		});

	<?endif;?>
 
    /*заполняем поле город*/
    $('select[name=month]').change(function(){ 
        var cur_year='';
        cur_year=$(':selected', this).attr('year');
        
        $('input[name="yearr"]').val(cur_year); 
    });
     
    $('.book_info_close').click(function(){			
        $(this).parent().hide();			
    });
    
 
    $('.day-reserved').click(function(){
    
        var book_id=$(this).attr('id');		
        var book_info_id=book_id+'-info';	
        
        $("#"+book_info_id).show();	    
    });
   
    
    //сохранение брони
    function booked_reload(){        
        location.reload();        
    }
    
    $(document).on('click', "#book_send", function(){
                  
        $("#wait").show(); 
        
        var ar_arriv=$("#booking_date_from").val().split(' '); 
        var ar_depart=$("#booking_date_to").val().split(' '); 
        
        $.post(
            '/booking/add.php',
            {
                book_id:$("#book_id").val(),
                room_id:$("#room_id").val(),
                date_start: ar_arriv[0], //$("#booking_date_from").val(),
                date_end:  ar_depart[0],//$("#booking_date_to").val(),
                arrival:ar_arriv[1],
                departure:ar_depart[1], 
                fio:$("#booking_fio").val(),
                source:'site',

                //people:$("#booking_clients_numb").val(),
                //phone:$("#booking_phone").val(),
                //email:$("#booking_email").val()
            },
            function(data) {

                $('#response').html(data);
                $("#wait").hide();

                if(data.indexOf('занят') == -1 && data.indexOf('доступен') == -1) 
					setTimeout(booked_reload, 2);
            }
        );
    
    });
    
     
    
    $(".book_info_edit").click(function(){
                  
        var book_to_edit=$(this).parent().attr('id');	
        var ar_book_to_edit=book_to_edit.split('-');
        var book_id=ar_book_to_edit[0];
        //var people=$('#'+book_id+'-people').html();
        //var email=$('#'+book_id+'-email').html();
        //var phone=$('#'+book_id+'-phone').html();

        var fio=$('#'+book_id+'-fio').html();
        var dates=$('#'+book_id+'-dates').html();
         
        var ar_dates=dates.split(' - ');
        date_start=ar_dates[0];
        date_end=ar_dates[1];
                           
        $('#booking_date_from').val(date_start);
        $('#booking_date_to').val(date_end);
        $('#booking_fio').val(fio);

        // $('#booking_clients_numb').val(people);
        // $('#booking_phone').val(phone);	
        // $('#booking_email').val(email);	

        $('#book_id').val(book_id);				  
         
        var room=$(this).closest('tr').attr('id');		
        var room_title=$(this).closest('tr').attr('room_title'); 
        var ar_room=room.split('_');
        var room_post_id=ar_room[1]; 
        
        $("#room_id").val(room_post_id);		
        $("#room_title").html(room_title);	
		
        console.log($('#book_id').val());
        console.log($('#room_id').val());
        console.log(fio);
		            
        $('.test').click(); 
    });
    
     
    $(".book_delete").click(function(){
                  
        var book_to_delete=$(this).parent().attr('id');	
        var ar_book_to_delete=book_to_delete.split('-');
                              
        result = confirm('Вы уверены, что хотите удалить бронь?');
                            
        if(result){				 
            $.post(
                '/booking/delete.php',
                {
                    book_id:ar_book_to_delete[0],
                },
                function(data) {

                    setTimeout(booked_reload, 2);
                }
            );
        }
    });
     
  
}); 

</script>

 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>