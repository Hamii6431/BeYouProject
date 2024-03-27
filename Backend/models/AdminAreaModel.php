<?php
//Adatbázis kapcsolat létrehozása
require_once __DIR__ . '/../includes/Database.php';

$conn = Database::getInstance()->getConnection();

class AdminAreaModel {
    private $db;


    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }


    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        $users = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = [
                    'user_id' => $row['user_id'],
                    'username' => $row['username'],
                    'email' => $row['email'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name']
                ];
            }
        }
    
        return $users;
    }
    

    public function getAllFinalOrderItems() {
        $sql = "SELECT * FROM final_order_items";
        $result = $this->db->query($sql);
        $finalOrderItems = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $finalOrderItems[] = [
                    'final_order_item_id' => $row['final_order_item_id'],
                    'final_order_id' => $row['final_order_id'],
                    'product_id' => $row['product_id'],
                    'quantity' => $row['quantity'],
                    'total_price' => $row['total_price']
                ];
            }
        }
    
        return $finalOrderItems;
    }


    public function getAllProducts(){
        $sql = "SELECT * FROM products";
        $result = $this->db->query($sql);
        $products = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = [
                    'name' => $row['product_name'],
                    'price' => $row['price'],
                    'image' => $row['image'],
                    'id' => $row['product_ID'],
                    'type' => $row['type_ID'],
                    'gemstone' => $row['gemstone_ID'],
                    'material' => $row['material_ID'],
                ];
            }
        }

        return $products;
    }


    public function AllUsers() {
        $sql = "SELECT COUNT(*) as userCount FROM users";
        $result = $this->db->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['userCount'];
        } else {
            return 0; // Ha nincs rekord, 0-t adunk vissza
        }
    }


    public function AllFinalOrders() {
        $sql = "SELECT COUNT(*) as orderCount FROM final_orders";
        $result = $this->db->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['orderCount'];
        } else {
            return 0; // Ha nincs rekord, 0-t adunk vissza
        }
    }


    public function AllProducts() {
        $sql = "SELECT COUNT(*) as productCount FROM products";
        $result = $this->db->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['productCount'];
        } else {
            return 0; // Ha nincs rekord, 0-t adunk vissza
        }
    }


    public function AllIncome() {
        $sql = "SELECT SUM(total_price) as incomeCount FROM final_orders";
        $result = $this->db->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['incomeCount'];
        } else {
            return 0; // Ha nincs rekord, 0-t adunk vissza
        }
    }
    

    public function getMaterials() {
        // Ide írd be a materials lekérdezést az adatbázisból
        // Példa:
        $sql = "SELECT * FROM materials";
        $result = $this->db->query($sql);
        $materials = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $materials[] = [
                    'material_id' => $row['material_id'],
                    'material_name' => $row['material_name']
                ];
            }
        }
        return $materials;
    }


    public function getTypes() {
        // Ide írd be a types lekérdezést az adatbázisból
        // Példa:
        $sql = "SELECT * FROM types";
        $result = $this->db->query($sql);
        $types = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $types[] = [
                    'type_id' => $row['type_id'],
                    'type_name' => $row['type_name']
                ];
            }
        }
        return $types;
    }


    public function getgemstones() {
        // Ide írd be a gemstones lekérdezést az adatbázisból
        // Példa:
        $sql = "SELECT * FROM gemstones";
        $result = $this->db->query($sql);
        $gemstones = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gemstones[] = [
                    'gemstone_id' => $row['gemstone_id'],
                    'gemstone_name' => $row['gemstone_name']
                ];
            }
        }
        return $gemstones;
    }


    public function addProduct($product_name, $price, $description, $stock, $gemstone_id, $type_id, $material_id, $default_image_url) {
        $sql = "INSERT INTO products (product_name, price, description, stock, gemstone_id, type_id, material_id, default_image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Adatbázis hiba.'];
        }
        
        $stmt->bind_param('sdssiiis', $product_name, $price, $description, $stock, $gemstone_id, $type_id, $material_id, $default_image_url);
        
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Termék sikeresen hozzáadva.'];
        } else {
            return ['success' => false, 'message' => 'Nem sikerült hozzáadni a terméket.'];
        }
    }


    public function updateProduct($product_id, $product_name, $price, $description, $stock, $gemstone_id, $type_id, $material_id, $default_image_url) {
        $sql = "UPDATE products SET product_name=?, price=?, description=?, stock=?, gemstone_id=?, type_id=?, material_id=?, default_image_url=? WHERE product_id=?";
        $stmt = $this->db->prepare($sql);
    
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Adatbázis hiba.'];
        }
    
        $stmt->bind_param('sdssiiisi', $product_name, $price, $description, $stock, $gemstone_id, $type_id, $material_id, $default_image_url, $product_id);
    
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Termék sikeresen frissítve.'];
        } else {
            return ['success' => false, 'message' => 'Nem sikerült frissíteni a terméket.'];
        }
    }
    

    public function updateUser($user_id, $username, $email, $first_name, $last_name) {

        $sql = "UPDATE users SET username=?, email=?, first_name=?, last_name=? WHERE user_id=?";
        $stmt = $this->db->prepare($sql);
    
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Adatbázis hiba.'];
        }
    
        $stmt->bind_param('ssssi', $username, $email, $first_name, $last_name, $user_id);
    
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Termék sikeresen frissítve.'];
        } else {
            return ['success' => false, 'message' => 'Nem sikerült frissíteni a terméket.'];
        }
    }
    
    public function updateUserCount() {
        
        $sql = "SELECT user_id, username, email, first_name, last_name FROM users ORDER BY user_ID DESC LIMIT 15";
        $result = $this->db->query($sql);
        $users = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
    
        return $users;


    }

    public function getLatestUsers() {
        $sql = "SELECT user_ID, username, email, first_name, last_name FROM users ORDER BY user_ID DESC LIMIT 5";
        $result = $this->db->query($sql);
        $users = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
    
        return $users;
    }


    public function getLatestOrders() {
        $sql = "SELECT final_order_id, user_id, total_price, order_date, status, shipping_address_id FROM final_orders ORDER BY final_order_id DESC LIMIT 5";
        $result = $this->db->query($sql);
        $orders = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
    
        return $orders;
    }


    public function orderCount() {
        $sql = "SELECT final_order_id, user_id, total_price, order_date, status, shipping_address_id FROM final_orders ORDER BY final_order_id DESC LIMIT 15";
        $result = $this->db->query($sql);
        $orders = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
    
        return $orders;
    }

    
    public function getLatestProducts() {
        $sql = "SELECT product_id, product_name, price, description, stock, gemstone_id, type_id, material_id, default_image_url FROM products ORDER BY product_id DESC LIMIT 15";
        $result = $this->db->query($sql);
        $orders = [];
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
    
        return $orders;

        $sql = "SELECT * FROM gemstones";
        $result = $this->db->query($sql);
        $gemstones = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gemstones[] = [
                    'gemstone_id' => $row['gemstone_id'],
                    'gemstone_name' => $row['gemstone_name']
                ];
            }
        }
        return $gemstones;
    }
    


    


}
?>