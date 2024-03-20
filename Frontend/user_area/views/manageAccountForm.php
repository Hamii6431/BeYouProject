
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
        <h4>Manage Account</h4>
    </div>
    <div class="surface_header2">
        <p>Personal Information</p>
    </div>
</div>
<div class="surface_primary_body">
    <form action="/BeYou_web/Beyouproject/Backend/controllers/ProfileController.php" method="POST">

        <!-- Valódi név firstname és lastname külön rendezve.! -->
        <!-- Felhasználónév -->
        <div class="form-group">
            <input type="text" name="username" id="username" class="container_input" value="<?php echo isset($userData['username']) ? $userData['username'] : 'Nincs megadva'; ?>" required>
            <label for="username">Username</label>
        </div>
        <!-- Keresztnév -->
        <div class="form-group">
            <input type="text" name="first_name" id="first_name" class="container_input" value="<?php echo isset($userData['first_name']) ? $userData['first_name'] : 'Nincs megadva'; ?>" required>
            <label for="first_name">First name</label>
        </div>
        <!-- Vezetéknév -->
        <div class="form-group">
            <input type="text" name="last_name" id="last_name" class="container_input" value="<?php echo isset($userData['last_name']) ? $userData['last_name'] : 'Nincs megadva'; ?>" required>
            <label for="last_name">Last name</label>
        </div>
        <!-- E-mail -->
        <div class="form-group">
            <input type="email" name="email" id="email" class="container_input" value="<?php echo isset($userData['email']) ? $userData['email'] : 'Nincs megadva'; ?>" required>
            <label for="email">Email</label>
        </div>

        <button class="sample_button_reverse" type="submit" name="update_account">Update Account</button>
    </form>
</div>

    
</body>
</html>