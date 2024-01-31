<?php
include '../../Backend/includes/connect.php';
include '../../Backend/includes/session.php';
include '../assets/header.php';

// Bejelentkezési folyamat kezelése
if (isset($_POST['user_login'])) {
    $login_username = mysqli_real_escape_string($con, $_POST['login_username']);
    $login_password = mysqli_real_escape_string($con, $_POST['login_password']);

    $loginSuccess = false;

    // Bejelentkezés ellenőrzése az user_table-ban
    $select_user_query = "SELECT * FROM user_table WHERE username = '$login_username' LIMIT 1";
    $result_user_select = mysqli_query($con, $select_user_query);

    if ($result_user_select && mysqli_num_rows($result_user_select) == 1) {
        $row_user = mysqli_fetch_assoc($result_user_select);
        $hashed_password_user = $row_user['password'];

        if (password_verify($login_password, $hashed_password_user)) {
            // Sikeres bejelentkezés az user_table-ból
            $_SESSION['user_id'] = $row_user['user_ID'];
            $_SESSION['user_username'] = $row_user['username'];
            $_SESSION['user_email'] = $row_user['email'];
            $loginSuccess = true;
        }
    }

    // Ha az user_table-ben nem található a felhasználó, akkor az admin_table-ban keresünk
    if (!$loginSuccess) {
        $select_admin_query = "SELECT * FROM table_admin WHERE admin_username = '$login_username' LIMIT 1";
        $result_admin_select = mysqli_query($con, $select_admin_query);

        if ($result_admin_select && mysqli_num_rows($result_admin_select) == 1) {
            $row_admin = mysqli_fetch_assoc($result_admin_select);
            $hashed_password_admin = $row_admin['admin_password'];

            if (password_verify($login_password, $hashed_password_admin)) {
                // Sikeres bejelentkezés a table_admin-ból
                $_SESSION['admin_id'] = $row_admin['admin_ID'];
                $_SESSION['admin_username'] = $row_admin['admin_username'];
                $_SESSION['user_type'] = 'admin';
                $loginSuccess = true;
            }
        }
    }

    if ($loginSuccess) {
        header("location: /BeYou_web/Beyouproject/Frontend/user_area/profilepage.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password. Please try again.')</script>";
    }
}

// Regisztrációs folyamat kezelése
if (isset($_POST['user_register'])) {
    // Felhasználótól kapott adatok
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);
    $user_password_again = mysqli_real_escape_string($con, $_POST['user_password_again']);
    $user_address = mysqli_real_escape_string($con, $_POST['user_address']);
    $user_mobile = mysqli_real_escape_string($con, $_POST['user_mobile']);
    $country = mysqli_real_escape_string($con, $_POST['country']);
    $postal_code = mysqli_real_escape_string($con, $_POST['postal_code']);
    $street_address = mysqli_real_escape_string($con, $_POST['street_address']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Üres mezők ellenőrzése
    if (empty($username) || empty($name) || empty($user_email) || empty($user_password) || empty($user_password_again) || empty($user_address) || empty($user_mobile) || empty($country) || empty($postal_code) || empty($street_address) || empty($city) || empty($gender) || empty($birthdate)) {
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
    $insert_user_query = "INSERT INTO user_table (name, gender, birthdate, email, phone_number, username, password, ip_address) 
    VALUES ('$name', '$gender', '$birthdate', '$user_email', '$user_mobile', '$username', '$hashed_password', '$ip_address')";

    $result_user_insert = mysqli_query($con, $insert_user_query);

    if ($result_user_insert) {
        // Utolsó beszúrt user_ID lekérdezése
        $last_user_id = mysqli_insert_id($con);

        // Szállítási címek táblába való beszúrása
        $insert_shipping_address_query = "INSERT INTO shipping_addresses (user_ID, country, postal_code, street_address, city) 
        VALUES ('$last_user_id', '$country', '$postal_code', '$street_address', '$city')";

        $result_shipping_insert = mysqli_query($con, $insert_shipping_address_query);

        if ($result_shipping_insert) {
            echo "<script>alert('Registration successful.')</script>";
        } else {
            echo "<script>alert('Error during registration.')</script>";
        }
    } else {
        echo "<script>alert('Error during registration.')</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginpage</title>
    <link rel="stylesheet" href="../../public/user_area/css/loginpage.css">
    <link rel="stylesheet" href="../../public/user_area/css/font_import.css">
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container_primary_text{
            display:flex;
            justify-content: center;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .container_vertical{
            height:60%;   
            border-left: 1px solid #27251F;
            position: absolute;
            left: 50%;
            transform: translateX(-50%); 
        }

        .container_tab_items{
            display:flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .tab_pill_item{
            border-bottom: 2px solid gray;
            width:49%;
            text-decoration: none;
            display:flex;
            justify-content: center;
        }
        

    .form-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        margin-top: 5px; /* Példa: minimális távolság az input mező teteje és a label között */
    }

    .form-group label {
        margin-top: 0.2rem;
        position: absolute;
        top: 0;
        left: 10px;
        font-size: 12px;
        color: #888; /* Példa: szürke szín a kisebb fontmérethez */
        transition: all 0.3s;
    }


    button {
        border: none;
        background: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
        display: inline-flex;
        align-items: center;
        margin:0;
        width: 100%;
        
        justify-content: center;
        height: 50px;
        
    }
    .login_button{
        background-color: #27251F;
        color: white;
    }
    .login_button:hover {
        transition: 0.3s;
        background-color: #000000;
        color: white;
    }
    .status_button{
        background-color: white;
        color: black;
        border:1px solid black;
    }
    .status_button:hover{
        transition: 0.3s;
        background-color: #000000;
        color: white;
    }


    .wrapper {
    width: 100%;
    display: flex;
    }

input[type="checkbox"] {
    appearance: none;
    -webkit-appearance: none;
    height: 1.5em;
    width: 1.5em;
    background-color: white;
    border: 2px solid rgb(42, 42, 42);
    border-radius: 0;
    cursor: pointer;
    display: flex;
    outline: none;
    align-items: center;
    justify-content: center;
}

label {
    color: black;
    font-size: 1em;
    cursor: pointer;
    margin-left: 0.5em;
}

input[type="checkbox"]:after {
    font-family: "Font awesome 6 Free";
    content: "\f00c";
    font-weight: 600;
    font-size: 1em;
    color: #ffffff;
    display: none;
}

input[type="checkbox"]:hover {
    background-color: white;
}

input[type="checkbox"]:checked {
    background-color: rgb(31,31,31);
}

input[type="checkbox"]:checked:after {
    display: block;
}



    </style>
</head>

<body>

    <div class="container">
        <div class="container_primary_text">
            <h1 class="display-4">My profile</h1>
        </div>
    </div>

    <div class="container primary_container">
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="secondary_div">
                    <!-- Bejelentkezési űrlap -->
                    <div class="container_tab_items">
                        <div class="tab_pill_item" role="presentation">
                            <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                                aria-controls="pills-login" aria-selected="true">LOGIN</a>
                        </div>
                        <div class="tab_pill_item" role="presentation">
                            <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
                                aria-controls="pills-register" aria-selected="false">SIGN UP</a>
                        </div>
                    </div>


                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                            <!-- Bejelentkezési űrlap tartalma -->
                            <form method="POST" action="loginpage.php" class="orderform">
                                <div class="form-group">
                                    <input type="text" name="login_username" id="login_username" class="" placeholder=" " required>
                                    <label for="login_username">Enter your username *</label>
                                </div>
                                <!-- Password input -->
                                <div class="form-group">
                                    <input type="password" name="login_password" id="login_password" class="" placeholder=" " required>
                                    <label for="login_password">Enter your password *</label>
                                </div>

                                <div class="container_terms">
                                    <div class="wrapper">
                                        <input type="checkbox" name="" value="">
                                        <label><p href="termsandconditions.php">Terms and conditions</p></label>  <!--Módosítani-->
                                    </div> 
                                    <p>* The required fields must be filled out. Without feedback, we cannot process your request.</p>
                                </div>
                                
                                
                                <button class="login_button" type="submit" name="user_login">LOGIN</button>

                            </form>

                        </div>

                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                            <!-- Regisztrációs űrlap tartalma -->
                            <form action="../../Backend/user_area/user_registration.php" method="post">
                                <!-- Felhasználónév -->
                                <div class="form-outline mb-4">
                                    <label for="username" class="form-label">
                                        Username
                                    </label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Enter your username" autocomplete="off" required="required">
                                </div>

                                <!-- Rendes név -->
                                <div class="form-outline mb-4">
                                    <label for="name" class="form-label">
                                        Full name
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter your full name" autocomplete="off" required="required">
                                </div>

                                <!-- ... (a többi regisztrációs űrlap mező itt helyezkedik el) ... -->

                                <!-- Regisztrációs gomb -->
                                <div class="form-outline mb-4">
                                    <input type="submit" name="user_register" class="btn btn-block mb-3" value="Register">
                                    <p>Already have an account? <button class="btn btn-block mb-3" id="backToLoginButton"
                                            class="btn btn-primary">
                                            Back to login
                                        </button></p>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="col-12 col-lg-2 d-none d-lg-block">
                <div class="container_vertical">
                    <!-- A tartalom, ami csak nagyobb készülékeken jelenik meg -->
                </div>
            </div>

            
            <div class="col-12 col-lg-5">
                <div class="secondary_div">
                    <div class="container_orderstatus">
                        <h3>CHECK ORDER STATUS</h3>
                        <hr>
                        <form method="POST" action="" class="orderform">
                                <div class="form-group">
                                    <input type="text" name="login_username" id="login_username" class="" placeholder=" " required>
                                    <label for="login_username">Order number *</label>
                                </div>
                                <!-- Password input -->
                                <div class="form-group">
                                    <input type="password" name="login_password" id="login_password" class="" placeholder=" " required>
                                    <label for="login_password">Order email address *</label>
                                </div>
                                
                                <button class="status_button" type="submit" name="">STATUS CHECK</button>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Funkció a login és register űrlap közötti váltáshoz. -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        const loginTab = document.getElementById('tab-login');
        const registerTab = document.getElementById('tab-register');
        const loginForm = document.getElementById('pills-login');
        const registerForm = document.getElementById('pills-register');
        const registerButton = document.getElementById('tab-register');
        const backButton = document.getElementById('backToLoginButton');

        registerButton.addEventListener('click', function () {
            loginTab.classList.remove('active');
            registerTab.classList.add('active');
            loginForm.classList.remove('show', 'active');
            registerForm.classList.add('show', 'active');
        });

        loginTab.addEventListener('click', function () {
            loginTab.classList.add('active');
            registerTab.classList.remove('active');
            loginForm.classList.add('show', 'active');
            registerForm.classList.remove('show', 'active');
        });

        backButton.addEventListener('click', function () {
            loginTab.classList.add('active');
            registerTab.classList.remove('active');
            loginForm.classList.add('show', 'active');
            registerForm.classList.remove('show', 'active');
        });
    </script>

</body>
</html>
