<?php
//Adatbázis kapcsolat létrehozása
require_once __DIR__ . '/../includes/Database.php';

class CartModel {
    private $db;

    // Konstruktor az adatbázis kapcsolathoz
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

// Hozzáadás vagy mennyiség növelése a kosárban.
public function addOrUpdateProductInCart($userId, $productId, $quantity = 1) {
    // Ellenőrizzük, hogy van-e elegendő mennyiség a készleten
    $currentStock = $this->getStock($productId);
    if ($currentStock !== null && $currentStock < $quantity) {
        return false; // Nem lehet hozzáadni a kosárhoz, mert nincs elegendő készlet
    }

    // Először ellenőrizzük, hogy van-e már ilyen termék a kosárban
    $stmt = $this->db->prepare("SELECT * FROM carts WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ha már van, akkor növeljük a mennyiséget
        $cartItem = $result->fetch_assoc();
        $newQuantity = $cartItem['quantity'] + $quantity;

        // Ellenőrizzük, hogy a készletet nem lépjük-e túl
        if ($newQuantity > $currentStock) {
            return false; // Túl sok terméket próbálunk hozzáadni a kosárhoz
        }

        // Frissítjük a kosárban lévő mennyiséget
        $updateStmt = $this->db->prepare("UPDATE carts SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $updateStmt->bind_param("iii", $newQuantity, $userId, $productId);
        return $updateStmt->execute();
    } else {
        // Ha még nincs, akkor új elemet hozunk létre
        $insertStmt = $this->db->prepare("INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insertStmt->bind_param("iii", $userId, $productId, $quantity);
        return $insertStmt->execute();
    }
}

    // Készlet lekérdezése
    public function getStock($productId) {
        $query = "SELECT stock FROM products WHERE product_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result->num_rows > 0) ? $result->fetch_assoc()['stock'] : 0;
    }

    //Felhasználóhoz tartozó kosár lekérése [Felhasználói ID alapján]
    public function getCartItemsByUserId($userId) {
        $stmt = $this->db->prepare("SELECT c.product_id, c.quantity, p.product_name, p.price, p.default_image_url FROM carts c INNER JOIN products p ON c.product_id = p.product_id WHERE c.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $cartItems = [];
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
        }
        $stmt->close();
        return $cartItems;
    }

    //Termék eltávolítása a kosárból
    public function deleteCartItem($userId, $productId) {
        $stmt = $this->db->prepare("DELETE FROM carts WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $userId, $productId);
        return $stmt->execute();
    }
    
    //Termék mennyiségének módosítása a kosárban.
    public function updateQuantityInCart($userId, $productId, $newQuantity) {
        $updateStmt = $this->db->prepare("UPDATE carts SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $updateStmt->bind_param("iii", $newQuantity, $userId, $productId);
        return $updateStmt->execute();
    }




    // Új rendelés létrehozása és a kosár tartalmának áthelyezése
    public function finalizeOrder($userId, $totalPrice, $shippingAddressId) {
        $this->db->begin_transaction();
        try {
            // Létrehozzuk a végleges rendelést
            $stmt = $this->db->prepare("INSERT INTO final_orders (user_id, total_price, status, shipping_address_id) VALUES (?, ?, 'Processing', ?)");
            $stmt->bind_param("idi", $userId, $totalPrice, $shippingAddressId);
            $stmt->execute();
            $finalOrderId = $this->db->insert_id;

            // Áthelyezzük a kosár tartalmát a végleges rendelés tételekhez
            $stmt = $this->db->prepare("INSERT INTO final_order_items (final_order_id, product_id, quantity, total_price) SELECT ?, product_id, quantity, (SELECT price FROM products WHERE product_id = carts.product_id) * quantity FROM carts WHERE user_id = ?");
            $stmt->bind_param("ii", $finalOrderId, $userId);
            $stmt->execute();

            // Ürítjük a kosarat
            $stmt = $this->db->prepare("DELETE FROM carts WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollback();
            return false;
        }
    }



}


?>


