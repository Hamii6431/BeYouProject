// Kezdőérték beállítása a legutóbbi görgetési pozíciónak
let lastScrollTop = 0;

// A görgetési esemény kezelője
window.addEventListener("scroll", function() {
    // Az aktuális görgetési pozíció meghatározása
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    // Lefelé görgetéskor a navigációs sáv elrejtése
    if (currentScroll > lastScrollTop) {
        document.querySelector(".container-navbar").style.top = "-100px";
    } else {
        // Felfelé görgetéskor a navigációs sáv megjelenítése
        document.querySelector(".container-navbar").style.top = "0";
    }
    // Az utolsó görgetési pozíció frissítése
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
}, false);

// A DOM teljes betöltése után futtatandó kód
document.addEventListener('DOMContentLoaded', function() {
    // Felhasználói interakciók eseménykezelőinek inicializálása
    initUserInteractionHandlers();
    // A navigációs menüpontok kattinthatóságának beállítása
    extendNavigationMenuItemClickability();
});

function initUserInteractionHandlers() {
    // Az összes releváns ikonra eseménykezelők hozzáadása
    document.querySelectorAll('.personIcon').forEach(item => {
        item.addEventListener('click', function() { navigateBasedOnSession('person'); });
    });
    document.querySelectorAll('.shoppingBagIcon').forEach(item => {
        item.addEventListener('click', function() { navigateBasedOnSession('shoppingBag'); });
    });
    document.querySelectorAll('.logoutIcon').forEach(item => {
        item.addEventListener('click', logout);
    });
}

function navigateBasedOnSession(action) {
    // Session állapotának ellenőrzése és megfelelő átirányítás
    $.ajax({
        type: "POST",
        url: "../../Backend/controllers/SessionController.php",
        data: { action: "checkSessionAjax" },
        success: function(response) {
            const res = JSON.parse(response);
            if (res.isLoggedIn) {
                if (action === 'person') {
                    window.location.href = 'ProfilePage.php';
                } else if (action === 'shoppingBag') {
                    window.location.href = 'CartPage.php';
                }
            } else {
                window.location.href = 'LoginPage.html';
            }
        }
    });
}

// Felhasználó kijelentkeztetése és átirányítása
function logout() {
    $.ajax({
        type: "POST",
        url: "../../Backend/controllers/SessionController.php",
        data: { action: "logout" },
        success: function(response) {
            const result = JSON.parse(response);
            window.location.href = result.redirectUrl;
        }
    });
}

// A hamburger menü és a navigációs menü állapotának váltása
function toggleMenu() {
    const hamburgerMenu = document.querySelector(".hamburger-menu");
    const navigationMenu = document.querySelector(".navigation-menu");
    hamburgerMenu.classList.toggle("active");
    navigationMenu.classList.toggle("active");
}

// A navigációs menüpontok kattinthatóságának kiterjesztése
function extendNavigationMenuItemClickability() {
    const menuItems = document.querySelectorAll('.navigation-menu-item');

    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            const url = this.querySelector('a').getAttribute('href');
            if (url) {
                window.location.href = url;
            }
        });
    });
}
