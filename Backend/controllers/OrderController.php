<?php
require_once __DIR__ . '/../models/CartModel.php';
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class OrderController {
    private $cartModel;
    private $productModel;
    private $userModel;

    public function __construct() {
        $this->cartModel = new CartModel();
        $this->productModel = new productModel();
        $this->userModel = new UserModel();
    }

    //Kérések kezelése
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

    //Rendelés véglegesítése.
    private function finalizeOrder() {
        $userId = $_SESSION['user_id'];
        $totalPrice = $_POST['total_price'];
        $shippingAddressId = $this->userModel->isUserHaveAddress($userId);

        if (!$shippingAddressId) {
            echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
            return;
        }

        // Lekérjük a kosárban lévő termékeket és azok mennyiségét
        $cartItems = $this->cartModel->getCartItemsByUserId($userId);

        // Ellenőrizzük, hogy van-e elegendő mennyiség a készleten
        foreach ($cartItems as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];
            $currentStock = $this->productModel->getStock($productId);

            // Ha a készlet elegendő
            if ($currentStock >= $quantity) {
                // Kivonjuk a rendelt mennyiséget a készletből
                $this->productModel->updateStock($productId, -$quantity);
            } else {
                // Ha a készlet nem elegendő, hibaüzenet és kilépés
                echo json_encode(['status' => 'error', 'message' => 'Insufficient stock for product: ' . $item['product_name']]);
                return;
            }
        }

        // Véglegesítjük a rendelést
        if ($this->cartModel->finalizeOrder($userId, $totalPrice, $shippingAddressId)) {
            echo json_encode(['status' => 'success', 'message' => 'Order finalized successfully', 'redirect' => 'OrderConfirmation.html']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to finalize the order']);
        }
    }

    //Kérés kezelés.
    private function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}

$orderController = new OrderController();
$orderController->handleRequest();
?>
