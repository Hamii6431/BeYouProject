<?php

require_once __DIR__ . '/../models/CartModel.php';
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/UserModel.php';

session_start();

class CartController {
    private $cartModel;
    private $productModel;
    private $userModel;

    public function __construct(CartModel $cartModel, UserModel $userModel, ProductModel $productModel) {
        $this->cartModel = $cartModel;
        $this->userModel = $userModel;
        $this->productModel = $productModel;
    }

    // GET kérések kezelése
    public function handleGetRequest() {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'displayCartItems':
                    $this->displayCartItems();
                    break;
                default:
                    echo json_encode(['status' => 'error', 'message' => 'Invalid GET action']);
                    break;
            }
        }
    }
    
    // POST kérések kezelése
    public function handlePostRequest() {
        if (isset($_POST['action'])) {
            if (isset($_SESSION['user_id'])) { // Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
                $userId = $_SESSION['user_id'];
                switch ($_POST['action']) {
                    case 'addToCart':
                        $this->addToCart();
                        break;
                    case 'deleteCartItem':
                        $productId = $_POST['product_id'] ?? null;
                        if ($productId) {
                            $response = $this->deleteCartItem($userId, $productId);
                            echo json_encode($response);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Product ID is missing']);
                        }
                        break;
                    case 'updateQuantityInCart':
                        $this->updateQuantityInCart();
                        break;
                    case 'calculateCartSummary':
                        $this->calculateCartSummary();
                        break;
                    default:
                        echo json_encode(['status' => 'error', 'message' => 'Invalid POST action']);
                        break;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No action specified']);
        }
    }

    // Kosárban lévő termékek lekérése
    private function displayCartItems() {
        if ($this->userModel->isUserLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $cartItems = $this->cartModel->getCartItemsByUserId($userId);

            // Ha a kosár üres, adjunk vissza egy üres tömböt
            if ($cartItems === null) {
                $cartItems = [];
            }

            echo json_encode(['status' => 'success', 'cartItems' => $cartItems]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
    }


// Termék hozzáadása a kosárhoz
private function addToCart() {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'] ?? null;
    $quantity = $_POST['quantity'] ?? 1;

    // Ellenőrizzük, hogy van-e elegendő mennyiség a készleten
    $currentStock = $this->productModel->getStock($productId);
    if ($currentStock !== null && $currentStock >= $quantity) {
        if ($productId && $this->cartModel->addOrUpdateProductInCart($userId, $productId, $quantity)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Not enough stock available']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Not enough stock available', 'currentStock' => $currentStock]);
    }
}


// Mennyiség módosítása a kosárban
private function updateQuantityInCart() {
    if ($this->userModel->isUserLoggedIn()) {
        $userId = $_SESSION['user_id'];
        $productId = $_POST['product_id'] ?? null;
        $newQuantity = $_POST['new_quantity'] ?? 1;

        // Ellenőrizzük, hogy van-e elegendő mennyiség a készleten
        $currentStock = $this->productModel->getStock($productId);
        if ($newQuantity <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid quantity']);
        } elseif ($currentStock >= $newQuantity) {
            if ($productId && $this->cartModel->updateQuantityInCart($userId, $productId, $newQuantity)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update quantity in cart']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Not enough stock available']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    }
}


    // Termék törlése a kosárból
    public function deleteCartItem($userId, $productId) {
        if ($this->userModel->isUserLoggedIn()) {
            if ($this->cartModel->deleteCartItem($userId, $productId)) {
                return ['status' => 'success'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to delete product from cart'];
            }
        } else {
            return ['status' => 'error', 'message' => 'User not logged in'];
        }
    }

    private function calculateCartSummary() {
        if ($this->userModel->isUserLoggedIn()) {
            $userId = $_SESSION['user_id'];
            $cartItems = $this->cartModel->getCartItemsByUserId($userId);
            
            // Ellenőrizzük, hogy $cartItems null-e, és ha igen, akkor adjunk vissza egy üres tömböt
            if ($cartItems === null) {
                $cartItems = [];
            }
            
            // Subtotal kiszámítása
            $subtotal = array_reduce($cartItems, function ($carry, $item) {
                return $carry + ($item['quantity'] * $item['price']);
            }, 0);
    
            // Szállítási költség kiszámítása
            $shippingCost = $subtotal > 0 ? 5.00 : 0; // Például fix 5.00, ha van termék
    
            // Teljes összeg kiszámítása
            $total = $subtotal + $shippingCost;
    
            // Adatok visszaküldése
            echo json_encode([
                'status' => 'success',
                'subtotal' => $subtotal,
                'shippingCost' => $shippingCost,
                'total' => $total
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        }
    }
}

// A kéréstípustól függően hívjuk meg a megfelelő metódust
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new CartController(new CartModel(), new UserModel(), new ProductModel());
    $controller->handleGetRequest();
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new CartController(new CartModel(), new UserModel(), new ProductModel());
    $controller->handlePostRequest();
}

?>