

<div class="surface_primary_header">
    <div class="surface_header1">
        <h4>Manage Account</h4>
    </div>
    <div class="surface_header2">
        <p>Personal Information</p>
    </div>
</div>
<div class="surface_primary_body">
    <form action="/BeYou_web/Beyouproject/Backend/controllers/ProfileController.php" method="post">

        <!-- Valódi név -->
        <div class="form-group">
            <input type="text" name="name" id="name" class="container_input" value="<?php echo htmlspecialchars($_SESSION['session_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            <label for="real_name">Real Name</label>
        </div>
        <!-- E-mail -->
        <div class="form-group">
            <input type="email" name="email" id="email" class="container_input" value="<?php echo htmlspecialchars($_SESSION['session_email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            <label for="email">Email</label>
        </div>
        <!-- Telefonszám -->
        <div class="form-group">
            <input type="tel" name="phone_number" id="phone_number" class="container_input" value="<?php echo htmlspecialchars($_SESSION['session_phone_number'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            <label for="phone_number">Phone Number</label>
        </div>
        <!-- Születésnap -->
        <div class="form-group">
            <input type="date" name="birthdate" id="birthdate" class="container_input" value="<?php echo htmlspecialchars($_SESSION['session_birthdate'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
            <label for="birthdate">Birthdate</label>
        </div>
        <!-- Nem -->
        <div class="form-group">
            <select name="gender" id="gender" class="container_input" required>
                <option value="" disabled>Select your gender</option>
                <option value="Female" <?php echo (isset($_SESSION['session_gender']) && $_SESSION['session_gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                <option value="Male" <?php echo (isset($_SESSION['session_gender']) && $_SESSION['session_gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Other" <?php echo (isset($_SESSION['session_gender']) && $_SESSION['session_gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
            </select>
            <label for="gender">Gender</label>
        </div>
        <button class="sample_button_reverse" type="submit" name="update_account">Update Account</button>
    </form>
</div>
