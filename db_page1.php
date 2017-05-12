<?php

session_start();

$_SESSION['class'] = addslashes($_POST['class']);
$_SESSION['name']= addslashes($_POST['name']);
$_SESSION['stu_num'] = addslashes($_POST['stu_num']);
header("Location: db2_page1.php");

//$_SESSION['class']=$class;
//$_SESSION['name']=$name;
//$_SESSION['stu_num']=$stu_num;

?>
