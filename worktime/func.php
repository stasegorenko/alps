<?php
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php"); 
     
class config {
 
  public static $db;

  public function __construct($db) { 
      self::$db = $db;
  }
   
  function get($key) {
    $q = self::$db->Query("SELECT * FROM worktime WHERE delta = '".$key."'")->Fetch();
    return json_decode($q['data'], true);
  } 
  
  function set($key, $data) {
    if (is_array($data)) $data = json_encode($data);
    $q = self::$db->Query("UPDATE worktime SET data = '".$data."', date = NOW() WHERE delta = '".$key."'");
    
    return true;
  } 

} 