<?   
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Бронирование");
$APPLICATION->SetPageProperty("keywords", "Гостиничные номера, забронировать, альпийские домики, аренда,");
$APPLICATION->SetPageProperty("description", "Атмосферные номера в Альпийских домиках");
use Altaykz\Booking;
$APPLICATION->SetTitle("Забронировать номер"); 
include('conditions.php');
?>
 
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/libs/datetimepicker/jquery.datetimepicker.css" >
<script src="<?=SITE_TEMPLATE_PATH?>/libs/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>

<!-- 
<script src="https://widget.cloudpayments.kz/bundles/cloudpayments"></script> 

<link rel="stylesheet" href="https://paymentpage.jetpay.kz/shared/merchant.css" />
<script type="text/javascript" src="https://paymentpage.jetpay.kz/shared/merchant.js"></script>-->

<img src="/slider/intro1.jpg" style="width: 100%" class="inner-hero__video d-md-block d-none"></img>
<img src="/slider/intromini.jpg" style="width: 100%" class="inner-hero__video d-md-none d-block"></img>

<div class="cottages_search_div">
<div class="container">
<form class="cottages_search d-md-flex d-block" action="/rooms/"> 		

	<div class="text_input">
		<p>Дата заезда</p> 
		<input type="text" autocomplete="off" name="date_from" id="date_from" value="<?=$_GET["date_from"]?>"> 
	</div>
	<div class="text_input">
		<p>Дата выезда</p> 
		<input type="text" autocomplete="off" name="date_to" id="date_to" value="<?=$_GET["date_to"]?>"> 
	</div> 
	<?		
	$booking_handler = new Booking();
	$selected_room = (isset($_GET['room_id']) && $_GET['room_id'] != '') ? $_GET['room_id'] : '';
	?>		 
	<div class="text_input text_input_select">
		<p>Номер</p> 
		<select name="room_id" >
			<option value=""> -- Выберите номер -- </option> 
			<?=$booking_handler->buildRoomsList($selected_room, array('!IBLOCK_SECTION_ID' => 8));?> 
		</select>
	</div>
		
	<div> <input type="submit" value="Найти">	</div>			

</form>
</div>
</div> 

<?
$roomsFilter = array(
	'!IBLOCK_SECTION_ID' => 8
);
//если выбран номер то фильтруем только по номеру не учитывая даты
if(isset($_GET['room_id']) && $_GET['room_id'] != ''){	
	$roomsFilter['ID'] = htmlspecialchars($_GET['room_id']);
}
elseif(isset($_GET['date_from']) && $_GET['date_from'] != '' &&  isset($_GET['date_to']) && $_GET['date_to'] != ''){	
	$roomsFilter['!ID'] = $booking_handler->get_reserved_rooms($_GET['date_from'], $_GET['date_to']);
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"rooms",
	Array(
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
		"FIELD_CODE" => array("ID",""),
		"FILTER_NAME" => "roomsFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "alps",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "100",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("BEDS","BEDS_MAX","MORE_PHOTO_LINKS","NUMID","PRICE_HOLIDAY_SUMMER","PRICE_HOLIDAY_WINTER","PRICE_NEWYEAR","PRICE_SUMMER","PRICE_VV_HOLIDAY","PRICE_VV_NEWYEAR","PRICE_VV_SUMMER","PRICE_VV_WINTER","PRICE_WINTER",""),
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
		"STRICT_SECTION_CHECK" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>