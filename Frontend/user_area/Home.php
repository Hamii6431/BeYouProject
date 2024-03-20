<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Stíluslapok és ikonok linkelése -->
    <link rel="stylesheet" href="css/Navbar.css">
    <link rel="stylesheet" href="css/Home.css">
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
        <div class="navigation-menu-item hamburger-item personIcon"><a>Profile<button type="button" class="icon-button"><span class="material-symbols-outlined iconstyle">person</span></button></a></div>
        <div class="navigation-menu-item hamburger-item shoppingBagIcon"><a>Cart<button type="button" class="icon-button"><span class="material-symbols-outlined iconstyle">shopping_bag</span></button></a></div>
        <div class="navigation-menu-item hamburger-item logoutIcon"><a>Logout<button type="button" class="icon-button"><span class="material-symbols-outlined iconstyle">logout</span></button></a></div>
    </div>
    </div>
    <!-- Nagy képernyős felhasználói interakciók ikonjai -->
    <div class="icon-container">
        <button type="button" class="icon-button personIcon"><span class="material-symbols-outlined iconstyle">person</span></button>
        <button type="button" class="icon-button shoppingBagIcon"><span class="material-symbols-outlined iconstyle">shopping_bag</span></button>
        <button type="button" class="icon-button logoutIcon"><span class="material-symbols-outlined iconstyle">logout</span></button>
    </div>

    
</nav>

<!-- Fő tartalom -->
<div class="container-for-home">
    <div class="collection">
        <h1>Our Collection</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat, beatae cum neque repudiandae quasi quod quidem blanditiis dolores. Optio?</p>
        <button>Explore Now</button>
    </div>
</div>

<!-- Kártyák konténere -->
<div class="container-for-cards">
    <div class="box-for-cards col-lg-4 col-md-12">
        <div class="card-content">
            <h5>Design Creative</h5>
            <h2>Ring Jewelry Design</h2>
            <p>From $60.99 - Sale 20%</p>
        </div>
        <img src="../../public/img/ring-1.png" alt="Ring Image" class="card-image">
    </div>

    <div class="box-for-cards col-lg-3 col-md-12">
        <div class="card-content">
            <h5>Design Creative</h5>
            <h2>Ring Jewelry Design</h2>
            <p>From $60.99 - Sale 20%</p>
        </div>
    </div>
    <div class="box-for-cards col-lg-4 col-md-12">
        <div class="card-content">
            <h5>Design Creative</h5>
            <h2>Ring Jewelry Design</h2>
            <p>From $60.99 - Sale 20%</p>
        </div>
        <img src="../../public/img/ring-1.png" alt="Ring Image" class="card-image">
    </div>
    <!-- További kártyák helye... -->
</div>


<!-- További tartalom konténer -->
<div class="container-for-content">
    <div class="container-for-content-left">
        <img src="../../public/img/ring-1.png">
    </div>
    <div class="container-for-content-right">
        <h1>Exclusive rings, unique collections!</h1>
        <p>Take a look through our collection to find the ideal ring, necklace, or bracelet that matches your style or would make a perfect gift.</p>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 ">
                <div class="about-us">
                    <h3>About Us</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="navigation">
                    <h3>Navigation</h3>
                    <div class="footer-navigation-links">
                        <div class="footer-navigation-item"><a href="Home.php">Home</a></div>
                        <div class="footer-navigation-item"><a href="Products.php">All Products</a></div>
                        <div class="footer-navigation-item"><a href="Rings.html">Rings</a></div>
                        <div class="footer-navigation-item"><a href="Bracelets.html">Bracelets</a></div>
                        <div class="footer-navigation-item"><a href="Necklaces.html">Necklaces</a></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 ">
                <div class="contact-info">
                    <h3>Contact Us</h3>
                    <div class="footer-info">
                        <div class="footer-info-item"><i class="material-icons-outlined">location_on</i>123 Street, City, Country</div>
                        <div class="footer-info-item"><i class="material-icons-outlined">phone</i>(123) 456-7890</div>
                        <div class="footer-info-item"><i class="material-icons-outlined">email</i>info@example.com</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>




<style>/* Footer stílusok */
/* Footer stílusok */
.footer a {
    text-decoration: none;
    color: #3A4049;
}
.footer-navigation-links {
    display: flex;
    flex-direction: column;
}



.footer-navigation-item {
    display: flex;
    align-items: center;
    gap: 5px;
    margin: 5px 0px;
}
.footer-info-item{
    display: flex;
    justify-content:end;
    align-items: center;
    margin: 5px 0px;
}
.footer {
    background-color: #F5F5F5;
    color: #3A4049;
    padding: 60px 0;
    box-shadow: 0px 0px 0px 1px rgba(0,0,0,0.1);
    padding-left: 10rem;
    padding-right: 10rem;
}
@media (max-width: 1200px) {
    .footer {
    padding-left: 5rem;
    padding-right: 5rem;
}
}
@media (max-width: 576px) {
    .footer{
    padding-left: 2rem;
    padding-right: 2rem;
}
}


.footer h3 {
    color: #3A4049;
}

.footer p {
    color: #3A4049;
}

.about-us,
.navigation,
.contact-info {
    display: flex;
    flex-direction: column;
    margin-bottom: 1rem;
}



@media (min-width: 992px) {
    .about-us {
        align-items: flex-start;
    }

    .navigation {
        align-items: center;
    }

    .footer-navigation-item {
        justify-content: center;
    }

    .contact-info {
        align-items: flex-end;
    }

}
@media(max-width:991px){
    .navigation{
        align-items: center;
    }
    .footer-navigation-item{
        justify-content: center;
    }
    .footer-info-item{
        justify-content: start;
    }
}

@media (max-width: 768px) {
    .about-us,
    .contact-info,
    .navigation {
        align-items: flex-start;
    }
    .footer-navigation-item{
        justify-content: start;
    }
}
</style>
<!-- JavaScript kód -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Js/Navbar.js"></script>
</body>
</html>
