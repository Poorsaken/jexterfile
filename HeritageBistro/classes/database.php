<?php
class Database {
    private static $con = null;

    public static function connectDB() {
        if (self::$con === null) {
            date_default_timezone_set('Asia/Manila');
            try {
                $db_host = 'localhost';
                $db_name = 'HeritageBistro';
                $db_user = 'root';
                $user_pw = '';

                self::$con = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $user_pw);
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$con->exec("SET CHARACTER SET utf8");
            } catch (PDOException $err) {
                echo "<center><h3>You are currently denied access to Database. Contact Web Administrator</h3></center>";
                file_put_contents('PDOErrors.txt', $err, FILE_APPEND);
                die();
            }
        }
        return self::$con;
    }

    public static function getConnection() {
        return self::connectDB();
    }
}
