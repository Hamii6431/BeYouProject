document.addEventListener('DOMContentLoaded', function() {
    fetchShippingData();

    const updateAddressForm = document.querySelector('.surface_primary_body form');
    updateAddressForm.addEventListener('submit', function(event) {
        event.preventDefault();
        updateShippingData(new FormData(this));
    });
});

function fetchShippingData() {
    // Itt kérdezd le a szállítási adatokat, és töltsd fel az űrlapot
    fetch('/BeYou_web/Beyouproject/Backend/controllers/ShippingController.php?action=getShippingData')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Itt töltse be az adatokat az űrlap mezőibe
            } else {
                console.error('Failed to load shipping data');
            }
        })
        .catch(error => console.error('Error:', error));
}

function updateShippingData(formData) {
    // Itt küldd el az űrlap adatokat, és kezeld a választ
    fetch('/BeYou_web/Beyouproject/Backend/controllers/ShippingController.php?action=updateShippingData', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Shipping data updated successfully');
                // Itt irányíthatod át a felhasználót, vagy jeleníthetsz meg sikeres üzenetet
            } else {
                console.error('Failed to update shipping data');
            }
        })
        .catch(error => console.error('Error:', error));
}
