
<?php
session_start(); // Add this at the top
require_once __DIR__ . '/../models/UserModel.php';



require_once __DIR__ . '/../includes/connect.php';




$db = new Database(); // Ensure you have a Database class to handle the DB connection
$dbConnection = $db->getConnection();

$userModel = new UserModel($dbConnection);
$userData = $userModel->userFinder($_SESSION['username']);

if (!$userData) {
    echo 'Error fetching user data.';
    exit;
}

if (isset($_GET['menuItemId'])) {
    $menuItemId = $_GET['menuItemId'];

    switch ($menuItemId) {
        case 'accountMenuItem':
            // Account page content
            break;
        
        case 'manageAccountMenuItem':
            // Display form with user data for managing account
            include __DIR__ . '/../views/manageAccountForm.php'; // Adjust the path as necessary
            break;
        
        case 'manageShippingMenuItem':
            // Display form for managing shipping addresses
            include __DIR__ . '/../views/manageShippingForm.php'; // Adjust the path as necessary
            break;
        
        default:
            echo 'Error: Unknown menu item.';
    }
} else {
    echo 'Error: menuItemId is not set.';
}
?>
