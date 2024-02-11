<?php
//userModel importálása.
require_once __DIR__ . '/../models/UserModel.php';

//LoginController létrehozása
class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    //Bejelentkezési logika.
    public function login($loginUsername, $loginPassword) {
        //Adatok egyezőségének vizsgálata.
        if ($this->userModel->verifyPassword($loginUsername, $loginPassword)) {
            //Amennyiben megfelelnek a bejelentkezési adatok az adatbázisban lévő felhasználói adatokkal elindítjuk a sessiont.
            session_start();
            $userData = $this->userModel->getUserDataByUsername($loginUsername);
            //Felhasználó adatainak tárolása a sessionben.
            if ($userData) {
                $_SESSION['session_username'] = $userData['username'];
                $_SESSION['session_user_id'] = $userData['user_ID'];
                $_SESSION['session_name'] = $userData['name'];
                $_SESSION['session_gender'] = $userData['gender'];
                $_SESSION['session_birthdate'] = $userData['birthdate'];
                $_SESSION['session_email'] = $userData['email'];
                $_SESSION['session_phone_number'] = $userData['phone_number'];
                
                // Átirányítás a profil oldalra
                header("Location: ../../Frontend/user_area/profilepage.php");
                exit();
            } else {
                //Exit
            }
        } else {
            //Felhasználó értesítése a hibás bejelentkezésről.
            echo "<script>alert('Invalid username or password. Please try again.')</script>";
        }
    }

    //Kijelentkezés funkció bejelentkezési oldalra átirányítással.
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../Frontend/loginpage.php");
        exit();
    }
}
