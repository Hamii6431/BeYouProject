document.getElementById('addToCartBtn').addEventListener('click', function () {
    var popupBox = document.getElementById('popupBox');
    // AJAX kérés végrehajtása
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Backend/user_area/add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    var formData = new FormData(document.getElementById('addToCartForm'));
    xhr.send(new URLSearchParams(formData));

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Sikeres válasz esetén itt kezelheted a választ, ha szükséges
            console.log(xhr.responseText);
            // Megjelenítjük a popup boxot
            popupBox.style.display = 'block';
        } else {
            // Hiba esetén kezelheted a hibát
            console.error(xhr.responseText);
        }
    };
});
function closePopupBox() {
    var popupBox = document.getElementById('popupBox');
    popupBox.style.display = 'none';
}
function showDescription() {
    var descriptionDiv = document.querySelector('.description');
    if (descriptionDiv.style.display === 'none' || descriptionDiv.style.display === '') {
        descriptionDiv.style.display = 'block';
    } else {
        descriptionDiv.style.display = 'none';
    }
}
function showDetails() {
    // AJAX kérés a termék részleteinek lekérdezéséhez
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Backend/user_area/get_product_details.php?id=" + <?php echo $productID; ?>, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Sikeres válasz esetén a JSON adatok feldolgozása
            var details = JSON.parse(xhr.responseText);

            // Elemek kiválasztása
            var detailsDiv = document.querySelector('.details');
            var detailsBtn = document.querySelector('.details_and_details_btn');

            // Szöveg beállítása a részletek div-be
            detailsDiv.innerHTML = `
                <p><strong>Color:</strong> ${details.color_Name}</p>
                <p><strong>Type:</strong> ${details.type_Name}</p>
                <p><strong>Material:</strong> ${details.material_Name}</p>
            `;

            // Megjelenítés/kikapcsolás állapotának kezelése
            if (detailsDiv.style.display === 'none' || detailsDiv.style.display === '') {
                detailsDiv.style.display = 'block';
                detailsBtn.classList.add('active');  // Opcionális: Aktív osztály hozzáadása a gombhoz stílusozáshoz
            } else {
                detailsDiv.style.display = 'none';
                detailsBtn.classList.remove('active');  // Opcionális: Aktív osztály eltávolítása a gombtól stílusozáshoz
            }
        } else {
            // Hiba esetén kiírjuk a konzolra a hibaüzenetet
            console.error(xhr.responseText);
        }
    };

    xhr.send();
}


