<?php



// Bejelentkezési folyamat kezelése
// Ha a user_login gomb funkciója lefut:
if (isset($_POST['user_login'])) {
    $login_username = mysqli_real_escape_string($con, $_POST['login_username']);
    $login_password = mysqli_real_escape_string($con, $_POST['login_password']);

    // Bejelentkezés ellenőrzése az user_table-ban
    // A $login_username-nek meg kell egyeznie egy adatbázisban található username adattal.
    $select_user_query = "SELECT * FROM user_table WHERE username = ? LIMIT 1";
    $stmt_user_select = mysqli_prepare($con, $select_user_query);
    mysqli_stmt_bind_param($stmt_user_select, "s", $login_username);
    mysqli_stmt_execute($stmt_user_select);
    $result_user_select = mysqli_stmt_get_result($stmt_user_select);

    // Amennyiben megegyezik megnézzük a jelszót, hogy megegyezik-e az adatbázisban található jelszó hash-el.
    if ($result_user_select && mysqli_num_rows($result_user_select) == 1) {
        $row_user = mysqli_fetch_assoc($result_user_select);
        $hashed_password_user = $row_user['password'];

        // Ha a username és a password is megegyezik, kimentjük a felhasználó adatait a session változójaiba.
        if (password_verify($login_password, $hashed_password_user)) {
            // Mentés a sessionbe:
            session_start();
            $_SESSION['session_user_id'] = $row_user['user_ID'];
            $is_logged_in = true;
            
            if ($is_logged_in) {
                header("location: ../../Frontend/user_area/profilepage.php");
                exit();
            }
    } else {
        echo "<script>alert('Invalid username or password. Please try again.')</script>"; // Ha sikertelen a bejelentkezés, értesítést küldünk róla.
    }

    // Ha az user_table-ben nem található a felhasználónév, akkor megnézzük, hogy a table_admin-->admin_username adatokkal van-e egyezés.
    if (!isset($is_logged_in)) {
        $select_admin_query = "SELECT * FROM table_admin WHERE admin_username = ? LIMIT 1";
        $stmt_admin_select = mysqli_prepare($con, $select_admin_query);
        mysqli_stmt_bind_param($stmt_admin_select, "s", $login_username);
        mysqli_stmt_execute($stmt_admin_select);
        $result_admin_select = mysqli_stmt_get_result($stmt_admin_select);

        // Amennyiben megegyezik megnézzük a jelszót, hogy megegyezik-e az adatbázisban található jelszó hash-el.
        if ($result_admin_select && mysqli_num_rows($result_admin_select) == 1) {
            $row_admin = mysqli_fetch_assoc($result_admin_select);
            $hashed_password_admin = $row_admin['admin_password'];
            // Ha az admin_username és az admin_password is megegyezik, elindítjuk a sessiont és kimentjük a felhasználó adatait a session változójaiba.
            if (password_verify($login_password, $hashed_password_admin)) {
                // Mentés a sessionbe:
                $_SESSION['admin_id'] = $row_admin['admin_ID'];
                $_SESSION['admin_username'] = $row_admin['admin_username'];
                $_SESSION['user_type'] = 'admin';
                $is_logged_in = true;
            }
        }
    }
    }
}
// A sessionbe a felhasználó elmentve tárolt adatai a következők:
/*
$_SESSION['session_user_id'] = A felhasználó aktív ID-je a sessionbe.
$_SESSION['session_username'] = Felhasználónév
$_SESSION['session_name'] = Valódi név
$_SESSION['session_email'] = Email cím
$_SESSION['session_phonenumber'] = Telefonszám
$_SESSION['session_birthdate'] = Születési dátum
$_SESSION['session_gender'] = Nem
*/
?>
