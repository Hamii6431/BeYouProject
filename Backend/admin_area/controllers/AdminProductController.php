<?php
require_once '../models/AdminProductModel.php'; // Biztosítsd, hogy az útvonal helyes legyen

class AdminProductController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function handleProductInsert($postData, $fileData) {
        // Képfeltöltés logikája
        $default_image_url = $this->uploadImage($fileData['product_image']);

        // Adatok átadása a modellnek a beszúráshoz
        return $this->model->insertProduct(
            $postData['product_name'],
            $postData['product_price'],
            $postData['product_desc'],
            $postData['product_stock'],
            $postData['product_gemstone'],
            $postData['product_type'],
            $postData['product_material'],
            $default_image_url
        );
    }

    private function uploadImage($image) {
        $targetDirectory = "uploads/"; // Célmappa, biztosítsd, hogy létezik és írható
        $targetFile = $targetDirectory . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $targetFile);
        return $targetFile; // Itt térünk vissza a kép elérési útjával
    }

    // Egy metódus, ami lekéri és visszaadja az összes szükséges dinamikus adatot (színek, típusok, anyagok)
    public function getFormData() {
        return [
            'gemstones' => $this->model->getgemstones(),
            'types' => $this->model->getTypes(),
            'materials' => $this->model->getMaterials()
        ];
    }
}
