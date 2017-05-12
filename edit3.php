<?php
require 'mysql.php';
$db = DataBase::initDB();
$e_id = $_POST['edit'];
$stmt = $db->query("SELECT * FROM Equipment WHERE Equipment_ID='$e_id'");
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
                <tr><td><input type="submit" name="bt[]" value="送修"></td><td><input type="submit" name="bt[]" value="歸還"></td></tr>
                <tr><td><input type ="button" onclick="javascript:location.href = 'db2_page3.php'" value="離開"></td></tr>
            </form>
        </table>
    </body>
</html>

