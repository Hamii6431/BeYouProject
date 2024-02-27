<style>
    .details_group_1 {
        margin: 0;
        color: #ADB5BB;
    }

    .surface_primary_body {
        display: flex;
        justify-content: space-between;
    }

    .surface_primary_body_account {
        width: 50%;
    }

    .surface_primary_body_shipping {
        width: 50%;
    }
</style>
<div class="surface_primary_header">
    <div class="surface_header1">
        <h4>Saját Profilom</h4>
    </div>
    <div class="surface_header2">
        <p>Személyes Információk</p>
    </div>
</div>
<div class="surface_primary_body">
    <div class="surface_primary_body_account">
        <div class="details_group">
            <p class="details_group_1">Felhasználónév</p>
            <p class="details_group_2"><?php echo isset($userData['username']) ? $userData['username'] : 'Nincs megadva'; ?></p>
        </div>
        <div class="details_group">
            <p class="details_group_1">Teljes Név</p>
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
            <p class="details_group_1">Ország</p>
            <p class="details_group_2"><?php echo isset($shippingData['country']) ? $shippingData['country'] : 'Nincs megadva'; ?></p>
        </div>
        <div class="details_group">
            <p class="details_group_1">Irányítószám</p>
            <p class="details_group_2"><?php echo isset($shippingData['postal_code']) ? $shippingData['postal_code'] : 'Nincs megadva'; ?></p>
        </div>
        <div class="details_group">
            <p class="details_group_1">Város</p>
            <p class="details_group_2"><?php echo isset($shippingData['city']) ? $shippingData['city'] : 'Nincs megadva'; ?></p>
        </div>
        <div class="details_group">
            <p class="details_group_1">Utca és házszám</p>
            <p class="details_group_2"><?php echo isset($shippingData['street_address']) ? $shippingData['street_address'] : 'Nincs megadva'; ?></p>
        </div>
    </div>
</div>