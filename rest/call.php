<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");  

file_put_contents($_SERVER['DOCUMENT_ROOT'].'/rest/call.txt', print_r($_REQUEST, true), FILE_APPEND);  

?>
