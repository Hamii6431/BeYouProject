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
        <div class="navigation-menu-item hamburger-item personIcon"><a>My Profile<button type="button" class="icon-button"><span class="material-symbols-outlined iconstyle">person</span></button></a></div>
        <div class="navigation-menu-item hamburger-item shoppingBagIcon"><a>Cart<button type="button" class="icon-button"><span class="material-symbols-outlined iconstyle">shopping_bag</span></button></a></div>
        <div class="navigation-menu-item hamburger-item logoutIcon"><a>Logout<button type="button" class="icon-button"><span class="material-symbols-outlined iconstyle">logout</span></button></a></div>
    </div>

    <!-- Nagy képernyős felhasználói interakciók ikonjai -->
    <div class="icon-container">
        <button type="button" class="icon-button personIcon"><span class="material-symbols-outlined iconstyle">person</span></button>
        <button type="button" class="icon-button shoppingBagIcon"><span class="material-symbols-outlined iconstyle">shopping_bag</span></button>
        <button type="button" class="icon-button logoutIcon"><span class="material-symbols-outlined iconstyle">logout</span></button>
    </div>

    
</nav>

<!-- Fő tartalom -->
<div class="container-for">
    <div class="collection">
        <h1>Our Collection</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat, beatae cum neque repudiandae quasi quod quidem blanditiis dolores. Optio?</p>
        <button>Explore Now</button>
    </div>
</div>

<!-- Kártyák konténere -->
<div class="container-for-cards row">
    <div class="box-for-cards col-lg-4 col-md-12" id="CARD1"></div>
    <div class="box-for-cards col-lg-3 col-md-12" id="CARD2"></div>
    <div class="box-for-cards col-lg-4 col-md-12" id="CARD3">
        <div class="card-text-side">
            <div class="card-text-collection">
                <h5>You want something new?</h5>
                <h2>Explore Necklaces</h2>
                <h5>Creative designed Necklaces</h5>
            </div>
        </div>
        <div class="card-image-side"></div>
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

<!-- JavaScript kód -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Js/Navbar.js"></script>
</body>
</html>
