<?php
// Munkamenet indítása minden PHP oldalon szükséges, hogy hozzáférjünk a munkamenet változókhoz
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <!-- Stíluslapok linkelése -->
    <link rel="stylesheet" href="css/Navbar.css">
    <link rel="stylesheet" href="css/Toast.css">
    <link rel="stylesheet" href="css/ImportFont.css">
    <link rel="stylesheet" href="css/CartPage.css">

    <!-- Google Icons és Font Awesome ikonok -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

<div class="container-for-cartpage">
    <div class="row">
        <!-- Kosár tartalma -->
        <div class="cart-items col-lg-8 col-md-12">
            <div class="cart-items-head">
                <h2>Shopping Cart</h2>
                <h2 id="cartItemCount"></h2>
            </div>
            <div class="cart-items-body">
                <!-- Ide töltődik be a kosár tartalma JavaScript segítségével -->
            </div>
        </div>
        <!-- Rendelés összegzése -->
        <div class="cart-summary col-lg-4 col-md-12">
            <div class="summary-head">
                <h2>Order Overview</h2>
            </div>
            <div class="summary-subtotal">
                <div class="subtotal-text">
                    <h5>Subtotal</h5>
                    <p>Shipping</p>
                </div>
                <div class="subtotal-price">
                    <h5></h5>
                    <p>$0.00</p>
                </div>
            </div>
            <div class="summary-total">
                <h4>Total Price</h4> 
                <h4 id='totalPrice'>$0.00</h4>
            </div>
            <div class="summary-button">
                <button id="placeOrderButton" class="sample-button">Place order</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript és jQuery könyvtárak -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Js/Navbar.js"></script>
<script src="Js/CartPage.js"></script>
</body>
</html>
