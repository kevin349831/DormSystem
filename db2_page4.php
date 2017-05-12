<?php
require 'mysql.php';
$db = DataBase::initDB();
$stmt = $db->query("SELECT Class_name,Department_name,Student_number,Student_name,Phone,Academic_Year,Student_address,Parent_name,Parent_phone 
FROM `Student` A JOIN `Parant` B ON B.Parent_ID = A.ParantParent_ID JOIN `Class` C ON A.ClassClass_ID = C.Class_ID JOIN Deparment D ON D.Department_ID = C.Department_ID
WHERE 1");
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
        echo '<table class=hovertable width=100% border="1"><tr bgcolor=#DBDBDB Height=45 align="center"><td bgcolor=#FFFFFF></td><td>';
        echo "系所" . '</td><td>' . "班級" . '</td><td>' . "學號" . '</td><td>' . "姓名" . '</td><td>' . "電話" . '</td><td>' . "入學年" . '</td><td>' . "地址" . '</td><td>' . "家長姓名" . '</td><td>' . "家長電話" . '</td></tr>';
        foreach ($c as $row) {
            if ($count >= $start && $count < ($start + $per)) {
                if ($count % 2 != 0) {
                    echo '<tr bgcolor=#DBDBDB Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<i class="fa fa-pencil" style="font-size:20px"></i>' . "　" . '<i class="fa fa-trash" style="font-size:20px"></i>' . '</td><td>' . $row['Department_name'] . '</td><td>' . $row['Class_name'] . '</td><td>' . $row['Student_number'] . '</td><td>' . $row['Student_name'] . '</td><td>' . $row['Phone'] . '</td><td>' . $row['Academic_Year'] . '</td><td>' . $row['Student_address'] . '</td><td>' . $row['Parent_name'] . '</td><td>' . $row['Parent_phone'] . '</td>';
                    $br++;
                } else {
                    echo '<tr Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<i class="fa fa-pencil" style="font-size:20px"></i>' . "　" . '<i class="fa fa-trash" style="font-size:20px"></i>' . '</td><td>' . $row['Department_name'] . '</td><td>' . $row['Class_name'] . '</td><td>' . $row['Student_number'] . '</td><td>' . $row['Student_name'] . '</td><td>' . $row['Phone'] . '</td><td>' . $row['Academic_Year'] . '</td><td>' . $row['Student_address'] . '</td><td>' . $row['Parent_name'] . '</td><td>' . $row['Parent_phone'] . '</td>';
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
        } else {
            $s_page = 1;
            $e_page = $pages;
        }
        echo '<span style="font-size:22px;">';
        for ($i = $s_page; $i <= $e_page; $i++) {
            if ($i == $page) {
                echo $i . "  ";
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a>' . " ";
            }
            echo '&nbsp;&nbsp;';
        }
        echo '</span>';

        echo '</div><div style="right:10px;top:600px;position:fixed;z-index:1;">';
        echo '<a href="db2_main4.html"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>';
        ?>
    </body>
</html>
