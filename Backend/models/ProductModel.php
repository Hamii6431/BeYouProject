<?php
require_once __DIR__ . '/../includes/connect.php';

class ProductModel {
    private $db;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }

    public function getFilteredProducts($types, $colors, $materials) {
        $typesStr = implode(",", $types);
        $colorsStr = implode(",", $colors);
        $materialsStr = implode(",", $materials);

        $sql = "SELECT * FROM products WHERE type_ID IN ($typesStr) AND color_ID IN ($colorsStr) AND material_ID IN ($materialsStr)";
        // Hasonlóképpen, összeállítani a többi lekérdezést

        $result = $this->db->query($sql);
        $filteredProducts = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filteredProducts[] = $row;
            }
        }

        return $filteredProducts;
    }
}

class FilterModel {
    private $db;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $this->db = $dbInstance->getConnection();
    }

    public function getFilters() {
        $materialsQuery = "SELECT * FROM materials";
        $typesQuery = "SELECT * FROM types";
        $colorsQuery = "SELECT * FROM colors";

        $materialsResult = $this->db->query($materialsQuery);
        $typesResult = $this->db->query($typesQuery);
        $colorsResult = $this->db->query($colorsQuery);

        $materials = $materialsResult->fetch_all(MYSQLI_ASSOC);
        $types = $typesResult->fetch_all(MYSQLI_ASSOC);
        $colors = $colorsResult->fetch_all(MYSQLI_ASSOC);

        return [
            'materials' => $materials,
            'types' => $types,
            'colors' => $colors
        ];
    }
}

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    public function index() {
        $types = isset($_GET['types']) ? $_GET['types'] : [];
        $colors = isset($_GET['colors']) ? $_GET['colors'] : [];
        $materials = isset($_GET['materials']) ? $_GET['materials'] : [];

        $filteredProducts = $this->model->getFilteredProducts($types, $colors, $materials);

        header('Content-Type: application/json');
        echo json_encode($filteredProducts);
    }
}

class FilterController {
    private $model;

    public function __construct() {
        $this->model = new FilterModel();
    }

    public function index() {
        $filters = $this->model->getFilters();

        header('Content-Type: application/json');
        echo json_encode($filters);
    }
}
?>
