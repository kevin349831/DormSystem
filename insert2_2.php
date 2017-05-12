<?php
//SELECT * FROM Student A JOIN Job_detail B ON A.Student_ID=B.StudentStudent_ID JOIN Job C ON C.Job_ID=B.JobJob_ID JOIN Worker D ON A.Student_ID=D.StudentStudent_ID JOIN Activity E ON D.ActivityActivity_ID=E.Activity_ID
//上面是查詢此次整個活動


$eid = $_POST['eid']; //設備ID//addslashes 跳脫'單引號
$aid = $_POST['aid']; //活動ID

require 'mysql.php';
$db = DataBase::initDB();

//更改設備狀態->借出------
$selectA = $db->query("SELECT * FROM Activity A JOIN Student B ON A.StudentStudent_ID=B.Student_ID WHERE Activity_ID='" . $aid . "'");
foreach ($selectA->fetchAll() as $row) {
    $Activity_ID = $row['Activity_ID'];
    $Activity_name = $row['Activity_name'];
    $Activity_detail = $row['Activity_detail'];
    $place = $row['Place'];
    $Activity_Date = $row['Activity_Date'];
    $StudentStudent_ID = $row['StudentStudent_ID'];
}

$selectS = $db->query("SELECT * FROM Student Where Student_ID = '" . $StudentStudent_ID . "'");
foreach ($selectS->fetchAll() as $row) {
    $Student_name = $row['Student_name'];
}

//更改設備狀態->借出------
for ($i = 0; $i < count($eid); $i++) {
    $count = $db->exec("UPDATE `Equipment` SET `Equipment_status`='借出' WHERE `Equipment_ID`='$eid[$i]'");
    $add = $db->exec("INSERT INTO `Rental_record`(`Rental_ID`, `Rental_Date`, `Rental_return_Date`, `StudentStudent_ID`, `ActivityActivity_ID`, `EquipmentEquipment_ID`) VALUES ('','$Activity_Date','','$StudentStudent_ID','$aid','$eid[$i]')");
}


$selectW = $db->query("SELECT * FROM Worker A JOIN Activity B ON A.ActivityActivity_ID=B.Activity_ID JOIN Student C ON A.StudentStudent_ID=C.Student_ID WHERE Activity_ID='$aid'");

$selectE = $db->query("SELECT * FROM Equipment A JOIN Rental_record B ON A.Equipment_ID = B.EquipmentEquipment_ID WHERE B.ActivityActivity_ID='$aid'");
?>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <table align="center" border="1">
            <tr height="50"><td>活動名稱：</td><td><?php echo $Activity_name; ?></td></tr>
            <tr height="50"><td>活動說明：</td><td><?php echo $Activity_detail; ?></td></tr>
            <tr height="50"><td>活動主辦人：</td><td><?php echo $Student_name; ?></td></tr>
            <tr height="50"><td>活動地點：</td><td><?php echo $place; ?></td></tr>
            <tr height="50"><td>活動日期：</td><td><?php echo $Activity_Date; ?></td></tr>
            <tr><td>工作人員清單：</td><td>
                    <?php
                    $ca = 0;
                    foreach ($selectW->fetchAll() as $row) { //ca = 5 表示五個人就換行
                        echo $row['Student_name'];
                        echo '</br>';
                    }
                    ?>
                </td></tr>
            <tr><td>借用設備清單：</td><td><?php
                    foreach ($selectE->fetchAll() as $row) {
                        echo $row['Equipment_name'];
                        echo '</br>';
                    }
                    ?></td></tr>


            <div style="right:10px;top:600px;position:fixed;z-index:1;"><a href="db2_main2.php"><i class="fa fa-reply" style="font-size:20px"></i> 確認</a></div>
        </table>
    </body>
</html>
