<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");


//получаем все свойства номера
CModule::IncludeModule('iblock');  
	 
$times = array();
$cables = array();

$arSelect = Array("IBLOCK_ID", "ID", "CODE", "SORT", "NAME", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement()){

  $arFields = $ob->GetFields();
  $arProps  = $ob->GetProperties(); 

  foreach($arProps['TIMES']['VALUE'] as $key => $weekday){

    //дни недели неудобно, используем их ключи которые будут удобны для функции date 
    $weekday_numb = $key + 1;
    if($key == 6) $weekday_numb = 0; // вс - это 0 в функции date

    if(strpos($arProps['TIMES']['DESCRIPTION'][$key], '-') != 0){
      $ar_cur_time = explode('-', $arProps['TIMES']['DESCRIPTION'][$key]);
      $times[$arFields['SORT']][$weekday_numb] = array($ar_cur_time[0], $ar_cur_time[1]); 
    } 
    else{ 
      $times[$arFields['SORT']][$weekday_numb] = array($arProps['TIMES']['DESCRIPTION'][$key]); 
    } 

  }
 
  $cables[$arFields['SORT']] = $arFields['NAME'];
   
}
$night_times[1] = $times[5];
unset($times[5]);


// echo '<pre>'; 
// print_r($times); 
// print_r($night_times); 
// echo '</pre>';

 
?>
