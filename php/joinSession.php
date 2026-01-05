<?php

include 'general.php';

$session = cleanHexInput($_GET['session']);

if($session < 0)
    fail("Session id is invalid");

//make sure the photo exists (in current week):
if(!$db->query("SELECT * FROM SESSIONS WHERE SESSION_ID = $session;")->fetchArray(SQLITE3_ASSOC))
    fail("Session does not exist");


$id = rand();

$sql ="INSERT INTO USERS (USER_ID, SESSION_ID) VALUES ($id, $session);";
$db->exec($sql);
$db->close();

$result = array(
    'success' => true,
    'user_id' => $id
);

echo json_encode($result);

?>