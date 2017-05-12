<?php
session_start();

require 'mysql.php';
$db = DataBase::initDB();

$user_acc = $_SESSION['username'];
$delete = $_POST['delete'];

$resp = $db->exec("DELETE FROM `Equipment` WHERE Equipment_ID = '$delete' ");

$stmt = $db->query("SELECT * FROM `Equipment` WHERE 1");
$count = 0;
$c = $stmt->fetchAll();
$per = 10; //一頁顯示幾筆資料
$pages = ceil(count($c) / $per);




if (!isset($_GET["page"])) {
    $page = 1;
} else {
    $page = intval($_GET["page"]);
    $page = ($page > 0) ? $page : 1;
    $page = ($pages > $page) ? $page : $pages;
}

$start = ($page - 1) * $per;
?>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--link那行 可以使用圖示-->
        <style>
            .hovertable tr:hover{
                background-color:#61E7FF; 
                opacity:1;
            }
        </style>
    </head>
    <body>
        <div style="right:10px;top:10px;position:fixed;z-index:1;">查詢 <?php echo count($c) ?> 筆資料</div></br></br>
        
        <?php
        $br = 0;
        echo '<table class=hovertable width=100% border="1"><tr bgcolor=#DBDBDB Height=45 align="center"><td bgcolor=#FFFFFF>修改</td><td bgcolor=#FFFFFF>刪除</td><td>';
        echo "設備名稱" . '</td><td>' . "設備型號" . '</td><td>' . "購買日期" . '</td><td>' . "設備狀態" . '</td></tr>';
        foreach ($c as $row) {
            if ($count >= $start && $count < ($start + $per)) {
                if ($count % 2 != 0) {
                    echo '<tr bgcolor=#DBDBDB Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<form action="edit3.php" method="post"><input type="image" name="edit" value="'.$row['Equipment_ID'].'" src="https://tierfive.com/uploads/FA-Pencil-150x150.png" alt="Submit" width="20" height="20"></form></td>' . "  " . '<td bgcolor=#FFFFFF width="55"><form action="delete3.php" method="post"><input type="image"  name="delete" value="' . $row['Equipment_ID'] . '" src="https://what.thedailywtf.com/plugins/nodebb-plugin-emoji-static/static/images/tdwtf/fa_trash_o.png" alt="Submit" width="20" height="20"></form>'.'</td><td>' . $row['Equipment_name'] . '</td><td>' . $row['Equipment_type'] . '</td><td>' . $row['Equipment_Date'] . '</td><td>' . $row['Equipment_status'] . '</td>';
                    $br++;
                } else {
                    echo '<tr Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<form action="edit3.php" method="post"><input type="image" name="edit" value="'.$row['Equipment_ID'].'" src="https://tierfive.com/uploads/FA-Pencil-150x150.png" alt="Submit" width="20" height="20"></form></td>' . "  " . '<td bgcolor=#FFFFFF width="55"><form action="delete3.php" method="post"><input type="image"  name="delete" value="' . $row['Equipment_ID'] . '" src="https://what.thedailywtf.com/plugins/nodebb-plugin-emoji-static/static/images/tdwtf/fa_trash_o.png" alt="Submit" width="20" height="20"></form></td><td>' . $row['Equipment_name'] . '</td><td>' . $row['Equipment_type'] . '</td><td>' . $row['Equipment_Date'] . '</td><td>' . $row['Equipment_status'] . '</td>';
                    $br++;
                }
            }
            $count = $count + 1;
        }
        echo "</tr></table>";
        if ($br < $per) {
            for ($i = 0; $i < ($per - $br); $i++) {
                echo "</br></br>";
            }
        }
        echo '<div style="left:820px;top:600px;position:fixed;z-index:1;">';
        for ($i = 1; $i <= $pages; $i++) {
            echo '<a href="?page=' . $i . '">' . $i . '</a>' . " ";
        }

        echo '</div><div style="right:10px;top:600px;position:fixed;z-index:1;">';
        echo '<a href="db2_main3.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>';
        ?>
    </body>
</html>

