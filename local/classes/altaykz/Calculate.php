<?php
namespace Altaykz; 

use Altaykz\Booking;
use Bitrix\Main\Error;  

class Calculate
{ 
    const WEEKENDS = [5,6,7];
    const SUMMER_START = '01.04';
    const SUMMER_END = '17.11'; 

    //ДОПЛАТА В СУТКИ

    //альпы ВВ
    const VV_ADULT = 18000;
    const VV_ADULT_HOLIDAY = 25000;
    const VV_CHILD = 11000;
    const VV_CHILD_HOLIDAY = 17000; 

    //альпы лечение    
    const ALPS_CURE_ADULT = 16000;
    const ALPS_CURE_ADULT_HOLIDAY = 16000;
    const ALPS_CURE_CHILD = 12000;
    const ALPS_CURE_CHILD_HOLIDAY = 12000;  

    //альпы пантолечение  
    const ALPS_PANTO_ADULT = 35000;
    const ALPS_PANTO_ADULT_HOLIDAY = 35000;
    const ALPS_PANTO_CHILD = 0;
    const ALPS_PANTO_CHILD_HOLIDAY = 0;  

    //изумрудный лечение    
    const CURE_ADULT = 18000;
    const CURE_ADULT_HOLIDAY = 18000;
	const CURE_CHILD = 14000;
    const CURE_CHILD_HOLIDAY = 14000; 

    //изумрудный катание    
    const IZUM_SKI_ADULT = 18000;
    const IZUM_SKI_ADULT_HOLIDAY = 25000;
    const IZUM_SKI_CHILD = 11000;
    const IZUM_SKI_CHILD_HOLIDAY = 17000;  


    const DOP_PEOPLE_PRICE = 11000; 

	const ALPS_SEASONS = [
		1 => ['01.04.2026', '20.04.2026', 0.0],
		2 => ['15.06.2026', '15.08.2026', 0.0],
		3 => ['16.08.2026', '15.10.2026', 0.0],
		4 => ['16.08.2026', '15.10.2026', 0.0],
		5 => ['16.08.2026', '15.10.2026', 0.0],
		6 => ['16.08.2026', '15.10.2026', 0.0],
		7 => ['16.08.2026', '15.10.2026', 0.0],
		8 => ['16.08.2026', '15.10.2026', 0.0],
		9 => ['01.04.2026', '20.04.2026', 0.0],
    ];

	const ALPS_EXTENDED_DISCOUNTS = [
		1 => ['01.04.2026', '20.04.2026', 0.5],
		// 2 => ['15.06.2026', '15.08.2026', 0.0],
		// 3 => ['16.08.2026', '15.10.2026', 0.0],
		// 4 => ['16.08.2026', '15.10.2026', 0.0], 
    ];

	const IZUM_EXTENDED_DISCOUNTS = [
		1 => ['01.04.2026', '20.04.2026', 0.5],
		// 2 => ['15.06.2026', '15.08.2026', 0.0],
		// 3 => ['16.08.2026', '15.10.2026', 0.0],
		// 4 => ['16.08.2026', '15.10.2026', 0.0], 
    ];

    const ALPS_EARLY_BOOK_DISCOUNT = 0.0;
    const ALPS_LONG_BOOK_DISCOUNT = 0.0;


    public static function handle($params)
    {                    
        $roomProps = self::getRoomInfo($params['room_id']);

        $date_start = $params['date_start'];
        $date_end = $params['date_end'];
        $beds = $roomProps['BEDS']['VALUE'];            
        $beds_max = $roomProps['BEDS_MAX']['VALUE'];
        $adults = $params['people'];
        $childs = $params['childs'];
        $if_vv = $params['if_vv'];
        $if_ski = $params['if_ski'];
        $if_cure = $params['if_cure'];
        $if_panto = $params['if_panto'];
        $if_besedka = $params['if_besedka']; 

        //!!!ДЛЯ БЕСЕДКИ!!!
        if($if_besedka == 'true') 
		{
            if(self::isNewYear($date_start))
                die('Покупка беседок в сезон 2026-2027, включая новогодние праздники с 29 декабря по 3 января, производится только через отдел продаж'); 

            return $roomProps[self::getPavilionPriceKey($date_start)]['VALUE']; 
		}

        //!!!ДЛЯ НОМЕРОВ!!!        
        $total_summ = 0; 
        $over_people = 0;  
        $discount = 0;
		$early_book_discount = 0;

        $total_people = $adults + $childs;  
        if($total_people > $beds_max) 
            die('Максимальная вместимость номера '.$beds_max.' чел.'); 

        //доп места
        if($total_people > $beds) 
            $over_people = $total_people - $beds;

        $dates = self::get_dates($date_start, $date_end); 

        foreach ($dates as $date) 
        {                  
            if(self::isNewYear($date))
				die('Покупка номера в сезон 2026-2027, включая новогодние праздники с 29 декабря по 3 января, производится только через отдел продаж');   
            $season_discount = 0;  
            $discountExt = 0;

            $cur_price = (int)$roomProps[self::getRoomPriceKey($date)]['VALUE'];

            //ДЛЯ АЛЬП УЧИТЫВАЕМ СЕЗОННОСТЬ и период Раннего бронирования
            if(SITE_ID == 's1')
            {
                //скидка от 5ти дней 
                if(count($dates) >= 5)
                {              
                    foreach (self::ALPS_SEASONS as $season_key => $season_value) 
                    {
                        if(strtotime($date) >= strtotime($season_value[0]) 
                        && strtotime($date) <= strtotime($season_value[1]))
                        {
                            $season_discount = $season_value[2];
                            break(1);
                        }
                    } 

		            $discount = self::ALPS_LONG_BOOK_DISCOUNT; 
                    // на период Раннего бронирования                
                    $early_book_discount = self::ALPS_EARLY_BOOK_DISCOUNT; 
                }


                foreach (self::ALPS_EXTENDED_DISCOUNTS as $season_key => $season_value) 
                {
                    if(strtotime($date) >= strtotime($season_value[0]) 
                    && strtotime($date) <= strtotime($season_value[1]))
                    {
                        $discountExt = $season_value[2];
                        break(1);
                    }
                }  

                $cur_price = $cur_price * (1 - $discount) * (1 - $season_discount) * (1 - $early_book_discount) * (1 - $discountExt);   

            }         


            if(SITE_ID == 's2')
            { 
                foreach (self::IZUM_EXTENDED_DISCOUNTS as $season_key => $season_value) 
                {
                    if(strtotime($date) >= strtotime($season_value[0]) 
                    && strtotime($date) <= strtotime($season_value[1]))
                    {
                        $discountExt = $season_value[2];
                        break(1);
                    }
                }  

                $cur_price = $cur_price * (1 - $discount) * (1 - $season_discount) * (1 - $early_book_discount) * (1 - $discountExt);   

            }         

            $total_summ += $cur_price + $over_people * self::DOP_PEOPLE_PRICE;
        }

        //для ВВ к расчетам за номер плюсуем доп расчеты из констант
        if($if_vv == 'true')
        {               
            if(count($dates) < 3 && SITE_ID == 's1') 
                die('Ошибка: Опция "Все включено" действует при заказе путевки от 3-ех дней');

            if(count($dates) < 3 && SITE_ID == 's2') 
                die('Ошибка: Опция "С лечением" действует при заказе путевки от 3 дней');

            $total_summ += self::getVVPrice($dates, $adults, $childs);

        } 

        //для лечения
        if($if_cure == 'true')
        {               
            if(count($dates) < 5) 
                die('Ошибка: Опция "С лечением" действует при заказе путевки от 5-и дней');

            $total_summ += self::getAlpsCurePrice($dates, $adults, $childs);
        }

        //для пантолечения
        if($if_panto == 'true')
        {               
            if(count($dates) < 3) 
                die('Ошибка: Опция "С пантолечением" действует при заказе путевки от 3-ех дней');

            $total_summ += self::getAlpsPantoPrice($dates, $adults, $childs);
        }


        //для катания в изумрудном
        if($if_ski == 'true')
        {                    
            $total_summ += self::getIzumSkiPrice($dates, $adults, $childs);
        }

        // if(SITE_ID == 's1')
        // {
        //     //скидка от 5ти дней 
        //     if(count($dates) >= 5)
        //     {
        //         // на период Раннего бронирования                
        //         $early_book_discount = self::ALPS_EARLY_BOOK_DISCOUNT; 
        //         $discount = self::ALPS_LONG_BOOK_DISCOUNT;             
        //     }

        // }
        // $total_summ = $total_summ * (1 - $discount) * (1 - $season_discount) * (1 - $early_book_discount);


        return $total_summ;

    }


    public static function getPavilionPriceKey($date)
    {            
        $date = date('d.m.Y', strtotime($date)); 

        if(self::isHoliday($date) || self::isWeekend($date)){
            if(self::isSummer($date)) $price_key = 'PRICE_HOLIDAY_SUMMER'; 
            else $price_key = 'PRICE_HOLIDAY_WINTER';  
        }  
        else{
            if(self::isSummer($date)) $price_key = 'PRICE_SUMMER'; 
            else $price_key = 'PRICE_WINTER';                     
        }

        return $price_key;

    }   

    public static function getRoomPriceKey($date)
    {            
        $date = date('d.m.Y', strtotime($date)); 

        if(self::isHoliday($date)){
            if(self::isSummer($date)) $price_key = 'PRICE_HOLIDAY_SUMMER'; 
            else $price_key = 'PRICE_HOLIDAY_WINTER';  
        }  
        else{
            if(self::isSummer($date)) $price_key = 'PRICE_SUMMER'; 
            else $price_key = 'PRICE_WINTER';                     
        }

        return $price_key;

    }         

    public static function getVVPrice($dates, $adults, $childs)
    {   
        $total_vv_summ = 0;

        foreach ($dates as $date) {  

            if(SITE_ID == 's1')
            {
                if(self::isHoliday($date) || self::isWeekend($date)){
                    $price = self::VV_ADULT_HOLIDAY;
                    $price_child = self::VV_CHILD_HOLIDAY;		 
                }
                else{
                    $price = self::VV_ADULT;
                    $price_child = self::VV_CHILD;		 
                }
            }
            elseif(SITE_ID == 's2')
            {
                if(self::isHoliday($date) || self::isWeekend($date)){
                    $price = self::CURE_ADULT_HOLIDAY;
                    $price_child = self::CURE_CHILD_HOLIDAY;		 
                }
                else{
                    $price = self::CURE_ADULT;
                    $price_child = self::CURE_CHILD;		 
                }
            }


            $cur_price = $price * $adults + $price_child * $childs;


            $discount = 0;  
            $early_book_discount = 0; 
            $season_discount = 0;

            if(SITE_ID == 's1')
            {
                //скидка от 5ти дней 
                if(count($dates) >= 5)
                {   

                    foreach (self::ALPS_SEASONS as $season_key => $season_value) 
                    {
                        if(strtotime($date) >= strtotime($season_value[0]) 
                        && strtotime($date) <= strtotime($season_value[1]))
                        {
                            $season_discount = $season_value[2];
                            break(1);
                        }
                    } 

		            $discount = self::ALPS_LONG_BOOK_DISCOUNT; 
                    // на период Раннего бронирования                
                    $early_book_discount = self::ALPS_EARLY_BOOK_DISCOUNT; 

                } 

				$cur_price = $cur_price * (1 - $discount) * (1 - $season_discount) * (1 - $early_book_discount);

            } 

            $total_vv_summ += $cur_price;

        }

        return $total_vv_summ; 
    }

    public static function getAlpsCurePrice($dates, $adults, $childs)
    {    
        $total_summ = 0;

        foreach ($dates as $date) {  

            if(self::isHoliday($date) || self::isWeekend($date)){
                $price = self::ALPS_CURE_ADULT_HOLIDAY;
                $price_child = self::ALPS_CURE_CHILD_HOLIDAY;		 
            }
            else{
                $price = self::ALPS_CURE_ADULT;
                $price_child = self::ALPS_CURE_CHILD;		 
            }
 
            $cur_price = $price * $adults + $price_child * $childs;


            $discount = 0;  
            $early_book_discount = 0; 
            $season_discount = 0;
  
            //скидка от 5ти дней 
            if(count($dates) >= 5)
            {                
                foreach (self::ALPS_SEASONS as $season_key => $season_value) 
                {
                    if(strtotime($date) >= strtotime($season_value[0]) 
                    && strtotime($date) <= strtotime($season_value[1]))
                    {
                        $season_discount = $season_value[2];
                        break(1);
                    }
                } 
        
                $discount = self::ALPS_LONG_BOOK_DISCOUNT; 
                // на период Раннего бронирования                
                $early_book_discount = self::ALPS_EARLY_BOOK_DISCOUNT; 
                            
				$cur_price = $cur_price * (1 - $discount) * (1 - $season_discount) * (1 - $early_book_discount);

            }
  
            $total_summ += $cur_price;

        }

        return $total_summ; 

    }

    public static function getAlpsPantoPrice($dates, $adults, $childs)
    {   
        $total_summ = 0;

        foreach ($dates as $date) {  
 
            if(self::isHoliday($date) || self::isWeekend($date)){
                $price = self::ALPS_PANTO_ADULT_HOLIDAY;
                $price_child = self::ALPS_PANTO_CHILD_HOLIDAY;		 
            }
            else{
                $price = self::ALPS_PANTO_ADULT;
                $price_child = self::ALPS_PANTO_CHILD;		 
            }

            $cur_price = $price * $adults + $price_child * $childs;


            $discount = 0;  
            $early_book_discount = 0; 
            $season_discount = 0;

            //скидка от 5ти дней 
            if(count($dates) >= 5)
            {                
                foreach (self::ALPS_SEASONS as $season_key => $season_value) 
                {
                    if(strtotime($date) >= strtotime($season_value[0]) 
                    && strtotime($date) <= strtotime($season_value[1]))
                    {
                        $season_discount = $season_value[2];
                        break(1);
                    }
                } 

                $discount = self::ALPS_LONG_BOOK_DISCOUNT; 
                // на период Раннего бронирования                
                $early_book_discount = self::ALPS_EARLY_BOOK_DISCOUNT; 
                            
                $cur_price = $cur_price * (1 - $discount) * (1 - $season_discount) * (1 - $early_book_discount);
            
            }
  
            $total_summ += $cur_price;
        }

        return $total_summ; 

    }


    
    public static function getIzumSkiPrice($dates, $adults, $childs)
    {   
        $total_summ = 0;

        foreach ($dates as $date) {  
 
            if(self::isHoliday($date) || self::isWeekend($date)){
                $price = self::IZUM_SKI_ADULT_HOLIDAY;
                $price_child = self::IZUM_SKI_CHILD_HOLIDAY;		 
            }
            else{
                $price = self::IZUM_SKI_ADULT;
                $price_child = self::IZUM_SKI_CHILD;		 
            }

            $cur_price = $price * $adults + $price_child * $childs;
 
            $total_summ += $cur_price;
        }

        return $total_summ; 

    }

    //получаем все свойства номера
    public static function getRoomInfo($room_id)
    {   
        //CModule::IncludeModule('iblock');  
        \Bitrix\Main\Loader::includeModule("iblock");   

        $booking_handler = new Booking();
        $arSites = $booking_handler->sites;         
            
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_*");
        $arFilter = Array("IBLOCK_ID" => $arSites[SITE_ID]['roomsIblock'], "ACTIVE" => "Y", "ID" => $room_id);
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if($ob = $res->GetNextElement()){
            $arFields = $ob->GetFields();
            $arProps  = $ob->GetProperties(); 
        }

        return array_merge($arFields,$arProps);
    }
 
    public static function isSummer($date_to_check)
    {              
        $summer_start = self::SUMMER_START.'.'.date('Y');
        $summer_end = self::SUMMER_END.'.'.date('Y'); 
         
        return (strtotime($date_to_check) >= strtotime($summer_start) && 
                strtotime($date_to_check) < strtotime($summer_end)) ? true : false;         
    }
 
    
    public static function isWeekend($date_to_check, $custom_weekends = [])
    {     
        if(!empty($custom_weekends))                          
            return in_array(date('N', strtotime($date_to_check)), $custom_weekends) ? true : false; 

        return in_array(date('N', strtotime($date_to_check)), self::WEEKENDS) ? true : false;         
    }


    //получаем интервал между датами и собираем все даты в массив
    public static function get_dates($date_start, $date_end)
    { 
        $dates = array();

        $datetime1 = new \DateTime($date_start);
        $datetime2 = new \DateTime($date_end);
        $interval = $datetime1->diff($datetime2);
        $reserved_days = $interval->days;	 
            
        $cur_date = $datetime1;
            
        for($i = 0; $i < $reserved_days; $i++){                
            $dates[$i] = $cur_date->format('d.m.Y');	
            $cur_date->add(new \DateInterval('P1D'));		
        } 

        return $dates;
    }

    
    

    public static function isHoliday($date_to_check)
    {   
        $ar_holidays = array(
			//            '14.12.2025',
            '15.12.2025',
            '16.12.2025',
			'01.01.2026',
			'02.01.2026',
			'03.01.2026',
			'04.01.2026',
			'05.01.2026',
			'06.01.2026',
			'07.01.2026', //добавлено, для Айдоса
			//            '07.03.2026',
            '08.03.2026',
            '09.03.2026',
			//			'10.03.2026', //добавлено, для Айдоса
            '21.03.2026', //добавлено, для Айдоса
            '22.03.2026',
            '23.03.2026',
            '24.03.2026', //добавлено, для Айдоса
			//            '25.03.2026', //добавлено, для Айдоса
        );

        $found_key = array_search($date_to_check, $ar_holidays);
         
        return $found_key !== false ? true : false;
    }

    
	public static function isNewYear($date_to_check)
    {              
        $ar_newyear = array(
			'16.11.2026',
			'17.11.2026',
			'18.11.2026',
			'19.11.2026',
			'20.11.2026',
			'21.11.2026',
			'22.11.2026',
			'23.11.2026',
			'24.11.2026',
			'25.11.2026',
			'26.11.2026',
			'27.11.2026',
			'28.11.2026',
			'29.11.2026',
			'30.11.2026',
			'01.12.2026',
			'02.12.2026',
			'03.12.2026',
			'04.12.2026',
			'05.12.2026',
			'06.12.2026',
			'07.12.2026',
			'08.12.2026',
			'09.12.2026',
			'10.12.2026',
			'11.12.2026',
			'12.12.2026',
			'13.12.2026',
			'14.12.2026',
			'15.12.2026',
			'16.12.2026',
			'17.12.2026',
			'18.12.2026',
			'19.12.2026',
			'20.12.2026',
			'21.12.2026',
			'22.12.2026',
			'23.12.2026',
			'24.12.2026',
			'25.12.2026',
			'26.12.2026',
			'27.12.2026',
			'28.12.2026',
			'29.12.2026',
			'30.12.2026',
			'31.12.2026',
			'01.01.2027',
			'02.01.2027',
			'03.01.2027',
			'04.01.2027',
			'05.01.2027',
			'06.01.2027',
			'07.01.2027',
			'08.01.2027',
			'09.01.2027',
			'10.01.2027',
			'11.01.2027',
			'12.01.2027',
			'13.01.2027',
			'14.01.2027',
			'15.01.2027',
			'16.01.2027',
			'17.01.2027',
			'18.01.2027',
			'19.01.2027',
			'20.01.2027',
			'21.01.2027',
			'22.01.2027',
			'23.01.2027',
			'24.01.2027',
			'25.01.2027',
			'26.01.2027',
			'27.01.2027',
			'28.01.2027',
			'29.01.2027',
			'30.01.2027',
			'31.01.2027',
			'01.02.2027',
			'02.02.2027',
			'03.02.2027',
			'04.02.2027',
			'05.02.2027',
			'06.02.2027',
			'07.02.2027',
			'08.02.2027',
			'09.02.2027',
			'10.02.2027',
			'11.02.2027',
			'12.02.2027',
			'13.02.2027',
			'14.02.2027',
			'15.02.2027',
			'16.02.2027',
			'17.02.2027',
			'18.02.2027',
			'19.02.2027',
			'20.02.2027',
			'21.02.2027',
			'22.02.2027',
			'23.02.2027',
			'24.02.2027',
			'25.02.2027',
			'26.02.2027',
			'27.02.2027',
			'28.02.2027',
			'01.03.2027',
			'02.03.2027',
			'03.03.2027',
			'04.03.2027',
			'05.03.2027',
			'06.03.2027',
			'07.03.2027',
			'08.03.2027',
			'09.03.2027',
			'10.03.2027',
			'11.03.2027',
			'12.03.2027',
			'13.03.2027',
			'14.03.2027',
			'15.03.2027',
			'16.03.2027',
			'17.03.2027',
			'18.03.2027',
			'19.03.2027',
			'20.03.2027',
			'21.03.2027',
			'22.03.2027',
			'23.03.2027',
			'24.03.2027',
			'25.03.2027',
			'26.03.2027',
			'27.03.2027',
			'28.03.2027',
			'29.03.2027',
			'30.03.2027',
			'31.03.2027',
			'01.04.2027',
			'02.04.2027',
			'03.04.2027',
			'04.04.2027',
			'05.04.2027',
			'06.04.2027',
			'07.04.2027',
			'08.04.2027',
			'09.04.2027',
			'10.04.2027',
			'11.04.2027',
			'12.04.2027',
			'13.04.2027',
			'14.04.2027',
			'15.04.2027',
			'16.04.2027',
			'17.04.2027',
			'18.04.2027',
			'19.04.2027',
			'20.04.2027',
			'21.04.2027',
			'22.04.2027',
			'23.04.2027',



        );

        $found_key = array_search($date_to_check, $ar_newyear);
         
        return $found_key !== false ? true : false;         
    }
 
}