<?php
include '../../Backend/includes/connect.php';
include '../../Backend/includes/session.php';

$servername = "localhost";
$username = "Hamii";
$password = "4M9TZedhhxxd-PFP";
$database = "BeYou";

$con = new mysqli($servername, $username, $password, $database);
$mysqli= $con;

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


// Ellenőrizze, hogy a termékazonosító rendelkezésre áll-e a lekérdezési karakterláncban
if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Ellenőrizze, hogy a felhasználó be van-e jelentkezve
    if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];

        // Termék eltávolítása az order_items táblából
        $query = "DELETE FROM order_items WHERE user_ID = ? AND product_ID = ?";
        $stmt = $mysqli->prepare($query);

        if ($stmt) {
            $stmt->bind_param('ii', $userID, $productID);
            $stmt->execute();

            // Ellenőrizze, hogy a törlés sikeres volt-e
            if ($stmt->affected_rows > 0) {
                echo "Termék sikeresen eltávolítva.";
            } else {
                echo "Nem sikerült eltávolítani a terméket az order_items táblából.";
            }

            $stmt->close();
        } else {
            echo "Hiba a készült állításban.";
        }
    } else {
        echo "A felhasználó nincs bejelentkezve.";
    }
} else {
    echo "Nincs termékazonosító megadva.";
}

$mysqli->close();
?>
