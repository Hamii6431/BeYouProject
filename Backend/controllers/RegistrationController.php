<?php

require_once __DIR__ . '/../models/UserModel.php';

class RegistrationController {
    private $userModel;

    public function __construct($userModel = null) {
        if ($userModel === null) {
            $this->userModel = new UserModel();
        } else {
            $this->userModel = $userModel;
        }
    }

    //Regisztrációs adatok validálása és a felhasználó regisztrálása.
    public function handleRegistration() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (!$this->allRequiredFieldsProvided()) {
                    throw new Exception("Please fill all required fields.");
                }
                
                if (!isset($_POST['terms'])) {
                    throw new Exception("Please accept the Terms and Conditions.");
                }
                
                if (!$this->isUsernameValid($_POST['username'])) {
                    throw new Exception("Invalid username format.");
                }

                if (!$this->isEmailValid($_POST['email'])) {
                    throw new Exception("Invalid email format.");
                }

                if (strlen($_POST['password']) < 6) {
                    throw new Exception("Password must be at least 6 characters long.");
                }

                if ($_POST['password'] !== $_POST['password_again']) {
                    throw new Exception("Passwords do not match.");
                }

                $this->registerUser();
            } catch (Exception $e) {
                $this->sendResponse($e->getMessage(), false);
            }
        } else {
            $this->sendResponse("Invalid request!", false);
        }
    }

    //Kitöltöttség ellenőrzése.
    private function allRequiredFieldsProvided() {
        $fields = ['first_name', 'last_name', 'username', 'email', 'password', 'password_again', 'terms'];
    
        foreach ($fields as $field) {
            if (empty($_POST[$field])) {
                return false;
            }
        }
    
        return true;
    }

    //Felhasználónév validálása
    private function isUsernameValid($username) {
        return preg_match('/^[a-zA-Z0-9_]+$/', $username);
    }

    //Emailcím validálása
    private function isEmailValid($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    //Felhasználónév és emailcím foglaltságának ellenőrzése és felhasználó regisztrálása.
    private function registerUser() {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($this->userModel->isUsernameTaken($username)) {
            $this->sendResponse("Username is already taken.", false);
        }

        if ($this->userModel->isEmailTaken($email)) {
            $this->sendResponse("Email is already taken.", false);
        }

        $registrationResult = $this->userModel->registerUser($first_name, $last_name, $username, $email, $password);

        $this->sendResponse($registrationResult, $registrationResult === "Registration successful.");
    }

    private function sendResponse($message, $isSuccess) {
        $response = ['status' => $isSuccess ? 'success' : 'error', 'message' => $message];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $registrationController = new RegistrationController();
    $registrationController->handleRegistration();
}
?>
