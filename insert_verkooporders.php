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
    <form method="POST" action="">
        Verkooporder ID: <input type="text" name="verkordid"><br>
        Klant: <?php echo $verkooporder->getKlantDropdown(); ?><br>
        Artikel: <?php echo $verkooporder->getArtikelDropdown(); ?><br>
        Datum: <input type="text" name="verkorddatum"><br>
        Bestelhoeveelheid: <input type="text" name="verkordbestaantal"><br>
        Status: <input type="text" name="verkordstatus"><br>
        <input type="submit" name="insert" value="Insert">
    </form>
</body>
</html>
