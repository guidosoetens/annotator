<?php

include 'general.php';

$slide = intval($_GET['slide']);
$session = cleanHexInput($_GET['session']);

if($session < 0)
    fail("Session id is invalid");

$sql ="UPDATE SESSIONS SET CURRENT_SLIDE = $slide WHERE SESSION_ID = $session";
$db->exec($sql);
$db->close();

$result = array(
    'success' => true
);

echo json_encode($result);

?>