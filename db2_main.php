<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '這不是你該來的地方';
} else {
    $ne = $_SESSION['username'];
    require 'mysql.php';
    $db = DataBase::initDB();
    $ip_last = "";
    $time = "";
    $user_id = 0;
    $cou = 0;
    $count = $db->query("SELECT COUNT(*) FROM User A JOIN User_Detail B ON A.User_ID = B.UserUser_ID WHERE User_account='$ne'");
    foreach ($count->fetchAll() as $row) {
        $cou = $row['COUNT(*)'];
    }

    if ($cou != 0) {
        $stmt = $db->query("SELECT User_ID,User_IP,User_Login_Date FROM User A JOIN User_Detail B ON A.User_ID = B.UserUser_ID WHERE User_account='$ne' ORDER BY User_Detail_ID DESC limit 1,1");
        foreach ($stmt->fetchAll() as $row) {


            $ip_last = $row['User_IP'];
            $time = $row['User_Login_Date'];
            $user_id = $row['User_ID'];
            break;
        }
    } else {
        $stmt = $db->query("SELECT User_ID FROM User WHERE User_account='$ne'");
        foreach ($stmt->fetchAll() as $row) {
            $user_id = $row['User_ID'];
        }
    }





    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    echo '<html>
        <head>
            <title>TODO supply a title</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <div style="position: absolute; width: 500px; height: 18px; z-index: 1; left: 36%; top: 25px" id="show"></div>

        <style type="text/css"> #show{color:"#ffffff"; font-size:25px; letter-spacing: 2pt}

        </style>

        <script language="javascript">
            function timeshow() {
                dayname = new Array("日", "一", "二", "三", "四", "五", "六");
                d = new Date( );
                var show = "";
                var y = d.getYear() + 1900;
                var m = ((d.getMonth() * 1 + 1) < 10) ? "0" + (d.getMonth() * 1 + 1) : (d.getMonth() * 1 + 1);
                var da = (d.getDate() < 10) ? "0" + d.getDate() : d.getDate();
                var dd = (dayname[d.getDay()] < 10) ? "0" + dayname[d.getDay()] : dayname[d.getDay()];
                var hi = (d.getHours() < 10) ? "0" + d.getHours() : d.getHours();
                var mi = (d.getMinutes() < 10) ? "0" + d.getMinutes() : d.getMinutes();
                var Si = (d.getSeconds() < 10) ? "0" + d.getSeconds() : d.getSeconds();
                show += y + "." + m + "." + da + "(" + dd + ")　" + hi + ":" + mi + ":" + Si;
                document.getElementById("show").innerHTML = show;
                setTimeout("timeshow()", 1000);
            }
        </script>
        
<style>
.button {
    background-color: #DBDBDB; /* Green */
    border: none;
    color: black;
    padding: 5px 6px ;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px ;
}




.button4 {border-radius: 8px ;}

</style>

    </head>
    <body onload="timeshow()">
        <div style="position:fixed; top:25px; left: 10%;"><font size="5">
            </br></br>
            使用者名稱：'. $ne.'</br></br>
            目前使用IP：'. $ip .'</br></br>
            上次登入時間：'. $time.'</br></br>
            上次登入IP：'.$ip_last.'</br></br>
        </font><div>
            <form action="db2_page.php" method="post">

                <input type="submit" class="button" value="更多資訊">
            </form>
            </body>
            </html>';
    
    
    
    }
//$datetime = date("Y-m-d H:i:s", mktime(date('H') + 8, date('i'), date('s')+3, date('m'), date('d'), date('Y')));
////echo $datetime ; // 顯示時間 
//$db->exec("INSERT INTO User_Detail(User_Detail_ID, User_IP, User_Login_Date, UserUser_ID) VALUES(NULL, '$ip', '$datetime', '$user_id' )");
    ?>


    
            



