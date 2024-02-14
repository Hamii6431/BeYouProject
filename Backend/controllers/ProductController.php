
<?php
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../includes/connect.php';

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