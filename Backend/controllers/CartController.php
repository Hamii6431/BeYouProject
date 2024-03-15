<?php
require_once __DIR__ . '/../models/CartModel.php';
require_once __DIR__ . '/../models/UserModel.php';

session_start();

class CartController {
    private $cartModel;
    private $sessionModel;

    public function __construct() {
        $this->cartModel = new CartModel();
        $this->sessionModel = new UserModel();
    }

    // GET kérések kezelése
    public function handleGetRequest() {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'displayCartItems':
                    $this->displayCartItems();
                    break;
                // Itt jöhetnek további GET esetek kezelése
                default:
                    echo json_encode(['status' => 'error', 'message' => 'Invalid GET action']);
                    break;
            }
        }
    }
    
    // POST kérések kezelése
    public function handlePostRequest() {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'addToCart':
                    $this->addToCart();
                    break;
                case 'deleteCartItem':
                    $this->deleteCartItem();
                    break;
                case 'updateQuantityInCart':
                    $this->updateQuantityInCart();
                    break;
                default:
                    echo json_encode(['status' => 'error', 'message' => 'Invalid POST action']);
                    break;
            }
        }
    }

    private function displayCartItems() {
        if ($this->sessionModel->isUserLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $cartItems = $this->cartModel->getCartItemsByUserId($userId);
            echo json_encode(['status' => 'success', 'cartItems' => $cartItems]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
    }

    private function addToCart() {
        if ($this->sessionModel->isUserLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;

            if ($productId && $this->cartModel->addOrUpdateProductInCart($userId, $productId, $quantity)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add product to cart']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
    }

    private function updateQuantityInCart() {
        if ($this->sessionModel->isUserLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'] ?? null;
            $newQuantity = $_POST['new_quantity'] ?? 1;

            if ($productId && $this->cartModel->updateQuantityInCart($userId, $productId, $newQuantity)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update quantity in cart']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
    }

    private function deleteCartItem() {
        if ($this->sessionModel->isUserLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $productId = $_POST['product_id'] ?? null;

            if ($productId && $this->cartModel->deleteCartItem($userId, $productId)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete product from cart']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
    }
}

$controller = new CartController();
// A kéréstípustól függően hívjuk meg a megfelelő metódust
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->handleGetRequest();
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handlePostRequest();
}
?>
