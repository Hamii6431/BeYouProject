
<body>
<div class="surface">
    <div class="dashboard-base1">
        <div class="recent-users">
            <div class="recent-users-header">
                <h2>Manage Users</h2>
            </div>
            <div class="recent-users-table">
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($updateUserCount as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['user_id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['first_name']) ?></td>
                            <td><?= htmlspecialchars($user['last_name']) ?></td>
                            <td><button class="modalButton" onclick="openModal(<?= htmlspecialchars($user['user_id']) ?>)">Edit</button></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (count($updateUserCount) === 0): ?>
                        <tr>
                            <td colspan="6">No users found</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- Modális Ablak HTML -->
    <div id="editUserModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit User</h2>
        <form id="editUserForm">
            <input type="hidden" name="editUserId" id="editUserId">
                
                <div class="form-group">
                        <label for="editUsername">Userame: <?= htmlspecialchars($user['username']) ?></label>
                    <input type="text" name="editUsername" id="editUsername" required>
                </div>

                <div class="form-group">
                    <label for="editEmail">Email: <?= htmlspecialchars($user['email']) ?></label>
                    <input type="text" name="editEmail" id="editEmail" required>
                </div>

                <div class="form-group">
                    <label for="editFirstname">First Name: <?= htmlspecialchars($user['first_name']) ?></label>
                    <input type="text" name="editFirstname" id="editFirstname" required>
                </div>

                <div class="form-group">
                    <label for="editLastname">Last Name: <?= htmlspecialchars($user['last_name']) ?></label>
                    <input type="text" name="editLastname" id="editLastname" required>
                </div>

                <button class="modalButton2" type="button" onclick="updateProduct()">Save</button>
            
            </form>
        </div>
    </div>



<script>
    // Modális ablak megnyitása
    function openModal(userId) {
        // Ide jön a logika az adatok betöltésére a szerkesztési űrlapra
        document.getElementById('editUserId').value = userId;
        // További mezők kitöltése az adatbázisból lekérdezett adatok alapján

        document.getElementById('editUserModal').style.display = 'block';
    }

    // Modális ablak bezárása
    var modal = document.getElementById('editUserModal');
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    
    function updateProduct() {
        var formData = new FormData(document.getElementById('editUserForm'));
        formData.append('action', 'updateUser'); // Fel kell venni egy action mezőt, hogy a szerver tudja, mit kell tennie

        fetch('/BeYou_web/Beyouproject/Backend/controllers/AdminContentController.php', { // A pontos útvonalat be kell állítani
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Visszajelzés megjelenítése
            if(data.success) {
                // Frissítheted a UI-t, ha szükséges
                document.getElementById('editUserModal').style.display = 'none';
            }
        })
        .catch(error => console.error('Error:', error));
    }

</script>
</body>