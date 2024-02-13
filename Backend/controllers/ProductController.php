<?php
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../includes/connect.php';

class ProductController {
    private $model;

    public function __construct() {
        $dbInstance = Database::getInstance();
        $dbConnection = $dbInstance->getConnection();
        $this->model = new ProductModel($dbConnection);
    }

    public function handleRequest() {
        $types = $_POST['types'] ?? [];
        $colors = $_POST['colors'] ?? [];
        $materials = $_POST['materials'] ?? [];

        $products = $this->model->getFilteredProducts($types, $colors, $materials);
        require 'productsView.php'; // Betöltjük a nézetet a termékekkel
    }
}