<?php

$DB_servername = "localhost";
$DB_username = "Hamii";
$DB_password = "4M9TZedhhxxd-PFP";
$DB_database = "BeYou";

$con = new mysqli($DB_servername, $DB_username, $DB_password, $DB_database);


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$result = $con;

?>