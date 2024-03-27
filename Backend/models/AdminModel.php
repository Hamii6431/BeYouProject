<?php
require_once __DIR__ . '/../includes/Database.php';

class AdminModel {
    private $db;

    // Konstruktor az adatbázis kapcsolathoz
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Admin adatok lekérdezése felhasználónév alapján
    public function getAdminDataByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE admin_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}
?>
