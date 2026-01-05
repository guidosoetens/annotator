<?php

$filename = '../data/timestamp';
$time = time();
$data = "{$time}";
file_put_contents($filename , $data);

?>