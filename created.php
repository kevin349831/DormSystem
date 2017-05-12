<?php
$ss = $_POST['edit'];
$datetime = date("Y", mktime(date('Y')));  //抓年分
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
//    $building=$row['Building_name'];
//    $bed=$row['Bed_name'];
    $sid = $row['Student_ID'];
    $pic = $row['Student_pic'];
}
?>

<html>
    <head>

    </head>
    <body bgcolor='#eee'>
        <table align="center">
            <form action="show_job_edit.php" method="post">
                <input type="hidden" name="sid" value="<?php echo $sid ?>"> <!--傳送資料 但不顯示在畫面上-->
                <input type="hidden" name="pic" value="<?php echo $pic ?>"> <!--傳送資料 但不顯示在畫面上-->

                <tr><td rowspan="10" width="350"><img src="./image/<?php echo $pic ?>" alt="Smiley face" width="300" height="300" border="2"></td>
                <tr height="50"><td>系所：</td><td><input type="text" name="department" value="<?php echo $department; ?>" readonly></td></tr>
                <tr height="50"><td>班級：</td><td><input type="text" name="class" value="<?php echo $class; ?>" readonly></td></tr>
                <tr height="50"><td>學號：</td><td><input type="text" name="number" value="<?php echo $number; ?>" readonly></td></tr>
                <tr height="50"><td>姓名：</td><td><input type="text" name="name" value="<?php echo $name; ?>" readonly></td></tr>
                <tr height="50"><td>電話：</td><td><input type="text" name="phone" value="<?php echo $phone; ?>" readonly></td></tr>
<!--                <tr height="50"><td>樓別：</td><td><input type="text" name="name" value="<?php echo $building; ?>" readonly></td></tr>
                <tr height="50"><td>床位：</td><td><input type="text" name="phone" value="<?php echo $bed; ?>" readonly></td></tr>-->
<!--                <tr height="50"><td>地址：</td><td><input type="text" name="address" value="<?php echo $address; ?>" readonly></td></tr>
                <tr height="50"><td>家長姓名：</td><td><input type="text" name="p_name" value="<?php echo $p_name; ?>" readonly></td></tr>
                <tr height="50"><td>家長電話：</td><td><input type="text" name="p_phone" value="<?php echo $p_phone; ?>" readonly></td></tr>-->
                <tr height="50"><td><p>
                            <label for="myJob">任職職位：</label> </td><td>
                        <input type="text" id="myJob" name="job" required class="text" placeholder="輸入職稱" list="jobList" />
                        <datalist id="jobList">
                            <label for="suggestion">or pick a job</label> 
                            <select id="suggestion" name="altjob">
                                <?php
                                $stmt = $db->query("SELECT * FROM `Job` WHERE 1");
                                foreach ($stmt->fetchAll() as $row) {
                                    $jobname = $row['Job_name'];
                                    echo '<option value=' . $jobname . '>' . '</option>';
                                }
                                ?>
                            </select>
                        </datalist>
                        </p></td></tr>

                <div id="test" style="left: 55%; top: 110px; position: absolute;">  
<!--                <tr height="50"><td>任職職位：</td><td><input type="text" name="jname" value=""></td></tr>-->
                    <tr height="50"><td>任職起始日期：</td><td><input type="date" name="stime" value="<?php echo $datetime; ?>-11-01"></td></tr>
                    <tr height="50"><td>任職結束日期：</td><td><input type="date" name="etime" value="<?php echo $datetime; ?>-10-31"></td></tr>
                </div>

                <tr height="50"><td><input type ="button" onclick="javascript:location.href = 'creatjob.php'" value="取消"></input>    </td><td><input type="submit" value="確認"></td></tr>

            </form>
        </table>
    </body>

</html>
