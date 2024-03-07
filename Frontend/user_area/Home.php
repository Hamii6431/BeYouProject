<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Stíluslapok és ikonok linkelése -->
    <link rel="stylesheet" href="css/Home.css">
    <link rel="stylesheet" href="css/Navbar.css">
    <link rel="stylesheet" href="css/ImportFont.css">
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

    <!-- Fő tartalom -->
    <div class="container-for">
        <!-- Kollekció bemutatása -->
        <div class="collection">
            <h1>Our Collection</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat, beatae cum neque repudiandae quasi quod quidem blanditiis dolores. Optio?</p>
            <button>Explore Now</button>
        </div>
    </div>

    <!-- Kártyák konténere -->
    <div class="container-for-cards">
        <div class="box-for-cards">
            <div class="card-text-side">
                <div class="card-text-collection">
                    <h5>You want something new?</h5>
                    <h2>Explore Rings</h2>
                    <h5>Creative designed rings</h5>
                </div>
            </div>
            <div class="card-image-side">
                <img src="../../public/img/bg-removed-ring.png">
            </div>
        </div>
        <div class="box-for-cards">
            <div class="card-text-side">
                <div class="card-text-collection">
                    <h5>You want something new?</h5>
                    <h2>Explore Rings</h2>
                    <h5>Creative designed rings</h5>
                </div>
            </div>
            <div class="card-image-side">
                <img src="../../public/img/bg-removed-ring.png">
            </div>
        </div>
        <div class="box-for-cards">
            <div class="card-text-side">
                <div class="card-text-collection">
                    <h5>You want something new?</h5>
                    <h2>Explore Rings</h2>
                    <h5>Creative designed rings</h5>
                </div>
            </div>
            <div class="card-image-side">
                <img src="../../public/img/bg-removed-ring.png">
            </div>
        </div>
    </div>

    <!-- További tartalom konténer -->
    <div class="container-for-content">
        <div class="container-for-content-left">
            <img src="../../public/img/jew-stock-1.png">
        </div>
        <div class="container-for-content-right">
            <h1>Exclusive rings, unique collections!</h1>
            <p>Take a look through our collection to find the ideal ring, necklace, or bracelet that matches your style or would make a perfect gift.</p>
        </div>
    </div>

    <!-- Üres hely -->
    <div class="spacer">
        <!-- Szükség esetén itt lehet még egyéb elemek -->
    </div>

    <!-- JavaScript kód -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Js/Navbar.js"></script>
</body>
</html>
