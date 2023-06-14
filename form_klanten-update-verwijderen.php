<!DOCTYPE html>
<html>
<head>
    <title>Zoeken op klant ID</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
</head>
<body>
    <h1>Klant wijzigen</h1>
<?php
include 'update_delete_select_klanten.php';

$klanten = new Klanten();

// Actie bepalen (update of delete)
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'update') {
    $klantid = isset($_GET['id']) ? $_GET['id'] : '';
    $klantnaam = $_POST['klantnaam'] ?? '';
    $klantemail = $_POST['klantemail'] ?? '';
    $klantadres = $_POST['klantadres'] ?? '';
    $klantpostcode = $_POST['klantpostcode'] ?? '';
    $klantwoonplaats = $_POST['klantwoonplaats'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $klanten->updateKlant($klantid, $klantnaam, $klantemail, $klantadres, $klantpostcode, $klantwoonplaats);
    } else {
        echo "<h2>Klant bijwerken</h2>";
        echo "<form method='POST' action='?action=update&id=$klantid'>";
        echo "<label for='klantnaam'>Klantnaam:</label>";
        echo "<input type='text' name='klantnaam' value='$klantnaam' required><br><br>";
        echo "<label for='klantemail'>Klant E-mail:</label>";
        echo "<input type='email' name='klantemail' value='$klantemail' required><br><br>";
        echo "<label for='klantadres'>Klant Adres:</label>";
        echo "<input type='text' name='klantadres' value='$klantadres' required><br><br>";
        echo "<label for='klantpostcode'>Klant Postcode:</label>";
        echo "<input type='text' name='klantpostcode' value='$klantpostcode' required><br><br>";
        echo "<label for='klantwoonplaats'>Klant Woonplaats:</label>";
        echo "<input type='text' name='klantwoonplaats' value='$klantwoonplaats' required><br><br>";
        echo "<input type='submit' value='Bijwerken'>";
        echo "</form>";
    }
} elseif ($action === 'delete') {
    $klantid = isset($_GET['id']) ? $_GET['id'] : '';

    $klanten->deleteKlant($klantid);
} else {
    // Standaard actie - selectAllKlanten
    $klanten->selectAllKlanten();
}
?>
</body>
</html>

