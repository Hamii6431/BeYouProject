<?php
require_once __DIR__ . '/../models/ProductModel.php';

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function getFilters()
    {
        $filters = $this->productModel->getFilters();
        header('Content-Type: application/json');
        echo json_encode($filters);
    }

    public function index()
    {
        $types = isset($_GET['types']) ? $_GET['types'] : [];
        $colors = isset($_GET['colors']) ? $_GET['colors'] : [];
        $materials = isset($_GET['materials']) ? $_GET['materials'] : [];

        $filteredProducts = $this->productModel->getFilteredProducts($types, $colors, $materials);

        header('Content-Type: application/json');
        echo json_encode($filteredProducts);
    }
}

$controller = new ProductController();

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'getFilters') {
        $controller->getFilters();
    } elseif ($_GET['action'] === 'index') {
        $controller->index();
    }
}
?>
