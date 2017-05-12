<?php
session_start();
if (empty($_SESSION['sid'])) {
    $_SESSION['sid'] = $_POST['edit'];
}
$ss = $_SESSION['sid'];



require 'mysql.php';
$db = DataBase::initDB();
$stmt = $db->query("SELECT * FROM `Student` A JOIN `Parent` B ON B.Parent_ID = A.ParentParent_ID JOIN `Class` C ON A.ClassClass_ID = C.Class_ID JOIN Department D ON D.Department_ID = C.Department_ID WHERE Student_ID='$ss'");
foreach ($stmt->fetchAll() as $row) {
    $pic = $row['Student_pic'];
    $number = $row['Student_number'];
    $name = $row['Student_name'];
    $phone = $row['Phone'];
    $address = $row['Student_address'];
    $p_name = $row['Parent_name'];
    $p_phone = $row['Parent_phone'];
    $class = $row['Class_name'];
    $department = $row['Department_name'];
    $sid = $row['Student_ID'];
    $pic = $row['Student_pic'];
}
$stmt = $db->query("SELECT * FROM Dorm_record A JOIN Bed C ON A.BedBed_ID = C.Bed_ID JOIN Room D ON C.RoomRoom_ID = D.Room_ID JOIN Building E ON D.BuildingBuilding_ID = E.Building_ID WHERE StudentStudent_ID = '$ss' ORDER BY Dorm_End_Date DESC LIMIT 1");
foreach ($stmt->fetchAll() as $row) {
    $build = $row['Building_name'];
    $bed = $row['Bed_name'];
}
?>

<html>
    <head>

    </head>
    <body bgcolor='#eee'>
        <table align="center">
            <form action="show_edit1.php" method="post">
<!--                <input type="hidden" name="sid" value="<?php echo $sid ?>"> 傳送資料 但不顯示在畫面上-->
                <input type="hidden" name="pic" value="<?php echo $pic ?>"> <!--傳送資料 但不顯示在畫面上-->
                <tr><td rowspan="12" width="350"><img src="./image/<?php echo $pic ?>" alt="Smiley face" width="300" height="300" border="2"></td>
                <tr height="50"><td>系所：</td><td><input type="text" name="department" value="<?php echo $department; ?>"></td></tr>
                <tr height="50"><td>班級：</td><td><input type="text" name="class" value="<?php echo $class; ?>"></td></tr>
                <tr height="50"><td>樓別：</td><td><input type="text" name="p_name" value="<?php echo $build; ?>" readonly></td></tr>
                <tr height="50"><td>床號：</td><td><input type="text" name="p_phone" value="<?php echo $bed; ?>" readonly></td></tr>
                <tr height="50"><td>學號：</td><td><input type="text" name="number" value="<?php echo $number; ?>"></td></tr>
                <tr height="50"><td>姓名：</td><td><input type="text" name="name" value="<?php echo $name; ?>"></td></tr>
                <tr height="50"><td>電話：</td><td><input type="text" name="phone" value="<?php echo $phone; ?>"></td></tr>
                <tr height="50"><td>地址：</td><td><input type="text" name="address" value="<?php echo $address; ?>"></td></tr>
                <tr height="50"><td>家長姓名：</td><td><input type="text" name="p_name" value="<?php echo $p_name; ?>"></td></tr>
                <tr height="50"><td>家長電話：</td><td><input type="text" name="p_phone" value="<?php echo $p_phone; ?>"></td></tr>



                <tr height="50"><td><input type ="button" onclick="javascript:location.href = 'db2_page1.php'" value="取消"></input>    </td><td><input type="submit" value="確認"></td></tr>

            </form>

            <form action="new_dorm.php" method="post">
                <input type="hidden" name="s_id" value="<?php echo $ss; ?>">
                <input type="submit" value="續住">
            </form>

            <form action="edit_dorm.php" method="post">
                <input type="hidden" name="s_id" value="<?php echo $ss; ?>">
                <input type="submit" value="換房">
            </form>

            <form action="show_dorm.php" method="post">
                <input type="hidden" name="s_id" value="<?php echo $ss; ?>">
                <input type="submit" value="查看住宿紀錄">
            </form>

        </table>
    </body>

</html>
