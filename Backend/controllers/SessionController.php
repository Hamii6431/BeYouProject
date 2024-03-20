<?php
require_once __DIR__ . '/../models/UserModel.php';
session_start();
class SessionController {
    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    //Aktív session állapot vizsgálata
    public function checkSessionAjax() {
        $isLoggedIn = $this->model->isUserLoggedIn();
        echo json_encode(['isLoggedIn' => $isLoggedIn]);
        exit();
    }

    //Kijelentkezés funkció
    public function logout() {
        session_unset();
        session_destroy();
        echo json_encode(['redirectUrl' => '../user_area/Logout.html']); // Módosítva .php-ról .html-re
        exit();
    }

    //Kiválasztjuk a megfelelő funkciót
    public function handleRequest() {
        $action = $_POST['action'] ?? '';
        switch ($action) {
            case 'checkSessionAjax':
                $this->checkSessionAjax();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                echo json_encode(['error' => 'Invalid action']);
                exit();
        }
    }
}

$controller = new SessionController();
$controller->handleRequest();
?>
