<?php
include 'insert_leveranciers.php';
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="bas.css">
    <title>Leverancier toevoegen</title>
</head>
<body>
    <h2>Leverancier toevoegen</h2>
    <form method="POST" action="">
        <label for="levid">Leverancier ID:</label>
        <input type="text" name="levid" required><br><br>

        <label for="levnaam">Naam:</label>
        <input type="text" name="levnaam" required><br><br>

        <label for="levcontact">Contactpersoon:</label>
        <input type="text" name="levcontact" required><br><br>

        <label for="levemail">E-mail:</label>
        <input type="email" name="levemail" required><br><br>

        <label for="levadres">Adres:</label>
        <input type="text" name="levadres" required><br><br>

        <label for="levpostcode">Postcode:</label>
        <input type="text" name="levpostcode" required><br><br>

        <label for="levwoonplaats">Woonplaats:</label>
        <input type="text" name="levwoonplaats" required><br><br>

        <input type="submit" name="insertLeverancier" value="Leverancier toevoegen">
    </form>
</body>
</html>
