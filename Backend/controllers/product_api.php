<?php
// Az adatbázis kapcsolatot tartalmazó fájl importálása
require_once __DIR__ . '/../includes/connect.php';

// Adatbázis kapcsolat létrehozása a Database osztály segítségével
$db = Database::getInstance();
$conn = $db->getConnection();

// Model kód a termék adatainak lekérdezésére adott termékazonosító alapján
function getProductDetails($productID, $conn) {
    // SQL lekérdezés a termék adatainak lekérdezésére adott termékazonosító alapján
    $product_query = "SELECT * FROM products WHERE product_ID = $productID";

    // Futtassa a lekérdezést
    $product_query_run = mysqli_query($conn, $product_query);

    // Ellenőrizze, hogy a lekérdezés eredménye nem üres-e
    if (mysqli_num_rows($product_query_run) > 0) {
        // Ha van eredmény, adja vissza a termék adatait
        return mysqli_fetch_assoc($product_query_run);
    } else {
        // Ellenkező esetben térjen vissza üres értékkel vagy hibával
        return null;
    }
}

// Vezérlő kód a termék adatainak lekérésére az API-n keresztül
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productID = $_GET['id'];

    // Hívja meg a modelt a termék adatainak lekérdezésére
    $product_data = getProductDetails($productID, $conn);

    // Ellenőrizze, hogy van-e eredmény a lekérdezésből
    if (!empty($product_data)) {
        // Termék adatainak JSON formátumba alakítása és kimeneti
        header('Content-Type: application/json');
        echo json_encode($product_data);
        exit;
    } else {
        // Hibás termékazonosító esetén üres JSON válasz
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Product not found'));
        exit;
    }
} else {
    // Hiányzó vagy érvénytelen termékazonosító esetén üres JSON válasz
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Invalid product ID'));
    exit;
}
?>