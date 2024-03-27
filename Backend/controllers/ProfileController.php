<?php

session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

class ProfileController {
    private $db;
    private $userModel;

    // Adatbázis kapcsolat előkészítése
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    //Kérés kezelése
    public function handleRequest() {
        if ($this->isGetRequest()) {
            $this->sendUserData();
        } else if ($this->isPostRequest()) {
            if ($this->isValidUpdateAccountRequest()) {
                $this->updateUserProfile();
            } else {
                $this->sendResponse("Invalid or missing update account action.", false);
            }
        } else {
            $this->sendResponse("Invalid request method.", false);
        }
    }

    //Get kérés ellenőrzése
    private function isGetRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    //Post kérés ellenőrzése
    private function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    //Felhasználói adatok elküldése
    private function sendUserData() {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            $this->sendResponse("User not authenticated", false);
            return;
        }
    
        $userData = $this->userModel->getUserDataByUserID($userId);
        if (!$userData) {
            $this->sendResponse("User data not found", false);
        } else {
            echo json_encode($userData); // Küldjük vissza a felhasználói adatokat
            exit;
        }
    }
    private function isValidUpdateAccountRequest() {
        // Ellenőrizze, hogy minden szükséges mező jelen van-e
        $requiredFields = ['username', 'first_name', 'last_name', 'email'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                return false;
            }
        }
    
        // Ellenőrizze, hogy a felhasználónév és emailcím ugyanaz-e, mint a jelenlegi
        $userId = $_SESSION['user_id'] ?? null;
        $userData = $this->userModel->getUserDataByUserID($userId);
    
        // Ellenőrizze, hogy legalább az egyik mező változott-e
        if ($userData['username'] === $_POST['username'] && $userData['email'] === $_POST['email'] &&
            $userData['first_name'] === $_POST['first_name'] && $userData['last_name'] === $_POST['last_name']) {
            return true; // Ha nincs változás, nincs szükség további ellenőrzésre
        }
    
        // Ha csak a felhasználónév változott
        if ($userData['username'] !== $_POST['username']) {
            // Ellenőrizze, hogy a felhasználónév foglalt-e
            if ($this->userModel->isUsernameTaken($_POST['username'])) {
                $this->sendResponse("Username is already taken.", false);
            }
        }
    
        // Ha csak az email változott
        if ($userData['email'] !== $_POST['email']) {
            // Ellenőrizze, hogy az email foglalt-e
            if ($this->userModel->isEmailTaken($_POST['email'])) {
                $this->sendResponse("Email is already taken.", false);
            }
        }
    
        return true;
    }
    
    //Felhasználó adatainak frissítése
    private function updateUserProfile() {
        $userId = $_SESSION['user_id']; // A felhasználó azonosítója a munkamenetből
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $success = $this->userModel->updateUserData($userId, $username, $first_name, $last_name, $email);

        if ($success) {
            $this->updateSessionData($username, $first_name, $last_name, $email);
            $this->sendResponse("Profile updated successfully.", true);
        } else {
            $this->sendResponse("Profile update failed. Please try again.", false);
        }
    }

    //Felhasználó adatainak frissítése a Sessionben
    private function updateSessionData($username, $first_name, $last_name, $email) {
        $_SESSION['user_username'] = $username;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_firstname'] = $first_name;
        $_SESSION['user_lastname'] = $last_name;
    }

    //Válasz elküldése
    private function sendResponse($message, $isSuccess) {
        $response = ['status' => $isSuccess ? 'success' : 'error', 'message' => $message];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

$profileController = new ProfileController();
$profileController->handleRequest();

?>
