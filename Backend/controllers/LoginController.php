<?php
session_start(); // Session indítása
require_once '../../Backend/models/UserModel.php';

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->areCredentialsProvided()) {
            $this->attemptLogin();
        } else {
            $this->redirectWithMessage('../../Frontend/user_area/LoginPage.html', 'invalid_request');
        }
    }

    private function areCredentialsProvided() {
        return isset($_POST['login_username'], $_POST['login_password']);
    }

    private function attemptLogin() {
        $loginUsername = $_POST['login_username'];
        $loginPassword = $_POST['login_password'];

        $loginResult = $this->userModel->verifyPassword($loginUsername, $loginPassword);

        if ($loginResult) {
            if ($loginResult['type'] === 'admin') {
                $this->setAdminSessionVariablesAndRedirect($loginResult['data']);
            } else {
                $this->setUserSessionVariablesAndRedirect($loginResult['data']);
            }
        } else {
            $this->redirectWithMessage('../../Frontend/user_area/LoginPage.html', 'invalid_login');
        }
    }

    private function setUserSessionVariablesAndRedirect($userData) {
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['user_username'] = $userData['username'];
        $_SESSION['user_email'] = $userData['email'];
        $_SESSION['user_firstname'] = $userData['first_name'];
        $_SESSION['user_lastname'] = $userData['last_name'];
        $_SESSION['logged_in'] = true;

        $this->sendResponse('success', '../../Frontend/user_area/ProfilePage.php');
    }

    private function setAdminSessionVariablesAndRedirect($adminData) {
        $_SESSION['admin_id'] = $adminData['admin_id'];
        $_SESSION['admin_username'] = $adminData['admin_username'];
        $_SESSION['admin_email'] = $adminData['admin_email'];
        $_SESSION['admin_firstname'] = $adminData['admin_first_name'];
        $_SESSION['admin_lastname'] = $adminData['admin_last_name'];
        $_SESSION['logged_in'] = true;

        $this->sendResponse('success', '../../Frontend/admin_area/AdminDashboard.php');
    }

    private function redirectWithMessage($url, $message) {
        header("Location: $url?message=$message");
        exit();
    }

    private function sendResponse($status, $redirectUrl) {
        header('Content-Type: application/json');
        echo json_encode(['status' => $status, 'redirectUrl' => $redirectUrl]);
        exit();
    }
}

$loginController = new LoginController();
$loginController->handleRequest();
?>
