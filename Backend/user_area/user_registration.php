<?php

if (isset($_POST['user_register'])) {
    // Felhasználótól kapott adatok
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);
    $user_password_again = mysqli_real_escape_string($con, $_POST['user_password_again']);
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Üres mezők ellenőrzése
    if (empty($username) || empty($name) || empty($user_email) || empty($user_password) || empty($user_password_again)) {
        echo "<script>alert('Please fill in all fields.')</script>";
        exit();
    }

    // Jelszó egyezőségének ellenőrzése
    if ($user_password != $user_password_again) {
        echo "<script>alert('Passwords do not match. Please try again.')</script>";
        exit();
    }

    // Felhasználónév foglaltságának ellenőrzése
    $check_username_query = "SELECT username FROM user_table WHERE username='$username' LIMIT 1";
    $result_username_check = mysqli_query($con, $check_username_query);

    if (mysqli_num_rows($result_username_check) > 0) {
        echo "<script>alert('Username is already taken.')</script>";
        exit();
    }

    // Jelszó hash készítése
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // Felhasználói adatok beszúrása az user_table táblába
    $insert_user_query = "INSERT INTO user_table (name, email, username, password, ip_address) 
    VALUES ('$name', '$user_email', '$username', '$hashed_password', '$ip_address')";


}
?>
