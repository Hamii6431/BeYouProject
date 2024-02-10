<?php

class Database {
    private static $instance = null;
    private $conn;

    private $DB_servername = "localhost";
    private $DB_username = "Hamii";
    private $DB_password = "4M9TZedhhxxd-PFP";
    private $DB_database = "BeYou";

    private function __construct() {
        $this->conn = new mysqli($this->DB_servername, $this->DB_username, $this->DB_password, $this->DB_database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>