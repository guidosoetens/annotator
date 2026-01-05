<?php

include 'general.php';

$user = decode_index(cleanHexInput($_GET['user']), $USER_ENCR_KEY);
if($user < 0)
    fail('invalid user...');

//make sure user has not already uploaded a photo already...
if($db->query("SELECT * FROM PHOTOS WHERE USER_ID = $user AND WEEK = $CURRENT_WEEK;")->fetchArray(SQLITE3_ASSOC))
    fail('user has already uploaded picture!');

$caption = cleanTextInput($_POST['caption']);

if(isset($_FILES['file'])){
    $dir = '../data/pictures/';
    if(!file_exists($dir))
        mkdir($dir);

    $id = rand();
    $filename = "image_" . $id . ".jpg";
    $location = '../data/pictures/' . $filename;
    $res = move_uploaded_file($_FILES['file']['tmp_name'], $location);

    $time = time();
    $sql ="INSERT INTO PHOTOS (PHOTO_ID, USER_ID, WEEK, CAPTION, TIMESTAMP) VALUES ($id, $user, $CURRENT_WEEK, '$caption', $time);";
    $db->exec($sql);

    $db->close();

    $result = array(
        'success' => true,
        'photo_id' => $id
    );

    echo json_encode($result);
}
else
    fail('user did not send file data!');

?>