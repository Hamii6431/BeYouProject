<?php
class UserModel {
    private $db; // Adatbázis kapcsolatot tároló változó

    public function __construct() {
        // Adatbázis kapcsolat létrehozása
        $this->db = Database::getInstance()->getConnection();
    }

    // Felhasználó keresése felhasználónév alapján
    public function findByUsername($loginUsername) {
        $stmt = $this->db->prepare("SELECT * FROM user_table WHERE username = ?");
        $stmt->bind_param("s", $loginUsername); // A "s" jelzi, hogy a paraméter típusa string
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc(); // Visszatérés a lekérdezés eredményével
    }

    // Jelszó ellenőrzése a felhasználónév alapján
    public function verifyPassword($loginUsername, $loginPassword) {
        $user = $this->findByUsername($loginUsername);
        if ($user) {
            return password_verify($loginPassword, $user['password']); // Jelszó ellenőrzése
        }
        return false;
    }



    public function getUserDataByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM user_table WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Visszatérítjük a lekérdezés eredményét
    }
    



    //Szállítási adatok tárolása $addresses[] tömbbe.
    public function getUserShippingAddresses($userId) {
        $stmt = $this->db->prepare("SELECT * FROM shipping_addresses WHERE user_ID = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $addresses = [];
        while ($row = $result->fetch_assoc()) {
            $addresses[] = [
                'country' => $row['country'],
                'postal_code' => $row['postal_code'],
                'street_address' => $row['street_address'],
                'city' => $row['city'],
            ];
        }
        return $addresses;
    }
    
}
