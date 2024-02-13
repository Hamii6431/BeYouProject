<?php
require_once __DIR__ . '/../includes/connect.php';

class AdminModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Admin adatok lekérdezése felhasználónév alapján
    public function getAdminDataByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM table_admin WHERE admin_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Admin jelszó ellenőrzése
    public function verifyAdminPassword($loginUsername, $loginPassword) {
        $admin = $this->getAdminDataByUsername($loginUsername);
        if ($admin) {
            return password_verify($loginPassword, $admin['admin_password']);
        }
        return false;
    }
}
?>
