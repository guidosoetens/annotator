<?php

include 'general.php';

$user = decode_index(cleanHexInput($_GET['user']), $USER_ENCR_KEY);
if($user < 0)
    return;

$photo = cleanHexInput($_GET['photo']);

//make sure the photo exists (in current week):
if(!$db->query("SELECT * FROM PHOTOS WHERE PHOTO_ID = $photo AND WEEK = $CURRENT_WEEK;")->fetchArray(SQLITE3_ASSOC)) {
    echo "photo does not exist anymore";
    return;
}

$sql = "DELETE FROM LIKES WHERE USER_ID = $user AND PHOTO_ID = $photo;";
$db->exec($sql);

?>