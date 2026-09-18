<?php 

$start_time = '10:00';
$start_time2 = '14:00';
$start_time_bud = '09:00';
$end_time = '18:00';
$end_time2 = '14:00';
$end_time3 = '12:00';
$end_time4 = '14:00';
$night_start_time = '18:00';
$night_end_time = '23:00';
$night_start_time1 = '15:00';
$night_end_time1 = '22:00';
$night_end_time2 = '15:00';
$night_start_time3 = '18:00';
$night_start_time4 = '10:00';
$status_time = 'НЕТ';
$status_time_request = 'По заявке';
$status_time1 = 'работает';


$times = array(
 1 => array(
    1 => array($status_time_request),
    2 => array($status_time_request),
    3 => array($status_time_request),
    4 => array($status_time_request),
    5 => array($status_time_request),
    6 => array($start_time_bud,$night_start_time3),
    0 => array($start_time_bud,$night_start_time3),
  ),
  2 => array(
    1 => array($start_time_bud,$night_start_time3),
    2 => array($start_time2,$night_start_time3),
    3 => array($start_time_bud,$night_start_time3),
    4 => array($start_time_bud,$night_start_time3),
    5 => array($start_time_bud,$night_start_time3),
    6 => array($start_time_bud,$night_start_time3),
    0 => array($start_time_bud,$night_start_time3),
  ),
  3 => array(
    1 => array($start_time2,$night_start_time3),
    2 => array($start_time_bud,$night_start_time3),
    3 => array($start_time,$night_start_time3),
    4 => array($start_time,$night_start_time3),
    5 => array($start_time,$night_start_time3),
    6 => array($start_time_bud,$night_start_time3),
    0 => array($start_time_bud,$night_start_time3),
  ),

  4 => array(
    1 => array($status_time),
    2 => array($status_time),
    3 => array($status_time),
    4 => array($status_time),
    5 => array($status_time),
    6 => array($start_time,$night_start_time3),
    0 => array($start_time,$night_start_time3),
  ),
);


$night_times = array(

 1 => array(
    1 => array($status_time_request),
    2 => array($status_time_request),
    3 => array($night_start_time,$night_end_time1),
    4 => array($night_start_time,$night_end_time1),
    5 => array($night_start_time,$night_end_time1),
    6 => array($night_start_time3,$night_end_time1),
    0 => array($night_start_time3,$night_end_time1),
  )

);


$cables = array(
  1 => 'БКД-1',
  2 => 'БКД-2',
  3 => 'ККД-3',
  4 => 'ККД-4',
);
 
?>
