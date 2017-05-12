<?php
require 'mysql.php';
$db = DataBase::initDB();
session_start();
//$pic = $_POST['Student_pic'];
//$number = $_POST['Student_number'];
//$name = $_POST['Student_name'];
//$phone = $_POST['Phone'];
//$address = $_POST['Student_address'];
//$p_name = $_POST['Parent_name'];
//$p_phone = $_POST['Parent_phone'];
//$class = $_POST['Class_name'];
//$department = $_POST['Department_name'];

$sid = $_SESSION['sid'];
$pic = $_POST['pic'];

$department = $_POST['department'];
$class = $_POST['class'];
$number = $_POST['number'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$p_name = $_POST['p_name'];
$p_phone = $_POST['p_phone'];


$department = $_POST['department'];
$class = $_POST['class'];

//$count = $db->exec("
//UPDATE  `Student` A JOIN `Parant` B ON B.Parent_ID = A.ParantParent_ID JOIN `Class` C ON A.ClassClass_ID = C.Class_ID JOIN Deparment D ON D.Department_ID = C.Department_ID 
//SET `Student_number`='5252',`Student_name`='" . $name . "',`Phone`='" . $phone . "',`Student_address`='" . $address . ",`Parent_name`='." . $p_name . ",`Paren_phone`='" . $p_phone . "'
//WHERE Student_ID='" . $sid . "'");
//
$count = $db->exec("UPDATE  `Student` A JOIN `Parent` B ON B.Parent_ID = A.ParentParent_ID JOIN `Class` C ON A.ClassClass_ID = C.Class_ID JOIN Department D ON D.Department_ID = C.Department_ID 
SET `Student_name`='$name',`Phone`='$phone',`Student_address`='$address',`Parent_name`='$p_name',`Parent_phone`='$p_phone'
WHERE Student_ID='$sid'");
$stmt=$db->query("SELECT * FROM  `Student` A JOIN `Parent` B ON B.Parent_ID = A.ParentParent_ID JOIN `Class` C ON A.ClassClass_ID = C.Class_ID JOIN Department D ON D.Department_ID = C.Department_ID WHERE Student_ID='$sid'");
foreach($stmt -> fetchAll() as $row){
    echo '<html><head></head><body bgcolor = "#eee">';
    echo '<table align="center">';
    echo '<tr height="50"><td>系所：</td><td>'.$row['Department_name'].'</td></tr>';
    echo '<tr height="50"><td>班級：</td><td>'.$row['Class_name'].'</td></tr>';
    echo '<tr height="50"><td>學號：</td><td>'.$row['Student_number'].'</td></tr>';
    echo '<tr height="50"><td>姓名：</td><td>'.$row['Student_name'].'</td></tr>';
    echo '<tr height="50"><td>電話：</td><td>'.$row['Phone'].'</td></tr>';
    echo '<tr height="50"><td>地址：</td><td>'.$row['Student_address'].'</td></tr>';
    echo '<tr height="50"><td>家長姓名：</td><td>'.$row['Parent_name'].'</td></tr>';
    echo '<tr height="50"><td>家長電話：</td><td>'.$row['Parent_phone'].'</td></tr>';
    echo '<img src="./image/'.$row['Student_pic'].'" alt="Smiley face" width="300" height="300" style="position:absolute;top:50px;left:15%;" border="2">';
    
    echo '</table>
        </div><div style="right:10px;top:600px;position:fixed;z-index:1;">
        <a href="db2_main1.php"><i class="fa fa-reply" style="font-size:20px"></i> 返回</a></div>
</body>

</html>';
}


?>
