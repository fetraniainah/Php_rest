<?php
namespace app\config;

use PDO;
use PDOException;

class Database {
    private static $host = 'localhost';
    private static $db_name = 'ma_base_de_donnees';
    private static $username = 'root';
    private static $password = '';
    private static $conn;

    public static function connect() {
        if (self::$conn == null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }
        }
        return self::$conn;
    }
}
?>