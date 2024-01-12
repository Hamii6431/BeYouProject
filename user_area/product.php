<?php 
include '../includes/connect.php';
include 'includes/session.php';
include 'includes/header.php';


// Bejelentkezés ellenőrzése
if (isset($_SESSION['user_username'])) {
    $username = $_SESSION['user_username'];
    $user_email = $_SESSION['user_email'];
    $user_ID = $_SESSION['user_id'];
} else {
}

// Ellenőrizze, hogy van-e érvényes termékazonosító
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $productID = $_GET['id'];

    // Lekérdezés a kiválasztott termék adataira
    $product_query = "SELECT * FROM products WHERE product_ID = $productID";
    $product_query_run = mysqli_query($con, $product_query);

    if (mysqli_num_rows($product_query_run) > 0) {
        $product_data = mysqli_fetch_assoc($product_query_run);
        $productName = $product_data['product_name'];
        $productDescription = $product_data['description'];
        $productPrice = $product_data['price'];
        $productImage = $product_data['image'];
    } else {
        echo "Product not found!";
        exit;
    }
} else {
    echo "Invalid product ID!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $productName; ?></title>
    
    <!-- A Google Fonts betűtípus hozzáadása -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&display=swap" rel="stylesheet">

    <!-- A Bootstrap és egyéb stíluslapok hozzáadása -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="includes/font_import.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @font-face {
            font-family: 'CustomFont';
            src: url('../user_area/fonts/Optima\ Medium.woff') format('woff');
        }

        body {
            font-family: 'CustomFont', sans-serif;
        }

        .btn_add_cart {
            width: 100%;
            background-color: #27251F;
            color: white;
            justify-content: center;
            height: 50px;
        }

        .btn_add_cart:hover {
            transition: 0.3s;
            background-color: #FFCAD4;
            color: black;
        }

        .product_images img {
            display: inline-block;
            width: 47%;
            margin: 1%;
        }

        .primary_container {
            padding-top: 1.5%;
        }

        .description_and_details_btn {
            width: 100%;
            justify-content: space-between;
        }

        .description_and_details_box {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .description {
            width: 100%;
        }
    </style>
</head>

<body>

<div class="container primary_container">
    <div class="row justify-content-between mb-3">
        <div class="primary-images col-12 col-sm-6 col-lg-8">
            <div class="product_images">
                <img src="../admin_area/product_images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid mb-2">
                <img src="../admin_area/product_images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid mb-2">
                <img src="../admin_area/product_images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid mb-2">
                <img src="../admin_area/product_images/<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid mb-2">
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <h2><?php echo $productName; ?></h2>
            <p><strong>Price:</strong> <?php echo $productPrice; ?> Ft</p>
            <hr>

            <form action="includes/add_to_cart.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $user_ID; ?>">
                <input type="hidden" name="product_id" value="<?php echo $productID; ?>">
                <button type="submit" class="btn_add_cart">Add to cart</button>
            </form>

            <div class="description_and_details">
                <div class="description_and_details_box mt-3">
                    <button class="description_and_details_btn" onclick="showDescription()">PRODUCT DESCRIPTION
                        <span class="material-symbols-outlined">add</span>
                    </button>
                    <div class="description mt-3" style="display: none;">
                        <?php echo $productDescription; ?>
                    </div>
                </div>

                <div class="description_and_details_box mt-2">
                    <button class="description_and_details_btn" onclick="showDetails()">PRODUCT DETAILS
                        <span class="material-symbols-outlined">add</span>
                    </button>
                    <div class="description mt-3" style="display: none;">
                        <?php echo $productDescription; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showDescription() {
        var descriptionDiv = document.querySelector('.description');
        if (descriptionDiv.style.display === 'none' || descriptionDiv.style.display === '') {
            descriptionDiv.style.display = 'block';
        } else {
            descriptionDiv.style.display = 'none';
        }
    }
    function showDetails() {
        // AJAX kérés a termék részleteinek lekérdezéséhez
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "includes/get_product_details.php?id=" + <?php echo $productID; ?>, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Sikeres válasz esetén a JSON adatok feldolgozása
                var details = JSON.parse(xhr.responseText);

                // Elemek kiválasztása
                var detailsDiv = document.querySelector('.details');
                var detailsBtn = document.querySelector('.details_and_details_btn');

                // Szöveg beállítása a részletek div-be
                detailsDiv.innerHTML = `
                    <p><strong>Color:</strong> ${details.color_Name}</p>
                    <p><strong>Type:</strong> ${details.type_Name}</p>
                    <p><strong>Material:</strong> ${details.material_Name}</p>
                `;

                // Megjelenítés/kikapcsolás állapotának kezelése
                if (detailsDiv.style.display === 'none' || detailsDiv.style.display === '') {
                    detailsDiv.style.display = 'block';
                    detailsBtn.classList.add('active');  // Opcionális: Aktív osztály hozzáadása a gombhoz stílusozáshoz
                } else {
                    detailsDiv.style.display = 'none';
                    detailsBtn.classList.remove('active');  // Opcionális: Aktív osztály eltávolítása a gombtól stílusozáshoz
                }
            } else {
                // Hiba esetén kiírjuk a konzolra a hibaüzenetet
                console.error(xhr.responseText);
            }
        };

        xhr.send();
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
<?php include 'includes/footer.php'; ?>
