<div class="surface_primary_header">
    <div class="surface_header1">
        <h4>Manage Your Shipping Addresses</h4>
    </div>
    <div class="surface_header2">
        <p>Shipping Information</p>
    </div>
</div>
<!-- shippingMenuItem.php -->

<div class="surface_primary_body">
    <form action="/BeYou_web/Beyouproject/Backend/controllers/ShippingController.php" method="post">
        <div class="form-group">
            <input type="text" name="phone_number" id="phone_number" class="container_input" value="<?php echo isset($shippingData['phone_number']) ? $shippingData['phone_number'] : 'Nincs megadva'; ?>" required>
            <label for="phone_number">Phone Number</label>
        </div>

        
        <div class="form-group">
            <input type="text" name="country" id="country" class="container_input" value="<?php echo isset($shippingData['country']) ? $shippingData['country'] : 'Nincs megadva'; ?>" required>
            <label for="country">Country</label>
        </div>
        <div class="form-group">
            <input type="text" name="postal_code" id="postal_code" class="container_input" value="<?php echo isset($shippingData['postal_code']) ? $shippingData['postal_code'] : 'Nincs megadva'; ?>" required>
            <label for="postal_code">Postal code</label>
        </div>
        <div class="form-group">
            <input type="text" name="city" id="city" class="container_input" value="<?php echo isset($shippingData['city']) ? $shippingData['city'] : 'Nincs megadva'; ?>" required>
            <label for="city">City</label>
        </div>
        <div class="form-group">
            <input type="text" name="street_address" id="street_address" class="container_input" value="<?php echo isset($shippingData['street_address']) ? $shippingData['street_address'] : 'Nincs megadva'; ?>" required>
            <label for="street_address">Street address</label>
        </div>
        <!-- Az address_id és user_id megtartása rejtett mezőkben -->
        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
        <input type="hidden" name="address_id" value="<?php echo isset($shippingData['address_id']) ? $shippingData['address_id'] : ''; ?>">
        <button class="sample_button_reverse" type="submit" name="update_address">Update Addresses</button>
    </form>
</div>


</body>
</html>
