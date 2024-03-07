<?php
//Adatbázis kapcsolat létrehozása
require_once __DIR__ . '/../includes/Database.php';

class CartModel {
    private $db;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }

    public function addOrUpdateProductInCart($userId, $productId, $quantity = 1) {
        // Először ellenőrizzük, hogy van-e már ilyen termék a kosárban
        $stmt = $this->db->prepare("SELECT * FROM carts WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Ha már van, akkor növeljük a mennyiséget
            $cartItem = $result->fetch_assoc();
            $newQuantity = $cartItem['quantity'] + $quantity;
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


    public function deleteCartItem($userId, $productId) {
        $stmt = $this->db->prepare("DELETE FROM carts WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $userId, $productId);
        return $stmt->execute();
    }
    
}
