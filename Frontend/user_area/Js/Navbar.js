// Kezdőérték beállítása a legutóbbi görgetési pozíciónak
let lastScrollTop = 0;

// A görgetési esemény kezelője, amely elrejti vagy megjeleníti a navigációs sávot
window.addEventListener("scroll", function() {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        // Lefelé görgetéskor a navigációs sáv elrejtése
        document.querySelector(".container-navbar").style.top = "-85px";
    } else {
        // Felfelé görgetéskor a navigációs sáv megjelenítése
        document.querySelector(".container-navbar").style.top = "0";
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Az utolsó görgetési pozíció frissítése
}, false);

// A DOM teljes betöltése után futtatandó kód
document.addEventListener('DOMContentLoaded', function() {
    initUserInteractionHandlers(); // Eseménykezelők inicializálása
    extendNavigationMenuItemClickability(); // Navigációs menüpontok kattinthatóságának beállítása
});

// Felhasználói interakciók eseménykezelőinek inicializálása
function initUserInteractionHandlers() {
    document.querySelectorAll('.personIcon, .shoppingBagIcon, .logoutIcon').forEach(item => {
        item.addEventListener('click', function() {
            if (this.classList.contains('personIcon')) {
                navigateBasedOnSession('person');
            } else if (this.classList.contains('shoppingBagIcon')) {
                navigateBasedOnSession('shoppingBag');
            } else if (this.classList.contains('logoutIcon')) {
                logout();
            }
        });
    });
}

// Az aktuális munkamenet ellenőrzése és az esetleges átirányítás kezelése
function navigateBasedOnSession(action) {
    $.ajax({
        type: "POST",
        url: "../../Backend/controllers/SessionController.php",
        data: { action: "checkSessionAjax" },
        success: function(response) {
            const res = JSON.parse(response);
            if (res.isLoggedIn) {
                // Felhasználó átirányítása a profil vagy a kosár oldalra
                window.location.href = action === 'person' ? 'ProfilePage.html' : 'CartPage.html';
            } else {
                // Bejelentkezési oldalra átirányítás, ha a felhasználó nincs bejelentkezve
                window.location.href = 'LoginPage.html';
            }
        }
    });
}

// Felhasználó kijelentkeztetése és a kezdőlapra átirányítása
function logout() {
    $.ajax({
        type: "POST",
        url: "../../Backend/controllers/SessionController.php",
        data: { action: "logout" },
        success: function(response) {
            const result = JSON.parse(response);
            window.location.href = result.redirectUrl; // Átirányítás a megadott URL-re
        }
    });
}

// A hamburger menü és a navigációs menü állapotának váltása
function toggleMenu() {
    document.querySelector(".hamburger-menu").classList.toggle("active");
    document.querySelector(".navigation-menu").classList.toggle("active");
}

// A navigációs menüpontok kattinthatóságának kiterjesztése
function extendNavigationMenuItemClickability() {
    document.querySelectorAll('.navigation-menu-item').forEach(item => {
        item.addEventListener('click', function() {
            const url = this.querySelector('a').href;
            if (url) window.location.href = url; // Átirányítás a kiválasztott oldalra
        });
    });
}
