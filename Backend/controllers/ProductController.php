<?php
require_once __DIR__ . '/../models/ProductModel.php';


// Adatbázis kapcsolat előkészítése
$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();

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

// ProductController példány létrehozása és index metódus meghívása
$productController = new ProductController();
$productController->index();
?>
