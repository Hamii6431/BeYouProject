// Az oldal betöltésénél a termékek megjelenítése a kosárban.
document.addEventListener("DOMContentLoaded", function() {
    displayCartItems();
});

// Kosárban lévő termékek megjelenítése.
function displayCartItems() {
    // A kosár tartalmának lekérdezése a szerverről.
    fetch('../../Backend/controllers/CartController.php?action=displayCartItems')
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            const cartItemsContainer = document.querySelector('.cart-items-body');
            cartItemsContainer.innerHTML = ''; // Kosár tartalmának törlése előtt.

            // A kosárban lévő minden termék megjelenítése.
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
                    <div class="box-quantity">
                        <div class="quantity-change">
                            <button class="quantity_btn" onclick="updateQuantity(${item.product_id}, -1)">-</button>
                            <input class="quantity_input" id="quantityInput_${item.product_id}" type="text" value="${item.quantity}" disabled>
                            <button class="quantity_btn" onclick="updateQuantity(${item.product_id}, 1)">+</button>
                        </div>
                        <div class="quantity-remove">
                            <button class="delete-button" data-product-id="${item.product_id}" onclick="deleteCartItem(${item.product_id})">Delete</button>
                        </div>
                    </div>
                    <div class="box-subtotal">
                        <h5>Total: $${(item.quantity * item.price).toFixed(2)}</h5>
                    </div>
                </div>
                `;
                cartItemsContainer.appendChild(itemBox);
            });

            // Az összegzés frissítése a kosárban lévő termékek alapján.
            updateSummary(data.cartItems);
        } else {
            console.error(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Részösszeg kiszámítása a kosárban lévő termékek alapján.
function calculateSubtotal(cartItems) {
    return cartItems.reduce((total, item) => total + item.quantity * item.price, 0);
}

// Termék mennyiségének frissítése a kosárban.
function updateQuantity(productId, change) {
    const currentQuantityInput = document.getElementById(`quantityInput_${productId}`);
    let newQuantity = parseInt(currentQuantityInput.value) + change;
    newQuantity = Math.max(newQuantity, 0); // Az új mennyiség nem lehet negatív.

    // A mennyiség frissítésének elküldése a szerverre.
    fetch('../../Backend/controllers/CartController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=updateQuantityInCart&product_id=${productId}&new_quantity=${newQuantity}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            console.log('Quantity updated successfully');
            displayCartItems(); // A kosár újratöltése.
        } else {
            console.error(data.message)
        }
    })
    .catch(error => console.error('Error:', error));
}

// Termék törlése a kosárból.
function deleteCartItem(productId) {
    fetch('../../Backend/controllers/CartController.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=deleteCartItem&product_id=${productId}`
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            console.log('Product deleted successfully');
            displayCartItems(); // A kosár újratöltése.
        } else {
            console.error(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Az összegzés frissítése a kosár tartalma alapján.
function updateSummary(cartItems) {
    const subtotal = calculateSubtotal(cartItems);
    // Szállítási költség csak akkor, ha a subtotal több mint 0.
    const shippingCost = subtotal > 0 ? 5.00 : 0;
    const total = subtotal + shippingCost; // Összesített összeg szállítási költséggel.

    // Az összegek megjelenítése az oldalon.
    document.querySelector('.summary-subtotal .subtotal-price h5').textContent = `$${subtotal.toFixed(2)}`;
    document.querySelector('.summary-subtotal .subtotal-price p').textContent = `$${shippingCost.toFixed(2)}`;
    document.querySelector('#totalPrice').textContent = `$${total.toFixed(2)}`;
}


document.addEventListener('DOMContentLoaded', function() {
    const placeOrderButton = document.getElementById('placeOrderButton');
    
    placeOrderButton.addEventListener('click', function() {
            window.location.href = 'Order.php'; // Ha be van jelentkezve, átirányítjuk az Order.php oldalra
        }
    );
    });