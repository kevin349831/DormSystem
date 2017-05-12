<?php
$name = $_POST['name'];
$cost = $_POST['cost'];
$aid = $_POST['aid'];

require 'mysql.php';
$db = DataBase::initDB();

for ($i = 0; $i < count($name); $i++) {
    $numC = $db->exec("INSERT INTO `Cost_detail`(`Cost_ID`, `Cost_name`, `Cost_price`, `ActivityActivity_ID`) VALUES ('','$name[$i]','$cost[$i]','$aid')");
}

$selectC = $db->query("SELECT * FROM Cost_detail A JOIN Activity B ON A.ActivityActivity_ID=B.Activity_ID WHERE ActivityActivity_ID='$aid'");
?>


<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <center>
        <table border="1">
            <tr><td colspan="2">花費明細</td></tr>
            <tr><td>品項</td><td>金額</td></tr>
            <?php
            foreach ($selectC->fetchAll() as $row) {
                $na = $row['Cost_name'];
                $co = $row['Cost_price'];
                echo '<tr><td>' . $na . '</td><td>' . $co . '</td></tr>';
            }
            ?>
            <tr><td colspan="2"><a href="db2_main2.php">確認</a></td></tr>
        </table>
        
    </center>
    
</body>
</html>
