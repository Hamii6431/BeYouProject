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
    <!--<link rel="stylesheet" href="css/Navbar.css">-->
    <link rel="stylesheet" href="css/ImportFont.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
</head>
<style>
/* Navigációs sáv stílusai */
.container-navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background-color: #D3DCE2;
    height: 12vh;
    padding-left: 10rem;
    padding-right: 10rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    transition: top 0.2s;
    z-index: 1000;  
}
@media (max-width: 1200px) {
    .container-navbar {
    padding-left: 4rem;
    padding-right: 4rem;
}
}
@media (max-width: 576px) {
    .container-navbar {
    padding-left: 2rem;
    padding-right: 2rem;
}
}





.logo img {
    height: 12vh;
}

/* Navigációs menü és elemeinek stílusai */
.navigation-menu {
    display: flex;
    justify-content: space-around;
    gap: 5px;
    align-items: center;
    padding: 20px 0;
}

.navigation-menu-item {
    display: flex;
    align-items: center;
    height: 35px;
    transition:0.5s ease;
    border-radius: 6px;
}

.navigation-menu-item a {
    text-align: center;
    font-size: 120%;
    margin: 0 15px;
    text-decoration-line: none;
    color: #3A4049;
}

.navigation-menu-item:hover {
    background-color: #F8FAF7;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    border-radius: 12px;
}


/* Ikonok és gombok stílusai */
.icon-container {
    display: flex;
    flex-direction: row;
    gap: 22px;
}

.iconstyle {
    font-size: 24px;
    transform: scale(1.2);
    color: #3A4049;
}

.icon-button {
    padding: 0 20 0 20px;
    background-color: transparent;
    border: none;
    cursor: pointer;
    scale: 110%;
}
.hamburger-menu{
    display: none;
}

/* Stílusok kisebb képernyőkhöz */
@media (max-width: 933px) {
    .hamburger-menu {
        display: block;
        cursor: pointer;
        font-size: 30px;
        user-select: none;
    }
    .hamburger-menu.active .bar:nth-child(2) {
        opacity: 0;
    }

    .hamburger-menu.active .bar:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    .hamburger-menu.active .bar:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }

    .navigation-menu {
        display: none;
        flex-direction: column;
        width: 100%;
        position: absolute;
        top: 12vh;
        left: 0;
        background-color: #D3DCE2;
        z-index: 1001;
        box-shadow: 0 2px 4px rgba(0.4,0,0,0.4);
    }
    .navigation-menu-item a {
    text-align: center;
    font-size: 120%;
    margin: 0 30px;
    text-decoration-line: none;
    color: #3A4049;
}

.navigation-menu-item:hover {
    background-color: #F8FAF7;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    border-radius: 12px;
}
    
    .navigation-menu.active {
        display: flex;
        border-top: 1px solid #B2BCC6;
    }


    .icon-container {
        display: none;
    }
}





.bar{
    display:block;
    width:25px;
    height: 3px;
    margin:5px auto;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    background-color: black;
}
</style>

<body>
<nav class="container-navbar">
    <!-- Logo -->
    <div class="logo">
        <img src="../../public/img/PngLogo.png" alt="Logo">
    </div>

    <!-- Hamburger menü ikon -->
    <div class="hamburger-menu" onclick="toggleMenu()">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

    <!-- Navigációs menü -->
    <div class="navigation-menu">
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
        <div class="box-for-cards" id="CARD1">>
            <div class="card-text-side">
                <div class="card-text-collection">
                    <h5>Minden termékünk egyedileg tervezve. Tekitse meg kollekcióinkat.</h5>
                    <h2>Explore Rings</h2>
                    <h5>Creative designed rings</h5>
                </div>
            </div>
            <div class="card-image-side">
                <img src="../../public/img/bg-removed-ring.png">
            </div>
        </div>
        <div class="box-for-cards" id="CARD2">
            <div class="card-text-side">
                <div class="card-text-collection">
                    <h5>You want something new?</h5>
                    <h2>Explore Rings</h2>
                    <h5>Creative designed rings</h5>
                </div>
            </div>
            <div class="card-image-side" >

            </div>
        </div>
        <div class="box-for-cards" id="CARD3">
            <div class="card-text-side">
                <div class="card-text-collection">
                    <h5>You want something new?</h5>
                    <h2>Explore Necklaces</h2>
                    <h5>Creative designed Necklaces</h5>
                </div>
            </div>
            <div class="card-image-side">

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
    <script>
function toggleMenu() {
    const hamburgerMenu = document.querySelector(".hamburger-menu");
    const navigationMenu = document.querySelector(".navigation-menu");
    hamburgerMenu.classList.toggle("active");
    navigationMenu.classList.toggle("active");
}
</script>


</body>
</html>
