<?php
include '../assets/header.php';
require_once '../../Backend/includes/database.php';

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
                    <!-- Bejelentkezési és regisztrációs menüpontok-->
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
                            <form id="loginForm" method="POST" action="loginpage.php" class="orderform">
                                <!-- Bejelentkezési űrlap tartalma -->
                                <div class="form-group">
                                    <input type="text" name="login_username" id="login_username" class="container_input" placeholder=" " required>
                                    <label for="login_username">Enter your username *</label>
                                </div>
                                <!-- Password input -->
                                <div class="form-group">
                                    <input type="password" name="login_password" id="login_password" class="" placeholder=" " required>
                                    <label for="login_password">Enter your password *</label>
                                </div>
                                <div class="form-group">
                                    <p>* The required fields must be filled out. Without feedback, we cannot process your request.</p>
                                </div>
                                <button class="sample_button" type="submit">LOGIN</button>

                            </form>

                        </div>

                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                            <!-- Regisztrációs űrlap -->
                            <form id="registrationForm" method="POST" action="RegistrationController.php" class="orderform">
                                <div class="form-group">
                                    <input type="text" name="first_name" id="first_name" class="container_input" placeholder=" " autocomplete="off" required="required">
                                    <label for="first_name">Enter your first name *</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="last_name" id="last_name" class="container_input" placeholder=" " autocomplete="off" required="required">
                                    <label for="last_name">Enter your last name *</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="container_input" placeholder=" " autocomplete="off" required="required">
                                    <label for="username">Enter your username *</label>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="container_input" placeholder=" " autocomplete="off" required="required">
                                    <label for="email">Enter your email address *</label>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="container_input" placeholder=" " required="required">
                                    <label for="password">Enter your password *</label>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_again" id="password_again" class="container_input" placeholder=" " required="required">
                                    <label for="password_again">Enter your password again *</label>
                                </div>
                                <div class="container_terms">
                                    <div class="wrapper">
                                        <input type="checkbox" name="terms" id="terms" value="accepted" required>
                                        <label><p class="m-0">Terms and conditions *</p></label>
                                    </div>
                                    <p>* The required fields must be filled out. Without feedback, we cannot process your request.</p>
                                </div>
                                <div class="form-group">
                                    <button class="sample_button" type="submit" name="user_register">REGISTER</button>
                                    <p id="have_account">Already have an account?</p>
                                    <button class="sample_button_reverse" id="backToLoginButton">BACK TO LOGIN</button>
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
                        <h3 class="m-0">CHECK ORDER STATUS</h3>
                        <hr>
                        <form method="POST" action="" class="orderform">
                                <div class="form-group">
                                    <input type="text" name="" id="" class="" placeholder=" " required>
                                    <label for="">Order number *</label>
                                </div>
                                <!-- Password input -->
                                <div class="form-group">
                                    <input type="" name="" id="" class="" placeholder=" " required>
                                    <label for="">Order email address *</label>
                                </div>
                                
                                <button class="sample_button_reverse" type="submit" name="">STATUS CHECK</button>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        //Bejelentkezési űrlap elküldése AJAX kéréssel
        document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Az alapértelmezett űrlap elküldésének megakadályozása
        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../../Backend/controllers/LoginController.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Sikeres kérés esetén átirányítás
                window.location.href = xhr.responseURL;
            } else if (xhr.status === 302) {
                console.error('A kérés átirányítást kapott.');
            } else {
                console.error('Hiba történt a kérés során.');
            }
        };
        xhr.send(formData);
        });

        //Regisztrációs űrlap elküldése AJAX kéréssel
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Az alapértelmezett űrlap elküldésének megakadályozása

        // Űrlap adatainak gyűjtése
        const formData = new FormData(this);

        // AJAX kérés konfigurálása
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../../Backend/controllers/RegistrationController.php', true); // Módosítás: közvetlenül a PHP fájlra mutatunk
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Fejléc hozzáadása az AJAX kéréshez

        // AJAX kérés küldése
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Sikeres kérés esetén kezelheted a választ itt
                console.log(xhr.responseText);
                alert(xhr.responseText); // Például megjelenítheted egy alertboxban
            } else {
                // Sikertelen kérés esetén kezelheted a hibát itt
                console.error('Hiba történt a kérés során.');
            }
        };

        // AJAX kérés küldése
        xhr.send(formData);
    });


        //Bejelentkezés és regisztrációs űrlap közötti váltás
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
