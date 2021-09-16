<?php

namespace Core;

class Connection
{
    private static $host = 'localhost';
    private static $dbname = 'bd_usuarios';
    private static $user = 'root';
    private static $pass = '';

    protected static function conexao()
    {
        try {
            $conexao = new \PDO(
                "mysql:host=" . static::$host . ";dbname=" . static::$dbname,
                static::$user,
                static::$pass
            );

            return $conexao;
        } catch (\PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
            exit;
        }
    }
}
