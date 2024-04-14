document.addEventListener("DOMContentLoaded", function() {
    displayCartItems(); // Kosárban lévő termékek megjelenítése.

    const continueButtonElement = document.getElementById('continueButton');
    if (continueButtonElement) {
        continueButtonElement.addEventListener('click', continueOrder);
    }
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
            showToast('Quantity updated successfully'); // Értesítés kiírása
        } else {
            console.error(data.message)
            showToast(data.message); // Hibaüzenet kiírása
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error updating quantity'); // Hibaüzenet kiírása
    });
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
            showToast('Product deleted successfully'); // Értesítés kiírása
        } else {
            console.error(data.message);
            showToast('Failed to delete product: ' + data.message); // Hibaüzenet kiírása
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Error deleting product'); // Hibaüzenet kiírása
    });
}

// Részösszegek és végösszekek számolása és frissítése a kosár tartalma alapján.
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

//Továbbítás a rendelés véglegesítése oldalra.
function continueOrder() {
    const totalPriceElement = document.getElementById('totalPrice');
    const totalPrice = parseFloat(totalPriceElement.textContent.replace('$', ''));

    if (totalPrice <= 0) {
        showToast('There are no items in the cart. Please add items before finalizing your order.');
    } else {
        window.location.href = 'Order.html'; // Redirect to the Order page if the cart is not empty
    }
}


// Univerzális Toast értesítés
let isToastVisible = false;

function showToast(message) {
    if (isToastVisible) return;

    // Nézet mozgatása a képernyő tetejére.
    window.scrollTo(0, 0);

    isToastVisible = true;
    const toastContainer = document.getElementById('toastContainer');
    if (!toastContainer) {
        console.error('Toast container not found');
        return;
    }
    const toast = document.createElement('div');
    toast.classList.add('toast');
    toast.textContent = message;

    toastContainer.appendChild(toast);
    setTimeout(() => {
        toast.classList.add('show');
    }, 100);

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            toastContainer.removeChild(toast);
            isToastVisible = false;
        }, 500);
    }, 3000);
}

