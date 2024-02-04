<?php 
include '../../Backend/includes/connect.php';
include '../../Backend/includes/session.php';
include '../assets/header.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto+Slab:wght@200;300;600&display=swap" rel="stylesheet">

    <title>Profil oldal</title>

    <!--<link rel="stylesheet" href="../../public/user_area/css/profilepage.css">-->
    <link rel="stylesheet" href="../../public/user_area/css/font_import.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<style>
    * {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 0;
}
.container_profil_preview{
    display:flex;
    justify-content: center;
}
.container_profil_vertical{
    display: flex;
            flex-direction: column;
            align-items: center; /* Középre igazítás */
}



.container_profil_preview_image {
    width: 10rem;
    height: 10rem;
    position: relative;
    overflow: hidden;
    border-radius: 50%;
}
.container_profil_preview_image img {
  display: inline;
  margin: 0 auto;
  margin-left: -25%; 
  height: 100%;
  width: auto;
}
.container_profil_preview_name{
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.container_primary{
    margin-top: 1.5rem;
}

.container_menu{
    display:block;
}
.container_menuitem{
    display:flex;
    background-color: #F6F6F6;
    border-radius: 3px;
    margin-bottom: 0.1rem;
    padding:0.5rem;
}
.container_menuitem_icon {
    display:flex;
    align-items: center;
    transform: scale(1.2); /* Állítsd be a kívánt méretre */
    padding-left: 0.3rem;
    padding-right: 0.3rem;
}

.container_menuitem_line{
    height: 36;
    width: 1px; /* Módosítva: 1px-ről 100%-ra */
    background-color: #27251F;
    margin-left: 0.3rem;
    margin-right: 0.3rem;
}

.container_menuitem_text{
    padding-left: 8px;
    display:flex;
    align-items: center;
    font-size: 20px;
}

.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24
}




.container_surface {
            padding: 1rem;
            padding-top: 0;
        }

        .surface_header1 {
            margin-bottom: 2rem;
        }

        .surface_header2 {
            border-bottom: 1px solid #D0D1D2;
            margin-bottom: 1rem;
        }

        .surface_header2 p {
            margin-bottom: 0;
        }

        .surface_body {
            display: flex;
            flex-wrap: wrap;
            gap: 5px 15px;
        }

        .form-group {
            flex: 1 1 calc(50% - 20px);
            /* Két elem egymás mellett, egy sorban, 20px rés a két elem között */
            position: relative;
            margin-bottom: 1rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            padding-top: 15px;
            box-sizing: border-box;
        }

        .form-group label {
            position: absolute;
            top: 0;
            left: 10px;
            font-size: 12px;
            color: #888;
            transition: all 0.3s;
        }

        button {
        border: none;
        background: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
        display: inline-flex;
        align-items: center;
        margin:0;
        width: 100%;
        
        justify-content: center;
        height: 50px;
        
    }
    .sample_button{
        background-color: #27251F;
        color: white;
        margin-bottom: 0.5rem;
    }
    .sample_button:hover {
        transition: 0.3s;
        background-color: #000000;
        color: white;
    }
    .sample_button_reverse{
        background-color: white;
        color: black;
        border:1px solid black;
    }
    .sample_button_reverse:hover{
        transition: 0.3s;
        background-color: #000000;
        color: white;
    }
</style>

<body>
    <div class="container container_primary">
        <div class="row">
        <div class="col-lg-3">
                <div class="container_profil_preview">
                    <div class="container_profil_vertical">
                        <div class="container_profil_preview_image">
                            <img src="../../public/img/download.jpg" alt="">
                        </div>
                        <div class="container_profil_preview_name">
                            <h5><?php echo $name; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="container_menu">
                    <div class="container_menuitem" id="accountMenuItem">
                        <div class="container_menuitem_icon">
                            <span class="material-symbols-outlined">
                                person
                            </span>
                        </div>
                        <div class="container_menuitem_line"></div>
                        <div class="container_menuitem_text">
                            <p class="m-0">Account</p>
                        </div>
                        <div class="container_menuitem_active">
                            <span class="material-symbols-outlined">
                                chevron_right
                            </span>
                        </div>
                    </div>
                    <div class="container_menuitem" id="manageAccountMenuItem">
                        <div class="container_menuitem_icon">
                            <span class="material-symbols-outlined">
                                manage_accounts
                            </span>
                        </div>
                        <div class="container_menuitem_line"></div>
                        <div class="container_menuitem_text">
                            <p class="m-0">Manage Account</p>
                        </div>
                    </div>
                    <div class="container_menuitem" id="shippingAddressesMenuItem">
                        <div class="container_menuitem_icon">
                            <span class="material-symbols-outlined">
                                local_shipping
                            </span>
                        </div>
                        <div class="container_menuitem_line"></div>
                        <div class="container_menuitem_text">
                            <p class="m-0">Shipping addresses</p>
                        </div>
                    </div>
                    <div class="container_menuitem" id="myOrdersMenuItem">
                        <div class="container_menuitem_icon">
                            <span class="material-symbols-outlined">
                                shopping_cart
                            </span>
                        </div>
                        <div class="container_menuitem_line"></div>
                        <div class="container_menuitem_text">
                            <p class="m-0">My orders</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-12">
                <div class="container_surface" id="profileContainer">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var profileContainer = document.getElementById('profileContainer');

            // Menüelemek kattintás eseménye
            document.querySelectorAll('.container_menuitem').forEach(function (menuItem) {
                menuItem.addEventListener('click', function () {
                    var menuItemId = this.id;
                    loadContent(menuItemId);
                });
            });

            // Alapértelmezett tartalom betöltése
            loadContent('accountMenuItem');

            function loadContent(menuItemId) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        profileContainer.innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "server-side-script.php?menuItemId=" + menuItemId, true);
                xhttp.send();
            }
        });
    </script>

</body>

</html>

<?php 
include '../assets/footer.php' 
?>
