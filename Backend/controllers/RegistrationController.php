<?php
require_once __DIR__ . '/../models/UserModel.php';


class RegistrationController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function register($username, $name, $user_email, $user_password, $user_password_again,) {
        // Üres mezők ellenőrzése és jelszó egyezőségének ellenőrzése
        // Username foglaltságának ellenőrzése
        // Felhasználó regisztrálása, ha minden ellenőrzés sikeres

        // Példakód, amely a fenti logikát tartalmazza:
        if (empty($username) || empty($name) || empty($user_email) || empty($user_password) || empty($user_password_again)) {
            return 'Please fill in all fields.';
        }

        //Jelszó egyezés ellenőrzése
        if ($user_password != $user_password_again) {
            return 'Passwords do not match.';
        }

        // Felhasználónév foglaltságának ellenőrzése
        if ($this->userModel->userFinder($username)) {
            return 'Username is already taken.';
        }

        //Jelszó hashelés majd az adatok feltöltése az adatbázisba végül közöljük a felhasználóval a regisztráció állapotát
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
        if ($this->userModel->register($name, $user_email, $username, $hashed_password)) {
            return 'Registration successful.';
        } else {
            return 'Registration failed.';
        }
    }
}

?>