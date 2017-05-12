<?php
//產生GUID------
require 'Guid.php';
$guid = GGuid::Guid();
//產生GUID------
//
//此段為上傳圖片--------
if ($_FILES["fileToUpload"]["error"] > 0) {
    return "Error: " . $_FILES["fileToUpload"]["error"];
} else {
//    echo $_FILES["fileToUpload"]["name"] . "<br/>";
//    echo $_FILES["fileToUpload"]["type"] . "<br/>";
//    echo $_FILES["fileToUpload"]["size"] . "<br/>";
//    echo $_FILES["fileToUpload"]["tmp_name"];
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "./image/" . $_FILES["fileToUpload"]["name"]);
}
//此段為上傳圖片--------

$pic = $_FILES["fileToUpload"]["name"]; //圖片名稱

$e_name = addslashes($_POST['e_name']);//addslashes 跳脫'單引號
$e_type = addslashes($_POST['e_type']);
//$e_sta = $_POST['e_sta'];
$e_date = addslashes($_POST['e_date']);

$e_sta='可借用';
require 'mysql.php';
$db = DataBase::initDB();

$num = $db->exec("INSERT INTO `Equipment`(`Equipment_ID`, `Equipment_name`, `Equipment_type`, `Equipment_Date`, `Equipment_status`,Equipment_pic) VALUES ('$guid','$e_name','$e_type','$e_date','$e_sta','$pic')");

if ($num != 0) {
    $stmt = $db->query("SELECT * FROM `Equipment` WHERE Equipment_ID = '$guid'");
    echo '<html><body><link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--link那行 可以使用圖示-->';

    foreach ($stmt->fetchAll() as $row) {

        echo '<table align="center" width=50% border="1">';
          echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">照片</td><td>' . '<img src="./image/' . $row['Equipment_pic'] . '" alt="Smiley face" width="240" height="240">' . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">設備名稱</td><td>' . $row['Equipment_name'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">設備型號</td><td>' . $row['Equipment_type'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">購買日期</td><td>' . $row['Equipment_Date'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">設備狀態</td><td>' . $row['Equipment_status'] . '</td></tr>';
    }
    echo '</table>';

    echo '<div style="right:10px;top:600px;position:fixed;z-index:1;"><a href="db2_main3.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div></body></html>';
}
?>

