<?php
//Fájl tartalma: [Cím]
//Módosításra vár: // Felhasználó szállítási címeinek lekérdezése

require_once __DIR__ . '/../models/UserModel.php'; // A UserModel osztály betöltése

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel(); // UserModel példányosítása
    }

    // Bejelentkezési folyamat
    public function login($loginUsername, $loginPassword) {
        if ($this->userModel->verifyPassword($loginUsername, $loginPassword)) { // Jelszó ellenőrzése
            session_start();
            $_SESSION['session_username'] = $loginUsername; // Felhasználónév tárolása a munkamenetben
            header("Location: ../../Frontend/user_area/profilepage.php"); // Átirányítás a profil oldalra
            exit();
        } else {
            echo "<script>alert('Invalid username or password. Please try again.')</script>";
        }
    }

    // Felhasználó adatainak tárolása a munkamenetben
        public function storeUserData($loginUsername) {
            $userData = $this->userModel->findByUsername($loginUsername);
            if ($userData) {
                $_SESSION['session_user_id'] = $userData['user_ID'];
                $_SESSION['session_name'] = $userData['name'];
                $_SESSION['session_gender'] = $userData['gender'];
                $_SESSION['session_birthdate'] = $userData['birthdate'];
                $_SESSION['session_email'] = $userData['email'];
                $_SESSION['session_phone_number'] = $userData['phone_number'];
                // További adatok tárolása szükség szerint

                // Itt használjuk a userData['user_ID']-t a felhasználói azonosítóként
                $shippingAddresses = $this->userModel->getUserShippingAddresses($userData['user_ID']);
                $_SESSION['session_shipping_addresses'] = $shippingAddresses;
            }
        }




    // Felhasználó kijelentkeztetése és munkamenet törlése
    public function logout() {
        session_unset(); // Munkamenet változóinak törlése
        session_destroy(); // Munkamenet megsemmisítése
        header("Location: ../../Frontend/loginpage.php"); // Átirányítás a bejelentkezési oldalra
        exit();
    }
}
?>