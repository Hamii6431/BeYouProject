document.addEventListener('DOMContentLoaded', function() {
    fetchFilters();
    fetchProducts();

    function fetchFilters() {
        fetch('../../Backend/controllers/FilterController.php')
        .then(response => response.json())
        .then(data => {
            populateFilters(data);
        })
        .catch(error => console.error('Error fetching filters:', error));
    }

    function populateFilters(data) {
        const typeFilterContainer = document.querySelector('.type_filter');
        const colorFilterContainer = document.querySelector('.color_filter');
        const materialFilterContainer = document.querySelector('.material_filter');

        data.types.forEach(type => {
            typeFilterContainer.innerHTML += `<div class="wrapper">
                <input type="checkbox" name="types" value="${type.id}" id="type_${type.id}">
                <label for="type_${type.id}">${type.name}</label>
            </div>`;
        });

        data.colors.forEach(color => {
            colorFilterContainer.innerHTML += `<div class="wrapper">
                <input type="checkbox" name="colors" value="${color.id}" id="color_${color.id}">
                <label for="color_${color.id}">${color.name}</label>
            </div>`;
        });

        data.materials.forEach(material => {
            materialFilterContainer.innerHTML += `<div class="wrapper">
                <input type="checkbox" name="materials" value="${material.id}" id="material_${material.id}">
                <label for="material_${material.id}">${material.name}</label>
            </div>`;
        });
    }

    function getSelectedFilters() {
        const form = document.getElementById('filterForm');
        const formData = new FormData(form);
        const params = new URLSearchParams();
    
        // Collecting selected filters
        formData.getAll('types').forEach(value => params.append('types[]', value));
        formData.getAll('colors').forEach(value => params.append('colors[]', value));
        formData.getAll('materials').forEach(value => params.append('materials[]', value));
    
        return params.toString();
    }    

    // Event listener for filter changes
    document.getElementById('filterForm').addEventListener('change', fetchProducts);


    function fetchProducts() {
        const filters = getSelectedFilters();
        fetch('../../Backend/controllers/ProductController.php?' + filters)
        .then(response => response.json())
        .then(products => {
            displayProducts(products);
        })
        .catch(error => console.error('Error fetching products:', error));
    }

    function displayProducts(products) {
        const productsContainer = document.getElementById('productDisplay');
        productsContainer.innerHTML = ''; // Clear previous products
        products.forEach(product => {
            productsContainer.innerHTML += `
                            <div class="product-box" data-type="${product.type}" data-color="${product.color}" data-material="${product.material}" onclick="redirectToProduct(${product.id})">
                                <div class="product-box-img">
                                    <img src="../../public/product_images/${product.image}" alt="${product.name}">
                                </div>
                                <div class="product-box-data">
                                    <div class="product-name">
                                        <p>${product.name}</p>
                                    </div>
                                    <div class="product-price">
                                        <p>${product.price} Ft</p>
                                    </div>
                                    <button class="buy-button" onclick="addToCart(${product.id})">Buy</button>
                                </div>
                            </div>`;
        });
    }

    
});

function redirectToProduct(productID) {
    window.location.href = 'RedirectedProduct.php?id=' + productID;
}
