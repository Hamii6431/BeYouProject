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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<header>
    <div class="header-container">
        <div class="header-logo">
            <img class="logo-image" src="../../public/img/Logo.png" alt="">
        </div>
        <div class="header-right">
            <div class="admin-name-container">

            </div>
            <div class="admin-actions">
                <span class="material-symbols-outlined icon-logout">logout</span>
            </div>
        </div>
    </div>
</header>

<div class="container main-container">
    <div class="row">
        <div class="col-lg-3">
            <div class="sidebar-menu">
                <div class="menu-item" id="accountMenuItem">Account</div>
                <div class="menu-item" id="manageAccountForm">Manage Account</div>
                <div class="menu-item" id="manageShippingForm">Manage Shipping</div>
                <div class="menu-item" id="ordersMenuItem">My Orders</div>
            </div>
        </div>
        <div class="col-lg-9 col-12">
            <div class="content-container" id="profileContainer">
                <!-- Content loaded dynamically -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
