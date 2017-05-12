<?php
$eid=$_POST['e_id'];
$bt=$_POST['bt'];
require 'mysql.php';
$db = DataBase::initDB();

if($bt[0]=='送修'){
$count = $db->exec("UPDATE `Equipment` SET `Equipment_status`='$bt[0]' WHERE Equipment_ID='$eid'");
}
else if($bt[0]=='歸還'){
$count = $db->exec("UPDATE `Equipment` SET `Equipment_status`='可借用' WHERE Equipment_ID='$eid'");
}

$stmt = $db->query("SELECT * FROM Equipment WHERE Equipment_ID='$eid'");
foreach ($stmt->fetchAll() as $row) {
    $e_name = $row['Equipment_name'];
    $e_type = $row['Equipment_type'];
    $e_date = $row['Equipment_Date'];
    $e_sta = $row['Equipment_status'];
    $e_pic = $row['Equipment_pic'];
}

?>

<html>
    <body>
        <table align="center">
            <form action="show_edit3.php" method="POST">
                <input type="hidden" name="e_id" value="<?php echo $e_id; ?>">
                <tr><td rowspan="12" width="350"><img src="./image/<?php echo $e_pic ?>" alt="Smiley face" width="300" height="300" border="2"></td></tr>
                <tr><td>設備名稱</td><td><input type="text" name="e_name" value="<?php echo $e_name; ?>" readonly></td></tr>
                <tr><td>設備型號</td><td><input type="text" name="e_type" value="<?php echo $e_type; ?>" readonly></td></tr>
                <tr><td>購買日期</td><td><input type="text" name="e_date" value="<?php echo $e_date; ?>" readonly></td></tr>
                <tr><td>設備狀態</td><td><input type="text" name="e_status" value="<?php echo $e_sta; ?>" readonly></td></tr>
                <tr height="50"><td><input type ="button" onclick="javascript:location.href = 'db2_page3.php'" value="確定"></td>
            </form>
        </table>
    </body>
</html>
