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
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab:wght@200;300;600&display=swap" rel="stylesheet">

    <!-- CSS linkek -->
    <link rel="stylesheet" href="css/Header2.css">
    <link rel="stylesheet" href="css/ProfilePage.css">
    <link rel="stylesheet" href="css/ImportFont.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
<nav class="container-navbar">
    <!-- Logo -->
    <div class="logo">
        <img src="../../public/img/PngLogo.png" alt="Logo">
    </div>
    <!-- Navigációs menü -->
    <div class="navigation-menu">
        <!-- Menüpontok -->
        <div class="navigation-menu-item"><a href="Home.html">Home</a></div>
        <div class="navigation-menu-item"><a href="Products.html">All products</a></div>
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
    <div class="container-profile-menu">
        <div class="profile-name-image">
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
    <div class="container-surface" id="profileContainer">
        <!-- Profil tartalom helye -->
    </div>
</div>

    <!-- JavaScript linkek -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Js/ProfileManager.js"></script>
    <script src="Js/Navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>

$(document).ready(function() {
    // Kattintás eseménykezelő hozzáadása a menüpontokhoz
    $('.container-menuitem').click(function() {
        var menuItemId = $(this).attr('id'); // Kiválasztott menüpont azonosítója
        loadContent(menuItemId); // Tartalom betöltése AJAX kéréssel
    });

    // Felhasználó nevének betöltése
    loadFullName(<?php echo json_encode($_SESSION['user_id']); ?>);
});

function loadContent(menuItemId) {
    $.ajax({
        type: 'POST',
        url: '../../Backend/controllers/ProfileContentController.php', // A vezérlő elérési útvonala
        data: { menuItemId: menuItemId }, // Küldendő adatok
        success: function(response) {
            $('#profileContainer').html(response); // Az AJAX válasz beillesztése a profil konténerbe
        },
        error: function(xhr, status, error) {
            console.error("Hiba történt: " + xhr.responseText);
        }
    });
}

function loadFullName(userId) {
    $.ajax({
        type: 'POST',
        url: '../../Backend/models/UserModel.php', // Az elérési út a PHP fájlhoz, amely lekéri a felhasználó nevét
        data: { userId: userId },
        success: function(response) {
            $('.profile-name').text(response.trim()); // A válasz beállítása a profil névhez
        },
        error: function(xhr, status, error) {
            console.error("Hiba: " + error);
        }
    });
}
</script>


    </script>
</body>
</html>
