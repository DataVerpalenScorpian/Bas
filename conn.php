<?php
// connect.php

class DatabaseConn {
    private $servername;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function __construct($servername, $dbname, $username, $password) {
        $this->servername = $servername;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connectie gelukt <br />";
        } catch(PDOException $e) {
            echo "connectie mislukt: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$servername = "localhost";
$dbname = "basdb";
$username = "root";
$password = "";

$connection = new DatabaseConn($servername, $dbname, $username, $password);
$connection->connect();
$conn = $connection->getConnection();
?>