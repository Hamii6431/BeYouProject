

<?php 
session_start();
require_once '../../Backend/includes/connect.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Termékek</title>

    <link rel="stylesheet" href="adminpanel.css">

    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- ki kell rendezni css-be -->
    <style>
        .keret {
            border-bottom: 6px solid pink;
        }


        .logo img {
            max-width: 180px;
        }

        .name_container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            height: auto;
            margin-top: 20px; /* Fentről távolság */
            margin-bottom: 20px; /* Lentől távolság */
        }


        .nav-item {
            margin-bottom: 10px;
        }

        .nav-link {
            color: black;
            font-size: 18px;
            border: 2px solid transparent; /* ne csúszkáljon */
        }

        .nav-link.active,
        .nav-link:hover {
            border-bottom: 2px solid pink;
            color:gray;
        }

        
        .admin_navbar{
            border-right: 3px solid pink;
        }

        .main-container {
        padding-left: 50px;  /* Bal oldali belső padding */
        padding-right: 50px;  /* Jobb oldali belső padding */
        }

        /* Responsive beállítások a Sidebar-hoz */
        @media (max-width: 768px) {
            .col-12.col-md-3 {
                text-align: center;
            }

            .nav-item {
                margin-bottom: 10px;
            }
        }

        
    </style>

</head>

<body>

<!-----------------------------------------------------------------------HEADER-------------------------------------------------------->

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="logo">
                    <img src="img/logo.png" alt="Logo">
                </div>
            </div>
            <div class="col-6">
                <div class="name_container">
                    <h3>[<?php echo $_SESSION['admin_username']; ?>]</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="keret"></div>


<!-----------------------------------------------------------------------HEADER END-------------------------------------------------------->

    <div class="container-fluid mt-4 main-container">  
            <!-- Adminfelület navigációs sáv -->
            <div class="row">
                <!-- Sidebar (Menu) -->
                <div class="col-12 col-md-3">
                    <div class="admin_navbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="index.php?loadhome" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?loadorders" class="nav-link">Rendelések megtekintése</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?loadedit_product" class="nav-link">Termékek szerkesztése</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?loadinsert_product" class="nav-link">Termék feltöltése</a>
                            </li>
                            <li class="nav-item">
                                <a href="index.php?loadinsert_details" class="nav-link">Termék adatok hozzáadása</a>
                            </li>
                        </ul>
                    </div>
                </div>

<!-----------------------------------------------------------------------MAIN------------------------------------------------------->

                <!-- Main Content -->
                <div class="col-12 col-md-9">
                    <div class="container">
                        <div class="row">
                            <div class="oldalfeltoltes">

                            
                            <?php
                                if (isset($_GET['loadhome'])) {
                                    include('loadhome.php');
                                } elseif (isset($_GET['loadorders'])) {
                                    include('loadorders.php');
                                } elseif (isset($_GET['loadedit_product'])) {
                                    include('loadedit_product.php');
                                } elseif (isset($_GET['loadinsert_product'])) {
                                    include('loadinsert_product.php');
                                } elseif (isset($_GET['loadinsert_details'])) {
                                include('loadinsert_details.php');
                            }
                            ?>


                            <div class="oldalfeltoltes2">
                            <?php
                            if (isset($_GET['insert_color'])) {
                                include('insert_color.php');
                            } elseif (isset($_GET['insert_type'])) {
                                include('insert_type.php');
                            } elseif (isset($_GET['insert_material'])) {
                                include('insert_material.php');
                            } 
                            ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
