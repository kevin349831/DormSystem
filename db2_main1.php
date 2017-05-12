<?php
session_start();
$datetime = date("Y", mktime(date('Y'))) - 1911;
unset($_SESSION['class']);

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
                <li><a href="javascript:void(0);" class="active"><i class="fa fa-user-plus" style="font-size:20px"></i> 新增</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-search" style="font-size:20px"></i> 查詢</a></li>
            </ul>
        </nav>

        <section id="tab_panes">
            <div class="tab_pane active">
                <form action="insert1.php" method="POST" enctype="multipart/form-data">
                    <img id="blah" src="#" alt="your image" /></br></br>     
                    照片：<input type="file" name="fileToUpload" id="fileToUpload" required class="text"></br></br>
                    <p>
                        <label for="myClass">班級：</label>
                        <input type="text" id="myJob" name="class" required class="text" placeholder="輸入班級" list="jobList" />
                        <datalist id="jobList">
                            <label for="suggestion">or pick a class</label>
                            <select id="suggestion" name="altClass">
                                <?php
                                $stmt = $db->query("SELECT * FROM `Class` WHERE 1");
                                foreach ($stmt->fetchAll() as $row) {
                                    $name = $row['Class_name'];
                                    $Did = $row['Department_ID'];
                                    echo '<option value=' . $name . '>' . '</option>';
                                }
                                ?>
                            </select>
                        </datalist>
                    </p>
                    姓名：<input type="text" name="name" required class="text" placeholder="輸入姓名"></br></br>
                    學號：<input type="text" name="stu_num" required class="text" placeholder="輸入學號">
                    <p>
                        <label for="myBad">床號：</label>
                        <input type="text" id="myBad" name="bed" required class="text" placeholder="輸入床號" list="badList" />
                        <datalist id="badList">
                            <label for="suggestion">or pick a bad</label>
                            <select id="suggestion" name="altBad">
                                <?php
                                $stmt = $db->query("SELECT * FROM `Bed` WHERE 1");
                                foreach ($stmt->fetchAll() as $row) {
                                    $badname = $row['Bed_name'];
                                    echo '<option value=' . $badname . '>' . '</option>';
                                }
                                ?>
                            </select>
                        </datalist>
                    </p>
                    手機：<input type="text" name="cell" required class="text" placeholder="輸入手機"></br></br>
                    地址：<input type="text" name="add" required class="text" placeholder="輸入地址"></br></br>
                    入學年：<select style="width:160px;height:25px" name="year">
                        <option value="<?php echo $datetime; ?>"> <?php echo $datetime; ?> </option>
                        <option value="<?php echo $datetime - 1; ?>"> <?php echo $datetime - 1; ?></option>
                        <option value="<?php echo $datetime - 2; ?>"> <?php echo $datetime - 2; ?></option>
                        <option value="<?php echo $datetime - 3; ?>"> <?php echo $datetime - 3; ?></option>
                    </select> </br></br>
                    入住日期：<input type="date" name="dorm_s" value="<?php echo $datetime + 1911; ?>-09-01"><br/><br/>
                    監護人姓名：<input type="text" name="p_name" required class="text" placeholder="輸入監護人姓名"></br></br>
                    監護人手機：<input type="text" name="p_cell" required class="text" placeholder="輸入監護人手機"></br></br>
                    監護人身分證：<input type="text" name="p_idcard" required class="text" placeholder="輸入監護人身分證"></br></br>
                    <input type="reset" value="清除">
                    <input type="submit" value="送出">
                </form>
                <!--以下為詢問兄弟姊妹的-->
                <!--                <div id="clickme" style="left: 55%; top: 80px; position: absolute;">是否有兄弟姊妹?</div>
                                <div id="test" style="left: 55%; top: 110px; position: absolute;">
                                    <form action="do_page1.php" method="POST">
                                        兄弟姊妹班級：<input type="text" name="class"></br></br>
                                        兄弟姊妹姓名：<input type="text" name="name"></br></br>
                                        兄弟姊妹學號：<input type="text" name="stu_num"></br></br>
                                        <input type="reset" value="清除">
                                        <input type="submit" value="查詢">
                
                                    </form>
                                </div>-->
            </div>
        </div>
    </div>
    <div class="tab_pane">
        <form action="do_page1.php" method="POST">
            班級：<input type="text" name="class"></br></br>
            姓名：<input type="text" name="name"></br></br>
            學號：<input type="text" name="stu_num"></br></br>
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



<!--右邊是否有兄弟姊妹的-->
<script type="Text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type='text/javascript'>
    $("#test").hide(); //先讓問題消失
    $(function () {
        $("#clickme").click(function () {
            $("#test").toggle(); //點了之後問題出現
        });
    });
</script>

<!--即時顯示圖片-->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileToUpload").change(function () {
        readURL(this);
    });
</script>


</body>

</html>
