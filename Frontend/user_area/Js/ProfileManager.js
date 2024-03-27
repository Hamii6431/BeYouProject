//Alapértelmezett űrlap betöltése és űrlapok kattintás figyelője
document.addEventListener("DOMContentLoaded", function() {
    showForm('accountItem'); // Alapértelmezett űrlap megjelenítése

    document.getElementById("accountMenuItem").addEventListener("click", function() {
        showForm('accountItem');
    });
    document.getElementById("manageAccountMenuItem").addEventListener("click", function() {
        showForm('manageAccountItem');
    });
    document.getElementById("manageShippingMenuItem").addEventListener("click", function() {
        showForm('manageShippingItem'); // Automatikusan betölti a szállítási adatokat is
    });
    document.getElementById("ordersMenuItem").addEventListener("click", function() {
        showForm('ordersItem');
    });
});

//Kiválasztott űrlapok betöltése és kezelése
function showForm(itemId) {
    // Minden űrlap elrejtése
    const forms = document.querySelectorAll('.container-surface > div');
    forms.forEach(form => {
        form.style.display = 'none';
    });

    // A kiválasztott űrlap megjelenítése
    const selectedForm = document.getElementById(itemId + 'Div');
    if (selectedForm) {
        selectedForm.style.display = 'block';
        switch (itemId) {
            case 'accountItem':
                fetchUserData();
                fetchShippingData();
                loadAccountItem();    
                break;
            case 'ordersItem':
                fetchUserOrders();
                loadOrdersItem();
                break;
            case 'manageAccountItem':
                fetchUserData();
                loadManageAccountItem();
                setupAccountFormSubmit();
                break;
            case 'manageShippingItem':
                fetchShippingData();
                loadManageShippingItem();
                setupShippingFormSubmit();
                break;
            default:
                break;
        }
    }
}

function loadAccountItem() {
    const accountItemContent = `
        <div class="surface_primary_header">
            <div class="surface_header1">
                <h4>My profile</h4>
            </div>
            <div class="surface_header2">
                <p>Personal informations</p>
            </div>
        </div>
        <div id="surface_primary_body">
            <div id="surface_primary_body_account">
                <div class="details_group">
                    <p class="details_group_1">Username</p>
                    <p id="usernameValue" class="details_group_2"></p> <!-- Azonosító hozzáadása -->
                </div>
                <div class="details_group">
                    <p class="details_group_1">Fullname</p>
                    <p id="fullnameValue" class="details_group_2"></p> <!-- Azonosító hozzáadása -->
                </div>
                <div class="details_group">
                    <p class="details_group_1">E-mail</p>
                    <p id="emailValue" class="details_group_2"></p> <!-- Azonosító hozzáadása -->
                </div>
                <div class="details_group">
                    <p class="details_group_1">Phone number</p>
                    <p id="phone_numberValue" class="details_group_2"></p> <!-- Azonosító hozzáadása -->
                </div>
            </div>

            <div id="surface_primary_body_shipping">
                <div class="details_group">
                    <p class="details_group_1">Country</p>
                    <p id="countryValue" class="details_group_2"></p> <!-- Azonosító hozzáadása -->
                </div>
                <div class="details_group">
                    <p class="details_group_1">Postal code</p>
                    <p id="postal_codeValue" class="details_group_2"></p> <!-- Azonosító hozzáadása -->
                </div>
                <div class="details_group">
                    <p class="details_group_1">City</p>
                    <p id="cityValue" class="details_group_2"></p> <!-- Azonosító hozzáadása -->
                </div>
                <div class="details_group">
                    <p class="details_group_1">Street and house number</p>
                    <p id="street_addressValue" class="details_group_2"></p> <!-- Azonosító hozzáadása -->
                </div>
            </div>
        </div>
    `;
    document.getElementById('accountItemDiv').innerHTML = accountItemContent;
}

function loadOrdersItem() {
    const ordersItemContent = `
    <div class="surface_primary_header">
        <div class="surface_header1">
            <h4>My orders</h4>
        </div>
        <div class="surface_header2">
            <p>Orders Information</p>
        </div>
    </div>
    <div class="surface_primary_body scrollable-table">
        <table class="order-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date/Time</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
    
            </tbody>
        </table>
    </div>
    
    `;
    document.getElementById('ordersItemDiv').innerHTML = ordersItemContent;
    }

function loadManageAccountItem() {
    const manageAccountItemContent = `
    <div class="surface_primary_header">
        <div class="surface_header1">
            <h4>Manage Account</h4>
        </div>
        <div class="surface_header2">
            <p>Personal Information</p>
        </div>
    </div>
    <div class="surface_primary_body">
        <form id="accountForm" action="/BeYou_web/Beyouproject/Backend/controllers/ProfileController.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" id="username" class="container_input" value="" novalidate>
                <label for="username">Username *</label>
            </div>
            <div class="form-group">
                <input type="text" name="first_name" id="first_name" class="container_input" value="" novalidate>
                <label for="first_name">First name *</label>
            </div>
            <div class="form-group">
                <input type="text" name="last_name" id="last_name" class="container_input" value="" novalidate>
                <label for="last_name">Last name *</label>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" class="container_input" value="" novalidate>
                <label for="email">Email *</label>
            </div>

            <button class="sample-button" type="submit" name="update_account">Update Account</button>
        </form>
    </div>
`;
document.getElementById('manageAccountItemDiv').innerHTML = manageAccountItemContent;
}

function loadManageShippingItem() {
    // A szállítási űrlap tartalmának beállítása
    const manageShippingItemContent = `
        <div class="surface_primary_header">
            <div class="surface_header1">
                <h4>Manage Your Shipping Addresses</h4>
            </div>
            <div class="surface_header2">
                <p>Shipping Information</p>
            </div>
        </div>
        <div class="surface_primary_body">
            <form id="shippingForm" action="../../Backend/controllers/ShippingController.php" method="POST">
                <div class="form-group">
                    <label for="phone_number">Phone Number *</label>
                    <input type="text" name="phone_number" id="phone_number" class="container_input" novalidate>
                </div>
                <div class="form-group">
                    <label for="country">Country *</label>
                    <input type="text" name="country" id="country" class="container_input" novalidate>
                </div>
                <div class="form-group">
                    <label for="postal_code">Postal Code *</label>
                    <input type="text" name="postal_code" id="postal_code" class="container_input" novalidate>
                </div>
                <div class="form-group">
                    <label for="city">City *</label>
                    <input type="text" name="city" id="city" class="container_input" novalidate>
                </div>
                <div class="form-group">
                    <label for="street_address">Street Address *</label>
                    <input type="text" name="street_address" id="street_address" class="container_input" novalidate>
                </div>
                <input type="hidden" name="user_id" value="">
                <input type="hidden" name="address_id" value="">
                <button type="submit" name="update_address" class="sample-button">Update Address</button>
            </form>
        </div>
    `;
    document.getElementById('manageShippingItemDiv').innerHTML = manageShippingItemContent;
}

function populateOrdersTable(orders) {
    const tableBody = document.querySelector('.order-table tbody');
    if (!tableBody) return;

    // Clear existing rows
    tableBody.innerHTML = '';

    // Populate rows with orders data
    orders.forEach(order => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${order.final_order_id}</td>
            <td>${new Date(order.order_date).toLocaleString()}</td>
            <td>${order.first_name} ${order.last_name}</td>
            <td>${order.total_price}</td>
            <td>${order.status}</td>
        `;
        tableBody.appendChild(row);
    });
}



function fetchShippingData() {
    fetch('../../Backend/controllers/ShippingController.php')
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error fetching shipping data:', data.error);
        } else {
            ['phone_number', 'country', 'postal_code', 'city', 'street_address'].forEach(id => {
                updateInputAndTextContent(id, data[id]);
            });
        }
    })
    .catch(error => console.error('Error fetching shipping data:', error));
}

function fetchUserData() {
    fetch('/BeYou_web/Beyouproject/Backend/controllers/ProfileController.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            console.error('Error fetching user data:', data.message);
        } else {
            // DRY: Don't Repeat Yourself - közös függvény az érték beállításokhoz
            ['username', 'first_name', 'last_name', 'email'].forEach(id => {
                updateInputAndTextContent(id, data[id]);
            });
            updateTextContent('fullnameValue', `${data.first_name} ${data.last_name}`);
        }
    })
    .catch(error => console.error('Error fetching user data:', error));
}

function fetchUserOrders() {
    fetch('/BeYou_web/Beyouproject/Backend/controllers/GetOrdersController.php')
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            populateOrdersTable(data.orders); // Tegyük fel, hogy 'orders' a rendelések tömbje
        } else {
            showToast('Failed to fetch orders: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error fetching orders:', error);
        showToast('An error occurred while fetching orders.');
    });
}



// Űrlapok feltöltése
function updateInputAndTextContent(id, value) {
    const element = document.getElementById(id);
    if (element) {
        element.value = value || '';
    }
    const textElement = document.getElementById(id + 'Value');
    if (textElement) {
        textElement.textContent = value || '';
    }
}

//Teljes név betöltése
function updateTextContent(id, value) {
    const element = document.getElementById(id);
    if (element) {
        element.textContent = value || '';
    }
}

//Szállítási adatok elküldése
function setupShippingFormSubmit() {
    const shippingForm = document.getElementById('shippingForm');
    if (shippingForm) {
        shippingForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Megakadályozza az űrlap alapértelmezett beküldési működését
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

//Felhasználói adatok elküldése
function setupAccountFormSubmit() {
    const accountForm = document.getElementById('accountForm');
    if (accountForm) {
        accountForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Megakadályozza az űrlap alapértelmezett beküldési működését
            const formData = new FormData(accountForm);

            fetch('/BeYou_web/Beyouproject/Backend/controllers/ProfileController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    showToast(data.message); // Sikeres üzenet megjelenítése
                } else {
                    showToast(data.message); // Sikertelen üzenet megjelenítése
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
}


//Felhasználói érrtesítés elem
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

