<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/AdminModel.php';

class LoginController {
    private $userModel;
    private $adminModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->adminModel = new AdminModel();
    }

    public function login($loginUsername, $loginPassword) {
        session_start();

        if ($this->attemptAdminLogin($loginUsername, $loginPassword)) {
            return;
        }

        if ($this->attemptUserLogin($loginUsername, $loginPassword)) {
            return;
        }

        $this->notifyLoginFailure();
    }

    private function attemptAdminLogin($username, $password) {
        if ($this->adminModel->verifyAdminPassword($username, $password)) {
            $adminData = $this->adminModel->getAdminDataByUsername($username);
            if ($adminData) {
                $this->initializeAdminSession($adminData);
                header("Location: ../../Frontend/admin_area/index.php");
                exit();
            }
            return true;
        }
        return false;
    }

    private function attemptUserLogin($username, $password) {
        if ($this->userModel->verifyPassword($username, $password)) {
            $userData = $this->userModel->getUserDataByUsername($username);
            if ($userData) {
                $this->initializeUserSession($userData);
                header("Location: ../../Frontend/user_area/profilepage.php");
                exit();
            }
            return true;
        }
        return false;
    }

    private function initializeAdminSession($adminData) {
        $_SESSION['admin_user_id'] = $adminData['admin_ID'];
        $_SESSION['admin_username'] = $adminData['admin_username'];
        $_SESSION['admin_name'] = $adminData['admin_name'];
        // További admin adatok tárolása szükség szerint
    }

    private function initializeUserSession($userData) {
        $_SESSION['session_user_id'] = $userData['user_ID'];
        $_SESSION['session_username'] = $userData['username'];
        $_SESSION['session_name'] = $userData['name'];
        $_SESSION['session_gender'] = $userData['gender'];
        $_SESSION['session_birthdate'] = $userData['birthdate'];
        $_SESSION['session_email'] = $userData['email'];
        $_SESSION['session_phone_number'] = $userData['phone_number'];
        
        $shippingAddresses = $this->userModel->getUserShippingAddresses($userData['user_ID']);
        $_SESSION['session_shipping_addresses'] = $shippingAddresses;
    }

    private function notifyLoginFailure() {
        echo "<script>alert('Invalid username or password. Please try again.')</script>";
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../Frontend/loginpage.php");
        exit();
    }
}
