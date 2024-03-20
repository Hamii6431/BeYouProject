<?php
require_once __DIR__ . '/../models/ProductModel.php';

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

        $this->sendJson($filters);
    }

    private function sendJson($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

$filterController = new FilterController();
$filterController->index();
