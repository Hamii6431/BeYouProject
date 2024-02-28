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


    //Bejelentkezés és regisztrációs űrlap közötti váltás
    const loginTab = document.getElementById('tab-login');
    const registerTab = document.getElementById('tab-register');
    const loginForm = document.getElementById('pills-login');
    const registerForm = document.getElementById('pills-register');
    const registerButton = document.getElementById('tab-register');
    const backButton = document.getElementById('backToLoginButton');

    registerButton.addEventListener('click', function () {
        loginTab.classList.remove('active');
        registerTab.classList.add('active');
        loginForm.classList.remove('show', 'active');
        registerForm.classList.add('show', 'active');
    });

    loginTab.addEventListener('click', function () {
        loginTab.classList.add('active');
        registerTab.classList.remove('active');
        loginForm.classList.add('show', 'active');
        registerForm.classList.remove('show', 'active');
    });

    backButton.addEventListener('click', function () {
        loginTab.classList.add('active');
        registerTab.classList.remove('active');
        loginForm.classList.add('show', 'active');
        registerForm.classList.remove('show', 'active');
    });