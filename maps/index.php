<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Схема курорта");
$APPLICATION->SetPageProperty("keywords", "схема курорта, карта, маршрут");
$APPLICATION->SetPageProperty("description", "Легко ориентируйтесь на курорте, используя схему.");
$APPLICATION->SetTitle("Схема курорта");
?>


<div class="position-relative">

	<a data-fancybox="gallery_rent" href="/slider/maps_full.jpg">					
		<img src="/slider/maps_full.jpg" style="width: 100%;">	
		<svg viewBox="0 0 24 24" id="zoom"><title>zoom</title><path fill="currentColor" d="M21 19.59l-5.4-5.4a7 7 0 1 0-1.41 1.41l5.4 5.4zM10 15a5 5 0 1 1 5-5 5 5 0 0 1-5 5zm3-4.57h-2.57V13h-.86v-2.57H7v-.86h2.57V7h.86v2.57H13z"></path></svg>				 
	</a>

</div>
 

<div class="container mt-5 mb-5"> 

  <div class="d-md-flex d-block justify-content-around">
    <div class="prices_div"> 
  	<a class="what_included" href="/worktime/"><span style=" background-color: #ff7300;  ">Схема склонов</span> </a>
    </div>
    <div class="prices_div"> 
  	<a class="what_included" href="/rooms/"><span style=" background-color: #7ab734;  ">Домики</span> </a>
    </div>
    <div class="prices_div"> 
  	<a class="what_included" href="/pavilions/"><span style=" background-color: #7ab734;  ">Беседки</span> </a>
    </div>
  </div>

</div>

<style type="text/css">
  .prices_div{        
    margin: 10px 0;
  }
	.what_included{
		margin: 20px 0 30px 0;
    	cursor: pointer;
	}
  .what_included:hover span{
    box-shadow: 0 4px 8px 0 black;
  }
  .what_included span{
    font-size: 20px;
    background-color: #7ab734;
    color: white; 
    padding: 10px 30px 13px 30px;
    width: 230px;
    display: block; 
    text-align: center;
    border-radius: 20px;
    margin: auto;
  } 
   a.what_included:hover{ 
    text-decoration: none !important; 
  }
	@media (max-width: 768px){
  	 
  	.what_included{
  		margin: 20px 0 30px 0 !important;
  	}
  } 
</style>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>