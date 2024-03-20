<?php
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../includes/Database.php'; // Feltételezve, hogy van egy Database osztályod

class ProductController {
    private $model;

    public function __construct() {
        // Adatbázis kapcsolat előkészítése
        $dbInstance = Database::getInstance();
        $dbConnection = $dbInstance->getConnection();

        $this->model = new ProductModel($dbConnection);
    }

    //Szűrők lekérése
    public function index() {
        $types = isset($_GET['types']) ? $_GET['types'] : [];
        $colors = isset($_GET['colors']) ? $_GET['colors'] : [];
        $materials = isset($_GET['materials']) ? $_GET['materials'] : [];

        $filteredProducts = $this->model->getFilteredProducts($types, $colors, $materials);

        header('Content-Type: application/json');
        echo json_encode($filteredProducts);
    }

    // Termékek lekérése termék ID alapján.
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

// ProductController példány létrehozása
$productController = new ProductController();

// Meghatározzuk, melyik metódust kell meghívni az URL alapján
if (isset($_GET['action']) && $_GET['action'] == 'getProductDetails') {
    $productController->getProductDetails();
} else {
    $productController->index();
}

?>
