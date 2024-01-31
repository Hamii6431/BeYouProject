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

    <title>Profile page</title>

    <link rel="stylesheet" href="../../public/user_area/css/profilepage.css">
    <link rel="stylesheet" href="../../public/user_area/css/font_import.css">
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <div class="container-fluid p-0 position-relative">
        <div class="row">
            <div class="col-12">
                <img src="../../public/img/banner.png" class="img-fluid w-100">
                <h1 class="position-absolute top-50 start-0 text-center text-white">Welcome <br> <?php echo $username; ?></h1>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="ccardbody">
                    <div class="ccard">
                        <div class="ccardheader">
                            <div class="ccardprocontent">
                                <div class="ccardcontent">
                                    <h3>Profile data</h3>
                                </div>
                                <div class="ccardedit">
                                    <p class="underlined">Edit</p>
                                </div>
                            </div>
                        </div>
                        <div class="ccardprocontent">
                            <div class="ccardcontent">
                                <p class="dataheader">Name</p>
                                <p><?php echo $name; ?></p>
                            </div>
                            <div class="ccardcontent">
                                <p class="dataheader">Gender</p>
                                <p><?php echo $gender; ?></p>
                            </div>
                        </div>
                        <div class="ccardprocontent">
                            <div class="ccardcontent">
                                <p class="dataheader">Birthday</p>
                                <p><?php echo $birthdate; ?></p>
                            </div>
                            <div class="ccardcontent">
                                <p class="dataheader">E-mail</p>
                                <p><?php echo $email; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="ccardbody">
                    <div class="ccard">
                        <div class="ccardheader">
                            <div class="ccardprocontent">
                                <div class="ccardcontent">
                                    <h3>Shipping informations</h3>
                                </div>
                                <div class="ccardedit">
                                    <p class="underlined">Edit</p>
                                </div>
                            </div>
                        </div>
                        <div class="ccardprocontent">
                            <div class="ccardcontent">
                                <p class="dataheader">Country</p>
                                <p><?php echo $country; ?></p>
                            </div>
                            <div class="ccardcontent">
                                <p class="dataheader">Postal code</p>
                                <p><?php echo $postal_code; ?></p>
                            </div>
                        </div>
                        <div class="ccardprocontent">
                            <div class="ccardcontent">
                                <p class="dataheader">City</p>
                                <p><?php echo $city; ?></p>
                            </div>
                            <div class="ccardcontent">
                                <p class="dataheader">Street</p>
                                <p><?php echo $street_address; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <div class="ccardbody">
                    <div class="ccard">
                        <div class="ccardheader">
                            <div class="ccardprocontent">
                                <div class="ccardcontent">
                                    <h3>Previous orders</h3>
                                </div>
                            </div>
                        </div>
                        <div class="ccardprocontent">
                            <div class="ccardcontent">
                                <p class="dataheader">Order number:</p>
                                <p><?php echo $order_ID; ?></p>
                            </div>
                            <div class="ccardedit">
                                <p class="underlined">View</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="ccardbody">
                    <div class="ccard">
                        <div class="ccardheader">
                            <div class="ccardprocontent">
                                <div class="ccardcontent">
                                    <h3>Wish list</h3>
                                </div>
                            </div>
                        </div>
                        <div class="ccardprocontent">
                            <div class="ccardcontent">
                                <p class="dataheader">Product name:</p>
                                <p></p>
                            </div>
                            <div class="ccardedit">
                                <p class="underlined">View</p>
                            </div>
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

<?php 
include '../assets/footer.php' 
?>
