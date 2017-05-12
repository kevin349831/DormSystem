<?php
session_start();
unset($_SESSION['sid']);
//unset($_SESSION['stu_num']);
require 'mysql.php';
//echo $_SESSION['stu_num'];
$db = DataBase::initDB();

$stmt = $db->query("SELECT * FROM `Student` A JOIN `Parent` B ON B.Parent_ID = A.ParentParent_ID JOIN `Class` C ON A.ClassClass_ID = C.Class_ID JOIN Department D ON D.Department_ID = C.Department_ID
WHERE `Class_name` LIKE '%" . $_SESSION['class'] . "%' and `Student_name` LIKE '%" . $_SESSION['name'] . "%' and `Student_number` LIKE '%" . $_SESSION['stu_num'] . "%'");
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
        echo "系所" . '</td><td>' . "班級" . '</td><td>' . "床號" . '</td><td>' . "樓別" . '</td><td>' . "學號" . '</td><td>' . "姓名" . '</td><td>' . "電話" . '</td><td>' . "入學年" . '</td><td>' . "地址" . '</td></tr>';
        foreach ($c as $row) {
            $sid = $row['Student_ID'];
            $stmt = $db->query("SELECT * FROM Dorm_record A JOIN Bed B ON A.BedBed_ID = B.Bed_ID JOIN Room C ON B.RoomRoom_ID = C.Room_ID JOIN Building D ON C.BuildingBuilding_ID = D.Building_ID WHERE StudentStudent_ID = '$sid' ORDER BY Dorm_End_Date DESC LIMIT 1");
            foreach ($stmt->fetchAll() as $row2) {
                if ($count >= $start && $count < ($start + $per)) {
                    if ($count % 2 != 0) {
                        echo '<tr bgcolor=#DBDBDB Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<form action="edit1.php" method="post"><input type="image" name="edit" value="' . $row['Student_ID'] . '" src="https://tierfive.com/uploads/FA-Pencil-150x150.png" alt="Submit" width="20" height="20"></form></td>' . "  " . '<td bgcolor=#FFFFFF width="55"><form action="delete1.php" method="post"><input type="image"  name="delete" value="' . $row['Student_ID'] . '" src="https://what.thedailywtf.com/plugins/nodebb-plugin-emoji-static/static/images/tdwtf/fa_trash_o.png" alt="Submit" width="20" height="20"></form>' . '</td><td>' . $row['Department_name'] . '</td><td>' . $row['Class_name'] . '</td><td>' . $row2['Bed_name'] . '</td><td>' . $row2['Building_name'] . '</td><td>' . $row['Student_number'] . '</td><td>' . $row['Student_name'] . '</td><td>' . $row['Phone'] . '</td><td>' . $row['Academic_Year'] . '</td><td>' . $row['Student_address'] . '</td>';
                        $br++;
                    } else {
                        echo '<tr Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<form action="edit1.php" method="post"><input type="image" name="edit" value="' . $row['Student_ID'] . '" src="https://tierfive.com/uploads/FA-Pencil-150x150.png" alt="Submit" width="20" height="20"></form></td>' . "  " . '<td bgcolor=#FFFFFF width="55"><form action="delete1.php" method="post"><input type="image"  name="delete" value="' . $row['Student_ID'] . '" src="https://what.thedailywtf.com/plugins/nodebb-plugin-emoji-static/static/images/tdwtf/fa_trash_o.png" alt="Submit" width="20" height="20"></form></td><td>' . $row['Department_name'] . '</td><td>' . $row['Class_name'] . '</td><td>' . $row2['Bed_name'] . '</td><td>' . $row2['Building_name'] . '</td><td>' . $row['Student_number'] . '</td><td>' . $row['Student_name'] . '</td><td>' . $row['Phone'] . '</td><td>' . $row['Academic_Year'] . '</td><td>' . $row['Student_address'] . '</td>';
                        $br++;
                    }
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
        echo '<div style="text-align:center;">';
        if ($pages > 10) {
            $s_page = $page - 5;
            $e_page = $page + 4;
            if ($s_page <= 0) {
                $s_page = 1;
                $e_page = 10;
            } else if ($e_page > $pages) {
                $s_page = $pages - 9;
                $e_page = $pages;
            }
        }else{
            $s_page=1;
            $e_page=$pages;
        }
        echo '<span style="font-size:22px;">';
        for ($i = $s_page; $i <= $e_page; $i++) {
            if($i==$page){
                echo $i."  ";
            }else{
                echo '<a href="?page=' . $i . '">' . $i . '</a>' . " ";
            }
            echo '&nbsp;&nbsp;';
        }
        echo '</span>';

        echo '</div><div style="right:10px;top:600px;position:fixed;z-index:1;">';
        echo '<a href="db2_main1.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>';
        ?>
    </body>
</html>
