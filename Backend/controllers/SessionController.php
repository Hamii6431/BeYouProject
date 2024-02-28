<?php

require_once __DIR__ . '/../models/SessionModel.php';

class SessionController {
    private $model;

    public function __construct() {
        $this->model = new SessionModel();
    }

    public function handleRequest() {
        if ($_POST['action'] == 'checkSessionAjax') {
            $this->checkSessionAjax();
        } elseif ($_POST['action'] == 'logout') {
            $this->logout();
        }
    }

    private function checkSessionAjax() {
        header('Content-Type: application/json');
        $isLoggedIn = $this->model->isUserLoggedIn();
        echo json_encode(['isLoggedIn' => $isLoggedIn]);
        exit();
    }

    private function logout() {
        session_start();
        session_unset();
        session_destroy();
        exit();
    }
}

$controller = new SessionController();
$controller->handleRequest();

?>
