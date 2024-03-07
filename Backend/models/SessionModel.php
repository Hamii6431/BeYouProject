<?php
require_once __DIR__ . '/../includes/Database.php';


class SessionModel {
    public function isUserLoggedIn() {
        // Ellenőrizzük, hogy a 'logged_in' session változó létezik-e és igaz értékű-e
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
}



?>
