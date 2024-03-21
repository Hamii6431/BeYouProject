<?php

require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/../models/AdminModel.php'; // Biztosítsuk, hogy az AdminModel is betöltődjön

class UserModel {
    private $db;

    // Konstruktor az adatbázis kapcsolathoz
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Felhasználói adatok lekérése felhasználónév alapján
    public function getUserDataByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Felhasználói adatok lekérése felhasználói ID alapján
    public function getUserDataByUserID($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_ID = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Bejelentkezés ellenőrzése
    public function verifyPassword($loginUsername, $loginPassword) {
        $user = $this->getUserDataByUsername($loginUsername);
        if ($user && password_verify($loginPassword, $user['password'])) {
            return ['type' => 'user', 'data' => $user];
        }

        $adminModel = new AdminModel();
        $admin = $adminModel->getAdminDataByUsername($loginUsername);
        if ($admin && password_verify($loginPassword, $admin['admin_password'])) {
            return ['type' => 'admin', 'data' => $admin];
        }

        return false;
    }

    // Teljes név lekérése felhasználói ID alapján
    public function getUserFullName($userId) {
        $stmt = $this->db->prepare("SELECT CONCAT(first_name, ' ', last_name) AS full_name FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            return $result->fetch_assoc()['full_name'];
        }
        return "Unknown";
    }

    // Felhasználónév foglaltságának ellenőrzése
    public function isUsernameTaken($username) {
        $stmt = $this->db->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Email foglaltságának ellenőrzése
    public function isEmailTaken($email) {
        $stmt = $this->db->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Jelszavak egyezőségének ellenőrzése
    public function passwordsMatch($password, $password_again) {
        return $password === $password_again;
    }

    // Felhasználó regisztrálása
    public function registerUser($first_name, $last_name, $username, $email, $password) {
        if ($this->isUsernameTaken($username) || $this->isEmailTaken($email)) {
            return "Username or Email already taken.";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            return "Registration successful.";
        }
        return "Registration failed.";
    }

    // Felhasználói adatok frissítése
    public function updateUserData($userId, $username, $first_name, $last_name, $email) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, first_name = ?, last_name = ?, email = ? WHERE user_id = ?");
        $stmt->bind_param("ssssi", $username, $first_name, $last_name, $email, $userId);
        
        return $stmt->execute();
    }

    // Felhasználó szállítási adatainak lekérése ID alapján
    public function getUserShippingDataByUserID($userId) {
        $stmt = $this->db->prepare("SELECT * FROM shipping_addresses WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Felhasználó szállítási címeinek lekérése
    public function getUserShippingAddresses($userId) {
        $stmt = $this->db->prepare("SELECT * FROM shipping_addresses WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $addresses = [];
        while ($row = $result->fetch_assoc()) {
            $addresses[] = $row;
        }
        return $addresses;
    }

    public function isUserHaveAddress($userId) {
        $stmt = $this->db->prepare("SELECT address_id FROM shipping_addresses WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc()['address_id'];
        } else {
            return false;
        }
    }
    

    // Új szállítási cím létrehozása
    public function createShippingAddress($userId, $phoneNumber, $country, $postalCode, $city, $streetAddress) {
        $stmt = $this->db->prepare("INSERT INTO shipping_addresses (user_id, phone_number, country, postal_code, city, street_address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $userId, $phoneNumber, $country, $postalCode, $city, $streetAddress);
        return $stmt->execute();
    }

    // Felhasználó szállítási adatainak frissítése
    public function updateShippingAddress($addressId, $userId, $phoneNumber, $country, $postalCode, $city, $streetAddress) {
        $stmt = $this->db->prepare("UPDATE shipping_addresses SET phone_number = ?, country = ?, postal_code = ?, city = ?, street_address = ? WHERE address_id = ? AND user_id = ?");
        $stmt->bind_param("sssssii", $phoneNumber, $country, $postalCode, $city, $streetAddress, $addressId, $userId);
        return $stmt->execute();
    }






    public function isUserLoggedIn() {
        // Ellenőrizzük, hogy a 'logged_in' session változó létezik-e és igaz értékű-e
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
}
