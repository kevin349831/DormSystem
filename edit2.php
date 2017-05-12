<?php
$aid = $_POST['edit'];

require 'mysql.php';
$db = DataBase::initDB();

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

$selectW = $db->query("SELECT * FROM Worker A JOIN Activity B ON A.ActivityActivity_ID=B.Activity_ID JOIN Student C ON A.StudentStudent_ID=C.Student_ID WHERE Activity_ID='$aid'");
$selectE = $db->query("SELECT * FROM Equipment A JOIN Rental_record B ON B.EquipmentEquipment_ID=A.Equipment_ID JOIN Activity C ON C.Activity_ID=B.ActivityActivity_ID WHERE Activity_ID='$aid'");
$selectC = $db->query("SELECT * FROM Cost_detail A JOIN Activity B ON A.ActivityActivity_ID=B.Activity_ID WHERE ActivityActivity_ID='$aid'");
?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--link那行 可以使用圖示-->
        <table align="center" border="1">
            <form action="show_edit2_1.php" method="POST">
                <input type="hidden" name="aid" value="<?php echo $aid; ?> ">
                <tr height="50"><td>活動名稱：</td><td><?php echo $Activity_name; ?></td></tr>
                <tr height="50"><td>活動說明：</td><td><?php echo $Activity_detail; ?></td></tr>
                <tr height="50"><td>活動主辦人：</td><td><?php echo $Student_name; ?></td></tr>
                <tr height="50"><td>活動地點：</td><td><?php echo $place; ?></td></tr>
                <tr height="50"><td>活動日期：</td><td><?php echo $Activity_Date; ?></td></tr>
                <tr><td>工作人員清單：</td><td>
                        <?php
                        foreach ($selectW->fetchAll() as $row) {
                            echo $row['Student_name'];
                            echo "</br>";
                        }
                        ?>
                    </td></tr>
                <tr><td>借用設備清單：</td><td>
                        <?php
                        foreach ($selectE->fetchAll() as $row) {
                            echo $row['Equipment_name'];
                            echo "</br>";
                        }
                        ?>
                    </td></tr>
                <tr><td>活動花費清單：</td><td>
                        <?php
                        foreach ($selectC->fetchAll() as $row) {
                            echo $row['Cost_name'];
                            echo $row['Cost_price'];
                            echo '</br>';
                        }
                        ?>
                    </td></tr>
                <tr><td colspan="3"><input type="submit" name="bt[]" value="填寫費用"><input type="submit" name="bt[]" value="器材全數歸還">
                        <input type ="button" onclick="javascript:location.href = 'db2_page2.php'" value="取消"></td></tr>
            </form>
        </table>
    </body>
</html>
