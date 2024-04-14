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

    private function isGetRequest() {
        return isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET';
    }
    
    private function isPostRequest() {
        return isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    
    //Adatok begyűjtése az űrlapról.
    private function collectAddressDataFromPost() {
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        return [
            'userId' => $userId,
            'addressId' => isset($_POST['address_id']) ? $_POST['address_id'] : null,
            'phoneNumber' => isset($_POST['phone_number']) ? $_POST['phone_number'] : null,
            'country' => isset($_POST['country']) ? $_POST['country'] : null,
            'postalCode' => isset($_POST['postal_code']) ? $_POST['postal_code'] : null,
            'city' => isset($_POST['city']) ? $_POST['city'] : null,
            'streetAddress' => isset($_POST['street_address']) ? $_POST['street_address'] : null,
        ];
    }

    // Telefonszám validációja
    private function validatePhoneNumber($phoneNumber) {
        // Ellenőrizzük, hogy a telefonszám csak számokat és a megadott kivételeket tartalmazza
        return preg_match('/^(\+?\d{0,9})?([ -]?\d{2,3}){1,2}$/', $phoneNumber);
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

            // Telefonszám validálása
            if (!$this->validatePhoneNumber($_POST['phone_number'])) {
                $this->sendResponse("Please enter a valid phone number.", false);
                return;
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
