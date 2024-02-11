<?php

require_once __DIR__ . '/../includes/connect.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getUserDataByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM user_table WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function verifyPassword($loginUsername, $loginPassword) {
        $user = $this->getUserDataByUsername($loginUsername);
        if ($user) {
            return password_verify($loginPassword, $user['password']);
        }
        return false;
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
    

    public function updateUserData($userId, $name, $email, $phone_number, $birthdate, $gender) {
        $stmt = $this->db->prepare("UPDATE user_table SET name = ?, email = ?, phone_number = ?, birthdate = ?, gender = ? WHERE user_ID = ?");
        $stmt->bind_param("sssssi", $name, $email, $phone_number, $birthdate, $gender, $userId);
        return $stmt->execute();
    }
    
}
