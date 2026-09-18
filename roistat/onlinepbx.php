<?php

if (empty($_REQUEST)) {
    die('Data is empty');
}

$direction = $_REQUEST['direction'];
$event     = $_REQUEST['event'];
if ($direction !== 'inbound') {
    die('call is outbound');
}

$accessEvent = ['call_end'];
if (!in_array($event, $accessEvent)) {
    die('Is empty');
}

require_once __DIR__ . '/RoistatApi.php';

$caller       = $_REQUEST['caller']; //Номер звонившего
$callee       = $_REQUEST['callee']; //МенеНомерджер
$date         = $_REQUEST['date'];
$download_url = $_REQUEST['download_url'];

const ROISTAT_PROJECT_ID = '228327';
const ROISTAT_KEY        = '4beb63fa894465d466f0a7e9544dbf0a';

$managers = [
    101 => 'Богдан',
    102 => 'Серафима',
    103 => 'Алена',
    104 => 'Пантолечение',
    105 => 'Ольга',
];

$roistatApi = RoistatApi::getInstance(ROISTAT_PROJECT_ID, ROISTAT_KEY);

$r = $roistatApi->speechCallAdd([
    "date"     => $date,
    "callee"   => $callee,
    "caller"   => $caller,
    "file_url" => $download_url,
    'operator' => array_key_exists($callee, $managers) ? $managers[$callee] : null,
]);

echo "<pre>";
print_r($r);