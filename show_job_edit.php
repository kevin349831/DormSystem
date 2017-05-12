<?php

//接收資料-----------------
$sid = $_POST['sid'];
$job = $_POST['job'];
$stime = $_POST['stime'];
$etime = $_POST['etime'];
//接收資料-----------------

require 'mysql.php';
$db = DataBase::initDB();
$stmt=$db->query("SELECT * FROM Job WHERE Job_name='$job'");
foreach($stmt->fetchAll() as $row){
    $jid=$row['Job_ID'];
}
//echo $stime,$etime,$jid,$sid;

//        $count=$db->exec("INSERT INTO `Job_detail`(`Job_detail_ID`, `Job_Start_Date`, `Job_End_Date`, `StudentStudent_ID`, `JobJob_ID`) VALUES ('','2016-06-03','2016-06-03','58e1a902-4739-8f97-e2e3-574f0f4ff074','1')");
$count=$db->exec("INSERT INTO `Job_detail`(`Job_detail_ID`, `Job_Start_Date`, `Job_End_Date`, `StudentStudent_ID`, `JobJob_ID`) VALUES ('','$stime','$etime','$sid','$jid')");

$stmt = $db->query("SELECT * FROM Student A JOIN Class B ON A.ClassClass_ID = B.Class_ID JOIN Department C ON B.Department_ID = C.Department_ID  WHERE Student_ID='$sid'");
foreach ($stmt->fetchAll() as $row) {
    $name = $row['Student_name'];
    $class = $row['Class_name'];
    $phone = $row['Phone'];
    $department = $row['Department_name'];
    $number = $row['Student_number'];
    $pic=$row['Student_pic'];
}
?>



<html>
    <body bgcolor="#eee">
        <table align="center">
            <tr height="45"><td>系所：</td><td><?php echo $department; ?></td></tr>
            <tr height="45"><td>班級：</td><td><?php echo $class; ?></td></tr>
            <tr height="45"><td>學號：</td><td><?php echo $number; ?></td></tr>
            <tr height="45"><td>姓名：</td><td><?php echo $name; ?></td></tr>
            <tr height="45"><td>電話：</td><td><?php echo $phone; ?></td></tr>
            <tr height="45"><td>職稱：</td><td><?php echo $job; ?></td></tr>
            <tr height="45"><td>任職開始日期：</td><td><?php echo $stime; ?></td></tr>
            <tr height="45"><td>任職結束日期：</td><td><?php echo $etime; ?></td></tr>
            
            <img src="./image/<?php echo $pic ?>" alt="Smiley face" width="300" height="300" style="position:absolute;top:50px;left:15%;" border="2">
        </table>
    </body>
</html>

