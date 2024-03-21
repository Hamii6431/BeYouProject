<?php
// Munkamenet indítása minden PHP oldalon szükséges, hogy hozzáférjünk a munkamenet változókhoz
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <!-- Stíluslapok linkelése -->
    <link rel="stylesheet" href="css/Navbar.css">
    <link rel="stylesheet" href="css/Toast.css">
    <link rel="stylesheet" href="css/ImportFont.css">
    <link rel="stylesheet" href="css/Cartpage.css">
    <link rel="stylesheet" href="css/Order.css">
    <!-- Google Icons és Font Awesome ikonok -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>

    </style>
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

<div class="container-for-cartpage">
    <div class="row">
        <!-- Kosár tartalma -->
        <div class="cart-items col-lg-8 col-md-12">
            <div class="cart-items-head">
                <h2>Shipping informations</h2>
            </div>
            <div class="surface_primary_body">
                <form id="shippingForm" action="../Backend/controllers/ShippingController.php" method="POST">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="container_input" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" class="container_input" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" class="container_input" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="container_input" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="street_address">Street Address</label>
                        <input type="text" name="street_address" id="street_address" class="container_input" value="" required>
                    </div>
                    
                    <input type="hidden" name="user_id" value="">
                    <input type="hidden" name="address_id" value="">
                    <button type="submit" name="update_address" class="sample_button_reverse">Update Address</button>
                </form>
            </div>
        </div>
        <!-- Rendelés összegzése -->
<!-- Rendelés összegzése -->
        <div class="cart-summary col-lg-4 col-md-12">
            <div class="summary-head">
                <h2>Order Overview</h2>
            </div>
            <div class="summary-subtotal">
                <div class="subtotal-text">
                    <h5>Subtotal</h5>
                    <p>Shipping</p>
                </div>
                <div class="subtotal-price">
                    <h5></h5>
                    <p>$0.00</p>
                </div>
            </div>
            <div class="summary-total">
                <h4>Total Price</h4> 
                <h4 id='totalPrice'>$0.00</h4>
            </div>
            <div class="summary-button">
                <button id="finishOrderButton" class="sample-button">Finish order</button>
            </div>

        </div>
    </div>
</div>

<!-- JavaScript és jQuery könyvtárak -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="Js/Navbar.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    displayCartItems();
    fetchShippingData();

    document.querySelector('#shippingForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        fetch('../../Backend/controllers/ShippingController.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Address updated successfully.');
            } else {
                alert('Failed to update address. Please try again.');
            }
        })
        .catch(error => console.error('Error updating address:', error));
    });
});

// Kosár összegzése és megjelenítése
function displayCartItems() {
    fetch('../../Backend/controllers/CartController.php?action=displayCartItems')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const cartItems = data.cartItems;
                updateCartSummary(cartItems);
            } else {
                console.error('Failed to fetch cart items:', data.message);
            }
        })
        .catch(error => console.error('Error fetching cart items:', error));
}

// Felhasználó szállítási adatainak lekérése és megjelenítése
function fetchShippingData() {
    fetch('../../Backend/controllers/ShippingController.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error fetching shipping data:', data.error);
            } else {
                document.getElementById('phone_number').value = data.phone_number || '';
                document.getElementById('country').value = data.country || '';
                document.getElementById('postal_code').value = data.postal_code || '';
                document.getElementById('city').value = data.city || '';
                document.getElementById('street_address').value = data.street_address || '';
            }
        })
        .catch(error => console.error('Error fetching shipping data:', error));
}

// Kosár összegzése frissítése
function updateCartSummary(cartItems) {
    let subtotal = 0;
    cartItems.forEach(item => {
        subtotal += item.price * item.quantity;
    });
    
    // Szállítási költség hozzáadása, ha a subtotal nagyobb mint 0
    const shippingCost = subtotal > 0 ? 5 : 0;
    subtotal += shippingCost;
    
    const total = subtotal + shippingCost; // Total számítása a szállítási költséggel
    
    // Subtotal és Total frissítése az oldalon
    document.querySelector('.summary-subtotal .subtotal-price h5').textContent = '$' + subtotal.toFixed(2);
    document.querySelector('.summary-subtotal .subtotal-price p').textContent = '$' + shippingCost.toFixed(2);
    document.getElementById('totalPrice').textContent = '$' + total.toFixed(2); // Total ár megjelenítése
}



</script>

</script>

</script>
</body>
</html>
