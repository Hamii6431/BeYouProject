<?php

require_once __DIR__ . '/../models/UserModel.php';

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login($loginUsername, $loginPassword) {
        if ($this->userModel->verifyPassword($loginUsername, $loginPassword)) {
            session_start();
            $userData = $this->userModel->getUserDataByUsername($loginUsername);
            if ($userData) {
                $_SESSION['session_username'] = $userData['username'];
                $_SESSION['session_user_id'] = $userData['user_ID'];
                $_SESSION['session_name'] = $userData['name'];
                $_SESSION['session_gender'] = $userData['gender'];
                $_SESSION['session_birthdate'] = $userData['birthdate'];
                $_SESSION['session_email'] = $userData['email'];
                $_SESSION['session_phone_number'] = $userData['phone_number'];
                
                // Átirányítás a profil oldalra
                header("Location: ../../Frontend/user_area/profilepage.php");
                exit();
            } else {
                echo "<script>alert('User data fetch failed. Please try again.')</script>";
            }
        } else {
            echo "<script>alert('Invalid username or password. Please try again.')</script>";
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../../Frontend/loginpage.php");
        exit();
    }
}
