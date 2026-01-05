<?php

$filename = 'data.json';
if(file_exists($filename)) {
    $time = time();
    copy($filename , "./backup/backup_{$time}.json");
}

$data = $_POST["data"];
$res = file_put_contents($filename , $data);

if(!$res)
    echo 'oeikes!</br>';

echo 'dit is de data: ' . $data . " | " . $res;

?>