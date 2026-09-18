<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
use Altaykz\Booking;
CModule::IncludeModule("iblock");
 
// date_default_timezone_set('Etc/GMT-5');
 
//этот скрипт вызывается с портала и принимает оттуда id новой сделки
$deal_id = $_REQUEST['data']['FIELDS']['ID'];

{
    //чтобы в crm не стучалась слишком часто
    $memcache_obj = new Memcache; 
    $memcache_obj->connect('127.0.0.1', 11211) or die('Could not connect');
    $temp_var = 'deal_'.$deal_id;
    $cur_deal_id = @$memcache_obj->get($temp_var);

    if(!empty($cur_deal_id))
    {    
        //writeToLog($deal_id, '!!!DELETED REQUEST!!! memcache_obj --- cur_deal_id = '.$cur_deal_id);
        die('memcache_obj error cur_deal_id');
    } 
    else $memcache_obj->set($temp_var, $deal_id, false, 3);  
    $memcache_obj->close(); 
}

//по ид сделки получаем все значения свойств сделки
$queryUrl ='https://altaykz.bitrix24.kz/rest/1/ohbsnd9ulxke3t7m/crm.deal.get.json';
$queryData = http_build_query(array(
    'id' => $deal_id
));

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_POST => 1,
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $queryUrl,
    CURLOPT_POSTFIELDS => $queryData,
));

$result = curl_exec($curl);
curl_close($curl);
$deal_res = json_decode($result, true);

if(empty($deal_res))
{    
    writeToLog($_REQUEST, 'incoming  ---  empty $deal_res --- deal_id = '.$deal_id);
    die();
}

if($deal_res['result']['CATEGORY_ID'] != '0')
{ 
    die('Не та воронка');
} 

//writeToLog($_REQUEST, 'incoming  -------------- INITIAL ---------- deal_id = '.$deal_id);

$ar_resorts = Array(
    51 => 's1',
    53 => 's2',
    55 => 's3',
);
$resort_site = $ar_resorts[$deal_res['result']['UF_CRM_1690806402362']];
 
$booking_handler = new Booking($resort_site);

$sites = $booking_handler->sites;
 
$deal = array();
  
$deal['roomsIblock'] = $sites[$resort_site]['roomsIblock'];
$deal['date_time_start'] = $deal_res['result']['UF_CRM_1663234208235'];
$deal['date_time_end'] = $deal_res['result']['UF_CRM_1690815389'];
$deal['book_id'] = intval($deal_res['result']['UF_CRM_1693931478']);
$deal['stage'] = $deal_res['result']['STAGE_ID'];
$deal['prepayment'] = ($deal['stage'] == 'EXECUTING' || $deal['stage'] == 'UC_9A1DKJ') ? 1 : 0; 

// writeToLog($deal, 'incoming deal_props_res');

$ar_arrive = explode(' ', date('d.m.Y H:i', strtotime($deal['date_time_start'].'+2 hours')));
$ar_depart = explode(' ', date('d.m.Y H:i', strtotime($deal['date_time_end'].'+2 hours')));
// $ar_arrive = explode(' ', date('d.m.Y H:i', strtotime($deal['date_time_start'])));
// $ar_depart = explode(' ', date('d.m.Y H:i', strtotime($deal['date_time_end'])));

//работаем только с этапами сделки Успешно завершена, Счет на Предоплату, внесена Предоплата  
if($deal['stage'] == 'WON' || $deal['stage'] == 'EXECUTING' || $deal['stage'] == 'UC_9A1DKJ')
{
    
    //получаем id номера на сайте по id номера из crm
    $arSelect = Array("ID", "NAME", "PROPERTY_CRM_ID");
    $arFilter = Array("IBLOCK_ID" => $sites[$resort_site]['roomsIblock'], "ACTIVE"=>"Y", "PROPERTY_CRM_ID" => $deal_res['result']['UF_CRM_1691302058269']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    if($arFields = $res->GetNext())
    {
        $room_id = $arFields['ID'];
    }
    else
    { 
        die('room not found');
    } 
 

    $deal['room'] = $room_id;
 
    $book_info = array(
        'room_id' => $room_id,
        'deal_id' => $deal_id,        
        'date_start' => $ar_arrive[0],
        'time_start' => $ar_arrive[1],
        'date_end' => $ar_depart[0],
        'time_end' => $ar_depart[1],
        'prepayment' => $deal['prepayment'],
    );  
    
    //если это создание брони
    if($deal['book_id'] == 0)
    {
        //проверяем нет ли уже брони по этой сделке
        $arSelect = Array("ID", "NAME", "PROPERTY_deal_id");
        $arFilter = Array("IBLOCK_ID" => $sites[$resort_site]['bookingIblock'], "ACTIVE" => "Y", "PROPERTY_deal_id" => $deal_id);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if($arFields = $res->GetNext())
        {
            // writeToLog($deal_id, 'incoming REPEAT deal_id');
            die();
        }

        $book_id = $booking_handler->add($book_info); 

		if($book_id)
        {
            writeToLog( 'incoming deal NEW $book_id = '.$book_id.' $deal_id = '.$deal_id);
		}		
		else{
            // writeToLog($booking_handler->last_error, 'local add error - '.$deal_id); 
            die();
        }  

    } //обновление брони
    else
    {    
		if($booking_result = $booking_handler->update($deal['book_id'], $book_info))
        {
            // writeToLog($update_result, 'internal book_update_result $booking_result = '.$booking_result.' $deal_id = '.$deal_id);
		}		
		else
        {
            writeToLog($booking_handler->last_error, 'local update error');

            die();
        } 
    } 
    
}
elseif($deal['book_id'] != 0) //иначе удаляем бронь если была и очищаем в сделке по book_id
{
   
    //очищаем в сделке  book_id
    $queryUrl ='https://altaykz.bitrix24.kz/rest/1/butzyhcav8y1ay1k/crm.deal.update.json';
    $queryData = http_build_query(array(
        'id' => $deal_id,
        'fields' => array(
            "UF_CRM_1693931478" => ''   
        ),
    ));

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $queryUrl,
        CURLOPT_POSTFIELDS => $queryData,
    ));

    $result = curl_exec($curl);
    curl_close($curl);
    $update_result = json_decode($result, true);
    
    // writeToLog($update_result, 'incoming book delete');

    CIBlockElement::Delete($deal['book_id']);     
}
elseif($_REQUEST['event'] == 'ONCRMDEALUPDATE') //если это обновление сделки помимо созданий и отмены брони
{

    // writeToLog($deal_id, 'ONCRMDEALUPDATE incoming deal EXCEPT NEW booking');
 
} 
  
//если это создание сделки, значит нужно назначить ответственного в зависимости от адреса в заказе
// if($_REQUEST['event']=='ONCRMDEALADD') {
 
// }
 


?>
