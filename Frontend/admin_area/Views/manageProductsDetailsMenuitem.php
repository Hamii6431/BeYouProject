
<body>
    
    <div class="surface">
        <div class="dashboard-base1">
            <div class="recent-products">
                <div class="recent-products-header">
                    <h2>Manage Products</h2>
                </div>
                <div class="recent-products-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Stock</th>
                                <th>gemstone</th>
                                <th>Type</th>
                                <th>Material</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($latestProducts as $product): ?>
                            <tr>
                                <td><?= htmlspecialchars($product['product_id']) ?></td>
                                <td><?= htmlspecialchars($product['product_name']) ?></td>
                                <td><?= htmlspecialchars($product['price']) ?></td>
                                <td><?= htmlspecialchars($product['description']) ?></td>
                                <td><?= htmlspecialchars($product['stock']) ?></td>
                                <td><?= htmlspecialchars($product['gemstone_id']) ?></td>
                                <td><?= htmlspecialchars($product['type_id']) ?></td>
                                <td><?= htmlspecialchars($product['material_id']) ?></td>
                                <td><button class="modalButton" onclick="openModal(<?= $product['product_id'] ?>)">Edit</button></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (count($latestProducts) === 0): ?>
                            <tr>
                                <td colspan="5">No orders found</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modális Ablak HTML -->
    <div id="editProductModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Product</h2>
            <form id="editProductForm">
            <input type="hidden" name="editProductId" id="editProductId" value="">
            
            <div class="form-group">
                <label for="editProduct_name">Product Name: </label>
                <input type="text" name="editProduct_name" id="editProduct_name" class="container_input" novalidate>
            </div>

            <div class="form-group">
                <label for="editPrice">Product Price: </label>
                <input type="number" name="editPrice" id="editPrice" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="editDescription">Product Description: </label>
                <textarea name="editDescription" id="editDescription" required></textarea>
            </div>

            <div class="form-group">
                <label for="editStock">Product Stock: </label>
                <input type="number" name="editStock" id="editStock" required>
            </div>

            <div class="form-group">
                <label for="editGemstone_id">Select gemstone: </label>
                <select name="editGemstone_id" id="editGemstone_id" required>
                    <option value="">--Select gemstone--</option>
                    <!-- PHP kód a színek dinamikus beillesztésére -->
                    <?php foreach ($gemstones as $gemstone): ?>
                        <option value="<?= $gemstone['gemstone_id'] ?>"><?= $gemstone['gemstone_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="editType_id">Select Type: </label>
                <select name="editType_id" id="editType_id" required>
                    <option value="">--Select Type--</option>
                    <!-- PHP kód a típusok dinamikus beillesztésére -->
                    <?php foreach ($types as $type): ?>
                        <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="editMaterial_id">Select Material: </label>
                <select name="editMaterial_id" id="editMaterial_id" required>
                    <option value="">--Select Material--</option>
                    <!-- PHP kód az anyagok dinamikus beillesztésére -->
                    <?php foreach ($materials as $material): ?>
                        <option value="<?= $material['material_id'] ?>"><?= $material['material_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button class="modalButton2" type="button" onclick="updateProduct()">Save</button>
            </form>
        </div>
    </div>



<script>
    // Modális ablak megnyitása
    function openModal(productId) {
        fetch(`/BeYou_web/Beyouproject/Backend/controllers/AdminContentController.php?action=getProductDetails&productId=${productId}`)
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error('Error fetching product data:', data.message);
                return;
            }

            const productDetails = data.data;
            document.getElementById('editProductId').value = productId;
            document.getElementById('editProduct_name').value = productDetails.product_name || '';
            document.getElementById('editPrice').value = productDetails.price || '';
            document.getElementById('editDescription').value = productDetails.description || '';
            document.getElementById('editStock').value = productDetails.stock || '';
            document.getElementById('editGemstone_id').value = productDetails.gemstone_id || '';
            document.getElementById('editType_id').value = productDetails.type_id || '';
            document.getElementById('editMaterial_id').value = productDetails.material_id || '';
            // Megjegyzés: A képfeltöltési logika itt eltérhet, mivel az input típusú fájl mezők nem támogatják a "value" attribútum beállítását JavaScriptből.
            
            document.getElementById('editProductModal').style.display = 'block';
        })
        .catch(error => console.error('Error:', error));
    }


    // Modális ablak bezárása
    var modal = document.getElementById('editProductModal');
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    
    function updateProduct() {
    var formData = new FormData(document.getElementById('editProductForm'));
    formData.append('action', 'updateProduct'); // Fel kell venni egy action mezőt, hogy a szerver tudja, mit kell tennie

    fetch('/BeYou_web/Beyouproject/Backend/controllers/AdminContentController.php', { // A pontos útvonalat be kell állítani
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Visszajelzés megjelenítése
        if(data.success) {
            // Frissítheted a UI-t, ha szükséges
            document.getElementById('editProductModal').style.display = 'none';
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>
</body>