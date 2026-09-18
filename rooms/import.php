<?  
//require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); 
  
$filename = 'arraytest.txt';
$rooms = unserialize(file_get_contents($filename)); 
 

CModule::IncludeModule('iblock'); 
 

foreach($rooms as $room):
    
    $el = new CIBlockElement;

    $PROP = array();

    $PROP = $room;  

    $PROP['MORE_PHOTO_LINKS'] = '';
	foreach ($room['MORE_PHOTO'] as $photo) { 
        if($photo != ''){
         
            //$PROP['MORE_PHOTO'][] = CFile::MakeFileArray($photo);
            $PROP['MORE_PHOTO_LINKS'] = $PROP['MORE_PHOTO_LINKS'].$photo.PHP_EOL;
        }       
	} 

    $arLoadProductArray = Array( 
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID"      => 3,
        "PROPERTY_VALUES"=> $PROP,
        "NAME"           => $room['TITLE'],
        "ACTIVE"         => "Y",            // активен
        "PREVIEW_TEXT"   => $room['DETAIL_TEXT'], 
       // "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
    );

    echo '<pre>';
    print_r($arLoadProductArray);
    echo '</pre>';

    // if($PRODUCT_ID = $el->Add($arLoadProductArray))
    //     echo "New ID: ".$PRODUCT_ID;
    // else
    //     echo "Error: ".$el->LAST_ERROR;
    
endforeach; 

?>
 