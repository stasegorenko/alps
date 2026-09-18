<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Веб-Камера");
$APPLICATION->SetTitle("Веб-Камера");
?>

<!--<img style="width: 100%;" src="/slider/webcam_banner.jpg">-->








<div class="container container_narrow page_cams"> 

	<div class="row mt-2 mt-md-5 mb-4">

	    <div class="col-12 col-md-4 order-1 order-md-2">	 		
			<ul class="webcamtabs">
				<!--<li><a <?=($_GET['view']=='8kr')?('class="active"'):('')?> href=/news>СКИДКА 70%</a></li>-->
				<!--<li><a <?=($_GET['view']=='detsad')?('class="active"'):('')?> href='/web-cameras/?view=detsad'>Рыбалка</a></li>	-->			
			    <li><a <?=($_GET['view']=='4slope')?('class="active"'):('')?> href='/web-cameras/?view=4slope'>Кафе "Сугроб"</a></li>			
	            <li><a <?=($_GET['view']=='1bkd')?('class="active"'):('')?> href='/web-cameras/?view=1bkd'>3 ККД низ</a></li>
	            <li><a <?=($_GET['view']=='3kr')?('class="active"'):('')?> href='/web-cameras/?view=3kr'>3 ККД верх</a></li>		
	            <li><a <?=($_GET['view']=='2bkd')?('class="active"'):('')?> href='/web-cameras/?view=2bkd'>2 БКД</a></li>

			</ul>	
		</div>	

	    <div class="col-12 col-md-8 order-2 order-md-1 cam_div">

			<?if($_GET['view']!='4slope' && $_GET['view']!='2bkd' && $_GET['view']!='3kr' && $_GET['view']!='1bkd' && $_GET['view']!='detsad'):?>
			
				<div class="iv-embed" style="margin:0 auto;padding:0;border:0;width:642px;"><div class="iv-v" style="display:block;margin:0;padding:1px;border:0;background:#000;"><iframe class="iv-i" style="display:block;margin:0;padding:0;border:0;" src="https://open.ivideon.com/embed/v3/?server=100-5xXKgWpqasYCutFuqVWGLP&amp;camera=524288&amp;width=&amp;height=&amp;lang=ru" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; clipboard-write; picture-in-picture"></iframe></div><div class="iv-b" style="display:block;margin:0;padding:0;border:0;"><div style="float:right;text-align:right;padding:0 0 10px;line-height:10px;"><a class="iv-a" style="font:10px Verdana,sans-serif;color:inherit;opacity:.6;" href="https://www.ivideon.com/" target="_blank">Powered by Ivideon</a></div><div style="clear:both;height:0;overflow:hidden;">&nbsp;</div><script src="https://open.ivideon.com/embed/v3/embedded.js"></script></div></div>


			<?elseif($_GET['view']=='4slope'):?>		
			

					<div class="iv-embed" style="margin:0 auto;padding:0;border:0;width:642px;"><div class="iv-v" style="display:block;margin:0;padding:1px;border:0;background:#000;"><iframe class="iv-i" style="display:block;margin:0;padding:0;border:0;" src="https://public.ivideon.com/embed/v3/?server=100-5xXKgWpqasYCutFuqVWGLP&camera=589824&width=&height=&lang=ru" width="640" height="480" frameborder="0" allowfullscreen></iframe></div><div class="iv-b" style="display:block;margin:0;padding:0;border:0;"><div style="float:right;text-align:right;padding:0 0 10px;line-height:10px;"><a class="iv-a" style="font:10px Verdana,sans-serif;color:inherit;opacity:.6;" href="https://www.ivideon.com/" target="_blank">Powered by Ivideon</a></div><div style="clear:both;height:0;overflow:hidden;">&nbsp;</div><script src="https://open.ivideon.com/embed/v3/embedded.js">
					</script></div></div>


			<?elseif($_GET['view']=='detsad'):?>


				
		       <div class="iv-embed" style="margin:0 auto;padding:0;border:0;width:642px;"><div class="iv-v" style="display:block;margin:0;padding:1px;border:0;background:#000;"><iframe class="iv-i" style="display:block;margin:0;padding:0;border:0;" src="https://open.ivideon.com/embed/v3/?server=100-tZbkMJcgLDDQygALAFzhO9&amp;camera=655360&amp;width=&amp;height=&amp;lang=ru" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; clipboard-write; picture-in-picture"></iframe></div><div class="iv-b" style="display:block;margin:0;padding:0;border:0;"><div style="float:right;text-align:right;padding:0 0 10px;line-height:10px;"><a class="iv-a" style="font:10px Verdana,sans-serif;color:inherit;opacity:.6;" href="https://www.ivideon.com/" target="_blank">Powered by Ivideon</a></div><div style="clear:both;height:0;overflow:hidden;">&nbsp;</div><script src="https://open.ivideon.com/embed/v3/embedded.js"></script></div></div>

			<?elseif($_GET['view']=='3kr'):?>		
			
					<!--<div class="iv-embed" style="margin:0 auto;padding:0;border:0;width:642px;"><div class="iv-v" style="display:block;margin:0;padding:1px;border:0;background:#000;"><iframe class="iv-i" style="display:block;margin:0;padding:0;border:0;" src="https://open.ivideon.com/embed/v3/?server=100-5xXKgWpqasYCutFuqVWGLP&amp;camera=655360&amp;width=&amp;height=&amp;lang=ru" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; clipboard-write; picture-in-picture"></iframe></div><div class="iv-b" style="display:block;margin:0;padding:0;border:0;"><div style="float:right;text-align:right;padding:0 0 10px;line-height:10px;"><a class="iv-a" style="font:10px Verdana,sans-serif;color:inherit;opacity:.6;" href="https://www.ivideon.com/" target="_blank">Powered by Ivideon</a></div><div style="clear:both;height:0;overflow:hidden;">&nbsp;</div><script src="https://open.ivideon.com/embed/v3/embedded.js"></script></div></div>-->
					<div class="iv-embed" style="margin:0 auto;padding:0;border:0;width:642px;"><div class="iv-v" style="display:block;margin:0;padding:1px;border:0;background:#000;"><iframe class="iv-i" style="display:block;margin:0;padding:0;border:0;" src="https://open.ivideon.com/embed/v3/?server=100-5xXKgWpqasYCutFuqVWGLP&amp;camera=327680" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; clipboard-write; picture-in-picture"></iframe></div><div class="iv-b" style="display:block;margin:0;padding:0;border:0;"><div style="float:right;text-align:right;padding:0 0 10px;line-height:10px;"><a class="iv-a" style="font:10px Verdana,sans-serif;color:inherit;opacity:.6;" href="https://www.ivideon.com/" target="_blank">Powered by Ivideon</a></div><div style="clear:both;height:0;overflow:hidden;">&nbsp;</div><script src="https://open.ivideon.com/embed/v3/embedded.js"></script></div></div>

	
			<?elseif($_GET['view']=='2bkd'):?>		


				<div class="iv-embed" style="margin:0 auto;padding:0;border:0;width:642px;"><div class="iv-v" style="display:block;margin:0;padding:1px;border:0;background:#000;"><iframe class="iv-i" style="display:block;margin:0;padding:0;border:0;" src="https://open.ivideon.com/embed/v3/?server=100-5xXKgWpqasYCutFuqVWGLP&amp;camera=458752&amp;width=&amp;height=&amp;lang=ru" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; clipboard-write; picture-in-picture"></iframe></div><div class="iv-b" style="display:block;margin:0;padding:0;border:0;"><div style="float:right;text-align:right;padding:0 0 10px;line-height:10px;"><a class="iv-a" style="font:10px Verdana,sans-serif;color:inherit;opacity:.6;" href="https://www.ivideon.com/" target="_blank">Powered by Ivideon</a></div><div style="clear:both;height:0;overflow:hidden;">&nbsp;</div><script src="https://open.ivideon.com/embed/v3/embedded.js"></script></div></div>

			<?elseif($_GET['view']=='1bkd'):?>		

<div class="iv-embed" style="margin:0 auto;padding:0;border:0;width:642px;"><div class="iv-v" style="display:block;margin:0;padding:1px;border:0;background:#000;"><iframe class="iv-i" style="display:block;margin:0;padding:0;border:0;" src="https://open.ivideon.com/embed/v3/?server=100-5xXKgWpqasYCutFuqVWGLP&amp;camera=524288&amp;width=&amp;height=&amp;lang=ru" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; clipboard-write; picture-in-picture"></iframe></div><div class="iv-b" style="display:block;margin:0;padding:0;border:0;"><div style="float:right;text-align:right;padding:0 0 10px;line-height:10px;"><a class="iv-a" style="font:10px Verdana,sans-serif;color:inherit;opacity:.6;" href="https://www.ivideon.com/" target="_blank">Powered by Ivideon</a></div><div style="clear:both;height:0;overflow:hidden;">&nbsp;</div><script src="https://open.ivideon.com/embed/v3/embedded.js"></script></div></div>

			<?endif;?>


			<script src="https://open.ivideon.com/embed/v2/embedded.js"></script>

		</div>

	 </div>	

 </div>	
 
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>