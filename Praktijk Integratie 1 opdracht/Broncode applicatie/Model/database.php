<?php

class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "mysql";
    private $charset = "utf8";
    private $dbname = "boerderijautomaat";
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->servername};dbname={$this->dbname};charset={$this->charset}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>