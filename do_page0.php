<?php

session_start();

$_SESSION['u_name'] = addslashes($_POST['u_name']);
$_SESSION['email']= addslashes($_POST['email']);
$_SESSION['acc'] = addslashes($_POST['acc']);
header("Location: db2_page0.php");



?>
