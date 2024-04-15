
<?php
session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/AdminAreaModel.php';
require_once __DIR__ . '/../models/AdminModel.php';
require_once __DIR__ . '/../includes/Database.php';

// Adatbázis kapcsolat létrehozása
$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();

// Példányosítjuk a modelleket
$adminAreaModel = new AdminAreaModel($dbConnection);


// Lekérjük az összes felhasználó és rendelés számát
$allUsers = $adminAreaModel->AllUsers();
$allFinalOrders = $adminAreaModel->AllFinalOrders();
$allProducts = $adminAreaModel->AllProducts();
$allIncome = $adminAreaModel->AllIncome();
$gemstones = $adminAreaModel->getgemstones();
$types = $adminAreaModel->getTypes();
$materials = $adminAreaModel->getMaterials();
$latestUsers = $adminAreaModel->getLatestUsers();
$latestOrders = $adminAreaModel->getLatestOrders();
$latestProducts = $adminAreaModel->getLatestProducts();
$updateUserCount = $adminAreaModel->updateUserCount();
$orderCount = $adminAreaModel->orderCount();

if (isset($_POST['action']) && $_POST['action'] == 'addProduct') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $gemstone_id = $_POST['gemstone_id'];
    $type_id = $_POST['type_id'];
    $material_id = $_POST['material_id'];

    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDirectory = __DIR__ . '/../../public/product_images/'; 
        $fileName = basename($_FILES['image']['name']);
        $targetFile = $targetDirectory . $fileName;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $default_image_url = $fileName;
        } else {
            echo json_encode(['success' => false, 'message' => 'Nem sikerült feltölteni a képet.']);
            exit;
        }
    } else {
        $default_image_url = ''; // Alapértelmezett kép vagy hibaüzenet
    }
    

    // Ellenőrizd, hogy az összes szükséges adat meg van-e adva
    if (empty($product_name) || empty($price) || empty($description) || empty($stock) || empty($gemstone_id) || empty($type_id) || empty($material_id) || empty($default_image_url)) {
        echo json_encode(['success' => false, 'message' => 'Minden mezőt ki kell tölteni.']);
        exit;
    }

    try {
        // Próbáld meg hozzáadni a terméket az adatbázishoz
        $result = $adminAreaModel->addProduct($product_name, $price, $description, $stock, $gemstone_id, $type_id, $material_id, $default_image_url);

        // Ellenőrizd a beszúrás eredményét
        if ($result['success']) {
            echo json_encode(['success' => true, 'message' => 'Termék sikeresen hozzáadva.']);
        } else {
            echo json_encode(['success' => false, 'message' => $result['message']]);
        }
    } catch (Exception $e) {
        // Ha valami hiba történik az adatbázisművelet közben
        echo json_encode(['success' => false, 'message' => 'Hiba történt az adatbázisművelet közben: ' . $e->getMessage()]);
    }

    
}
// AdminContentController.php folytatása

if (isset($_GET['action']) && $_GET['action'] == 'getProductDetails' && isset($_GET['productId'])) {
    $productId = (int)$_GET['productId'];
    $productDetails = $adminAreaModel->getProductById($productId);

    if ($productDetails) {
        echo json_encode(['success' => true, 'data' => $productDetails]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
    }
    exit;
}




// AdminContentController része a termékek frissítésére

if (isset($_POST['action']) && $_POST['action'] == 'updateProduct') {
    // Azonosító és űrlapadatok kinyerése
    $product_id = $_POST['editProductId'];
    $product_name = $_POST['editProduct_name'];
    $price = $_POST['editPrice'];
    $description = $_POST['editDescription'];
    $stock = $_POST['editStock'];
    $gemstone_id = $_POST['editGemstone_id'];
    $type_id = $_POST['editType_id'];
    $material_id = $_POST['editMaterial_id'];

    // Képfájl kezelése
    $default_image_url = ''; // Alapértelmezett érték
    if (isset($_FILES['editImage']) && $_FILES['editImage']['error'] == 0) {
        $targetDirectory = __DIR__ . '/../../public/product_images/';
        $fileName = basename($_FILES['editImage']['name']);
        $targetFile = $targetDirectory . $fileName;

        if (move_uploaded_file($_FILES['editImage']['tmp_name'], $targetFile)) {
            $default_image_url = '/../../public/product_images/' . $fileName; // Weben elérhető útvonal
        } else {
            echo json_encode(['success' => false, 'message' => 'Nem sikerült feltölteni a képet.']);
            exit;
        }
    }

    // Adatbázisban való frissítés
    $updateResult = $adminAreaModel->updateProduct($product_id, $product_name, $price, $description, $stock, $gemstone_id, $type_id, $material_id, $default_image_url);

    if ($updateResult['success']) {
        echo json_encode(['success' => true, 'message' => 'Termék sikeresen frissítve.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nem sikerült frissíteni a terméket: ' . $updateResult['message']]);
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'getUserDetails' && isset($_GET['userId'])) {
    $userId = (int)$_GET['userId'];
    $userDetails = $adminAreaModel->getUserById($userId);

    if ($userDetails) {
        echo json_encode(['success' => true, 'data' => $userDetails]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
    exit;
}
// AdminContentController része a felhasználók frissítésére

if (isset($_POST['action']) && $_POST['action'] == 'updateUser') {
    // Azonosító és űrlapadatok kinyerése
    $user_id = $_POST['editUserId'];
    $username = $_POST['editUsername'];
    $email = $_POST['editEmail'];
    $first_name = $_POST['editFirstname'];
    $last_name = $_POST['editLastname'];


    // Adatbázisban való frissítés
    $updateResult = $adminAreaModel->updateUser($user_id, $username, $email, $first_name, $last_name);

    if ($updateResult['success']) {
        echo json_encode(['success' => true, 'message' => 'Felhasználó sikeresen frissítve.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nem sikerült frissíteni a felhasználót: ' . $updateResult['message']]);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'getOrderDetails' && isset($_GET['final_order_id'])) {
    $final_order_id = (int)$_GET['final_order_id'];
    $orderDetails = $adminAreaModel->getFinalOrderById($final_order_id);

    if ($orderDetails) {
        echo json_encode(['success' => true, 'data' => $orderDetails]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
    exit;
}
// AdminContentController része a felhasználók frissítésére

if (isset($_POST['action']) && $_POST['action'] == 'updateOrderStatus') {
    // Azonosító és űrlapadatok kinyerése
    $final_order_id = $_POST['editFinal_order_id']; 
    $status = $_POST['editStatus']; 


    // Adatbázisban való frissítés
    $updateResult = $adminAreaModel->updateOrderStatus($final_order_id, $status);

    if ($updateResult['success']) {
        echo json_encode(['success' => true, 'message' => 'Felhasználó sikeresen frissítve.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nem sikerült frissíteni a felhasználót: ' . $updateResult['message']]);
    }
}






// Ha van 'menuItemId' paraméter az URL-ben
if (isset($_POST['menuItemId'])) {
    $menuItemId = $_POST['menuItemId'];

    // A 'menuItemId' alapján megjelenítjük a megfelelő tartalmat
    switch ($menuItemId) {
        case 'dashboardMenuitem':
            // Felhasználói adatok űrlapjának megjelenítése
            include __DIR__ . '/../../Frontend/admin_area/views/dashboardMenuitem.php';
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


