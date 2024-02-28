<?php
// Munkamenet indítása vagy folytatása
session_start();

// Felhasználó azonosítójának beállítása a munkamenetben
$_SESSION['user_id'] = '5';

// A pelda.html fájl tartalmának beolvasása
$html = file_get_contents("pelda.html");

// Helyettesítés a fájl tartalmában
$html = str_replace("Lorem", $_SESSION['user_id'], $html);

// Módosított tartalom megjelenítése
echo $html;
?>
