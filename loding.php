<?php
require 'mysql.php';
$db = DataBase::initDB();
session_start();
//$username = $_POST['user'];
$username = addslashes($_POST['user']); //跳脫
$passwd = $_POST['passwd'];

//此段為加密過程------
$key = "146c07ef2479cedcd54c7c2af5cf3a80"; //金鑰
$salty = "i3flm234rmsldk543kf2jvl2sdfj"; //亂數
$password_hash = hash_hmac("sha1", $salty + $passwd, $key); //HMAC加料演算法
//此段為加密過程------

$stmt = $db->query("SELECT * FROM User WHERE User_account='$username'");
$c = 0;
foreach ($stmt->fetchAll() as $row) {
    if ($password_hash == $row['User_passwd']) {
        $c = 1;
        $_SESSION['username'] = $username;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $datetime = date("Y-m-d H:i:s", mktime(date('H') + 8, date('i'), date('s') + 3, date('m'), date('d'), date('Y')));
        $user_id=$row['User_ID'];
        //echo $datetime ; // 顯示時間 
        $db->exec("INSERT INTO User_Detail(User_Detail_ID, User_IP, User_Login_Date, UserUser_ID) VALUES(NULL, '$ip', '$datetime', '$user_id' )");
        switch ($row['User_power']) {
            case '1':
                header("Location: db2_load.php");
                break;
            case '2':
                header("Location: ./stu/db2_load.php");
                break;
        }
    }
}
if ($c == 0) {
    echo '<script language="javascript">';
    echo 'alert("帳號或密碼錯誤，請重新輸入")';
    echo '</script>';
    header("refresh:0 ; url=index.html");
}
?>

