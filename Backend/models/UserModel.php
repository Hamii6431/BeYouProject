<?php
require_once __DIR__ . '/../includes/connect.php';

class UserModel {
    private $db;

    // Database connection initialization
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Fetch user data by username
    public function getUserDataByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM user_table WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Verify user password for login
    public function verifyPassword($loginUsername, $loginPassword) {
        $user = $this->getUserDataByUsername($loginUsername);
        if ($user) {
            return password_verify($loginPassword, $user['password']);
        }
        return false;
    }



    // Update user data
    public function updateUserData($userId, $name, $email, $phone_number, $birthdate, $gender) {
        $stmt = $this->db->prepare("UPDATE user_table SET name = ?, email = ?, phone_number = ?, birthdate = ?, gender = ? WHERE user_ID = ?");
        $stmt->bind_param("sssssi", $name, $email, $phone_number, $birthdate, $gender, $userId);
        return $stmt->execute();
    }

    // Szállítási címek lekérése.
    public function getUserShippingAddresses($userId) {
        $query = "SELECT * FROM shipping_addresses WHERE user_ID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $addresses = [];
        while ($row = $result->fetch_assoc()) {
            $addresses[] = $row;
        }
        return $addresses;
    }

    public function updateShippingAddress($addressId, $userId, $country, $postalCode, $city, $streetAddress) {
        // Assuming `address_ID` is the primary key for your shipping_addresses table
        $stmt = $this->db->prepare("UPDATE shipping_addresses SET country = ?, postal_code = ?, city = ?, street_address = ? WHERE address_ID = ? AND user_ID = ?");
        $stmt->bind_param("ssssii", $country, $postalCode, $city, $streetAddress, $addressId, $userId);
        return $stmt->execute();
    }
    

}
?>
