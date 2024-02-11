<?php
// A Database osztály egy singleton mintát valósít meg, amely biztosítja, hogy csak egy adatbázis kapcsolat példány létezzen.
class Database {
    // Az egyetlen példányt tároló statikus változó.
    private static $instance = null;
    
    // Az adatbázis kapcsolatot tároló változó.
    private $conn;

    // Az adatbázis szerverének neve vagy címe.
    private $DB_servername = "localhost";
    // Az adatbázis felhasználói neve.
    private $DB_username = "Hamii";
    // Az adatbázis felhasználó jelszava.
    private $DB_password = "4M9TZedhhxxd-PFP";
    // Az adatbázis neve, amelyhez kapcsolódni szeretnénk.
    private $DB_database = "BeYou";

    // A konstruktor privát, hogy megakadályozza a közvetlen példányosítást.
    private function __construct() {
        // Létrehozza az adatbázis kapcsolatot a mysqli osztály használatával.
        $this->conn = new mysqli($this->DB_servername, $this->DB_username, $this->DB_password, $this->DB_database);
        // Ellenőrzi, hogy van-e hiba a kapcsolat létrehozásakor.
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Ez a metódus visszaadja az osztály egyetlen példányát. Ha még nem létezik, létrehozza azt.
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Ez a metódus visszaadja az adatbázis kapcsolatot.
    public function getConnection() {
        return $this->conn;
    }
}
?>
