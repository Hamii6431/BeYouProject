<?php

session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

class ProfileController {
    private $userModel;

    public function __construct() {
        // Adatbázis kapcsolat létrehozása
        $dbInstance = Database::getInstance();
        $dbConnection = $dbInstance->getConnection();
        // UserModel példány létrehozása
        $this->userModel = new UserModel($dbConnection);
    }

    public function handleRequest() {
        if ($this->isPostRequest() && $this->isValidUpdateAccountRequest()) {
            $this->updateUserProfile();
        } else {
            // Kezeljük az érvénytelen kéréseket vagy hibákat
            echo "Invalid request or missing update account action.";
        }
    }

    private function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    private function isValidUpdateAccountRequest() {
        return isset($_POST['update_account']);
    }

    private function updateUserProfile() {
        $userId = $_SESSION['user_id']; // A felhasználó azonosítója a munkamenetből
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $success = $this->userModel->updateUserData($userId, $username, $first_name, $last_name, $email);

        if ($success) {
            // Sikeres frissítés esetén frissítjük a munkamenet adatokat is
            $this->updateSessionData($username, $first_name, $last_name, $email);
            // Átirányítás a profil oldalra
            $this->redirectToProfilePage();
        } else {
            // Sikertelen frissítés esetén hibaüzenet megjelenítése
            echo "<script>alert('Profile update failed. Please try again.');</script>";
        }
    }

    private function updateSessionData($username, $first_name, $last_name, $email) {
        $_SESSION['user_username'] = $username;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_firstname'] = $first_name;
        $_SESSION['user_lastname'] = $last_name;
    }

    private function redirectToProfilePage() {
        header("Location: ../../Frontend/user_area/profilepage.php");
        exit();
    }
}

// A ProfileController osztály példányosítása és a kérés kezelése
$profileController = new ProfileController();
$profileController->handleRequest();

?>
