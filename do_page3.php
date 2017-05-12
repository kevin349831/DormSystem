<?php

session_start();
$_SESSION['e_id'] = addslashes($_POST['e_id']);
$_SESSION['$e_name'] = addslashes($_POST['e_name']);
$_SESSION['$e_type']= addslashes($_POST['e_type']);
$_SESSION['$e_sta'] = addslashes($_POST['$e_sta']);
header("Location: db2_page3.php");

?>
