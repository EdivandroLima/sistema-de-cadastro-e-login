<?php

namespace App;

class Connection
{
    private $host = 'localhost';
    private $dbname = 'bd_usuarios';
    private $user = 'root';
    private $pass = '';
    protected $db;

    public function __construct()
    {
        try {
            // Conexão usando PDO
            $conexao = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->pass"
            );

            $this->db = $conexao;
        } catch (\PDOException $e) {
            echo '<pr>' . $e->getMessage() . '</p>';
        }
    }
}
