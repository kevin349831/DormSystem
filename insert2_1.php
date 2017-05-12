<?php
$sid = $_POST['sid']; //sid 是工作人員 //addslashes 跳脫'單引號
$aid=$_POST['aid']; //活動ID

require 'mysql.php';
$db = DataBase::initDB();
//新增工作人員進資料庫-----
for ($i = 0; $i < count($sid); $i++) {
    $num = $db->exec("INSERT INTO `Worker`(`Work_ID`, `StudentStudent_ID`, `ActivityActivity_ID`) VALUES ('','$sid[$i]','$aid')");
}
//新增工作人員進資料庫-----

//選設備

$stmt = $db->query("SELECT * FROM Equipment WHERE Equipment_status IN ('可借用')"); //記得判斷年分
?>


<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="insert2_2.php" method="POST">
            <input type="hidden" name="aid" value="<?php echo $aid; ?>">
            <?php
            foreach ($stmt->fetchAll() as $row) {
                echo '<input type="checkbox" name=eid[] value="' . $row['Equipment_ID'] . '">' . $row['Equipment_name'] . $row['Equipment_type'] .$row['Equipment_status']. ' </br> ';
            }
            ?>
            <input type="reset" value="清除">
            <input type="submit" value="送出">
        </form>
    </body>
</html>
