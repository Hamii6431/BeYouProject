<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termékek</title>
    <link rel="stylesheet" href="css/AdminPage.css">
    <link rel="stylesheet" href="css/ImportFont.css">
    <link rel="stylesheet" href="css/Header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>


<body>



<div class="container-for">
    <div class="container-menu">
        <div class="menu-logo">
            <img src="../../public/img/PngLogo.png" alt="Logo">
        </div>
        <!-- Menüpontok -->
        <div class="container-menuitem" id="accountMenuItem">Dashboard</div>
        <div class="container-menuitem" id="manageAccountForm">Analytics</div>
        <div class="container-menuitem" id="manageShippingForm">Manage Products</div>
        <div class="container-menuitem" id="ordersMenuItem">Manage Users</div>
        <div class="container-menuitem" id="ordersMenuItem">Manage Orders</div>
    </div>

    <div class="container-surface" id="adminContainer">

    </div>
</div>


    <!-- JavaScript linkek -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Js/Navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    </script>
</body>
</html>
