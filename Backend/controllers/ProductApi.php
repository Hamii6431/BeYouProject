<?php
require_once __DIR__ . '/../models/ProductModel.php';

class API {
    public function getFilters() {
        // Hasonlóan a kérdésben megadott kódrészlethez, de a ProductModel használatával
        $productModel = new ProductModel();
        $materials = $productModel->getMaterials();
        $types = $productModel->getTypes();
        $colors = $productModel->getColors();

        $response = [
            'materials' => $materials,
            'types' => $types,
            'colors' => $colors
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getFilteredProducts($types, $colors, $materials) {
        $productModel = new ProductModel();
        $filteredProducts = $productModel->getFilteredProducts($types, $colors, $materials);

        header('Content-Type: application/json');
        echo json_encode($filteredProducts);
    }
}

// URL routing
$action = isset($_GET['action']) ? $_GET['action'] : null;
$api = new API();

switch ($action) {
    case 'getFilters':
        $api->getFilters();
        break;
    case 'getFilteredProducts':
        $types = isset($_GET['types']) ? $_GET['types'] : [];
        $colors = isset($_GET['colors']) ? $_GET['colors'] : [];
        $materials = isset($_GET['materials']) ? $_GET['materials'] : [];
        $api->getFilteredProducts($types, $colors, $materials);
        break;
    default:
        // Handle invalid actions
        break;
}
?>
