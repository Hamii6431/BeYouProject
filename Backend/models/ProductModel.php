<?php
require_once __DIR__ . '/../includes/connect.php';

class ProductModel {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getFilteredProducts($types = [], $colors = [], $materials = []) {
        $conditions = [];
        $params = [];

        if (!empty($types)) {
            $conditions[] = "type_ID IN (" . implode(',', array_fill(0, count($types), '?')) . ")";
            $params = array_merge($params, $types);
        }
        if (!empty($colors)) {
            $conditions[] = "color_ID IN (" . implode(',', array_fill(0, count($colors), '?')) . ")";
            $params = array_merge($params, $colors);
        }
        if (!empty($materials)) {
            $conditions[] = "material_ID IN (" . implode(',', array_fill(0, count($materials), '?')) . ")";
            $params = array_merge($params, $materials);
        }

        $sql = "SELECT * FROM products";
        if ($conditions) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>