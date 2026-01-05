<?php

include 'db.php';

if(file_exists($DB_LOCATION)) {
    $time = time();
    copy($DB_LOCATION , "../data/backup/backup_{$time}.db");
}

?>