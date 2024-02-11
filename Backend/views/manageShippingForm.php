<div class="surface_header">
    <div class="surface_header1">
        <h4>Shipping Addresses</h4>
    </div>
    <div class="surface_header2">
        <p>Manage your shipping addresses</p>
    </div>
</div>
<div class="surface_body">
    <!-- Egyszerű form az új cím hozzáadására -->
    <form action="/path/to/update/shipping" method="post">
        <div class="form-group">
            <input type="text" name="name" id="name" class="container_input"  required>
            <label for="real_name">Real Name</label>
        </div>
        <div class="form-group">
            <input type="text" name="country" id="country" class="container_input" value="<?php echo htmlspecialchars($address['country'], ENT_QUOTES, 'UTF-8'); ?>" required>
            <input type="text" name="country" id="country" class="container_input" placeholder="Country" required>
            <label for="country">Country</label>
        </div>
        <div class="form-group">
            <input type="text" name="postal_code" id="postal_code" class="container_input" placeholder="Postal Code" required>
            <label for="postal_code">Postal Code</label>
        </div>
        <div class="form-group">
            <input type="text" name="city" id="city" class="container_input" placeholder="City" required>
            <label for="city">City</label>
        </div>
        <div class="form-group">
            <input type="text" name="street_address" id="street_address" class="container_input" placeholder="Street Address" required>
            <label for="street_address">Street Address</label>
        </div>
        <button class="sample_button_reverse" type="submit" name="add_shipping_address">Add Address</button>
    </form>


</div>
