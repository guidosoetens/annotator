<?php 

include 'db.php';
include 'encrypt.php';

date_default_timezone_set('Europe/Amsterdam');
$FRAC_TO_DAYS = 24 * 60 * 60;
$TOTAL_TIME_FRAC = (time() - strtotime('2024-10-28 00:00:00')) / $FRAC_TO_DAYS;

$CURRENT_WEEK  = floor($TOTAL_TIME_FRAC / 7.0);
$CURR_WEEK_TIME_FRAC = fmod($TOTAL_TIME_FRAC, 7.0);
$APP_LOCKED = $CURR_WEEK_TIME_FRAC < 0.5;

function fail($str = '(no message)') {
    echo "{ \"success\" : false, \"message\" : \"{$str}\" }";
    exit(0);
}

function success($str = '(no message)') {
    echo "{ \"success\" : true, \"message\" : \"{$str}\" }";
    exit(0);
}

$db = new DataBase();
if(!$db) 
    fail('Cannot create quiz database');

function cleanInput($s) {
    return intval(preg_replace("/[^0-9-]+/","", $s));
}

?>