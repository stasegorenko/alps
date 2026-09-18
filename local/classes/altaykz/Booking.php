<?php
namespace Altaykz;  
use Bitrix\Main\Error;

class Booking
{
    private $fields = []; 
    public $last_error = ''; 
    public $siteId = '';    
    public $sites = [];
     
    public function __construct($curSiteId = '')
    {         
        \Bitrix\Main\Loader::includeModule('iblock');

        $this->siteId = $curSiteId ? $curSiteId : SITE_ID; 

        $this->sites = array(
            's1' => array(
                'bookingIblock' => IBLOCK_ALPS_BOOKING,
                'roomsIblock' => IBLOCK_ALPS_ROOMS,
                'prepaymentVal' => 1,
            ),         
            's2' => array(
                'bookingIblock' => IBLOCK_IZUM_BOOKING,
                'roomsIblock' => IBLOCK_IZUM_ROOMS,
                'prepaymentVal' => 3,
            ),         
            's3' => array(
                'bookingIblock' => IBLOCK_AUDA_BOOKING,
                'roomsIblock' => IBLOCK_AUDA_ROOMS,
                'prepaymentVal' => 2,
            ),          
        ); 
  
    }

    //создаем бронь
    public function add($book_info, $client_info = [])
    {     
        $check_dates_result = $this->check_dates(
            $book_info['room_id'], 
            $book_info['date_start'], 
            $book_info['time_start'], 
            $book_info['date_end'], 
            $book_info['time_end'], 
        );

        if($check_dates_result != 'allowed'){            
            $this->last_error = $check_dates_result;
            return false;
        }

        $el = new \CIBlockElement;
                    
        $PROP = array();

        $PROP['room_id'] = $book_info['room_id'];
        $PROP['date_time_start'] = $book_info['date_start'];
        $PROP['arrival'] = $book_info['time_start'];
        $PROP['date_time_end'] =  $book_info['date_end'];
        $PROP['departure'] = $book_info['time_end'];
        $PROP['fio'] = $client_info['fio'];
        $PROP['dates'] = self::get_dates($book_info['date_start'], $book_info['date_end'], 'json');        
        $PROP['prepayment'] = $book_info['prepayment'] ? $this->sites[$this->siteId]['prepaymentVal'] : '';
        $PROP['deal_id'] = $book_info['deal_id'] ? $book_info['deal_id'] : '';
        
        $arLoadProductArray = Array( 
            "IBLOCK_ID"      => $this->sites[$this->siteId]['bookingIblock'], 
            "NAME"           => 'Бронь с '.$book_info['date_start'].' по '.$book_info['date_end'],
            "ACTIVE"         => "Y",            
            "PROPERTY_VALUES"=> $PROP,
        );
        if($book_id = $el->Add($arLoadProductArray)) 
            return $book_id;
        else   
        {
            $this->last_error = $el->LAST_ERROR;
            throw new \Bitrix\Main\SystemException($el->LAST_ERROR); 
        }

    }

    
    //обновляем бронь
    public function update($book_id, $book_info, $client_info = [])
    {         
        //проверяем есть ли такая бронь в этом инфоблоке
        $arSelect = Array("ID", "NAME");
        $arFilter = Array("IBLOCK_ID" => $this->sites[$this->siteId]['bookingIblock'], "ACTIVE"=>"Y", "ID" => $book_id);
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        if(!$arFields = $res->GetNext()){
            writeToLog($book_id, 'incoming ERROR');
            die('нет брони с таким id в этом инфоблоке');
        }  

        $check_dates_result = $this->check_dates(
            $book_info['room_id'], 
            $book_info['date_start'], 
            $book_info['time_start'], 
            $book_info['date_end'], 
            $book_info['time_end'], 
            $book_id
        );

        if($check_dates_result != 'allowed'){  
            writeToLog($book_info, 'check_dates ERROR');          
            $this->last_error = $check_dates_result;
            return false;
        }
    
        $book_info['prepayment'] = $book_info['prepayment'] ? $this->sites[$this->siteId]['prepaymentVal'] : '';

        \CIBlockElement::SetPropertyValuesEx($book_id, false, array('room_id' => $book_info['room_id']));
        \CIBlockElement::SetPropertyValuesEx($book_id, false, array('date_time_start' => $book_info['date_start']));
        \CIBlockElement::SetPropertyValuesEx($book_id, false, array('date_time_end' => $book_info['date_end']));
        \CIBlockElement::SetPropertyValuesEx($book_id, false, array('arrival' => $book_info['time_start']));
        \CIBlockElement::SetPropertyValuesEx($book_id, false, array('departure' => $book_info['time_end']));
        \CIBlockElement::SetPropertyValuesEx($book_id, false, array('prepayment' => $book_info['prepayment']));
        \CIBlockElement::SetPropertyValuesEx($book_id, false, array('dates' => self::get_dates($book_info['date_start'], $book_info['date_end'], 'json')));  
        \CIBlockElement::SetPropertyValuesEx($book_id, false, array('fio' => $client_info['fio']));

        return true;
    }

 
    //получаем интервал между датами и собираем все даты в массив
    public static function get_dates($date_start, $date_end, $type = '')
    { 
        $dates = array();

        $datetime1 = new \DateTime($date_start);
        $datetime2 = new \DateTime($date_end);
        $interval = $datetime1->diff($datetime2);
        $reserved_days = $interval->days;	
        $reserved_days++;
            
        $cur_date = $datetime1;
            
        for($i=0; $i < $reserved_days; $i++){                
            $dates[$i] = $cur_date->format('d.m.Y');	
            $cur_date->add(new \DateInterval('P1D'));		
        }

        if($type == 'json') $dates = json_encode($dates);

        return $dates;
    }
    
    //проверка занятости номера в определенные даты
    public function check_dates($room_id, $date_start, $time_from, $date_end, $time_to, $book_id = ''){
     
        $ar_reserves = array();

        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_*");
        $arFilter = Array("IBLOCK_ID" => $this->sites[$this->siteId]['bookingIblock'], "PROPERTY_room_id" => $room_id, "ACTIVE"=>"Y");
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement()){
        
            $arFields = $ob->GetFields();
            $arProps  = $ob->GetProperties(); 

            if($book_id != '' && $book_id == $arFields['ID'])
                continue;

            $ar_reserves[$arFields['ID']]['dates'] = json_decode($arProps['dates']['~VALUE']);
            $ar_reserves[$arFields['ID']]['start'] = $arProps['date_time_start']['VALUE']; 
            $ar_reserves[$arFields['ID']]['end'] = $arProps['date_time_end']['VALUE']; 	
            $ar_reserves[$arFields['ID']]['arrival'] = $arProps['arrival']['VALUE']; 
            $ar_reserves[$arFields['ID']]['departure'] = $arProps['departure']['VALUE']; 
        }   
     
        $dates = self::get_dates($date_start, $date_end);
        $days_count = count($dates);
      
        $resultMsg = 'allowed';

        // теперь перебиваем этот массив и сравниваем с датами которые хотим забронировать								
        foreach($ar_reserves as $cur_book_id => $reserve_info){
            foreach($reserve_info['dates'] as $reserved_date){	
                
                $found_key = array_search($reserved_date, $dates);

                if($found_key !== false) {
 
                    //нормально, если последний день новой брони выпал на первый день существующей 
                    if($found_key == ($days_count-1) && $reserve_info['start'] == $dates[$found_key] 
                    && $days_count > 1 && $reserve_info['start'] != $reserve_info['end']){                        
                        //проверяем время 
                        if(strtotime($time_to) > strtotime($reserve_info['arrival'])){
                            $resultMsg = $reserve_info['start'].' номер доступен до '.$reserve_info['arrival'];
                            return $resultMsg;
                        }
                    }				
                    //или первый день новой попал на последний день старой 
                    elseif($found_key == 0 && $reserve_info['end'] == $dates[$found_key] 
                    && $reserve_info['start'] != $reserve_info['end']){                        
                        //проверяем время 
                        if(strtotime($time_from) < strtotime($reserve_info['departure'])){
                            $resultMsg = $reserve_info['end'].' номер доступен с '.$reserve_info['departure'];
                            return $resultMsg;
                        }
                    }                     
                    else{ 
                        $resultMsg = $dates[$found_key].' номер занят';
                        //$resultMsg .= ' ID брони: '.$cur_book_id;
                        return $resultMsg; 
                    } 
                }			
            }				
        }

        return $resultMsg;
    }


    //поиск всех номеров занятых в определенные даты. используется для фильтров на страницах списка номеров 
    public function get_reserved_rooms($date_start, $date_end){
           
        $dates = self::get_dates($date_start, $date_end);
                
        //смотрим брони только за последние 15 дней   
        $date = new \DateTime($date_start);
        $date->sub(new \DateInterval('P15D'));
        $filter_start_date = $date->format('Y-m-d');

        $date = new \DateTime($date_end);
        $filter_end_date = $date->format('Y-m-d');
        
        $arSelect = Array(  "IBLOCK_ID", "ID", 
                            "PROPERTY_date_time_start", 
                            "PROPERTY_date_time_end", 
                            "PROPERTY_dates", 
                            "PROPERTY_room_id"
                        );                
        $arFilter = Array(
            "IBLOCK_ID" => $this->sites[$this->siteId]['bookingIblock'], 
            "><PROPERTY_date_time_start" => array($filter_start_date, $filter_end_date),
            "ACTIVE"=>"Y"
        );
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($arFields = $res->GetNext()){         
            $intersectDates = array_intersect(json_decode($arFields['~PROPERTY_DATES_VALUE']), $dates); 

            if(count($intersectDates) > 0     
            && $date_start != $arFields['PROPERTY_DATE_TIME_END_VALUE'] 
            && $date_end != $arFields['PROPERTY_DATE_TIME_START_VALUE']){
                $rooms_to_exclude[$arFields['PROPERTY_ROOM_ID_VALUE']] = $arFields['PROPERTY_ROOM_ID_VALUE'];
            } 
            
        } 
              
        return $rooms_to_exclude;
    }
      
    
    //построение списка номеров для фильтров на страницах списка номеров 
    public function buildRoomsList($room_id = '', $filter = []){
           
        $arSelect = Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_NUMID");
        $arFilter = Array("IBLOCK_ID" => $this->sites[$this->siteId]['roomsIblock'], "ACTIVE"=>"Y");
        if(!empty($filter)) $arFilter = array_merge($arFilter, $filter);
        $res = \CIBlockElement::GetList(Array('property_NUMID' => 'ASC'), $arFilter, false, false, $arSelect);
        while($arFields = $res->GetNext()){          
            $sel = ($room_id != '' && $arFields['ID'] == $room_id) ? 'selected' : '';             
            $html.='<option '.$sel.' value="'.$arFields['ID'].'">'.$arFields['PROPERTY_NUMID_VALUE'].'</option>';  
        }        

        return $html;
    }
 

}
