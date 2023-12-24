<?php
require_once '../CONTROLER/QUESTIONS_CONTROLER.php';

echo json_encode($questionsArray);
$_SESSION['score'] = 0;
?>
