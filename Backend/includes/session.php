<?php
session_start();
include 'connect.php';

$is_logged_in = false;

// Bejelentkezés ellenőrzése
if (isset($_SESSION['user_username'])) {
    $user_ID = $_SESSION['user_id'];
    $username = $_SESSION['user_username'];
    $user_email = $_SESSION['user_email'];
    $is_logged_in = true;

    // Felhasználó adatainak lekérdezése
    $user_query = "SELECT * FROM user_table WHERE username = ?";
    $stmt_user = mysqli_prepare($con, $user_query);
    mysqli_stmt_bind_param($stmt_user, "s", $username);
    mysqli_stmt_execute($stmt_user);
    $result_user = mysqli_stmt_get_result($stmt_user);

    // Ellenőrizzük, hogy a lekérdezés sikeres volt-e
    if ($result_user) {
        $row_user = mysqli_fetch_assoc($result_user);

        // Felhasználó adatainak tárolása változókban
        $name = $row_user['name'];
        $gender = $row_user['gender'];
        $birthdate = $row_user['birthdate'];
        $email = $row_user['email'];
        $phonenumber = $row_user['phone_number'];

        // Szállítási adatok lekérdezése
        $shipping_query = "SELECT * FROM shipping_addresses WHERE user_ID = ?";
        $stmt_shipping = mysqli_prepare($con, $shipping_query);
        mysqli_stmt_bind_param($stmt_shipping, "i", $user_ID);
        mysqli_stmt_execute($stmt_shipping);
        $result_shipping = mysqli_stmt_get_result($stmt_shipping);

        // Ellenőrizzük, hogy a lekérdezés sikeres volt-e
        if ($result_shipping) {
            $row_shipping = mysqli_fetch_assoc($result_shipping);

            // Szállítási adatok tárolása változókban
            $country = $row_shipping['country'];
            $postal_code = $row_shipping['postal_code'];
            $street_address = $row_shipping['street_address'];
            $city = $row_shipping['city'];

            // Korábbi rendelések lekérdezése
            $order_query = "SELECT * FROM orders WHERE user_ID = ? ORDER BY order_date DESC LIMIT 1";
            $stmt_order = mysqli_prepare($con, $order_query);
            mysqli_stmt_bind_param($stmt_order, "i", $user_ID);
            mysqli_stmt_execute($stmt_order);
            $result_order = mysqli_stmt_get_result($stmt_order);

            // Ellenőrizzük, hogy volt-e korábbi rendelés
            $order_ID = ($result_order && mysqli_num_rows($result_order) > 0) ? mysqli_fetch_assoc($result_order)['order_ID'] : "Nincs korábbi rendelés";

        } else {
            // Hiba kezelése, ha a szállítási adatok lekérdezése nem volt sikeres
            echo "Hiba a szállítási adatok lekérdezésekor: " . mysqli_error($con);
        }
    } else {
        // Hiba kezelése, ha a felhasználó adatainak lekérdezése nem volt sikeres
        echo "Hiba a felhasználó adatainak lekérdezésekor: " . mysqli_error($con);
    }

} else {
    $is_logged_in = false;
}

/*
            $name: Felhasználó neve
            $gender: Felhasználó nemzete
            $birthdate: Felhasználó születési dátuma
            $email: Felhasználó e-mail címe
            $phonenumber: Felhasználó telefonszáma

            $country: Szállítási cím ország
            $postal_code: Szállítási cím irányítószám
            $street_address: Szállítási cím utca és házszám
            $city: Szállítási cím város

            $order_ID: Legutóbbi rendelés azonosítója (vagy üzenet, ha nincs korábbi rendelés)

            $is_logged_in változó amibe elementjük hogy a felhasználó be van e jelentkezve a sessionbe
            */
?>
