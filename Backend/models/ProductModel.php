<?php
//Adatbázis kapcsolat létrehozása
require_once __DIR__ . '/../includes/Database.php';

class ProductModel {
    private $db;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }
    
    public function getProductById($productId) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Visszaadja a termék adatait asszociatív tömbként
        } else {
            return null; // Nincs ilyen termék
        }
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
                    'color' => $row['color_ID'],
                    'material' => $row['material_ID'],
                ];
            }
        }

        return $products;
    }
    
    public function getFilteredProducts($types, $colors, $materials) {
        $sql = "SELECT * FROM products";

        if (!empty($types) || !empty($colors) || !empty($materials)) {
            $sql .= " WHERE";
            $conditions = [];

            if (!empty($types)) {
                $conditions[] = " type_ID IN (" . implode(",", $types) . ")";
            }
            if (!empty($colors)) {
                $conditions[] = " color_ID IN (" . implode(",", $colors) . ")";
            }
            if (!empty($materials)) {
                $conditions[] = " material_ID IN (" . implode(",", $materials) . ")";
            }

            $sql .= implode(" AND ", $conditions);
        }

        $result = $this->db->query($sql);
        $filteredProducts = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filteredProducts[] = [
                    'name' => $row['product_name'],
                    'price' => $row['price'],
                    'image' => $row['default_image_url'],
                    'id' => $row['product_id'],
                    'type' => $row['type_id'],
                    'color' => $row['color_id'],
                    'material' => $row['material_id'],
                ];
            }
        }

        return $filteredProducts;
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
                    'id' => $row['material_id'],
                    'name' => $row['material_name']
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
                    'id' => $row['type_id'],
                    'name' => $row['type_name']
                ];
            }
        }
        return $types;
    }

    public function getColors() {
        // Ide írd be a colors lekérdezést az adatbázisból
        // Példa:
        $sql = "SELECT * FROM colors";
        $result = $this->db->query($sql);
        $colors = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $colors[] = [
                    'id' => $row['color_id'],
                    'name' => $row['color_name']
                ];
            }
        }
        return $colors;
    }
}


?>
