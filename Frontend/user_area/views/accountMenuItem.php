<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/AccountMenuItem.css">
</head>
<body>
    

<div class="surface_primary_header">
    <div class="surface_header1">
        <h4>My profile</h4>
    </div>
    <div class="surface_header2">
        <p>Personal informations</p>
    </div>
</div>
<div class="surface_primary_body">
    <div class="surface_primary_body_account">
        <div class="details_group">
            <p class="details_group_1">Username</p>
            <p class="details_group_2"><?php echo isset($userData['username']) ? $userData['username'] : 'Nincs megadva'; ?></p>
        </div>
        <div class="details_group">
            <p class="details_group_1">Fullname</p>
            <p class="details_group_2"><?php echo isset($userData['first_name']) && isset($userData['last_name']) ? $userData['first_name'] . ' ' . $userData['last_name'] : 'Nincs megadva'; ?></p>
        </div>
        <div class="details_group">
            <p class="details_group_1">E-mail</p>
            <p class="details_group_2"><?php echo isset($userData['email']) ? $userData['email'] : 'Nincs megadva'; ?></p>
        </div>
        <!-- Ha szükséges, itt adhatsz meg további részleteket -->
    </div>


    <div class="surface_primary_body_shipping">
        <div class="details_group">
            <p class="details_group_1">Country</p>
            <p class="details_group_2"><?php echo isset($shippingData['country']) ? $shippingData['country'] : 'Nincs megadva'; ?></p>
        </div>
        <div class="details_group">
            <p class="details_group_1">Postal code</p>
            <p class="details_group_2"><?php echo isset($shippingData['postal_code']) ? $shippingData['postal_code'] : 'Nincs megadva'; ?></p>
        </div>
        <div class="details_group">
            <p class="details_group_1">City</p>
            <p class="details_group_2"><?php echo isset($shippingData['city']) ? $shippingData['city'] : 'Nincs megadva'; ?></p>
        </div>
        <div class="details_group">
            <p class="details_group_1">Street and house number</p>
            <p class="details_group_2"><?php echo isset($shippingData['street_address']) ? $shippingData['street_address'] : 'Nincs megadva'; ?></p>
        </div>
    </div>
</div>

</body>
</html>