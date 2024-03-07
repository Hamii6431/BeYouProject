<?php
require_once __DIR__ . '/../models/CartModel.php';
require_once __DIR__ . '/../models/SessionModel.php';

session_start();

class CartController {
    private $cartModel;
    private $sessionModel;

    public function __construct() {
        $this->cartModel = new CartModel();
        $this->sessionModel = new SessionModel();
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
                // Itt jöhetnek további POST esetek kezelése
                default:
                    echo json_encode(['status' => 'error', 'message' => 'Invalid POST action']);
                    break;
            }
        }
    }

    // DELETE kérések kezelése
    public function handleDeleteRequest() {
        parse_str(file_get_contents("php://input"), $_DELETE);

        if (isset($_DELETE['action'])) {
            switch ($_DELETE['action']) {
                case 'deleteCartItem':
                    $this->deleteCartItem();
                    break;
                // Itt jöhetnek további DELETE esetek kezelése
                default:
                    echo json_encode(['status' => 'error', 'message' => 'Invalid DELETE action']);
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

    private function deleteCartItem() {
        if ($this->sessionModel->isUserLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $productId = $_DELETE['product_id'] ?? null;

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
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $controller->handleDeleteRequest();
}
?>
