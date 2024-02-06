<?php
// Session elindítása
session_start();

// Adatbázis kapcsolat létrehozása
include 'connect.php';

$is_logged_in = false;
$is_previous_order = false;

// Bejelentkezés ellenőrzése majd a felhasználó adatainak tárolása
if (isset($_SESSION['session_user_id'])) {
    $session_user_id = $_SESSION['session_user_id'];

    // Felhasználó adatainak lekérdezése a user_table-ből hogy mindig friss adatokkal tudjunk dolgozni.
    $select_user_query = "SELECT * FROM user_table WHERE user_ID = ? LIMIT 1";
    $stmt_user_select = mysqli_prepare($con, $select_user_query);
    mysqli_stmt_bind_param($stmt_user_select, "i", $session_user_id);
    mysqli_stmt_execute($stmt_user_select);
    $result_user_select = mysqli_stmt_get_result($stmt_user_select);

    // Ellenőrizzük, hogy a lekérdezés sikeres volt-e, majd elmentjük az adatokat.
    if ($result_user_select && mysqli_num_rows($result_user_select) == 1) {
        $row_user = mysqli_fetch_assoc($result_user_select);

        // Felhasználói adatok tárolása változókban
        $session_user_id = $row_user ['user_ID'];
        $session_username = $row_user['username'];
        $session_name = $row_user['name'];
        $session_email = $row_user['email'];
        $session_phonenumber = $row_user['phone_number'];
        $session_birthdate = $row_user['birthdate'];
        $session_gender = $row_user['gender'];
        $is_logged_in = true;

        //A felhasználó szállítási adatainak lekérdezése
        $shipping_query = "SELECT * FROM shipping_addresses WHERE user_ID = ?";
        $stmt_shipping = mysqli_prepare($con, $shipping_query);
        mysqli_stmt_bind_param($stmt_shipping, "i", $session_user_id);
        mysqli_stmt_execute($stmt_shipping);
        $result_shipping = mysqli_stmt_get_result($stmt_shipping);

        // Ellenőrizzük, hogy a lekérdezés sikeres volt-e majd elmentjük az adatokat.
        if ($result_shipping) {
            $row_shipping = mysqli_fetch_assoc($result_shipping);

            // Szállítási adatok tárolása változókban
            $session_user_country = $row_shipping['country'];
            $session_user_postal_code = $row_shipping['postal_code'];
            $session_user_city = $row_shipping['city'];
            $session_user_address = $row_shipping['street_address'];

            // Korábbi rendelések lekérdezése
            $order_query = "SELECT * FROM orders WHERE user_ID = ? ORDER BY order_date ";
            $stmt_order = mysqli_prepare($con, $order_query);
            mysqli_stmt_bind_param($stmt_order, "i", $session_user_id);
            mysqli_stmt_execute($stmt_order);
            $result_order = mysqli_stmt_get_result($stmt_order);

            // Ellenőrizzük, hogy volt-e korábbi rendelés
            $is_previous_order = (mysqli_num_rows($result_order) > 0) ? true : false;

            $order_ID = ($is_previous_order) ? mysqli_fetch_assoc($result_order)['order_ID'] : "Nincs korábbi rendelés";
        }
    }
}
?>
