<?

use Bitrix\Main\Config\Option;
\Bitrix\Main\Loader::registerNamespace(
	'Altaykz\\',
	\Bitrix\Main\Loader::getDocumentRoot() . '/local/classes/altaykz/'
); 

//Константы
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/constants.php");
}
//Обработчики
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/handlers.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/handlers.php");
} 
//функции
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/functions.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/include/functions.php");
}
//composer
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/vendor/autoload.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/vendor/autoload.php");
}
?>