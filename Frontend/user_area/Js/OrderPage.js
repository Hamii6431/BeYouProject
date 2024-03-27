document.addEventListener("DOMContentLoaded", function() {
    fetchCartSummary();
    fetchShippingData();
    setupShippingFormSubmit();

    // A "Finish Order" gombra kattintás eseménykezelője
    document.getElementById('finishOrderButton').addEventListener('click', function() {
        finishOrder();
    });
});

function fetchCartSummary() {
    fetch('../../Backend/controllers/CartController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=calculateCartSummary'
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            updateCartSummaryDirectly(data.subtotal, data.shippingCost, data.total);
        } else {
            console.error('Failed to fetch cart summary:', data.message);
        }
    })
    .catch(error => console.error('Error fetching cart summary:', error));
}

function finishOrder() {
    updateShippingData()
        .then(() => {
            const totalPriceElement = document.getElementById('totalPrice');
            const totalPrice = parseFloat(totalPriceElement.textContent.replace('$', ''));

            if (totalPrice <= 0) {
                showToast('There are no items in the cart. Please add items before finalizing your order.'); 
                return;
            }

            sendOrder(totalPrice);
        })
        .catch(error => {
            console.error('Error updating shipping data:', error);
            showToast('An error occurred while updating shipping data.');
        });
}

function updateShippingData() {
    return new Promise((resolve, reject) => {
        const formData = new FormData(document.getElementById('shippingForm'));

        fetch('../../Backend/controllers/ShippingController.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                resolve();
            } else {
                reject(new Error('Failed to update shipping data.'));
            }
        })
        .catch(error => {
            reject(error);
        });
    });
}

function sendOrder(totalPrice) {
    fetch('../../Backend/controllers/OrderController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=finalizeOrder&total_price=${totalPrice}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showToast(data.message);
            window.location.href = data.redirect;
        } else {
            showToast(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('There was an issue finalizing your order. Please try again.');
    });
}

function fetchShippingData() {
    fetch('/BeYou_web/Beyouproject/Backend/controllers/ShippingController.php')
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error fetching shipping data:', data.error);
        } else if (!data || Object.keys(data).length === 0) {
            showToast("Please enter your shipping details");
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

function updateCartSummaryDirectly(subtotal, shippingCost, total) {
    document.querySelector('.summary-subtotal .subtotal-price h5').textContent = `$${subtotal.toFixed(2)}`;
    document.querySelector('.summary-subtotal .subtotal-price p').textContent = `$${shippingCost.toFixed(2)}`;
    document.getElementById('totalPrice').textContent = `$${total.toFixed(2)}`;
}

function setupShippingFormSubmit() {
    const shippingForm = document.getElementById('shippingForm');
    if (shippingForm) {
        shippingForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(shippingForm);

            fetch('../../Backend/controllers/ShippingController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showToast(data.message);
                } else {
                    showToast(data.message); // Megjeleníti a szerver válaszát, akár sikeres, akár hiba
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred.');
            });
        });
    }
}

let isToastVisible = false;

function showToast(message) {

    if (isToastVisible) return;

    //Nézet mozgatása a képernyő tetejére.
    window.scrollTo(0, 0);

    isToastVisible = true;
    const toastContainer = document.getElementById('toastContainer');
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
