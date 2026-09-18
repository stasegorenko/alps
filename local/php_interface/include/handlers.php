<?
use Bitrix\Main\EventManager;

$eventManager = EventManager::getInstance();

$eventManager->addEventHandler('iblock', 'OnAfterIBlockElementAdd', ['\\AltayKz\\EventHandler\\IBlockHandler', 'onAfterIBlockElementAddHandler']);
?>