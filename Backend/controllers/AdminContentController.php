
<?php
session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

// Adatbázis kapcsolat létrehozása
$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();

// Ha van 'menuItemId' paraméter az URL-ben
if (isset($_POST['menuItemId'])) {
    $menuItemId = $_POST['menuItemId'];

    // A 'menuItemId' alapján megjelenítjük a megfelelő tartalmat
    switch ($menuItemId) {
        case 'dashboardMenuitem':
            // Felhasználói adatok űrlapjának megjelenítése
            include __DIR__ . '/../../Frontend/admin_area/views/dashboardMenuitem.php';
            break;
        
        case 'analyticsMenuitem':
            // Felhasználói fiók kezelési űrlapjának megjelenítése
            include __DIR__ . '/../../Frontend/admin_area/views/analyticsMenuitem.php';
            break;
        
        case 'manageProductsMenuitem':
            // Szállítási adatok űrlapjának megjelenítése
            include __DIR__ . '/../../Frontend/admin_area/views/manageProductsMenuitem.php';
            break;

        case 'manageProductsDetailsMenuitem':
            // Szállítási adatok űrlapjának megjelenítése
            include __DIR__ . '/../../Frontend/admin_area/views/manageProductsDetailsMenuitem.php';
            break;
            
        case 'manageUsersMenuitem':
            // Rendelések megjelenítése
            include __DIR__ . '/../../Frontend/admin_area/views/manageUsersMenuitem.php';
            break;
        
        case 'manageOrdersMenuitem':
            // Rendelések megjelenítése
            include __DIR__ . '/../../Frontend/admin_area/views/manageOrdersMenuitem.php';
            break;

        default:
            // Ha a 'menuItemId' nem megfelelő, akkor nem történik semmi
            break;
    }
} else {

}
?>


