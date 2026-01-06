<?php

$DB_LOCATION = '../data/database.db';

class DataBase extends SQLite3 {
    function __construct() {
        global $DB_LOCATION;
        $this->open($DB_LOCATION);
        $this->busyTimeout(5000);
    }
}

function init_db($db) {

    global $DB_LOCATION;

    chmod($DB_LOCATION, 0777); 

    $sql = "CREATE TABLE SESSIONS (
        SESSION_ID      INTEGER NOT NULL,
        CURRENT_SLIDE   INTEGER NOT NULL,
        HOST_ENCR       INTEGER NOT NULL
    )";
    $db->exec($sql); 

    $sql = "CREATE TABLE USERS (
        USER_ID     INTEGER NOT NULL,
        SESSION_ID  INTEGER NOT NULL
    )";
    $db->exec($sql);

    $sql = "CREATE TABLE ANNOTATION (
        ANNOTATION_ID   INTEGER NOT NULL,
        SESSION_ID      INTEGER NOT NULL,
        USER_ID         INTEGER NOT NULL,
        ANNOTATION      TEXT NOT NULL,
        POS_X           INTEGER NOT NULL,
        POS_Y           INTEGER NOT NULL
    )";
    $db->exec($sql); 
}

?>