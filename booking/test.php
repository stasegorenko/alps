<?php 
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); 
require($_SERVER["DOCUMENT_ROOT"] . '/reports/crest.php');
use Bitrix\Main\Type;
use Altaykz\Booking; 
use Altaykz\OrdersTable;
 
\Bitrix\Main\Loader::includeModule("iblock");
\Bitrix\Main\Loader::includeModule("pay");


// //проверяем нет ли уже брони по этой сделке
// $arSelect = Array("ID", "NAME", "PROPERTY_deal_id");
// $arFilter = Array("IBLOCK_ID" => 6, "ACTIVE" => "Y", ">=ID" => 2438);
// $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
// while($arFields = $res->GetNext()){ 
//     vd($arFields);

//     $deal_id = $arFields['PROPERTY_DEAL_ID_VALUE'];
//     $book_id = $arFields['ID'];

//     //записываем id брони в сделку
//     $queryUrl ='https://altaykz.bitrix24.kz/rest/1/butzyhcav8y1ay1k/crm.deal.update.json';
//     $queryData = http_build_query(array(
//         'id' => $deal_id,
//         'fields' => array(
//             "UF_CRM_1693931478" => $book_id   
//         ),
//     ));

//     $curl = curl_init();
//     curl_setopt_array($curl, array(
//         CURLOPT_SSL_VERIFYPEER => 0,
//         CURLOPT_POST => 1,
//         CURLOPT_HEADER => 0,
//         CURLOPT_RETURNTRANSFER => 1,
//         CURLOPT_URL => $queryUrl,
//         CURLOPT_POSTFIELDS => $queryData,
//     ));

//     $result = curl_exec($curl);
//     curl_close($curl);
//     $update_result = json_decode($result, true);

//     vd($update_result);


// }

 
global $DB;
//$res = $DB->Query('SELECT * FROM altaykz_orders');
//$res = $DB->Query("ALTER TABLE altaykz_orders ADD SITE_ID VARCHAR(255)");
// $res = $DB->Query("ALTER TABLE altaykz_orders MODIFY `CHILDS` int"); 
//$res = $DB->Query("DELETE FROM altaykz_orders WHERE ID > 63"); 

//vd($res->Fetch());


// $rooms = CRest::call('crm.deal.userfield.list',['filter' => ["ID" => "387"]]); 
// foreach($rooms['result'][0]['LIST'] as $room){
// 	$arRooms[$room['ID']] = $room['VALUE'];
// }  
  
// echo 'Все значения в crm: ';
// vd($arRooms);




$date = '2023-11-12 22:43:00';  

// $res = OrdersTable::add([
//     "TITLE" => "testorder345",
//     "ROOM_ID" => 22,
//     "DATE_START" => new Type\Date($date, 'Y-m-d H:i:s'),
//     "DATE_END" => new Type\Date($date, 'Y-m-d H:i:s'),
//     "TIME_START" => '14:00',
//     "TIME_END" => '12:00',
//     "FIO"  => "testFIO",
//     "EMAIL"  => "testEMAIL",
//     "PHONE"  => "testPHONE",
// 	"PEOPLE"  => 33,
//     //"CREATED"  => $objDateTime->getTimestamp(),
// ]); 
// //vd(get_class_methods($res));
// if ($res->isSuccess())
// {
// 	$id = $res->getId();
// }
// echo $id;
// vd($res);
 

//TODO: при вызове со стороны платежки нужен update и для отправки в CRM getlist

// $id = 7;
// $res = OrdersTable::update($id, [ 
//     "PAY"  => 1,
// ]); 
// //vd(get_class_methods($res));
// if ($res->isSuccess())
// {
// 	$id = $res->getId();
// }
// echo $id;
// vd($res);
  
// $order_id = 6;
// $fieldName = 'PAY';
// $fieldvalue = 1;
// $order = Altaykz\OrdersTable::getByPrimary($order_id)->fetchObject();

// $title = $order->getTitle();
// echo $title;
// $order->set($fieldName, $fieldvalue);
// $order->save();
//echo $order->get($fieldName);



/*test getList*/
$res = OrdersTable::getList([ 
	'select' => array('*')
]); 

/*через коллекции*/
$resultCollection = $res->fetchCollection()->getAll();
//vd(get_class_methods($resultCollection[0]));
// foreach($resultCollection as $item){    
//     vd($item->collectValues()); 
// } 
/*через массив*/
// while ($result = $res->Fetch())
// { 
//     vd($result);
// }  
  

 
// CModule::IncludeModule("iblock");
// $found_rooms = array(); 
// foreach($ar_rooms as $site_room_numb => $crm_room_id){

//     //$site_room_numb = strtr($site_room_numb,array('аб'=>'a','а'=>'a','б'=>'b','А'=>'a','Б'=>'b','/'=>'-'));
        
//     $arSelect = Array("ID", "NAME", "PROPERTY_NUMID");
//     $arFilter = Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y", "PROPERTY_NUMID" => $site_room_numb);
//     $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
//     if($arFields = $res->GetNext()){
//         $room_id = $arFields['ID'];
//         $found_rooms[$room_id] = $arFields['PROPERTY_NUMID_VALUE']; 
//         //CIBlockElement::SetPropertyValuesEx($room_id, false, array('CRM_ID' => $crm_room_id));
//     }
// }

// vd($found_rooms);
// echo 'всего найдено на сайте '. count($found_rooms);
 


// //задаем понятные имена полям crm
// define("RESORT", "UF_CRM_1690806402362"); 
// define("ROOM", "UF_CRM_1691302058269"); 
// define("SELL_DATE", "UF_CRM_1692715617988");
// define("DATE_FROM", "UF_CRM_1663234208235"); 
// define("DATE_TO", "UF_CRM_1690815389"); 
// define("DAYS_COUNT", "UF_CRM_1690865436882"); 
// define("PEOPLE", "UF_CRM_1690865551206");
// define("CITY", "UF_CRM_1691426904993");
// define("PAYMENT_TYPE", "UF_CRM_1691770333797");
// define("WHAT_INCLUDED", "UF_CRM_1690865749589");
// define("SOURCE", "UF_CRM_1690879319228");
  
// date_default_timezone_set('Europe/Moscow');
// //получаем формат даты 2023-08-10T12:00:00+03:00 для фильтра

// $date_from = date('12.11.2023');  
// $date_to = date('15.11.2023');  
// $sell_date = date('10.11.2023');  
// $date_from_format = date_create($date_from);
// $date_to_format = date_create($date_to);
// $sell_date_format = date_create($sell_date);
// $date_from_formatted = date_format($date_from_format,"c"); 
// $date_to_formatted = date_format($date_to_format,"c"); 
// $sell_date_formatted = date_format($sell_date_format,"c"); 
// date_default_timezone_set('Asia/Almaty');
			      
// $addFields = array( 
//     "TITLE"  =>  "test продажа", 
//     //"TYPE_ID"  =>  "GOODS", 
//     "STAGE_ID" =>  "WON", 					
//     //"COMPANY_ID"  =>  3,
//     //"CONTACT_ID"  =>  3,
//     "OPENED"  =>  "Y", 
//     "ASSIGNED_BY_ID" => 1, 
//     "PROBABILITY" => 30,
//     "CURRENCY_ID" =>  "KZT", 
//     "OPPORTUNITY" =>  5000,
//     "CATEGORY_ID" =>  0,    
//     DATE_FROM => $date_from_formatted,
//     DATE_TO => $date_to_formatted, 
//     SELL_DATE => $sell_date_formatted,
//     DAYS_COUNT => 8,  
//     RESORT => 51, //альпы 
//     ROOM => 143, //207
//     PEOPLE => 2,  
//     WHAT_INCLUDED => 83, // с лечением
//     CITY => 193, //ukg
//     PAYMENT_TYPE => 1223, // безнал
//     SOURCE => 117, // Онлайн покупка
//     // "BEGINDATE" =>  date2str(current),
//     // "CLOSEDATE" =>  date2str(nextMonth)					
// );
// $rooms = CRest::call('crm.deal.add',['fields' =>  $addFields]); 
// vd($rooms);

?>