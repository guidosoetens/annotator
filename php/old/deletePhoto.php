<?php

include 'general.php';

$user = decode_index(cleanHexInput($_GET['user']), $USER_ENCR_KEY);
if($user < 0)
    fail("invalid user...");


$ret = $db->query("SELECT * FROM PHOTOS WHERE USER_ID = $user AND WEEK = $CURRENT_WEEK;");
while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    $photo = $row['PHOTO_ID'];

    //delete photo
    $db->exec("DELETE FROM PHOTOS WHERE PHOTO_ID = $photo;");

    //delete likes related to photo
    $db->exec("DELETE FROM LIKES WHERE PHOTO_ID = $photo;");
}

success();

?>