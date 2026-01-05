<?php

include 'general.php';

$password = $_GET['password'];

if($password != "xxxxx")
    fail("password incorrect" . strval($password));


$id = rand();

$sql ="INSERT INTO SESSIONS (SESSION_ID, CURRENT_SLIDE) VALUES ($id, -1);";
$db->exec($sql);
$db->close();

$result = array(
    'success' => true,
    'session_id' => $id
);

echo json_encode($result);

?>