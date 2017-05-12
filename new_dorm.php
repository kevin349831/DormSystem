<?php
$datetime = date("Y", mktime(date('Y')));

//echo $datetime;
//echo $datetime+1;
?>


<html>
    <body bgcolor="#eee">
        <form action="show_new_dorm.php" method="POST">
           
            <table align="center">

                <tr height="50"><td><p>
                            <label for="mybed">床號：</label> </td><td>
                        <input type="text" id="mybed" name="bed" required class="text" value="" list="bedList" />
                        <datalist id="bedList">
                            <label for="suggestion">or pick a bed</label>
                            <select id="suggestion" name="altbed">
                                <?php
                                require 'mysql.php';
                                $db=DataBase::initDB();
                                $stmt = $db->query("SELECT * FROM `Bed` WHERE 1");
                                $db=null;
                                foreach ($stmt->fetchAll() as $row) {
                                    $name = $row['Bed_name'];
                                    echo '<option value=' . $name . '>' . '</option>';
                                }
                                ?>
                            </select>
                        </datalist>
                        </p></td></tr>
                <tr height="50"><td>入宿日期：</td><td><input type="date" name="stime"  value="<?php echo $datetime ; ?>-09-01"></td></tr>
                <tr height="50"><td>預設離宿日期：</td><td><input type="date" name="etime" value="<?php echo $datetime + 1; ?>-07-01"></td></tr>            
                <tr height="50"><td><input type ="button" onclick="javascript:location.href = 'edit1.php'" value="取消"></input>    </td><td><input type="submit" value="確認"></td></tr>
            </table>
        </form>
    </body>
</html>
