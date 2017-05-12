<?php
//產生GUID------
require 'Guid.php';
$guid = GGuid::Guid();
//產生GUID------
//接值------
$name = addslashes($_POST['name']); //addslashes 跳脫'單引號
$detail = addslashes($_POST['detail']);
$place = addslashes($_POST['place']);
$date = addslashes($_POST['date']);
$host = addslashes($_POST['host']);
//host 就是主辦人 = 學生name
//接值------
$datetime = date("Y", mktime(date('Y')));

require 'mysql.php';
$db = DataBase::initDB();

$stmt = $db->query("SELECT * FROM Job A JOIN Job_detail B ON A.Job_ID=B.JobJob_ID JOIN Student C ON C.Student_ID=B.StudentStudent_ID WHERE job_name='$host'");
foreach ($stmt->fetchAll() as $row) {
    $sid = $row['StudentStudent_ID'];
}



$num = $db->exec("INSERT INTO `Activity`(`Activity_ID`, `Activity_name`, `Activity_detail`, `Place`, `Activity_Date`, `StudentStudent_ID`) VALUES ('$guid','$name','$detail','$place','$date','$sid')");   //新增資料
//選工作人員


$stmt = $db->query("SELECT * FROM Student A JOIN Job_detail B ON A.Student_ID=B.StudentStudent_ID"); //記得判斷年分
?>


<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="insert2_1.php" method="POST">
            <input type="hidden" name="aid" value="<?php echo $guid; ?>">

            <?php
            foreach ($stmt->fetchAll() as $row) {
                echo '<input type="checkbox" name=sid[] value="' . $row['Student_ID'] . '">' . $row['Student_name'] . '</br> ';
            }
            ?>
            <input type="reset" value="清除">
            <input type="submit" value="送出">
        </form>
    </body>
</html>

