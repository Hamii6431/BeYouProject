<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    
    <!-- CSS linkek -->
    <link rel="stylesheet" href="css/Header2.css">
    <link rel="stylesheet" href="css/Products.css">
    <link rel="stylesheet" href="css/ImportFont.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    
    </head>

<body>
    
    <!-- Navigációs sáv -->
    <nav class="container-navbar">
        <!-- Logo -->
        <div class="logo">
            <img src="../../public/img/PngLogo.png" alt="Logo">
        </div>
        <!-- Navigációs menü -->
        <div class="navigation-menu">
            <!-- Menüpontok -->
            <div class="navigation-menu-item"><a href="Home.php">Home</a></div>
            <div class="navigation-menu-item"><a href="Products.php">All products</a></div>
            <div class="navigation-menu-item"><a href="Rings.html">Rings</a></div>
            <div class="navigation-menu-item"><a href="Bracelets.html">Bracelets</a></div>
            <div class="navigation-menu-item"><a href="Necklaces.html">Necklaces</a></div>
        </div>

        <!-- Ikonok a felhasználói interakciókhoz -->
        <div class="icon-container">
            <form id="personForm" action="#" method="POST">
                <button type="button" class="icon-button" id="personIcon">
                    <span class="material-symbols-outlined iconstyle">person</span>
                </button>
                <button type="button" class="icon-button" id="shoppingBagIcon">
                    <span class="material-symbols-outlined iconstyle">shopping_bag</span>
                </button>
                <button type="button" class="icon-button" id="logoutIcon">
                    <span class="material-symbols-outlined iconstyle">logout</span>
                </button>
            </form>
        </div>
    </nav>

<div class="container-for">
    <div class="container-filters">
        <div class="type_header">
            <h4>Filters</h4>
        </div>
        <form id="filterForm">
            <div class="filter">
                <h3>Types:</h3>
                <div class="type_filter">
                    <!-- Típusok dinamikus betöltése -->
                </div>
            </div>
            <hr>
            <div class="filter">
                <h3>Colours:</h3>
                <div class="color_filter">
                    <!-- Színek dinamikus betöltése -->
                </div>
            </div>
            <hr>
            <div class="filter">
                <h3>Materials:</h3>
                <div class="material_filter">
                    <!-- Anyagok dinamikus betöltése -->
                </div>
            </div>
        </form>
    </div>
    <div class="container-products" id="productDisplay">
        
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Js/Navbar.js"></script>


<script src="js/ProductsFetch.js"></script>
</body>
</html>
