<?php 
 
Bitrix\Main\Loader::registerAutoloadClasses(
    'pay',
    array(
        'Altaykz\\OrdersTable' => 'lib/orm/OrdersTable.php',
    )
);
