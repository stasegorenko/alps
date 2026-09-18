<?php 
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); 
require($_SERVER["DOCUMENT_ROOT"] . '/reports/crest.php'); 

$rooms = CRest::call('crm.deal.userfield.list',['filter' => ["ID" => "387"]]); 
foreach($rooms['result'][0]['LIST'] as $room){
	$arRooms[$room['ID']] = $room['VALUE'];
}  
echo 'Все значения поля Номер: ';
vd($arRooms);


?>