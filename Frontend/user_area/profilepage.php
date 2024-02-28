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
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab:wght@200;300;600&display=swap" rel="stylesheet">

    <!-- CSS linkek -->
    <link rel="stylesheet" href="css/Header.css">
    <link rel="stylesheet" href="css/ProfilePage.css">
    <link rel="stylesheet" href="css/ImportFont.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <!-- Header rész -->
    <header>
        <div class="header_headerdiv1">
            <div class="header_headerlogo">
                <img class="header_img" src="../../public/img/Logo.png" alt="">
            </div>
            <div class="header_headericons">
                <!-- Form az űrlap elküldéséhez -->
                <form id="personForm" action="#" method="POST">
                    <button type="button" id="personIcon">
                        <span class="material-symbols-outlined iconstyle">person</span>
                    </button>
                    <button type="button" id="shoppingBagIcon">
                        <span class="material-symbols-outlined iconstyle">shopping_bag</span>
                    </button>
                    <button type="button" id="logoutIcon">
                        <span class="material-symbols-outlined iconstyle">logout</span>
                    </button>
                </form>
                <!-- További ikonok -->
            </div>
        </div>

        <div class="header_headerdiv2">
            <nav class="header_navbar">
                <ul class="header_nav-menu">
                    <li class="header_nav-item">
                        <a href="#" class="header_nav-link">Home</a>
                    </li>
                    <li class="header_nav-item">
                        <a href="Products.html" class="header_nav-link">All products</a>
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

    <div class="container container_primary">
        <div class="row">
            <div class="col-lg-3">
                <div class="container_profil_preview">
                    <div class="container_profil_vertical">
                        <div class="container_profil_preview_image">
                            <img src="../../public/img/download.jpg" alt="">
                        </div>
                        <div class="container_profil_preview_name">
                            <h5></h5>
                        </div>
                    </div>
                </div>
                <div class="container_menu">
                    <!-- Menüpontok -->
                    <div class="container_menuitem" id="accountMenuItem">Account</div>
                    <div class="container_menuitem" id="manageAccountForm">Manage Account</div>
                    <div class="container_menuitem" id="manageShippingForm">Manage Shipping</div>
                    <div class="container_menuitem" id="ordersMenuItem">My Orders</div>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="container_surface" id="profileContainer">
                    <!-- Az oldal tartalmát amit kiválasztottunk a menüpontokkal ide töltjük be.-->
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript linkek -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Js/ProfileManager.js"></script>
    <script src="Js/Header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Az oldal betöltésekor futtatott függvény
        window.onload = function() {
            // Felhasználó nevének beállítása
            getUserNameByUserId(<?php echo $_SESSION['user_id']; ?>);
        }

        // Felhasználónév lekérésének függvénye AJAX használatával
        function getUserNameByUserId(userId) {
            $.ajax({
                type: 'POST',
                url: '../../Backend/models/UserModel.php', // Az elérési út a PHP fájlhoz, amely lekéri a felhasználó teljes nevét
                data: { userId: userId },
                success: function(response) {
                    // Sikeres válasz esetén a felhasználó nevének beállítása
                    var userName = document.querySelector('.container_profil_preview_name h5');
                    userName.innerText = response;
                },
                error: function(xhr, status, error) {
                    // Hibakezelés
                    console.error(error);
                }
            });
        }
    </script>
</body>
</html>
