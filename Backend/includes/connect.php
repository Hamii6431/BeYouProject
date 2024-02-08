<?php
//Fájl tartalma: Adatbázis kapcsolat létrehozása
class Database {
    private $DB_servername = "localhost";
    private $DB_username = "Hamii";
    private $DB_password = "4M9TZedhhxxd-PFP";
    private $DB_database = "BeYou";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->DB_servername, $this->DB_username, $this->DB_password, $this->DB_database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$con = new Database();
?>