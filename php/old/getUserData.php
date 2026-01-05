<?php

include 'general.php';

$user = decode_index(cleanHexInput($_GET['user']), $USER_ENCR_KEY);
if($user < 0)
    fail('invalid user...');

function isLiked($user, $photo_id) {
    global $db;
    $sql = "SELECT * FROM LIKES WHERE USER_ID = $user AND PHOTO_ID = $photo_id;";
    $ret = $db->query($sql);
    if($ret->fetchArray(SQLITE3_ASSOC))
        return TRUE;
    return FALSE;
}

$array = array();

$ret = $db->query("SELECT * FROM PHOTOS WHERE WEEK = $CURRENT_WEEK ORDER BY TIMESTAMP;");
while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
    $elem = array( 
        'photo_id' => $row['PHOTO_ID'],
        'caption' => $row['CAPTION'],
        'liked' => isLiked($user, $row['PHOTO_ID']),
        'own_picture' => ($user == $row['USER_ID'])
    );
    array_push($array, $elem);
}

$refresh_id = file_get_contents('../data/timestamp');
$result = array( 
    'success' => TRUE,
    'pictures' => $array,
    'week_id' => $CURRENT_WEEK,
    'refresh_id' => $refresh_id
);

echo json_encode($result);

?>