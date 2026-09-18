<?php 
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Altaykz\Booking;

if(isset($_REQUEST['source']) && $_REQUEST['source'] == 'site'){
 
	$booking_handler = new Booking();	
 
	$book_info = array(
		'room_id' => $_POST['room_id'],
		'date_start' => $_POST['date_start'],
		'time_start' => $_POST['arrival'],
		'date_end' => $_POST['date_end'],
		'time_end' => $_POST['departure'],
		'prepayment' => true,
	); 
	$client_info = array(
		'fio' => $_POST['fio'],
	); 

	if($_POST['book_id'] == ''){
	
		if($booking_result = $booking_handler->add($book_info, $client_info)){
			echo 'Данные успешно сохранены. ID брони: '.$booking_result;
		}		
		else echo $booking_handler->last_error;
	}
	else{
	
		if($booking_result = $booking_handler->update($_POST['book_id'], $book_info, $client_info)){
			echo 'Данные успешно сохранены';
		}		
		else echo $booking_handler->last_error;
	}
	  
}
elseif(isset($_REQUEST['source']) && $_REQUEST['source'] == 'amo'){
 
	CModule::IncludeModule("iblock");

	$arSelect = Array("ID", "NAME", "PROPERTY_NUMID");
    $arFilter = Array("IBLOCK_ID" => 3, "ACTIVE" => "Y", "PROPERTY_NUMID" => $_POST['room']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if($arFields = $res->GetNext()){
        $room_id = $arFields['ID']; 
    }	
 
	$book_info = array(
		'room_id' => $room_id,
		'date_start' => $_POST['date_start'],
		'time_start' => $_POST['arrival'],
		'date_end' => $_POST['date_end'],
		'time_end' => $_POST['departure'],
		'prepayment' => 0,
	); 
	$client_info = array(
		'fio' => $_POST['fio'],
	);  
	
	$booking_handler = new Booking();
	$booking_result = $booking_handler->add($book_info, $client_info);
}
?>