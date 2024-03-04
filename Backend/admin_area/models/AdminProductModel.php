<?php
require_once '../../includes/Database.php'; // Feltételezzük, hogy a Database osztály már létezik

class AdminProductModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertProduct($product_name, $price, $description, $stock, $color_id, $type_id, $material_id, $default_image_url) {
        $sql = "INSERT INTO products (product_name, price, description, stock, color_id, type_id, material_id, default_image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sdisiiis", $product_name, $price, $description, $stock, $color_id, $type_id, $material_id, $default_image_url);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function getColors() {
        $sql = "SELECT color_id, color_name FROM colors";
        $result = $this->db->query($sql);
        $colors = [];
        while ($row = $result->fetch_assoc()) {
            $colors[] = $row;
        }
        return $colors;
    }

    public function getTypes() {
        $sql = "SELECT type_id, type_name FROM types";
        $result = $this->db->query($sql);
        $types = [];
        while ($row = $result->fetch_assoc()) {
            $types[] = $row;
        }
        return $types;
    }

    public function getMaterials() {
        $sql = "SELECT material_id, material_name FROM materials";
        $result = $this->db->query($sql);
        $materials = [];
        while ($row = $result->fetch_assoc()) {
            $materials[] = $row;
        }
        return $materials;
    }
}
