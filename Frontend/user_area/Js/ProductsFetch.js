document.addEventListener('DOMContentLoaded', function() {
    fetchFilters();
    fetchProducts();

    function fetchFilters() {
        fetch('../../Backend/controllers/ProductApi.php?action=getFilters')
        .then(response => response.json())
        .then(data => {
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
        })
        .catch(error => console.error('Error:', error));
    }

    function fetchProducts() {
        const filters = getSelectedFilters();
        fetch(`../../Backend/controllers/ProductApi.php?action=getFilteredProducts&${filters}`)
        .then(response => response.json())
        .then(products => {
            const productsContainer = document.getElementById('productDisplay');
            productsContainer.innerHTML = ''; // Clear previous products
            products.forEach(product => {
                productsContainer.innerHTML += `
                                <div class="productbox" data-type="${product.type}" data-color="${product.color}" data-material="${product.material}" onclick="redirectToProduct(${product.id})">
                                    <div class="disp_productimg">
                                        <img src="../../public/product_images/${product.image}" alt="${product.name}">
                                    </div>
                                    <div class="disp_productdata mt-2">
                                        <div class="disp_productname">
                                            <p>${product.name}</p>
                                        </div>
                                        <div class="disp_productprice">
                                            <p>${product.price} Ft</p>
                                        </div>
                                        <button class="buy-button" onclick="addToCart(${product.id})">Buy</button>
                                    </div>
                                </div>`;
            });
        })
        .catch(error => console.error('Error fetching products:', error));
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
});

function redirectToProduct(productID) {
    window.location.href = 'RedirectedProduct.html?id=' + productID;
}
