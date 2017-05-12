<?php

session_start();
if ($_POST['cho'] == 1) {
    $_SESSION['class'] = addslashes($_POST['class']);
    $_SESSION['name'] = addslashes($_POST['name']);
    $_SESSION['stu_num'] = addslashes($_POST['stu_num']);
    header("Location: creatjob.php");
} else {
    $_SESSION['id'] = addslashes($_POST['id']);
    $_SESSION['name'] = addslashes($_POST['name']);
    $_SESSION['place'] = addslashes($_POST['place']);
    $_SESSION['date'] = addslashes($_POST['date']);
    header("Location: selectjob.php");
}
?>

