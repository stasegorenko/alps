<?php
/*
 * Файл local/modules/scrollup/install/unstep.php
 */

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!check_bitrix_sessid()){
    return;
}

if ($errorException = $APPLICATION->GetException()) {
    // ошибка при удалении модуля
    CAdminMessage::ShowMessage(
        Loc::getMessage('ALTAYKZPAY_UNINSTALL_FAILED').': '.$errorException->GetString()
    );
} else {
    // модуль успешно удален
    CAdminMessage::ShowNote(
        Loc::getMessage('ALTAYKZPAY_UNINSTALL_SUCCESS')
    );
}
?>

<form action="<?= $APPLICATION->GetCurPage(); ?>"> <!-- Кнопка возврата к списку модулей -->
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID; ?>" />
    <input type="submit" value="<?= Loc::getMessage('ALTAYKZPAY_RETURN_MODULES'); ?>">
</form>