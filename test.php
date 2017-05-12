<?php
$name = addslashes($_POST['name']); //addslashes 跳脫'單引號
$detail = addslashes($_POST['detail']);
$place = addslashes($_POST['place']);
$date = addslashes($_POST['date']);
$host = addslashes($_POST['host']);
echo $host;
?>

