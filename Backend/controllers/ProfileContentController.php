<?php

session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

class ProfileContentController {
    private $userModel;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $dbConnection = $dbInstance->getConnection();
        $this->userModel = new UserModel($dbConnection);
    }

    public function loadPage() {
        $userId = $_SESSION['user_id'] ?? null;



        $userData = $this->userModel->getUserDataByUserID($userId);
        $shippingData = $this->userModel->getUserShippingDataByUserID($userId);

        if (isset($_POST['menuItemId'])) {
            $menuItemId = $_POST['menuItemId'];
            $this->renderPage($menuItemId, $userData, $shippingData, $userId);
        }
    }

    private function renderPage($menuItemId, $userData, $shippingData, $userId) {
        switch ($menuItemId) {
            case 'accountMenuItem':
                include __DIR__ . '/../../Frontend/user_area/views/accountMenuItem.php';
                break;
            case 'manageAccountForm':
                include __DIR__ . '/../../Frontend/user_area/views/manageAccountForm.php';
                break;
            case 'manageShippingForm':
                include __DIR__ . '/../../Frontend/user_area/views/manageShippingForm.php';
                break;
            case 'ordersMenuItem':
                include __DIR__ . '/../../Frontend/user_area/views/ordersMenuItem.php';
                break;
            default:
                echo "Page not found.";
                break;
        }
    }
}

$controller = new ProfileContentController();
$controller->loadPage();
