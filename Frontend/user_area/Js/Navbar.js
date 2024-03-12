






let lastScrollTop = 0; // Kezdő görgetési pozíció
    
        window.addEventListener("scroll", function() {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    
            if (currentScroll > lastScrollTop) {
                // Lefelé görgetéskor
                document.querySelector(".container-navbar").style.top = "-100px"; // Elrejtjük a navbar-t
            } else {
                // Felfelé görgetéskor
                document.querySelector(".container-navbar").style.top = "0"; // Megjelenítjük a navbar-t
            }
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Frissítjük az utolsó görgetési pozíciót
        }, false);


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('personIcon').addEventListener('click', function() {
        navigateBasedOnSession('person');
    });
    document.getElementById('shoppingBagIcon').addEventListener('click', function() {
        navigateBasedOnSession('shoppingBag');
    });
    document.getElementById('logoutIcon').addEventListener('click', logout);
});

function navigateBasedOnSession(action) {
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





function toggleMenu() {
    var menu = document.querySelector('.navigation-menu');
    menu.classList.toggle('active');
}


const header_hamburger = document.querySelector(".header_hamburger");
const header_navMenu = document.querySelector(".header_nav-menu");

header_hamburger.addEventListener("click", () => {
    header_hamburger.classList.toggle("active");
    header_navMenu.classList.toggle("active");
}); // Add a semicolon here