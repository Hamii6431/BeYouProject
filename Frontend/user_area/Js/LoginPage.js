document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("tab-login").addEventListener("click", loadLoginForm);
    document.getElementById("tab-register").addEventListener("click", loadRegistrationForm);
    loadLoginForm();
});

//Bejelentkezési űrlap feltöltése
function loadLoginForm() {
    const formContainer = document.getElementById("form-container");
    formContainer.innerHTML = `
        <form id="loginForm" method="POST" action="../../Backend/controllers/LoginController.php" class="orderform" novalidate>
            <div class="form-group">
                <input type="text" name="login_username" id="login_username" class="container-input" placeholder=" " required>
                <label for="login_username">Enter your username *</label>
            </div>
            <div class="form-group">
                <input type="password" name="login_password" id="login_password" class="container-input" placeholder=" " required>
                <label for="login_password">Enter your password *</label>
            </div>
            <div class="form-group">
                <p>* The required fields must be filled out. Without feedback, we cannot process your request.</p>
            </div>
            <button class="sample-button" type="submit">LOGIN</button>
        </form>
    `;

    //Bejelentkezési űrlap elküldése és feldolgozása
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        submitLoginForm(this, 'Login successful!', 'Invalid username or password.');
    });
}

//Változó hogy meg tudjuk nézni a felhasználó regisztrált e már ebben a munakamenetben és ez alapján értesítünk.
let isRegistered = false;

//Regisztrációs űrlap betöltése
function loadRegistrationForm() {
    const formContainer = document.getElementById("form-container");
    formContainer.innerHTML = `
        <form id="registrationForm" method="POST" action="../../Backend/controllers/RegistrationController.php" class="orderform" novalidate>
            <div class="form-group">
                <input type="text" name="first_name" id="first_name" class="container-input" placeholder=" " autocomplete="off" required>
                <label for="first_name">Enter your first name *</label>
            </div>
            <div class="form-group">
                <input type="text" name="last_name" id="last_name" class="container-input" placeholder=" " autocomplete="off" required>
                <label for="last_name">Enter your last name *</label>
            </div>
            <div class="form-group">
                <input type="text" name="username" id="username" class="container-input" placeholder=" " autocomplete="off" required>
                <label for="username">Enter your username *</label>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" class="container-input" placeholder=" " autocomplete="off" required>
                <label for="email">Enter your email address *</label>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="container-input" placeholder=" " required>
                <label for="password">Enter your password *</label>
            </div>
            <div class="form-group">
                <input type="password" name="password_again" id="password_again" class="container-input" placeholder=" " required>
                <label for="password_again">Enter your password again *</label>
            </div>
            <div class="container-terms">
                <div class="container-terms-checkbox">
                    <input type="checkbox" name="terms" id="terms" value="accepted" required>
                    <label for="terms">I accept the <a class="terms-style" href="TermsAndConditions.html" target="_blank">Terms and Conditions</a> *</label>
                </div>
                <p>* The required fields must be filled out. Without feedback, we cannot process your request.</p>
            </div>
            <button class="sample-button" type="submit" name="user_register">REGISTER</button>
        </form>
    `;

    //Adatok elküldése és feldolgozása
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (isRegistered) {
            showToast('You have already registered.');
            return;
        }else{
            submitRegistrationForm(this);
        }

    });
}

//Bejelentkezési űrlap elküldése
function submitLoginForm(form, successMessage, errorMessage) {
    const formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error('Network error');
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            showToast(successMessage);
            // Redirect if needed:
            if (data.redirectUrl) window.location.href = data.redirectUrl;
        } else {
            showToast(errorMessage);
        }
    })
    .catch(() => {
        showToast(errorMessage);
    });
}

//Regisztrációs űrlap elküldése
function submitRegistrationForm(form) {
    fetch(form.action, {
        method: 'POST',
        body: new FormData(form)
    })
    .then(response => {
        if (!response.ok) throw new Error('Network error');
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            // Sikeres regisztráció esetén:
            isRegistered = true;
            showToast('Registration successful!');
            // Letiltjuk a regisztrációs űrlapot:
            document.getElementById('registrationForm').classList.add('disabled');
        } else {
            showToast(data.message);
        }
    })
    .catch(() => {
        showToast('Registration failed.');
    });
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

