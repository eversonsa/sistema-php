<?php

namespace App\Infra;

use \PDO;

class Database {
    private static $host = 'localhost';
    private static $db   = 'bookwise';
    private static $user = 'root';
    private static $pass = 'everson';
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db, self::$user, self::$pass);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
}