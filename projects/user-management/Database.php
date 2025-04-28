<?php

class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct() {
        $this->host = getenv('DB_HOST') ?: 'db'; // fallback to 'db' if not set
        $this->username = getenv('MYSQL_USER') ?: 'devuser';
        $this->password = getenv('MYSQL_PASSWORD') ?: 'devpass';
        $this->database = getenv('MYSQL_DATABASE') ?: 'user_management';
    }

    public function connect() {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if ($this->conn->connect_error) {
            die("Database Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>
