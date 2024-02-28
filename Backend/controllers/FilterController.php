<?php
require_once __DIR__ . '/../models/ProductModel.php';


// Adatbázis kapcsolat előkészítése
$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();

class FilterController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    public function index() {
        $filters = [
            'types' => $this->model->getTypes(),
            'colors' => $this->model->getColors(),
            'materials' => $this->model->getMaterials()
        ];

        header('Content-Type: application/json');
        echo json_encode($filters);
    }
}

// FilterController példány létrehozása és index metódus meghívása
$filterController = new FilterController();
$filterController->index();
?>
