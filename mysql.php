<?php

class DataBase {

    public static function initDB() {
        $db_host = 'db.mis.kuas.edu.tw';
        $db_name = 's1103137222';
        $db_user = 's1103137222';
        $db_password = 'haoyu';
        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
        $db = new PDO($dsn, $db_user, $db_password);
        return $db;
    }

}
?>



