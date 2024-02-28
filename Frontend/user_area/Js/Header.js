document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('personIcon').addEventListener('click', function() {
        navigateBasedOnSession('person');
    });
    document.getElementById('shoppingBagIcon').addEventListener('click', function() {
        navigateBasedOnSession('shoppingBag');
    });
    document.getElementById('logoutIcon').addEventListener('click', function() {
        logout();
    });
});


function navigateBasedOnSession(action) {
    $.ajax({
        type: "POST",
        url: "../../Backend/controllers/SessionController.php",
        data: { action: "checkSessionAjax" },
        success: function(response) {
            const res = JSON.parse(response);
            if (res.isLoggedIn) {
                if (action === 'person') {
                    window.location.href = '../ProfilePage.php';
                } else if (action === 'shoppingBag') {
                    window.location.href = '../CartPage.php';
                }
            } else {
                window.location.href = '../LoginPage.html';
            }
        }
    });
}

function logout() {
    $.ajax({
        type: "POST",
        url: "../../Backend/controllers/SessionController.php",
        data: { action: "logout" },
        success: function() {
            window.location.href = '../user_area/Logout.html';
        }
    });
}