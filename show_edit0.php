<?php

session_start();
$pawd = $_POST['pawd'];
$check = $_POST['check'];
if ($pawd == $check) {
    require 'mysql.php';
    $db = DataBase::initDB();
    $u_name = $_POST['u_name'];
    $acc = $_POST['acc'];
    $email = $_POST['email'];
    $u_power = $_POST['u_power'];
    $u_id = $_SESSION['u_id'];
    if (empty($pawd)) {
        $count = $db->exec("UPDATE `User` SET User_name='$u_name',`User_account`='$acc',`User_email`='$email',`User_power`='$u_power' WHERE User_ID='$u_id'");
    } else {
        $key = "146c07ef2479cedcd54c7c2af5cf3a80"; //金鑰
        $salty = "i3flm234rmsldk543kf2jvl2sdfj"; //亂數
        $password_hash = hash_hmac("sha1", $salty + $pawd, $key);
        $count = $db->exec("UPDATE `User` SET User_name='$u_name',`User_account`='$acc',`User_passwd`='$password_hash',`User_email`='$email',`User_power`='$u_power' WHERE User_ID='$u_id'");
    }
    if ($count != 0) {
        $stmt = $db->query("SELECT * FROM User WHERE User_ID='$u_id'");

        echo '<table align="center" width=50% border="1">';
        foreach ($stmt->fetchAll() as $row) {
            echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">照片</td><td>' . '<img src="./image/' . $row['User_pic'] . '" alt="Smiley face" width="240" height="240">' . '</td></tr>';
            echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">帳號</td><td>' . $row['User_account'] . '</td></tr>';
            echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">姓名</td><td>' . $row['User_name'] . '</td></tr>';
            echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">E-Mail</td><td>' . $row['User_email'] . '</td></tr>';
            if ($row['User_power'] == 1) {
                $power_name = '管理者';
            } else if ($row['User_power'] == 2) {
                $power_name = '使用者';
            }
            echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">權限</td><td>' . $power_name . '</td></tr>';
        }
        echo '</table>';

        echo '</div><div style="right:10px;top:600px;position:fixed;z-index:1;">';
        echo '<a href="db2_page0.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>';
    } else {
        header("Location: db2_page0.php");
    }
} else {
    echo '<script language="javascript">';
    echo 'alert("密碼與確認密碼不相同，請重新輸入")';
    echo '</script>';
    header("refresh:1 ; url=edit0.php");
}
?>




