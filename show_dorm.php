<?php
$sid=$_POST['s_id'];

require 'mysql.php';
$db=  DataBase::initDB();

$stmt=$db->query("SELECT * FROM Dorm_record A JOIN Bed C ON A.BedBed_ID = C.Bed_ID JOIN Room D ON C.RoomRoom_ID = D.Room_ID JOIN Building E ON D.BuildingBuilding_ID = E.Building_ID WHERE StudentStudent_ID = '$sid' ORDER BY Dorm_ID DESC ");
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
        echo '<table class=hovertable width=100% border="1"><tr bgcolor=#DBDBDB Height=45 align="center">';
        echo "<td>樓別</td><td>床號</td><td>入住日期</td><td>離宿日期</td></tr>";
        foreach ($c as $row) {
            if ($count >= $start && $count < ($start + $per)) {
                if ($count % 2 != 0) {
                    echo '<tr bgcolor=#DBDBDB Height=45 align="center"><td>' . $row['Building_name'] . '</td><td>' . $row['Bed_name'] . '</td><td>' . $row['Dorm_Start_Date'] . '</td><td>' . $row['Dorm_End_Date'] . '</td></tr>';
                    $br++;
                } else {
                    echo '<tr Height=45 align="center"><td>' . $row['Building_name'] . '</td><td>' . $row['Bed_name'] . '</td><td>' . $row['Dorm_Start_Date'] . '</td><td>' . $row['Dorm_End_Date'] . '</td></tr>';
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
        echo '<a href="edit1.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>';
        ?>
    </form>
</body>
</html>




