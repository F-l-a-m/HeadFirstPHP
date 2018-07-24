<?php

class Database {

    //private static $dbName = 'aliendatabase';
    private static $dbHost = '127.0.0.1';
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'root';
    private static $connection = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect($dbName) {
        // One connection through whole application
        if (null == self::$connection) {
            try {
                self::$connection = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . $dbName, self::$dbUsername, self::$dbUserPassword);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$connection;
    }

    public static function disconnect() {
        self::$connection = null;
    }

}

?>
