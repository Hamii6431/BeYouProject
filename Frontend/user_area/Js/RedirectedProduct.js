document.addEventListener('DOMContentLoaded', function() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const productId = urlParams.get('id');
    
    if (productId) {
        fetch('../../Backend/controllers/ProductController.php?action=getProductDetails&productId=' + productId)
            .then(response => response.json())
            .then(product => {
                document.querySelector('.container-product-image img').src = "../../public/product_images/" + product.default_image_url;
                document.querySelector('.container-product-details h1').innerText = product.product_name;
                document.querySelector('.container-product-details p').innerText = product.description;
                document.querySelector('.container-product-details h2').innerText = "$" + product.price;
            })
            .catch(error => console.error('Error:', error));
    } else {
        console.error('No product ID provided');
    }

    const buyButton = document.getElementById('buy-button');
    if (buyButton) {
        buyButton.addEventListener('click', function() {
            if (productId) {
                fetch('../../Backend/controllers/CartController.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `action=addToCart&product_id=${productId}`
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'success') {
                        showToast('Product added to cart successfully!');
                    } else {
                        showToast('Failed to add product to cart: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    }
});

//Felhasználói értesítés elem
let isToastVisible = false;

function showToast(message) {
    if (isToastVisible) return;

    // Nézet mozgatása a képernyő tetejére.
    window.scrollTo(0, 0);

    isToastVisible = true;
    const toastContainer = document.getElementById('toastContainer');
    if (!toastContainer) {
        console.error('Toast container not found');
        return;
    }
    const toast = document.createElement('div');
    toast.classList.add('toast');
    toast.textContent = message;

    toastContainer.appendChild(toast);
    setTimeout(() => {
        toast.classList.add('show');
    }, 100);

    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            toastContainer.removeChild(toast);
            isToastVisible = false;
        }, 500);
    }, 3000);
}