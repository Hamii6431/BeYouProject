<?php
// server-side-script.php

// Ellenőrizze, hogy a menuItemId paraméter be van-e állítva
if (isset($_GET['menuItemId'])) {
    $menuItemId = $_GET['menuItemId'];

    // Ellenőrizze, melyik menüpont lett kiválasztva, és generálja a tartalmat
    switch ($menuItemId) {
        case 'accountMenuItem':
            $content = '<h2>Account Page</h2><p>This is the content for the Account page.</p>';
            break;
        case 'manageAccountMenuItem':
            $content = '<div class="surface_header">
                            <div class="surface_header1">
                                <h4>Manage account</h4>
                            </div>
                            <div class="surface_header2">
                                <p>Personal informations</p>
                            </div>
                        </div>
                        <div class="surface_body">
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="container_input" placeholder=" "> 
                                <label for="username">Enter your username </label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="real_name" id="real_name" class="container_input" placeholder=" " required>
                                <label for="real_name">Enter your real name </label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="container_input" placeholder=" " required>
                                <label for="email">Email </label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone_number" id="phone_number" class="container_input" placeholder=" " required>
                                <label for="phone_number">Phone number </label>
                            </div>
                            <div class="form-group">
                                <input type="date" name="birthdate" id="birthdate" class="container_input" placeholder=" " required>
                                <label for="birthdate">Enter your birthdate </label>
                            </div>
                            <div class="form-group">
                                <label for="gender">Select your gender </label>
                                <select name="gender" id="gender" class="container_input" required>
                                    <option value="" disabled selected>Select your gender</option>
                                    <option value="Women">Women</option>
                                    <option value="Man">Man</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <button class="sample_button_reverse" type="submit" name="user_login">SAVE</button>
                        </div>';
            break;
        case 'shippingAddressesMenuItem':
            $content = '<div class="surface_header">
                            <div class="surface_header1">
                                <h4>Shipping addresses</h4>
                            </div>
                            <div class="surface_header2">
                                <p>Shipping informations</p>
                            </div>
                        </div>
                        <div class="surface_body">
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="container_input" placeholder=" " required>
                                <label for="username">Enter your clountry </label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="real_name" id="real_name" class="container_input" placeholder=" " required>
                                <label for="real_name">Enter your postalcode</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="container_input" placeholder=" " required>
                                <label for="email">City</label>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone_number" id="phone_number" class="container_input" placeholder=" " required>
                                <label for="phone_number">Enter your street address</label>
                            </div>

                            <button class="sample_button_reverse" type="submit" name="user_login">SAVE</button>
                        </div>';
            break;
        case 'myOrdersMenuItem':
            $content = '<h2>My Orders Page</h2><p>This is the content for the My Orders page.</p>';
            break;
        default:
            $content = '<h2>Default Page</h2><p>This is the default content.</p>';
    }

    // Küldje vissza a generált tartalmat
    echo $content;
} else {
    // Ha a menuItemId nincs beállítva, küldjön vissza egy hibaüzenetet
    echo 'Error: menuItemId is not set.';
}
?>
