<?php
require_once __DIR__ . '/../models/UserModel.php';

// Ellenőrizzük, hogy a POST kérés érkezett-e és AJAX kérés-e
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Ellenőrizzük, hogy minden kötelező mezőt kitöltöttek-e
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['terms'])) {
        // Mezők értékeinek mentése változókba
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_again = $_POST['password_again'];

        // UserModel példányosítása
        $userModel = new UserModel();

        // Ellenőrizzük, hogy a jelszavak egyeznek-e
        if ($userModel->passwordsMatch($password, $password_again)) {
            // Regisztráljuk a felhasználót
            $registrationResult = $userModel->registerUser($first_name, $last_name, $username, $email, $password);
            // Ellenőrizzük a regisztráció eredményét
            if ($registrationResult === "Registration successful.") {
                // Sikeres regisztráció esetén további teendők, például átirányítás vagy üzenet megjelenítése
                echo "<script>alert('Registration successful.');</script>";
                // Ide írd be a további teendőket, például átirányítást
            } else {
                // Sikertelen regisztráció esetén hibaüzenet megjelenítése
                echo "<script>alert('$registrationResult');</script>";
            }
        } else {
            // Ha a jelszavak nem egyeznek, hibaüzenet megjelenítése
            echo "<script>alert('Passwords do not match.');</script>";
        }
    } else {
        // Ha nem minden kötelező mezőt töltöttek ki, hibaüzenet küldése
        echo "Hiányzó mezők!";
    }
} else {
    // Ha nem POST kérés érkezett vagy nem AJAX kérés, hibaüzenet küldése
    echo "Érvénytelen kérés!";
}
?>
