<?php

require_once __DIR__ . '/../includes/connect.php'; // Az adatbázis kapcsolódási adatok betöltése
$dbInstance = Database::getInstance(); // A Database példány létrehozása
$con = $dbInstance->getConnection(); // Az adatbázis kapcsolat létrehozása

// Lekérdezések előkészítése
$materialQuery = "SELECT * FROM materials";
$typeQuery = "SELECT * FROM types";
$colorQuery = "SELECT * FROM colors";

// Szűrők lekérdezése és az eredmények tárolása
$materials = [];
$types = [];
$colors = [];

// Materials lekérdezése
$materialQueryRun = mysqli_query($con, $materialQuery);
if (mysqli_num_rows($materialQueryRun) > 0) {
    while ($material = mysqli_fetch_assoc($materialQueryRun)) {
        $materials[] = [
            'id' => $material['material_ID'],
            'name' => $material['material_Name']
        ];
    }
}

// Types lekérdezése
$typeQueryRun = mysqli_query($con, $typeQuery);
if (mysqli_num_rows($typeQueryRun) > 0) {
    while ($type = mysqli_fetch_assoc($typeQueryRun)) {
        $types[] = [
            'id' => $type['type_ID'],
            'name' => $type['type_Name']
        ];
    }
}

// Colors lekérdezése
$colorQueryRun = mysqli_query($con, $colorQuery);
if (mysqli_num_rows($colorQueryRun) > 0) {
    while ($color = mysqli_fetch_assoc($colorQueryRun)) {
        $colors[] = [
            'id' => $color['color_ID'],
            'name' => $color['color_Name']
        ];
    }
}

// Az eredmények összegyűjtése és JSON formátumban való visszaküldése
$response = [
    'materials' => $materials,
    'types' => $types,
    'colors' => $colors
];

header('Content-Type: application/json');
echo json_encode($response);
