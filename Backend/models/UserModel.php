<?php
//Fájl tartalma: [Cím]

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Felhasználó keresése az userID azonosító alapján
    public function userFinder ($userId) {
        $stmt = $this->db->prepare("SELECT * FROM user_table WHERE user_ID = ? LIMIT 1");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }


    // Felhasználó jelszavának ellenőrzése
    public function verifyPassword($user, $password) {
        return password_verify($password, $user['password']);
    }

    // Új felhasználó regisztrálása
    public function register($name, $email, $username, $password,) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO user_table (name, email, username, password, ip_address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $username, $hashed_password, );

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
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
