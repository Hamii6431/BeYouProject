
<?php
session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

// Adatbázis kapcsolat létrehozása
$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();

// UserModel példányosítása
$userModel = new UserModel($dbConnection);

// Felhasználó azonosítójának lekérése a munkamenetből
$userId = $_SESSION['user_id'];

// Felhasználó adatainak lekérése a UserModel segítségével
$userData = $userModel->getUserDataByUserID($userId);
// Felhasználó szállítási címeinek lekérése
$shippingData = $userModel->getUserShippingDataByUserID($userId);

// Teljes név összefűzése
$fullName = $userData['first_name'] . ' ' . $userData['last_name'];

// Ha van 'menuItemId' paraméter az URL-ben
if (isset($_GET['menuItemId'])) {
    $menuItemId = $_GET['menuItemId'];

    // A 'menuItemId' alapján megjelenítjük a megfelelő tartalmat
    switch ($menuItemId) {
        case 'accountMenuItem':
            // Felhasználói adatok űrlapjának megjelenítése
            include __DIR__ . '/../../Frontend/user_area/views/accountMenuItem.php';
            break;
        
        case 'manageAccountForm':
            // Felhasználói fiók kezelési űrlapjának megjelenítése
            include __DIR__ . '/../../Frontend/user_area/views/manageAccountForm.php';
            break;
        
        case 'manageShippingForm':
            // Szállítási adatok űrlapjának megjelenítése
            include __DIR__ . '/../../Frontend/user_area/views/manageShippingForm.php';
            break;

        case 'ordersMenuItem':
            // Rendelések megjelenítése
            include __DIR__ . '/../../Frontend/user_area/views/ordersMenuItem.php';
            break;
        
        default:
            // Ha a 'menuItemId' nem megfelelő, akkor nem történik semmi
            break;
    }
} else {
    // Ha nincs 'menuItemId' paraméter az URL-ben, akkor visszaküldjük a felhasználó teljes nevét
    echo $fullName;
}
?>


