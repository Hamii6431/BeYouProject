<?php
session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/connect.php';

$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();
$userModel = new UserModel($dbConnection);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_address'])) {
    $userId = $_SESSION['session_user_id'];
    $addressId = $_POST['address_ID']; // Ensure this input is present in the form
    $country = $_POST['country'];
    $postalCode = $_POST['postal_code'];
    $city = $_POST['city'];
    $streetAddress = $_POST['street_address'];

    $success = $userModel->updateShippingAddress($addressId, $userId, $country, $postalCode, $city, $streetAddress);

    if ($success) {
        echo "<script>alert('Address updated successfully.');</script>";
    } else {
        echo "<script>alert('Failed to update address. Please try again.');</script>";
    }

    header("Location: ../../Frontend/user_area/profilepage.php");
    exit();
}
?>
