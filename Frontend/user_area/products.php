<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- CSS linkek -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/user_area/css/header.css">
    <link rel="stylesheet" href="../../public/user_area/css/products.css">
    <link rel="stylesheet" href="../../public/user_area/css/font_import.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <!-- Header rész -->
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
    <!--<div class="container-fluid">
        <div class="banner-container">
            <img class="banner-img" src="../../public/img/bannerimg_2.png" alt="Banner kép">
        </div>
    </div>-->
    <div class="container-fluid primary_container mt-4">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-3">
                <div class="type_header mb-2">
                    <h4>Filters</h4>
                </div>
                <form id="filterForm">
                    <div class="filter">
                        <h3>Types:</h3>
                        <div class="type_filter">
                            <!-- Típusok dinamikus betöltése -->
                        </div>
                    </div>
                    <hr>
                    <div class="filter">
                        <h3>Colours:</h3>
                        <div class="color_filter">
                            <!-- Színek dinamikus betöltése -->
                        </div>
                    </div>
                    <hr>
                    <div class="filter">
                        <h3>Materials:</h3>
                        <div class="material_filter">
                            <!-- Anyagok dinamikus betöltése -->
                        </div>
                    </div>
                </form>
                <hr>
            </div>
            <div class="col-12 col-md-9 col-lg-9">
                <div id="productDisplay" class="productdisplay row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <!-- Termékek dinamikusan frissülnek ide úgy, hogy minden termék egy külön productBoxot kap. -->
                </div>
            </div>
        </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Js/Header.js"></script>
    <script src="js/ProductsFetch.js"></script>
    <script>
        
    </script>
</body>
</html>
