<?php

session_start();
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/Database.php';

class ShippingController {
    private $db;
    private $userModel;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    private function isGetRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    private function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }



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
    private function updateOrCreateAddress($addressData) {
        // Ellenőrizzük, hogy van-e már szállítási cím az adott felhasználóhoz
        $existingAddressId = $this->userModel->isUserHaveAddress($addressData['userId']);
    
        if ($existingAddressId) {
            // Ha van, akkor frissítjük a meglévő címet
            return $this->userModel->updateShippingAddress(
                $existingAddressId,
                $addressData['userId'],
                $addressData['phoneNumber'],
                $addressData['country'],
                $addressData['postalCode'],
                $addressData['city'],
                $addressData['streetAddress']
            );
        } else {
            // Ha nincs, akkor új címet hozunk létre
            return $this->userModel->createShippingAddress(
                $addressData['userId'],
                $addressData['phoneNumber'],
                $addressData['country'],
                $addressData['postalCode'],
                $addressData['city'],
                $addressData['streetAddress']
            );
        }
    }
    

    public function handleRequest() {
        if ($this->isGetRequest()) {
            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                echo json_encode(['error' => 'User not authenticated']);
                exit;
            }
    
            $shippingData = $this->userModel->getUserShippingDataByUserID($userId);
            echo json_encode($shippingData ?: ['error' => 'No shipping data found']);
            exit;
        }
    
        if ($this->isPostRequest()) {
            // Ellenőrizzük, hogy minden szükséges adat megérkezett-e.
            $requiredFields = ['phone_number', 'country', 'postal_code', 'city', 'street_address'];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    echo json_encode(['error' => "Missing field: $field"]);
                    exit;
                }
            }
    
            $addressData = $this->collectAddressDataFromPost();
            $success = $this->updateOrCreateAddress($addressData);
    
            echo json_encode(['success' => $success]);
            exit;
        }
    
        echo json_encode(['error' => 'Invalid request']);
        exit;
    }
}

$controller = new ShippingController();
$controller->handleRequest();

?>
