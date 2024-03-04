<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="path_to_your_css_file"> <!-- Szükség szerint adj hozzá CSS fájlt -->
</head>
<body>

<h1 class="text-center">Add Product</h1>

<form action="your_action_page.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>
    </div>

    <div class="form-group">
        <label for="product_price">Product Price:</label>
        <input type="number" name="product_price" id="product_price" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="product_desc">Product Description:</label>
        <textarea name="product_desc" id="product_desc" required></textarea>
    </div>

    <div class="form-group">
        <label for="product_stock">Product Stock:</label>
        <input type="number" name="product_stock" id="product_stock" required>
    </div>

    <div class="form-group">
        <label for="product_color">Select Color:</label>
        <select name="product_color" id="product_color" required>
            <option value="">--Select Color--</option>
            <!-- PHP kód a színek dinamikus beillesztésére -->
            <?php foreach ($colors as $color): ?>
                <option value="<?= $color['color_id'] ?>"><?= $color['color_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="product_type">Select Type:</label>
        <select name="product_type" id="product_type" required>
            <option value="">--Select Type--</option>
            <!-- PHP kód a típusok dinamikus beillesztésére -->
            <?php foreach ($types as $type): ?>
                <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="product_material">Select Material:</label>
        <select name="product_material" id="product_material" required>
            <option value="">--Select Material--</option>
            <!-- PHP kód az anyagok dinamikus beillesztésére -->
            <?php foreach ($materials as $material): ?>
                <option value="<?= $material['material_id'] ?>"><?= $material['material_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" id="product_image" required>
    </div>

    <button type="submit" name="insert_product">Add Product</button>
</form>

</body>
</html>
