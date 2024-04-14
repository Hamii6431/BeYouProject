<?php
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../includes/Database.php';

class ProductController {
    private $model;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $dbConnection = $dbInstance->getConnection();

        $this->model = new ProductModel($dbConnection);
    }

    //Szűrt termékek lekérése.
    public function index() {
        $types = isset($_GET['types']) ? $_GET['types'] : [];
        $gemstones = isset($_GET['gemstones']) ? $_GET['gemstones'] : [];
        $materials = isset($_GET['materials']) ? $_GET['materials'] : [];

        $filteredProducts = $this->model->getFilteredProducts($types, $gemstones, $materials);

        header('Content-Type: application/json');
        echo json_encode($filteredProducts);
    }

    //Kiválasztott termék adatainak lekérése.
    public function getProductDetails() {
        $productId = isset($_GET['productId']) ? $_GET['productId'] : null;
        if ($productId) {
            $productDetails = $this->model->getProductById($productId);

            if ($productDetails) {
                header('Content-Type: application/json');
                echo json_encode($productDetails);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Product not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing product ID']);
        }
    }
}

$productController = new ProductController();

if (isset($_GET['action']) && $_GET['action'] == 'getProductDetails') {
    $productController->getProductDetails();
} else {
    $productController->index();
}
?>
