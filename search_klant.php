<?php
include 'conn.php';
include 'Config.php';
include 'classes/klant.php';

$searchCustomer = new ZoekKlant();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zoeken op klant ID</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
</head>
<body>
    <h1>Zoeken op klant ID</h1>

    <form method="GET" action="">
        <label for="klantid">Klant ID:</label>
        <input type="text" name="klantid" id="klantid">
        <input type="submit" value="Zoeken">
    </form>
    <br><br>
    <a href="CRUD_klanten.php" class="button">Klantbeheer</a>
    <br><br>
    <a href="Index.php" class="button">Terug naar Homepage</a>
</body>
</html>
