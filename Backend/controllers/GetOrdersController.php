<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

session_start();

class GetOrdersController {
    private $db;
    private $userModel;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    //Kérés kezelése
    public function handleRequest() {
        if ($this->isGetRequest()) {
            $this->sendUserOrders();
        } else {
            $this->sendResponse("Invalid request method.", false);
        }
    }

    //Get kérések validálása
    private function isGetRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    //Felhasználó korábbi rendeléseinek elküldése
    private function sendUserOrders() {
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            $this->sendResponse("User not authenticated", false);
            return;
        }

        // Itt a UserModel-ben lévő getUserLatestOrdersByUserID függvényt hívjuk meg
        $userOrders = $this->userModel->getUserLatestOrdersByUserID($userId);
        if (empty($userOrders)) {
            $this->sendResponse("Orders not found", false);
        } else {
            echo json_encode(['status' => 'success', 'orders' => $userOrders]); // Módosított válasz tömbbel
            exit;
        }
    }

    //Válasz küldése
    private function sendResponse($message, $isSuccess) {
        $response = ['status' => $isSuccess ? 'success' : 'error', 'message' => $message];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

$getOrdersController = new GetOrdersController();
$getOrdersController->handleRequest();

?>
