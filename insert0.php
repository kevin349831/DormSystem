<?php

//產生GUID------
require 'Guid.php';
$guid = GGuid::Guid();
//產生GUID------


$pic = $_FILES["fileToUpload"]["name"]; //圖片名稱
$name = addslashes($_POST['name']); //addslashes 跳脫'單引號
$email = addslashes($_POST['email']);
$account = addslashes($_POST['account']);
$passwd = addslashes($_POST['passwd']);
$check = addslashes($_POST['check']);
$power = addslashes($_POST['u_power']);
//以上為接收資料
//此段為判斷信箱正確嗎-----
if (preg_match("/[a-zA-Z0-9\._\+]+@([a-zA-Z0-9\.-]\.)*[a-zA-Z0-9\.-]+/", $email)) {
//    echo "$email"; 正確就上傳圖片
    //此段為上傳圖片--------
    if ($_FILES["fileToUpload"]["error"] > 0) {
        return "Error: " . $_FILES["fileToUpload"]["error"];
    } else {
//    echo $_FILES["fileToUpload"]["name"] . "<br/>";
//    echo $_FILES["fileToUpload"]["type"] . "<br/>";
//    echo $_FILES["fileToUpload"]["size"] . "<br />";
//    echo $_FILES["fileToUpload"]["tmp_name"];
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "./image/" . $_FILES["fileToUpload"]["name"]);
    }
//此段為上傳圖片--------
} else {
    echo '<script language="javascript">';
    echo 'alert("電子信箱為錯誤格式，請重新填寫資料")';
    echo '</script>';
    header("refresh:0 ; url=db2_main0.php");
//    echo "此電子信箱為錯誤格式"; 錯誤
}
//此段為判斷信箱正確嗎-----


require 'mysql.php';
$db = DataBase::initDB();
$c = 0;
$stmt = $db->query("SELECT User_account FROM User");
foreach ($stmt->fetchAll() as $row) {
    if ($account == $row['User_account']) {
        $c = 1;
        break;
    }
}
if ($c == 1) {
    echo '<script language="javascript">';
    echo 'alert("帳號已有人使用")';
    echo '</script>';
    header("refresh:1 ; url=db2_main0.php");
} else if ($passwd != $check) {
    echo '<script language="javascript">';
    echo 'alert("密碼不相同，請重新輸入")';
    echo '</script>';
    header("refresh:1 ; url=db2_main0.php");
} else {

//此段為加密過程------
    $key = "146c07ef2479cedcd54c7c2af5cf3a80"; //金鑰
    $salty = "i3flm234rmsldk543kf2jvl2sdfj"; //亂數
    $password_hash = hash_hmac("sha1", $salty + $passwd, $key); //HMAC加料演算法
//此段為加密過程------

    $num = $db->exec("INSERT INTO `User`(`User_ID`, `User_name`, `User_account`, `User_passwd`, `User_email`, `User_power`, `User_pic`) VALUES ('$guid','$name','$account','$password_hash','$email','$power','$pic')");   //新增帳戶

    $stmt = $db->query("SELECT * FROM `User` WHERE User_ID = '$guid'"); //查詢新增的這筆資料

    echo '<html><body><link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--link那行 可以使用圖示-->';

    foreach ($stmt->fetchAll() as $row) {
        echo '<table align="center" width=50% border="1">';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">照片</td><td>' . '<img src="./image/' . $pic . '" alt="Smiley face" width="120" height="120">' . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">使用者姓名</td><td>' . $row['User_name'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">帳號</td><td>' . $row['User_account'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">密碼</td><td>' . $passwd . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">信箱</td><td>' . $row['User_email'] . '</td></tr>';
        if ($row['User_power'] == 1) {
            $power_name = '管理者';
        } else if ($row['User_power'] == 2) {
            $power_name = '使用者';
        }
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">權限</td><td>' . $power_name . '</td></tr>';
    }

    echo "</tr></table>";

    echo '<div style="right:10px;top:600px;position:fixed;z-index:1;"><a href="./db2_main0.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div></body></html>';
}
?>


