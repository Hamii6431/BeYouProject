

<?php 
session_start();
// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve ha nincs irányítjuk a loginpage.php-re.
if (!isset($_SESSION['session_username'])) {
    header('Location: loginpage.php');
    exit();
}

require_once '../../Backend/includes/connect.php'; // Ha szükséges
require_once '../../Backend/controllers/ProfileContentController.php'; // Ha szükséges


echo $_SESSION['session_username']; //kiírjuk az aktív sessiont             -ideiglenes
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
                            <h5><?php echo $_SESSION['session_name']; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="container_menu">
                    <!-- Menüpontok -->
                    <div class="container_menuitem" onclick="fetchContent('accountMenuItem')">Account</div>
                    <div class="container_menuitem" onclick="fetchContent('manageAccountMenuItem')">Manage Account</div>
                    <div class="container_menuitem" onclick="fetchContent('shippingAddressesMenuItem')">Shipping Addresses</div>
                    <div class="container_menuitem" onclick="fetchContent('myOrdersMenuItem')">My Orders</div>
                </div>
            </div>
            <div class="col-lg-9 col-12">
                <div class="container_surface" id="profileContainer">
                    <!-- Az oldal tartalmát amit kiválasztottunk a menüpontokkal ide töltjük be.-->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../public/user_area/js/profile.js"></script>
    <script>
        function fetchContent(menuItemId) {
            fetch(`../../Backend/controllers/ProfileContentController.php?menuItemId=${menuItemId}&userId=${<?php echo $_SESSION['user_id']; ?>}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('profileContainer').innerHTML = html;
                })
                .catch(error => console.error('Error loading the content:', error));
        }
    </script>
</body>
</html>

<?php 
include '../assets/footer.php'; 
?>
