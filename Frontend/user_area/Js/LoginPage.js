document.addEventListener("DOMContentLoaded", function() {
    // Eseménykezelők hozzáadása a tab gombokhoz
    document.getElementById("tab-login").addEventListener("click", function() {
        loadLoginForm();
    });

    document.getElementById("tab-register").addEventListener("click", function() {
        loadRegistrationForm();
    });

    // Alapértelmezett form betöltése
    loadLoginForm();
});

function loadLoginForm() {
    const formContainer = document.getElementById("form-container");
    formContainer.innerHTML = `
        <form id="loginForm" method="POST" action="LoginController.php" class="orderform">
            <div class="form-group">
                <input type="text" name="login_username" id="login_username" class="container-input" placeholder=" " required>
                <label for="login_username">Enter your username *</label>
            </div>
            <div class="form-group">
                <input type="password" name="login_password" id="login_password" class="" placeholder=" " required>
                <label for="login_password">Enter your password *</label>
            </div>
            <div class="form-group">
                <p>* The required fields must be filled out. Without feedback, we cannot process your request.</p>
            </div>
            <button class="sample-button" type="submit">LOGIN</button>
        </form>
    `;

    //Bejelentkezési űrlap elküldése AJAX kéréssel
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Az alapértelmezett űrlap elküldésének megakadályozása
        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../../Backend/controllers/LoginController.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Sikeres kérés esetén átirányítás
                window.location.href = xhr.responseURL;
            } else if (xhr.status === 302) {
                console.error('A kérés átirányítást kapott.');
            } else {
                console.error('Hiba történt a kérés során.');
            }
        };
        xhr.send(formData);
        });
    }

function loadRegistrationForm() {
    const formContainer = document.getElementById("form-container");
    formContainer.innerHTML = `
        <form id="registrationForm" method="POST" action="RegistrationController.php" class="orderform">
            <div class="form-group">
                <input type="text" name="first_name" id="first_name" class="container-input" placeholder=" " autocomplete="off" required="required">
                <label for="first_name">Enter your first name *</label>
            </div>
            <div class="form-group">
                <input type="text" name="last_name" id="last_name" class="container-input" placeholder=" " autocomplete="off" required="required">
                <label for="last_name">Enter your last name *</label>
            </div>
            <div class="form-group">
                <input type="text" name="username" id="username" class="container-input" placeholder=" " autocomplete="off" required="required">
                <label for="username">Enter your username *</label>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" class="container-input" placeholder=" " autocomplete="off" required="required">
                <label for="email">Enter your email address *</label>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="container-input" placeholder=" " required="required">
                <label for="password">Enter your password *</label>
            </div>
            <div class="form-group">
                <input type="password" name="password_again" id="password_again" class="container-input" placeholder=" " required="required">
                <label for="password_again">Enter your password again *</label>
            </div>
            <div class="container-terms">
                <div class="container-terms-checkbox">
                    <input type="checkbox" name="terms" id="terms" value="accepted" required>
                    <label for="terms">I accept the Terms and Conditions *</label>
                </div>
                <p>* The required fields must be filled out. Without feedback, we cannot process your request.</p>
            </div>
            <button class="sample-button" type="submit" name="user_register">REGISTER</button>
        </form>
    `;

    //Regisztrációs űrlap elküldése AJAX kéréssel
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Az alapértelmezett űrlap elküldésének megakadályozása
    
        // Űrlap adatainak gyűjtése
        const formData = new FormData(this);
    
        // AJAX kérés konfigurálása
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../../Backend/controllers/RegistrationController.php', true); // Módosítás: közvetlenül a PHP fájlra mutatunk
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Fejléc hozzáadása az AJAX kéréshez
    
        // AJAX kérés küldése
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Sikeres kérés esetén kezelheted a választ itt
                console.log(xhr.responseText);
                alert(xhr.responseText); // Például megjelenítheted egy alertboxban
            } else {
                // Sikertelen kérés esetén kezelheted a hibát itt
                console.error('Hiba történt a kérés során.');
            }
        };
    
        // AJAX kérés küldése
        xhr.send(formData);
    });
}