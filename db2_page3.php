<?php
session_start();

require 'mysql.php';
$db = DataBase::initDB();

$stmt = $db->query("SELECT * FROM `Equipment` WHERE  `Equipment_name` LIKE '%" . $_SESSION['$e_name'] . "%' AND `Equipment_type` LIKE '%" . $_SESSION['$e_type'] . "%' AND `Equipment_status` LIKE '%" . $_SESSION['$e_sta'] . "%'");
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


            .maxl{
                margin:25px ;
            }
            .inline{
                display: inline-block;
            }
            .inline + .inline{
                margin-left:10px;
            }
            .radio{
                color:#999;
                font-size:15px;
                position:relative;
            }
            .radio span{
                position:relative;
                padding-left:20px;
            }
            .radio span:after{
                content:'';
                width:15px;
                height:15px;
                border:3px solid;
                position:absolute;
                left:0;
                top:1px;
                border-radius:100%;
                -ms-border-radius:100%;
                -moz-border-radius:100%;
                -webkit-border-radius:100%;
                box-sizing:border-box;
                -ms-box-sizing:border-box;
                -moz-box-sizing:border-box;
                -webkit-box-sizing:border-box;
            }
            .radio input[type="radio"]{
                cursor: pointer; 
                position:absolute;
                width:100%;
                height:100%;
                z-index: 1;
                opacity: 0;
                filter: alpha(opacity=0);
                -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"
            }
            .radio input[type="radio"]:checked + span{
                color:#0B8;  
            }
            .radio input[type="radio"]:checked + span:before{
                content:'';
                width:5px;
                height:5px;
                position:absolute;
                background:#0B8;
                left:5px;
                top:6px;
                border-radius:100%;
                -ms-border-radius:100%;
                -moz-border-radius:100%;
                -webkit-border-radius:100%;
            }


        </style>
    </head>
    <body>
        <div style="right:10px;top:10px;position:fixed;z-index:1;">查詢 <?php echo count($c) ?> 筆資料</div></br></br>


<!--        <div class="maxl">
            <label class="radio inline"> 
                <input type="radio" name="sex" value="e1" checked>
                <span> 借用 </span> 
            </label>
            <label class="radio inline"> 
                <input type="radio" name="sex" value="e2">
                <span> 歸還 </span> 
            </label>
            <label class="radio inline"> 
                <input type="radio" name="sex" value="e3">
                <span> 送修 </span> 
            </label>
        </div>-->


        <?php
        $br = 0;
        echo '<table class=hovertable width=100% border="1"><tr bgcolor=#DBDBDB Height=45 align="center"><td bgcolor=#FFFFFF>修改</td><td bgcolor=#FFFFFF>刪除</td><td>';
        echo "設備名稱" . '</td><td>' . "設備型號" . '</td><td>' . "購買日期" . '</td><td>' . "設備狀態" . '</td></tr>';
        foreach ($c as $row) {
            if ($count >= $start && $count < ($start + $per)) {
                if ($count % 2 != 0) {
                    echo '<tr bgcolor=#DBDBDB Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<form action="edit3.php" method="post"><input type="image" name="edit" value="' . $row['Equipment_ID'] . '" src="https://tierfive.com/uploads/FA-Pencil-150x150.png" alt="Submit" width="20" height="20"></form></td>' . "  " . '<td bgcolor=#FFFFFF width="55"><form action="delete3.php" method="post"><input type="image"  name="delete" value="' . $row['Equipment_ID'] . '" src="https://what.thedailywtf.com/plugins/nodebb-plugin-emoji-static/static/images/tdwtf/fa_trash_o.png" alt="Submit" width="20" height="20"></form>' . '</td><td>' . $row['Equipment_name'] . '</td><td>' . $row['Equipment_type'] . '</td><td>' . $row['Equipment_Date'] . '</td><td>' . $row['Equipment_status'] . '</td>';
                    $br++;
                } else {
                    echo '<tr Height=45 align="center"><td bgcolor=#FFFFFF width="55">' . '<form action="edit3.php" method="post"><input type="image" name="edit" value="' . $row['Equipment_ID'] . '" src="https://tierfive.com/uploads/FA-Pencil-150x150.png" alt="Submit" width="20" height="20"></form></td>' . "  " . '<td bgcolor=#FFFFFF width="55"><form action="delete3.php" method="post"><input type="image"  name="delete" value="' . $row['Equipment_ID'] . '" src="https://what.thedailywtf.com/plugins/nodebb-plugin-emoji-static/static/images/tdwtf/fa_trash_o.png" alt="Submit" width="20" height="20"></form></td><td>' . $row['Equipment_name'] . '</td><td>' . $row['Equipment_type'] . '</td><td>' . $row['Equipment_Date'] . '</td><td>' . $row['Equipment_status'] . '</td>';
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
        echo '<a href="db2_main3.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>';
        ?>
    </body>
</html>
