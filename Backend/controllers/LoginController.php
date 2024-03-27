<?php
require_once '../../Backend/models/UserModel.php';

session_start();

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    //Kérés validálása és kezelése
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->areCredentialsProvided()) {
            $this->attemptLogin();
        } else {
            $this->redirectWithMessage('../../Frontend/user_area/LoginPage.html', 'invalid_request');
        }
    }

    //Űrlapról beérkező adatok validálása
    private function areCredentialsProvided() {
        return isset($_POST['login_username'], $_POST['login_password']);
    }

    //Bejelentkezés kezelése
    private function attemptLogin() {
        $loginUsername = $_POST['login_username'];
        $loginPassword = $_POST['login_password'];

        //Jelszó hitelesítése
        $loginResult = $this->userModel->verifyPassword($loginUsername, $loginPassword);

        //Jogosultsági kör kiválasztása
        if ($loginResult) {
            if ($loginResult['type'] === 'admin') {
                $this->setAdminSessionVariablesAndRedirect($loginResult['data']);
            } else {
                $this->setUserSessionVariablesAndRedirect($loginResult['data']);
            }
        } else {
            //Hibás bejelentkezés esetén a felhasználó visszairányítása és értesítés küldése.
            $this->redirectWithMessage('../../Frontend/user_area/LoginPage.html', 'invalid_login');
        }
    }

    //Felhasználói adatok beállítása és felhasználó átirányítása a profil oldalra.
    private function setUserSessionVariablesAndRedirect($userData) {
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['user_username'] = $userData['username'];
        $_SESSION['user_email'] = $userData['email'];
        $_SESSION['user_firstname'] = $userData['first_name'];
        $_SESSION['user_lastname'] = $userData['last_name'];
        $_SESSION['logged_in'] = true;

        $this->sendResponse('success', '../../Frontend/user_area/ProfilePage.html');
    }

    //Admin adatok beállítása és felhasználó átirányítása az adminisztrációs felületre.
    private function setAdminSessionVariablesAndRedirect($adminData) {
        $_SESSION['admin_id'] = $adminData['admin_id'];
        $_SESSION['admin_username'] = $adminData['admin_username'];
        $_SESSION['admin_email'] = $adminData['admin_email'];
        $_SESSION['admin_firstname'] = $adminData['admin_first_name'];
        $_SESSION['admin_lastname'] = $adminData['admin_last_name'];
        $_SESSION['logged_in'] = true;

        $this->sendResponse('success', '../../Frontend/admin_area/AdminDashboard.php');
    }

    //Hibás bejelentkezés kezelése 
    private function redirectWithMessage($url, $message) {
        header("Location: $url?message=$message");
        exit();
    }

    //Válasz küldése
    private function sendResponse($status, $redirectUrl) {
        header('Content-Type: application/json');
        echo json_encode(['status' => $status, 'redirectUrl' => $redirectUrl]);
        exit();
    }
}

$loginController = new LoginController();
$loginController->handleRequest();
?>
