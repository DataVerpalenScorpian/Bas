<?php
include 'verkooporder.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verkooporder</title>
    <link rel="stylesheet" type="text/css" href="bas.css">
</head>
<body>
    <h1>Verkooporder formulier</h1>
    <form method="POST" action="">
        Verkooporder ID: <input type="text" name="verkordid"><br>
        Klant: <?php echo $verkooporder->getKlantDropdown(); ?><br>
        Artikel: <?php echo $verkooporder->getArtikelDropdown(); ?><br>
        Datum: <input type="text" name="verkorddatum"><br>
        Bestelhoeveelheid: <input type="text" name="verkordbestaantal"><br>
        Status: <input type="text" name="verkordstatus"><br>
        <input type="submit" name="insert" value="Verkooporder toevoegen">
        <br><br>
        <a href="form_update-verkooporder-status.php" class="button">Orderbeheer</a>
        <br><br>
        <a href="Index.php" class="button">Terug naar Homepage</a>
        </form>
</body>
</html>
