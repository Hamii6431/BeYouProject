<?php
// Kapcsolódás az adatbázishoz
require_once __DIR__ . '/../includes/connect.php';
$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();

// Változók inicializálása
$types = isset($_GET['types']) ? implode(",", $_GET['types']) : '';
$colors = isset($_GET['colors']) ? implode(",", $_GET['colors']) : '';
$materials = isset($_GET['materials']) ? implode(",", $_GET['materials']) : '';

// SQL lekérdezés összeállítása a szűrők alapján
if (!empty($types) && !empty($colors) && !empty($materials)) {
    $sql = "SELECT * FROM products WHERE type_ID IN ($types) AND color_ID IN ($colors) AND material_ID IN ($materials)";
} elseif (!empty($types) && !empty($colors)) {
    $sql = "SELECT * FROM products WHERE type_ID IN ($types) AND color_ID IN ($colors)";
} elseif (!empty($types) && !empty($materials)) {
    $sql = "SELECT * FROM products WHERE type_ID IN ($types) AND material_ID IN ($materials)";
} elseif (!empty($colors) && !empty($materials)) {
    $sql = "SELECT * FROM products WHERE color_ID IN ($colors) AND material_ID IN ($materials)";
} elseif (!empty($types)) {
    $sql = "SELECT * FROM products WHERE type_ID IN ($types)";
} elseif (!empty($colors)) {
    $sql = "SELECT * FROM products WHERE color_ID IN ($colors)";
} elseif (!empty($materials)) {
    $sql = "SELECT * FROM products WHERE material_ID IN ($materials)";
} else {
    $sql = "SELECT * FROM products";
}

// Lekérdezés végrehajtása
$result = $dbConnection->query($sql);
$filteredProducts = [];

// Eredmény feldolgozása
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $filteredProducts[] = [
            'name' => $row['product_name'],
            'price' => $row['price'],
            'image' => $row['image'],
            'id' => $row['product_ID'],
            'type' => $row['type_ID'],
            'color' => $row['color_ID'],
            'material' => $row['material_ID'],
        ];
    }
}

// Adatbáziskapcsolat lezárása
$dbConnection->close();

// JSON válasz küldése
header('Content-Type: application/json');
echo json_encode($filteredProducts);
?>
