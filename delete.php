<?php
session_start();

require 'mysql.php';
$db = DataBase::initDB();

//$user_acc = $_SESSION['username'];
$delete = $_POST['delete'];

$resp = $db->exec("DELETE FROM `User_Detail` WHERE User_Detail_ID = '$delete' ");
 header("Location: db2_page.php");
 
 ?>

