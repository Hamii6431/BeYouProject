$(document).ready(function() {
    $('.container-menuitem').click(function() {
        var menuItemId = $(this).attr('id'); // Kiválasztott menüpont azonosítója

        // Tartalom betöltése AJAX kéréssel
        loadContent(menuItemId);
    });

    function loadContent(menuItemId) {
        $.ajax({
            type: 'POST',
            url: '../../Backend/controllers/AdminContentController.php', // Javított URL
            data: { 'menuItemId': menuItemId }, // A 'menuItemId' kulcsot használva adjuk át az értéket
            success: function(response) {
                $('#adminContainer').html(response); // Javított célkonténer
            },
            error: function(xhr, status, error) {
                console.error("Hiba történt: " + xhr.responseText);
            }
        });
    }
});