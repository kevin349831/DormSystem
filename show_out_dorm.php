<?php

session_start();
$bed = $_POST['bed'];
$etime = $_POST['etime'];
$sid = $_SESSION['sid'];
$netime = $_POST['netime'];
$stime = $_POST['stime'];



if ($netime >= $etime) {
    echo '<script language="javascript">';
    echo 'alert("時間錯誤!!")';
    echo '</script>';
    header("refresh:0 ; url=edit_dorm.php");
} else if ($netime <= $stime) {
    echo '<script language="javascript">';
    echo 'alert("時間錯誤!!")';
    echo '</script>';
    header("refresh:0 ; url=edit_dorm.php");
} else {


    require 'mysql.php';
    $db = DataBase::initDB();


    $count = $db->exec("UPDATE `Dorm_record` SET `Dorm_End_Date`='$netime' WHERE `StudentStudent_ID` = '$sid' AND Dorm_End_Date='$etime'");




   
    $stmt = $db->query("SELECT * FROM Dorm_record A JOIN Bed B ON A.BedBed_ID = B.Bed_ID JOIN Room C ON B.RoomRoom_ID = C.Room_ID JOIN Building D ON C.BuildingBuilding_ID = D.Building_ID WHERE StudentStudent_ID = '$sid' ORDER BY Dorm_End_Date DESC LIMIT 1");
    foreach ($stmt->fetchAll() as $row) {
        $build = $row['Building_name'];
        $bed = $row['Bed_name'];
        $stime = $row['Dorm_Start_Date'];
        $etime = $row['Dorm_End_Date'];
    }

    echo '<html>
    <body bgcolor="#eee">
        <table align="center">
            <tr height="50"><td>樓別：</td><td>' . $build . '</td></tr>
            <tr height="50"><td>床號：</td><td>' . $bed . '</td></tr>
            <tr height="50"><td>入住日期：</td><td>' . $stime . '</td></tr>
            <tr height="50"><td>離宿日期：</td><td>' . $netime . '</td></tr>
        </table>
    </div><div style="right:10px;top:600px;position:fixed;z-index:1;">
        <a href="edit1.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>
</body>
</html>';
}

