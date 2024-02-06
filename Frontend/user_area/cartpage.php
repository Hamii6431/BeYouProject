<?php 
include '../assets/header.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="css/cartpage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/user_area/css/cartpage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <div class="container primary_container">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-8">
                <div class="cart_items">
                    <div class="cart_item_number">
                        <h2 id="cartItemCount">CART 0 items</h2>
                        <hr>
                    </div>
                    <div id="cartItemsContainer">
                        <!-- Az itt lévő adatoknak folyamatosan frissülni kell, amint valami változás lép életbe, ezért AJAX-al oldjuk meg a megjelenítést. -->
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4 d">
                <div class="cart_data">
                    <div class="cart_data_header">
                        <h2>Cart contents</h2>
                    </div>
                    <hr>
                    <div class="cart_data_subtotal">
                        <p id="cartItemCountText">Final amount 0 product</p>
                        <p id="cartTotalPrice">[] Ft</p>
                    </div>
                    <hr>
                    <div class="cart_place_order">
                        <button class="btn_place_order">Place order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
// Fetch and display cart items using AJAX
function displayCartItems() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Backend/user_area/get_cart_items.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var cartItemsContainer = document.getElementById('cartItemsContainer');
            var cartItems = JSON.parse(xhr.responseText);

            if (cartItems.length > 0) {
                var itemCount = 0;
                var totalAmount = 0;

                cartItemsContainer.innerHTML = '<h3>Your Cart</h3>';
                
                cartItems.forEach(function(item) {
                    var cartItemBox = document.createElement('div');
                    cartItemBox.className = 'cart_items_display';
                    cartItemBox.innerHTML = `
                        <div class="cart_image_container">
                            <img class="cart_item_image" src="../../public/product_images/${item.image}" alt="${item.product_name}">
                        </div>
                        <div class="cart_item_data">
                            <div class="cart_item_data_1">
                                <div class="cart_item_name">
                                    <h5>${item.product_name}</h5>
                                </div>
                                <div class="cart_item_productdata">
                                    <p>Product ID: ${item.product_ID}</p>
                                    <p>Material: ${item.material}</p>
                                    <p>Color: ${item.color}</p>
                                </div>
                            </div>
                            <div class="cart_item_data_2">
                                <div class="cart_item_price">
                                    <p>Price: ${item.item_price} Ft</p>
                                </div>
                                <div class="quantity_form">
                                    <div class="quantity_controls">
                                        <button class="quantity_btn" onclick="updateQuantity(${item.product_ID}, -1)">-</button>
                                        <input class="quantity_input" id="quantityInput_${item.product_ID}" type="text" value="${item.quantity}" disabled>
                                        <button class="quantity_btn" onclick="updateQuantity(${item.product_ID}, 1)">+</button>
                                    </div>
                                </div>
                                <div class="cart_item_remove">
                                    <button onclick="removeItem(${item.product_ID})">Remove</button>
                                </div>
                            </div>
                        </div>
                    `;

                    cartItemsContainer.appendChild(cartItemBox);

                    itemCount += parseInt(item.quantity);
                    totalAmount += parseFloat(item.item_price) * parseInt(item.quantity);
                });

                document.getElementById('cartItemCount').innerText = 'CART ' + itemCount + ' items';
                document.getElementById('cartItemCountText').innerText = 'Final amount [' + itemCount + '] product';
                document.getElementById('cartTotalPrice').innerText = '[' + totalAmount + '] Ft';
            } else {
                cartItemsContainer.innerHTML = '<p>Your shopping cart is empty.</p>';
            }
        } else {
            console.error(xhr.responseText);
        }
    };

    xhr.send();
}

// Function to remove item from cart
function removeItem(productID) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Backend/user_area/remove_cart_item.php?id=" + productID, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // After removing item, refresh the displayed cart items
            displayCartItems();
        } else {
            console.error(xhr.responseText);
        }
    };

    xhr.send();
}

// Function to update item quantity in cart
function updateQuantity(productID, quantityChange) {
    var quantityInput = document.getElementById('quantityInput_' + productID);
    var newQuantity = parseInt(quantityInput.value) + quantityChange;

    if (newQuantity >= 0) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../../Backend/user_area/update_cart_quantity.php?id=" + productID + "&quantity=" + newQuantity, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                // After updating quantity, refresh the displayed cart items
                displayCartItems();
            } else {
                console.error(xhr.responseText);
            }
        };

        xhr.send();
    }
}

// Call the function to display cart items
displayCartItems();
</script>

</body>
</html>

<?php
include '../assets/footer.php'; 
echo $username;
?>
