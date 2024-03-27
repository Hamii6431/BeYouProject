<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

session_start();

class ShippingController {
    private $db;
    private $userModel;

    // Adatbázis kapcsolat előkészítése
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    //Get kérés validálása
    private function isGetRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    //Post kérés validálása
    private function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    //Adatok kigyűjtése
    private function collectAddressDataFromPost() {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        return [
            'userId' => $userId,
            'addressId' => $_POST['address_id'],
            'phoneNumber' => $_POST['phone_number'] ?? null,
            'country' => $_POST['country'] ?? null,
            'postalCode' => $_POST['postal_code'] ?? null,
            'city' => $_POST['city'] ?? null,
            'streetAddress' => $_POST['street_address'] ?? null,
        ];
    }

    //Amennyiben volt már korábban szállítási adat frissítjük az adatokat ha pedig nem volt még akkor létrehozzuk a felhasználó szállítási adatait.
    private function updateOrCreateAddress($addressData) {
        $existingAddressId = $this->userModel->isUserHaveAddress($addressData['userId']);
    
        if ($existingAddressId) {
            $success = $this->userModel->updateShippingAddress(
                $existingAddressId,
                $addressData['userId'],
                $addressData['phoneNumber'],
                $addressData['country'],
                $addressData['postalCode'],
                $addressData['city'],
                $addressData['streetAddress']
            );
        } else {
            $success = $this->userModel->createShippingAddress(
                $addressData['userId'],
                $addressData['phoneNumber'],
                $addressData['country'],
                $addressData['postalCode'],
                $addressData['city'],
                $addressData['streetAddress']
            );
        }
        if ($success) {
            $this->sendResponse("Shipping address updated successfully.", true);
        } else {
            $this->sendResponse("Failed to update the shipping address.", false);
        }
    }

    //Kérés kezelése
    public function handleRequest() {
        if ($this->isGetRequest()) {
            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                $this->sendResponse("Please enter your shipping details", false);
                return;
            }
    
            $shippingData = $this->userModel->getUserShippingDataByUserID($userId);
            if (!$shippingData) {
                $this->sendResponse("Please enter your shipping details", false);
                return;
            } else {
                echo json_encode($shippingData);
                exit;
            }
        }
    
        if ($this->isPostRequest()) {
            $requiredFields = ['phone_number', 'country', 'postal_code', 'city', 'street_address'];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    $this->sendResponse("Please fill in all required fields.", false);
                    return;
                }
            }
    
            $addressData = $this->collectAddressDataFromPost();
            $this->updateOrCreateAddress($addressData);
        }
    }

    //Válasz elküldése
    private function sendResponse($message, $isSuccess) {
        $response = ['status' => $isSuccess ? 'success' : 'error', 'message' => $message];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

$controller = new ShippingController();
$controller->handleRequest();

?>
