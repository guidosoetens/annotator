<?php

include 'general.php';

if($_GET['password'] != 'pikkebaas')
    fail('XS DENIED!!');

$result = array();

//add users:
$result['users'] = array();
$ret = $db->query("SELECT * FROM USERS;");
$index = 0;
while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    $user = array();
    $user['id'] = $row['USER_ID'];
    $user['name'] = $row['NAME'];
    $user['key'] = encode_index($row['USER_ID'], $USER_ENCR_KEY);
    $result['users'][$index] = $user;
    $index++;
}

//add pictures:
$result['photos'] = array();
$ret = $db->query("SELECT * FROM PHOTOS ORDER BY TIMESTAMP;");
$index = 0;
while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    $photo = array();
    $photo['id'] = $row['PHOTO_ID'];
    $photo['owner_id'] = $row['USER_ID'];
    $photo['week'] = $row['WEEK'];
    $photo['caption'] = $row['CAPTION'];
    $photo['timestamp'] = $row['TIMESTAMP'];
    $result['photos'][$index] = $photo;
    $index++;
}

//add likes:
$result['likes'] = array();
$ret = $db->query("SELECT * FROM LIKES;");
$index = 0;
while($row = $ret->fetchArray(SQLITE3_ASSOC)) {
    $like = array();
    $like['photo_id'] = $row['PHOTO_ID'];
    $like['user_id'] = $row['USER_ID'];
    $result['likes'][$index] = $like;
    $index++;
}

$result['week_id'] = $CURRENT_WEEK;

echo json_encode($result);

?>