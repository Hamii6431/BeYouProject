<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil oldal</title>

    <!-- Fontok importálása -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- CSS linkek -->
    <link rel="stylesheet" href="css/Navbar.css">
    <link rel="stylesheet" href="css/Toast.css">
    <link rel="stylesheet" href="css/ImportFont.css">
    <link rel="stylesheet" href="css/ProfilePage.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
<!-- Navigációs sáv -->
<nav class="container-navbar">
    <div class="logo">
        <img src="../../public/img/PngLogo.png" alt="Logo">
    </div>
    <div class="hamburger-menu" onclick="toggleMenu()">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
    <div class="navigation-menu">
        <!-- Navigációs linkek -->
        <div class="navigation-menu-item"><a href="Home.php">Home</a></div>
        <div class="navigation-menu-item"><a href="Products.php">All products</a></div>
        <div class="navigation-menu-item"><a href="Rings.html">Rings</a></div>
        <div class="navigation-menu-item"><a href="Bracelets.html">Bracelets</a></div>
        <div class="navigation-menu-item"><a href="Necklaces.html">Necklaces</a></div>
    <!-- Navigációs sáv: Felhasználói interakciók ikonjai -->
    <div class="hamburger-menu-icons">
        <div class="navigation-menu-item hamburger-item personIcon"><a>Profile<button type="button" class="icon-button"><span class="material-symbols-outlined iconstyle">person</span></button></a></div>
        <div class="navigation-menu-item hamburger-item shoppingBagIcon"><a>Cart<button type="button" class="icon-button"><span class="material-symbols-outlined iconstyle">shopping_bag</span></button></a></div>
        <div class="navigation-menu-item hamburger-item logoutIcon"><a>Logout<button type="button" class="icon-button"><span class="material-symbols-outlined iconstyle">logout</span></button></a></div>
    </div>
    </div>
    <!-- Nagy képernyős felhasználói interakciók ikonjai -->
    <div class="icon-container">
        <button type="button" class="icon-button personIcon"><span class="material-symbols-outlined iconstyle">person</span></button>
        <button type="button" class="icon-button shoppingBagIcon"><span class="material-symbols-outlined iconstyle">shopping_bag</span></button>
        <button type="button" class="icon-button logoutIcon"><span class="material-symbols-outlined iconstyle">logout</span></button>
    </div>

    
</nav>

    <div class="container-for-profilepage">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="profile-name-image mb-3">
                    <div class="preview-image">
                        <img src="../../public/img/download.jpg" alt="">
                    </div>
                    <h5 class="profile-name"></h5>
                </div>
                <div class="container-menu">
                    <!-- Menüpontok -->
                    <div class="container-menuitem" id="accountMenuItem">Account</div>
                    <div class="container-menuitem" id="manageAccountForm">Manage Account</div>
                    <div class="container-menuitem" id="manageShippingForm">Manage Shipping</div>
                    <div class="container-menuitem" id="ordersMenuItem">My Orders</div>
                </div>
            </div>
            <div class="container-surface col-lg-9 col-md-6" id="profileContainer">
                <!-- Profil tartalom helye -->
                <h2>Profil Tartalom</h2>
            </div>
        </div>
    </div>

    <!-- JavaScript linkek -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Js/ProfileManager.js"></script>
    <script src="Js/Navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
