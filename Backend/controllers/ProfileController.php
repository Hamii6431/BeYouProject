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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_account'])) {
    // Felhasználói adatok begyűjtése az űrlapról
    $userId = $_SESSION['user_id']; // Feltételezzük, hogy a felhasználói ID-t tároljuk a munkamenetben
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Felhasználói adatok frissítése az adatbázisban
    $success = $userModel->updateUserData($userId, $first_name, $last_name, $email);

    if ($success) {

        //felhasználói adatok frissítése a sessionben.
        $_SESSION['user_username'] = $username;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_firstname'] = $first_name;
        $_SESSION['user_lastname'] = $last_name;

        // Sikeres frissítés esetén átirányítás a profil oldalra
        header("Location: ../../Frontend/user_area/profilepage.php");
        exit();
    } else {
        // Hibás frissítés esetén hibaüzenet megjelenítése
        echo "<script>alert('Profile update failed. Please try again.');</script>";
    }
}
?>
