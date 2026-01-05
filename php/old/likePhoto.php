<?php

include 'general.php';

$user = decode_index(cleanHexInput($_GET['user']), $USER_ENCR_KEY);
if($user < 0)
    return;

$photo = cleanHexInput($_GET['photo']);

//make sure this is not the users own photo
if($db->query("SELECT * FROM PHOTOS WHERE USER_ID = $user AND PHOTO_ID = $photo;")->fetchArray(SQLITE3_ASSOC)) {
    echo "trying to like your own picture, uncool!";
    return;
}

//make sure the photo exists (in current week):
if(!$db->query("SELECT * FROM PHOTOS WHERE PHOTO_ID = $photo AND WEEK = $CURRENT_WEEK;")->fetchArray(SQLITE3_ASSOC)) {
    echo "photo does not exist anymore";
    return;
}

//delete all likes for this user (of pics that were made this week)
$photo_rows = $db->query("SELECT * FROM PHOTOS WHERE WEEK = $CURRENT_WEEK;");
while($photo_row = $photo_rows->fetchArray(SQLITE3_ASSOC) ) {
    $photo_id = $photo_row['PHOTO_ID'];
    $db->exec("DELETE FROM LIKES WHERE USER_ID = $user AND PHOTO_ID = $photo_id;");
}

//like this specific photo
$db->exec("INSERT INTO LIKES (USER_ID, PHOTO_ID) VALUES ($user, $photo);");

/*
//make sure user does not already like photo:
if($db->query("SELECT * FROM LIKES WHERE USER_ID = $user AND PHOTO_ID = $photo;")->fetchArray(SQLITE3_ASSOC)) {
    echo "picture is already liked";
    return;
}

//make sure user has enough likes to distribute this week:
$num_likes = 0;
$photo_rows = $db->query("SELECT * FROM PHOTOS WHERE WEEK = $CURRENT_WEEK;");
while($photo_row = $photo_rows->fetchArray(SQLITE3_ASSOC) ) {
    $pid = $photo_row['PHOTO_ID'];
    if($db->query("SELECT * FROM LIKES WHERE USER_ID = $user AND PHOTO_ID = $pid;")->fetchArray(SQLITE3_ASSOC))
        $num_likes += 1;
}

if($num_likes < 3) {
    $sql ="INSERT INTO LIKES (USER_ID, PHOTO_ID) VALUES ($user, $photo);";
    $db->exec($sql);
}
*/

// echo "Number of {$num_likes} </br>"; 

?>