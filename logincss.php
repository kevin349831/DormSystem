<?php ?>

<!DOCTYPE html>
<html lang="en-us">
    <meta charset="utf-8" />
    <head>
        <title>Free HTML5 CSS3 Responsive Login Signup Form</title>

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
    </head>
    <body>

        <nav id="menu">
            <ul class="nav">
                <li><a href="javascript:void(0);" class="active"><i class="fa fa-user-plus" style="font-size:20px"></i> 新增</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-search" style="font-size:20px"></i> 查詢</a></li>
            </ul>
        </nav>


        <!--        <div class="form">
                    <div class="header"><h2>使用者登入</h2></div>
                    <div class="login">
                        <form action="loding.php" method="POST">
                            <ul>
                                <li>
                                    <span class="un"><i class="fa fa-user"></i></span><input type="text" name="user" required class="text" placeholder="你的帳號或是電子郵件"/></li>
                                <li>
                                    <span class="un"><i class="fa fa-lock"></i></span><input type="password" name="passwd" required class="text" placeholder="用戶密碼"/></li>
                                placeholder 是預設字樣，使用者點下去就會消失
                                <li>
                                    <input type="submit" value="登入" class="btn">
                                </li>
        
                        </form>
                    </div></div>-->




        <section id="tab_panes">
            <div class="tab_pane active">
                <div class="form">
                    <div class="login">
                        <form action="loding.php" method="POST">
                            
                                
                                    班級：<input type="text" name="class" required class="text" placeholder="輸入班級"/></br></br>
                                
                                    姓名：<input type="text" name="name" required class="text" placeholder="輸入姓名"/></br></br>
                                <!--placeholder 是預設字樣，使用者點下去就會消失-->
                                
                                    <input type="reset" value="清除"><input type="submit" value="新增">
                                
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab_pane">
                <form action="do_page1.php" method="POST">
                    班級：<input type="text" name="class"></br></br>
                    姓名：<input type="text" name="name"></br></br>
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


