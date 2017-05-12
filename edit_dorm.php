<?php
session_start();
$sid = $_SESSION['sid'];

require 'mysql.php';
$db = DataBase::initDB();
date_default_timezone_set('Asia/Taipei');
$datetime = date("Y-m-d", mktime(date('m'), date('d'), date('Y')));
$stmt = $db->query("SELECT * FROM Dorm_record A JOIN Bed C ON A.BedBed_ID = C.Bed_ID JOIN Room D ON C.RoomRoom_ID = D.Room_ID JOIN Building E ON D.BuildingBuilding_ID = E.Building_ID WHERE StudentStudent_ID = '$sid' ORDER BY Dorm_End_Date DESC LIMIT 1");
foreach ($stmt->fetchAll() as $row) {
    $build = $row['Building_name'];
    $bed = $row['Bed_name'];
    $room = $row['Room_name'];
    $stime = $row['Dorm_Start_Date'];
    $etime = $row['Dorm_End_Date'];
}
?>


<html>
    <body bgcolor="#eee">
        <form action="show_edit_dorm.php" method="POST">
            <input type="hidden" name="sid" value="<?php echo $sid; ?>">
            <input type="hidden" name="etime" value="<?php echo $etime; ?>">
            <table align="center">

<!--                <tr height="50"><td><p>
                            <label for="myBuilding">樓別：</label> </td><td>
                        <input type="text" id="myBuilding" name="building" required class="text" value="<?php echo $build; ?>" list="BuildingList" />
                        <datalist id="BuildingList">
                            <label for="suggestion">or pick a building</label>
                            <select id="suggestion" name="altBuilding">
                                <?php
                                $stmt = $db->query("SELECT * FROM `Building` WHERE 1");
                                foreach ($stmt->fetchAll() as $row) {
                                    $name = $row['Building_name'];

                                    echo '<option value=' . $name . '>' . '</option>';
                                }
                                ?>
                            </select>
                        </datalist>
                        </p></td></tr>-->

                <tr height="50"><td><p>
                            <label for="mybed">床號：</label> </td><td>
                        <input type="text" id="mybed" name="bed" required class="text" value="<?php echo $bed; ?>" list="bedList" />
                        <datalist id="bedList">
                            <label for="suggestion">or pick a bed</label>
                            <select id="suggestion" name="altbed">
                                <?php
                                $stmt = $db->query("SELECT * FROM `Bed` WHERE 1");
                                foreach ($stmt->fetchAll() as $row) {
                                    $name = $row['Bed_name'];
                                    echo '<option value=' . $name . '>' . '</option>';
                                }
                                ?>
                            </select>
                        </datalist>
                        </p></td></tr>

<!--                <tr height="50"><td>樓別：</td><td><input type="text" name="build" value="<?php echo $build; ?>"></td></tr>-->
<!--                <tr height="50"><td>床號：</td><td><input type="text" name="bed" value="<?php echo $bed; ?>"></td></tr>-->
                <tr height="50"><td>入宿日期：</td><td><input type="date" name="stime" readonly value="<?php echo $stime; ?>"></td></tr>
                <tr height="50"><td>換宿日期：</td><td><input type="date" name="netime" value="<?php echo $datetime; ?>"></td></tr>            
                <tr height="50"><td><input type ="button" onclick="javascript:location.href = 'edit1.php'" value="取消"></input>    </td><td><input type="submit" value="確認"></td></tr>
            </table>
        </form>
    </body>
</html>
