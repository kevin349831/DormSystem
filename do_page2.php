<?php

session_start();

$_SESSION['id']= addslashes($_POST['id']);
$_SESSION['name']=addslashes($_POST['name']);
$_SESSION['place']=addslashes($_POST['place']);
$_SESSION['date']=addslashes($_POST['date']);
header("Location: db2_page2.php");

?>
