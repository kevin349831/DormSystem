<?php
session_start();
unset($_SESSION['u_name'], $_SESSION['email'], $_SESSION['acc']);
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

            .button {
                background-color: #DBDBDB; /* Green */
                border: none;
                color: black;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
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
                        <!--以下form為上傳圖片功能-->
                        <form action="insert0.php" method="post" enctype="multipart/form-data">
                             <!--<input type='file' id="imgInp" />-->
                              <img id="blah" src="#" alt="your image" /></br></br>     
                            照片：<input type="file" name="fileToUpload" id="fileToUpload" required class="text"></br></br>               
                            名字：<input type="text" name="name" required class="text" placeholder="輸入姓名"></br></br>
                            信箱：<input type="text" name="email" required class="text" placeholder="輸入信箱"></br></br>
                            帳號：<input type="text" name="account" required class="text" placeholder="輸入帳號"></br></br>
                            密碼：<input type="password" name="passwd" required class="text" placeholder="輸入密碼"></br></br>
                            確認密碼：<input type="password" name="check" required class="text" placeholder="再次輸入密碼"></br></br>
                            權限：<select name="u_power">
                                <option value="1" >管理者</option>
                                <option value="2" SELECTED>使用者</option>
                            </select></br></br>

                            <input type="reset" value="清除">
                            <input type="submit" value="送出">
                            
                        </form>

                    </div>
                </div>
            </div>
            <div class="tab_pane">
                <div class="form">
                    <div class="login">
                        <form action="do_page0.php" method="POST">
                            名字：<input type="text" name="u_name"></br></br>
                            信箱：<input type="text" name="email"></br></br>
                            帳號：<input type="text" name="acc"></br></br>
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
