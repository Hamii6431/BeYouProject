    // Várjuk meg, hogy a DOM betöltődjön
    document.addEventListener('DOMContentLoaded', function() {
        // Az oldal betöltődésekor először lekérdezzük és megjelenítjük a szűrőket és a termékeket
        fetchFilters();
        fetchProducts();

        // Szűrők lekérése
        function fetchFilters() {
            fetch('../../Backend/controllers/FilterController.php')
            .then(response => response.json())
            .then(data => {
                populateFilters(data);
            })
            .catch(error => console.error('Error fetching filters:', error));
        }

        // Szűrők megjelenítése
        function populateFilters(data) {
            const gemstoneFilterContainer = document.querySelector('.gemstone_filter');
            const materialFilterContainer = document.querySelector('.material_filter');

            // Drágakövek megjelenítése
            data.gemstones.forEach(gemstone => {
                gemstoneFilterContainer.innerHTML += `<div class="wrapper">
                    <input type="checkbox" name="gemstones" value="${gemstone.id}" id="gemstone_${gemstone.id}">
                    <label for="gemstone_${gemstone.id}">${gemstone.name}</label>
                </div>`;
            });

            // Anyagok megjelenítése
            data.materials.forEach(material => {
                materialFilterContainer.innerHTML += `<div class="wrapper">
                    <input type="checkbox" name="materials" value="${material.id}" id="material_${material.id}">
                    <label for="material_${material.id}">${material.name}</label>
                </div>`;
            });
        }

    // Aktív szűrők lekérdezése
    function getSelectedFilters() {
        const form = document.getElementById('filterForm');
        const formData = new FormData(form);
        const params = new URLSearchParams();

        // Alapértelmezetten csak a 'Ring' típust válasszuk ki
        params.append('types[]', 6); 

        formData.getAll('gemstones').forEach(value => params.append('gemstones[]', value));
        formData.getAll('materials').forEach(value => params.append('materials[]', value));

        return params.toString();
    }

        // Szűrők változásakor újra lekérdezzük a termékeket
        document.getElementById('filterForm').addEventListener('change', fetchProducts);

        // Termékek lekérése
        function fetchProducts() {
            const filters = getSelectedFilters();
            fetch('../../Backend/controllers/ProductController.php?' + filters)
            .then(response => response.json())
            .then(products => {
                displayProducts(products);
            })
            .catch(error => console.error('Error fetching products:', error));
        }

        // Termékek megjelenítése
        function displayProducts(products) {
            const productsContainer = document.getElementById('productDisplay');
            productsContainer.innerHTML = ''; // Előző termékek törlése
            products.forEach(product => {
                let buyButton;
                if (product.in_stock == 1) {
                    buyButton = `<button class="sample-buy-button" onclick="addToCart(${product.id})">Buy</button>`;
                } else {
                    buyButton = `<button class="sample-buy-button out-of-stock">Out of Stock</button>`;
                }
                productsContainer.innerHTML += `
                    <div class="product-box" data-type="${product.type}" data-gemstone="${product.gemstone}" data-material="${product.material}" onclick="redirectToProduct(${product.id})">
                        <div class="product-box-img">
                            <img src="../../public/product_images/${product.image}" alt="${product.name}">
                        </div>
                        <div class="product-box-data">
                            <div class="product-name">
                                <p>${product.name}</p>
                            </div>
                            <div class="product-price">
                                <p>${product.price}$</p>
                            </div>
                            ${buyButton}
                        </div>
                    </div>`;
            });
        }
    });

    // Kiválasztott termék oldalára továbbítás
    function redirectToProduct(productID) {
        window.location.href = 'RedirectedProduct.html?id=' + productID;
    }