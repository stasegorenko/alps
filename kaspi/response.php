 <?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Type;
use Bitrix\Main\Loader;
use Altaykz\OrdersTable;
use Altaykz\Booking;

Loader::includeModule("iblock");
Loader::includeModule("pay");
 

//проверка перед оплатой
if(isset($_REQUEST['command']) && $_REQUEST['command'] == 'check')
{
    writeToLog($_REQUEST, 'check _REQUEST kaspi'); 
	
    $InvoiceId = htmlspecialchars($_REQUEST['account']);
     
    $order = OrdersTable::getByPrimary($InvoiceId)->fetchObject();

	$sites = [
		's1' => 'ГК «Алтайские Альпы»',
		's2' => 'Санаторий «Изумрудный»',
		's3' => 'База отдыха «Аюда»',
	]; 
	
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
		$result = 0; 
	}
	else 
	{
		$result = 1;
	}

	$response = [ 
		'sum' => $order->get("SUMM"),
		'txn_id' => $_REQUEST['txn_id'], 
		'result' => $result,
		'fields' => [
			'field1' => [
				'@name' => 'title',
				'#text' => $sites[$order->get("SITE_ID")],
			]
		]
	];

    echo json_encode($response);
}
  

// оплата
if(isset($_REQUEST['command']) && $_REQUEST['command'] == 'pay')
{ 
	
	$params = [
		'InvoiceId' => $_REQUEST['account'],
		'method' => 'pay',
	];

	$ch = curl_init('https://alps.altay.kz/booking/check_pay.php');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$response = curl_exec($ch);
	curl_close($ch);
	
    
	$resp = array('result' => 0);    
		
    echo json_encode($resp);
}
?> 