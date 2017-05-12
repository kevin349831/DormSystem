<?php
session_start();

require 'mysql.php';
$db = DataBase::initDB();

$user_acc = $_SESSION['username'];
$delete = $_POST['delete'];

$de = $db->exec("DELETE FROM `Worker` WHERE `ActivityActivity_ID`='$delete'");
$de1 = $db->exec("DELETE FROM `Cost_detail` WHERE `ActivityActivity_ID` = '$delete'");
$de2 = $db->exec("DELETE FROM `Rental_record` WHERE `ActivityActivity_ID`='$delete'");

$resp = $db->exec("DELETE FROM `Activity` WHERE Activity_ID = '$delete' ");

$stmt = $db->query("SELECT * FROM Activity WHERE Activity_ID='$delete'");
$count = 0;
$c = $db->query("SELECT * FROM `Activity` WHERE Activity_ID='$delete'");
$per = 10; //一頁顯示幾筆資料
$pages = ceil(count($c) / $per);


 header("Location: db2_page2.php");
