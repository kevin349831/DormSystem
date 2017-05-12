<?php
$ne = $_GET['user'];
?>

<html>
    <head>
        <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/zh/thumb/f/fb/KUAS_logo.svg/1194px-KUAS_logo.svg.png">
        <!--上面是讓網頁標題有圖片-->
        <title>高應宿舍活動管理系統</title>
        <style>
            body {
                width: 90%;
                margin: 50px auto 0 auto;
                font-family: Arial, Helvetica;
                font-size: large;
                background-color: #eee;
                background-image: url(data:image/gif;base64,R0lGODlhCAAIAJEAAMzMzP///////wAAACH5BAEHAAIALAAAAAAIAAgAAAINhG4nudroGJBRsYcxKAA7);
            }
            /* ------------------------------------------------- */

            #tabs {
                overflow: hidden;
                width: 100%;
                margin: 0;
                padding: 0;
                list-style: none;
            }

            #tabs li {
                float: left;
                margin: 0 -15px 0 0;
            }

            #tabs a {
                float: left;
                position: relative;
                padding: 0 40px;
                height: 0;
                line-height: 30px;
                text-transform: uppercase;
                text-decoration: none;
                color: #fff;      
                border-right: 30px solid transparent;
                border-bottom: 30px solid #3D3D3D;
                border-bottom-color: #777\9;
                opacity: .3;
                filter: alpha(opacity=30);      
            }

            #tabs a:hover,
            #tabs a:focus {
                border-bottom-color: #2ac7e1;
                opacity: 1;
                filter: alpha(opacity=100);
            }

            #tabs a:focus {
                outline: 0;
            }

            #tabs #current {
                z-index: 3;
                border-bottom-color: #3d3d3d;
                opacity: 1;
                filter: alpha(opacity=100);      
            }

            /* ----------- */
            #content {
                background: #fff;
                border-top: 2px solid #3d3d3d;
                padding: 2em;
                /*height: 220px;*/
            }

            #content h2,
            #content h3,
            #content p {
                margin: 0 0 15px 0;
            }  

            /* Demo page only */
            #about {
                color: #999;
                text-align: center;
                font: 0.9em Arial, Helvetica;
            }

            #about a {
                color: #777;
            }   
        </style>  

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    </head>
    <body>
        <div dojotype="dijit.layout.ContentPane" region="center" dolayout="false" style="padding: 0px; overflow: hidden; left: 0px; top: 0px; position: absolute; width: 100%; height: 30px; background: none 0px 0px repeat scroll rgb(61, 61, 61);"></div>
        <!--上面是最上面那條橫線-->        <ul id="tabs">
            <li><a href="#" name="#tab">系統資訊</a></li>
            <li><a href="#" name="#tab1">住宿生</a></li>
            <li><a href="#" name="#tab2">活動</a></li>
            <li><a href="#" name="#tab3">設備</a></li>
            <li><a href="#" name="#tab4">幹部</a></li>
        </ul>
        <!--上面是分頁標籤-->
        
        <div style="left: 10;top:5px;position:fixed;z-index:1;"color="FFFFFF"> 
            <font size="4" color="FFFFFF">高 應 宿 舍 活 動 管 理 系 統
            </font>
        </div>
        <div style="right: 6%;top:5px;position:fixed;z-index:1;"color="FFFFFF"> 
            <font size="4" color="FFFFFF">使用者:<?php echo $ne ?>
            <a href="logout.php">登出</a>
            </font>
        </div>
        <!--上面是使用者ID及登出文字-->
        
        
        
        <div id="content">
            <div id="tab">
                <iframe src="db_main.php" width="100%" height="650px" frameborder="0" scrolling="yes"></iframe>
            </div>
            <div id="tab1">
                <iframe src="db_main1.php" width="100%" height="650px" frameborder="0" scrolling="yes"></iframe>
            </div>
            <div id="tab2">
                <iframe src="db_main2.php" width="100%" height="650px" frameborder="0" scrolling="yes"></iframe>
            </div>
            <div id="tab3">
                <iframe src="db_main3.php" width="100%" height="650px" frameborder="0" scrolling="yes"></iframe>
            </div>
            <div id="tab4">
                <iframe src="db_main4.php" width="100%" height="650px" frameborder="0" scrolling="yes"></iframe>
            </div>
        </div>
        <!--上面是分頁標籤的內容-->
        
        <p id="about">前往 <a target="_blank" href="http://studorm.kuas.edu.tw/web2/">宿舍網站</a></p>
        <!--上面是網頁底部文字  target="_blank" 是另外開分頁-->
        
        <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

        <script>
            function resetTabs() {
                $("#content > div").hide(); //Hide all content
                $("#tabs a").attr("id", ""); //Reset id's      
            }

            var myUrl = window.location.href; //get URL
            var myUrlTab = myUrl.substring(myUrl.indexOf("#")); // For localhost/tabs.html#tab2, myUrlTab = #tab2     
            var myUrlTabName = myUrlTab.substring(0, 4); // For the above example, myUrlTabName = #tab

            (function () {
                $("#content > div").hide(); // Initially hide all content
                $("#tabs li:first a").attr("id", "current"); // Activate first tab
                $("#content > div:first").fadeIn(); // Show first tab content

                $("#tabs a").on("click", function (e) {
                    e.preventDefault();
                    if ($(this).attr("id") == "current") { //detection for current tab
                        return
                    } else {
                        resetTabs();
                        $(this).attr("id", "current"); // Activate this
                        $($(this).attr('name')).fadeIn(); // Show content for current tab
                    }
                });

                for (i = 1; i <= $("#tabs li").length; i++) {
                    if (myUrlTab == myUrlTabName + i) {
                        resetTabs();
                        $("a[name='" + myUrlTab + "']").attr("id", "current"); // Activate url tab
                        $(myUrlTab).fadeIn(); // Show url tab content        
                    }
                }
            })()
        </script>

    </body>
</html>
