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
    <link rel="stylesheet" href="css/Cartpage.css">
    <link rel="stylesheet" href="css/Order.css">
    <!-- Google Icons és Font Awesome ikonok -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>

    </style>
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

    <style>
    .container-for-cartpage {
        padding-top: 30vh;
        padding-left: 10rem;
        padding-right: 10rem;
        text-align: center;
        height: 100vh; /* Teljes képernyős magasság */

    }
    .collection{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .collection h1 {
        font-weight: bold;
        color:#3A4049;
    }

    .collection h5 {
        color: #545E67;
    }
    .collection button {
        font-weight:bold;
        border-radius: 16px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        width: 200px; /* Gomb szélességének beállítása */
        background-color: rgb(131, 165, 202);
        color: #F8FAF7;
        justify-content: center;
        height: 50px;
        border: none; /* A gomb keretének eltávolítása */
        cursor: pointer; /* Mutató ikon a gomb felett */
        font-size: 16px; /* Betűméret beállítása */
        margin-top: 20px; /* Távolság a felső elemhez */
    }





.wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
}

.animated-check {
    height: 5em;
    width: 5em
}

.animated-check path {
    fill: none;
    stroke: rgb(131, 165, 202);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    stroke-width: 4;
    stroke-dasharray: 23;
    stroke-dashoffset: 23;
    animation: draw 1s linear forwards;
    stroke-linecap: round;
    stroke-linejoin: round
}

@keyframes draw {
    to {
        stroke-dashoffset: 0
    }
}
</style>

</nav>

<div class="container-for-cartpage">
    <div class="collection">
    <div class="wrapper"> <svg class="animated-check" viewBox="0 0 24 24">
        <path d="M4.1 12.7L9 17.6 20.3 6.3" fill="none" /> </svg>
</div>
        <h1>Thank you for your order</h1>
        <h5>Your order has been placed and is being processed.</h5>
        <button onclick="redirectToHome()">Back to homepage</button>
    </div>
</div>

<!-- JavaScript és jQuery könyvtárak -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Js/Navbar.js"></script>
<script>

function redirectToHome() {
    window.location.href = 'Home.php';
}

</script>
</body>
</html>
