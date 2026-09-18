<?
//склонение слов в зависимости от числа     
function declOfNum($num, $titles) {
    $cases = array(2, 0, 1, 1, 1, 2);
    return $num . " " . $titles[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
}

/**
 * Write data to log file.
 *
 * @param mixed $data
 * @param string $title
 *
 * @return bool
 */
function writeToLog($data, $title = '') {
    $log = "\n------------------------\n";
    $log .= date("Y.m.d G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/log.txt', $log, FILE_APPEND);
    return true;
} 

function vd($data) {
    //if(CUser::IsAuthorized()) {
	echo "<pre>".print_r($data,1)."</pre>";
    //}
}
 

// function translate_phone($phone){
//     // $result = preg_replace('/[^0-9,.]/', '', $phone);
//     // if(strlen($result) > 10){
//     //     $result = substr($result, (strlen($result) - 10));
//     // }
// 	$result = str_replace(" ","",$phone);
//     return $result;
// }
?>