
<?php
//Adatbázis kapcsolat létrehozása
require_once __DIR__ . '/../includes/Database.php';
//AdminModel.php meghívása
require_once __DIR__ . '/../models/AdminModel.php';

//UserModel Class létrehozása
class UserModel {
    private $db;

    //Adatbázis kapcsolat
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }


//////////////////////////////////////////////////////////////BEJELENTKEZÉS///////////////////////////////////////////////


    // Felhasználó bejelentkezésének ellenőrzése
    public function verifyPassword($loginUsername, $loginPassword) {
        //Felhasználónév találat esetén megnézzük hogy a kapott jelszó hashe megegyezik e az adatbázisban lévő hash-el.
        $user = $this->getUserDataByUsername($loginUsername);
        if ($user && password_verify($loginPassword, $user['password'])) {
            return ['type' => 'user', 'data' => $user];
        }

        //Admin felhasználónév találat esetén megnézzük hogy a kapott jelszó hashe megegyezik e az adatbázisban lévő hash-el.
        $adminModel = new AdminModel();
        $admin = $adminModel->getAdminDataByUsername($loginUsername);
        if ($admin && password_verify($loginPassword, $admin['password'])) {
            return ['type' => 'admin', 'data' => $admin];
        }

        return false;
    }

    // Felhasználó adatainak lekérése felhasználónév alapján
    public function getUserDataByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    //Felhasználó kijelentkeztetése és továbbítása a bejelentkezési oldalra.
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../Frontend/loginpage.php");
        exit();
    }

//////////////////////////////////////////////////////////////REGISZTRÁCIÓ///////////////////////////////////////////////


    // Felhasználónév foglaltságának ellenőrzése az adatbázisban.
    public function isUsernameTaken($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Email cím egyezőségének ellenőrzése
    public function isEmailTaken($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    // Jelszavak egyezőségének ellenőrzése
    public function passwordsMatch($password, $password_again) {
        return $password === $password_again;
    }

    // Felhasználó regisztrálása az adatbázisba
    public function registerUser($first_name, $last_name, $username, $email, $password) {
        // Ellenőrizzük, hogy a felhasználónév és az emailcím még nem foglalt-e
        if ($this->isUsernameTaken($username)) {
            return "Username already taken.";
        }

        if ($this->isEmailTaken($email)) {
            return "Email already registered.";
        }

        // Jelszó hashelése
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Felhasználó adatainak regisztrálása az adatbázisban.
        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            return "Registration successful.";
        } else {
            return "Registration failed.";
        }
    }


//////////////////////////////////////////////////////////////              ///////////////////////////////////////////////


    // Felhasználó szállítási címeinek lekérése
    public function getUserShippingAddresses($userId) {
        $query = "SELECT * FROM shipping_addresses WHERE user_id = ?";
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

    // Felhasználó szállítási címének frissítése
    public function updateShippingAddress($addressId, $userId, $country, $postalCode, $city, $streetAddress) {
        $stmt = $this->db->prepare("UPDATE shipping_addresses SET country = ?, postal_code = ?, city = ?, street_address = ? WHERE address_id = ? AND user_id = ?");
        $stmt->bind_param("ssssii", $country, $postalCode, $city, $streetAddress, $addressId, $userId);
        return $stmt->execute();
    }
}



?>
