<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/user_area/css/products.css">
    <link rel="stylesheet" href="../../public/user_area/css/font_import.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
</head>
<body>
    <div class="container-fluid">
        <div class="banner-container">
            <img class="banner-img" src="../../public/img/bannerimg_2.png" alt="Banner kép">
        </div>
    </div>
    <div class="container-fluid primary_container mt-4">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-3">
                <div class="type_header mb-2">
                    <h4>Jewellery</h4>
                </div>
                <form id="filterForm">
                    <div class="filter">
                        <h3>Types:</h3>
                        <div class="type_filter">
                            <!-- Típusok dinamikus betöltése -->
                        </div>
                    </div>
                    <hr>
                    <div class="filter">
                        <h3>Colours:</h3>
                        <div class="color_filter">
                            <!-- Színek dinamikus betöltése -->
                        </div>
                    </div>
                    <hr>
                    <div class="filter">
                        <h3>Materials:</h3>
                        <div class="material_filter">
                            <!-- Anyagok dinamikus betöltése -->
                        </div>
                    </div>
                </form>
                <hr>
            </div>
            <div class="col-12 col-md-9 col-lg-9">
                <div id="productDisplay" class="productdisplay row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <!-- Termékek dinamikusan frissülnek ide úgy, hogy minden termék egy külön productBoxot kap. -->
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript linkek -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-+/zF3N6r8+dsv3UnT2K2Hb8HXJDk2nt2iQy5t668rEw=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha384-BmzXrC0L3K/duZsSQIQHP2bZtBL/Ze7j1ayaoIJbN2RsIZKTuIdHpA+E+86mKxqX" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-12o46T3at/S3dGv2KH7tkXzjxOhZN/sQDME+9O8y/OgAa3EvF8YnMIV3FfD2Qqu9" crossorigin="anonymous"></script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    fetchFilters();
    fetchProducts();

    function fetchFilters() {
        fetch('../../Backend/api/getFilters.php')
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
        fetch(`../../Backend/api/getProducts.php?${filters}`)
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
            window.location.href = 'product.php?id=' + productID;
        }
</script>
