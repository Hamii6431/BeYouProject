<?php
include '../../Backend/includes/connect.php';
include '../../Backend/includes/session.php';
include '../assets/header.php';
include '../../Backend/user_area/user_login.php';
include '../../Backend/user_area/user_registration.php';
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
            height: 60%;   
            border-left: 1px solid #27251F;
            position: absolute;
            left: 50%;
            transform: translateX(-50%); 
        }

        .container_tab_items{
            display:flex;
            justify-content: space-between;
            margin-bottom: 1rem;
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
        padding-top: 15px;
        box-sizing: border-box;
    }

    .form-group label {

        position: absolute;
        top: 0;
        left: 5px;
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
    .sample_button{
        background-color: #27251F;
        color: white;
        margin-bottom: 0.5rem;
    }
    .sample_button:hover {
        transition: 0.3s;
        background-color: #000000;
        color: white;
    }
    .sample_button_reverse{
        background-color: white;
        color: black;
        border:1px solid black;
    }
    .sample_button_reverse:hover{
        transition: 0.3s;
        background-color: #000000;
        color: white;
    }


    .wrapper {
    width: 100%;
    display: flex;
    margin-bottom: 1rem;
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
.nav-link.active{
    color: aqua !important;
}
#have_account{
    margin-bottom: 0.5rem;
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

                                <button class="sample_button" type="submit" name="user_login">LOGIN</button>

                            </form>

                        </div>

                        <!-- Regisztrációs űrlap tartalma -->
                        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                            <form action="loginpage.php#pills-login" method="post" class="orderform">
                                <!-- Felhasználónév -->
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="container_input" placeholder=" " autocomplete="off" required="required">
                                    <label for="username">Enter your username *</label>
                                </div>

                                <!-- Rendes név -->
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="container_input" placeholder=" " autocomplete="off" required="required">
                                    <label for="name">Enter your full name *</label>
                                </div>

                                <!-- E-mail cím -->
                                <div class="form-group">
                                    <input type="email" name="user_email" id="user_email" class="container_input" placeholder=" " autocomplete="off" required="required">
                                    <label for="user_email">Enter your email address *</label>
                                </div>

                                <!-- Jelszó -->
                                <div class="form-group">
                                    <input type="password" name="user_password" id="user_password" class="container_input" placeholder=" " required="required">
                                    <label for="user_password">Enter your password *</label>
                                </div>

                                <!-- Jelszó újra -->
                                <div class="form-group">
                                    <input type="password" name="user_password_again" id="user_password_again" class="container_input" placeholder=" " required="required">
                                    <label for="user_password_again">Enter your password again *</label>
                                </div>

                                <div class="container_terms">
                                    <div class="wrapper">
                                        <input type="checkbox" name="" value="">
                                        <label><p class="m-0"href="termsandconditions.php">Terms and conditions *</p></label>  <!--Módosítani-->
                                    </div> 
                                    <p>* The required fields must be filled out. Without feedback, we cannot process your request.</p>
                                </div>

                                <!-- Regisztrációs gomb -->
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
                                    <input type="text" name="login_username" id="login_username" class="" placeholder=" " required>
                                    <label for="login_username">Order number *</label>
                                </div>
                                <!-- Password input -->
                                <div class="form-group">
                                    <input type="password" name="login_password" id="login_password" class="" placeholder=" " required>
                                    <label for="login_password">Order email address *</label>
                                </div>
                                
                                <button class="sample_button_reverse" type="submit" name="">STATUS CHECK</button>

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
