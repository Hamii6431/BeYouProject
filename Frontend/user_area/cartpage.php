<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="css/Navbar.css">
    <link rel="stylesheet" href="css/ImportFont.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<style>

button {
    border: none;
    background: none;
    padding: 0;
    font: inherit;
    cursor: pointer;
    outline: inherit;
    display: flex;
    align-items: center;
    justify-content: center;
    margin:0;
    width: 100%;
    height: 50px;
}


.container-for {
    background-image: url('../../../public/img/stock-stone2.png');
    background-size: cover;
    background-repeat: no-repeat;
    padding-top: 15vh;
    padding-left: 10rem;
    padding-right: 10rem;
}

/*Kosár tartalma és rendelés összegzése */
.cart-items, .cart-summary{
    padding:30px 30px 0px 30px;
}
/*Rendelés összegzése */
.cart-summary{
    background-color: #F5F5F5;
    border-top: 5px solid #FFCAD4;
    height: fit-content;
    padding-top: 25px;
}

/*Kosár tartalma és rendelés összegzése fejrészei */
.cart-items-head, .summary-head{
    display: flex;
    justify-content: space-between;
    border-bottom: 2px solid gray;
    padding-bottom: 0.5rem;
}

/*Kosárban lévő termék */
.item-box {
    margin-top:1rem;
    display: flex;
    align-items: center;
    gap: 20px;
}
.box-image img {
    max-width: 140px; /* Kép szélessége */
    height: auto; /* Magasság automatikus arányosítása */
}
.box-name-price{
    min-width: 50%;
    max-width: 50%;
}
.box-name-price, .box-subtotal {
    flex-grow: 1; /* Töltse ki a rendelkezésre álló teret */
}
.box-subtotal{
    display: flex;
    align-items: end;
    flex-direction: column;
}
/*Box-quantity tartalma: */
.quantity-change{
    display: flex;
}
.quantity-remove{
    height: 10px;
}
.quantity-control {
    border: 1px solid #ccc;
    padding: 5px 10px; /* Kis térköz */
    cursor: pointer; /* Kattintható stílus */
}
.quantity-input {
    width: 50px;
    text-align: center;
    border: 1px solid #eee;
}



/*Rendelés összegzése */
.summary-subtotal, .summary-total {
    border-bottom: 2px solid gray;
    padding:1rem 0rem 1rem 0rem;
    display:flex;
    justify-content: space-between;
}
.summary-subtotal, h5, p{
    margin: 0;
}
.summary-total h4{
    margin: 0;
}
.sample-button{
background-color: #27251F;
color: white;
margin-bottom: 2.5rem;
}
.sample-button:hover {
transition: 0.3s;
background-color: #000000;
color: white;
}



@media (max-width: 1200px) {
    .container-for {
    padding-top: 15vh;
    padding-left: 5rem;
    padding-right: 5rem;
}
}


@media (max-width: 768px) {
    .item-box {
        flex-direction: column;
        align-items: stretch;
    }

    .box-image, .box-name-price, .box-subtotal, .box-quantintity {
        width: 100%; /* Kis kijelzőkön teljes szélesség */
        text-align: center; /* Középre igazítás */
        margin-bottom: 10px; /* Térköz az elemek között */
    }
    .quantity-change{
        display: flex;
        justify-content: center;
    }

    .box-name-price{
    min-width: 100%;
    max-width: 100%;
}

    .box-subtotal{
    display: block;
    align-items: normal;
    flex-direction: row;
}
}


@media (max-width: 576px) {
    .container-for {
    padding-top: 15vh;
    padding-left: 2rem;
    padding-right: 2rem;
}

}










.quantity_btn {
    background-color: #27251F;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    height:40px;
    width:30px;
}

.quantity_btn:hover {
    transition: 0.3s;
    background-color: #FFCAD4;
    color: black;
}

.quantity_input {
    width: 50px;
    text-align: center;
    height:40px;
}
</style>

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
        <div class="cart-items col-lg-8 col-md-12">
            <div class="cart-items-head">
                <h2>Shopping Cart</h2>
                <h2 id="cartItemCount">X Items</h2>
            </div>
            <div class="cart-items-body">
                <!--Ide töltődik be a kosár tartalma.-->
            </div>
        </div>
        <div class="cart-summary col-lg-4 col-md-12">
            <div class="summary-head">
                <h2>Order Overview</h2>
            </div>
            <div class="summary-subtotal">
                <div class="subtotal-text">
                    <h5>Subtotal (X Products)</h5>
                    <p>Shipping</p>
                </div>
                <div class="subtotal-price">
                    <h5>$312.00</h5>
                    <p>$0.00</p>
                </div>
            </div>
            <div class="summary-total">
                <h4>Total price</h4>
                <h4>$312.00</h4>
            </div>
            <div class="summary-button">
                <button class="sample-button">Place order</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Js/Navbar.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('../../Backend/controllers/CartController.php?action=displayCartItems')
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            const cartItemsContainer = document.querySelector('.cart-items-body');
            data.cartItems.forEach(item => {
                const itemBox = document.createElement('div');
                itemBox.className = 'item-box';
                itemBox.innerHTML = `
                    <div class="box-image">
                        <img src="../../public/product_images/${item.default_image_url}" alt="Product Image">
                    </div>
                    <div class="box-name-price">
                        <h5>${item.product_name}</h5>
                        <p>$${item.price}</p>
                    </div>
                    <div class="box-quantintity">
                        <div class="quantity-change">
                            <button class="quantity_btn" onclick="updateQuantity(${item.product_ID}, -1)">-</button>
                                <input class="quantity_input" id="quantityInput_${item.product_ID}" type="text" value="${item.quantity}" disabled>
                            <button class="quantity_btn" onclick="updateQuantity(${item.product_ID}, 1)">+</button>
                        </div>
                        <div class="quantity-remove">
                            <button class="delete-button" data-product-id="${item.product_ID}">Delete</button>
                        </div>
                    </div>
                    <div class="box-subtotal">
                        <h5>Total: $${item.quantity * item.price}</h5>
                    </div>

                `;
                cartItemsContainer.appendChild(itemBox);
            });
        } else {
            console.error(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});



</script>
</body>
</html>