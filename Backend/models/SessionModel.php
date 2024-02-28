<?php

class SessionModel {
    public function isUserLoggedIn() {
        session_start();
        return isset($_SESSION['user_id']);
    }
}

?>
