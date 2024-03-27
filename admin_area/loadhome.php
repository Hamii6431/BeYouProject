
<style>
        .displayer {
            border: 2px solid pink;

            height: 150px; /* Változtathatsz az értéken az igényeid szerint */
            padding: 10px;
            position: relative;
        }

        .vertical_center {
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .image_container {
            position: absolute;
            top:60%;
            right: 0;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            height: 50%; /* A kép magassága a displayer div magasságának 50%-a */
        }

        .displayer:hover {
            background-color: #fce4ec; /* Halvány rózsaszín háttérszín hover állapotban */
        }

        .displayer_header {
            color: black; /* Fekete szín */
        }

        .displayer_data {
            color: gray; /* Szürke szín */
        }

        .menu-item {
            font-size: 18px;
            color: #343a40;
            text-decoration: none;
            padding: 10px;
        }

        .menu-item.active,
        .menu-item:hover {
            border-bottom: 2px solid pink;
        }

    </style>

<?php
include('../includes/connect.php');

// Query a user_table sorainak számolására
$user_count_query = "SELECT COUNT(*) as user_count FROM user_table";
$user_count_result = mysqli_query($con, $user_count_query);

// Ellenőrizzük, hogy a lekérdezés sikeres volt-e
if ($user_count_result) {
    // Fetch-eljük az eredményt asszociatív tömbként
    $user_count_data = mysqli_fetch_assoc($user_count_result);

    // Szerezzük meg a számláló értékét
    $user_count = $user_count_data['user_count'];
} else {
    // Ha a lekérdezés nem sikerült, állítsunk be egy alapértelmezett értéket
    $user_count = "N/A";
}

$new_user_query = "SELECT user_ID, username, email, name FROM user_table"


// Query a user_table sorainak számolására
$order_count_query = "SELECT COUNT(*) as order_count FROM orders";
$order_count_result = mysqli_query($con, $order_count_query);

// Ellenőrizzük, hogy a lekérdezés sikeres volt-e
if ($order_count_result) {
    // Fetch-eljük az eredményt asszociatív tömbként
    $order_count_data = mysqli_fetch_assoc($order_count_result);

    // Szerezzük meg a számláló értékét
    $order_count = $order_count_data['order_count'];
} else {
    // Ha a lekérdezés nem sikerült, állítsunk be egy alapértelmezett értéket
    $order_count = "N/A";
}
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="displayer mb-2">
                    <div class="vertical_center ms-3">
                        <div class="displayer_header">
                            <h4>[<?php echo $user_count; ?>]</h4>
                        </div>
                        <div class="displayer_data">
                            <h5>Regisztrált felhasználó</h5>
                        </div>
                    </div>
                    <div class="image_container me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                            <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="displayer mb-2">
                    <div class="vertical_center ms-3">
                        <div class="displayer_header">
                            <h4>[<?php echo $order_count; ?>]</h4>
                        </div>
                        <div class="displayer_data">
                            <h5>Leadott rendelések száma</h5>
                        </div>
                    </div>
                    <div class="image_container me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-pin-angle" viewBox="0 0 16 16">
                            <path d="M9.828.722a.5.5 0 0 1 .354.146l4.95 4.95a.5.5 0 0 1 0 .707c-.48.48-1.072.588-1.503.588-.177 0-.335-.018-.46-.039l-3.134 3.134a5.927 5.927 0 0 1 .16 1.013c.046.702-.032 1.687-.72 2.375a.5.5 0 0 1-.707 0l-2.829-2.828-3.182 3.182c-.195.195-1.219.902-1.414.707-.195-.195.512-1.22.707-1.414l3.182-3.182-2.828-2.829a.5.5 0 0 1 0-.707c.688-.688 1.673-.767 2.375-.72a5.922 5.922 0 0 1 1.013.16l3.134-3.133a2.772 2.772 0 0 1-.04-.461c0-.43.108-1.022.589-1.503a.5.5 0 0 1 .353-.146zm.122 2.112v-.002.002zm0-.002v.002a.5.5 0 0 1-.122.51L6.293 6.878a.5.5 0 0 1-.511.12H5.78l-.014-.004a4.507 4.507 0 0 0-.288-.076 4.922 4.922 0 0 0-.765-.116c-.422-.028-.836.008-1.175.15l5.51 5.509c.141-.34.177-.753.149-1.175a4.924 4.924 0 0 0-.192-1.054l-.004-.013v-.001a.5.5 0 0 1 .12-.512l3.536-3.535a.5.5 0 0 1 .532-.115l.096.022c.087.017.208.034.344.034.114 0 .23-.011.343-.04L9.927 2.028c-.029.113-.04.23-.04.343a1.779 1.779 0 0 0 .062.46z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="displayer mb-2">
                    <div class="vertical_center ms-3">
                        <div class="displayer_header">
                            <h4>[###]</h4>
                        </div>
                        <div class="displayer_data">
                            <h5>Bevétel</h5>
                        </div>
                    </div>
                    <div class="image_container me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="displayer mb-2">
                    <div class="vertical_center ms-3">
                        <div class="displayer_header">
                            <h4>[###]</h4>
                        </div>
                        <div class="displayer_data">
                            <h5>Oldal dokumentáció</h5>
                        </div>
                    </div>
                    <div class="image_container me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-pass" viewBox="0 0 16 16">
                            <path d="M5.5 5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5Zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Z"/>
                            <path d="M8 2a2 2 0 0 0 2-2h2.5A1.5 1.5 0 0 1 14 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-13A1.5 1.5 0 0 1 3.5 0H6a2 2 0 0 0 2 2Zm0 1a3.001 3.001 0 0 1-2.83-2H3.5a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5h-1.67A3.001 3.001 0 0 1 8 3Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS és Popper.js betöltése -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>



