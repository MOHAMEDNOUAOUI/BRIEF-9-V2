<?php
require_once '../CONTROLER/QUEST_CONTROLER.php';

echo json_encode($questionsArray);
$_SESSION['score'] = 0;
?>
