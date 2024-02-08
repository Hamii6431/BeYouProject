<?php
require_once '../../Backend/includes/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navigation</title>
    <link rel="stylesheet" href="../../public/user_area/css/header.css">
    <link rel="stylesheet" href="../../public/user_area/css/font_import.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <header>
        <div class="header_headerdiv1">
            <div class="header_headerlogo">
                <img class="header_img" src="../../public/img/Logo.png" alt=""> 
            </div>
            <div class="header_headericons">
                <?php
                if (isset($_SESSION['session_user_id'])) {
                    // Ha be van jelentkezve és a profil gombra kattint a felhasználó a profilpage.php oldalra továbbítjuk.
                    echo '<a href="profilepage.php">';
                } else {
                    // Ha nincs bejelentkezve és a profil gombra kattint a felhasználó a lloginpage.php oldalra továbbítjuk.
                    echo '<a href="loginpage.php">';
                }
                ?>
                    <span class="material-symbols-outlined iconstyle">
                        person
                    </span>
                </a>
                <?php
                if (isset($_SESSION['session_user_id'])) {
                    // Ha be van jelentkezve és a kosár gombra kattint a felhasználó a cartpage.php oldalra továbbítjuk.
                    echo '<a href="cartpage.php">';
                } else {
                    // Ha nincs bejelentkezve és a kosár gombra kattint a felhasználó a loginpage.php oldalra továbbítjuk.
                    echo '<a href="loginpage.php">';
                }
                ?>
                    <span class="material-symbols-outlined iconstyle">
                        shopping_bag
                    </span>
                </a>
                <a href="">
                <?php
                if (isset($_SESSION['session_user_id'])) {
                    // Ha be van jelentkezve és a logout gombra kattint a felhasználó a logout.php oldalra továbbítjuk.
                    echo '<a href="logout.php">';
                } else {

                }
                ?>
                    <span class="material-symbols-outlined iconstyle">
                        logout
                    </span>
                </a>
            </div>
        </div>

        <div class="header_headerdiv2">
            <nav class="header_navbar">
                <ul class="header_nav-menu">
                    <li class="header_nav-item">
                        <a href="#" class="header_nav-link">Home</a>
                    </li>
                    <li class="header_nav-item">
                        <a href="products.php" class="header_nav-link">All products</a>
                    </li>
                    <li class="header_nav-item">
                        <a href="rings.php" class="header_nav-link">Rings</a>
                    </li>
                    <li class="header_nav-item">
                        <a href="bracelets.php" class="header_nav-link">Bracelets</a>
                    </li>
                    <li class="header_nav-item">
                        <a href="necklaces.php" class="header_nav-link">Necklaces</a>
                    </li>
                </ul>
                <div class="header_hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                
            </nav>
        </div>
    </header>
    <script>

        //Amennyiben a kijelző mérete 768 pixel alá esik (mobilnézet)
        //megjelenik a hamburger menü amivel a felhasználó elő tudja hívni a navigációs sávot.
        const header_hamburger = document.querySelector(".header_hamburger");
        const header_navMenu = document.querySelector(".header_nav-menu");

        header_hamburger.addEventListener("click", () => {
            header_hamburger.classList.toggle("active");
            header_navMenu.classList.toggle("active");
        }); // Add a semicolon here

    </script>
</body>

</html>
