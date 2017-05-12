<?php
$aid = $_POST['aid'];
$bt = $_POST['bt'];

require 'mysql.php';
$db = DataBase::initDB();
if ($bt[0] == '器材全數歸還') {
    $selectE = $db->query("SELECT * FROM Equipment A JOIN Rental_record B ON B.EquipmentEquipment_ID=A.Equipment_ID JOIN Activity C ON C.Activity_ID=B.ActivityActivity_ID WHERE Activity_ID='$aid'");
    foreach ($selectE->fetchAll() as $row) {
        $eid = $row['Equipment_ID'];
        $count = $db->exec("UPDATE `Equipment` SET `Equipment_status`='可借用' WHERE Equipment_ID='$eid'");
    }
    header("Location: db2_main2.php"); //回到main2
    
}
?>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type='text/javascript' src='http://code.jquery.com/jquery-1.10.2.min.js'></script>
        <script type='text/javascript'>
            $(function () {
                $('#test').click(function () {
                    var option = $('#select1').html();
                    var num = parseInt($('#num').val()) + 1;
                    var select = '<tr><td><input type="text" name="name[]"></td><td><input type="text" name="cost[]"></td></tr>';
                    $('#sss').append(select);
                    $('#num').val(num);
                });
            });
        </script>
    </head>


    <body><?php
if ($bt[0] == '填寫費用')
    echo " 
    <center>
        <input type='button' id='test' value='增加欄位'>
        <input type='hidden' id='num' value='1'>

        <form action='addcost.php' method='POST'>
            <table>
                <input type='hidden' name='aid' value='$aid'>
                <div id='sss'></div>

                <tr><td><input type ='button' onclick='javascript:location.href = 'db2_page2.php' value='取消'></td>
                    <td><input type='reset' value='清除'></td><td><input type='submit' value='送出'></td></tr>

            </table>
        </form>
    </center>"
    ?>
    </body>
</html>

