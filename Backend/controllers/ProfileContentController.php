<?php
session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/connect.php';

$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();
$userModel = new UserModel($dbConnection);



if (isset($_GET['menuItemId'])) {
    $menuItemId = $_GET['menuItemId'];

    switch ($menuItemId) {
        case 'accountMenuItem':
            // Account page content
            break;
        
        case 'manageAccountForm':
            // Display form with user data for managing account
            include __DIR__ . '/../views/manageAccountForm.php'; // Adjust the path as necessary
            break;
        
        case 'manageShippingForm':
            // Display form for managing shipping addresses
            include __DIR__ . '/../views/manageShippingForm.php'; // Adjust the path as necessary
            break;
        
        default:
            
    }
} else {
    //Valamit
}
?>
