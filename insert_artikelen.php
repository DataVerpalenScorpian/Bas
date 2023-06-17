<?php
include 'conn.php';
include 'Config.php';
include 'classes/artikel.php';

$artikelen = new Artikelen();

if (isset($_POST['insert'])) {
    $artid = $_POST['artid'] ?? '';
    $artikelenomschrijving = $_POST['artikelenomschrijving'] ?? '';
    $artinkoop = $_POST['artinkoop'] ?? '';
    $artverkoop = $_POST['artverkoop'] ?? '';
    $artvoorraad = $_POST['artvoorraad'] ?? '';
    $artminvoorraad = $_POST['artminvoorraad'] ?? '';
    $artmaxvoorraad = $_POST['artmaxvoorraad'] ?? '';
    $artlocatie = $_POST['artlocatie'] ?? '';
    $levid = $_POST['levid'] ?? '';

    $artikelen->insert($artid, $artikelenomschrijving, $artinkoop, $artverkoop, $artvoorraad, $artminvoorraad, $artmaxvoorraad, $artlocatie, $levid);
}
?>
