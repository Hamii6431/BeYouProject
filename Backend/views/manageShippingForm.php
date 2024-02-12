<div class="surface_primary_header">
    <div class="surface_header1">
        <h4>Manage Your Shipping Addresses</h4>
    </div>
    <div class="surface_header2">
        <p>Shipping Information</p>
    </div>
</div>

<div class="surface_primary_body">
<?php foreach ($addresses as $address): ?>
    <form action="/BeYou_web/Beyouproject/Backend/controllers/ShippingController.php" method="post">
        <input type="hidden" name="address_ID" value="<?php echo $address['address_ID']; ?>">
        <div class="form-group">
            <input type="text" name="country" id="country" class="container_input" value="<?php echo $address['country']; ?>" required>
            <label for="country">Country</label>
        </div>
        <div class="form-group">
            <input type="text" name="postal_code" id="postal_code" class="container_input" value="<?php echo $address['postal_code']; ?>" required>
            <label for="postal_code">Postal code</label>
        </div>
        <div class="form-group">
            <input type="text" name="city" id="city" class="container_input" value="<?php echo $address['city']; ?>" required>
            <label for="city">City</label>
        </div>
        <div class="form-group">
            <input type="text" name="street_address" id="street_address" class="container_input" value="<?php echo $address['street_address']; ?>" required>
            <label for="street_address">Street address</label>
        </div>
        <button class="sample_button_reverse" type="submit" name="update_address">Update Addresses</button>

    </form>
<?php endforeach; ?>
</div>

</body>
</html>
