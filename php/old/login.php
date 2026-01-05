<?php

include 'general.php';

$user = decode_index(cleanHexInput($_GET['user']), $USER_ENCR_KEY);
if($user < 0)
    fail();

$json = file_get_contents('../team/data.json');
$team_data = json_decode($json, true); 
$qs = $team_data['questions'];

$wait = 7.0 - $CURR_WEEK_TIME_FRAC;
if($APP_LOCKED) 
    $wait = 0.5 - $CURR_WEEK_TIME_FRAC;
$seconds_until_refresh = $wait * $FRAC_TO_DAYS;

$refresh_id = file_get_contents('../data/timestamp');
$result = array(
    'name' => 'UNKNOWN',
    'success' => TRUE,
    'week_id' => $CURRENT_WEEK,
    'app_locked' => $APP_LOCKED,
    'seconds_until_refresh' => $seconds_until_refresh,
    'question' => $qs[min($CURRENT_WEEK, count($qs) - 1)],
    'refresh_id' => $refresh_id
);

$sql = "SELECT NAME FROM USERS WHERE USER_ID = $user;";
$ret = $db->query($sql);
$first = $ret->fetchArray(SQLITE3_ASSOC);
if($first)
    $result['name'] = $first['NAME'];
else 
    fail();

echo json_encode($result);

?>