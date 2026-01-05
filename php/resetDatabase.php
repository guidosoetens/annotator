<?php

include 'db.php';

if($_GET['password'] != 'pikkebaas') {
    echo 'XS DENIED!!';
    return;
}

if(file_exists($DB_LOCATION)) {
    $time = time();
    copy($DB_LOCATION , "../data/backup/backup_{$time}.db");
    unlink($DB_LOCATION);
}

$db = new DataBase();

init_db($db);

echo 'Hij is nu leeg';

?>