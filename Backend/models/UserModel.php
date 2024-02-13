<?php
require_once __DIR__ . '/../includes/connect.php';
require_once __DIR__ . '/../models/AdminModel.php'; // AdminModel importálása

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
        if ($user && password_verify($loginPassword, $user['password'])) {
            return ['type' => 'user', 'data' => $user];
        }

        // Admin bejelentkezési logika
        $adminModel = new AdminModel();
        $admin = $adminModel->getAdminDataByUsername($loginUsername);
        if ($admin && password_verify($loginPassword, $admin['password'])) {
            return ['type' => 'admin', 'data' => $admin];
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
