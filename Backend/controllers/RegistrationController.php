<?php

// UserModel.php modell osztály beolvasása
require_once __DIR__ . '/../models/UserModel.php';

// Regisztrációs kontroller osztály definiálása
class RegistrationController {
    private $userModel;

    // Osztály konstruktorának definiálása
    public function __construct() {
        // UserModel példányosítása
        $this->userModel = new UserModel();
    }

    // Regisztrációs folyamat kezelése
    public function handleRegistration() {
        // Ellenőrizzük, hogy POST kérés érkezett-e
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ellenőrizzük, hogy az összes kötelező mezőt kitöltötték-e
            if ($this->allRequiredFieldsProvided()) {
                // Ellenőrizzük, hogy elfogadták-e a feltételeket
                if (!isset($_POST['terms'])) {
                    $this->sendResponse("Please accept the Terms and Conditions.", false);
                } else {
                    // Ellenőrizzük a felhasználónév formátumát
                    if (!$this->isUsernameValid($_POST['username'])) {
                        $this->sendResponse("Invalid username format.", false);
                        return;
                    }

                    // Ellenőrizzük az email cím formátumát
                    if (!$this->isEmailValid($_POST['email'])) {
                        $this->sendResponse("Invalid email format.", false);
                        return;
                    }

                    // Ellenőrizzük a jelszó hosszát
                    if (strlen($_POST['password']) < 6) {
                        $this->sendResponse("Password must be at least 6 characters long.", false);
                        return;
                    }

                    // Ellenőrizzük, hogy a jelszavak egyeznek-e
                    if (!$this->userModel->passwordsMatch($_POST['password'], $_POST['password_again'])) {
                        $this->sendResponse("Passwords do not match.", false);
                        return;
                    }

                    // Ha minden ellenőrzés sikeres, regisztráljuk a felhasználót
                    $this->registerUser();
                }
            } else {
                $this->sendResponse("Please fill all required fields.", false);
            }
        } else {
            $this->sendResponse("Invalid request!", false);
        }
    }

    // Az összes kötelező mező kitöltésének ellenőrzése
    private function allRequiredFieldsProvided() {
        return isset($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_again'], $_POST['terms']);
    }

    // Felhasználónév formátumának ellenőrzése
    private function isUsernameValid($username) {
        // A felhasználónév csak betűket, számokat és aláhúzás jelet tartalmazhat
        return preg_match('/^[a-zA-Z0-9_]+$/', $username);
    }

    // Email cím formátumának ellenőrzése
    private function isEmailValid($email) {
        // Az email cím formátumának ellenőrzése filter_var függvénnyel
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    // Felhasználó regisztrálása
    private function registerUser() {
        // Felhasználó adatainak begyűjtése
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordAgain = $_POST['password_again'];

        // Ellenőrizzük, hogy a felhasználónév foglalt-e
        if ($this->userModel->isUsernameTaken($username)) {
            $this->sendResponse("Username is already taken.", false);
        }

        // Ellenőrizzük, hogy az email cím foglalt-e
        if ($this->userModel->isEmailTaken($email)) {
            $this->sendResponse("Email is already taken.", false);
        }

        // Felhasználó regisztrálása a UserModel segítségével
        $registrationResult = $this->userModel->registerUser($first_name, $last_name, $username, $email, $password);

        // Válasz küldése a regisztrációs folyamat eredményéről
        $this->sendResponse($registrationResult, $registrationResult === "Registration successful.");
    }

    // Válasz küldése
    private function sendResponse($message, $isSuccess) {
        $response = ['status' => $isSuccess ? 'success' : 'error', 'message' => $message];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

// Regisztrációs kontroller példányosítása és a regisztrációs folyamat kezelése
$registrationController = new RegistrationController();
$registrationController->handleRegistration();

?>
