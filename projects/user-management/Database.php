<?php

class Database {
    private $host ="db"; // <-- IMPORTANT: if you are using docker, usually the service name in docker-compose.yml
    private $username = "devuser";
    private $password = "devpass";
    private $database = "user_management";
    private $conn;

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