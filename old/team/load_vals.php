<?php

$json = file_get_contents('data.json');

if ($json === false) {
    die('Error reading the JSON file');
}

// Decode the JSON file
$data = json_decode($json, true); 

// Check if the JSON was decoded successfully
if ($data === null) {
    die('Error decoding the JSON file');
}

date_default_timezone_set('Europe/Amsterdam');
$FRAC_TO_DAYS = 24 * 60 * 60;
$TOTAL_TIME_FRAC = (time() - strtotime('2024-10-28 00:00:00')) / $FRAC_TO_DAYS;
$CURRENT_WEEK  = floor($TOTAL_TIME_FRAC / 7.0);

$data['week_index'] = $CURRENT_WEEK;

// Display data
echo json_encode($data);

?>