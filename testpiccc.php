<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') { 
        if( $_FILES['photo']['error'] != '4' ) { // 檢查有沒上傳圖檔
            $file = $_FILES['photo']['tmp_name'] ;
            $fp      = fopen($file, 'r');
            $rawDataSS1 = fread($fp, filesize($file));
            fclose($fp);
            $_SESSION['sessionImg'] = $encodedSS1Data = base64_encode($rawDataSS1); // 將檔案邊碼(base64)後放入SESSION
        }
    }
?>
<!DOCTYPE html>
<html lang="zh-TW">
    <head>
        <title>DL部落 - 上傳圖片後預覽, 不需寫檔</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <?php
            if( isset($_SESSION['sessionImg']) && $_SESSION['sessionImg'] != '' ) { // 檢查SESSION有沒有值
                echo '<img src="data:image/;base64,'.$_SESSION['sessionImg'].'">' ; // 顯示圖檔
            }
        ?>
        <form enctype="multipart/form-data" method="POST">
            <input type="file" name="photo">
            <button type="submit">上傳</button>
        </form>
    </body>
</html>
