<?   
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Беседки");
$APPLICATION->SetPageProperty("keywords", "Аренда беседок, цены беседок, домики в Альпах");
$APPLICATION->SetPageProperty("description", "Аренда беседок в Алтайских Альпах"); 
$APPLICATION->SetTitle("Забронировать беседку"); 
CModule::IncludeModule('iblock'); 
include('conditions.php');
?>
 
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/libs/datetimepicker/jquery.datetimepicker.css" >
<script src="<?=SITE_TEMPLATE_PATH?>/libs/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>

<!-- 
<script src="https://widget.cloudpayments.kz/bundles/cloudpayments"></script> 

<link rel="stylesheet" href="https://paymentpage.jetpay.kz/shared/merchant.css" />
<script type="text/javascript" src="https://paymentpage.jetpay.kz/shared/merchant.js"></script>-->
 
<div class="cottages_search_div">
<div class="container">
<form class="cottages_search d-md-flex d-block" action="/pavilions/"> 		

	<div class="text_input">
		<p>Дата заезда</p> 
		<input type="text" autocomplete="off" name="date_from" id="date_from" value="<?=$_GET["date_from"]?>"> 
	</div>   
	<div> <input type="submit" value="Найти">	</div>			

</form>
</div>
</div> 

<?    
$date = new DateTime($_GET['date_from']);
$filter_date = $date->format('Y-m-d');
$arSelect = Array("IBLOCK_ID", "ID", "PROPERTY_room_id", "PROPERTY_date_time_start");                
$arFilter = Array("IBLOCK_ID" => IBLOCK_ALPS_BOOKING, "=PROPERTY_date_time_start" => $filter_date);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($arFields = $res->GetNext()){   
	$pavilions_to_exclude[$arFields['PROPERTY_ROOM_ID_VALUE']] = $arFields['PROPERTY_ROOM_ID_VALUE'];             
} 
	   
if(isset($_GET['date_from']) && $_GET['date_from'] != ''){	
	$roomsFilter['!ID'] = $pavilions_to_exclude;
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"pavilions", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"FILTER_NAME" => "roomsFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "alps",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "8",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "BEDS",
			1 => "BEDS_MAX",
			2 => "MORE_PHOTO_LINKS",
			3 => "NUMID",
			4 => "PRICE_HOLIDAY_SUMMER",
			5 => "PRICE_HOLIDAY_WINTER",
			6 => "PRICE_NEWYEAR",
			7 => "PRICE_SUMMER",
			8 => "PRICE_VV_HOLIDAY",
			9 => "PRICE_VV_NEWYEAR",
			10 => "PRICE_VV_SUMMER",
			11 => "PRICE_VV_WINTER",
			12 => "PRICE_WINTER",
			13 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "pavilions"
	),
	false
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>