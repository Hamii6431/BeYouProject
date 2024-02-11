<?php
session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/connect.php';

$dbInstance = Database::getInstance();
$dbConnection = $dbInstance->getConnection();
$userModel = new UserModel($dbConnection);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_account'])) {
    // Begyűjtjük az űrlapról érkező adatokat
    $userId = $_SESSION['session_user_id']; // Feltételezve, hogy a felhasználó ID-t tároljuk a munkamenetben
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];

    // Meghívjuk a frissítési metódust a UserModel-ben
    $success = $userModel->updateUserData($userId, $name, $email, $phone_number, $birthdate, $gender);

    if ($success) {
        //felhasználói adatok frissítése a sessionben.
        $username = $_SESSION['session_username'];
        $userData = $userModel->getUserDataByUsername($username);

        if ($userData) {
            // Frissítjük a munkamenet adatokat a lekérdezett adatokkal
            $_SESSION['session_user_id'] = $userData['user_ID'];
            $_SESSION['session_name'] = $userData['name'];
            $_SESSION['session_gender'] = $userData['gender'];
            $_SESSION['session_birthdate'] = $userData['birthdate'];
            $_SESSION['session_email'] = $userData['email'];
            $_SESSION['session_phone_number'] = $userData['phone_number'];
            // További adatok frissítése szükség szerint
        } else {
            echo "Hiba történt a felhasználói adatok lekérdezésekor.";
        }
        } else {
            echo "<script>alert('Profile update failed. Please try again.');</script>";
        }

    // Opcionálisan átirányíthatsz egy megerősítő oldalra vagy vissza a profilra
    header("Location: ../../Frontend/user_area/profilepage.php");
    exit();
}
?>