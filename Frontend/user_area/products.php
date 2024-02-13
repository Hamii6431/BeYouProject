<?php
require_once '../../Backend/controllers/ProductController.php';
$controller = new ProductController();
list($types, $colors, $materials, $products) = $controller->handleRequest();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Termékek</title>
    <!-- Ide jöhetnek a stílusok -->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Termékek</h1>
                <form id="filterForm" action="products.php" method="post">
                    <!-- Szűrők helye (Típusok, Színek, Anyagok) -->
                    <!-- Példa: -->
                    <div>
                        <h3>Típus</h3>
                        <!-- A típusokat dinamikusan kell betölteni -->
                    </div>
                    <div>
                        <h3>Szín</h3>
                        <!-- A színeket dinamikusan kell betölteni -->
                    </div>
                    <div>
                        <h3>Anyag</h3>
                        <!-- Az anyagokat dinamikusan kell betölteni -->
                    </div>
                    <button type="submit">Szűrés</button>
                </form>
            </div>
            <div class="col-12" id="productDisplay">
                <!-- Termékek megjelenítése helye -->
            </div>
        </div>
    </div>

    <script>
        function filterProducts() {
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);

            fetch('../../Backend/controllers/ProductController.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(products => {
                const display = document.getElementById('productDisplay');
                display.innerHTML = ''; // Töröljük a korábbi termékeket
                products.forEach(product => {
                    const productElement = `
                        <div class="product">
                            <img src="../../public/product_images/${product.image}" alt="${product.name}">
                            <h3>${product.name}</h3>
                            <p>Ár: ${product.price} Ft</p>
                        </div>
                    `;
                    display.innerHTML += productElement;
                });
            })
            .catch(error => console.error('Hiba:', error));
        }
    </script>
</body>
</html>
