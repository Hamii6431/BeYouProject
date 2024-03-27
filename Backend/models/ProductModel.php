<?php
//Adatbázis kapcsolat létrehozása
require_once __DIR__ . '/../includes/Database.php';

class ProductModel {
    private $db;

        // Konstruktor az adatbázis kapcsolathoz
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    //Termék lekérése [Felhasználói ID alapján]
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

    //Összes termék lekérése az adatbázisból
    public function getAllProducts(){
        $sql = "SELECT * FROM products";
        $result = $this->db->query($sql);
        $products = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = [
                    'name' => $row['product_name'],
                    'price' => $row['price'],
                    'image' => $row['default_image_url'],
                    'id' => $row['product_ID'],
                    'type' => $row['type_ID'],
                    'gemstone' => $row['gemstone_ID'],
                    'material' => $row['material_ID'],
                ];
            }
        }

        return $products;
    }
    
    //Szűrt termékek lekérése az adatbázisból
    public function getFilteredProducts($types, $gemstones, $materials) {
        $sql = "SELECT * FROM products";

        if (!empty($types) || !empty($gemstones) || !empty($materials)) {
            $sql .= " WHERE";
            $conditions = [];

            if (!empty($types)) {
                $conditions[] = " type_ID IN (" . implode(",", $types) . ")";
            }
            if (!empty($gemstones)) {
                $conditions[] = " gemstone_ID IN (" . implode(",", $gemstones) . ")";
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
                    'gemstone' => $row['gemstone_id'],
                    'material' => $row['material_id'],
                ];
            }
        }

        return $filteredProducts;
    }

    //Anyagtípusok lekérdezése
    public function getMaterials() {
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
    
    //Ékszertípusok lekérdezése
    public function getTypes() {
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

    //Drágakő típusok lekérdezése
    public function getGemstones() {
        $sql = "SELECT * FROM gemstones";
        $result = $this->db->query($sql);
        $gemstones = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gemstones[] = [
                    'id' => $row['gemstone_id'],
                    'name' => $row['gemstone_name']
                ];
            }
        }
        return $gemstones;
    }
}


?>
