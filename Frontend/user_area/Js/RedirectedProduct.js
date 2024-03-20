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

    const buyButton = document.querySelector('.buy-button');
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

