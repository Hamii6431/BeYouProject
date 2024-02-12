<?php
require_once 'Database.php';

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getFilteredProducts($types, $colors, $materials) {
        $conditions = [];
        $params = [];
        $typesQuery = $colorsQuery = $materialsQuery = "";

        if (!empty($types)) {
            $typesQuery = "type_ID IN (" . str_repeat('?,', count($types) - 1) . '?)';
            $conditions[] = $typesQuery;
            $params = array_merge($params, $types);
        }

        if (!empty($colors)) {
            $colorsQuery = "color_ID IN (" . str_repeat('?,', count($colors) - 1) . '?)';
            $conditions[] = $colorsQuery;
            $params = array_merge($params, $colors);
        }

        if (!empty($materials)) {
            $materialsQuery = "material_ID IN (" . str_repeat('?,', count($materials) - 1) . '?)';
            $conditions[] = $materialsQuery;
            $params = array_merge($params, $materials);
        }

        $query = "SELECT * FROM products";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->db->prepare($query);

        if ($stmt) {
            if (!empty($params)) {
                $stmt->bind_param(str_repeat('i', count($params)), ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            $stmt->close();
            return $products;
        }
        return [];
    }
}
?>
