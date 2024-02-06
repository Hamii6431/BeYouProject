<?php
include '../../Backend/includes/connect.php';
include '../../Backend/includes/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ellenőrizze, hogy a felhasználó be van-e jelentkezve
    if ($is_logged_in) {
        $productID = $_POST['product_id'];

        // Ellenőrizze, hogy a termék létezik az adatbázisban
        $checkProductQuery = "SELECT * FROM products WHERE product_ID = $productID";
        $checkProductResult = mysqli_query($con, $checkProductQuery);

        if (mysqli_num_rows($checkProductResult) > 0) {
            $productData = mysqli_fetch_assoc($checkProductResult);
            $productName = $productData['product_name'];
            $productPrice = $productData['price'];

            // Ellenőrizze, hogy van-e aktív rendelés a felhasználónak
            $checkOrderQuery = "SELECT * FROM orders WHERE user_ID = $session_user_id AND status = 'Received'";
            $checkOrderResult = mysqli_query($con, $checkOrderQuery);

            if (mysqli_num_rows($checkOrderResult) > 0) {
                // Van aktív rendelés, ellenőrizze, hogy van-e már ilyen termék a rendelésben
                $orderData = mysqli_fetch_assoc($checkOrderResult);
                $orderID = $orderData['order_ID'];

                $checkExistingProductQuery = "SELECT * FROM order_items WHERE order_ID = $orderID AND product_ID = $productID AND user_ID = $session_user_id AND status = 'Cart'";
                $checkExistingProductResult = mysqli_query($con, $checkExistingProductQuery);

                if (mysqli_num_rows($checkExistingProductResult) > 0) {
                    // A termék már szerepel a rendelésben, növelje meg a mennyiséget
                    $updateQuantityQuery = "UPDATE order_items SET quantity = quantity + 1 WHERE order_ID = $orderID AND product_ID = $productID AND user_ID = $session_user_id AND status = 'Cart'";
                    $updateQuantityResult = mysqli_query($con, $updateQuantityQuery);

                    if ($updateQuantityResult) {
                        // Sikeres frissítés
                        echo json_encode(['status' => 'success']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Hiba a mennyiség frissítése közben.']);
                    }
                } else {
                    // A termék még nincs a rendelésben, adjuk hozzá
                    $insertToOrderItemsQuery = "INSERT INTO order_items (order_ID, product_ID, quantity, item_price, user_ID, status) VALUES ($orderID, $productID, 1, $productPrice, $session_user_id, 'Cart')";
                    $insertToOrderItemsResult = mysqli_query($con, $insertToOrderItemsQuery);

                    if ($insertToOrderItemsResult) {
                        // Sikeres hozzáadás
                        echo json_encode(['status' => 'success']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Hiba a rendelés tételekhez adás közben.']);
                    }
                }
            } else {
                // Nincs aktív rendelés, létrehoz egy új rendelést
                $createOrderQuery = "INSERT INTO orders (user_ID) VALUES ($session_user_id)";
                $createOrderResult = mysqli_query($con, $createOrderQuery);

                if ($createOrderResult) {
                    $orderID = mysqli_insert_id($con);

                    // Adjuk hozzá a terméket az új rendeléshez
                    $insertToOrderItemsQuery = "INSERT INTO order_items (order_ID, product_ID, quantity, item_price, user_ID, status) VALUES ($orderID, $productID, 1, $productPrice, $session_user_id, 'Cart')";
                    $insertToOrderItemsResult = mysqli_query($con, $insertToOrderItemsQuery);

                    if ($insertToOrderItemsResult) {
                        // Sikeres hozzáadás
                        echo json_encode(['status' => 'success']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Hiba a rendelés tételekhez adás közben.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Hiba az új rendelés létrehozása közben.']);
                }
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'A kiválasztott termék nem található.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'A felhasználó nincs bejelentkezve.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Érvénytelen kérési metódus.']);
}
?>
