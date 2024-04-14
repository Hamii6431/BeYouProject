// Főoldalra való átirányítás függvénye
function redirectToHome() {
    window.location.href = "Home.html";
}

// Hamburger menü toggle függvénye
function toggleMenu() {
    const navigationMenu = document.querySelector('.navigation-menu');
    navigationMenu.classList.toggle('active');
}
