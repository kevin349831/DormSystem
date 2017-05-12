
<?php
session_start();
$u_acc = $_SESSION['username'];

require 'mysql.php';
$db = DataBase::initDB();

if (!empty($_POST['u_id'])) {
    $u_id = $_POST['u_id'];
    $pawd = $_POST['pawd'];
    $check = $_POST['check'];
    $name = $_POST['u_name'];
    $email = $_POST['email'];
    if (empty($pawd)) {
        $count = $db->exec("UPDATE `User` SET `User_name`='$name',`User_email`='$email' WHERE User_ID='$u_id'");
    } else if ($check == $pawd) {
        $key = "146c07ef2479cedcd54c7c2af5cf3a80"; //金鑰
        $salty = "i3flm234rmsldk543kf2jvl2sdfj"; //亂數
        $password_hash = hash_hmac("sha1", $salty + $pawd, $key);
        $count = $db->exec("UPDATE `User` SET `User_name`='$name',`User_passwd`='$password_hash',`User_email`='$email' WHERE User_ID='$u_id'");

    } else {
    
        echo 'unset';
        echo '<script language="javascript">';
        echo 'alert("密碼與確認密碼不相同，請重新輸入")';
        echo '</script>';
        header("refresh:1 ; url=Jpage.php");
    }

}




$stmt = $db->query("SELECT * FROM User WHERE User_account='$u_acc'");
foreach ($stmt->fetchAll() as $row) {
    $pic = $row['User_pic'];
    $u_name = $row['User_name'];
    $acc = $row['User_account'];
    $email = $row['User_email'];
    $u_power = $row['User_power'];
    $u_id = $row['User_ID'];
}
?>

<html>
    <head>
        <title>使用者資訊</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <SCRIPT language=JavaScript>
            self.moveTo(400, 250)  //左右定位(絕對位置的移動)
            self.resizeTo(900, 600) //寬高尺寸(變更指定大小)
        </SCRIPT>

    </head>
    <body bgcolor='#eee'>
    <center>
        <table BORDER=0 CELLSPACING=5 CELLPADDING=5>
            <tr ALIGN=Center>
                <td rowspan="7" width="350"><img src="./image/<?php echo $pic ?>" alt="Smiley face" width="300" height="300" border="2"></td>
                <td colspan="3">
                    <font Color="navy" size="5">使用者資訊</font><br>
                    <form action="Jpage.php" method="post">
                        <input type="hidden" name="u_id" value="<?php echo $u_id ?>">
                        <input type="hidden" name="acc" value="<?php echo $acc ?>">
                        <tr height="50"><td>帳號：</td><td><input type="text" name="u_acc" value="<?php echo $acc; ?>" readonly></td></tr>
                        <tr height="50"><td>姓名：</td><td><input type="text" name="u_name" value="<?php echo $u_name; ?>"></td></tr>
                        <tr height="50"><td>密碼：</td><td><input type="password" name="pawd" ></td></tr>
                        <tr height="50"><td>確認密碼：</td><td><input type="password" name="check"></td></tr>
                        <tr height="50"><td>E-Mail：</td><td><input type="text" name="email" value="<?php echo $email; ?>"></td></tr>
                        <tr height="50"><td><input type ="button" value="取消" onClick="window.close()" class="button" onfocus="this.blur()"></input>    </td><td><input type="submit" value="確認"></td></tr>
                    </form>



            </tr>
        </table>
    </center>





</body>

</html>

