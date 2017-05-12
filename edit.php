<?php
session_start();

$edit = $_POST['edit'];

require 'mysql.php';
$db = DataBase::initDB();

$user_acc = $_SESSION['username'];

$stmt = $db->query("SELECT * FROM `User` A JOIN `User_Detail` B ON A.User_ID = B.UserUser_ID 
WHERE A.User_Detail_ID='$edit'
ORDER BY `User_Login_Date` DESC
");
$count = 0;
$c = $stmt->fetchAll();
?>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--link那行 可以使用圖示-->

    </head>
    <body>
        <div style="right:10px;top:10px;position:fixed;z-index:1;">查詢 <?php echo count($c) ?> 筆資料</div></br></br>

        <?php
        $br = 0;
        echo '<table width=100% border="1"><tr bgcolor=#DBDBDB Height=45 align="center"><td bgcolor=#FFFFFF>修改</td><td bgcolor=#FFFFFF>刪除</td><td>';
        echo "帳號" . '</td><td>' . "姓名" . '</td><td>' . "登入時間" . '</td><td>' . "IP" . '</td>';
        foreach ($c as $row) {
            if ($count >= $start) {
                if ($count % 2 != 0) {
                    echo '<tr bgcolor=#DBDBDB Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<form action="edit.php" method="post"><input type="image" name="edit" value="' . $row['User_Detail_ID'] . '" src="https://tierfive.com/uploads/FA-Pencil-150x150.png" alt="Submit" width="20" height="20"></form></td>' . "  " . '<td bgcolor=#FFFFFF width="55"><form action="delete.php" method="post"><input type="image"  name="delete" value="' . $row['User_Detail_ID'] . '" src="https://what.thedailywtf.com/plugins/nodebb-plugin-emoji-static/static/images/tdwtf/fa_trash_o.png" alt="Submit" width="20" height="20"></form>' . '</td><td>' . $row['User_account'] . '</td><td>' . $row['User_name'] . '</td><td>' . $row['User_Login_Date'] . '</td><td>' . $row['User_IP'] . '</td>';
                    $br++;
                } else {
                    echo '<tr Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<form action="edit.php" method="post"><input type="image" name="edit" value="' . $row['User_Detail_ID'] . '" src="https://tierfive.com/uploads/FA-Pencil-150x150.png" alt="Submit" width="20" height="20"></form></td>' . "  " . '<td bgcolor=#FFFFFF width="55"><form action="delete.php" method="post"><input type="image" name="delete" value="' . $row['User_Detail_ID'] . '" src="https://what.thedailywtf.com/plugins/nodebb-plugin-emoji-static/static/images/tdwtf/fa_trash_o.png" alt="Submit" width="20" height="20"></form>' . '</td><td>' . $row['User_account'] . '</td><td>' . $row['User_name'] . '</td><td>' . $row['User_Login_Date'] . '</td><td>' . $row['User_IP'] . '</td>';
                    $br++;
                }
            }
            $count = $count + 1;
        }
        echo "</tr></table>";
        echo '<div style="left:820px;top:600px;position:fixed;z-index:1;">';

        echo '</div><div style="right:10px;top:600px;position:fixed;z-index:1;">';
        echo '<a href="db2_main.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>';
        ?>
    </form>
</body>
</html>
