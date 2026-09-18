<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"] . '/reports/crest.php');
use Bitrix\Main\Type;
use Altaykz\OrdersTable;
use Altaykz\Booking;

\Bitrix\Main\Loader::includeModule("iblock");
\Bitrix\Main\Loader::includeModule("pay");


date_default_timezone_set('Europe/Moscow');

//получаем цену
if(isset($_POST['action']) && $_POST['action'] == 'get_price'){

	if(strtotime($_POST['date_start']) > strtotime($_POST['date_end'])){
		echo '0';
		die();	
	} 
	$total_summ = \Altaykz\Calculate::handle($_POST); 
	echo $total_summ;
}


//создаем заказ при вызове окна платежной системы
if(isset($_POST['action']) && $_POST['action'] == 'check_dates'){
  
	$booking_handler = new Booking(); 
	$check_dates_result = $booking_handler->check_dates(
		$_POST['room_id'], 
		$_POST['date_start'],  
		$_POST['time_from'],
		$_POST['date_end'], 
		$_POST['time_to'],  
	);
	if($check_dates_result != 'allowed')          
		die($check_dates_result);	

	$date_start = date('Y-m-d H:i:s', strtotime($_POST['date_start'])); 
	$date_end = date('Y-m-d H:i:s', strtotime($_POST['date_end'])); 

	$res = OrdersTable::add([
		"TITLE" => htmlspecialchars(str_replace('"','',$_POST["room_title"])), 
		"ROOM_ID" => htmlspecialchars($_POST['room_id']),
		"DATE_START" => new Type\Date($date_start, 'Y-m-d H:i:s'),
		"DATE_END" => new Type\Date($date_end, 'Y-m-d H:i:s'),
		"TIME_START" => htmlspecialchars($_POST['time_from']),
		"TIME_END" => htmlspecialchars($_POST['time_to']),
		"FIO"  => htmlspecialchars($_POST['fio']),
		"EMAIL"  => htmlspecialchars($_POST['email']),
		"PHONE"  => htmlspecialchars($_POST['phone']),
		"PEOPLE"  => (int)$_POST['people'],
		"CHILDS"  => (int)$_POST['childs'],
		"IF_VV"  => $_POST['if_vv'] == 'true' ? 1 : 0,
		"IF_BESEDKA"  => $_POST['if_besedka'] == 'true' ? 1 : 0,
		"SUMM"  => \Altaykz\Calculate::handle($_POST),  
		"SITE_ID" => 's1'
	]); 

	if ($res->isSuccess()) 
		echo $res->getId(); 
 
}

 
if(isset($_REQUEST['method']) && $_REQUEST['method'] == 'check'){

	$InvoiceId = htmlspecialchars($_REQUEST['InvoiceId']);
	 
	$order = \Altaykz\OrdersTable::getByPrimary($InvoiceId)->fetchObject();

	$booking_handler = new Booking(); 

	$check_dates_result = $booking_handler->check_dates(
		$order->get("ROOM_ID"), 
		$order->get("DATE_START"),
		$order->get("TIME_START"),
		$order->get("DATE_END"), 
		$order->get("TIME_END"),  
	);
  
	if($check_dates_result == 'allowed')
	{
		$resp = array('CODE' => 0); 
	}
	else 
	{
		$resp = array('CODE' => 20);
	}

	echo json_encode($resp);
}
 
//задаем понятные имена полям crm
define("RESORT", "UF_CRM_1690806402362"); 
define("ROOM", "UF_CRM_1691302058269"); 
define("SELL_DATE", "UF_CRM_1692715617988");
define("DATE_FROM", "UF_CRM_1663234208235"); 
define("DATE_TO", "UF_CRM_1690815389"); 
define("DAYS_COUNT", "UF_CRM_1690865436882"); 
define("PEOPLE", "UF_CRM_1690865551206");
define("CITY", "UF_CRM_1691426904993");
define("PAYMENT_TYPE", "UF_CRM_1691770333797");
define("WHAT_INCLUDED", "UF_CRM_1690865749589");
define("SOURCE", "UF_CRM_1690879319228");
define("FOOD", "UF_CRM_1691596805565");
$ar_resorts = Array(
	's1' => 51,
	's2' => 53,
	's3' => 55,
);

//оплата
if(isset($_REQUEST['method']) && $_REQUEST['method'] == 'pay'){
  
	// $response = json_decode(file_get_contents('php://input'), true); 
	// $_REQUEST['InvoiceId'] = $response['payment']['id']; 

	// writeToLog($_REQUEST, 'pay _REQUEST');

	$InvoiceId = htmlspecialchars($_REQUEST['InvoiceId']);
	$order = \Altaykz\OrdersTable::getByPrimary($InvoiceId)->fetchObject();
	
	if($order->get("PAY") != 1  /*&& get_post_status($_REQUEST['InvoiceId']) !== false */){ 

		$order->set('PAY', 1);
		$order->save(); 

		//сначала проверяем есть ли такой контакт уже	
		$existingContact = CRest::call('crm.contact.list',
			[
				'filter' =>  ["PHONE" => $order->get("PHONE")],
				'select' => [ "ID", "NAME", "LAST_NAME"]
			]
		);  		
		//vd($existingContact); 
		if(!empty($existingContact['result'])) 
			$ContactId = $existingContact['result'][0]['ID'];
		else{
			//если контакта нет то создаем
			$newContact = CRest::call('crm.contact.add',
				[
					'fields' =>  [
						"NAME" => $order->get("FIO"),					
						"EMAIL" => [ [ "VALUE" => $order->get("EMAIL"), "VALUE_TYPE" => "WORK" ] ] ,
						"PHONE" => [ [ "VALUE" => $order->get("PHONE"), "VALUE_TYPE" => "MOBILE" ] ] ,
						"OPENED" => "Y", 
						"ASSIGNED_BY_ID" => 1, 
						"TYPE_ID" => "CLIENT", 
					], 
				]
			);  		 
			//vd($newContact); 		
			$ContactId = $newContact['result'];
		} 

		$arArriveDate = explode(' ', $order->get("DATE_START"));
		$arDepartDate = explode(' ', $order->get("DATE_END"));

		$arrive = $arArriveDate[0].' '.$order->get("TIME_START");
		$depart = $arDepartDate[0].' '.$order->get("TIME_END");

		$sell_date = date('d.m.Y').' 15:00';
		
		$date_from_format = date_create($arrive)->modify('-4 hours');
		$date_to_format = date_create($depart)->modify('-4 hours');
		$sell_date_format = date_create($sell_date); 
		// date_default_timezone_set('Asia/Almaty');

			
		$booking_handler = new Booking(); 
		$sites = $booking_handler->sites;
		
		//получаем id номера в crm по id номера с сайта 
		$db_props = CIBlockElement::GetProperty($sites[$order->get("SITE_ID")]['roomsIblock'], $order->get("ROOM_ID"), array("sort" => "asc"), Array("CODE"=>"CRM_ID"));
		if($ar_props = $db_props->Fetch())
			$ROOM_ID = IntVal($ar_props["VALUE"]);
			
		$FOOD = 1217; // завтрак + обед
		$WHAT_INCLUDED = 145; //без опций . 83 - с лечением
		if($order->get("IF_VV") == 1){
			$FOOD = 1219; // завтрак + обед + ужин
			$WHAT_INCLUDED = 81; //с катанием
		}			
		if($order->get("IF_BESEDKA") == 1){
			$FOOD = 1329; // без питания 
		}			

		$datetime1 = new DateTime($arrive);
		$datetime2 = new DateTime($depart);
		$interval = $datetime1->diff($datetime2); 
		$daysCount = $interval->days + 1; 
		
		$addFields = array( 
			"TITLE"  =>  "Онлайн оплата №".$InvoiceId,  
			"STAGE_ID" =>  "WON", 	 
			"CONTACT_ID"  =>  $ContactId,
			"OPENED"  =>  "Y", 
			"ASSIGNED_BY_ID" => 1,  
			"CURRENCY_ID" =>  "KZT", 
			"OPPORTUNITY" =>  (int)$order->get("SUMM"),
			"CATEGORY_ID" =>  0,    
			DATE_FROM => date_format($date_from_format,"c"),
			DATE_TO => date_format($date_to_format,"c"), 
			SELL_DATE => date_format($sell_date_format,"c"),
			DAYS_COUNT => $daysCount,  
			RESORT => $ar_resorts[$order->get("SITE_ID")],  
			ROOM => $ROOM_ID,//143, //207
			PEOPLE => $order->get("PEOPLE"),  
			WHAT_INCLUDED => $WHAT_INCLUDED, 
			FOOD => $FOOD,
			CITY => 193, //ukg
			PAYMENT_TYPE => 1223, // безнал
			SOURCE => 117, // Онлайн покупка 				
		);
		$respDeal = CRest::call('crm.deal.add',['fields' =>  $addFields]); 
		//vd($rooms); 
		writeToLog(array_merge($addFields, $respDeal), 'payment crm New Deal');

	}

	$resp = array('CODE' => 0);
		
	echo json_encode($resp);
}
?>