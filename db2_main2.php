<?php
$datetime = date("Y", mktime(date('Y'))) - 1911;
session_start();
unset($_SESSION['id'], $_SESSION['name'], $_SESSION['place'], $_SESSION['date']);
require 'mysql.php';
$db = DataBase::initDB();
?>

<html>
    <head>
        <title>mainpage</title>

        <style>

            @import
            url(http://fonts.googleapis.com/css?family=Open+Sans:600);

            body {
                padding: 20px;
                background: whiteSmoke;
                font-family: 'Open Sans';
            }

            #menu {
                text-align: center;
            }

            .nav {
                list-style: none;
                display: inline-block; /* for centering */
                border: 1px solid #b8b8b8;
                font-size: 14px;
                margin: 0; padding: 0;
            }

            .nav li {
                border-left: 1px solid #b8b8b8;
                float: left;
            }
            .nav li:first-child {
                border-left: 0;
            }

            .nav a {
                color: #2f2f2f;
                padding: 0 20px;
                line-height: 32px;
                display: block;
                text-decoration: none;
                background: #fbfbfb;
                background-image: linear-gradient(#fbfbfb, #f5f5f5);
            }

            .nav a:hover {
                background: #fcfcfd;
                background-image: linear-gradient(#fff, #f9f9f9);
            }

            .nav a.active,
            .nav a:active {
                background: #e8e8e8;
                background-image: linear-gradient(#e8e8e8, #f5f5f5);
            }

            #tab_panes {
                max-width: 600px;
                margin: 20px auto;
            }

            .tab_pane {
                display: none;
            }
            .tab_pane.active {
                display: block;
            }

            #tab_panes img {
                max-width: 600px;
                box-shadow: 0 0 5px rgba(0,0,0,0.5);
            }


            .btn{height:40px; border:none; background:#0C6; width:100%; outline:none; font-family: 'Source Sans Pro', sans-serif; font-size:20px; font-weight:bold; color:#eee; border-bottom:solid 3px #093; border-radius:3px; cursor:pointer}
        </style>

        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <!--link那行 可以使用圖示-->

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <nav id="menu">
            <ul class="nav">
                <li><a href="javascript:void(0);" class="active"><i class="fa fa-plus" style="font-size:20px"></i> 新增</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-search" style="font-size:20px"></i> 查詢</a></li>
            </ul>
        </nav>

        <section id="tab_panes">
            <div class="tab_pane active">
                <form action="insert2.php" method="POST">
                    活動名稱：<input type="text" name="name" required class="text" placeholder="輸入名稱"></br></br>
                    活動說明：<input type="text" name="detail" required class="text" placeholder="輸入說明">
                    <p>
                        <label for="myHost">主辦人：</label>
                        <input type="text" id="myJob" name="host" required class="text" placeholder="輸入活動主辦人" list="hostList" />
                        <datalist id="hostList">
                            <label for="suggestion">or pick a host</label>
                            <select id="suggestion" name="altHost">
                                <?php
                                $stmt = $db->query("SELECT * FROM Job A JOIN Job_detail B ON A.Job_ID=B.JobJob_ID JOIN Student C ON C.Student_ID=B.StudentStudent_ID");
                                foreach ($stmt->fetchAll() as $row) {
                                    $jname = $row['Job_name'];
                                    $sname = $row['Student_name'];
                                    $sid = $row['StudentStudent_ID'];
                                    echo '<option value=' . $jname . '>' . $sname . '</option>';
//                                    echo '<option value=' . $sid . '>' . $jname . $sname . '</option>';
                                }
                                ?>
                            </select>
                        </datalist>
                    </p>
                    活動地點：<input type="text" name="place" required class="text" placeholder="輸入地點"></br></br>
                    活動日期：<input type="date" name="date" value="<?php echo $datetime + 1911; ?>-09-01"></br></br>
                    <input type="reset" value="清除">
                    <input type="submit" value="送出">
                </form>
            </div>
        </div>
    </div>
    <div class="tab_pane">
        <form action="do_page2.php" method="POST">
            活動編號：<input type="text" name="id"></br></br>
            活動名稱：<input type="text" name="name"></br></br>
            活動地點：<input type="text" name="place"></br></br>
            活動日期：<input type="text" name="date"></br></br>
            <input type="reset" value="清除">
            <input type="submit" value="送出">
        </form>
    </div>

</section>

<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<script>
    (function () {
        $('.nav a').on('click', function () {
            var $el = $(this);
            var index = $('.nav a').index(this);
            var active = $('.nav').find('a.active');
            if ($('nav a').index(active) !== index) {
                active.removeClass('active');
                $el.addClass('active');
                $('.tab_pane.active')
                        .hide()
                        .removeClass('active');
                $('.tab_pane:eq(' + index + ')')
                        .fadeIn()
                        .addClass('active');
            }
        });
    }());
</script>

</body>

</html>

