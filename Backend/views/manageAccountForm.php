<div class="surface_header">
    <div class="surface_header1">
        <h4>Manage Account</h4>
    </div>
    <div class="surface_header2">
        <p>Personal Information</p>
    </div>
</div>
<div class="surface_body">
    <form action="/path/to/update/account" method="post">
        <!-- Felhasználónév -->
        <div class="form-group">
            <input type="text" name="username" id="username" class="container_input" value="<?php echo $_SESSION['session_username']; ?>" required>
            <label for="username">Username</label>
        </div>
        <!-- Valódi név -->
        <div class="form-group">
            <input type="text" name="real_name" id="real_name" class="container_input" value="<?php echo $_SESSION['session_name']; ?>" required>
            <label for="real_name">Real Name</label>
        </div>
        <!-- E-mail -->
        <div class="form-group">
            <input type="email" name="email" id="email" class="container_input" value="<?php echo $_SESSION['session_email']; ?>" required>
            <label for="email">Email</label>
        </div>
        <!-- Telefonszám -->
        <div class="form-group">
            <input type="tel" name="phone_number" id="phone_number" class="container_input" value="<?php echo $_SESSION['session_phone_number']; ?>" required>
            <label for="phone_number">Phone Number</label>
        </div>
        <!-- Születésnap -->
        <div class="form-group">
            <input type="date" name="birthdate" id="birthdate" class="container_input" value="<?php echo $_SESSION['session_birthdate']; ?>" required>
            <label for="birthdate">Birthdate</label>
        </div>
        <!-- Nem -->
        <div class="form-group">
            <select name="gender" id="gender" class="container_input" required>
                <option value="" disabled>Select your gender</option>
                <option value="Female">Female</option>
                <option value="Male" >Male</option>
                <option value="Other" >Other</option>
            </select>
            <label for="gender">Gender</label>
        </div>
        <button class="sample_button_reverse" type="submit" name="update_account">Update Account</button>
    </form>
</div>
