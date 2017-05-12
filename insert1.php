<?php

//產生GUID------
require 'Guid.php';
$guid = GGuid::Guid();
//產生GUID------

$datetime = date("Y", mktime(date('Y'))) - 1911;  //抓年分


$name = addslashes($_POST['name']); //addslashes 跳脫'單引號
$class = addslashes($_POST['class']);
$stu_num = addslashes($_POST['stu_num']);
$bed = addslashes($_POST['bed']);
$cell = addslashes($_POST['cell']);
$add = addslashes($_POST['add']);
$year = addslashes($_POST['year']);
$p_name = addslashes($_POST['p_name']);
$p_cell = addslashes($_POST['p_cell']);
$p_idcard = addslashes($_POST['p_idcard']);
$dorm_s = addslashes($_POST['dorm_s']);
//以上接值

require 'mysql.php';
$db = DataBase::initDB();

$output = explode("-", $dorm_s);
if ($output[1] <= 07) {
    $dorm_e = $datetime + 1911;
} else {
    $dorm_e = $datetime + 1911 + 1;
}
//判斷是否有住人-----------
$uuu = 0;
$stmtt = $db->query("SELECT * FROM `Bed` WHERE `Bed_ID` NOT IN(SELECT `BedBed_ID` FROM `Dorm_record` WHERE `Dorm_End_Date`='$dorm_e-07-01')");    //有沒有重複家長
foreach ($stmtt->fetchAll() as $row) {
    $yyy = $row['Bed_name'];
    if ($yyy == $bed) {
        $uuu = 1;
    }
}
//判斷是否有住人-----------
//有住uuu=0;
if ($uuu == 1) {
    //此段為上傳圖片--------
    if ($_FILES["fileToUpload"]["error"] > 0) {
        return "Error: " . $_FILES["fileToUpload"]["error"];
    } else {
//    echo $_FILES["fileToUpload"]["name"] . "<br/>";
//    echo $_FILES["fileToUpload"]["type"] . "<br/>";
//    echo $_FILES["fileToUpload"]["size"] . "<br />";
//    echo $_FILES["fileToUpload"]["tmp_name"];
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "./image/" . $_FILES["fileToUpload"]["name"]);
    }
//此段為上傳圖片--------

    $pic = $_FILES["fileToUpload"]["name"]; //圖片名稱

    $stmt = $db->query("SELECT * FROM Parent WHERE Parent_idcard='$p_idcard'");    //有沒有重複家長
    foreach ($stmt->fetchAll() as $row) {
        $p_id = $row['Parent_ID'];
        $num = 1;
    }


    if (empty($p_id)) {
        $num = $db->exec("INSERT INTO Parent(Parent_ID,Parent_name,Parent_phone,Parent_idcard) VALUES('$guid','$p_name','$p_cell','$p_idcard')");   //新增監護人資料
        $p_id = $guid;
    }





    if ($num != 0) {                //如果新增成功
        $stmt = $db->query("SELECT * FROM Parent WHERE Parent_ID = '$p_id'");              //查詢監護人ID
        foreach ($stmt->fetchAll() as $row) {
            $p_id = $row['Parent_ID'];
        }
        $stmt = $db->query("SELECT * FROM Class WHERE Class_name='$class'");
        foreach ($stmt->fetchAll() as $row) {
            $c_id = $row['Class_ID'];
        }
        $num = 0;
        $output = explode("-", $dorm_s);

//    $datemon = date("m", mktime(date('m')));
        if ($output[1] <= 07) {
            $dorm_e = $datetime + 1911;
        } else {
            $dorm_e = $datetime + 1911 + 1;
        }

        $num = $db->exec("INSERT INTO Student(Student_ID,Student_number,Student_name,Phone,Academic_Year,Student_address,ClassClass_ID,ParentParent_ID,Student_pic) VALUES('$guid','$stu_num','$name','$cell','$year','$add','$c_id','$p_id','$pic')");
        $stmt = $db->query("SELECT * FROM Bed WHERE Bed_name='$bed'");
        foreach ($stmt->fetchAll() as $row) {
            $b_id = $row['Bed_ID'];
        }
        $num = $db->exec("INSERT INTO `Dorm_record`(`Dorm_ID`, `Dorm_Start_Date`, `Dorm_End_Date`, `BedBed_ID`, `StudentStudent_ID`) VALUES (null,'$dorm_s','$dorm_e-07-01','$b_id','$guid')");
    }

    $stmt = $db->query("SELECT * FROM Student A JOIN Parent B ON A.ParentParent_ID = B.Parent_ID JOIN Class C ON A.ClassClass_ID = C.Class_ID JOIN Department D ON C.Department_ID = D.Department_ID JOIN Dorm_record H ON A.Student_ID=H.StudentStudent_ID JOIN Bed E ON H.BedBed_ID = E.Bed_ID JOIN Room F ON E.RoomRoom_ID = F.Room_ID JOIN Building G ON F.BuildingBuilding_ID = G.Building_ID WHERE Student_ID = '$guid'");
    echo '<html><body><link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--link那行 可以使用圖示-->';


    foreach ($stmt->fetchAll() as $row) {
        echo '<table align="center" width=50% border="1">';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">照片</td><td>' . '<img src="./image/' . $row['Student_pic'] . '" alt="Smiley face" width="240" height="240">' . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">系所</td><td>' . $row['Department_name'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">班級</td><td>' . $row['Class_name'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">姓名</td><td>' . $row['Student_name'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">學號</td><td>' . $row['Student_number'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">系所</td><td>' . $row['Building_name'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">床號</td><td>' . $row['Bed_name'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">手機</td><td>' . $row['Phone'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">地址</td><td>' . $row['Student_address'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">入學年</td><td>' . $row['Academic_Year'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">家長姓名</td><td>' . $row['Parent_name'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">家長電話</td><td>' . $row['Parent_phone'] . '</td></tr>';
        echo '<tr Height=45 align="center"><td bgcolor="#DBDBDB">家長身分證</td><td>' . $row['Parent_idcard'] . '</td></tr>';
    }



    echo '<div style="right:10px;top:600px;position:fixed;z-index:1;"><a href="db2_main1.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div></body></html>';
} else {

    echo '<script language="javascript">';
    echo 'alert("房間已有住宿生")';
    echo '</script>';
    header("refresh:0 ; url=db2_main1.php");
}
?>
