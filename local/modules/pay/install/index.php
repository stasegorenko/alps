<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

Loc::loadMessages(__FILE__);

class pay extends CModule {

    public function __construct() {
        if (is_file(__DIR__.'/version.php')){
            include_once(__DIR__.'/version.php');
            $this->MODULE_ID           = get_class($this);
            $this->MODULE_VERSION      = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
            $this->MODULE_NAME         = Loc::getMessage('ALTAYKZPAY_NAME');
            $this->MODULE_DESCRIPTION  = Loc::getMessage('ALTAYKZPAY_DESCRIPTION');
        } else {
            CAdminMessage::ShowMessage(
                Loc::getMessage('ALTAYKZPAY_FILE_NOT_FOUND').' version.php'
            );
        }
    }
    
    public function DoInstall() {

        global $APPLICATION;

        // мы используем функционал нового ядра D7 — поддерживает ли его система?
        if (CheckVersion(ModuleManager::getVersion('main'), '14.00.00')) {
            // копируем файлы, необходимые для работы модуля
            $this->InstallFiles();
            // создаем таблицы БД, необходимые для работы модуля
            $this->InstallDB();
            // регистрируем модуль в системе
            ModuleManager::registerModule($this->MODULE_ID);
            // регистрируем обработчики событий
            $this->InstallEvents();
        } else {
            CAdminMessage::ShowMessage(
                Loc::getMessage('ALTAYKZPAY_INSTALL_ERROR')
            );
            return;
        }

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage('ALTAYKZPAY_INSTALL_TITLE').' «'.Loc::getMessage('ALTAYKZPAY_NAME').'»',
            __DIR__.'/step.php'
        );
    }
    
    public function InstallFiles() {         
    }
    
    public function InstallDB() { 
        global $DB;
        $this->errors = false;
        //$this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . "/local/modules/pay/install/db/install.sql");
        if (!$this->errors) {
 
            return true;
        } else
            return $this->errors; 
    }

    public function InstallEvents() { 
    }

    public function DoUninstall() {

        global $APPLICATION;

        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->UnInstallEvents();

        ModuleManager::unRegisterModule($this->MODULE_ID);

        $APPLICATION->IncludeAdminFile(
            Loc::getMessage('ALTAYKZPAY_UNINSTALL_TITLE').' «'.Loc::getMessage('ALTAYKZPAY_NAME').'»',
            __DIR__.'/unstep.php'
        );

    }

    public function UnInstallFiles() { 
    }
    
    public function UnInstallDB() {
        return;
    }
    
    public function UnInstallEvents(){ 
    }

}