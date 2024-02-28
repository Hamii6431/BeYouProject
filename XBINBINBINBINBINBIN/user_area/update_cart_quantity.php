<?php
session_start();
include '../includes/connect.php';

$servername = "localhost";
$username = "Hamii";
$password = "4M9TZedhhxxd-PFP";
$database = "BeYou";

$con = new mysqli($servername, $username, $password, $database);
$mysqli= $con;

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_SESSION['user_username'])) {
    $user_ID = $_SESSION['user_id'];
    
    // Ellenőrizze, hogy a paraméterek be vannak-e állítva
    if (isset($_GET['id']) && isset($_GET['quantity'])) {
        $productID = $_GET['id'];
        $newQuantity = $_GET['quantity'];

        // Ellenőrizze, hogy a mennyiség nem negatív
        if ($newQuantity >= 0) {
            // Frissítse az adatbázist a megadott termék mennyiségével
            $stmt = $mysqli->prepare("UPDATE order_items SET quantity = ? WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param("iii", $newQuantity, $user_ID, $productID);
            $stmt->execute();
            $stmt->close();
            
            // Ha sikeres a frissítés, küldjön vissza 200-as státuszkódot
            http_response_code(200);
            exit;
        } else {
            // Ha a mennyiség negatív, küldjön vissza hibakódot
            http_response_code(400);
            exit("Invalid quantity.");
        }
    } else {
        // Ha a paraméterek nincsenek beállítva, küldjön vissza hibakódot
        http_response_code(400);
        exit("Missing parameters.");
    }
} else {
    // Ha a felhasználó nincs bejelentkezve, küldje el a hozzáférési hibakódot
    http_response_code(403);
    exit("Access denied.");
}
?>
