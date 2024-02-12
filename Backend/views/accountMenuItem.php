
<style>
.details_group_1{
    margin:0;
    color:#ADB5BB;
}
.surface_primary_body{
    display: flex;
    justify-content: space-between;
}
.surface_primary_body_account{
    width:50%;
}
.surface_primary_body_shipping{
    width:50%;
}
</style>
<div class="surface_primary_header">
    <div class="surface_header1">
        <h4>My profile</h4>
    </div>
    <div class="surface_header2">
        <p>Personal Information</p>
    </div>
</div>
<div class="surface_primary_body">
    <div class="surface_primary_body_account">
        <div class="details_group">
            <p class="details_group_1">
                Real name
            </p>
            <p class="details_group_2">
                <?php echo htmlspecialchars($_SESSION['session_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
            </p>
        </div>
        <div class="details_group">
            <p class="details_group_1">
                E-mail
            </p>
            <p class="details_group_2">
                <?php echo htmlspecialchars($_SESSION['session_email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
            </p>
        </div>
        <div class="details_group">
            <p class="details_group_1">
                Phone number
            </p>
            <p class="details_group_2">
                <?php echo htmlspecialchars($_SESSION['session_phone_number'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
            </p>
        </div>
        <div class="details_group">
            <p class="details_group_1">
                Birthdate
            </p>
            <p class="details_group_2">
                <?php echo htmlspecialchars($_SESSION['session_birthdate'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
            </p>
        </div>
    </div>
    <div class="surface_primary_body_shipping">
        <?php foreach ($addresses as $address): ?>
            <div class="details_group">
                <p class="details_group_1">Country</p>
                <p class="details_group_2"><?php echo htmlspecialchars($address['country'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div class="details_group">
                <p class="details_group_1">Postal Code</p>
                <p class="details_group_2"><?php echo htmlspecialchars($address['postal_code'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div class="details_group">
                <p class="details_group_1">City</p>
                <p class="details_group_2"><?php echo htmlspecialchars($address['city'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div class="details_group">
                <p class="details_group_1">Street Address</p>
                <p class="details_group_2"><?php echo htmlspecialchars($address['street_address'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

</div>
