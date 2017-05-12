<?php
session_start();
if (empty($_SESSION['u_id'])) {
    $_SESSION['u_id'] = $_POST['edit'];
}

require 'mysql.php';
$db = DataBase::initDB();
$u_id = $_SESSION['u_id'];
$stmt = $db->query("SELECT * FROM User WHERE User_ID='$u_id'");
foreach ($stmt->fetchAll() as $row) {
    $pic = $row['User_pic'];
    $u_name = $row['User_name'];
    $acc = $row['User_account'];
    $email = $row['User_email'];
    $u_power = $row['User_power'];
}
?>

<html>
    <head>
    </head>
    <body bgcolor='#eee'>
        <table align="center">
            <form action="show_edit0.php" method="post">
                <input type="hidden" name="u_id" value="<?php echo $u_id ?>">
                <input type="hidden" name="acc" value="<?php echo $acc ?>">
                <tr><td rowspan="8" width="350"><img src="./image/<?php echo $pic ?>" alt="Smiley face" width="300" height="300" border="2"></td>
                <tr height="50"><td>帳號：</td><td><input type="text" name="u_acc" value="<?php echo $acc; ?>" readonly></td></tr>
                <tr height="50"><td>姓名：</td><td><input type="text" name="u_name" value="<?php echo $u_name; ?>"></td></tr>
                <tr height="50"><td>密碼：</td><td><input type="password" name="pawd" ></td></tr>
                <tr height="50"><td>確認密碼：</td><td><input type="password" name="check"></td></tr>
                <tr height="50"><td>E-Mail：</td><td><input type="text" name="email" value="<?php echo $email; ?>"></td></tr>
                <?php
                if ($u_power == 1) {
                    echo '<tr height="50"><td>權限：</td><td><select name="u_power">
                            <option value="1" SELECTED>管理者</option>
                            <option value="2" >使用者</option>
                        </select></td></tr>';
                } else {
                    echo '<tr height="50"><td>權限：</td><td><select name="u_power">
                            <option value="1" >管理者</option>
                            <option value="2" SELECTED>使用者</option>
                        </select></td></tr>';
                }
                ?>
                <tr height="50"><td><input type ="button" onclick="javascript:location.href = 'db2_page0.php'" value="取消"></input>    </td><td><input type="submit" value="確認"></td></tr>
            </form>
        </table>
    </body>
</html>
