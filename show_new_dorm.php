<?php
session_start();
$sid = $_SESSION['sid'];
$stime = $_POST['stime'];
$etime = $_POST['etime'];
$bed = $_POST['bed'];
require 'mysql.php';
$db = DataBase::initDB();

$stmt = $db->query("SELECT Bed_ID FROM Bed WHERE Bed_name='$bed'");
foreach ($stmt->fetchAll() as $row) {
    $bid = $row['Bed_ID'];
}

$count = $db->exec("INSERT INTO `Dorm_record`(`Dorm_ID`, `Dorm_Start_Date`, `Dorm_End_Date`, `BedBed_ID`, `StudentStudent_ID`) VALUES (null,'$stime','$etime','$bid','$sid')");

$stmt = $db->query("SELECT * FROM Dorm_record A JOIN Bed B ON A.BedBed_ID = B.Bed_ID JOIN Room C ON B.RoomRoom_ID = C.Room_ID JOIN Building D ON C.BuildingBuilding_ID = D.Building_ID WHERE StudentStudent_ID = '$sid' ORDER BY Dorm_End_Date DESC LIMIT 1");
foreach ($stmt->fetchAll() as $row) {
    $build = $row['Building_name'];
    $bed = $row['Bed_name'];
    $stime = $row['Dorm_Start_Date'];
    $etime = $row['Dorm_End_Date'];
}
?>

<html>
    <body>
        <table align="center" valign="center">
            <tr height="50"><td>樓別：</td><td><?php echo $build; ?></td>
            <tr height="50"><td>床號：</td><td><?php echo $bed; ?></td>
            <tr height="50"><td>入住時間：</td><td><?php echo $stime; ?></td>
            <tr height="50"><td>離宿時間：</td><td><?php echo $etime; ?></td>
        </table>
        
        </div><div style="right:10px;top:600px;position:fixed;z-index:1;">
        <a href="edit1.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>
    </body>
</html>
