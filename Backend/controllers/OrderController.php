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

    public function handleRequest() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'finalizeOrder') {
            $userId = $_SESSION['user_id'];
            $totalPrice = $_POST['total_price'];
            $shippingAddressId = $this->userModel->isUserHaveAddress($userId);

            if (!$shippingAddressId) {
                echo json_encode(['status' => 'error', 'message' => 'No valid shipping address found for user']);
                return;
            }

            if ($this->cartModel->finalizeOrder($userId, $totalPrice, $shippingAddressId)) {
                // Sikeres rendelés esetén az átirányítás címét is visszaküldjük
                echo json_encode(['status' => 'success', 'message' => 'Order finalized successfully', 'redirect' => 'OrderConfirmation.php']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to finalize the order']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        }
    }
}

$orderController = new OrderController();
$orderController->handleRequest();
