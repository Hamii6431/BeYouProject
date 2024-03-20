<?php

session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

class ShippingController {
    private $db;
    private $userModel;

    public function __construct() {
        // Adatbázis kapcsolat létrehozása a konstruktorban
        $this->db = Database::getInstance()->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    private function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    private function isValidUpdateAddressRequest() {
        return isset($_POST['update_address']);
    }

    private function collectAddressDataFromPost() {
        return [
            'userId' => $_POST['user_id'],
            'addressId' => $_POST['address_id'],
            'phoneNumber' => $_POST['phone_number'],
            'country' => $_POST['country'],
            'postalCode' => $_POST['postal_code'],
            'city' => $_POST['city'],
            'streetAddress' => $_POST['street_address'],
        ];
    }

    private function updateOrCreateAddress($addressData) {
        if (empty($addressData['addressId'])) {
            return $this->userModel->createShippingAddress(
                $addressData['userId'],
                $addressData['phoneNumber'],
                $addressData['country'],
                $addressData['postalCode'],
                $addressData['city'],
                $addressData['streetAddress']
            );
        } else {
            return $this->userModel->updateShippingAddress(
                $addressData['addressId'],
                $addressData['userId'],
                $addressData['phoneNumber'],
                $addressData['country'],
                $addressData['postalCode'],
                $addressData['city'],
                $addressData['streetAddress']
            );
        }
    }

    private function redirectToProfilePage() {
        header("Location: ../../Frontend/user_area/profilepage.php");
        exit();
    }

    public function handleRequest() {
        if ($this->isPostRequest() && $this->isValidUpdateAddressRequest()) {
            $addressData = $this->collectAddressDataFromPost();
            $success = $this->updateOrCreateAddress($addressData);

            if ($success) {
                echo "<script>alert('Address updated successfully.');</script>";
                $this->redirectToProfilePage();
            } else {
                echo "<script>alert('Failed to update address. Please try again.');</script>";
            }
        }
    }
}

// A ShippingController osztály példányosítása és a kérés kezelésének indítása
$controller = new ShippingController();
$controller->handleRequest();

?>