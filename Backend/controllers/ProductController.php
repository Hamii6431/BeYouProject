<?php
require_once 'ProductModel.php';

class ProductController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    public function filterProducts() {
        $types = isset($_GET['types']) ? $_GET['types'] : [];
        $colors = isset($_GET['colors']) ? $_GET['colors'] : [];
        $materials = isset($_GET['materials']) ? $_GET['materials'] : [];

        $products = $this->model->getFilteredProducts($types, $colors, $materials);
        include 'views/products.php'; // Megjelenítjük a termékeket
    }
}
?>
