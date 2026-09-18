<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Контакты");
$APPLICATION->SetPageProperty("keywords", "Контакты, алтайские альпы, связь с менеджером, альпы Whatsapp");
$APPLICATION->SetPageProperty("description", "Контакты и схема проезда");
$APPLICATION->SetTitle("Контакты");
?> 

<div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Яндекс.Карты</a><a href="https://yandex.ru/maps/?ll=82.800972%2C49.984804&mode=routes&rtext=49.979718%2C82.628236~49.945805%2C83.004788&rtt=auto&ruri=~&utm_medium=mapframe&utm_source=maps&z=12" style="color:#eee;font-size:12px;position:absolute;top:14px;">Яндекс.Карты</a><iframe src="https://yandex.ru/map-widget/v1/-/CCQ~AZbmhA" width="560" height="500" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>


<style type="text/css">
	iframe {
	    width: 100%;
	    height: 430px;
	}
	@media(max-width:768px){

		iframe {
		    width: 100%;
		    height: 380px !important;
		}

	}
</style>
 

<div class="cottages_page_div">

	<div class="container container_narrow">

		<div class="row">
			
			<div class="col-12 col-md-4 mb-3 mb-md-0 d-flex align-items-center">
				<span class="contacts_page_title" style="color: #fff;">Адрес</span>
			</div>
			<div class="col-12 col-md-8">
				<span style="color: white;">
					Республика Казахстан<br>
					Восточно-Казахстанская область, г. Усть-Каменогорск,<br>
					ул.Кабанбай Батыра, 160, корпус 1, 070000
				</span>

			</div>

		</div>
 
	</div>
</div> 
 
<div class="cottages_page_div" style="background: white;">

	<div class="container container_narrow">

		<div class="row">
			
			<div class="col-12 col-md-4 mb-3 mb-md-0">
				<span class="contacts_page_title" style="color: #546272; text-align: left;">Контакты</span>
			</div>
			<div class="col-12 col-md-8">

				<div class="row contacts_page" >					
					<div class="col-6"> 
						<div>
							<a href="tel:77774015340">+7 777 401 53 40</a><br>
							<a href="tel:77232492072">+7 (7232) 49-20-72</a> 
						</div>
					</div>			
					<div class="col-6">Менеджер</div>

					<div class="col-6"><a href="tel:77774015360">+7 777 401 53 60</a></div>
					<div class="col-6">Администратор</div>
					
					<div class="col-6"><a href="https://wa.me/77774015340" style="text-decoration: none;">+7 777 401 53 40</a></div>
					<div class="col-6">whatsapp</div>

					<div class="col-6">
						<div>
							<a href="tel:77775351094">+7 777 535 10 94</a><br>
							<a href="tel:77232249902">+7 (7232) 24-99-02</a> 
						</div>
					</div>
					<div class="col-6">Маркетинг и реклама</div>

				</div> 

				<a id="contacts_page_mail" href="mailto:zakaz@altay.kz">zakaz@altay.kz</a>

				<style type="text/css">
					 
					#contacts_page_mail{  
					  text-decoration: underline;
					  position: relative;  
					  display: inline-block;
					  color: #546272 !important;
					  margin-left: 23px;
					}  

					#contacts_page_mail:after{
					  content: '';
					  position: absolute;
					  top: 4px;
					  left: -22px;
					  width: 18px;
					  height:14px;
					  z-index: 2;   
					  background-image: url(/slider/mail.png);
					  background-size: 100%;
					  background-repeat: no-repeat; 

					}

				</style>

			</div>

		</div>
 
	</div>
</div> 


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>