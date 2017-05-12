<?php
//學生刪除 幹部怎麼辦???  有BUG



session_start();

require 'mysql.php';
$db = DataBase::initDB();

//$user_acc = $_SESSION['username'];     //不知道是幹嘛的
$delete = $_POST['delete'];
$stmt = $db->query("SELECT ParentParent_ID FROM Student Where Student_ID ='$delete'");
foreach ($stmt->fetchAll() as $row) {
    $p_id = $row['ParentParent_ID'];
}
$stmt=$db->query("SELECT COUNT(*) as c FROM Student WHERE ParentParent_ID='$p_id'");
foreach ($stmt->fetchAll() as $row) {
    $count = $row['c'];
}
$resp = $db->exec("DELETE FROM Dorm_record WHERE StudentStudent_ID = '$delete'");
$resp = $db->exec("DELETE FROM `Student` WHERE Student_ID = '$delete' ");
if ($count==1) {
    $resp = $db->exec("DELETE FROM Parent WHERE Parent_ID = '$p_id'");
}



 header("Location: db2_page1.php");
?>
