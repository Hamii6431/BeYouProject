
<body>

<h1 class="text-center">Add Product</h1>

<form id="productForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>
    </div>

    <div class="form-group">
        <label for="price">Product Price:</label>
        <input type="number" name="price" id="price" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="description">Product Description:</label>
        <textarea name="description" id="description" required></textarea>
    </div>

    <div class="form-group">
        <label for="stock">Product Stock:</label>
        <input type="number" name="stock" id="stock" required>
    </div>

    <div class="form-group">
        <label for="color_id">Select Color:</label>
        <select name="color_id" id="color_id" required>
            <option value="">--Select Color--</option>
            <!-- PHP kód a színek dinamikus beillesztésére -->
            <?php foreach ($colors as $color): ?>
                <option value="<?= $color['color_id'] ?>"><?= $color['color_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="type_id">Select Type:</label>
        <select name="type_id" id="type_id" required>
            <option value="">--Select Type--</option>
            <!-- PHP kód a típusok dinamikus beillesztésére -->
            <?php foreach ($types as $type): ?>
                <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="material_id">Select Material:</label>
        <select name="material_id" id="material_id" required>
            <option value="">--Select Material--</option>
            <!-- PHP kód az anyagok dinamikus beillesztésére -->
            <?php foreach ($materials as $material): ?>
                <option value="<?= $material['material_id'] ?>"><?= $material['material_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image" required>
    </div>

    <button class="modalButton" type="submit" name="addProduct">Add Product</button>
</form>



<script>
document.getElementById('productForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Megakadályozza az űrlap alapértelmezett beküldési viselkedését

    var formData = new FormData(this);
    formData.append('action', 'addProduct'); // Biztosítja, hogy az 'action' kulcs be legyen állítva

    fetch('/BeYou_web/Beyouproject/Backend/controllers/AdminContentController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
});
</script>


</body>
</html>
