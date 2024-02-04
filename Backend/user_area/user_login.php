<?php

// Bejelentkezési folyamat kezelése
//user_login gomb funkciója lefut:
if (isset($_POST['user_login'])) {
    $login_username = mysqli_real_escape_string($con, $_POST['login_username']); //kimentünk két változót: $login_username és 
    $login_password = mysqli_real_escape_string($con, $_POST['login_password']); //$login_password

    //Bejelentkezés ellenőrzése az user_table-ban
    //A $login_username-nek meg kell egyeznie egy adatbázisban található username adattal.
    $select_user_query = "SELECT * FROM user_table WHERE username = '$login_username' LIMIT 1";
    $result_user_select = mysqli_query($con, $select_user_query);

    //Amennyiben megegyezik megnézzük a jelszót hogy megegyezik e az adatbázisban található jelszó hash-el.
    if ($result_user_select && mysqli_num_rows($result_user_select) == 1) {
        $row_user = mysqli_fetch_assoc($result_user_select);
        $hashed_password_user = $row_user['password'];
        //Ha a username és a password is megegyezik elindítjuk a sessiont és kimentjük a felhasználó adatait a session változójaiba.
        if (password_verify($login_password, $hashed_password_user)) {
            //Mentés a sessionbe:
            $_SESSION['session_user_id'] = $row_user['user_ID'];
            $_SESSION['session_username'] = $row_user['username'];
            $_SESSION['session_name'] = $row_user['name'];
            $_SESSION['session_email'] = $row_user['email'];
            $_SESSION['session_phonenumber'] = $row_user['phonenumber'];
            $_SESSION['session_birthdate'] = $row_user['birthdate'];
            $_SESSION['session_gender'] = $row_user['gender'];
            $is_logged_in = true;
            
            //A sessionbe a felhasználó elmentve tárolt adatai a következők:
            /*
            $_SESSION['session_user_id'] = A felhasználó aktív ID-je a sessionbe.
            $_SESSION['session_username'] = Felhasználónév
            $_SESSION['session_name'] = Valódi név
            $_SESSION['session_email'] = Email cím
            $_SESSION['session_phonenumber'] = Telefonszám
            $_SESSION['session_birthdate'] = Születési dátum
            $_SESSION['session_gender'] = Nem
            */
        }
    }

    // Ha az user_table-ben nem található a felhasználónév akkor megnézzük hogy a table_admin-->admin_username adatokkal van e egyezés.
    if (!isset($is_logged_in)) {
        $select_admin_query = "SELECT * FROM table_admin WHERE admin_username = '$login_username' LIMIT 1";
        $result_admin_select = mysqli_query($con, $select_admin_query);
        //Amennyiben megegyezik megnézzük a jelszót hogy megegyezik e az adatbázisban található jelszó hash-el.
        if ($result_admin_select && mysqli_num_rows($result_admin_select) == 1) {
            $row_admin = mysqli_fetch_assoc($result_admin_select);
            $hashed_password_admin = $row_admin['admin_password'];
            //Ha az admin_username és az admin_password is megegyezik elindítjuk a sessiont és kimentjük a felhasználó adatait a session változójaiba.
            if (password_verify($login_password, $hashed_password_admin)) {
                //Mentés a sessionbe:
                $_SESSION['admin_id'] = $row_admin['admin_ID'];
                $_SESSION['admin_username'] = $row_admin['admin_username'];
                $_SESSION['user_type'] = 'admin';
                $is_logged_in = true;
            }
        }
    }
    //Ha sikeres a bejelentkezés átirányítjuk a felhasználót a profilpage.php oldalra ahol a regisztrált adatokat láthatja illetve szerkesztheti.
    if (isset($is_logged_in)) {
        header("location: /BeYou_web/Beyouproject/Frontend/user_area/profilepage.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password. Please try again.')</script>"; //Ha sikertelen a bejelentkezés értesítést küldünk róla.
    }
}
?>
