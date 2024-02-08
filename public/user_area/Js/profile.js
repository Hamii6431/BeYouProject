document.addEventListener('DOMContentLoaded', function () {
    var profileContainer = document.getElementById('profileContainer');

    // Menüelemek kattintás eseménye
    document.querySelectorAll('.container_menuitem').forEach(function (menuItem) {
        menuItem.addEventListener('click', function () {
            var menuItemId = this.id;
            loadContent(menuItemId);
        });
    });

    // Alapértelmezett tartalom betöltése
    loadContent('accountMenuItem');

    function loadContent(menuItemId) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                profileContainer.innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "server-side-script.php?menuItemId=" + menuItemId, true);
        xhttp.send();
    }
});
