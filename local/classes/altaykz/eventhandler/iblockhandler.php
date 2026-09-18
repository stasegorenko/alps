<?php

namespace AltayKz\EventHandler;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Web\Json;

/**
 * Class IBlockHandler
 * @packages Ilab\EventHandler
 */
class IBlockHandler
{  
    /**
     * @param array $arFields
     * @return void
     * @throws ArgumentException
     */
    public static function onAfterIBlockElementAddHandler(array &$arFields): void
    {        
        // //проверяем нет ли уже брони такой
        // $arSelect = ["ID", "NAME", "PROPERTY_room_id", "PROPERTY_date_time_start", "PROPERTY_date_time_end"];
        // $arFilter = [
        //     "IBLOCK_ID" => $arFields["IBLOCK_ID"], 
        //     "ACTIVE" => "Y",
        //     "PROPERTY_room_id" => $arFields['PROPERTY_VALUES']['room_id'],
        //     "PROPERTY_date_time_start" => $arFields['PROPERTY_VALUES']['date_time_start'],
        //     "PROPERTY_date_time_start" => $arFields['PROPERTY_VALUES']['date_time_start'],
        // ];

        // $dups = [];
        // $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        // while($book_iter = $res->GetNext()){
        //     $dups[] = $book_iter;           
        // }
        // if(count($dups)>0)
        // {
        //     writeToLog($arFields, 'onAfterIBlockElementAddHandler arFields');
        //     writeToLog($dups, 'onAfterIBlockElementAddHandler duplicate');   
        // } 
        
 
        $deal_id = $arFields['PROPERTY_VALUES']['deal_id'];
        $book_id = $arFields['ID'];
 
        //записываем id брони в сделку
        $queryUrl ='https://altaykz.bitrix24.kz/rest/1/butzyhcav8y1ay1k/crm.deal.update.json';
        $queryData = http_build_query(array(
            'id' => $deal_id,
            'fields' => array(
                "UF_CRM_1693931478" => $book_id   
            ),
        ));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $queryUrl,
            CURLOPT_POSTFIELDS => $queryData,
        ));

        $result = curl_exec($curl);
        curl_close($curl);
        $update_result = json_decode($result, true);

        // writeToLog($update_result, 'init RESPONSE $update_result - '.$book_id.' - '.$deal_id); 

    }

    /**
     * @param array $arFields
     * @return void
     * @throws ArgumentException
     */
    public static function onAfterIBlockElementUpdateHandler(array &$arFields): void
    {
       
    }

   
    protected static function makeUrl(string $action): string
    {
        $url = '';
        switch ($action)
        {
            case 'short_uri':
                $url = '/api/short-uri/create/';
                break;
            case 'redirection_mobile':
                $url = '/api/redirection-mobile/create/';
                break;
            default:
                break;
        }
        return $url;
    }
}