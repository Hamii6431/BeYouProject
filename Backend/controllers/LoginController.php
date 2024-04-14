<?php
require_once __DIR__ . '/../models/UserModel.php';
session_start();

class LoginController {
    private $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    //Bejelentkezési kérés ellenőrzése.
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectWithMessage('../../Frontend/user_area/LoginPage.html', 'invalid_request');
        }
    
        if (!$this->areCredentialsProvided()) {
            $this->redirectWithMessage('../../Frontend/user_area/LoginPage.html', 'missing_credentials');
        }
    
        $loginUsername = $_POST['login_username'] ?? '';
        $loginPassword = $_POST['login_password'] ?? '';
    
        if (strlen($loginUsername) < 3 || strlen($loginPassword) < 6) {
            $this->redirectWithMessage('../../Frontend/user_area/LoginPage.html', 'invalid_credentials_length');
        }
    
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
    

    //Név és jelszó meglétének ellenőrzése.
    private function areCredentialsProvided() {
        return isset($_POST['login_username'], $_POST['login_password']);
    }

    //Felhasználói adatok beállítása a sessionben.
    private function setUserSessionVariablesAndRedirect($userData) {
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['user_username'] = $userData['username'];
        $_SESSION['user_email'] = $userData['email'];
        $_SESSION['user_firstname'] = $userData['first_name'];
        $_SESSION['user_lastname'] = $userData['last_name'];
        $_SESSION['logged_in'] = true;

        $this->sendResponse('success', '../../Frontend/user_area/ProfilePage.html');
    }

    //Admin felhasználói adatok beállítási a sessionben.
    private function setAdminSessionVariablesAndRedirect($adminData) {
        $_SESSION['admin_id'] = $adminData['admin_id'];
        $_SESSION['admin_username'] = $adminData['admin_username'];
        $_SESSION['admin_email'] = $adminData['admin_email'];
        $_SESSION['admin_firstname'] = $adminData['admin_first_name'];
        $_SESSION['admin_lastname'] = $adminData['admin_last_name'];
        $_SESSION['logged_in'] = true;

        $this->sendResponse('success', '../../Frontend/admin_area/AdminPage.php');
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

// A kéréstípustól függően hívjuk meg a megfelelő metódust
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new LoginController(new UserModel());
    $controller->handleRequest();
}
?>
