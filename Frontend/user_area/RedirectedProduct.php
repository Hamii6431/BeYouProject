<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirected Product</title>
    <link rel="stylesheet" href="css/RedirectedProduct.css">
    <link rel="stylesheet" href="css/Navbar.css">
    <link rel="stylesheet" href="css/ImportFont.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
    .container-for {
        background-size: cover;
        background-repeat: no-repeat;
        padding-top: 15vh;
        padding-left: 10rem;
        padding-right: 10rem;
    }
    .container-product-image{
        display: flex;
        justify-content: center;
    }
    .container-product-image img {
        max-width: 100%;
        height: auto;
    }
    .container-product-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        background-color: rgb(226, 235, 244);
        border-radius: 16px;
        padding: 2rem;
    }
    .container-product-details h1{
        margin-bottom: 2rem;
    }
    .container-product-details h2{
        margin-bottom: 1rem;
    }





    .buy-button {
        border-radius: 16px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        width: 100%;
        background-color: rgb(131, 165, 202);
        color: white;
        justify-content: center;
        height: 50px;
    }
    button {
        border: none;
        background: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
        display: inline-flex;
        align-items: center;
        margin:0;
    }
</style>
<body>
    <!-- Navigációs sáv -->
    <nav class="container-navbar">
        <!-- Logo -->
        <div class="logo">
            <img src="../../public/img/PngLogo.png" alt="Logo">
        </div>
        <!-- Navigációs menü -->
        <div class="navigation-menu">
            <!-- Menüpontok -->
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
    <div class="container-for">
        <div class="row">
            <div class="container-product-image col-lg-6 col-md-12">
                <img src="">
            </div>
            <div class="container-product-details col-lg-6 col-md-12">
                <h1></h1>
                <p></p>
                <h2></h2>
                <button class="buy-button">Add to cart</button>
            </div>
        </div>
    </div>


<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const productId = urlParams.get('id');
    
    if (productId) {
        fetch('../../Backend/controllers/ProductController.php?action=getProductDetails&productId=' + productId)
            .then(response => response.json())
            .then(product => {
                document.querySelector('.container-product-image img').src = "../../public/product_images/" + product.default_image_url;
                document.querySelector('.container-product-details h1').innerText = product.product_name;
                document.querySelector('.container-product-details p').innerText = product.description;
                document.querySelector('.container-product-details h2').innerText = product.price + " Ft";
            })
            .catch(error => console.error('Error:', error));
    } else {
        console.error('No product ID provided');
    }


    document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.buy-button').addEventListener('click', function() {
        const productId = new URLSearchParams(window.location.search).get('id');
        if (productId) {
            fetch('../../backend/controllers/CartController.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `action=addToCart&product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    alert('Product added to cart successfully!');
                } else {
                    alert('Failed to add product to cart: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
</script>
        
</body>
</html>
