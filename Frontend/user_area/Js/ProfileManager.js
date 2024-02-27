$(document).ready(function() {
    // Kattintás eseménykezelő hozzáadása a menüpontokhoz
    $('.container_menuitem').click(function() {
        var menuItemId = $(this).attr('id'); // Kiválasztott menüpont azonosítója
        loadContent(menuItemId); // Tartalom betöltése AJAX kéréssel
    });

    // Felhasználó teljes nevének betöltése
    loadFullName();
});

function loadContent(menuItemId) {
    $.ajax({
        type: 'GET',
        url: '../../Backend/controllers/ProfileContentController.php', // A vezérlő elérési útvonala
        data: { menuItemId: menuItemId }, // Küldendő adatok
        success: function(response) {
            $('#profileContainer').html(response); // Az AJAX válasz beillesztése a profil konténerbe
        },
        error: function(xhr, status, error) {
            // Hibakezelés
            console.error(xhr.responseText);
        }
    });
}

function loadFullName() {
    $.ajax({
        type: 'GET',
        url: '../../Backend/controllers/ProfileContentController.php', // A vezérlő elérési útvonala
        success: function(response) {
            // Sikeres válasz esetén a felhasználó teljes nevének beállítása
            var fullName = response.trim(); // Az esetleges whitespace karakterek eltávolítása
            var userName = $('.container_profil_preview_name h5');
            userName.text(fullName);
        },
        error: function(xhr, status, error) {
            // Hibakezelés
            console.error(error);
        }
    });
}
