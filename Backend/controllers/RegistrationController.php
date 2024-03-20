<?php

require_once __DIR__ . '/../models/UserModel.php';

class RegistrationController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleRegistration() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->allRequiredFieldsProvided()) {
                $this->registerUser();
            } else {
                $this->sendResponse("Hiányzó mezők!", false);
            }
        } else {
            $this->sendResponse("Érvénytelen kérés!", false);
        }
    }

    private function isAjaxRequest() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    private function allRequiredFieldsProvided() {
        return isset($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_again'], $_POST['terms']);
    }

    private function registerUser() {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordAgain = $_POST['password_again'];

        if ($this->userModel->passwordsMatch($password, $passwordAgain)) {
            $registrationResult = $this->userModel->registerUser($first_name, $last_name, $username, $email, $password);
            $this->sendResponse($registrationResult, $registrationResult === "Registration successful.");
        } else {
            $this->sendResponse("Passwords do not match.", false);
        }
    }

    private function sendResponse($message, $isSuccess) {
        $response = ['status' => $isSuccess ? 'success' : 'error', 'message' => $message];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}

$registrationController = new RegistrationController();
$registrationController->handleRegistration();

?>
