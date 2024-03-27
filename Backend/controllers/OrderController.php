<?php

require_once __DIR__ . '/../models/CartModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class OrderController {
    private $cartModel;
    private $userModel;
    

    public function __construct() {
        $this->cartModel = new CartModel();
        $this->userModel = new UserModel();
    }

    //Kérés kezelése
    public function handleRequest() {
        session_start();

        if (!$this->userModel->isUserLoggedIn()) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        if ($this->isPostRequest() && $_POST['action'] === 'finalizeOrder') {
            $this->finalizeOrder();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        }
    }

    //Rendelés véglegesítése
    private function finalizeOrder() {
        $userId = $_SESSION['user_id'];
        $totalPrice = $_POST['total_price'];
        //Szállítási adatok meglétének vizsgálata
        $shippingAddressId = $this->userModel->isUserHaveAddress($userId);

        if (!$shippingAddressId) {
            echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
            return;
        }

        //Szállítás véglegesítése és továbbítás
        if ($this->cartModel->finalizeOrder($userId, $totalPrice, $shippingAddressId)) {
            echo json_encode(['status' => 'success', 'message' => 'Order finalized successfully', 'redirect' => 'OrderConfirmation.html']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to finalize the order']);
        }
    }

    //Kérés validálása
    private function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}

$orderController = new OrderController();
$orderController->handleRequest();
?>
