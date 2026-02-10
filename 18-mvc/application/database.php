<?php
abstract class Database
{
    protected static $conn = null;

    public static function connect()
    {
        if (self::$conn === null) {
            try {
                $host = 'localhost';
                $dbnm = 'pokeadso_a';
                $user = 'root';
                $pass = '';

                self::$conn = new PDO(
                    "mysql:host=$host;dbname=$dbnm;charset=utf8",
                    $user,
                    $pass
                );
            } catch (PDOException $e) {
                die('Connection Error: ' . $e->getMessage());
            }
            return self::$conn;
        }
    }
}
