<?php
session_start();
include '../assets/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab:wght@200;300;600&display=swap" rel="stylesheet">
    <title>Profil oldal</title>
    <link rel="stylesheet" href="../../public/user_area/css/profilepage.css">
    <link rel="stylesheet" href="../../public/user_area/css/font_import.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Js/ProfileManager.js"></script>
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

