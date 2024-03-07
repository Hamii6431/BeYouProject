<?php
session_start(); // Session indítása

//Ha érkezett adat a post kérésből elindítjuk a bejelentkezést
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ellenőrizzük hogy a login_username és a login_password változókba érkezett e adat.
    if (isset($_POST['login_username'], $_POST['login_password'])) {
        $loginUsername = $_POST['login_username'];
        $loginPassword = $_POST['login_password'];

        //Meghívjuk a UserModel.php fájlt a bejelentkezési funkciók eléréséhez.
        require_once '../../Backend/models/UserModel.php';
        $userModel = new UserModel();
        $loginResult = $userModel->verifyPassword($loginUsername, $loginPassword);
        if ($loginResult) {
            // Sikeres bejelentkezés esetén a felhasználó vagy admin adatainak tárolása session változókba majd továbbítás a megfelelő oldalra.
            if ($loginResult['type'] === 'user') {
                $_SESSION['user_id'] = $loginResult['data']['user_id'];
                $_SESSION['user_username'] = $loginResult['data']['username'];
                $_SESSION['user_email'] = $loginResult['data']['email'];
                $_SESSION['user_firstname'] = $loginResult['data']['first_name'];
                $_SESSION['user_lastname'] = $loginResult['data']['last_name'];
                $_SESSION['logged_in'] = true;
                
                // Átirányítás a felhasználó profil oldalára
                header("Location: ../../Frontend/user_area/ProfilePage.php");
                exit();
            } elseif ($loginResult['type'] === 'admin') {
                $_SESSION['admin_id'] = $loginResult['data']['admin_id'];
                $_SESSION['admin_username'] = $loginResult['data']['admin_username'];
                $_SESSION['admin_email'] = $loginResult['data']['admin_email'];
                $_SESSION['admin_firstname'] = $loginResult['data']['admin_first_name'];
                $_SESSION['admin_lastname'] = $loginResult['data']['admin_last_name'];
                
                // Átirányítás az admin felületre
                header("Location: ../../Frontend/admin_area/AdminPage.php");
                exit();
            }
        } else {
            // Sikertelen bejelentkezés esetén visszairányítás a bejelentkezési oldalra
            header("Location: ../../Frontend/user_area/loginpage.html?error=invalid_login");
            exit();
        }
    }
}

// Ha nem POST kérés érkezett, vagy hiányoznak az adatok, akkor visszairányítás a bejelentkezési oldalra
header("Location: ../../Frontend/user_area/LoginPage.html");
exit();
?>
