<?php
session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

// Adatbázis kapcsolat létrehozása
$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();

// UserModel példány létrehozása
$userModel = new UserModel($dbConnection);

// Űrlap adatok kezelése
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_address'])) {
    // Űrlapról érkező adatok begyűjtése
    $userId = $_POST['user_id']; // Felhasználói azonosító
    $addressId = $_POST['address_id']; // Cím azonosító
    $phoneNumber = $_POST['phone_number'];
    $country = $_POST['country'];
    $postalCode = $_POST['postal_code'];
    $city = $_POST['city'];
    $streetAddress = $_POST['street_address'];

    // Ellenőrizzük, hogy van-e már cím azonosító
    if (empty($addressId)) {
        // Ha nincs, létrehozzuk az új szállítási címet
        $success = $userModel->createShippingAddress($userId, $phoneNumber, $country, $postalCode, $city, $streetAddress);
        if (!$success) {
            echo "<script>alert('Failed to create new address. Please try again.');</script>";
            exit(); // Ha nem sikerült az új cím létrehozása, kilépünk
        }
    } else {
        // Ha van cím azonosító, frissítjük az adatokat az updateshippingaddress metódussal
        $success = $userModel->updateShippingAddress($addressId, $userId, $phoneNumber, $country, $postalCode, $city, $streetAddress);
    }

    if ($success) {
        echo "<script>alert('Address updated successfully.');</script>";
    } else {
        echo "<script>alert('Failed to update address. Please try again.');</script>";
    }

    // Visszairányítás a profil oldalra
    header("Location: ../../Frontend/user_area/profilepage.php");
    exit();
}

?>
