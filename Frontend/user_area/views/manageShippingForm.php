<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="surface_primary_header">
    <div class="surface_header1">
        <h4>Manage Your Shipping Addresses</h4>
    </div>
    <div class="surface_header2">
        <p>Shipping Information</p>
    </div>
</div>

<div class="surface_primary_body">
    <form action="/BeYou_web/Beyouproject/Backend/controllers/ShippingController.php" method="POST">
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="container_input" value="<?php echo isset($shippingData['phone_number']) ? $shippingData['phone_number'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" name="country" id="country" class="container_input" value="<?php echo isset($shippingData['country']) ? $shippingData['country'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" name="postal_code" id="postal_code" class="container_input" value="<?php echo isset($shippingData['postal_code']) ? $shippingData['postal_code'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" class="container_input" value="<?php echo isset($shippingData['city']) ? $shippingData['city'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="street_address">Street Address</label>
            <input type="text" name="street_address" id="street_address" class="container_input" value="<?php echo isset($shippingData['street_address']) ? $shippingData['street_address'] : ''; ?>" required>
        </div>
        
        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
        <input type="hidden" name="address_id" value="<?php echo isset($shippingData['address_id']) ? $shippingData['address_id'] : ''; ?>">
        <button type="submit" name="update_address" class="sample_button_reverse">Update Address</button>
    </form>
</div>

</body>
</html>