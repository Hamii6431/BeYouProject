<?php
//Fájl tartalma: [Cím]
//Módosításra vár: // Felhasználó szállítási címeinek lekérdezése

require_once __DIR__ . '/../models/UserModel.php';

class LoginController {
    private $userModel;

    
    public function __construct($db) {
        $this->userModel = new UserModel($db->getConnection()); //Adatbázis kapcsolat biztosítása
    }

    //Bejelentkezési logika.
    //Amennyiben megegyezik a felhasználó neve egy adatbázisban tárolt névvel és a jelszó hashek is megegyeznek elindítjuk a sessiont.
    //Tároljuk a felhasználó ID-jét és neveit a sessionbe.
    //Átirányítjuk a
    public function login($username, $password) {
        $user = $this->userModel->userFinder($username);
        if ($user && $this->userModel->verifyPassword($user, $password)) {
            session_start();
            $_SESSION['user_id'] = $user['user_ID'];
            
            $this->storeUserData($user['user_ID']);
            //Felhasználó átirányítása
            header("Location: ../../Frontend/user_area/profilepage.php");
            exit();
        } else {
            echo "<script>alert('Invalid username or password. Please try again.')</script>";
        }
    }

    public function storeUserData($userId) {
        // Felhasználó alapadatainak lekérdezése és tárolása
        $userData = $this->userModel->userFinder($userId);
        $_SESSION['session_user_id'] = $userData['user_ID'];
        $_SESSION['session_username'] = $userData['username'];
        $_SESSION['session_name'] = $userData['name'];
        $_SESSION['session_gender'] = $userData['gender'];
        $_SESSION['session_birthdate'] = $userData['birthdate'];
        $_SESSION['session_email'] = $userData['email'];
        $_SESSION['session_phone_number'] = $userData['phone_number'];
    
        // Felhasználó szállítási címeinek lekérdezése
        $shippingAddresses = $this->userModel->getUserShippingAddresses($userId);
        $_SESSION['session_shipping_addresses'] = $shippingAddresses;
    }
    
    // Felhasználó kijelentkeztetése és munkamenet törlése
    public function logout() {
        session_unset(); // Munkamenet változóinak törlése
        session_destroy(); // Munkamenet megsemmisítése
        header("Location: ../../Frontend/loginpage.php"); // Átirányítás a bejelentkezési oldalra
        exit();
    }
}
