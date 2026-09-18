<?php //get_header(); 

//include($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/twentyfifteen/header.php');
?>
 
<!--<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
<link rel="stylesheet" href="leaflet.css">
  
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
		<script src="map/index_files/ajax_cart.js.Без названия" type="text/javascript"></script>-->
 
<!DOCTYPE html>
<html lang="ru-RU"><!--<![endif]-->
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	
	<script src="map/index_files/jquery.min.js.Без названия" type="text/javascript"></script>
	

	<link href="map/index_files/default.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="map/index_files/tcal.css" type="text/css" media="all">
	<link href="map/index_files/flexslider.css" rel="stylesheet">
 
	<link rel="stylesheet" id="less-css" href="map/index_files/font-awesome.min.css" type="text/css" media="all">

 <script src="map/index_files/function.js.Без названия" type="text/javascript"></script>
		 

		<script src="map/index_files/scripts.js.Без названия" type="text/javascript"></script>
	 
		<script src="map/index_files/tcal.js.Без названия" type="text/javascript"></script>

		<script src="map/index_files/jquery.inputmask.js.Без названия" type="text/javascript"></script>
		<script src="map/index_files/jquery.flexslider.js.Без названия"></script>
		<script src="map/index_files/ajaxfilter.js.Без названия" type="text/javascript"></script>
		<link href="map/index_files/leaflet.css" rel="stylesheet" type="text/css">
		<script src="map/index_files/leaflet.js.Без названия" type="text/javascript"></script>
</head>

<body class="full-hd"> 
	
 
			<div id="map"> 
				</div>


</body>


	<!--div class="now-zoom"></div>
			<div class="now-coord"></div-->
			<script type="text/javascript">
			var ind;
				// исходный размер картинки
				var wimg = 4500;
				var himg = 2667;
				// дельта коэффициент масштаба
				var delta = 1.3;
				//зум
				var minz = 3;
				var maxz = 7;
				// размер экрана
				var wsite = window.innerWidth;
				var hsite = window.innerHeight;
				var hsreen = screen.height;
				var wsreen = screen.width;
				// метод при смене ориентации экрана
				var mql = window.matchMedia("(orientation: portrait)");
				
				// мобильник
				if (wsreen < 1024) {
					if (hsreen > wsreen) {
						wsite=hsreen*(hsreen/wsreen);
						hsite=wsreen*(hsreen/wsreen);
					} else {
						hsite=hsreen*(wsreen/hsreen);
						wsite=wsreen*(wsreen/hsreen);
					}
				}
				
				/*mql.addListener(function(m) {
				
					if(m.matches) { //vertical
						wsite=wsite+hsite;
						hsite=wsite-hsite;
						wsite=wsite-hsite;
					} else { //horisontal
						wsite=wsite+hsite;
						hsite=wsite-hsite;
						wsite=wsite-hsite;
					}
				
				});*/
				
				// расчет смещения координат
				var k = wsite/1366;
				
				// расчет размера картинки
				
				var sizesumm = wsite/wimg;
				var wsize = wimg*sizesumm;
				var hsize = himg*sizesumm;
				
				if ((hsize<hsite)&&(wsite > 1024)) { 
					/*sizesumm = hsite/himg;
					wsize = wimg*sizesumm;
					hsize = himg*sizesumm;
					k = wsite/1920;*/
					sizesumm = sizesumm*1.1;
					wsize = wsize*1.1;
					hsize = hsize*1.1;
					k = k*1.1;
					
				}

				k = k*1.009;
				//alert(k);
				
				// коэфициент увелечения картинки при зумировании
				L.CRS.CustomZoom = L.extend({}, L.CRS.Simple, {
					scale: function (zoom) {
						return 256 * Math.pow(delta, zoom);
					}
				});
				
				// анимация на мобильниках
				var wsite = window.innerWidth;
				if (wsite < 1024) {
					var map = L.map('map', {
						minZoom: minz,
						maxZoom: maxz,
						center: [-0.6363612953675016, 1.146531965591306],
						zoom: 3,
						ZoomControl: false,
						bounceAtZoomLimits: false,
						crs: L.CRS.CustomZoom
					});
				} else {
					var map = L.map('map', {
						minZoom: minz,
						maxZoom: maxz,
						center: [-0.6363612953675016, 1.146531965591306],
						zoom: 3,
						ZoomControl: false,
						crs: L.CRS.CustomZoom
					});
				}

				// приминяемые размеры изображения
				var w = wsize*delta,
					h = hsize*delta,
					url = 'https://alps.altay.kz/worktimeadmin/map.jpg';
					
				// координаты клика
				map.on("click", function(e) {
					$(".now-coord").html("Координаты клика: "+e.latlng.lat*k+", "+e.latlng.lng*k);
				});	

				// расчет краев изображения, в пространстве координат
				var southWest = map.unproject([0, h], map.getMaxZoom()-(maxz-minz-1));
				var northEast = map.unproject([w, 0], map.getMaxZoom()-(maxz-minz-1));
				var bounds = new L.LatLngBounds(southWest, northEast);

				// наложение изображения,
				// так, чтобы она покрывала всю карту
				ind = L.imageOverlay(url, bounds);
				map.addLayer(ind);
				
				map.setMaxBounds(bounds);
				map.on('drag', function() {
					map.panInsideBounds(bounds, { animate: false });
				});

				
				var data_json=[
					{"icon":"hut.png","lat":"-0.5075548321079959","lng":"1.692103262562074"},
					{"icon":"hut.png","lat":"-0.7805548321079959","lng":"1.792103262562074"},
					{"icon":"hut.png","lat":"-0.7575548321079959","lng":"1.692103262562074"},
					{"icon":"hut.png","lat":"-0.7475548321079959","lng":"1.692103262562074"},
				];
					
				for (var i=0;i<data_json.length;i++) {

					var lat = data_json[i].lat;
					var lng = data_json[i].lng;
					var icon = new L.Icon({
						iconUrl: 'https://alps.altay.kz/worktimeadmin/'+data_json[i].icon,
						className: 'point TMafBAo'
					});

					marker = new L.marker([lat*k,lng*k], {icon: icon});
					map.addLayer(marker);

					marker.on("click", function (e) {
						$('.mainblock').toggleClass("block-bg");
					});
				
				};




</script>

<?/*
$arr=array('links_name_object'=>'Административное здание','visible_object'=>'1');

$object["add_marker"] = '1';
$object["name_object"] = 'Административное здание';

$url='https://koprino.ru/core/ajax_map.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
//curl_setopt($ch,CURLOPT_FOLLOWLOCATION,TRUE);
//curl_setopt($ch,CURLOPT_MAXREDIRS,10);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $header);
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $object); 
 
$data = curl_exec($ch); 
echo $data;*/?>

		
		<script>	
			/*marker = new L.marker([-91.25, 124.625]);
			map.addLayer(marker);
			marker.on("click", function(e) {
				map.panTo([e.latlng.lat, e.latlng.lng]);
			});*/
			/*marker = new L.marker([-76.25, 178.375]);
			map.addLayer(marker);
			marker.on("click", function(e) {
				map.panTo([e.latlng.lat, e.latlng.lng]);
			});*/
			
			/*var type = "POST";
			var url = 'https://' + window.location.hostname + '/core/ajax_map.php';
			var object = {};
			object["add_marker"] = 1;
			function AjaxResponseHandler(data) {
				var data_json = $.parseJSON(data);
				 
				for (var i=0;i<data_json.icon.length;i++) {
					var machine_name = data_json.machine_name[i];
					var icon = new L.Icon({
						iconUrl: 'https://'+window.location.hostname+'/img/'+data_json.icon[i],
						className: 'point '+data_json.class_type[i]+" "+machine_name
					});
					var html = data_json.html[i];
					var lat = data_json.lat[i];
					var lng = data_json.lng[i];
					var category = data_json.category[i];
					if (!isNaN(lat)) {
						function AddMarker (icon, html, machine_name, lat, lng, category, k) {
						 
							marker = new L.marker([lat*k,lng*k], {icon: icon});
							marker.on("add", function (e) {
								$("."+machine_name).attr("id", "p-"+lat+"-"+lng);
								$("."+machine_name).addClass("object-map");
								$("."+machine_name).addClass(category);
								if (category != "inform" && category != "cat_qRQRRKU") {
									$("."+machine_name).addClass("hiddenPoint");
								}
							});
							marker.on("click", function (e) {
								//$("."+machine_name).attr("id", "p-"+lat+"-"+lng);
								$(".block1 .bubble").remove();
								$(".block1 .mainblock-head").after(html);
								$('.point').removeClass("select-point");
								$("."+machine_name).addClass("select-point");
								$('.map_buttons a').removeClass("select-button");
								var id = $("."+machine_name).attr("id");
								var z = id.split("-");
								$('#a--'+z[1]+"-"+z[2]).addClass("select-button");
								$('.mobmenu').addClass("menumore");
								$('.mobinfo').fadeIn();		
								$('.mobinfo').html($('[rel="p--'+z[2]+'-'+z[3]+'"]').html());
								//$('.filter').addClass("hidden");
								//$('#open-allobjects').removeClass("close-allobjects");
								//$('#open-filter').removeClass("close-filter");			//-
								//$('#open-allobjects').html("Объекты");
								$('.mainblock').addClass("block-bg");
								$('.mainblock').removeClass("bubble-off");
								//$('.mainblock').addClass("filt-off");
								$(".number_luxury_click").fadeIn("fast");
								$(".number_luxury_click").removeClass("active_number_luxury");
								$(".number_luxury").fadeOut("slow");	
								$(".number_standard_click").fadeIn("fast");
								$(".number_standard_click").removeClass("active_number_standard");
								$(".number_standard").fadeOut("slow");	
								
								if(($("."+machine_name).hasClass("house") || $("."+machine_name).hasClass("daytime") || $("."+machine_name).hasClass("marquee")) && $("."+machine_name).hasClass("nofiltered"))
								{
								$('.bubble').fadeOut("fast");
								$('.mainblock').addClass("bubble-off");
								$(".message").addClass("error_message");
								$(".message").html("Этот объект занят на данную дату.");
								$(".message").fadeIn();
								setTimeout(function() {$('.message').fadeOut();}, 8000); 
								}
								else
								{
								$('.bubble').fadeIn("fast");
								$('.mainblock').removeClass("bubble-off");
								$(".message").removeClass("error_message");
								$(".message").html("");
								$(".message").fadeOut();
								if ($("#content").hasClass("tcalOn")) {
									$(".calendar_date_from_to").removeClass("calendar_active");
									$(".calendar_block").fadeOut();
									$('#content').removeClass('tcalOn');
								}
								}
								//map.panTo([lat*k,lng*k], 5);
								map.setView([lat*k,lng*k]);
							});
							//marker.off("click");
							mass_marker[i] = marker;
							map.addLayer(marker);
						}
						AddMarker (icon, html, machine_name, lat, lng, category, k);
					}
				}
			}
			AjaxLoader(type, url, object, AjaxResponseHandler);
			
			$('.map_buttons a').live("click", function(){// текстовая ссылка на объект
					$('.map_buttons a').removeClass("select-button");
					$(this).addClass("select-button");
					$('.mobmenu').removeClass("menumore");
					$('.point').addClass("opacity-point");
					var id = $(this).attr("id");
					var z = id.split("-");
					$(".point").removeClass("select-point");
					//alert($(this).children("#links_name_object").text());
					var pk_c_code = 1;
					var pk_c_code1 = $(this).children("#links_name_object").text();
					var type = "POST";
					var url = 'https://' + window.location.hostname + '/core/ajax_map.php';
					var object = {};
					object["add_marker"] = 1;
					object["name_object"] = pk_c_code1;
					function AjaxResponseHandler(data) {
						var data_json = $.parseJSON(data);
						var html = data_json.html[0];
						//alert(data_json.test_query);
						$(".block1 .bubble").remove();
						$(".block1 .mainblock-head").after(html);
						map.setView([data_json.lat[0]*k, data_json.lng[0]*k]);
					}
					AjaxLoader(type, url, object, AjaxResponseHandler);
					
					setTimeout(function() {
					var url = 'https://' + window.location.hostname + '/core/ajax_object.php'; 
					if(pk_c_code != '') { 
					$.ajax ({ 
					type: "POST",
					url: url,
					data: {
					'visible_object' : pk_c_code,
					'links_name_object' : pk_c_code1
					},
					success: function(data){
					var data_json = $.parseJSON(data);
					if (data_json.bool_parent == '1') {
						$("." + data_json.arr_coordinates_fade_in[0]).removeClass("opacity-point");
						$("." + data_json.arr_coordinates_fade_in[0]).addClass("select-point");
						var coordsOnMap = data_json.arr_coordinates_fade_in[0].split()
						for (var i = 0;i<data_json.arr_coordinates_fade_in.length;i++) {
							//alert(data_json.arr_coordinates_fade_in[i]);
							$(".bubble #" + data_json.arr_coordinates_fade_in[i]).fadeIn("fast");
						}
					} else {
						$("." + data_json.arr_coordinates_fade_out[0]).removeClass("opacity-point");
						$("." + data_json.arr_coordinates_fade_out[0]).addClass("select-point");
						$(".bubble #" + data_json.arr_coordinates_fade_in[0]).fadeIn("fast");
						//alert(data_json.arr_coordinates_fade_in[0]);
						for (var i = 0;i<data_json.arr_coordinates_fade_out.length;i++) {
							//alert(data_json.arr_coordinates_fade_out[i]);
							$(".bubble #" + data_json.arr_coordinates_fade_out[i]).fadeOut("fast");
						}
					}
					$(".number_luxury_click").fadeOut("fast");
					$(".number_luxury_click").removeClass("active_number_luxury");
					$(".number_luxury").fadeIn("slow");	
					$(".number_standard_click").fadeOut("fast");
					$(".number_standard_click").removeClass("active_number_standard");
					$(".number_standard").fadeIn("slow");	
					}
					}); 
					}
					}, 100);
					//$('.filter').addClass("hidden");
					//$('#open-allobjects').removeClass("close-allobjects");
					//$('#open-filter').removeClass("close-filter");               //-
					//$('#open-allobjects').html("Объекты");
					$('.mainblock').addClass("block-bg");
					$('.mainblock').removeClass("bubble-off");
					//$('.mainblock').addClass("filt-off");
					
					$(".mainblock").animate({scrollTop: 0}, 600);  //скролл вверх для моб.
					
				});
			//mass_marker[0].off("click");*/
			
			</script>





<div class="mainblock filt-off">
			
				<div class="block1">
					<div class="mainblock-head">
						<!--img class="logo" src="../img/logo.png" /-->
						
						<!--a class="button" id="openfilt" href="#">Меню</a>
						<a class="button" id="google" target="_blank" href="https://www.google.com/maps/dir//%D0%91%D0%B0%D0%B7%D0%B0+%D0%BE%D1%82%D0%B4%D1%8B%D1%85%D0%B0+%22%D0%91%D0%B5%D1%80%D1%91%D0%B7%D0%BA%D0%B0%22+%D0%9E%D0%9E%D0%9E+%22%D0%90%D1%80%D0%A2%D1%83%D1%80%22,+%D0%A2%D1%83%D1%80%D0%B3%D0%BE%D1%8F%D0%BA%D1%81%D0%BA%D0%BE%D0%B5+%D1%88%D0%BE%D1%81%D1%81%D0%B5,+9%2F12,+%D0%9C%D0%B8%D0%B0%D1%81%D1%81,+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F,+456300/@55.4328012,60.2616709,12z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x43c50017b9a8cb79:0xe5529be810bb0e29!2m2!1d60.335487!2d55.432726">Как добраться</a-->
						<a class="button-ico" id="open-allobjects" href="#"><span>Коттеджи</span></a>
						<a class="button-ico" id="google" target="_blank" href="https://www.google.ru/maps/place/%D0%91%D0%BE%D0%BB%D1%8C%D1%88%D0%B8%D0%B5+%D0%9A%D0%B0%D0%BC%D0%BD%D0%B8/@60.929161,29.998114,448m/data=!3m1!1e3!4m13!1m7!3m6!1s0x0:0x0!2zNjDCsDU1JzQ1LjAiTiAyOcKwNTknNTMuMiJF!3b1!8m2!3d60.9291667!4d29.9981111!3m4!1s0x0:0xd81379fb9c89987b!8m2!3d60.9292828!4d29.9983513"><span>Как проехать</span></a>
					
					</div>
					<div class="filter hidden">
						<div class="object-selector">
							<a class="houses-open active" href="#">Домики</a>
							<a class="objects-open" href="#">Инфраструктура</a>
						</div>
						<!--POMENIAT-->
						<ul class="map_buttons object-links hidden">
						
						<li><a class="map_link" href="#" id="a--0.6535479940013973-1.813762594022039" rel="p--0.6535479940013973-1.813762594022039"><span id="links_name_object">Пропускной пункт</span></a></li><li><a class="map_link" href="#" id="a--0.6075548321079959-1.692103262562074" rel="p--0.6075548321079959-1.692103262562074"><span id="links_name_object">Административное здание</span></a></li><li><a class="map_link" href="#" id="a--0.9450852943902158-0.8961248317294981" rel="p--0.9450852943902158-0.8961248317294981"><span id="links_name_object">Фруктовый сад</span></a></li><li><a class="map_link" href="#" id="a--0.7410833666372257-1.5081306149884683" rel="p--0.7410833666372257-1.5081306149884683"><span id="links_name_object">Сеновал</span></a></li><li><a class="map_link" href="#" id="a--0.45399701739938153-1.6876523114110997" rel="p--0.45399701739938153-1.6876523114110997"><span id="links_name_object">Аллея любви</span></a></li><li><a class="map_link" href="#" id="a--0.7833674025714819-1.8174717199811843" rel="p--0.7833674025714819-1.8174717199811843"><span id="links_name_object">Музей крестьянского быта</span></a></li><li><a class="map_link" href="#" id="a--0.6016202305733634-1.8923960643559188" rel="p--0.6016202305733634-1.8923960643559188"><span id="links_name_object">Парковка</span></a></li><li><a class="map_link" href="#" id="a--0.3078574546090577-1.8931378895477478" rel="p--0.3078574546090577-1.8931378895477478"><span id="links_name_object">Бассейн</span></a></li><li><a class="map_link" href="#" id="a--0.8204586621629346-1.438399046956537" rel="p--0.8204586621629346-1.438399046956537"><span id="links_name_object">Скамья примерения</span></a></li><li><a class="map_link" href="#" id="a--0.29747190192345097-1.816729894789355" rel="p--0.29747190192345097-1.816729894789355"><span id="links_name_object">WC</span></a></li><li><a class="map_link" href="#" id="a--0.5200194594721674-1.8048606917200904" rel="p--0.5200194594721674-1.8048606917200904"><span id="links_name_object">Бабушка Яга</span></a></li><li><a class="map_link" href="#" id="a--1.0875157312213943-1.5415127486207758" rel="p--1.0875157312213943-1.5415127486207758"><span id="links_name_object">Фигурка Доброго Муравья</span></a></li><li><a class="map_link" href="#" id="a--0.9688237005287456-1.5800876585958867" rel="p--0.9688237005287456-1.5800876585958867"><span id="links_name_object">Манеж</span></a></li><li><a class="map_link" href="#" id="a--0.0623133161136406-0.962889098994113" rel="p--0.0623133161136406-0.962889098994113"><span id="links_name_object">Выход в лес</span></a></li><li><a class="map_link" href="#" id="a--1.0882575564132233-0.5252122358149708" rel="p--1.0882575564132233-0.5252122358149708"><span id="links_name_object">Парк «Заповедный лес»</span></a></li><li><a class="map_link" href="#" id="a--0.6394533153566453-1.7469983267574238" rel="p--0.6394533153566453-1.7469983267574238"><span id="links_name_object">Магазин</span></a></li><li><a class="map_link" href="#" id="a--0.4888628014153471-1.9213272468372518" rel="p--0.4888628014153471-1.9213272468372518"><span id="links_name_object">Совы</span></a></li><li><a class="map_link" href="#" id="a--0.342434986550484-0.055587478530651914" rel="p--0.342434986550484-0.055587478530651914"><span id="links_name_object">Стелла "Дачный клуб "Коприно"</span></a></li><li><a class="map_link" href="#" id="a--1.1706001527062482-1.002205834161053" rel="p--1.1706001527062482-1.002205834161053"><span id="links_name_object">Ресепшен</span></a></li><li><a class="map_link" href="#" id="a--0.7344662859261105-1.3879252609044885" rel="p--0.7344662859261105-1.3879252609044885"><span id="links_name_object">Верблюдица Фаина</span></a></li><li><a class="map_link" href="#" id="a--1.1133312478970454-1.7548616737908123" rel="p--1.1133312478970454-1.7548616737908123"><span id="links_name_object">Ослик Кузя</span></a></li><li><a class="map_link" href="#" id="a--0.793456225180357-1.0011672788924924" rel="p--0.793456225180357-1.0011672788924924"><span id="links_name_object">Антилопа</span></a></li><li><a class="map_link" href="#" id="a--0.7136358345395507-1.6164370929955103" rel="p--0.7136358345395507-1.6164370929955103"><span id="links_name_object">Страусиная ферма</span></a></li><li><a class="map_link" href="#" id="a--0.8286187392730543-1.7128743679332876" rel="p--0.8286187392730543-1.7128743679332876"><span id="links_name_object">Конюшня</span></a></li><li><a class="map_link" href="#" id="a--1.2504205433470548-1.1139247080505088" rel="p--1.2504205433470548-1.1139247080505088"><span id="links_name_object">Ламы</span></a></li><li><a class="map_link" href="#" id="a--1.0778720037276166-1.4235625431199561" rel="p--1.0778720037276166-1.4235625431199561"><span id="links_name_object">Птичий двор</span></a></li><li><a class="map_link" href="#" id="a--1.0941921579478557-1.5081306149884683" rel="p--1.0941921579478557-1.5081306149884683"><span id="links_name_object">Белки</span></a></li><li><a class="map_link" href="#" id="a--1.0504244716299416-1.5199998180577332" rel="p--1.0504244716299416-1.5199998180577332"><span id="links_name_object">Лисы-чернобурки</span></a></li><li><a class="map_link" href="#" id="a--1.0519081220135997-1.5385454478534597" rel="p--1.0519081220135997-1.5385454478534597"><span id="links_name_object">Енотовидные собаки</span></a></li><li><a class="map_link" href="#" id="a--1.0578427235482322-1.559316553224673" rel="p--1.0578427235482322-1.559316553224673"><span id="links_name_object">Еноты</span></a></li><li><a class="map_link" href="#" id="a--1.178018404624539-1.6456650055535753" rel="p--1.178018404624539-1.6456650055535753"><span id="links_name_object">Олени</span></a></li><li><a class="map_link" href="#" id="a--1.2393567504860612-1.3121376174627626" rel="p--1.2393567504860612-1.3121376174627626"><span id="links_name_object">Як</span></a></li><li><a class="map_link" href="#" id="a--1.2651468331551354-1.1860527688584004" rel="p--1.2651468331551354-1.1860527688584004"><span id="links_name_object">Черный ангус</span></a></li><li><a class="map_link" href="#" id="a--0.7826255773796528-1.571185756293938" rel="p--0.7826255773796528-1.571185756293938"><span id="links_name_object">Голубятня</span></a></li><li><a class="map_link" href="#" id="a--1.1149632633190694-1.3864712835285034" rel="p--1.1149632633190694-1.3864712835285034"><span id="links_name_object">Овцы, козы</span></a></li><li><a class="map_link" href="#" id="a--0.7922693048734306-1.5364683373163384" rel="p--0.7922693048734306-1.5364683373163384"><span id="links_name_object">Лошади</span></a></li><li><a class="map_link" href="#" id="a--0.8760955515501138-1.5748948822530835" rel="p--0.8760955515501138-1.5748948822530835"><span id="links_name_object">Павлины</span></a></li><li><a class="map_link" href="#" id="a--0.865709998864507-1.502937838645665" rel="p--0.865709998864507-1.502937838645665"><span id="links_name_object">Цесарки</span></a></li><li><a class="map_link" href="#" id="a--0.18174717199811843-1.7054561160149968" rel="p--0.18174717199811843-1.7054561160149968"><span id="links_name_object">Мангальное место с беседкой</span></a></li><li><a class="map_link" href="#" id="a--0.37758902264098887-1.9628694575796788" rel="p--0.37758902264098887-1.9628694575796788"><span id="links_name_object">Пляж</span></a></li><li><a class="map_link" href="#" id="a--0.5459833411861843-2.0889797401906183" rel="p--0.5459833411861843-2.0889797401906183"><span id="links_name_object">Прокат лодок</span></a></li><li><a class="map_link" href="#" id="a--0.39836012801220244-1.1587309496369835" rel="p--0.39836012801220244-1.1587309496369835"><span id="links_name_object">Детская игровая площадка</span></a></li><li><a class="map_link" href="#" id="a--0.25815516675651107-1.75812570463486" rel="p--0.25815516675651107-1.75812570463486"><span id="links_name_object">Детская игровая площадка</span></a></li><li><a class="map_link" href="#" id="a--0.5482088167616714-1.749223802332911" rel="p--0.5482088167616714-1.749223802332911"><span id="links_name_object">Детская игровая площадка</span></a></li><li><a class="map_link" href="#" id="a--0.39094187609391184-1.1223815152373597" rel="p--0.39094187609391184-1.1223815152373597"><span id="links_name_object">Футбольная площадка</span></a></li><li><a class="map_link" href="#" id="a--0.17284526969616978-1.7462565015655949" rel="p--0.17284526969616978-1.7462565015655949"><span id="links_name_object">Горка</span></a></li><li><a class="map_link" href="#" id="a--0.9183795874843699-1.4680720546296995" rel="p--0.9183795874843699-1.4680720546296995"><span id="links_name_object">Площадка для начального обучения верховой езде</span></a></li><li><a class="map_link" href="#" id="a--0.47699359834608224-2.1223618738229257" rel="p--0.47699359834608224-2.1223618738229257"><span id="links_name_object">Понтон для рыбалки</span></a></li><li><a class="map_link" href="#" id="a--0.5563688938717911-1.8033770413364323" rel="p--0.5563688938717911-1.8033770413364323"><span id="links_name_object">Кафе "Лесная сказка"</span></a></li><li><a class="map_link" href="#" id="a--0.21735478120591303-1.732903648112672" rel="p--0.21735478120591303-1.732903648112672"><span id="links_name_object">Спортивная площадка</span></a></li><li><a class="map_link" href="#" id="a--0.2611224675238273-1.8627230566827566" rel="p--0.2611224675238273-1.8627230566827566"><span id="links_name_object">Павильон на берегу</span></a></li><li><a class="map_link" href="#" id="a--0.24702778887907526-1.7907660130753384" rel="p--0.24702778887907526-1.7907660130753384"><span id="links_name_object">Летняя площадка</span></a></li><li><a class="map_link" href="#" id="a--0.5474669915698425-1.8464029024625175" rel="p--0.5474669915698425-1.8464029024625175"><span id="links_name_object">Настольный теннис</span></a></li><li><a class="map_link" href="#" id="a--0.6031038809570215-1.7566420542512018" rel="p--0.6031038809570215-1.7566420542512018"><span id="links_name_object">Батут</span></a></li><li><a class="map_link" href="#" id="a--0.6431624413157905-1.8604975811072695" rel="p--0.6431624413157905-1.8604975811072695"><span id="links_name_object">Мангальное место с беседкой</span></a></li><li><a class="map_link" href="#" id="a--0.44732059067292-1.911683519343474" rel="p--0.44732059067292-1.911683519343474"><span id="links_name_object">Волейбольная площадка</span></a></li><li><a class="map_link" href="#" id="a--1.163033535749592-0.910367875412616" rel="p--1.163033535749592-0.910367875412616"><span id="links_name_object">Магазин</span></a></li><li><a class="map_link" href="#" id="a--0.8501316698360967-1.288550358207068" rel="p--0.8501316698360967-1.288550358207068"><span id="links_name_object">Каток</span></a></li><li><a class="map_link" href="#" id="a--0.9064139471401672-1.3000709034361733" rel="p--0.9064139471401672-1.3000709034361733"><span id="links_name_object">Горка</span></a></li><li><a class="map_link" href="#" id="a--1.0067087130754553-1.247416151320147" rel="p--1.0067087130754553-1.247416151320147"><span id="links_name_object">Детский городок</span></a></li><li><a class="map_link" href="#" id="a--0.4718008220032789-1.02816971587507" rel="p--0.4718008220032789-1.02816971587507"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.4784772487297404-1.095675808331514" rel="p--0.4784772487297404-1.095675808331514"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.3137920561436902-1.0437480449034802" rel="p--0.3137920561436902-1.0437480449034802"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.4146802822324416-1.014816862422147" rel="p--0.4146802822324416-1.014816862422147"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.3219521332538098-0.9406343432392416" rel="p--0.3219521332538098-0.9406343432392416"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.4258076601098774-0.9443434691983867" rel="p--0.4258076601098774-0.9443434691983867"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.3508833157351429-1.0637773250828646" rel="p--0.3508833157351429-1.0637773250828646"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.3234357836374679-1.0875157312213943" rel="p--0.3234357836374679-1.0875157312213943"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.3931673516693991-1.244782671889154" rel="p--0.3931673516693991-1.244782671889154"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.33753046228221995-1.2373644199708633" rel="p--0.33753046228221995-1.2373644199708633"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.40503655473866396-1.4176279415853237" rel="p--0.40503655473866396-1.4176279415853237"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.34865784015965573-1.3998241369814264" rel="p--0.34865784015965573-1.3998241369814264"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.36349434399623687-1.6572374785461086" rel="p--0.36349434399623687-1.6572374785461086"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.38500727455927947-1.7403219000309624" rel="p--0.38500727455927947-1.7403219000309624"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.2774426217440665-1.7150998435087748" rel="p--0.2774426217440665-1.7150998435087748"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.2114201796712806-1.6713321571908606" rel="p--0.2114201796712806-1.6713321571908606"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.45325519220755245-1.7707367328959538" rel="p--0.45325519220755245-1.7707367328959538"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.8968666569213273-1.6409173243258692" rel="p--0.8968666569213273-1.6409173243258692"><span id="links_name_object">Беседка</span></a></li><li><a class="map_link" href="#" id="a--0.583816425969466-1.8204390207485004" rel="p--0.583816425969466-1.8204390207485004"><span id="links_name_object">Гостиница</span></a></li>						<!--
							<li><a class="map_link" href="#" id="a-62-26" rel="p-62-26">Палаточный городок</a></li>
							<li><a class="map_link" href="#" id="a-41-25" rel="p-41-25">Умывальник</a></li>
							<li><a class="map_link" href="#" id="a-35-48" rel="p-35-48">Прокат лодок</a></li>
							<li><a class="map_link" href="#" id="a-39-9" rel="p-39-9">Буфет</a></li>
							<li><a class="map_link" href="#" id="a-49-11" rel="p-49-11">Баня</a></li>
							<li><a class="map_link" href="#" id="a-55-15" rel="p-55-15">Туалет</a></li>
							<li><a class="map_link" href="#" id="a-69-50" rel="p-69-50">Спортивная площадка</a></li>-->
						</ul>
						<style>
						#date_filter, #filter-button {
							display: none;
						}
						</style>
						<div class="date-filt">
							<!--<p><select id="type_bilding">
							<option disabled>Выберите тип фильтруемых объектов</option>
							<option selected value="live">Дома</option>
							<option value="arbor">Беседки</option>
							</select></p>-->
							
							<div class="filter_type_bilding filter_active" id="live">Дома</div>
							<div class="filter_type_bilding" id="arbor">Бани</div>
							<div class="filter_type_bilding"id="marquee">Палатки</div>
							<div class="button calendar_date_from_to">
								<span class="date_from_filter">Выберите дату</span> 
								<span class="date_to_filter"></span>
							</div>
							<div id="date_filter">
							<span>Дата приезда</span>
							<input type="text" id="date_from" class="interactive_calendar" />
							<span>Дата отъезда</span>
							<input type="text" id="date_to" class="interactive_calendar" />
							</div>
							<a class="button" id="filter-button" href="#">Применить</a>
							<a class="button" id="filter-reset" href="#">Сбросить</a>
							<a class="button mobinmap" href="#">На карте</a>
							
						</div>
						<!--POMENIAT-->
						<ul class="map_buttons house-links">
						
							<li><a  href="#" id="a--0.3820399737919632-1.4198534171608108" rel="p--0.3820399737919632-1.4198534171608108"><span id="links_name_object">Баня №3</span> <span><span> Будни: р. </span><span>Выходные: р.</span></span></a></li><li><a  href="#" id="a--0.3226939584456388-1.4154024660098365" rel="p--0.3226939584456388-1.4154024660098365"><span id="links_name_object">Баня №4</span> <span><span> Будни: р. </span><span>Выходные: р.</span></span></a></li><li><a  href="#" id="a--0.39094187609391184-1.8330500490095942" rel="p--0.39094187609391184-1.8330500490095942"><span id="links_name_object">Баня №1</span> <span><span> Будни: р. </span><span>Выходные: р.</span></span></a></li><li><a  href="#" id="a--0.35681791726977535-1.8211808459403294" rel="p--0.35681791726977535-1.8211808459403294"><span id="links_name_object">Баня №2</span> <span><span> Будни: р. </span><span>Выходные: р.</span></span></a></li><li><a  href="#" id="a--0.2180966063977421-1.654270177778792" rel="p--0.2180966063977421-1.654270177778792"><span id="links_name_object">Коттедж №16</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.3293703851721003-1.110512312168095" rel="p--0.3293703851721003-1.110512312168095"><span id="links_name_object">Коттедж №19</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.31601753171917735-1.218818790175137" rel="p--0.31601753171917735-1.218818790175137"><span id="links_name_object">Коттедж №18</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.284119048470528-1.6972960389048772" rel="p--0.284119048470528-1.6972960389048772"><span id="links_name_object">Коттедж №17</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.39613465243671525-1.652044702203305" rel="p--0.39613465243671525-1.652044702203305"><span id="links_name_object">Коттедж №7</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.257413341564682-1.1401853198412573" rel="p--0.257413341564682-1.1401853198412573"><span id="links_name_object">Коттедж №33</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.2002928017938448-1.110512312168095" rel="p--0.2002928017938448-1.110512312168095"><span id="links_name_object">Коттедж №34</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.12240115665179403-1.0756465281521295" rel="p--0.12240115665179403-1.0756465281521295"><span id="links_name_object">Коттедж №35</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.1409467864475204-1.1476035717595479" rel="p--0.1409467864475204-1.1476035717595479"><span id="links_name_object">Коттедж №36</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.16913614373702449-1.232913468819889" rel="p--0.16913614373702449-1.232913468819889"><span id="links_name_object">Коттедж №37</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.19584185064287046-1.3004195612763332" rel="p--0.19584185064287046-1.3004195612763332"><span id="links_name_object">Коттедж №38</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.22551485831603266-1.2618446513012223" rel="p--0.22551485831603266-1.2618446513012223"><span id="links_name_object">Коттедж №39</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.4428696395219457-1.78928236269168" rel="p--0.4428696395219457-1.78928236269168"><span id="links_name_object">Избушка Deluxe</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.4425506546894592-0.6067833339084936" rel="p--0.4425506546894592-0.6067833339084936"><span id="links_name_object">Коттедж №3.4</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.5077422525473965-0.5603970046634228" rel="p--0.5077422525473965-0.5603970046634228"><span id="links_name_object">Коттедж №3.3</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.611798072205258-0.5240401520118808" rel="p--0.611798072205258-0.5240401520118808"><span id="links_name_object">Коттедж №3.2</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.7409275833469415-0.4789075073410011" rel="p--0.7409275833469415-0.4789075073410011"><span id="links_name_object">Коттедж №3.1</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.5466064743473207-0.3961643254443884" rel="p--0.5466064743473207-0.3961643254443884"><span id="links_name_object">Коттедж №4.2</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.5240401520118808-0.8048654966306878" rel="p--0.5240401520118808-0.8048654966306878"><span id="links_name_object">Коттедж №2.4</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.7359128450501771-0.6807507237857686" rel="p--0.7359128450501771-0.6807507237857686"><span id="links_name_object">Коттедж №2.2</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.5453527897731296-0.9816350215916333" rel="p--0.5453527897731296-0.9816350215916333"><span id="links_name_object">Коттедж №1.4</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.6569307168761377-0.9001455242692116" rel="p--0.6569307168761377-0.9001455242692116"><span id="links_name_object">Коттедж №1.3</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.7860602280178213-0.7985970737597322" rel="p--0.7860602280178213-0.7985970737597322"><span id="links_name_object">Коттедж №1.2</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.9151897391595047-0.7020633615470174" rel="p--0.9151897391595047-0.7020633615470174"><span id="links_name_object">Коттедж №1.1</span> <span><span> Будни: 3800р. </span><span>Выходные: 4000р.</span></span></a></li><li><a  href="#" id="a--0.43990233875462953-1.2692629032195126" rel="p--0.43990233875462953-1.2692629032195126"><span id="links_name_object">Коттедж №12</span> <span><span> Будни: 4400р. </span><span>Выходные: 4900р.</span></span></a></li><li><a  href="#" id="a--0.365719819571724-1.2692629032195126" rel="p--0.365719819571724-1.2692629032195126"><span id="links_name_object">Коттедж №14</span> <span><span> Будни: 4400р. </span><span>Выходные: 4900р.</span></span></a></li><li><a  href="#" id="a--0.3301122103639294-1.2737138543704871" rel="p--0.3301122103639294-1.2737138543704871"><span id="links_name_object">Коттедж №15</span> <span><span> Будни: 4400р. </span><span>Выходные: 4900р.</span></span></a></li><li><a  href="#" id="a--0.3916837012857409-1.3427035972105892" rel="p--0.3916837012857409-1.3427035972105892"><span id="links_name_object">Коттедж №11</span> <span><span> Будни: 4400р. </span><span>Выходные: 4900р.</span></span></a></li><li><a  href="#" id="a--0.40337301174598733-0.7334054759017952" rel="p--0.40337301174598733-0.7334054759017952"><span id="links_name_object">Коттедж № 2.5</span> <span><span> Будни: 4400р. </span><span>Выходные: 4900р.</span></span></a></li><li><a  href="#" id="a--0.3434650638168524-1.6468519258605017" rel="p--0.3434650638168524-1.6468519258605017"><span id="links_name_object">Коттедж №6</span> <span><span> Будни: 5000р. </span><span>Выходные: 5300р.</span></span></a></li><li><a  href="#" id="a--0.4080038555059801-1.2685210780276837" rel="p--0.4080038555059801-1.2685210780276837"><span id="links_name_object">Коттедж №13</span> <span><span> Будни: 5000р. </span><span>Выходные: 5300р.</span></span></a></li><li><a  href="#" id="a--0.403686432889535-0.3033916669542468" rel="p--0.403686432889535-0.3033916669542468"><span id="links_name_object">Коттедж №5.3</span> <span><span> Будни: 5000р. </span><span>Выходные: 5300р.</span></span></a></li><li><a  href="#" id="a--0.39242552647756995-1.6030842395425873" rel="p--0.39242552647756995-1.6030842395425873"><span id="links_name_object">Коттедж №8</span> <span><span> Будни: 5500р. </span><span>Выходные: 5900р.</span></span></a></li><li><a  href="#" id="a--0.3820399737919632-1.5340944967024854" rel="p--0.3820399737919632-1.5340944967024854"><span id="links_name_object">Коттедж №9</span> <span><span> Будни: 5500р. </span><span>Выходные: 5900р.</span></span></a></li><li><a  href="#" id="a--0.4735070199444857-0.27291748807390925" rel="p--0.4735070199444857-0.27291748807390925"><span id="links_name_object">Коттедж №5.2</span> <span><span> Будни: 5500р. </span><span>Выходные: 5900р.</span></span></a></li><li><a  href="#" id="a--0.5845582511612951-0.257413341564682" rel="p--0.5845582511612951-0.257413341564682"><span id="links_name_object">Коттедж №5.1</span> <span><span> Будни: 5500р. </span><span>Выходные: 5900р.</span></span></a></li><li><a  href="#" id="a--0.40652020512232195-0.4836700250725437" rel="p--0.40652020512232195-0.4836700250725437"><span id="links_name_object">Коттедж №4.4</span> <span><span> Будни: 5500р. </span><span>Выходные: 5900р.</span></span></a></li><li><a  href="#" id="a--0.46067344412584293-0.42580766010987736" rel="p--0.46067344412584293-0.42580766010987736"><span id="links_name_object">Коттедж №4.3</span> <span><span> Будни: 5500р. </span><span>Выходные: 5900р.</span></span></a></li><li><a  href="#" id="a--0.635618079114889-0.35604641907027307" rel="p--0.635618079114889-0.35604641907027307"><span id="links_name_object">Коттедж №4.1</span> <span><span> Будни: 5500р. </span><span>Выходные: 5900р.</span></span></a></li><li><a  href="#" id="a--0.6205738642245957-0.7409275833469415" rel="p--0.6205738642245957-0.7409275833469415"><span id="links_name_object">Коттедж №2.3</span> <span><span> Будни: 5500р. </span><span>Выходные: 5900р.</span></span></a></li><li><a  href="#" id="a--0.8374612955596564-0.5942464881665825" rel="p--0.8374612955596564-0.5942464881665825"><span id="links_name_object">Коттедж №2.1</span> <span><span> Будни: 5500р. </span><span>Выходные: 5900р.</span></span></a></li><li><a  href="#" id="a--0.3738798966818436-1.7158416687006037" rel="p--0.3738798966818436-1.7158416687006037"><span id="links_name_object">Коттедж №5</span> <span><span> Будни: 6400р. </span><span>Выходные: 6900р.</span></span></a></li><li><a  href="#" id="a--0.3738798966818436-1.4858758592335966" rel="p--0.3738798966818436-1.4858758592335966"><span id="links_name_object">Коттедж №10</span> <span><span> Будни: 6400р. </span><span>Выходные: 6900р.</span></span></a></li><li><a  href="#" id="a--0.5274377113904579-1.678750409109151" rel="p--0.5274377113904579-1.678750409109151"><span id="links_name_object">Коттедж №1 юг</span> <span><span> Будни: 6500р. </span><span>Выходные: 7000р.</span></span></a></li><li><a  href="#" id="a--0.5534015931044749-1.6772667587254928" rel="p--0.5534015931044749-1.6772667587254928"><span id="links_name_object">Коттедж №1 север</span> <span><span> Будни: 6500р. </span><span>Выходные: 7000р.</span></span></a></li><li><a  href="#" id="a--0.5088920815947316-1.5726694066775964" rel="p--0.5088920815947316-1.5726694066775964"><span id="links_name_object">Коттедж №2 юг</span> <span><span> Будни: 6500р. </span><span>Выходные: 7000р.</span></span></a></li><li><a  href="#" id="a--0.5326304877332614-1.5726694066775964" rel="p--0.5326304877332614-1.5726694066775964"><span id="links_name_object">Коттедж №2 север</span> <span><span> Будни: 6500р. </span><span>Выходные: 7000р.</span></span></a></li><li><a  href="#" id="a--0.48367002507254375-1.4717811805888448" rel="p--0.48367002507254375-1.4717811805888448"><span id="links_name_object">Коттедж №3 юг</span> <span><span> Будни: 6500р. </span><span>Выходные: 7000р.</span></span></a></li><li><a  href="#" id="a--0.5036993052519282-1.4695557050133574" rel="p--0.5036993052519282-1.4695557050133574"><span id="links_name_object">Коттедж №3 север</span> <span><span> Будни: 6500р. </span><span>Выходные: 7000р.</span></span></a></li><li><a  href="#" id="a--0.4673498708523045-1.3827621575693583" rel="p--0.4673498708523045-1.3827621575693583"><span id="links_name_object">Коттедж №4 юг</span> <span><span> Будни: 6500р. </span><span>Выходные: 7000р.</span></span></a></li><li><a  href="#" id="a--0.4844118502643728-1.3753439056510675" rel="p--0.4844118502643728-1.3753439056510675"><span id="links_name_object">Коттедж №4 север</span> <span><span> Будни: 6500р. </span><span>Выходные: 7000р.</span></span></a></li><li><a  href="#" id="a--0.46512439527681737-1.1260906411965053" rel="p--0.46512439527681737-1.1260906411965053"><span id="links_name_object">Коттедж №20</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.4495460662484072-1.069711926617497" rel="p--0.4495460662484072-1.069711926617497"><span id="links_name_object">Коттедж №21</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.4413859891382876-1.0088822608875145" rel="p--0.4413859891382876-1.0088822608875145"><span id="links_name_object">Коттедж №22</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.3731380714900146-0.9465689447738739" rel="p--0.3731380714900146-0.9465689447738739"><span id="links_name_object">Коттедж №23</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.3642361691880659-0.8998339576886435" rel="p--0.3642361691880659-0.8998339576886435"><span id="links_name_object">Коттедж №24</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.3056319790335706-0.9050267340314468" rel="p--0.3056319790335706-0.9050267340314468"><span id="links_name_object">Коттедж №25</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.38500727455927947-1.0133332120384888" rel="p--0.38500727455927947-1.0133332120384888"><span id="links_name_object">Коттедж №26</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.3412395882413652-1.02816971587507" rel="p--0.3412395882413652-1.02816971587507"><span id="links_name_object">Коттедж №27</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.2937627759643057-1.0155586876139762" rel="p--0.2937627759643057-1.0155586876139762"><span id="links_name_object">Коттедж №28</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.1824889971899475-1.0341043174097024" rel="p--0.1824889971899475-1.0341043174097024"><span id="links_name_object">Коттедж №29</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li><li><a  href="#" id="a--0.10088822608875145-0.9703073509124037" rel="p--0.10088822608875145-0.9703073509124037"><span id="links_name_object">Коттедж №30</span> <span><span> Будни: 8500р. </span><span>Выходные: 8900р.</span></span></a></li>							
						</ul>
						<!--a class="close"></a-->
					</div>
				</div>
			</div>
			<style>
			.arrival_date, .check_out, .number_standard, .number_luxury {
				display: none;
			}
			</style>
			<div class="contentblock">
					<a href="#" class="close-content"></a>
					<h3></h3>
					<div id='daily'>
					<!--<div class="calendar_date_from_to_reservation">
						<span class="date_from_reservation"></span>
						<span class="date_to_reservation"></span>
					</div>-->
					<div class='arrival_date'>
					<span class='arrival_date_text'>Дата заезда: </span>
					<input type='text' class='tcal' name='date_ot' id='date_ot' value=''/>
					</div>
					<div class='check_out'>
					<span class='check_out_text'>Дата отъезда: </span>
					<input type='text'  class='tcal' name='date_do' id='date_do' value=''/>
					</div>
					<div class='check_out_colvo' style="display: none;">
					<span class='check_out_text'>Количество человек: </span>
					<input type='text' name='colvo_people' id='colvo_people' value=''/>
					</div>
					<div class='place_location'></div>
					<div><!--input type='submit' class='button' name='filter' id='filter' value='Применить'/--></div>
					<!--<div class='legend'>
					  <div><span class='clear'></span>Свободные</div>
					  <div><span class='reservations'></span>Занятые</div>
					  <div><span class='user_reservation'></span>Свободные в выбраном диапазоне</div>
					  <div><span class='user_reservation reservations'></span>Занятые в выбраном диапазоне</div>
					</div>-->
					</span><div class='table_payments'></div> 
					<div id='add_cart'></div><div id='cart_cart'></div>
					</div>
					<div id="hourly">
						<div class="block_count_people_hourly" style="display: none;">Количество мест: <input type="text" id="count_people_hourly" name="count_people_hourly" value=""></div>
						<div class="hourly_bath"><input type="text" id="input_date" class="tcal"><input class="button" type="button" id="apply" name="apply" value="Применить"></div>
						<div class="time_from_time_to">
						<p>Время с: <select size='1' id='time_from' name='time_from'><option value='00:00'>00:00</option><option value='01:00'>01:00</option><option value='02:00'>02:00</option><option value='03:00'>03:00</option><option value='04:00'>04:00</option><option value='05:00'>05:00</option><option value='06:00'>06:00</option><option value='07:00'>07:00</option><option value='08:00'>08:00</option><option value='09:00'>09:00</option><option value='10:00'>10:00</option><option value='11:00'>11:00</option><option value='12:00'>12:00</option><option value='13:00'>13:00</option><option value='14:00'>14:00</option><option value='15:00'>15:00</option><option value='16:00'>16:00</option><option value='17:00'>17:00</option><option value='18:00'>18:00</option><option value='19:00'>19:00</option><option value='20:00'>20:00</option><option value='21:00'>21:00</option><option value='22:00'>22:00</option></select></p><p>Время до: <select size='1' id='time_to' name='time_to'><option value='01:00'>01:00</option><option value='02:00'>02:00</option><option value='03:00'>03:00</option><option value='04:00'>04:00</option><option value='05:00'>05:00</option><option value='06:00'>06:00</option><option value='07:00'>07:00</option><option value='08:00'>08:00</option><option value='09:00'>09:00</option><option value='10:00'>10:00</option><option value='11:00'>11:00</option><option value='12:00'>12:00</option><option value='13:00'>13:00</option><option value='14:00'>14:00</option><option value='15:00'>15:00</option><option value='16:00'>16:00</option><option value='17:00'>17:00</option><option value='18:00'>18:00</option><option value='19:00'>19:00</option><option value='20:00'>20:00</option><option value='21:00'>21:00</option><option value='22:00'>22:00</option><option value='23:00'>23:00</option></select></p>						</div>

						<input type="hidden"id="id_object_val">
					</div>
					<div id='id_object' style='display: none;'></div>
					<div id='id_objectt' style='display: none;'></div>
					<div class="contentdesc">
						<div class="price">
							<p>Цена в будни:
							<span>1800<small>/чел</small></span></p>
							<p>Цена в выходные:
							<span>1900<small>/чел</small></span></p>
							<p>Общее количество мест: <b>10</b></p>
							<p>Количество комнат для проживания: <b>3 (1-но, 2-х местные)</b></p>
						</div>
						<p>Spain, officially the Kingdom of Spain . With an area of 504,030 km², it is the second largest country in Western Europe and the European Union after France.</p>
					</div>
					<!--<div class="calendar_block"></div>-->
					
					<!--CDES BILA KORZINA -->
					
			</div>
			
			<div class="message">здесь выводятся сообщения</div>

			
			
			<a class="zoom" id="zoomplus"></a>
			<a class="zoom" id="zoomminus"></a>
			<div class="mobinfo"></div>
			<a href="#" class="mobmenu"></a>
			<div class="help" id="help"></div>
			

			
			
		</div>
		<div class="calendar_block">
			</div>
	
		


	<!--div class="clouds-left-bottom">
	</div-->
	
	<img class="compas" src="../img/comp.png" />
	
	<!--форма обратной связи-->		
<div class="popup-wind">
</div>
<div class="popup feedback">
	<a class="close close-popup"></a>
	<div class="contact-form" id="tec_support">
		<h3>Обратная связь</h3>
		<div id="message_feedback"></div>
		<input type="text" id="name_feedback" maxlength="20" placeholder="Ваше имя">
		<input type="text" id="mail_feedback" maxlength="40" placeholder="Ваш e-mail">
		<input type="text" id="subject_feedback" maxlength="50"placeholder="Тема">
		<textarea id="comment_feedback" placeholder="Вашe сообщение"></textarea>
		<a class="button" id="press_feedback">Отправить</a>
		
	</div>
</div>







<style type="text/css">

	html, body, #app {
	    margin: 0;
	    width: 100%;
	    height: 100%; 
	}
	.auth-popup{
		z-index: 9999 !important;
	}
	#map-leaflet { 
				position:absolute; 
				top:0; 
				bottom:0; 
				width:100%; 
			}
			.now-zoom {
				position: fixed;
				top: 3px;
				left: 50px;
			}
			.now-coord {
				position: fixed;
				top: 3px;
				left: 1040px;
				z-index: 15;
			}
</style>

<?php 
//require_once($_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/twentyfifteen/footer.php'); 

?>