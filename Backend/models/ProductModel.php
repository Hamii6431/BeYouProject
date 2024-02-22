<?php
require_once __DIR__ . '/../includes/connect.php';

class ProductModel {
    private $db;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }

    public function getAllProducts(){
        $sql = "SELECT * FROM products";
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
                    'image' => $row['image'],
                    'id' => $row['product_ID'],
                    'type' => $row['type_ID'],
                    'color' => $row['color_ID'],
                    'material' => $row['material_ID'],
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
                    'id' => $row['material_ID'],
                    'name' => $row['material_Name']
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
                    'id' => $row['type_ID'],
                    'name' => $row['type_Name']
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
                    'id' => $row['color_ID'],
                    'name' => $row['color_Name']
                ];
            }
        }
        return $colors;
    }
}


?>
